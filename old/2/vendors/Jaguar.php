<?
class Jaguar{
    /**
     *
     * @return Jaguar_Css
     */
    static function css(){
        static $css;
        if(!$css){
            $css = new Jaguar_Css();
            $css->_domain_static = 'http://'.$_SERVER['HTTP_HOST'];
        }
        return $css;
    }



    /**
     *
     * @return Jaguar_View
     */
    static function view($tpl=null){
        static $view;
        if(!$view){
            $view = new Jaguar_View($tpl);
        }
        return $view;
    }



    /**
     * Реализация паттерна Singleton
     *
     * @return Jaguar_Js
     */
    static function js(){
        static $js;
        if(!$js){
            $js = new Jaguar_Js();
        }
        return $js;
    }
}
?>