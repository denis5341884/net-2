<?
    $form = new jQuickForm('simple');
        $fieldset = $form->insertFieldset('Fieldset 1');
            $fieldset11 = $fieldset->insertFieldset('Fieldset 1.1');
                $fieldset111 = $fieldset11->insertFieldset('Fieldset 1.1.1');
                    $fieldset111->insertInputText('t1')->setLabel('test 1');
                $fieldset112 = $fieldset11->insertFieldset('Fieldset 1.1.2');
                    $fieldset112->insertInputText('t2')->setLabel('test 2');
            $fieldset12 = $fieldset->insertFieldset('Fieldset 1.2');
                $fieldset121 = $fieldset12->insertFieldset('Fieldset 1.2.1');
                    $fieldset121->insertInputText('t2')->setLabel('test 3');
                $fieldset122 = $fieldset12->insertFieldset('Fieldset 1.2.2');
                    $fieldset122->insertInputText('t2')->setLabel('test 4');

?>