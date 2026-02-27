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
$L['info_notes'] = 'Використовується бібліотека PhpSpreadsheet версії 1.23.0 без Composer. Протестовано на Cotonti 0.9.26+ під PHP 8.4';

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

$L['pageimportcvsexcel_map_col_will_not_import'] = 'Do not import this column';

$L['pageimportcvsexcel_map_col_id'] = '
<span class="badge rounded-pill bg-secondary bg-opacity-10">
<code class="text-muted">page_id</code></span>
<br>
<span class="text-muted fw-light small">ID (авто) НЕ ІМПОРТУВАТИ</span>
';

$L['pageimportcvsexcel_map_col_alias'] = '
<span class="badge rounded-pill bg-warning">
<code class="text-dark">page_alias</code></span>
<br>
<span class="fw-light small">(Аліас — псевдонім сторінки як частина повного URL)</span>
';

$L['pageimportcvsexcel_map_col_state'] = '
<span class="badge rounded-pill bg-warning">
<code class="text-dark">page_state</code></span>
<br>
<span class="fw-light small">Статус публікації: (0), (1), (2). Залишити порожнім — буде</span> <span class="text-muted">0</span> — <span class="fw-light small">опубліковано</span>.
';

$L['pageimportcvsexcel_map_col_cat'] = '
<span class="badge rounded-pill bg-danger bg-opacity-10 text-danger">
<code class="fs-6 m-0">page_cat</code></span>
<br>
<span class="text-danger">Код категорії</span>, наприклад <code>usersblog</code>.<br>
<span class="fw-light small">На вашому сайті вже обов’язково має існувати категорія з таким кодом.</span>
';

$L['pageimportcvsexcel_map_col_title'] = '
<span class="badge rounded-pill bg-danger bg-opacity-10 text-danger">
<code class="fs-6 m-0">page_title</code></span>
<br>
<span class="text-danger">Заголовок статті / сторінки.</span> <span class="fw-light small">Це основна назва, наприклад:</span> <span class="text-dark small">Чому континенти рухаються?</span>
';

$L['pageimportcvsexcel_map_col_desc'] = '
<span class="badge rounded-pill bg-primary bg-opacity-10">
<code class="text-primary">page_desc</code></span>
<br>
<span class="fw-light small">Короткий опис (анотація, вступна частина у списках)</span>
';

$L['pageimportcvsexcel_map_col_keywords'] = '
<span class="badge rounded-pill bg-secondary bg-opacity-10">
<code class="text-muted">page_keywords</code></span>
<br>
<span class="text-muted fw-light small">Ключові слова. Застаріле поле</span>
';

$L['pageimportcvsexcel_map_col_metatitle'] = '
<span class="badge rounded-pill bg-primary bg-opacity-10">
<code class="text-primary">page_metatitle</code></span>
<br>
<span class="fw-light small">Мета-заголовок (title для браузера / пошуку)</span>
';

$L['pageimportcvsexcel_map_col_metadesc'] = '
<span class="badge rounded-pill bg-primary bg-opacity-10">
<code class="text-primary">page_metadesc</code></span>
<br>
<span class="fw-light small">Мета-опис</span>
';

$L['pageimportcvsexcel_map_col_text'] = '
<span class="badge rounded-pill bg-danger bg-opacity-10 text-danger">
<code class="fs-6 m-0">page_text</code></span>
<br>
<span class="text-danger">Основний текст статті / вміст сторінки</span>
';

$L['pageimportcvsexcel_map_col_parser'] = '
<span class="badge rounded-pill bg-warning">
<code class="text-dark">page_parser</code></span>
<br>
<span class="fw-light small">Парсер / тип розмітки поля <code class="fs-6 m-0">page_text</code>. Залишити порожнім — буде</span> <span class="text-muted">HTML</span>
';

$L['pageimportcvsexcel_map_col_author'] = '
<span class="badge rounded-pill bg-secondary bg-opacity-10">
<code class="text-muted">page_author</code></span>
<br>
<span class="text-muted fw-light small">Автор статті, наприклад</span> <span class="text-muted small">Жуль Верн</span>
';

$L['pageimportcvsexcel_map_col_ownerid'] = '
<span class="badge rounded-pill bg-warning">
<code class="text-dark">page_ownerid</code></span>
<br>
<span class="fw-light small">ID власника (створювача) сторінки. Залишити порожнім — буде призначено 1 (зазвичай admin)</span>
';

$L['pageimportcvsexcel_map_col_date'] = '
<span class="badge rounded-pill bg-warning">
<code class="text-dark">page_date</code></span>
<br>
<span class="fw-light small">Дата створення сторінки (timestamp). Залишити порожнім — буде поточна дата</span>
';

$L['pageimportcvsexcel_map_col_begin'] = '
<span class="badge rounded-pill bg-secondary bg-opacity-10">
<code class="text-muted">page_begin</code></span>
<br>
<span class="text-muted fw-light small">Дата початку публікації (timestamp)</span>
';

$L['pageimportcvsexcel_map_col_expire'] = '
<span class="badge rounded-pill bg-secondary bg-opacity-10">
<code class="text-muted">page_expire</code></span>
<br>
<span class="text-muted fw-light small">Дата завершення / закінчення публікації (timestamp)</span>
';

$L['pageimportcvsexcel_map_col_updated'] = '
<span class="badge rounded-pill bg-info">
<code class="text-dark">page_updated</code></span>
<br>
<span class="text-secondary fw-light small">Дата останнього оновлення (timestamp)</span>
';

$L['pageimportcvsexcel_map_col_file'] = '
<span class="badge rounded-pill bg-secondary bg-opacity-10">
<code class="text-muted">page_file</code></span>
<br>
<span class="text-muted fw-light small">Прапорець наявності прикріпленого файлу</span>
';

$L['pageimportcvsexcel_map_col_url'] = '
<span class="badge rounded-pill bg-secondary bg-opacity-10">
<code class="text-muted">page_url</code></span>
<br>
<span class="text-muted fw-light small">Посилання на прикріплений файл</span>
';

$L['pageimportcvsexcel_map_col_size'] = '
<span class="badge rounded-pill bg-secondary bg-opacity-10">
<code class="text-muted">page_size</code></span>
<br>
<span class="text-muted fw-light small">Розмір файлу</span>
';

$L['pageimportcvsexcel_map_col_count'] = '
<span class="badge rounded-pill bg-info">
<code class="text-dark">page_count</code></span>
<br>
<span class="text-secondary fw-light small">Кількість переглядів сторінки</span>
';

$L['pageimportcvsexcel_map_col_filecount'] = '
<span class="badge rounded-pill bg-secondary bg-opacity-10">
<code class="text-muted">page_filecount</code></span>
<br>
<span class="text-muted fw-light small">Кількість прикріплених файлів</span>
';