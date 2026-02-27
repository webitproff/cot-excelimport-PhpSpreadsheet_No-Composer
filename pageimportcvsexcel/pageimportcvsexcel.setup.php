<?php
/* ====================
[BEGIN_COT_EXT]
Code=pageimportcvsexcel
Name=Page Module articles Import from CSV/Excel
Category=tools
Description=Plugin for importing data to Page Module from Excel files into Cotonti using PhpSpreadsheet
Version=2.0.1
Date=Feb 25Th, 2026
Author=webitproff
Copyright=(c) webitproff 2026 | https://github.com/webitproff
Notes=
Auth_guests=R
Lock_guests=12345A
Auth_members=RW
Lock_members=
Requires_modules=page
Recommends_modules=
[END_COT_EXT]

[BEGIN_COT_EXT_CONFIG]
import_table=01:string::pages:Target table for import (e.g., 'pages' for cot_pages)
max_rows=02:string::300:Maximum rows to import per file (0 for unlimited)
allowed_formats=03:string::xlsx,csv:Comma-separated list of allowed file formats
use_function_strip_links=04:radio::0:Использовать функцию для вырезания ссылок в тексте файла импорта
use_function_log=05:radio::0:Использовать функцию логирования при импорте
[END_COT_EXT_CONFIG]
==================== */

/**
 * Page Module articles Import from CSV/Excel
 * Plugin pageimportcvsexcel for Cotonti 0.9.26, PHP 8.4+
 * Filename: pageimportcvsexcel.setup.php
 * Purpose: Setup & Config File. Register data in $db_core, $db_auth and $db_config for the Plugin pageimportcvsexcel
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

