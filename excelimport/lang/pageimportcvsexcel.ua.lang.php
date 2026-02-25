<?php

/**
 * Page Module articles Import from CSV/Excel
 * Plugin pageimportcvsexcel for Cotonti 0.9.26, PHP 8.4+ 
 * Filename: pageimportcvsexcel.ua.lang.php
 * Purpose: Ukrainian language localization stringsfor pageimportcvsexcel
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
$L['cfg_import_table'] = 'Цільова таблиця';
$L['cfg_import_table_hint'] = 'Потрібно вказати <code>pages</code> для імпорту даних, наприклад, у cot_pages';
$L['cfg_max_rows'] = 'Максимальна кількість рядків';
$L['cfg_max_rows_hint'] = 'Максимальна кількість рядків для імпорту (0 — без обмежень)';
$L['cfg_allowed_formats'] = 'Дозволені формати';
$L['cfg_allowed_formats_hint'] = 'Список форматів файлів через кому (наприклад, xlsx,csv)';

/**
 * Plugin Info
 */
$L['info_title'] = 'Page Module articles CSV/Excel Import';
$L['info_desc'] = 'Інструмент для імпорту даних із CSV/Excel файлів';
$L['info_notes'] = '<a href="https://t.me/aBuyFILE/185" target="_blank"><strong>Video in Telegram</strong></a> | <a href="https://www.youtube.com/watch?v=tisRJEZcQa4" target="_blank"><strong>Video in YouTube</strong></a> Протестовано на Cotonti 0.9.26+ під PHP 8.4';

/**
 * Plugin Admin
 */
$L['pageimportcvsexcel_adminTitle'] = 'Page Module articles CSV/Excel Import';
$L['pageimportcvsexcel_adminHelp'] = '<a href="https://abuyfile.com/ru/forums/cotonti/custom/plugs/topic123" target="_blank"><strong>Help & Support for using this Plugin</strong></a>';

/**
 * Plugin Title & Subtitle
 */
$L['pageimportcvsexcel_title'] = 'Page Module articles CSV/Excel Import';
$L['pageimportcvsexcel_subtitle'] = 'Інструмент для імпорту товарів з Excel-файлів у Page Module articles';

/**
 * Plugin Body
 */
$L['pageimportcvsexcel_form_mapping'] = 'Форма мапінгу';
$L['pageimportcvsexcel_form_upload'] = 'Форма завантаження';
$L['pageimportcvsexcel_upload'] = 'Завантажити файл';
$L['pageimportcvsexcel_import'] = 'Розпочати імпорт';
$L['pageimportcvsexcel_progress'] = 'Прогрес імпорту';
$L['pageimportcvsexcel_select_file'] = 'Виберіть файл';
$L['pageimportcvsexcel_max_rows_label'] = 'Максимальна кількість рядків';
$L['pageimportcvsexcel_allowed_formats_label'] = 'Допустимі формати';
$L['pageimportcvsexcel_headers'] = 'Виявлені заголовки колонок з вашої таблиці імпорту';
$L['pageimportcvsexcel_field_table'] = 'Поле бази даних';
$L['pageimportcvsexcel_field_excel'] = 'Поле Excel';
$L['pageimportcvsexcel_import'] = 'Імпортувати';
$L['pageimportcvsexcel_reset'] = 'Завантажити новий файл';
