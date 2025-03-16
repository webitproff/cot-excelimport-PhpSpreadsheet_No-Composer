<?php
/* ====================
[BEGIN_COT_EXT]
Code=excelimport
Name=Excel Import
Category=tools
Description=Plugin for importing data from Excel files into Cotonti using PhpSpreadsheet
Version=1.0.0
Date=2025-03-16
Author=cot_webitproff
Copyright=(c) 2025 cot_webitproff
Notes=BSD License
Auth_guests=R
Lock_guests=12345A
Auth_members=RW
Lock_members=
Requires_modules=page
Recommends_modules=page
[END_COT_EXT]

[BEGIN_COT_EXT_CONFIG]
import_table=01:string::pages:Target table for import (e.g., 'pages' for cot_pages)
max_rows=02:string::100:Maximum rows to import per file (0 for unlimited)
allowed_formats=03:string::xlsx,csv:Comma-separated list of allowed file formats
[END_COT_EXT_CONFIG]
==================== */

/**
 * Excel Import plugin for Cotonti
 *
 * @package ExcelImport
 * @copyright (c) 2025 cot_webitproff
 * @license BSD License
 */

defined('COT_CODE') or die('Wrong URL');