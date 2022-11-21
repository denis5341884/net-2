<?
    $form = new jQuickForm('simple');
    $page = $form->insertGroupPage(1);
        $fieldset = $page->insertFieldset('Страница 1');
            $select = $fieldset->insertSelect('select')->setLabel('Выпадающий список')
                ->setComment('Простой select')->setExample('Зеленый','green');
                $select->addOption('Красный', 'red');
                $select->addOption('Зеленый', 'green');
                $select->addOption('Toyota', 'toyota');
                $select->addOption('Nissan', 'nissan');
            $gr = $fieldset->insertGroupPageButtons();
                $gr->insertGroupPageButtonNext();

    $page = $form->insertGroupPage();
        $fieldset = $page->insertFieldset('Страница 2');
            $select = $fieldset->insertSelect('select')->setLabel('Выпадающий список')
                ->setComment('С группировкой значений (с optgroup)');
            $optgroup = $select->addOptgroup('Цвета');
            $optgroup->addOption('Красный', 'red');
            $optgroup->addOption('Зеленый', 'green');
            $optgroup = $select->addOptgroup('Марки авто');
            $optgroup->addOption('Toyota', 'toyota');
            $optgroup->addOption('Nissan', 'nissan');
            $gr = $fieldset->insertGroupPageButtons();
                $gr->insertGroupPageButtonNext();
                $gr->insertGroupPageButtonPrev();

    $page = $form->insertGroupPage();
        $fieldset = $page->insertFieldset('Страница 3');
            $comment = $fieldset->insertTextarea('comment')
                ->setLabel('Расширенный комментарий')
                ->setCols(50)->setRows(5)
                ->setComment('Не забываем, что это правило работает так: все верное, если поле либо пустое, либо если начал заполнять,
то заполняй так, чтобы количество элементов было не менее указанного.
А это значит, если хотите ограничить, чтобы было точно не менее 10, то добавляйте еще правило <strong>addRuleRequired</strong>')
                ->setExample('ОЛОЛО ПЫЩЬ ПЫЩЬ!!!!!111111АДИНАДИНАДИН.');
            $comment->addRuleMin("Маловато для комментария, ожидалось хотя бы 10 символов", 10);
            $comment->addRuleRequired("Таки заполни");

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
            $gr = $fieldset->insertGroupPageButtons();
                $gr->insertGroupPageButtonPrev();
                $gr->insertInputSubmit('Сохранить');
?>