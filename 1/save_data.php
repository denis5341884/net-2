<?php 

require_once('HTML/QuickForm.php'); 
$form = new HTML_QuickForm('mainForm', 'post'); 


$eee=array();
$data = $_POST['text_field'];
//$data = implode(",",$data);

$eee['s']='sssssss';
$eee['d']='ddddddd';
$eee['e']='eeeeeee';
$eee['f']='fffffff';

$data['ar']=$eee;

//var_dump($data);
//echo('ddddddd');
var_dump(json_encode($data));
?>

