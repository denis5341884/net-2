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
    'date'       => 'jQuickForm - Date',
    'datepicker' => 'jQuickForm - DatePicker',
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


$routes['jaguar']['text'] = 'Jaguar - менеджер сайта';
$routes['jaguar']['elements'] = array(
    'js' => 'Jaguar_Js',
    'css' => 'Jaguar_Css',
    'view' => 'Jaguar_View',
);

$routes['patch']['text'] = 'Patch HMTL_QuickForm2';

$routes['roadmap']['text'] = 'Планы';
$routes['thanks']['text'] = 'Благодарности';
$routes['feedback']['text'] = 'Обратная связь';
$routes['download']['text'] = 'Скачать jQuickForm';
?>