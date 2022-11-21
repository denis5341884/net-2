<?
    $form = new jQuickForm('simple');
    $fieldset = $form->insertFieldset('Варианты использования slider');

        $fieldset->insertSlider('sl',0,1000,100)
            ->setLabel('Сколько сотен долларов готовы пожертвовать в Фонд мира?')
            ->setComment('Сумма пожертвования составляет ($):');

        $fieldset->insertSlider('s2',35.0, 41,.1)
            ->setLabel('Средняя температура по больнице:')
            ->setComment('в градусах по Цельсию:');

        $fieldset->insertInputSubmit('Ты не отвечаешь на мой ответ!!!','save');

    // выставим значения по-умолчанию
    $form->addDataSource(
        new HTML_QuickForm2_DataSource_Array(array(
            's2'        => 36.6,
        )
    ));

?>