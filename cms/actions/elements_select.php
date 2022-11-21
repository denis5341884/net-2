<?
    $form = new jQuickForm('simple');
    $fieldset = $form->insertFieldset('Варианты использования select');
        $select = $fieldset->insertSelect('select')->setLabel('Выпадающий список')
            ->setComment('Простой select')->setExample('Зеленый','green');
        $select->addOption('Красный', 'red');
        $select->addOption('Зеленый', 'green');
        $select->addOption('Toyota', 'toyota');
        $select->addOption('Nissan', 'nissan');

        $select = $fieldset->insertSelect('select')->setLabel('Выпадающий список')
            ->setComment('С группировкой значений (с optgroup)');
        $optgroup = $select->addOptgroup('Цвета');
        $optgroup->addOption('Красный', 'red');
        $optgroup->addOption('Зеленый', 'green');
        $optgroup = $select->addOptgroup('Марки авто');
        $optgroup->addOption('Toyota', 'toyota');
        $optgroup->addOption('Nissan', 'nissan');

        $select = $fieldset->insertSelect('select')->setLabel('Выпадающий список')
            ->setComment('С множественным выбором')
            ->setExample('Красный, Зеленый, Ниссан',"green,red,nissan");
        $optgroup = $select->addOptgroup('Цвета');
        $optgroup->addOption('Красный', 'red');
        $optgroup->addOption('Зеленый', 'green');
        $optgroup = $select->addOptgroup('Марки авто');
        $optgroup->addOption('Toyota', 'toyota');
        $optgroup->addOption('Nissan', 'nissan');
        $select->setMultiple(1);
?>