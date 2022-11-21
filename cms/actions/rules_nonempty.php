<?
    $form = new jQuickForm('simple');
        $fieldset = $form->insertFieldset('Пример правила "не пустой"');
        $gr = $fieldset->insertGroup('chk')->addClass('col4')
            ->setLabel('Вам дают на выбор два сувенира из трех:')
            ->setComment("234");
//            jaguar_debug($gr);exit;
            $gr->insertInputCheckbox('s1','Зажигалка');
            $gr->insertInputCheckbox('s2','Визитница');
            $r = $gr->insertInputCheckbox('s3','Авторучка');
            $r->setComment(123);
            $gr->addRuleNonEmpty('Выберите хотя бы два сувенира', 2);
        $gr = $fieldset->insertGroup('chk1')->setLabel('Чтобы много зарабатывать нужно, нужно иметь хотя бы что то из этого набора. Что есть у вас?')->addClass('col4');
            $gr->insertInputCheckbox('s1','Умную голову');
            $gr->insertInputCheckbox('s2','Связи');
            $gr->insertInputCheckbox('s3','Деньги');
            $gr->addRuleNonEmpty("У вас нет шансов");
            $gr->setComment("Хотя бы 1");
        $fieldset->insertInputSubmit('Ты не отвечаешь на мой ответ!!!','save');

?>