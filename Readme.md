Cotonti. Импорт из Excel через PhpSpreadsheet

Плагин импорта статей для всех сайтов на Cotonti.

Важные технические замечания:

1. Используется библиотека PhpSpreadsheet версии 1.23.0 без Composer. 
2. Тестировалось на сайте Cotonti 0.9.26 под версией PHP 8.2
3. Библиотека PhpSpreadsheet не обновлять более поздними версиями, то есть версиями новее, чем 1.23.0, потому что дальше уже требует Composer. 


Установка плагина.

1. Папку "excelimport" закачать в папку с плагинами на сайте.
2. Внутри дириктории плагина /public_html/plugins/excelimport на папки "uploads" и "logs" дайте права на запись 755 или 777 зависит от хостера.
3. Идем в админку "Управление сайтом / Расширения" находим "Импорт из Excel через PhpSpreadsheet", заходим в карточку плагина и жмем "Установить".
4. Жмем кнопку "Конфигурация" - можете отрегулировать количество строк для импорта за раз. 
5. Если префикс вашей БД есть "cot_" - ничего не меняем. С другими префиксами БД я сам плагин не тестировал еще.

Работа с импортом.

1. Заходим в карточку расширения "excelimport" и жмем "Администрирование".

2. Жмем кнопку "Выбрать файл" и выбираете на компьютере свой файл xlsx или тот, что прикреплен как образец, - import_to_pages_2025_16-03.xlsx, а затем  "Загрузить файл" / "Загрузить новый файл". 

3. После загрузки файла, вы увидите заголовки полей(колонок) таблицы из вашего Excel. Разумеется, при создании своего файла для импорта, кириллицу использовать в заголовках не рекомендуется.

4. Ниже таблица сопоставления полей в БД и полей в вашем файле импорта. 
	Пусть не пугает написание и название полей слева, например "Alias", "Meta Description" в коде плагина все они корректно прописанны, как пример:

    'page_alias' => 'Alias',
    'page_state' => 'State',
    'page_cat' => 'Category',
    'page_title' => 'Title',
    'page_desc' => 'Description',
    'page_keywords' => 'Keywords',
    'page_metatitle' => 'Meta Title',
    'page_metadesc' => 'Meta Description',
	
5. В колонке справа, в каждой строке (не все поля обязательны) прописываем название колонки из таблицы вашего Excel, где название этой колонки должно соответствовать полю в БД таблицы модуля статей "cot_pages".

Например:

5.1. Слева у вас "Alias" - это означает справа в таблице должен быть прописан заголовок таблицы из Excel, в котором находятся псевдонимы вашей статьи (в прилагаемом к плагину файлу import_to_pages_2025_16-03.xlsx псевдонимы/алиасы лежат в колонке под названием "page_alias").

5.2. Слева у вас "Title" - это означает справа в таблице должен быть прописан заголовок таблицы из Excel, в котором находятся названия статей. (в прилагаемом к плагину файлу import_to_pages_2025_16-03.xlsx названия статей лежат в колонке под названием "page_title").

и так далее. 

6. Критически важное замечание!
Плагин не умеет создавать категории. Поэтому оставьте пустым поле справа напротив поля "Category", которое слева.
По умолчанию, если категория не указана, - статьи импортируются в категорию статей "news".
Перед убедитесь, что в структуре Управление сайтом / Расширения / Pages / Структура у вас есть раздел с кодом "news".
Можно ее создать, если ее нет, или поле таблицы с кодом категории в вашем файле эксель привести в точное соответствие со структурой модуля "Pages", для каждой статьи в вашем файле импорта.

7. Все поля (важные и обязательные) заполнили, - внизу кнопка "Импортировать".

Проверил сам не однократно - плагин импорта работает.
Смотрите скриншоты в теме поддержки по ссылке ниже.

Скачать бесплатно плагин ["Импорт из Excel через PhpSpreadsheet"](https://github.com/webitproff/cot-excelimport-PhpSpreadsheet_No-Composer/).

Тема поддержки на форуме. 

Cotonti. Import from Excel via PhpSpreadsheet

A plugin for importing articles for all Cotonti-based websites.
Important Technical Notes:

    Uses the PhpSpreadsheet library version 1.23.0 without Composer.
    Tested on a Cotonti 0.9.26 website running PHP 8.2.
    Do not update the PhpSpreadsheet library to versions newer than 1.23.0, as later versions require Composer.

Plugin Installation:

    Upload the "excelimport" folder to the plugins directory on your website.
    Inside the plugin directory /public_html/plugins/excelimport, set write permissions (755 or 777, depending on your hosting provider) for the "uploads" and "logs" folders.
    Go to the admin panel: "Site Management / Extensions," find "Import from Excel via PhpSpreadsheet," open the plugin card, and click "Install."
    Click the "Configuration" button—you can adjust the number of rows to import at once.
    If your database prefix is "cot_", no changes are needed. I haven’t tested the plugin with other database prefixes yet.

Working with the Import:

    Go to the "excelimport" extension card and click "Administration."

    Click the "Select File" button and choose your .xlsx file from your computer (or use the sample file attached—import_to_pages_2025_16-03.xlsx), then click "Upload File" / "Upload New File."

    After uploading the file, you’ll see the headers of the table columns from your Excel file. Naturally, when creating your own import file, it’s recommended to avoid using Cyrillic characters in the headers.

    Below is a field mapping table for the database fields and the fields in your import file.

    Don’t be alarmed by the naming of the fields on the left, such as "Alias" or "Meta Description"—in the plugin code, they are all correctly defined, for example:
    php

    'page_alias' => 'Alias',
    'page_state' => 'State',
    'page_cat' => 'Category',
    'page_title' => 'Title',
    'page_desc' => 'Description',
    'page_keywords' => 'Keywords',
    'page_metatitle' => 'Meta Title',
    'page_metadesc' => 'Meta Description',

    In the right column, for each row (not all fields are mandatory), enter the column header from your Excel table that corresponds to the database field in the "cot_pages" articles module.

For example:

5.1. On the left, you have "Alias"—this means that in the right column, you should enter the header from your Excel table that contains the aliases for your articles (in the sample file import_to_pages_2025_16-03.xlsx attached to the plugin, aliases are in the column titled "page_alias").

5.2. On the left, you have "Title"—this means that in the right column, you should enter the header from your Excel table that contains the article titles (in the sample file import_to_pages_2025_16-03.xlsx, article titles are in the column titled "page_title").

And so on.

    Critically Important Note!
    The plugin does not create categories. Therefore, leave the right field empty next to the "Category" field on the left.
    By default, if no category is specified, articles are imported into the "news" category.
    Before proceeding, ensure that in "Site Management / Extensions / Pages / Structure," you have a section with the code "news."
    You can create it if it doesn’t exist, or adjust the category code field in your Excel file to exactly match the structure of the "Pages" module for each article in your import file.
    Once all important and required fields are filled in, click the "Import" button at the bottom.

I’ve tested it multiple times myself—the import plugin works.
Download the ["Import from Excel via PhpSpreadsheet"](https://github.com/webitproff/cot-excelimport-PhpSpreadsheet_No-Composer/) plugin for free.

Support thread on the forum.
