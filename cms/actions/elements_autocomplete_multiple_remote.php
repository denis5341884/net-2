<?
    $form = new jQuickForm('simple');
    $fieldset1 = $form
    ->insertFieldset('Пример использования multiple autocomplete с remote-source (textarea)');

        $fieldset1->insertTextArea('autocomplete')
        ->autocompleteMultipleRemote('/cms/ajax/autocomplete_multiple_remote.php')
        ->setCols(60)
        ->setLabel('С какими функциями PHP вам доводилось работать')
        ->setExample('get_class')->setComment('Введите хотя бы один символ, например англ. "a"');

    $fieldset1 = $form
    ->insertFieldset('Пример использования multiple autocomplete с remote-source (input type=text)');
        $fieldset1->insertInputText('autocomplete2')
        ->autocompleteMultipleRemote('/cms/ajax/autocomplete_multiple_remote.php')
        ->setAttribute('size',80)
        ->setLabel('С какими функциями PHP вам доводилось работать')
        ->setExample('get_class')->setComment('Введите хотя бы один символ, например англ. "a"');

    Jaguar::view()->setVar('PHP_CODE','<h2>Скрипт AJAX-источника,
    который и выдает варианты автодополнения</h2>');
    Jaguar::view()->setVar('PHP_CODE',
        trim(highlight_file($_SERVER['DOCUMENT_ROOT']
        .'/cms/ajax/autocomplete_multiple_remote.php',true)));

?>