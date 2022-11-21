<?
    //если была создана форма - покажем процесс ее создания
    if(isset($form)){
        //если форма прошла проверку
        if($form->validate()){
            //выведем полученные POST'ом значения
            Jaguar::view()->setVar('body','<h2>Пришел POST</h2>');
            Jaguar::view()->setVar('body','<pre>'.htmlentities(print_r($_POST,1),ENT_QUOTES,'UTF-8').'</pre>');
        }
        $html = $form.'';
        //добавим саму форму на страницу
        Jaguar::view()->setVar('body',$html);
        //добавим код php-файла со сборкой формы на страницу
        Jaguar::view()->setVar('PHP_CODE','<h2>2) Собственно сборка формы</h2>');
        Jaguar::view()->setVar('PHP_CODE',
            trim(highlight_file($_SERVER['DOCUMENT_ROOT'].'/cms/actions/'.PAGE.'.php',true)));
        Jaguar::view()->setVar('PHP_CODE','<h2>HTML-код сгенерированной формы</h2>');
        Jaguar::view()->setVar('PHP_CODE','<pre>'.htmlentities($html,ENT_QUOTES,'UTF-8').'</pre>');
        //добавим код php-файла с инициализацией приложения на страницу
        Jaguar::view()->setVar('PHP_CODE','<h2>1) Инициализация приложения</h2>');
        Jaguar::view()->setVar('PHP_CODE',
            trim(highlight_file($_SERVER['DOCUMENT_ROOT'].'/cms/prepend.php',true)));
        //добавим код php-файла со сборкой страницы на страницу (масло масляное :) )
        Jaguar::view()->setVar('PHP_CODE','<h2>3) Сборка страницы</h2>');
        Jaguar::view()->setVar('PHP_CODE',
            trim(highlight_file($_SERVER['DOCUMENT_ROOT'].'/cms/append.php',true)));
    }
    //выведем все стили, которые были добавлены как внешние
    Jaguar::view()->setVar('css',Jaguar::css()->getCss());
    //выведем все стили, которые были добавлены как inline css
    Jaguar::view()->setVar('css_inline',Jaguar::css()->getCssInline());
    Jaguar::view()->setVar('PHP_CODE','<h2>Что попало в JsOnload</h2>');
    Jaguar::view()->setVar('PHP_CODE',
        '<pre>'.htmlentities(Jaguar::js()->getJsOnload(),ENT_QUOTES,'UTF-8').'</pre>');
    Jaguar::view()->setVar('PHP_CODE','<h2>Что попало в JsInline</h2>');
    Jaguar::view()->setVar('PHP_CODE',
        '<pre>'.htmlentities(Jaguar::js()->getJsInline(),ENT_QUOTES,'UTF-8').'</pre>');
    Jaguar::view()->setVar('PHP_CODE','<h2>Подключенные javascript-файлы</h2>');
    Jaguar::view()->setVar('PHP_CODE',
        '<pre>'.htmlentities(Jaguar::js()->getJs(),ENT_QUOTES,'UTF-8').'</pre>');
    Jaguar::view()->setVar('PHP_CODE','<h2>Здесь показано какие шаблоны были использованы
    при отрисовке каждого элемента</h2>');
    Jaguar::view()->setVar('PHP_CODE',
        '<div class="quickform">'.implode('<br />',jQuickForm::$element_templates).'</div>');
    //выведем все js, которые были добавлены необходимые по событию "onload"
    Jaguar::view()->setVar('js_onload',Jaguar::js()->getJsOnload());
    //выведем все inline js
    Jaguar::view()->setVar('js_inline',Jaguar::js()->getJsInline());
    //выведем все js, подключенные как внешние
    Jaguar::view()->setVar('js',Jaguar::js()->getJs());
    //ну и заголовок страницы
    Jaguar::view()->setVar('title', 'jQuickForm = jQuery UI + Html_QuickForm2');
    //парсим и выводим сгенерированную страницу
    print  Jaguar::view()->parse();
?>