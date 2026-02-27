<?php
/**
 * Page Module articles Import from CSV/Excel
 * Plugin pageimportcvsexcel for Cotonti 0.9.26, PHP 8.4+
 * Filename: pageimportcvsexcel.functions.php
 * Purpose: Functions for the Plugin pageimportcvsexcel
 * Date: Feb 27Th, 2026
 * Source: https://github.com/webitproff/cot-excelimport-PhpSpreadsheet_No-Composer
 * Support: https://abuyfile.com/ru/forums/cotonti/custom/plugs/topic123
 * @package pageimportcvsexcel
 * @version 2.2.27
 * @author webitproff
 * @copyright Copyright (c) webitproff 2026 | https://github.com/webitproff
 * @license BSD
 */
defined('COT_CODE') or die('Wrong URL');

$pluginDir = $cfg['plugins_dir'] . '/pageimportcvsexcel';
$libPathPhpSpreadsheet = "$pluginDir/lib/phpspreadsheet/src/PhpOffice/PhpSpreadsheet";
$libPathPsr = "$pluginDir/lib/psr/simple-cache/src/Psr/SimpleCache";
$logFile = "$pluginDir/logs/import.log";

spl_autoload_register(function (string $class) use ($libPathPhpSpreadsheet): void {
    if (str_starts_with($class, 'PhpOffice\\PhpSpreadsheet\\')) {
        $file = $libPathPhpSpreadsheet . '/' . str_replace('\\', '/', substr($class, strlen('PhpOffice\\PhpSpreadsheet\\'))) . '.php';
        if (file_exists($file)) require_once $file;
    }
});

spl_autoload_register(function (string $class) use ($libPathPsr): void {
    if (str_starts_with($class, 'Psr\\SimpleCache\\')) {
        $file = $libPathPsr . '/' . str_replace('\\', '/', substr($class, strlen('Psr\\SimpleCache\\'))) . '.php';
        if (file_exists($file)) require_once $file;
    }
});

require_once "$libPathPhpSpreadsheet/Spreadsheet.php";
require_once "$libPathPhpSpreadsheet/IOFactory.php";


/**
 * Логирование сообщений в файл, если включено в конфиге плагина
 */
function cot_pageimportcvsexcel_log(string $message): void {
    global $cfg, $logFile;
    if (isset($cfg['plugin']['pageimportcvsexcel']['use_function_log']) && $cfg['plugin']['pageimportcvsexcel']['use_function_log'] === '1') {
        file_put_contents($logFile, "[" . date('Y-m-d H:i:s') . "] $message\n", FILE_APPEND);
    }
}

/**
 * Удаление ссылок из текста, если включено в конфиге
 */
function cot_pageimportcvsexcel_strip_links(string $html): string {
    global $cfg;
    if (!isset($cfg['plugin']['pageimportcvsexcel']['use_function_strip_links']) || $cfg['plugin']['pageimportcvsexcel']['use_function_strip_links'] !== '1') {
        // Если функция отключена — вернуть вход без изменений
        return $html;
    }

    // 1. Удаляем все теги <script> и их содержимое
    $html = preg_replace('#<script\b[^>]*>(.*?)</script>#is', '', $html);

    // 2. Заменяем <div> на <p>, закрывающие теги тоже
    // Важно: Заменяем именно теги, без содержания
    $html = preg_replace('#<div\b([^>]*)>#i', '<p$1>', $html);
    $html = preg_replace('#</div>#i', '</p>', $html);

    // 3. Удаляем атрибуты событий (onclick, onload и др.) из всех тегов
    // Список атрибутов событий можно расширять по необходимости
    $html = preg_replace('#\s(on\w+)\s*=\s*(["\']).*?\2#i', '', $html);

    // 4. Удаляем javascript: и data: схемы из href/src
    $html = preg_replace_callback('#\s(href|src)\s*=\s*(["\'])(.*?)\2#i', function($m) {
        $attr = $m[1];
        $quote = $m[2];
        $val = trim($m[3]);
        // Удаляем, если начинается с javascript: или data:
        if (preg_match('#^(javascript:|data:)#i', $val)) {
            return '';
        }
        return " $attr=$quote$val$quote";
    }, $html);

    // 5. Удаляем все ссылки <a href=...> оставляя только текст
    $html = preg_replace_callback('#<a\b[^>]*>(.*?)</a>#si', function ($m) {
        // Оставляем только текст без тегов внутри ссылки
        return strip_tags($m[1]);
    }, $html);

    // 6. Удаляем прямые URL вида https://example.com, http://, ftp://, www.
    $html = preg_replace('#\b(?:https?://|ftp://|www\.)\S+\b#i', '', $html);

    // 7. Удаляем пустые теги, например <p></p> или <p> </p> после очистки
    $html = preg_replace('#<(\w+)[^>]*>\s*</\1>#', '', $html);

    // 8. Можно добавить ещё очистка от лишних пробелов и переносов
    $html = trim($html);

    return $html;
}



function cot_pageimportcvsexcel_check_format(string $fileName): string|false {
    global $cfg;
    $allowedFormats = explode(',', $cfg['plugin']['pageimportcvsexcel']['allowed_formats'] ?? 'xlsx,csv');
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    if (!in_array($fileExt, $allowedFormats)) {
        cot_pageimportcvsexcel_log("Ошибка: формат '$fileExt' не поддерживается.");
        return false;
    }
    return $fileExt;
}

function cot_pageimportcvsexcel_get_headers(string $filePath, string $fileName): array|string {
    $fileExt = cot_pageimportcvsexcel_check_format($fileName);
    if ($fileExt === false) return "Ошибка: формат не поддерживается.";
    try {
        $readerType = ($fileExt === 'csv') ? 'Csv' : 'Xlsx';
        $reader = PhpOffice\PhpSpreadsheet\IOFactory::createReader($readerType);
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load($filePath);
        $headers = [];
        foreach ($spreadsheet->getActiveSheet()->getRowIterator(1)->current()->getCellIterator() as $cell) {
            $value = trim((string) ($cell->getValue() ?? ''));
            $headers[] = $value ?: '0';
        }
        cot_pageimportcvsexcel_log("Считаны заголовки: " . implode(', ', $headers));
        return $headers;
    } catch (Exception $e) {
        $error = "Ошибка чтения заголовков: " . $e->getMessage();
        cot_pageimportcvsexcel_log($error);
        return $error;
    }
}


/**
 * Импорт данных из Excel/CSV в таблицу pages.
 *
 * @param string $filePath Путь к файлу Excel/CSV на сервере.
 * @param array  $mapping  Ассоциативный массив маппинга: поле БД => заголовок в Excel.
 * @param string $fileName Имя файла (для проверки расширения).
 *
 * @return string Результат выполнения импорта (успешно/ошибка).
 */
function cot_pageimportcvsexcel_process(string $filePath, array $mapping, string $fileName): string {
    // Подключаем глобальные переменные
    global $db, $cfg, $db_x, $db_pages, $sys, $usr;

    // Определяем таблицу для импорта
    $db_pages = $db_x . 'pages';

    // Проверяем формат файла
    $fileExt = cot_pageimportcvsexcel_check_format($fileName);
    if ($fileExt === false) return "Ошибка: формат не поддерживается.";

    try {
        // Определяем существующие колонки в таблице
        $existingColumns = [];
        $colsRes = $db->query("SHOW COLUMNS FROM `$db_pages`")->fetchAll();
        foreach ($colsRes as $col) {
            // Добавляем имя колонки в список
            $existingColumns[] = $col['Field'];
        }
        // Логируем найденные поля
        cot_pageimportcvsexcel_log("Найденные поля таблицы: " . implode(', ', $existingColumns));

        // Определяем тип ридера (CSV или XLSX)
        $readerType = ($fileExt === 'csv') ? 'Csv' : 'Xlsx';

        // Создаём объект ридера
        $reader = PhpOffice\PhpSpreadsheet\IOFactory::createReader($readerType);

        // Читаем только данные (без стилей)
        $reader->setReadDataOnly(true);

        // Загружаем файл
        $spreadsheet = $reader->load($filePath);

        // Получаем активный лист
        $sheet = $spreadsheet->getActiveSheet();

        // Определяем количество строк
        $totalRows = $sheet->getHighestRow() - 1;

        // Лимит строк для импорта
        $maxRows = (int) ($cfg['plugin']['pageimportcvsexcel']['max_rows'] ?? 100);

        // Сбрасываем прогресс в сессии
        $_SESSION['import_progress'] = 0;
        $_SESSION['import_total'] = min($totalRows, $maxRows > 0 ? $maxRows : $totalRows);

        // Счётчик импортированных строк
        $importedRows = 0;

        // Получаем заголовки столбцов
        $headers = cot_pageimportcvsexcel_get_headers($filePath, $fileName);
        if (!is_array($headers)) return $headers;

        // Логируем маппинг
        cot_pageimportcvsexcel_log("Маппинг: " . json_encode($mapping));

        // Перебираем строки в файле
        foreach ($sheet->getRowIterator() as $row) {
            // Пропускаем строку заголовка и строки за пределом лимита
            if ($row->getRowIndex() === 1 || ($maxRows > 0 && $importedRows >= $maxRows)) continue;

            // Массив данных строки
            $data = [];
            foreach ($row->getCellIterator() as $cell) {
                // Получаем значение ячейки
                $value = $cell->getValue();

                // Если это дата Excel — преобразуем в timestamp
                if ($value instanceof \PhpOffice\PhpSpreadsheet\Shared\Date) {
                    $value = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($value);
                }

                // Добавляем в массив данных
                $data[] = trim((string) $value);
            }

            // Логируем обработку строки
            cot_pageimportcvsexcel_log("Обрабатываемая строка {$row->getRowIndex()}: " . json_encode($data));

            // Создаём массив записи
            $record = [];

            // Значения по умолчанию
            $defaults = [
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
                'page_parser' => 'html',
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

            // Заполняем только существующие поля значениями по умолчанию
            foreach ($defaults as $field => $defValue) {
                if (in_array($field, $existingColumns)) {
                    $record[$field] = $defValue;
                }
            }

            // Заполняем данными из Excel по маппингу
            foreach ($mapping as $dbField => $excelHeader) {
                if (in_array($dbField, $existingColumns) && $excelHeader && ($colIndex = array_search($excelHeader, $headers)) !== false) {
                    // Берём значение ячейки
                    $value = $data[$colIndex] ?? '';

                    // Если поле — дата
                    if (in_array($dbField, ['page_date', 'page_begin', 'page_expire', 'page_updated'])) {
                        $timestamp = is_numeric($value) ? (int)$value : strtotime((string)$value);
                        $record[$dbField] = $timestamp ?: (int) Cot::$sys['now'];
                        cot_pageimportcvsexcel_log("Дата для $dbField: исходное '$value', результат {$record[$dbField]}");


                    // Если текстовое поле — удаляем ссылки
                    } elseif (in_array($dbField, ['page_text', 'page_desc', 'page_metadesc'])) {
                        $record[$dbField] = cot_pageimportcvsexcel_strip_links((string)$value);

                    // Все остальные поля — сохраняем как строку
                    } else {
                        $record[$dbField] = (string)$value;
                    }
                }
            }

            // Проверка обязательных полей (категория и заголовок)
            if (
                (in_array('page_cat', $existingColumns) && trim((string)($record['page_cat'] ?? '')) === '') ||
                (in_array('page_title', $existingColumns) && trim((string)($record['page_title'] ?? '')) === '')
            ) {
                cot_pageimportcvsexcel_log("Строка {$row->getRowIndex()} пропущена: пустые page_cat или page_title");
                continue;
            }

            // Если page_text пустой — подставляем заголовок
            if (in_array('page_text', $existingColumns) && empty($record['page_text']) && !empty($record['page_title'])) {
                $record['page_text'] = $record['page_title'];
                cot_pageimportcvsexcel_log("page_text пуст — подставлен заголовок: {$record['page_title']}");
            }

            // Логируем подготовленный массив
            cot_pageimportcvsexcel_log("Подготовленный массив для вставки: " . json_encode($record));

            try {
                // Пытаемся вставить запись в базу
                if (!empty($record) && $db->insert($db_pages, $record)) {
                    $importedRows++;
                    $_SESSION['import_progress'] = $importedRows;
                    cot_pageimportcvsexcel_log("Импортирована строка {$row->getRowIndex()}: " . implode(', ', $data));
                } else {
                    cot_pageimportcvsexcel_log("Ошибка вставки строки {$row->getRowIndex()}: не удалось добавить запись");
                }
            } catch (Exception $e) {
                // Логируем исключение при вставке
                cot_pageimportcvsexcel_log("Исключение при вставке строки {$row->getRowIndex()}: " . $e->getMessage());
            }
        }

        // Финальный результат
        $result = "Импорт завершён. Добавлено записей: $importedRows из $totalRows";
        cot_pageimportcvsexcel_log($result);

        // Чистим сессию
        unset($_SESSION['import_progress'], $_SESSION['import_total']);

        // Возвращаем результат
        return $result;

    } catch (Exception $e) {
        // Обработка исключения
        $error = "Ошибка импорта: " . $e->getMessage();
        cot_pageimportcvsexcel_log($error);
        return $error;
    }
}

