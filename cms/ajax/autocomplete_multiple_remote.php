<?
    $term = isset($_GET['term']) ? trim(strip_tags($_GET['term'])) : '';
    if(!$term) die('[]');
    $f = get_defined_functions();
    $values = $f['internal'];
    $result = array();
    foreach ($values as $k=>$v){
        //ограничим список функций первой сотней
        if($k>100) break;
        if(strpos(strtolower($v), strtolower($term))===false) continue;
        $o = new stdClass();
        $o->id = $k;
        $o->value = $o->lavel = $v;
        $result[] = $o;
    }
    print json_encode($result);
?>