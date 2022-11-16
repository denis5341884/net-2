<?php
$user_info = array();     
$user_info[] = array (
  'fio' => 'Иванов Сергей',
  'birthday' => '09.03.1975'
);
$user_info[] = array (
  'fio' => 'Петров Алексей',
  'birthday' => '18.09.1983'
);
echo json_encode($user_info);

?>