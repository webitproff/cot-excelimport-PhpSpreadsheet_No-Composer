<?php
/**
 * Page Module articles Import from CSV/Excel
 * Plugin pageimportcvsexcel for Cotonti 0.9.26, PHP 8.4+ 
 * Filename: pageimportcvsexcel.en.lang.php
 * Purpose: English localization strings for pageimportcvsexcel
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
$L['info_notes'] = '<a href="https://abuyfile.com/ru/forums/cotonti/custom/plugs/topic123" target="_blank"><strong>Help & Support for using this Plugin</strong></a>. Tested on Cotonti 0.9.26+ with PHP 8.4';

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

$L['pageimportcvsexcel_map_col_will_not_import'] = 'Do not import this column';

$L['pageimportcvsexcel_map_col_id'] = '
<span class="badge rounded-pill bg-secondary bg-opacity-10">
<code class="text-muted">page_id</code></span>
<br>
<span class="text-muted fw-light small">ID (auto) DO NOT IMPORT</span>
';

$L['pageimportcvsexcel_map_col_alias'] = '
<span class="badge rounded-pill bg-warning">
<code class="text-dark">page_alias</code></span>
<br>
<span class="fw-light small">(Alias — page slug used as part of the full page URL)</span>
';

$L['pageimportcvsexcel_map_col_state'] = '
<span class="badge rounded-pill bg-warning">
<code class="text-dark">page_state</code></span>
<br>
<span class="fw-light small">Publication status: (0), (1), (2). Leave empty — will be set to</span> <span class="text-muted">0</span> — <span class="fw-light small">published</span>.
';

$L['pageimportcvsexcel_map_col_cat'] = '
<span class="badge rounded-pill bg-danger bg-opacity-10 text-danger">
<code class="fs-6 m-0">page_cat</code></span>
<br>
<span class="text-danger">Category code</span>, e.g. <code>usersblog</code>.<br>
<span class="fw-light small">A category with this exact code must already exist on your site.</span>
';

$L['pageimportcvsexcel_map_col_title'] = '
<span class="badge rounded-pill bg-danger bg-opacity-10 text-danger">
<code class="fs-6 m-0">page_title</code></span>
<br>
<span class="text-danger">Article title / Page heading.</span> <span class="fw-light small">This is the main title of the page, for example:</span> <span class="text-dark small">Why Do Continents Move?</span>
';

$L['pageimportcvsexcel_map_col_desc'] = '
<span class="badge rounded-pill bg-primary bg-opacity-10">
<code class="text-primary">page_desc</code></span>
<br>
<span class="fw-light small">Short description (lead / excerpt shown in lists)</span>
';

$L['pageimportcvsexcel_map_col_keywords'] = '
<span class="badge rounded-pill bg-secondary bg-opacity-10">
<code class="text-muted">page_keywords</code></span>
<br>
<span class="text-muted fw-light small">Keywords. Mostly a legacy field nowadays.</span>
';

$L['pageimportcvsexcel_map_col_metatitle'] = '
<span class="badge rounded-pill bg-primary bg-opacity-10">
<code class="text-primary">page_metatitle</code></span>
<br>
<span class="fw-light small">Meta Title (browser tab / search result title)</span>
';

$L['pageimportcvsexcel_map_col_metadesc'] = '
<span class="badge rounded-pill bg-primary bg-opacity-10">
<code class="text-primary">page_metadesc</code></span>
<br>
<span class="fw-light small">Meta Description</span>
';

$L['pageimportcvsexcel_map_col_text'] = '
<span class="badge rounded-pill bg-danger bg-opacity-10 text-danger">
<code class="fs-6 m-0">page_text</code></span>
<br>
<span class="text-danger">Main content / article body text</span>
';

$L['pageimportcvsexcel_map_col_parser'] = '
<span class="badge rounded-pill bg-warning">
<code class="text-dark">page_parser</code></span>
<br>
<span class="fw-light small">Parser / markup type of the <code class="fs-6 m-0">page_text</code> field. Leave empty — will default to</span> <span class="text-muted">HTML</span>
';

$L['pageimportcvsexcel_map_col_author'] = '
<span class="badge rounded-pill bg-secondary bg-opacity-10">
<code class="text-muted">page_author</code></span>
<br>
<span class="text-muted fw-light small">Author name, e.g.</span> <span class="text-muted small">Jules Verne</span>
';

$L['pageimportcvsexcel_map_col_ownerid'] = '
<span class="badge rounded-pill bg-warning">
<code class="text-dark">page_ownerid</code></span>
<br>
<span class="fw-light small">Owner / creator user ID. Leave empty — will be assigned 1 (usually admin)</span>
';

$L['pageimportcvsexcel_map_col_date'] = '
<span class="badge rounded-pill bg-warning">
<code class="text-dark">page_date</code></span>
<br>
<span class="fw-light small">Page creation date timestamp. Leave empty — current date/time will be used</span>
';

$L['pageimportcvsexcel_map_col_begin'] = '
<span class="badge rounded-pill bg-secondary bg-opacity-10">
<code class="text-muted">page_begin</code></span>
<br>
<span class="text-muted fw-light small">Publication start date timestamp</span>
';

$L['pageimportcvsexcel_map_col_expire'] = '
<span class="badge rounded-pill bg-secondary bg-opacity-10">
<code class="text-muted">page_expire</code></span>
<br>
<span class="text-muted fw-light small">Publication end / expiration date timestamp</span>
';

$L['pageimportcvsexcel_map_col_updated'] = '
<span class="badge rounded-pill bg-info">
<code class="text-dark">page_updated</code></span>
<br>
<span class="text-secondary fw-light small">Last update timestamp</span>
';

$L['pageimportcvsexcel_map_col_file'] = '
<span class="badge rounded-pill bg-secondary bg-opacity-10">
<code class="text-muted">page_file</code></span>
<br>
<span class="text-muted fw-light small">File attachment flag</span>
';

$L['pageimportcvsexcel_map_col_url'] = '
<span class="badge rounded-pill bg-secondary bg-opacity-10">
<code class="text-muted">page_url</code></span>
<br>
<span class="text-muted fw-light small">URL of the attached file</span>
';

$L['pageimportcvsexcel_map_col_size'] = '
<span class="badge rounded-pill bg-secondary bg-opacity-10">
<code class="text-muted">page_size</code></span>
<br>
<span class="text-muted fw-light small">File size</span>
';

$L['pageimportcvsexcel_map_col_count'] = '
<span class="badge rounded-pill bg-info">
<code class="text-dark">page_count</code></span>
<br>
<span class="text-secondary fw-light small">Page view counter (number of views)</span>
';

$L['pageimportcvsexcel_map_col_filecount'] = '
<span class="badge rounded-pill bg-secondary bg-opacity-10">
<code class="text-muted">page_filecount</code></span>
<br>
<span class="text-muted fw-light small">Number of attached files</span>

';
