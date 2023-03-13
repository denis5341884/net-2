<?php
$obj = json_decode($_POST["x"], false);
//var_dump($obj);
$myObj->name = "John";
$myObj->age = 30;
$myObj->city = "New York";

echo json_encode($myObj);
?>