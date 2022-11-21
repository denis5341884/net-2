<?
    $form = new jQuickForm('simple');
    $fieldset1 = $form->insertFieldset('Варианты использования text');
        $fieldset1->insertInputText('inputtext')->setLabel('Текстовое поле')
        ->setExample('Пример текста')->setComment('Введите любой текст');
?>