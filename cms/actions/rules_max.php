<?
    $form = new jQuickForm('simple');
        $fieldset = $form->insertFieldset('Пример вставки textarea');
            $comment = $fieldset->insertTextarea('comment')
                ->setLabel('Twit')
                ->setCols(50)->setRows(5)
                ->setComment('Вы набираете сообщение для твиттера, попробуйте уложиться в 140 символов');
            $comment->addRuleMax("Сообщение в твиттере не может быть больше 140 символов", 140);
        $fieldset->insertInputSubmit('Save comment!','save');


?>