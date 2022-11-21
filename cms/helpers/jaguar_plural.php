<?
function jaguar_plural($cnt, $form1, $form2, $form5, $need_number=1,$form0=''){
    if(!$cnt){
        if($form0) return $form0;
    }
    $n = abs($cnt) % 100;
    $n1 = $cnt % 10;
    if ($n > 10 && $n < 20) return ($need_number ? $cnt.' ' : '').$form5;
    if ($n1 > 1 && $n1 < 5) return ($need_number ? $cnt.' ' : '').$form2;
    if ($n1 == 1) return ($need_number ? $cnt.' ' : '').$form1;
    return ($need_number ? $cnt.' ' : '').$form5;
}
?>