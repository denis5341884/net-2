<?
    $form = new jQuickForm('simple');
        $fieldset = $form->insertFieldset('Пример правила "не больше"');
            $pass = $fieldset->insertInputText('age')
                ->setLabel('Сколько Вам лет?')
                ->setComment('Наберите цифрами количество полных лет. Больше 150 не живут');
            $pass->addRuleCompareLte("Вы Дункан Маклауд?", 150);
        $fieldset->insertInputSubmit('Save!');

?>