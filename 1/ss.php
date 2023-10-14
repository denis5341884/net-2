<?php
    function f_ftp ($user_Name,$user_Addr, $user_phone){
        $textL=$user_Name.';'.$user_Addr.';'.$user_phone.';';
        $otv=true;
        $ti='zakaz';
        $ras='txt';
        $filenameL = 'ftp://billing:yellow10192.168.0.187/'.$ti.'/'.uniqid().'.'.$ras;
        $handlerL = fopen($filenameL, "w");
        fwrite($handlerL,$textL);
        fclose ($handlerL);
    }

if(1==1)//$_POST)
{
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest')
        {
            $otvet_serv = json_encode(array('text' => 'Возникла ошибка при отправке данных'));
            die($otvet_serv);
        }
    if((!isset($_POST["polz_name"])) || (!isset($_POST["polz_addr"])) || (!isset($_POST["polz_tel"])))
        {
            $otvet_serv = json_encode(array('type'=>'error', 'text' => 'Заполните форму'));
            die($otvet_serv);
        }
    $user_Name = filter_var($_POST["polz_name"], FILTER_SANITIZE_STRING);
    $user_Addr = filter_var($_POST["polz_addr"], FILTER_SANITIZE_STRING);
    $user_Phone = filter_var($_POST["polz_tel"], FILTER_SANITIZE_STRING);
    if(strlen($user_Name)<3)
    {
        $otvet_serv = json_encode(array('text' => 'Поле Имя слишком короткое или пустое'));
        die($otvet_serv);
    } 
    if(!is_numeric($user_Phone))
    {
        $otvet_serv = json_encode(array('text' => 'Номер телефона может состоять только из цифр'));
        die($otvet_serv);
    }
    if(strlen($user_Addr)<3)
    {
        $otvet_serv = json_encode(array('text' => 'Поле Адрес слишком короткое или пустое'));
        die($otvet_serv);
    };
    f_ftp($user_Name,$user_Addr,$user_Phone);
    $otvet_serv = json_encode(array('text' => 'Спасибо! Ваша заявка отправлена.'));
    die($otvet_serv);
}
?>