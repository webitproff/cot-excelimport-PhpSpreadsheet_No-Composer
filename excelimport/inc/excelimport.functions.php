<?php
defined('COT_CODE') or die('Wrong URL');

/**
 * Плагин для импорта данных из Excel в Cotonti с использованием PhpSpreadsheet
 */

/* === Подключение PhpSpreadsheet и Psr\SimpleCache === */
$pluginDir = $cfg['plugins_dir'] . '/excelimport';
$libPathPhpSpreadsheet = "$pluginDir/lib/phpspreadsheet/src/PhpOffice/PhpSpreadsheet";
$libPathPsr = "$pluginDir/lib/psr/simple-cache/src/Psr/SimpleCache";
$logFile = "$pluginDir/logs/import.log";

// Автозагрузчик PhpSpreadsheet
spl_autoload_register(function (string $class) use ($libPathPhpSpreadsheet): void {
    if (str_starts_with($class, 'PhpOffice\\PhpSpreadsheet\\')) {
        $relativePath = substr($class, strlen('PhpOffice\\PhpSpreadsheet\\'));
        $file = $libPathPhpSpreadsheet . '/' . str_replace('\\', '/', $relativePath) . '.php';
        if (file_exists($file)) {
            require_once $file;
        } else {
            cot_excelimport_log("Файл не найден: $file");
            die("Class $class not found. Expected file: $file");
        }
    }
});

// Автозагрузчик Psr\SimpleCache
spl_autoload_register(function (string $class) use ($libPathPsr): void {
    if (str_starts_with($class, 'Psr\\SimpleCache\\')) {
        $relativePath = substr($class, strlen('Psr\\SimpleCache\\'));
        $file = $libPathPsr . '/' . str_replace('\\', '/', $relativePath) . '.php';
        if (file_exists($file)) {
            require_once $file;
        }
    }
});

// Подключаем основные классы вручную
require_once "$libPathPhpSpreadsheet/Spreadsheet.php";
require_once "$libPathPhpSpreadsheet/IOFactory.php";

/**
 * Логирование
 */
function cot_excelimport_log(string $message): void
{
    global $logFile;
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents($logFile, "[$timestamp] $message\n", FILE_APPEND);
}

/**
 * Проверяет формат файла по оригинальному имени
 */
function cot_excelimport_check_format(string $fileName): string|false
{
    global $cfg;
    $allowedFormats = explode(',', $cfg['plugin']['excelimport']['allowed_formats'] ?? 'xlsx,csv');
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    if (!in_array($fileExt, $allowedFormats)) {
        $error = "Ошибка: формат '$fileExt' не поддерживается.";
        cot_excelimport_log($error);
        return false;
    }
    return $fileExt;
}

/**
 * Читает заголовки из Excel-файла
 */
function cot_excelimport_get_headers(string $filePath, string $fileName): array|string
{
    $fileExt = cot_excelimport_check_format($fileName);
    if ($fileExt === false) {
        return "Ошибка: формат не поддерживается.";
    }

    $readerType = ($fileExt === 'csv') ? 'Csv' : 'Xlsx';
    $reader = PhpOffice\PhpSpreadsheet\IOFactory::createReader($readerType);
    $reader->setReadDataOnly(true);
    $spreadsheet = $reader->load($filePath);
    $sheet = $spreadsheet->getActiveSheet();

    $headers = [];
    $row = $sheet->getRowIterator(1)->current();
    foreach ($row->getCellIterator() as $cell) {
        $headers[] = (string) ($cell->getValue() ?? '');
    }

    return $headers;
}

/**
 * Обрабатывает импорт с учётом маппинга
 */
function cot_excelimport_process(string $filePath, array $mapping, string $fileName): string
{
    global $db, $cfg, $db_x, $db_pages, $sys, $usr;
	$db_pages = $db_x . 'pages';
    
    $fileExt = cot_excelimport_check_format($fileName);
    if ($fileExt === false) {
        return "Ошибка: формат не поддерживается.";
    }

    $targetTable = $cfg['plugin']['excelimport']['import_table'] ?? 'pages';
    $maxRows = (int) ($cfg['plugin']['excelimport']['max_rows'] ?? 100);

    $readerType = ($fileExt === 'csv') ? 'Csv' : 'Xlsx';
    $reader = PhpOffice\PhpSpreadsheet\IOFactory::createReader($readerType);
    $reader->setReadDataOnly(true);
    $spreadsheet = $reader->load($filePath);
    $sheet = $spreadsheet->getActiveSheet();

    $totalRows = $sheet->getHighestRow() - 1;
    $table = $db_pages; //($targetTable === 'pages') ? 'cot_pages' : $targetTable;

    $_SESSION['import_progress'] = 0;
    $_SESSION['import_total'] = min($totalRows, $maxRows > 0 ? $maxRows : $totalRows);

    $importedRows = 0;
    $headers = cot_excelimport_get_headers($filePath, $fileName);
    if (!is_array($headers)) {
        return $headers; // Вернём ошибку, если заголовки некорректны
    }

    foreach ($sheet->getRowIterator() as $row) {
        if ($row->getRowIndex() === 1 || ($maxRows > 0 && $importedRows >= $maxRows)) {
            continue;
        }

        $data = [];
        foreach ($row->getCellIterator() as $cell) {
            $data[] = $cell->getValue();
        }
        if (empty($data[0])) {
            continue;
        }

        $record = [];
        if ($targetTable === 'pages') {
            $record = [
                'page_id' => null,
                'page_alias' => '',
                'page_state' => 0,
                'page_cat' => 'news',
                'page_title' => '',
                'page_desc' => '',
                'page_keywords' => '',
                'page_metatitle' => '',
                'page_metadesc' => '',
                'page_text' => '',
                'page_parser' => '',
                'page_author' => '',
                'page_ownerid' => $usr['id'] ?: 1,
                'page_date' => $sys['now'],
                'page_begin' => 0,
                'page_expire' => 0,
                'page_updated' => $sys['now'],
                'page_file' => 0,
                'page_url' => '',
                'page_size' => 0,
                'page_count' => 0,
                'page_filecount' => 0
            ];

            foreach ($mapping as $dbField => $excelHeader) {
                if ($excelHeader && ($colIndex = array_search($excelHeader, $headers)) !== false) {
                    $value = $data[$colIndex] ?? '';
                    if (in_array($dbField, ['page_date', 'page_begin', 'page_expire', 'page_updated'])) {
                        $record[$dbField] = strtotime((string) $value) ?: $sys['now'];
                    } else {
                        $record[$dbField] = (string) $value;
                    }
                }
            }
        }

        $db->insert($table, $record);
        $importedRows++;
        $_SESSION['import_progress'] = $importedRows;

        cot_excelimport_log("Импортирована строка $importedRows: " . implode(', ', $data));
    }

    $result = "Импорт завершён. Добавлено записей: $importedRows из $totalRows";
    cot_excelimport_log($result);
    unset($_SESSION['import_progress'], $_SESSION['import_total']);
    return $result;
}
