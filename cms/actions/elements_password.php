<?
    $form = new jQuickForm('simple');
        $fieldset = $form->insertFieldset('Пример элементов типа "password"');
            $pass = $fieldset->insertInputPassword('pass')
                ->setLabel('Пароль')
                ->setComment('Наберите пароль');
            $pass->addRuleRequired("Пароль надо заполнить");

            $repass = $fieldset->insertInputPassword('pass')
                ->setLabel('Пароль еще раз')
                ->setComment('Наберите пароль');
            $repass->addRuleCompareEq("Пароли должны совпадать", $pass);
            $fieldset->insertStatic('Обратите внимание значение поля "Пароль еще раз" не приходит постом');

        $fieldset->insertInputSubmit('Post!','save');


?>