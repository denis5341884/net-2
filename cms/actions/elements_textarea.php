<?
    $form = new jQuickForm('simple');
        $fieldset = $form->insertFieldset('Пример вставки textarea');
            $fieldset->insertTextarea('comment')
                ->setLabel('Расширенный комментарий')
                ->setCols(50)->setRows(5)
                ->setExample('ОЛОЛО ПЫЩЬ ПЫЩЬ!!!!!111111АДИНАДИНАДИН.');

?>