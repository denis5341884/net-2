<?
    $form = new jQuickForm('simple');
        $fieldset = $form->insertFieldset('Пример правила "пустой"');
            $fieldset->insertStatic('Это правило имеет смысл в сочетании с другими, например пустое, ЛИБО непустое И типа E-mail');
            $email = $fieldset->insertInputText('email')
                ->setLabel('E-mail')
                ->setComment('введите адрес вашей электронной почты');
                 $email->addRule('empty')
                 ->or_($email->createRule('nonempty', 'Введите свой настоящий адрес, если действительно хотите получать наш спам :)')
                ->and_($email->createRule('regex','Неверный формат',
                    "/^[a-z0-9_-]{1,20}@(([a-z0-9-]+\.)+(com|net|org|mil|".
                    "edu|gov|arpa|info|biz|inc|name|[a-z]{2})|[0-9]{1,3}\.[0-9]{1,3}\.[0-".
                    "9]{1,3}\.[0-9]{1,3})$/is")));

        $fieldset->insertInputSubmit('Post!','save');


?>