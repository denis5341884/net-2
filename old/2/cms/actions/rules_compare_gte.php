<?
    $form = new jQuickForm('simple');
        $fieldset = $form->insertFieldset('Пример правила "не меньше"');
            $pass = $fieldset->insertInputText('height')
                ->setLabel('Я мебельщик, какой высоты сделать вам стол?')
                ->setComment('Наберите цифрами высоту стола в сантиметрах. Подсказка: столы меньше 80 см не делают');
            $pass->addRuleCompareGte("Это будет кукольный столик?", 80);
        $fieldset->insertInputSubmit('Save!');

?>