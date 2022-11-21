<?
class Jaguar_View{
    public $vars = array();
    public $template = '';
    protected $reg_vars = '|([\{]+)([\w]+)([\}]+)|U';
    function __construct($template){
        $this->template = file_get_contents($template);
        //нормализация шаблона - переведем все переменные шаблона в нижний регистр
        preg_match_all($this->reg_vars,$this->template,    $out, PREG_PATTERN_ORDER);
        foreach ($out[0] as $k=>$var) {
        	$this->template = str_replace($var, strtolower($var), $this->template);
        }
    }
    function setVar($name, $value){
        $name = strtolower($name);
        $this->vars[$name][] = $value;
    }
    function getVar($name){
        $name = strtolower($name);
        if(isset($this->vars[$name])){
            return implode('', $this->vars[$name]);
        }
        return '';
    }
    function toLower(&$item, $key){
        $item = strtolower($item);
    }
    function parse(){
        $vars = array();
        foreach ($this->vars as $k=>$v){
            $this->template = str_replace('{'.strtolower($k).'}',$this->getVar($k),$this->template);
        }
        $this->template = preg_replace($this->reg_vars, '', $this->template);
        return $this->template;
    }
}
?>