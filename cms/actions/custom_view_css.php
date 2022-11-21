<?
    $form = new jQuickForm('simple');
    $fieldset = $form->insertFieldset('Делаем "вебдванольный" крупный шрифт в форме логина');
        $fieldset->insertInputText('inputtext')->setLabel('Логин')
        ->setComment('Введите Ваш логин или email');
        $fieldset->insertInputPassword('pass')->setLabel('Пароль')
        ->setComment('Введите Ваш пароль');
    //добавляем класс
    $fieldset->addClass('login_form');
    //добавляем стиль
    Jaguar::css()->addCssInline('
    .login_form input{
        font-size:30px;
    }
    .login_form label.jqf_element{
        font-size:18px;
        font-weight:normal;
    }
    ');
?>