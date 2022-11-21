<?
    $term = isset($_GET['term']) ? trim(strip_tags($_GET['term'])) : '';
    if(!$term) die('[]');
    $values = array(
        "ActionScript",
    	"AppleScript",
    	"Asp",
    	"BASIC",
    	"C",
    	"C++",
    	"Clojure",
    	"COBOL",
    	"ColdFusion",
    	"Erlang",
    	"Fortran",
    	"Groovy",
    	"Haskell",
    	"Java",
    	"JavaScript",
    	"Lisp",
    	"Perl",
    	"PHP",
    	"Python",
    	"Ruby",
    	"Scala",
    	"Scheme"
    );
    $result = array();
    foreach ($values as $k=>$v){
        if(strpos(strtolower($v), strtolower($term))===false) continue;
        $o = new stdClass();
        $o->id = $k;
        $o->value = $o->lavel = $v;
        $result[] = $o;
    }
    print json_encode($result);
?>