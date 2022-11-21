<?
    $form = new jQuickForm('simple');
        $fieldset = $form->insertFieldset('Пример правила "строго больше"');
            $pass = $fieldset->insertInputText('height')
                ->setLabel('Я мебельщик, какой высоты сделать вам стол?')
                ->setComment('Наберите цифрами высоту стола в сантиметрах. Подсказка: столы делают строго больше 80 см');
            $pass->addRuleCompareGt("Это будет кукольный столик?", 80);
        $fieldset->insertInputSubmit('Save!');

?>