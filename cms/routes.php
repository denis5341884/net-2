<?
$routes = array();
$routes['jquickform']['text'] = 'jQuickForm';
$routes['jquickform']['elements'] = array(
    'quickform2'       => 'HTML_QuickForm2',
    'jquery'           => 'jQuery',
);

$routes['elements']['text'] = 'Базовые элементы';
$routes['elements']['elements'] = array(
    'text'       => 'jQuickForm - InputText',
    'password'       => 'jQuickForm - InputPassword',
    'date'       => 'jQuickForm - Date',
    'datepicker' => 'jQuickForm - DatePicker',
    'slider' => 'jQuickForm - Slider',
    'slider_range' => 'jQuickForm - SliderRange',
    'select'     => 'jQuickForm - Select',
    'buttons'    => 'jQuickForm - Buttons',
    'textarea'    => 'jQuickForm - Textarea',
    'page'    => 'jQuickForm - Page',
    'static'    => 'jQuickForm - Static',
    'jwysiwyg'    => 'jQuickForm - jWysiwyg',
    'autocomplete_one_array'    => 'jQuickForm - Autocomplete <br />One Array',
    'autocomplete_one_remote'    => 'jQuickForm - Autocomplete <br />One Remote',
    'autocomplete_multiple_array'    => 'jQuickForm - Autocomplete <br />Multiple Array',
    'autocomplete_multiple_remote'    => 'jQuickForm - Autocomplete <br />Multiple Remote',
    'file'    => 'jQuickForm - File Upload',
    'file_multi'    => 'jQuickForm - File MultiUpload',
);

$routes['groups']['text'] = 'Группировки элементов';
$routes['groups']['elements'] = array(
    'habr' => 'Группировка submits в стиле Хабра',
    'fieldsets' => 'Вложенные fieldset',
    'checkbox' => 'Группа checkbox',
);

$routes['rules']['text'] = 'Правила валидации';
$routes['rules']['elements'] = array(
    'required' => 'Правило "обязательное поле"',
    'min' => 'Правило "минимум"',
    'max' => 'Правило "максимум"',
    'compare_eq' => 'Правило "совпадают"',
    'compare_neq' => 'Правило "не совпадают"',
    'compare_lt' => 'Правило "строго меньше"',
    'compare_lte' => 'Правило "не больше"',
    'compare_gt' => 'Правило "строго больше"',
    'compare_gte' => 'Правило "не меньше"',
    'each' => 'Правило "каждый в группе"',
    'empty' => 'Правило "пустой"',
    'nonempty' => 'Правило "не пустой"',
);

$routes['filters']['text'] = 'Фильтры полей форм';
$routes['filters']['elements'] = array(
    'intval' => 'intval()',
    'trim' => 'trim()',
    'user_function' => 'Свой фильтр',
);

$routes['datasource']['text'] = 'DataSource - источники данных для значений полей формы';
$routes['datasource']['elements'] = array(
    'array' => 'HTML_QuickForm2 DataSource_Array',
    'superglobal' => 'HTML_QuickForm2 DataSource_SuperGlobal',
    'session' => 'HTML_QuickForm2 DataSource_Session',
);


$routes['custom_view']['text'] = 'Кастомизация внешнего вида';
$routes['custom_view']['elements'] = array(
    'css' => 'CSS-кастомизация',
    'tpl' => 'Изменение шаблона элемента',
);


$routes['jaguar']['text'] = 'Jaguar - менеджер сайта';
$routes['jaguar']['elements'] = array(
    'js' => 'Jaguar_Js',
    'css' => 'Jaguar_Css',
    'view' => 'Jaguar_View',
);

$routes['patch']['text'] = 'Patch HMTL_QuickForm2';

$routes['examples']['text'] = 'Примеры';
$routes['examples']['elements'] = array(
    'demotivator' => 'Демотиватор!',
);

$routes['roadmap']['text'] = 'Планы';
$routes['thanks']['text'] = 'Благодарности';
$routes['feedback']['text'] = 'Обратная связь';
$routes['download']['text'] = 'Скачать jQuickForm';
?>