<?php
session_start();
 // Параметр $number - сообщает число 

 // символов в пароле
$number=8;
$_POST['number']=8;
generate_password($_POST['number']);

 function generate_password($number)

 {

 $arr = array('a','b','c','d','e','f',

 'g','h','i','j','k','l',

 'm','n','o','p','r','s',

 't','u','v','x','y','z',

 'A','B','C','D','E','F',

 'G','H','I','J','K','L',

 'M','N','O','P','R','S',

 'T','U','V','X','Y','Z',

 '1','2','3','4','5','6',

 '7','8','9','0');

 // Генерируем пароль

 $passw = "";

 for($i = 0; $i < $number; $i++)

 {

 // Вычисляем случайный индекс массива

 $index = rand(0, count($arr) - 1);

 $passw .= $arr[$index];

 }
$_SESSION['passw']=$passw;
 return $passw;

 }
?>