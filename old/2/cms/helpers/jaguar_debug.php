<?
function jaguar_debug($var='',$name='JaquarDebug',$need_print=true){
    static $item_number;
    if(!isset($item_number)){
        $item_number=0;
    }
    $item_number++;
    $vTraceStr = '<pre>'.jaguar_debug_backtrace().'</pre>';
    $debug_message = '<style>pre{margin:0;padding:0;}</style>';
    $debug_message .= '<div style="font-size:12px;-moz-border-radius:10px;color:#FF0033;margin:5px auto;margin-bottom:10px;padding:10px;font-family:Verdana;background-color:#fceaee;border:1px solid #FF7C00;line-height:1.3em;overflow:auto;">';
    //заголовок
    if('array'==gettype($var)){
        $title = 'array('.jaguar_plural(count($var),'элемент','элемента','элементов').')';
    } else {
        $title = (gettype ($var));
    }
    $debug_message .= '<h3 style="display:inline;margin:0;padding:0;text-align:center;color:#0180DA" onclick="javascript:var debug_inf=getElementById(\'debug_'.($item_number).'\');debug_inf.style.display=(debug_inf.style.display==\'none\')?\'block\':\'none\';">'.$name.' ('.$title.') &raquo;</h3>';
    //обертка содержимого
    $debug_message .= '<div style="margin:0;padding:0;display:'.(!is_scalar($var)?'none':'block').'" id="debug_'.($item_number).'">';
    $debug_message .= '<div style="margin:0;padding:0;"><a style="display:inline;color:#666666"></a>';
    $debug_message .= '<fieldset style="-moz-border-radius:10px;margin-top:5px;color:#999999"><legend onclick="javascript:var debug_files=getElementById(\'debug_files_'.($item_number).'\');debug_files.style.display=(debug_files.style.display==\'none\')?\'block\':\'none\';">Подключаемые файлы (кликни, чтобы открыть блок)</legend><div id="debug_files_'.($item_number).'" style="display:none;">'.$vTraceStr.'</div></fieldset></div>';
    $value = (!is_bool($var)) ? print_r($var,1) : ($var ? 'TRUE':'FALSE');
    $debug_message .= "<div style=\"padding:5px 0 0 20px;border-left:3px solid #FF7C00;margin:5px 0;\"><pre>".$value."</pre></div>";
    //обертка содержимого
    $debug_message .= '</div>';

    $debug_message .= '<div style="clear:both;"></div></div>';
    if($need_print){
        print $debug_message;
    }
    return $debug_message;
}


?>