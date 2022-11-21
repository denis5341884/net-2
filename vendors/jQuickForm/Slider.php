<?
class jQuickForm_Slider extends HTML_QuickForm2_Element_InputText {


    public function setValue($value){
        Jaguar::js()->addJsOnload('
jQuery("#'.$this->getId().'_jqfslider").slider( "value" , '.$value.' );
        ');
        return parent::setValue($value);
    }

}
?>