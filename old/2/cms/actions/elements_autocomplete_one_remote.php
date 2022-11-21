<?
    $form = new jQuickForm('simple');
    $fieldset1 = $form->insertFieldset('Пример использования single autocomplete с AJAX-source');

        $fieldset1->insertStatic('<div id="log">Тут будет выводиться лог действий</div>');

        $input = $fieldset1->insertInputText('arr')->autocompleteOneRemote('/cms/ajax/autocomplete_one_remote.php')
        ->setLabel('Языки программирования')
        ->setExample('PHP')->setComment('Введите хотя бы один символ, например англ. "P"');

    //чтобы показать еще одну фишку - дополнительно в качестве примера вставим лог вызовов
    Jaguar::js()->addJsOnload('
jQuery( "#'.$input->getId().'" ).bind( "autocompleteselect", function(event, ui) {
    log( ui.item ?
    "Selected: " + ui.item.value + " aka " + ui.item.id :
    "Nothing selected, input was " + this.value );
});
    ');
    Jaguar::js()->addJsInline('
		function log( message ) {
			jQuery( "<div/>" ).text( message ).prependTo( "#log" );
			jQuery( "#log" ).attr( "scrollTop", 0 );
		}

    ');
    Jaguar::view()->setVar('PHP_CODE','<h2>Скрипт AJAX-источника,
    который и выдает варианты автодополнения</h2>');
    Jaguar::view()->setVar('PHP_CODE',
        trim(highlight_file($_SERVER['DOCUMENT_ROOT']
        .'/cms/ajax/autocomplete_one_remote.php',true)));

?>