<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=tools
[END_COT_EXT]
==================== */

defined('COT_CODE') or die('Wrong URL');

// Временная отладка
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once cot_incfile('excelimport', 'plug');
require_once cot_langfile('excelimport', 'plug');

if (!cot_auth('plug', 'excelimport', 'W')) {
    cot_die_message(403);
}
$adminTitle = Cot::$L['excelimport_title'];

// Проверяем сессию
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Папка для хранения файлов
$uploadDir = $cfg['plugins_dir'] . '/excelimport/uploads/';
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// Список полей таблицы pages
$pageFields = [
    'page_id' => 'ID (auto)',
    'page_alias' => 'Alias',
    'page_state' => 'State',
    'page_cat' => 'Category',
    'page_title' => 'Title',
    'page_desc' => 'Description',
    'page_keywords' => 'Keywords',
    'page_metatitle' => 'Meta Title',
    'page_metadesc' => 'Meta Description',
    'page_text' => 'Text',
    'page_parser' => 'Parser',
    'page_author' => 'Author',
    'page_ownerid' => 'Owner ID',
    'page_date' => 'Date',
    'page_begin' => 'Begin Date',
    'page_expire' => 'Expire Date',
    'page_updated' => 'Updated Date',
    'page_file' => 'File Flag',
    'page_url' => 'URL',
    'page_size' => 'Size',
    'page_count' => 'Count',
    'page_filecount' => 'File Count'
];

$t = new XTemplate(cot_tplfile('excelimport.tools', 'plug', true));

// Отладка: проверяем запрос
$a = cot_import('a', 'G', 'TXT');
cot_excelimport_log("Запрос: m=" . cot_import('m', 'G', 'TXT') . ", p=" . cot_import('p', 'G', 'TXT') . ", a=" . ($a ?? 'пусто'));

// Обработка действий
if ($a === 'upload' && !empty($_FILES['excel_file']['tmp_name'])) {
    cot_excelimport_log("Начало загрузки файла");
    $fileTmpPath = (string) $_FILES['excel_file']['tmp_name'];
    $fileName = (string) $_FILES['excel_file']['name'];
    $filePath = $uploadDir . uniqid('excel_') . '_' . basename($fileName);
    
    // Перемещаем файл из временной папки
    if (move_uploaded_file($fileTmpPath, $filePath)) {
        $_SESSION['excel_file_path'] = $filePath;
        $_SESSION['excel_file_name'] = $fileName;
        $headers = cot_excelimport_get_headers($filePath, $fileName);
        if (is_array($headers)) {
            $_SESSION['excel_headers'] = $headers;
            cot_excelimport_log("Файл загружен успешно, путь: $filePath, заголовки: " . implode(', ', $headers));
        } else {
            cot_message("Ошибка при загрузке: $headers");
            unset($_SESSION['excel_file_path'], $_SESSION['excel_file_name'], $_SESSION['excel_headers']);
            if (file_exists($filePath)) unlink($filePath);
            cot_excelimport_log("Сессия очищена из-за ошибки, файл удалён");
        }
    } else {
        cot_message("Ошибка: не удалось переместить файл.");
        cot_excelimport_log("Ошибка перемещения файла из $fileTmpPath в $filePath");
    }
    $redirectUrl = cot_url('admin', ['m' => 'other', 'p' => 'excelimport'], '', true);
    cot_excelimport_log("Редирект на: $redirectUrl");
    cot_redirect($redirectUrl);
} elseif ($a === 'import' && !empty($_POST['mapping'])) {
    cot_excelimport_log("Начало импорта");
    $filePath = $_SESSION['excel_file_path'] ?? '';
    $fileName = $_SESSION['excel_file_name'] ?? '';
    if ($filePath && file_exists($filePath)) {
        $result = cot_excelimport_process($filePath, (array) $_POST['mapping'], $fileName);
        cot_message($result);
        // Очищаем сессию и удаляем файл после импорта
        unset($_SESSION['excel_file_path'], $_SESSION['excel_headers'], $_SESSION['excel_file_name']);
        if (file_exists($filePath)) unlink($filePath);
        cot_excelimport_log("Импорт завершён, сессия очищена, файл удалён: $filePath");
    } else {
        $error = "Ошибка: файл не найден для импорта.";
        cot_message($error);
        cot_excelimport_log($error . " Путь: $filePath");
    }
    $redirectUrl = cot_url('admin', ['m' => 'other', 'p' => 'excelimport'], '', true);
    cot_excelimport_log("Редирект на: $redirectUrl");
    cot_redirect($redirectUrl);
} elseif ($a === 'reset') {
    // Сброс сессии для загрузки нового файла
    $filePath = $_SESSION['excel_file_path'] ?? '';
    if ($filePath && file_exists($filePath)) unlink($filePath);
    unset($_SESSION['excel_file_path'], $_SESSION['excel_headers'], $_SESSION['excel_file_name']);
    cot_excelimport_log("Сессия сброшена вручную, файл удалён: $filePath");
    $redirectUrl = cot_url('admin', ['m' => 'other', 'p' => 'excelimport'], '', true);
    cot_excelimport_log("Редирект на: $redirectUrl");
    cot_redirect($redirectUrl);
}

// Отладка состояния сессии
$sessionHeaders = isset($_SESSION['excel_headers']) ? (is_array($_SESSION['excel_headers']) ? 'массив (' . count($_SESSION['excel_headers']) . ')' : 'строка: ' . $_SESSION['excel_headers']) : 'не задано';
cot_excelimport_log("Состояние сессии: headers=$sessionHeaders");

// Показываем форму загрузки или маппинг
if (!isset($_SESSION['excel_headers']) || !is_array($_SESSION['excel_headers'])) {
    cot_excelimport_log("Показываем форму загрузки");
    $t->assign([
        'EXCELIMPORT_FORM_ACTION' => cot_url('admin', ['m' => 'other', 'p' => 'excelimport', 'a' => 'upload'], '', true),
        'EXCELIMPORT_FORM_ENCTYPE' => 'multipart/form-data',
        'EXCELIMPORT_MAX_ROWS' => $cfg['plugin']['excelimport']['max_rows'],
        'EXCELIMPORT_ALLOWED_FORMATS' => $cfg['plugin']['excelimport']['allowed_formats']
    ]);
    $t->parse('MAIN.UPLOAD');
    cot_excelimport_log("Форма загрузки отрендерена");
} else {
    cot_excelimport_log("Показываем форму маппинга");
    $headers = $_SESSION['excel_headers'];
    foreach ($pageFields as $field => $label) {
        $t->assign([
            'FIELD_NAME' => $field,
            'FIELD_LABEL' => $label,
            'FIELD_INPUT' => cot_inputbox('text', "mapping[$field]", '', ['size' => 50, 'placeholder' => 'Введите заголовок из Excel'])
        ]);
        $t->parse('MAIN.MAPPING.FIELDS');
    }
    $t->assign([
        'EXCELIMPORT_MAPPING_ACTION' => cot_url('admin', ['m' => 'other', 'p' => 'excelimport', 'a' => 'import'], '', true),
        'EXCELIMPORT_PROGRESS_URL' => cot_url('admin', ['m' => 'other', 'p' => 'excelimport', 'a' => 'progress'], '', true),
        'EXCELIMPORT_HEADERS' => implode(', ', $headers),
        'EXCELIMPORT_RESET_URL' => cot_url('admin', ['m' => 'other', 'p' => 'excelimport', 'a' => 'reset'], '', true)
    ]);
    $t->parse('MAIN.MAPPING');
    cot_excelimport_log("Форма маппинга отрендерена");
}

cot_display_messages($t);
$t->parse('MAIN');
$pluginBody = $t->text('MAIN');

// Дополнительная отладка: что отрендерилось
cot_excelimport_log("Отрендерено: " . (!empty($pluginBody) ? 'содержимое есть (' . strlen($pluginBody) . ' символов)' : 'пусто'));