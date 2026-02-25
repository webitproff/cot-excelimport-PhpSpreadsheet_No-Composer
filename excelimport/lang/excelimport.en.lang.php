<?php
/**
 * Page Module articles Import from CSV/Excel
 * Plugin pageimportcvsexcel for Cotonti 0.9.26, PHP 8.4+ 
 * Filename: pageimportcvsexcel.en.lang.php
 * Purpose: English localization strings for pageimportcvsexcel
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
$L['cfg_import_table'] = 'Target table';
$L['cfg_import_table_hint'] = 'You must specify <code>pages</code> to import data, for example, into cot_pages';
$L['cfg_max_rows'] = 'Maximum rows';
$L['cfg_max_rows_hint'] = 'Maximum number of rows to import (0 — no limit)';
$L['cfg_allowed_formats'] = 'Allowed formats';
$L['cfg_allowed_formats_hint'] = 'Comma-separated list of file formats (e.g., xlsx,csv)';

/**
 * Plugin Info
 */
$L['info_title'] = 'Page Module articles CSV/Excel Import';
$L['info_desc'] = 'Tool for importing data from CSV/Excel files';
$L['info_notes'] = '<a href="https://t.me/aBuyFILE/185" target="_blank"><strong>Video in Telegram</strong></a> | <a href="https://www.youtube.com/watch?v=tisRJEZcQa4" target="_blank"><strong>Video in YouTube</strong></a>  Tested on Cotonti 0.9.26+ with PHP 8.4';

/**
 * Plugin Admin
 */
$L['pageimportcvsexcel_adminTitle'] = 'Page Module articles CSV/Excel Import';
$L['pageimportcvsexcel_adminHelp'] = '<a href="https://abuyfile.com/ru/forums/cotonti/custom/plugs/topic123" target="_blank"><strong>Help & Support for using this Plugin</strong></a>';

/**
 * Plugin Title & Subtitle
 */
$L['pageimportcvsexcel_title'] = 'Page Module articles CSV/Excel Import';
$L['pageimportcvsexcel_subtitle'] = 'Tool for importing products from Excel files into Page Module articles';

/**
 * Plugin Body
 */
$L['pageimportcvsexcel_form_mapping'] = 'Mapping form';
$L['pageimportcvsexcel_form_upload'] = 'Upload form';
$L['pageimportcvsexcel_upload'] = 'Upload file';
$L['pageimportcvsexcel_import'] = 'Start import';
$L['pageimportcvsexcel_progress'] = 'Import progress';
$L['pageimportcvsexcel_select_file'] = 'Select file';
$L['pageimportcvsexcel_max_rows_label'] = 'Maximum number of rows';
$L['pageimportcvsexcel_allowed_formats_label'] = 'Allowed formats';
$L['pageimportcvsexcel_headers'] = 'Detected column headers from your import table';
$L['pageimportcvsexcel_field_table'] = 'Database field';
$L['pageimportcvsexcel_field_excel'] = 'Excel field';
$L['pageimportcvsexcel_import'] = 'Import';
$L['pageimportcvsexcel_reset'] = 'Upload a new file';
