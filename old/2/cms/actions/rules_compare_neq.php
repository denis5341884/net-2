<?
    $form = new jQuickForm('simple');
        $fieldset = $form->insertFieldset('Пример правила "не совпадают"');
            $name = $fieldset->insertInputText('name1')
                ->setLabel('Имя первого сына')
                ->setComment('Придумай мужское имя');
            $name->addRuleRequired("Что, так сложно придумать имя?");

            $rename = $fieldset->insertInputText('name2')
                ->setLabel('Имя второго сына')
                ->setComment('Придумай еще одно мужское имя отличающееся от первого');
            $rename->addRuleCompareNeq("Имена не могут быть одинаковыми, иначе оба сына будут откликаться вместе и вы запутаетесь сами", $name);
            $rename->addRuleRequired("Что, так сложно придумать имя?");

            $captcha= $fieldset->insertInputText('captcha')
                ->setLabel('Captcha')
                ->setComment('Напиши что угодно, только не ответа на задачу сколько будет 2+2=?');
            $captcha->addRuleCompareNeq("Ну просил же - что то другое!!!", "4");

        $fieldset->insertInputSubmit('Post!','save');


?>