<?
function jaguar_debug_backtrace($show=false){
    $data = '';
    foreach( debug_backtrace() as $trace){
        $file     = isset($trace['file'])
        ? $trace['file']
        : 'no file (eval/obfuscate/lambda function)';
        $line     = isset($trace['line'])
        ? $trace['line']
        : 'no line (eval/obfuscate/lambda function)';
        $function = isset($trace['function']) ? '<span style="color: rgb(0, 0, 187);">'.htmlspecialchars($trace['function']).'</span>' : 'no function';
        $class    = isset($trace['class'])    ? '<span style="color: rgb(0, 0, 187);">'.htmlspecialchars($trace['class']).'</span>'    : '';
        $type     = isset($trace['type'])     ? '<span style="color: rgb(0, 0, 187);">'.htmlspecialchars($trace['type']).'</span>'     : '';
        $file = htmlspecialchars($file);
        $data .= '--------------------------------------------------------------------------------
';
        $data .= '
<span style="color: rgb(0, 0, 0);"><strong>'.str_pad('['.$line.']', 5).'</strong> '.str_replace($_SERVER['DOCUMENT_ROOT'],'...',$file).'</span>
';

        if($class){
            $data .= $class.$type.$function.'(';
        } else {
            $data .= $function.'(';
        }
        if(isset($trace['args'])&& is_array($trace['args']) && count($trace['args'])){
            $data .= '<span style="color: rgb(221, 0, 0);">';
            if(1==count($trace['args'])){
                if(is_scalar($trace['args'][0])){
                    $data .= htmlspecialchars($trace['args'][0]);
                } else {
                    $data .= htmlspecialchars(gettype($trace['args'][0]));
                }
            } else {
                $data .= '
';
                $i=1;
                foreach ($trace['args'] as $arg) {
                    if(is_scalar($arg)){
                        $data .= '   '.$i.') '.htmlspecialchars($arg).'
';
                    } else {
                        $data .= '   '.$i.') '.htmlspecialchars(gettype($arg)).'
';
                    }
                    $i++;
                }
            }
            $data .= '</span>';
        }
        $data .= ');
';

    }
    if($show){
        print '<pre style="font-family:Tahoma">';
        print $data;
        print '</pre>';
    }
    return $data;
}
?>