<?
    $form = new jQuickForm('simple');
    $fieldset = $form->insertFieldset('Варианты использования date');
        $fieldset->insertDate('dt','YMdhis',null,null,null,null,5,10)->setLabel('Выбор даты')
        ->setComment('Введите дату');
?>