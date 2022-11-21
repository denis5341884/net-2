<?
class jQuickForm extends HTML_QuickForm2{
    static $element_templates = array();

    static function logElementTemplate($element, $template){
        self::$element_templates[] = '<fieldset><legend>'.$element.'</legend>'.$template.'</fieldset>';
    }

    public function __construct($id, $method = 'post', $attributes = null, $trackSubmit = true){
        HTML_Common2::setOption('charset','UTF-8');
        parent::__construct($id, $method, $attributes, $trackSubmit);
    }

    /**
     * Установить маску для поля по его идентификатору
     *
     * use: jQuickform::jqfMask('phone','(999) 999-9999');
     *
     * use: jQuickform::jqfMask('phone','(999) 999-9999','Телефон');
     *
     * use: jQuickform::jqfMaskDefinition('~','+-');
     *      jQuickform::jqfMask('code','~9.99 ~9.99 999');
     *
     * @param string $id
     * @param string $mask
     */
    function jqfMask($name, $mask,$placeholder=null){
        Jaguar::js()->needJqueryMask();
        $elements = $this->getElementsByName($name);
        foreach ($elements as $e){
            $id = $e->getId();
            Jaguar::js()->addJsOnload('jQuery("#'.$id.'").mask("'.$mask.'"'.((!is_null($placeholder)) ? ',{placeholder:"'.$placeholder.'"}':'').');');
        }
    }

    /**
     * Задать mask definition
     *
     * use: jQuickform::jqfMaskDefinition('~','+-');
     *
     * @param unknown_type $name
     * @param unknown_type $value
     */
    function jqfMaskDefinition($name, $value){
        Jaguar::js()->needJqueryMask();
        Jaguar::js()->addJsOnload('jQuery.mask.definitions["'.$name.'"]="['.$value.']"');
    }


    function __toString(){
        require_once 'HTML/QuickForm2/Renderer.php';
        $renderer = $this->render(HTML_QuickForm2_Renderer::factory('default'));
        $script   = $renderer->getJavascriptBuilder()->getFormJavascript($this->getId(),false);
        if($script){
            Jaguar::js()->addJsInline($script);
            Jaguar::js()->addJsInline(
            '
qf.validator.prototype.oninvalid = function(errorMap){
    jQuery("span.jqf_error").text("").hide();
    jQuery("div.jqf_error").removeClass("jqf_error");
    for(var i in errorMap._map) {
        jQuery("#"+i).parent().parent().addClass("jqf_error");
        jQuery("#jqferr-"+i).text(errorMap._map[i]).show();
//        alert("#jqferr-"+i);
    }
};
            ','onload_'.$this->getId()
            );
        }
        return $renderer->__toString();
    }


}
?>