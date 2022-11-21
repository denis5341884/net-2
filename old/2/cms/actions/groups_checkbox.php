<?
    $form = new jQuickForm('simple');
        $fieldset = $form->insertFieldset('Checkboxes');
            $gr = $fieldset->insertGroup('chk')->setLabel('На какие сигналы светофора нужно обращать внимание?')->addClass('col4');
                $gr->insertInputCheckbox('red','Красный');
                $gr->insertInputCheckbox('yellow','Желтый');
                $gr->insertInputCheckbox('green','Зеленый');
        $gr->addRuleNonEmpty("Нельзя отказаться от этого вопроса");
        $fieldset->insertInputSubmit('Save comment!','save');
?>