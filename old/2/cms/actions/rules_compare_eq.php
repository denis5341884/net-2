<?
    $form = new jQuickForm('simple');
        $fieldset = $form->insertFieldset('Пример правила compare');
            $pass = $fieldset->insertInputText('pass')
                ->setLabel('Пароль')
                ->setComment('Наберите пароль');
            $pass->addRuleRequired("Пароль надо заполнить");

            $repass = $fieldset->insertInputText('pass')
                ->setLabel('Пароль еще раз')
                ->setComment('Наберите пароль');
            $repass->addRuleCompareEq("Пароли должны совпадать", $pass);
            $fieldset->insertStatic('Обратите внимание значение поля "Пароль еще раз" не приходит постом');

            $captcha= $fieldset->insertInputText('captcha')
                ->setLabel('Captcha')
                ->setComment('Сколько будет 2+2=?');
            $captcha->addRuleCompareEq("Каптча не разгадана", "4");

        $fieldset->insertInputSubmit('Post!','save');


?>