<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=tools
[END_COT_EXT]
==================== */
/**
 * Page Module articles Import from CSV/Excel
 * Plugin pageimportcvsexcel for Cotonti 0.9.26, PHP 8.4+
 * Filename: pageimportcvsexcel.tools.php
 * Purpose: Administration for the Plugin pageimportcvsexcel
 * Date: Feb 25Th, 2026
 * Source: https://github.com/webitproff/cot-excelimport-PhpSpreadsheet_No-Composer
 * Support: https://abuyfile.com/ru/forums/cotonti/custom/plugs/topic123
 * @package pageimportcvsexcel
 * @version 2.0.1
 * @author webitproff
 * @copyright Copyright (c) webitproff 2026 | https://github.com/webitproff
 * @license BSD
 */  
defined('COT_CODE') or die('Wrong URL');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once cot_incfile('pageimportcvsexcel', 'plug');
require_once cot_langfile('pageimportcvsexcel', 'plug');

if (!cot_auth('plug', 'pageimportcvsexcel', 'W')) {
    cot_die_message(403);
}
// заголовок браузера на странице администрирования плагина https://supersite.com/admin/other?p=pageimportcvsexcel
$adminTitle = Cot::$L['pageimportcvsexcel_adminTitle'] ?? '';

// текст справки по администрированию плагина, если такая строка есть в файле локализации
$adminHelp = Cot::$L['pageimportcvsexcel_adminHelp'] ?? 'help text not writed yet'; 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$uploadDir = $cfg['plugins_dir'] . '/pageimportcvsexcel/uploads/';
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

$pageFields = [
    'page_id' =>               $L['pageimportcvsexcel_map_col_id'],
    'page_alias' =>            $L['pageimportcvsexcel_map_col_alias'],
    'page_state' =>            $L['pageimportcvsexcel_map_col_state'],
    'page_cat' =>              $L['pageimportcvsexcel_map_col_cat'],
    'page_title' =>            $L['pageimportcvsexcel_map_col_title'],
    'page_desc' =>             $L['pageimportcvsexcel_map_col_desc'],
    'page_keywords' =>         $L['pageimportcvsexcel_map_col_keywords'],
    'page_metatitle' =>        $L['pageimportcvsexcel_map_col_metatitle'],
    'page_metadesc' =>         $L['pageimportcvsexcel_map_col_metadesc'],
    'page_text' =>             $L['pageimportcvsexcel_map_col_text'],
    'page_parser' =>           $L['pageimportcvsexcel_map_col_parser'],
    'page_author' =>           $L['pageimportcvsexcel_map_col_author'],
    'page_ownerid' =>          $L['pageimportcvsexcel_map_col_ownerid'],
    'page_date' =>             $L['pageimportcvsexcel_map_col_date'],
    'page_begin' =>            $L['pageimportcvsexcel_map_col_begin'],
    'page_expire' =>           $L['pageimportcvsexcel_map_col_expire'],
    'page_updated' =>          $L['pageimportcvsexcel_map_col_updated'],
    'page_file' =>             $L['pageimportcvsexcel_map_col_file'],
    'page_url' =>              $L['pageimportcvsexcel_map_col_url'],
    'page_size' =>             $L['pageimportcvsexcel_map_col_size'],
    'page_count' =>            $L['pageimportcvsexcel_map_col_count'],
    'page_filecount' =>        $L['pageimportcvsexcel_map_col_filecount'],
];
// присваиваем шаблону имя части и/или локации расширения
$tpl_ExtCode          = 'pageimportcvsexcel';   // код плагина в составе имени шаблона
$tpl_PartExt          = 'tools';                 // говорим, что это админка плагина
$tpl_PartExtSecond    = false;                 // говорим, что не исползуем здесь

// Загружаем шаблон 
$extTplFile = cot_tplfile(
		[
		$tpl_ExtCode, 
		$tpl_PartExt, 
		$tpl_PartExtSecond
		], 
		'plug', 
		true
	);
// создаем объект шаблона
$t = new XTemplate($extTplFile);


$a = cot_import('a', 'G', 'TXT');
cot_pageimportcvsexcel_log("Запрос: m=" . cot_import('m', 'G', 'TXT') . ", p=" . cot_import('p', 'G', 'TXT') . ", a=" . ($a ?? 'пусто'));

if ($a === 'upload' && !empty($_FILES['excel_file']['tmp_name'])) {
    cot_pageimportcvsexcel_log("Начало загрузки файла");
    $fileTmpPath = (string) $_FILES['excel_file']['tmp_name'];
    $fileName = (string) $_FILES['excel_file']['name'];
    $filePath = $uploadDir . uniqid('excel_') . '_' . basename($fileName);
    
    if (move_uploaded_file($fileTmpPath, $filePath)) {
        $_SESSION['excel_file_path'] = $filePath;
        $_SESSION['excel_file_name'] = $fileName;
        $headers = cot_pageimportcvsexcel_get_headers($filePath, $fileName);
        if (is_array($headers)) {
            $_SESSION['excel_headers'] = $headers;
            cot_pageimportcvsexcel_log("Файл загружен успешно, путь: $filePath, заголовки: " . implode(', ', $headers));
        } else {
            cot_message("Ошибка при загрузке: $headers", 'error');
            unset($_SESSION['excel_file_path'], $_SESSION['excel_file_name'], $_SESSION['excel_headers']);
            if (file_exists($filePath)) unlink($filePath);
            cot_pageimportcvsexcel_log("Сессия очищена из-за ошибки, файл удалён: $filePath");
        }
    } else {
        cot_message("Ошибка: не удалось переместить файл.", 'error');
        cot_pageimportcvsexcel_log("Ошибка перемещения файла из $fileTmpPath в $filePath");
    }
    $redirectUrl = cot_url('admin', ['m' => 'other', 'p' => 'pageimportcvsexcel'], '', true);
    cot_pageimportcvsexcel_log("Редирект на: $redirectUrl");
    cot_redirect($redirectUrl);
} elseif ($a === 'import' && !empty($_POST['mapping'])) {
    cot_pageimportcvsexcel_log("Начало импорта");
    $mapping = (array) $_POST['mapping'];
    $validMapping = false;
    foreach ($mapping as $dbField => $excelHeader) {
        if ($excelHeader !== '0') {
            $validMapping = true;
            break;
        }
    }
    if (!$validMapping) {
        cot_message("Ошибка: маппинг не задан. Выберите хотя бы одно соответствие полей.", 'error');
        cot_pageimportcvsexcel_log("Ошибка: маппинг не задан");
    } else {
        $filePath = $_SESSION['excel_file_path'] ?? '';
        $fileName = $_SESSION['excel_file_name'] ?? '';
        if ($filePath && file_exists($filePath)) {
            $result = cot_pageimportcvsexcel_process($filePath, $mapping, $fileName);
            cot_message($result);
            unset($_SESSION['excel_file_path'], $_SESSION['excel_headers'], $_SESSION['excel_file_name']);
            if (file_exists($filePath)) unlink($filePath);
            cot_pageimportcvsexcel_log("Импорт завершён, сессия очищена, файл удалён: $filePath");
        } else {
            $error = "Ошибка: файл не найден для импорта.";
            cot_message($error, 'error');
            cot_pageimportcvsexcel_log($error . " Путь: $filePath");
        }
    }
    $redirectUrl = cot_url('admin', ['m' => 'other', 'p' => 'pageimportcvsexcel'], '', true);
    cot_pageimportcvsexcel_log("Редирект на: $redirectUrl");
    cot_redirect($redirectUrl);
} elseif ($a === 'reset') {
    $filePath = $_SESSION['excel_file_path'] ?? '';
    if ($filePath && file_exists($filePath)) unlink($filePath);
    unset($_SESSION['excel_file_path'], $_SESSION['excel_headers'], $_SESSION['excel_file_name']);
    cot_pageimportcvsexcel_log("Сессия сброшена вручную, файл удалён: $filePath");
    $redirectUrl = cot_url('admin', ['m' => 'other', 'p' => 'pageimportcvsexcel'], '', true);
    cot_pageimportcvsexcel_log("Редирект на: $redirectUrl");
    cot_redirect($redirectUrl);
}

$sessionHeaders = isset($_SESSION['excel_headers']) ? (is_array($_SESSION['excel_headers']) ? 'массив (' . count($_SESSION['excel_headers']) . ')' : 'строка: ' . $_SESSION['excel_headers']) : 'не задано';
cot_pageimportcvsexcel_log("Состояние сессии: headers=$sessionHeaders");

if (!isset($_SESSION['excel_headers']) || !is_array($_SESSION['excel_headers'])) {
    cot_pageimportcvsexcel_log("Показываем форму загрузки");
    $t->assign([
        'EXCELIMPORT_FORM_ACTION' => cot_url('admin', ['m' => 'other', 'p' => 'pageimportcvsexcel', 'a' => 'upload'], '', true),
        'EXCELIMPORT_FORM_ENCTYPE' => 'multipart/form-data',
        'EXCELIMPORT_MAX_ROWS' => $cfg['plugin']['pageimportcvsexcel']['max_rows'],
        'EXCELIMPORT_ALLOWED_FORMATS' => $cfg['plugin']['pageimportcvsexcel']['allowed_formats']
    ]);
    $t->parse('MAIN.UPLOAD');
    cot_pageimportcvsexcel_log("Форма загрузки отрендерена");
} else {
    cot_pageimportcvsexcel_log("Показываем форму маппинга");
    $headers = $_SESSION['excel_headers'];
    foreach ($pageFields as $field => $label) {
        $options = ['0' => $L['pageimportcvsexcel_map_col_will_not_import']];
        foreach ($headers as $header) {
            $options[$header] = $header;
        }
        $t->assign([
            'FIELD_NAME' => $field,
            'FIELD_LABEL' => $label,
            'FIELD_INPUT' => cot_selectbox('', "mapping[$field]", array_keys($options), array_values($options), false)
        ]);
        $t->parse('MAIN.MAPPING.FIELDS');
    }
    $t->assign([
        'EXCELIMPORT_MAPPING_ACTION' => cot_url('admin', ['m' => 'other', 'p' => 'pageimportcvsexcel', 'a' => 'import'], '', true),
        'EXCELIMPORT_PROGRESS_URL' => cot_url('admin', ['m' => 'other', 'p' => 'pageimportcvsexcel', 'a' => 'progress'], '', true),
        'EXCELIMPORT_HEADERS' => implode(', ', $headers),
        'EXCELIMPORT_RESET_URL' => cot_url('admin', ['m' => 'other', 'p' => 'pageimportcvsexcel', 'a' => 'reset'], '', true)
    ]);
    $t->parse('MAIN.MAPPING');
    cot_pageimportcvsexcel_log("Форма маппинга отрендерена");
}

cot_display_messages($t);
$t->parse('MAIN');
$pluginBody = $t->text('MAIN');

cot_pageimportcvsexcel_log("Отрендерено: " . (!empty($pluginBody) ? 'содержимое есть (' . strlen($pluginBody) . ' символов)' : 'пусто'));