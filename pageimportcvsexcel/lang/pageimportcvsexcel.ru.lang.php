<?php
/**
 * Page Module articles Import from CSV/Excel
 * Plugin pageimportcvsexcel for Cotonti 0.9.26, PHP 8.4+ 
 * Filename: pageimportcvsexcel.ru.lang.php
 * Purpose: Russian Language strings for pageimportcvsexcel
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
$L['info_notes'] = ''<a href="https://abuyfile.com/ru/forums/cotonti/custom/plugs/topic123" target="_blank"><strong>Инструкции, помощь и поддержка</strong></a>. Тестировалось на сайте Cotonti 0.9.26+ под версией PHP 8.4';
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

$L['pageimportcvsexcel_map_col_will_not_import'] = 'Не включать в импорт';

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
<span class="fw-light small">(Алиас - псевдоним страницы как компонент для полного URL страницы)</span>
';

$L['pageimportcvsexcel_map_col_state'] = '
<span class="badge rounded-pill bg-warning">
<code class="text-dark">page_state</code></span>
<br>
<span class="fw-light small">Статус публикации (0), (1), (2). оставить пустым - будет</span> <span class="text-muted">0</span> - <span class="fw-light small">опубликовано</span>.
';

$L['pageimportcvsexcel_map_col_cat'] = '<span class="badge rounded-pill bg-danger bg-opacity-10 text-danger "><code class="fs-6 m-0">page_cat</code></span><br><span class="text-danger">Категория</span>structurecode usersblog';

$L['pageimportcvsexcel_map_col_cat'] = '
<span class="badge rounded-pill bg-danger bg-opacity-10 text-danger">
<code class="fs-6 m-0">page_cat</code></span>
<br>
<span class="text-danger">Код категории</span>, например <code>usersblog</code></span>. <span class="fw-light small">у вас на сайте уже обязательно должна быть категория с таким кодом.</span>  
';

$L['pageimportcvsexcel_map_col_title'] = '
<span class="badge rounded-pill bg-danger bg-opacity-10 text-danger">
<code class="fs-6 m-0">page_title</code></span>
<br>
<span class="text-danger">Заголовок статьи.</span> <span class="fw-light small">Он же и есть название статьи, например:</span> <span class="text-dark small">Почему континенты движутся?</span> 
';

$L['pageimportcvsexcel_map_col_desc'] = '
<span class="badge rounded-pill bg-primary bg-opacity-10">
<code class="text-primary">page_desc</code></span>
<br>
<span class="fw-light small">Краткое описание (вступительная часть в списках)</span>
';

$L['pageimportcvsexcel_map_col_keywords'] = '
<span class="badge rounded-pill bg-secondary bg-opacity-10">
<code class="text-muted">page_keywords</code></span>
<br>
<span class="text-muted fw-light small">ключевые слова. пережиток прошлого</span>
';

$L['pageimportcvsexcel_map_col_metatitle'] = '
<span class="badge rounded-pill bg-primary bg-opacity-10">
<code class="text-primary">page_metatitle</code></span>
<br>
<span class="fw-light small">Мета Заголовок</span>
';

$L['pageimportcvsexcel_map_col_metadesc'] = '
<span class="badge rounded-pill bg-primary bg-opacity-10">
<code class="text-primary">page_metadesc</code></span>
<br>
<span class="fw-light small">Мета описание</span>
';

$L['pageimportcvsexcel_map_col_text'] = '<span class="badge rounded-pill bg-danger bg-opacity-10 text-danger "><code class="fs-6 m-0">page_text</code></span><br><span class="text-danger">Текст. Основное содержание статьи</span>';

$L['pageimportcvsexcel_map_col_parser'] = '
<span class="badge rounded-pill bg-warning">
<code class="text-dark">page_parser</code></span>
<br>
<span class="fw-light small">Парсер, разметка содержания <code class="fs-6 m-0">page_text</code>, если сама разметка есть. оставить пустым - будет</span> <span class="text-muted">HTML</span>
';

$L['pageimportcvsexcel_map_col_author'] = '
<span class="badge rounded-pill bg-secondary bg-opacity-10">
<code class="text-muted">page_author</code></span>
<br>
<span class="text-muted fw-light small">Автор статьи, например </span> <span class="text-muted small">Жюль Верн</span>
';

$L['pageimportcvsexcel_map_col_ownerid'] = '
<span class="badge rounded-pill bg-warning">
<code class="text-dark">page_ownerid</code></span>
<br>
<span class="fw-light small">ID владельца (создателя) статьи. оставить пустым - будет присвоен номер 1 (обычно админ)</span>
';

$L['pageimportcvsexcel_map_col_date'] = '
<span class="badge rounded-pill bg-warning">
<code class="text-dark">page_date</code></span>
<br>
<span class="fw-light small">Штамп Даты создания страницы. оставить пустым - будет текущая</span>
';

$L['pageimportcvsexcel_map_col_begin'] = '
<span class="badge rounded-pill bg-secondary bg-opacity-10">
<code class="text-muted">page_begin</code></span>
<br>
<span class="text-muted fw-light small">Штамп даты начала публикации</span>
';

$L['pageimportcvsexcel_map_col_expire'] = '
<span class="badge rounded-pill bg-secondary bg-opacity-10">
<code class="text-muted">page_expire</code></span>
<br>
<span class="text-muted fw-light small">Штамп даты завершения публикации</span>
';

$L['pageimportcvsexcel_map_col_updated'] = '
<span class="badge rounded-pill bg-info">
<code class="text-dark">page_updated</code></span>
<br>
<span class="text-secondary fw-light small">Штамп даты обновления</span>
';

$L['pageimportcvsexcel_map_col_file'] = '
<span class="badge rounded-pill bg-secondary bg-opacity-10">
<code class="text-muted">page_file</code></span>
<br>
<span class="text-muted fw-light small">Флаг наличия файла</span>
';

$L['pageimportcvsexcel_map_col_url'] = '
<span class="badge rounded-pill bg-secondary bg-opacity-10">
<code class="text-muted">page_url</code></span>
<br>
<span class="text-muted fw-light small">Ссылка на прикрепленный файл</span>
';

$L['pageimportcvsexcel_map_col_size'] = '
<span class="badge rounded-pill bg-secondary bg-opacity-10">
<code class="text-muted">page_size</code></span>
<br>
<span class="text-muted fw-light small">size</span>
';

$L['pageimportcvsexcel_map_col_count'] = '
<span class="badge rounded-pill bg-info">
<code class="text-dark">page_count</code></span>
<br>
<span class="text-secondary fw-light small">Просмотры страницы (число)</span>
';

$L['pageimportcvsexcel_map_col_filecount'] = '
<span class="badge rounded-pill bg-secondary bg-opacity-10">
<code class="text-muted">page_filecount</code></span>
<br>
<span class="text-muted fw-light small">File Count</span>
';



