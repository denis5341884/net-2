<?
    $form = new jQuickForm('simple');
    $fieldset = $form->insertFieldset('Варианты использования datepicker');

        $fieldset->insertDatePicker('datepicker')
        ->setLabel('Выбор даты (формат yy-mm-dd)')
        ->setComment('Кликните на поле вызова datepicker')
        ->setExample(date('Y-m-d'));

        $fieldset->insertDatePicker('datepicker1','yy-mm')
        ->setLabel('Выбор даты (формат yy-mm)')
        ->setComment('Кликните на поле вызова datepicker')
        ->setExample(date('Y-m'));

        $fieldset->insertDatePicker('datepicker2','dd.mm.yy')
        ->setLabel('Выбор даты (формат dd.mm.yy)')
        ->setComment('Кликните на поле вызова datepicker')
        ->setExample(date('d.m.Y'));
?>