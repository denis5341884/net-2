<?
    $form = new jQuickForm('simple');
        $fieldset = $form->insertFieldset('Пример правила "строго меньше"');
            $pass = $fieldset->insertInputText('age')
                ->setLabel('Сколько Вам лет?')
                ->setComment('Наберите цифрами количество полных лет. Подсказка все люди живут, увы, строго меньше 150 лет');
            $pass->addRuleCompareLt("Вы Дункан Маклауд?", 150);
        $fieldset->insertInputSubmit('Save!');

?>