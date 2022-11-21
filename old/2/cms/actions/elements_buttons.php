<?
    $form = new jQuickForm('simple');
    $fieldset = $form->insertFieldset('Варианты использования buttons');
    $b = $fieldset->insertButton('button','Click me!');
    //навесим на кнопку onclick и отменим действие по-умолчанию
    Jaguar::js()->addJsOnload('jQuery("#'.$b->getId().'").click(function(e){
        alert("Click!");
        e.preventDefault();
    });');
    //тоже самое, но через установку аттрибутов
    $b = $fieldset->insertButton('button','Click me!')
        ->setAttribute('onclick','alert(123);return false;');

    $fieldset = $form->insertFieldset('Варианты использования input button');
    $b = $fieldset->insertInputButton('Click me!');
    Jaguar::js()->addJsOnload('jQuery("#'.$b->getId().'").one("click",function(e){
        jQuery(this).animate({
            height: "+=50"
        }, 500, function(){
            jQuery(this).animate({
            height: "-=5",
            width: "+=100",
            }, 500);
        }
        );
    });');

 ?>