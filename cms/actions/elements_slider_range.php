<?
    $form = new jQuickForm('simple');
    // выставим значения по-умолчанию
    $default = array(
        'gr' => array(
            'min' => 100,
            'max' => 400,
        )
    );
    $form->addDataSource(
        new HTML_QuickForm2_DataSource_Array($default)
    );
    $fieldset = $form->insertFieldset('Варианты использования slider');
        $fieldset->insertSliderRange('gr',0,1000,100)
            ->setLabel('Сколько сотен долларов готовы пожертвовать в Фонд мира?')
            ->setComment('Сумма пожертвования составляет ($):')
            ;
        $fieldset->insertInputSubmit('Помочь голодающим','save');

?>