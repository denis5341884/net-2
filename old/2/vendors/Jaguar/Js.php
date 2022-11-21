<?
class Jaguar_Js{

    public $js=array();
    public $js_inline=array();
    public $js_onload=array();


    function addJs($js){
        $this->js[$js] = $js;
    }

    function addJsInline($js, $id=null){
        if($id){
            $this->js_inline[$id] = $js;
        } else {
            $this->js_inline[] = $js;
        }
    }
    function addJsOnload($js, $id=null){
        $this->needJquery();
        if($id){
            $this->js_onload[$id] = $js;
        } else {
            $this->js_onload[] = $js;
        }
//        debug($this->js_onload);
    }

    function getJs(){
        if(!count($this->js)) return '';
        $js_code = '';
        foreach ($this->js as $js) {
        	$js_code .= '<script language="JavaScript" type="text/javascript" src="'.$js.'"></script>'."\n";
        }
        return $js_code;
    }
    function getJsInline(){
        if(!count($this->js_inline)) return '';
        $js_code = '<script language="JavaScript" type="text/javascript">';
        foreach ($this->js_inline as $js) {
        	$js_code .= $js."\n";
        }
        return $js_code.'</script>';
    }
    function getJsOnload(){
//        debug($this->js_onload,'getJsOnload');
        if(!count($this->js_onload)) return '';
        return  '<script language="JavaScript" type="text/javascript">
    jQuery(document).ready(
        function(){
'.(implode('
',$this->js_onload)).'
        }
    );
</script>
';
    }

    function needJquery(){
        $this->addJs('/vendors/jquery/jquery-1.4.2.min.js');
    }
    function needJqueryMask(){
        $this->needJquery();
        $this->addJs('/vendors/jquery/jquery.maskedinput-1.2.2.js');
    }
    function needJqueryUi(){
        $this->needJquery();
        Jaguar::css()->needJqueryUi();
        $this->addJs('/vendors/jquery/ui/jquery-ui-1.8.5.custom.min.js');
    }
}
?>