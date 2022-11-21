<?
class jQuickForm_SliderRange extends HTML_QuickForm2_Container_Group {
    public $range_min=0;
    public $range_max=100;
    public $range_step=1;

    public function setValue($value){
        Jaguar::js()->addJsOnload('
        jQuery("#'.$this->getId().'_jqfslider").slider( "values" , '.json_encode(array_values($value)).' );
        ');
        return parent::setValue($value);
    }

    public function render(HTML_QuickForm2_Renderer $renderer){
        $name = $this->getName();
        $id   = $this->getId();
        $value = $this->getValue();
        Jaguar::js()->needJquery();
        Jaguar::js()->needJqueryUi();
        Jaguar::js()->addJsOnload('
             /*-------------- jQuickForm_SliderRange ---------------*/
            jQuery("#'.$name.'_min").change(function(){
                jQuery("#'.$this->getId().'_jqfslider").slider( "value" , jQuery(this).val() );
            });
            jQuery("#'.$id.'_jqfslider").slider({
                range: true,
                values: '.json_encode(array_values($value)).',
                min: '.$this->range_min.',
                max: '.$this->range_max.',
                step: '.$this->range_step.',
                slide: function(event, ui) {
                    jQuery("#'.$name.'_min").val(ui.values[0]);
                    jQuery("#'.$name.'_max").val(ui.values[1]);
            	},
                change: function(event, ui) {
                    jQuery("#'.$name.'_min").val(ui.values[0]);
                    jQuery("#'.$name.'_max").val(ui.values[1]);
                }
            });
             /*-------------- jQuickForm_SliderRange ---------------*/
        ');
        return parent::render($renderer);
    }
}
?>