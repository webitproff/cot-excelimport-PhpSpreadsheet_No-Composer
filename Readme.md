<h1>Cotonti. Импорт из Excel через PhpSpreadsheet</h1>

<h2>Плагин импорта статей для всех сайтов на Cotonti.</h2>

<p>&nbsp;</p>

<h2>Важные технические замечания:</h2>

<p>1. Используется библиотека PhpSpreadsheet версии 1.23.0 без Composer.<br />
2. Тестировалось на сайте Cotonti 0.9.26 под версией PHP 8.2 - 8.4<br />
3. Библиотека PhpSpreadsheet не обновлять более поздними версиями, то есть версиями новее, чем 1.23.0, потому что дальше уже требует Composer.</p>

<h2><br />
Установка плагина.</h2>

<p>1. Папку &quot;excelimport&quot; закачать в папку с плагинами на сайте.<br />
2. Внутри дириктории плагина /public_html/plugins/excelimport на папки &quot;uploads&quot; и &quot;logs&quot; дайте права на запись 755 или 777 зависит от хостера.<br />
3. Идем в админку &quot;Управление сайтом / Расширения&quot; находим &quot;Импорт из Excel через PhpSpreadsheet&quot;, заходим в карточку плагина и жмем &quot;Установить&quot;.<br />
4. Жмем кнопку &quot;Конфигурация&quot; - можете отрегулировать количество строк для импорта за раз.<br />
5. Если префикс вашей БД есть &quot;cot_&quot; - ничего не меняем. С другими префиксами БД я сам плагин не тестировал еще.</p>

<h2>Работа с импортом.</h2>

<p>1. Заходим в карточку расширения &quot;excelimport&quot; и жмем &quot;Администрирование&quot;.</p>

<p>2. Жмем кнопку &quot;Выбрать файл&quot; и выбираете на компьютере свой файл xlsx или тот, что прикреплен как образец, - import_to_pages_2025_16-03.xlsx, а затем&nbsp; &quot;Загрузить файл&quot; / &quot;Загрузить новый файл&quot;.</p>

<p>3. После загрузки файла, вы увидите заголовки полей(колонок) таблицы из вашего Excel. Разумеется, при создании своего файла для импорта, кириллицу использовать в заголовках не рекомендуется.</p>

<p>4. Ниже таблица сопоставления полей в БД и полей в вашем файле импорта.<br />
&nbsp;&nbsp;&nbsp; Пусть не пугает написание и название полей слева, например &quot;Alias&quot;, &quot;Meta Description&quot; в коде плагина все они корректно прописанны, <strong>как пример</strong>:</p>

<pre class="brush:php;">
    &#39;page_alias&#39; =&gt; &#39;Alias&#39;,
    &#39;page_state&#39; =&gt; &#39;State&#39;,
    &#39;page_cat&#39; =&gt; &#39;Category&#39;,
    &#39;page_title&#39; =&gt; &#39;Title&#39;,
    &#39;page_desc&#39; =&gt; &#39;Description&#39;,
    &#39;page_keywords&#39; =&gt; &#39;Keywords&#39;,
    &#39;page_metatitle&#39; =&gt; &#39;Meta Title&#39;,
    &#39;page_metadesc&#39; =&gt; &#39;Meta Description&#39;,</pre>

<p><br />
&nbsp;&nbsp; &nbsp;<br />
5. В колонке справа, в каждой строке (не все поля обязательны) прописываем название колонки из таблицы вашего Excel, где название этой колонки должно соответствовать полю в БД таблицы модуля статей &quot;cot_pages&quot;.</p>

<p>Например:</p>

<p>5.1. Слева у вас &quot;Alias&quot; - это означает справа в таблице должен быть прописан заголовок таблицы из Excel, в котором находятся псевдонимы вашей статьи (в прилагаемом к плагину файлу import_to_pages_2025_16-03.xlsx псевдонимы/алиасы лежат в колонке под названием &quot;page_alias&quot;).</p>

<p>5.2. Слева у вас &quot;Title&quot; - это означает справа в таблице должен быть прописан заголовок таблицы из Excel, в котором находятся названия статей. (в прилагаемом к плагину файлу import_to_pages_2025_16-03.xlsx названия статей лежат в колонке под названием &quot;page_title&quot;).</p>

<p>и так далее.</p>

<p>6. Критически важное замечание!<br />
Плагин не умеет создавать категории. Поэтому оставьте пустым поле справа напротив поля &quot;Category&quot;, которое слева.<br />
По умолчанию, если категория не указана, - статьи импортируются в категорию статей &quot;news&quot;.<br />
Перед убедитесь, что в структуре Управление сайтом / Расширения / Pages / Структура у вас есть раздел с кодом &quot;news&quot;.<br />
Можно ее создать, если ее нет, или поле таблицы с кодом категории в вашем файле эксель привести в точное соответствие со структурой модуля &quot;Pages&quot;, для каждой статьи в вашем файле импорта.</p>

<p>7. Все поля (важные и обязательные) заполнили, - внизу кнопка &quot;Импортировать&quot;.</p>

<p>Проверил сам не однократно - плагин импорта работает.<br />
Смотрите скриншоты в теме поддержки по ссылке ниже.</p>

<p>Скачать бесплатно плагин<a href="https://github.com/webitproff/cot-excelimport-PhpSpreadsheet_No-Composer"><strong> &quot;Импорт из Excel через PhpSpreadsheet&quot;</strong></a>.</p>

<p><a href="https://abuyfile.com/ru/forums/cotonti/custom/plugs/topic123"><strong>Тема поддержки на форуме.</strong></a></p>

Если вас интересует [плагин ЭКСПОРТА данных в Excel](https://github.com/webitproff/cot-excel_export) через PhpSpreadsheet

<hr />

<h1>Cotonti. Import from Excel via PhpSpreadsheet</h1>

<p>A plugin for importing articles for all Cotonti-based websites.</p>

<h2>Important Technical Notes:</h2>

<p>&nbsp;&nbsp;&nbsp; Uses the PhpSpreadsheet library version 1.23.0 without Composer.<br />
&nbsp;&nbsp;&nbsp; Tested on a Cotonti 0.9.26 website running PHP 8.2.<br />
&nbsp;&nbsp;&nbsp; Do not update the PhpSpreadsheet library to versions newer than 1.23.0, as later versions require Composer.</p>

<h2>Plugin Installation:</h2>

<p>&nbsp;&nbsp;&nbsp; Upload the &quot;excelimport&quot; folder to the plugins directory on your website.<br />
&nbsp;&nbsp;&nbsp; Inside the plugin directory /public_html/plugins/excelimport, set write permissions (755 or 777, depending on your hosting provider) for the &quot;uploads&quot; and &quot;logs&quot; folders.<br />
&nbsp;&nbsp;&nbsp; Go to the admin panel: &quot;Site Management / Extensions,&quot; find &quot;Import from Excel via PhpSpreadsheet,&quot; open the plugin card, and click &quot;Install.&quot;<br />
&nbsp;&nbsp;&nbsp; Click the &quot;Configuration&quot; button&mdash;you can adjust the number of rows to import at once.<br />
&nbsp;&nbsp;&nbsp; If your database prefix is &quot;cot_&quot;, no changes are needed. I haven&rsquo;t tested the plugin with other database prefixes yet.</p>

<h2>Working with the Import:</h2>

<p>&nbsp;&nbsp;&nbsp; Go to the &quot;excelimport&quot; extension card and click &quot;Administration.&quot;</p>

<p>&nbsp;&nbsp;&nbsp; Click the &quot;Select File&quot; button and choose your .xlsx file from your computer (or use the sample file attached&mdash;import_to_pages_2025_16-03.xlsx), then click &quot;Upload File&quot; / &quot;Upload New File.&quot;</p>

<p>&nbsp;&nbsp;&nbsp; After uploading the file, you&rsquo;ll see the headers of the table columns from your Excel file. Naturally, when creating your own import file, it&rsquo;s recommended to avoid using Cyrillic characters in the headers.</p>

<p>&nbsp;&nbsp;&nbsp; Below is a field mapping table for the database fields and the fields in your import file.</p>

<p>&nbsp;&nbsp;&nbsp; Don&rsquo;t be alarmed by the naming of the fields on the left, such as &quot;Alias&quot; or &quot;Meta Description&quot;&mdash;in the plugin code, they are all correctly defined, for example:<br />
&nbsp;&nbsp;&nbsp; php</p>

<pre class="brush:php;">
    &#39;page_alias&#39; =&gt; &#39;Alias&#39;,
    &#39;page_state&#39; =&gt; &#39;State&#39;,
    &#39;page_cat&#39; =&gt; &#39;Category&#39;,
    &#39;page_title&#39; =&gt; &#39;Title&#39;,
    &#39;page_desc&#39; =&gt; &#39;Description&#39;,
    &#39;page_keywords&#39; =&gt; &#39;Keywords&#39;,
    &#39;page_metatitle&#39; =&gt; &#39;Meta Title&#39;,
    &#39;page_metadesc&#39; =&gt; &#39;Meta Description&#39;,</pre>

<p>&nbsp;&nbsp;&nbsp; In the right column, for each row (not all fields are mandatory), enter the column header from your Excel table that corresponds to the database field in the &quot;cot_pages&quot; articles module.</p>

<p>For example:</p>

<p>5.1. On the left, you have &quot;Alias&quot;&mdash;this means that in the right column, you should enter the header from your Excel table that contains the aliases for your articles (in the sample file import_to_pages_2025_16-03.xlsx attached to the plugin, aliases are in the column titled &quot;page_alias&quot;).</p>

<p>5.2. On the left, you have &quot;Title&quot;&mdash;this means that in the right column, you should enter the header from your Excel table that contains the article titles (in the sample file import_to_pages_2025_16-03.xlsx, article titles are in the column titled &quot;page_title&quot;).</p>

<p>And so on.</p>

<p>&nbsp;&nbsp;&nbsp; Critically Important Note!<br />
&nbsp;&nbsp;&nbsp; The plugin does not create categories. Therefore, leave the right field empty next to the &quot;Category&quot; field on the left.<br />
&nbsp;&nbsp;&nbsp; By default, if no category is specified, articles are imported into the &quot;news&quot; category.<br />
&nbsp;&nbsp;&nbsp; Before proceeding, ensure that in &quot;Site Management / Extensions / Pages / Structure,&quot; you have a section with the code &quot;news.&quot;<br />
&nbsp;&nbsp;&nbsp; You can create it if it doesn&rsquo;t exist, or adjust the category code field in your Excel file to exactly match the structure of the &quot;Pages&quot; module for each article in your import file.<br />
&nbsp;&nbsp;&nbsp; Once all important and required fields are filled in, click the &quot;Import&quot; button at the bottom.</p>

<p>I&rsquo;ve tested it multiple times myself&mdash;the import plugin works.<br />
Download the <a href="https://github.com/webitproff/cot-excelimport-PhpSpreadsheet_No-Composer"><strong>&quot;Import from Excel via PhpSpreadsheet&quot;</strong></a> plugin for free.</p>

<p><a href="https://abuyfile.com/ru/forums/cotonti/custom/plugs/topic123"><strong>Support thread on the forum</strong></a>.</p>

<p>&nbsp;</p>
