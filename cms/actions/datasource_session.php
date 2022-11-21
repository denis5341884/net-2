<?
    session_start();
    $_SESSION['select'] = 'add_job';
    $form = new jQuickForm('simple');
    $fieldset = $form->insertFieldset('Чтобы увидеть результат работы - кликните на тип создаваемой записи');
        $fieldset->insertStatic('
        В данном примере стартуется сессия со значением <pre>$_SESSION[\'select\'] = \'add_job\';</pre>
        Именно это значение и передается как значение по-умолчанию в форму
        ');
    $fieldset = $form->insertFieldset('Пример работы HTML_QuickForm2_DataSource_SuperGlobal');
        $select = $fieldset->insertSelect('select')->setLabel('Тип записи')
            ->setComment('Простой select')->setExample('Топик','add_topic');
            $select->addOption('-выберите тип записи-', '');
            $select->addOption('Топик', 'add_topic');
            $select->addOption('Вакасия', 'add_job');
            $select->addOption('Ссылка', 'add_link');

        $fieldset->insertInputText('title')
        ->setLabel('Заголовок')
        ->setExample('Пример текста');

        $fieldset->insertTextarea('text')
            ->setLabel('Содержание')
            ->setCols(50)->setRows(5);

    $form->insertInputSubmit('Сохранить новость');

    // выставим значения по-умолчанию
    $form->addDataSource(
        new HTML_QuickForm2_DataSource_Session($_SESSION)
    );

?>