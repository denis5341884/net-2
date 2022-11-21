<?
    $form = new jQuickForm('simple');
    $fieldset = $form->insertFieldset('Пример использования static - конечно же сиськи!');
        $fieldset->insertStatic('
<div class=" a_center">
    <div class="body siski">
        <h1>Сиськи на чистом CSS3!</h1>
        <div class="chest">
            <div class="left"><div class="clavicle"></div></div>
            <div class="right"><div class="clavicle"></div></div>

        </div>

        <div class="breast">
            <div class="left"><ul class="boob"><li class="nipple"></li></ul></div>
            <div class="right"><ul class="boob"><li class="nipple"></li></ul></div>
            <div class="between"></div>
        </div>

        <div class="belly">
            <div class="left"></div>

            <div class="button">O</div>
            <div class="right"></div>
        </div>

        <div class="thigh">
            <div class="left"></div>
            <div class="right"></div>
        </div>
    </div>
    <div class="controls">
        Потрогать:
        <input type="button" id="touch-left" value="Левая" />
        <input type="button" id="touch-both" value="Обе" />
        <input type="button" id="touch-right" value="Правая" /><br/>

        Размеры:
        <input type="button" id="size-1" value="№ 1" />
        <input type="button" id="size-2" value="№ 2" />

        <input type="button" id="size-3" value="№ 3" />
        <input type="button" id="size-4" value="№ 4" />
        <input type="button" id="size-5" value="№ 5" />
    </div>
    Оригинальная идея сайта <a href="http://boobs.webriders.com.ua/">http://boobs.webriders.com.ua/</a>
</div>
<div class="clear"></div>

        ');



    Jaguar::css()->addCss('http://boobs.webriders.com.ua/css/body.css');
    Jaguar::css()->addCssInline('
    .siski{
        overflow:visible;
        position:relative;
        height:280px;
        margin:0;
        padding-top:70px;
        position:relative;
        width:400px;
    }
    .siski h1{
        position:absolute;
        top:1px;
        font-family:\'Furore\',sans-serif;
        font-size:2em;
        line-height:1;
        text-shadow:2px 2px 0 #D3D3D3;
    }
    ');
    Jaguar::js()->addJs('http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js');
    Jaguar::js()->addJs('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js');
    Jaguar::js()->addJs('http://boobs.webriders.com.ua/js/body.js');
?>