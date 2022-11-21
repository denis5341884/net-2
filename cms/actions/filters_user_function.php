<?
    function filter_custom($var){
        return  str_replace('1','[один]',$var);
    }

    $form = new jQuickForm('simple');
    $fieldset = $form->insertFieldset('Пример работы фильтра trim()');
        $text = $fieldset->insertInputText('inputtext')->setLabel('Текстовое поле')
        ->setExample('Пример 1 текста 1')
        ->setComment('Введите любой текст с единичками (цифрами).<br />
        Увидеть работу фильтра можно сравнив массивы $form->getValue() и $_POST');

        $fieldset->insertTextarea('comment')
            ->setLabel('Расширенный комментарий')
            ->setCols(50)->setRows(5);
    $form->insertInputSubmit('Отправить данные на фильтрацию!');
    $text->addFilter('filter_custom',null,true);
?>