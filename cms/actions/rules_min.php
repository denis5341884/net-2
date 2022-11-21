<?
    $form = new jQuickForm('simple');
        $fieldset = $form->insertFieldset('Пример вставки textarea');
            $comment = $fieldset->insertTextarea('comment')
                ->setLabel('Расширенный комментарий')
                ->setCols(50)->setRows(5)
                ->setComment('Не забываем, что это правило работает так: все верное, если поле либо пустое, либо если начал заполнять,
то заполняй так, чтобы количество элементов было не менее указанного.
А это значит, если хотите ограничить, чтобы было точно не менее 10, то добавляйте еще правило <strong>addRuleRequired</strong>')
                ->setExample('ОЛОЛО ПЫЩЬ ПЫЩЬ!!!!!111111АДИНАДИНАДИН.');
            $comment->addRuleMin("Маловато для комментария, ожидалось хотя бы 10 символов", 10);
            $comment->addRuleRequired("Таки заполни");
        $gr = $fieldset->insertGroup('chk')->addClass('col4');
        $gr->insertInputCheckbox('green','Зеленый');
        $gr->insertInputCheckbox('red','Красный');
        $gr->insertInputCheckbox('blue','Синий');
        $gr->addRuleMin("Надо выбрать хотя бы два цвета", 2);
        $gr->addRuleRequired("Совсем не указать цвета - тоже не хорошо");
        $fieldset->insertInputSubmit('Ты не отвечаешь на мой ответ!!!','save');

?>