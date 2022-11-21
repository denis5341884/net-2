<?
    $form = new jQuickForm('simple');
        $fieldset = $form->insertFieldset('Пример группировки элементов submit');
            $gr = $fieldset->insertGroupSubmit();
            $gr->insertInputSubmit('Опубликовать','post')->addClass('big')
                ->setAttribute('onclick','alert("Форма ушла, вернется не скоро...");return false;');;
            $gr->insertInputSubmit('В черновики','draft')
                ->setAttribute('onclick','alert("Форма ушла, вернется не скоро...");return false;');;
            $gr->insertStatic('<a href="/">Отказаться</a>');
?>