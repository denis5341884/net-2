<?
    $form = new jQuickForm('simple');
        $fieldset = $form->insertFieldset('Пример вставки <a href="http://code.google.com/p/jwysiwyg/">jWysiwyg</a>');
            $fieldset->insertJwysiwyg('comment')
                ->setLabel('Расширенный комментарий')
                ->setCols(70)->setRows(5)
                ->setComment('Введите текст и еще его нужно обязательно красиво оформить!');

?>