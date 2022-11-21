<?
    $form = new jQuickForm('simple');
    $fieldset = $form->insertFieldset('Пример работы фильтра trim()');
        $fieldset->insertInputText('news_title')
        ->setLabel('Заголовок новости')
        ->setExample('Пример текста');

        $fieldset->insertTextarea('news_text')
            ->setLabel('Содержание новости')
            ->setCols(50)->setRows(5);

    $form->insertInputSubmit('Сохранить новость');

    // выставим значения по-умолчанию
    $form->addDataSource(
        new HTML_QuickForm2_DataSource_Array(array(
            'news_title'        => 'Заголовок новости №1',
            'news_text'        => "Текст новости №1",
        )
    ));

?>