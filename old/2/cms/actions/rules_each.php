<?
    $form = new jQuickForm('simple');
        $fieldset = $form->insertFieldset('Пример правила "каждый"');
            $gr = $fieldset->insertGroup("gr")->addClass('col3');
                $gr->insertInputText('email1')
                    ->setLabel('Введите любое целое число')
                    ->setExample('123');
                $gr->insertInputText('email2')
                    ->setLabel('Введите любое целое число')
                    ->setExample('123');
                $gr->insertInputText('email3')
                    ->setLabel('Введите любое целое число')
                    ->setExample('3');
            $gr->addRuleEach("Только цифры1", $gr->createRule('regex', null, '/^[a-z]+$/i'));

        $fieldset->insertInputSubmit('Post!','save');


?>