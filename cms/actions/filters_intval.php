<?
    $form = new jQuickForm('simple');
    $fieldset = $form->insertFieldset('Пример работы фильтра intval()');
        $text = $fieldset->insertInputText('inputtext')->setLabel('Текстовое поле')
        ->setExample('Пример текста')
        ->setComment('Введите любой текст, он будет преобразован в целое число.
        Увидеть работу фильтра можно сравнив массивы $form->getValue() и $_POST');
    $form->insertInputSubmit('Отправить данные на фильтрацию!');
    $text->addFilter('intval',null,true);
?>