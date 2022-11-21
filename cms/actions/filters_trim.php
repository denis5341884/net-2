<?
    $form = new jQuickForm('simple');
    $fieldset = $form->insertFieldset('Пример работы фильтра trim()');
        $fieldset->insertInputText('inputtext')->setLabel('Текстовое поле')
        ->setExample('Пример текста')
        ->setComment('Введите любой текст, он будет преобразован в целое число.
        Увидеть работу фильтра можно сравнив массивы $form->getValue() и $_POST');

        $fieldset->insertTextarea('comment')
            ->setLabel('Расширенный комментарий')
            ->setCols(50)->setRows(5)
            ->setExample('ОЛОЛО ПЫЩЬ ПЫЩЬ!!!!!111111АДИНАДИНАДИН.');
    $form->insertInputSubmit('Отправить данные на фильтрацию!');
    $form->addFilter('trim',null,true);
?>