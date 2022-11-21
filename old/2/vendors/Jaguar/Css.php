<?
class Jaguar_Css{
    /**
     * Подключаемые css-файлы
     *
     * @var string
     */
    public $css;




    public $jquery_ui_theme='overcast';



    /**
     * Для возможности изменения домена для раздачи статики
     *
     * @var string
     */
    public $_domain_static;



    /**
     * Используемый inline CSS
     *
     * @var string
     */
    public $css_inline;



    public $_is_min = true;
    public $conditions = array();



    /**
     * Подключение CSS-файла
     *
     * @param string $css_inline
     * @return Css
     */
    function addCss($css_file, $condition=null){
        $this->css[$css_file] = $condition;
        return $this;
    }



    /**
     * Подключение inline CSS
     *
     * @param string $css_inline
     * @return Css
     */
    function addCssInline($css_inline){
        $this->css_inline[$css_inline] = $css_inline;
        return $this;
    }






    protected function minify($v){
        $v = trim($v);
        $v = str_replace("\r\n", "\n", $v);
        $search = array("/\/\*[\d\D]*?\*\/|\t+/", "/\s+/", "/\}\s+/");
        $replace = array(null, " ", "}\n");
        $v = preg_replace($search, $replace, $v);
        $search = array("/\\;\s/", "/\s+\{\\s+/", "/\\:\s+\\#/", "/,\s+/i", "/\\:\s+\\\'/i", "/\\:\s+([0-9]+|[A-F]+)/i");
        $replace = array(";", "{", ":#", ",", ":\'", ":$1");
        $v = preg_replace($search, $replace, $v);
        $v = str_replace("\n", null, $v);
        return $v;
    }


    protected function makeFileName() {
        $file_name = md5($this->_domain_static.serialize($this->css));
        return 'css/'.substr($file_name, 0, 1).'/'.substr($file_name, 1, 1).'/'.$file_name.'.css';
    }


//    function loadCss(){
//        $inline = '';
//        if(count($this->css_inline)){
//            $inline = implode("\n",$this->css_inline);
//            if($this->_is_min){
//                $inline = $this->minify($inline);
//            }
//            $inline = "\n<style type=\"text/css\">\n".$inline."\n</style>";
//        }
//
//    }


    function needJqueryUi(){
        $this->addCss('/vendors/jquery/ui/css/'.$this->jquery_ui_theme.'/jquery-ui.css');
    }


    function getCss(){
        if(!count($this->css)) return '123';
        $css_code = '';
        foreach ($this->css as $css=>$condition) {
            $css_code .='        '.($condition ? '<!--['.$condition.']>':'').'<link rel="stylesheet" href="'.$css.'" media="all" type="text/css" />'.($condition ? '<![endif]-->':'')."\n";
        }
        return $css_code;
    }


    function getCssInline(){
        if(!count($this->css_inline)) return '';
        return '<style type="text/css">'.(implode('
',$this->css_inline)).'
</style>';

    }
}
?>