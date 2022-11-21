<?
    $form = new jQuickForm('simple');
        $fieldset = $form->insertFieldset('Fieldset 1');
            $name = $fieldset->insertInputText('name')->setLabel('Имя');
            $name->addRuleRequired('Вы не помните своего имени?');
        $fieldset->insertInputSubmit('Сохранить');
?>