<?php
/**
 * Page Module articles Import from CSV/Excel
 * Plugin pageimportcvsexcel for Cotonti 0.9.26, PHP 8.4+ 
 * Filename: pageimportcvsexcel.ru.lang.php
 * Purpose: Russian Language strings for pageimportcvsexcel
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

/**
 * Plugin Config
 */
$L['cfg_import_table'] = 'Целевая таблица';
$L['cfg_import_table_hint'] = 'Нужно указать <code>pages</code> для импорта данных например, в cot_pages';
$L['cfg_max_rows'] = 'Максимум строк';
$L['cfg_max_rows_hint'] = 'Максимальное число строк для импорта (0 — без ограничений)';
$L['cfg_allowed_formats'] = 'Разрешённые форматы';
$L['cfg_allowed_formats_hint'] = 'Список форматов файлов через запятую (например, xlsx,csv)';

/**
 * Plugin Info
 */
$L['info_title'] = 'Page Module articles CSV/Excel Import';
$L['info_desc'] = 'Инструмент для импорта данных из CSV/Excel';
$L['info_notes'] = '<a href="https://t.me/aBuyFILE/185" target="_blank"><strong>Video in Telegram</strong></a> | <a href="https://www.youtube.com/watch?v=tisRJEZcQa4" target="_blank"><strong>Video in YouTube</strong></a> Тестировалось на сайте Cotonti 0.9.26+ под версией PHP 8.4';
/**
 * Plugin Admin
 */
$L['pageimportcvsexcel_adminTitle'] = 'Page Module articles CSV/Excel Import';
$L['pageimportcvsexcel_adminHelp'] = '<a href="https://abuyfile.com/ru/forums/cotonti/custom/plugs/topic123" target="_blank"><strong>Help & Support for using this Plugin</strong></a>';

/**
 * Plugin Title & Subtitle
 */
$L['pageimportcvsexcel_title'] = 'Page Module articles CSV/Excel Import';
$L['pageimportcvsexcel_subtitle'] = 'Инструмент для импорта товаров из Excel-файлов в Page Module articles';

/**
 * Plugin Body
 */

$L['pageimportcvsexcel_form_mapping'] = 'Форма маппинга';
$L['pageimportcvsexcel_form_upload'] = 'Форма загрузки';
$L['pageimportcvsexcel_upload'] = 'Загрузить файл';
$L['pageimportcvsexcel_import'] = 'Начать импорт';
$L['pageimportcvsexcel_progress'] = 'Прогресс импорта';
$L['pageimportcvsexcel_select_file'] = 'Выберите файл';
$L['pageimportcvsexcel_max_rows_label'] = 'Максимальное количество строк';
$L['pageimportcvsexcel_allowed_formats_label'] = 'Допустимые форматы';
$L['pageimportcvsexcel_upload'] = 'Загрузить файл';
$L['pageimportcvsexcel_headers'] = 'Полученные заголовки полей из вашей таблицы импорта';
$L['pageimportcvsexcel_field_table'] = 'Поле в базе данных';
$L['pageimportcvsexcel_field_excel'] = 'Поле в Excel';
$L['pageimportcvsexcel_import'] = 'Импортировать';
$L['pageimportcvsexcel_reset'] = 'Загрузить новый файл'; 
