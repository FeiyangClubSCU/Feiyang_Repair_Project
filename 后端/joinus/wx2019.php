<?php
$name=$majo=$sexs=$leve=$pnum=$pmai=$text="";
$name = $_GET["name"];
$majo = $_GET['majo'];
$sexs = $_GET['sexs'];
$leve = $_GET['leve'];
$pnum = $_GET['pnum'];
$pmai = $_GET['pmai'];
$text = $_GET['text'];
$hous = $_GET['hous'];
$flor = $_GET['flor'];
$name = str_replace("\"","'",$name);
$sexs = str_replace("\"","'",$sexs);
$leve = str_replace("\"","'",$leve);
$majo = str_replace("\"","'",$majo);
$pnum = str_replace("\"","'",$pnum);
$pmai = str_replace("\"","'",$pmai);
$text = str_replace("\"","'",$text);
$hous = str_replace("\"","'",$hous);
$flor = str_replace("\"","'",$flor);

$data = 
   "\"".$name."\","
  ."\"".$sexs."\","
  ."\"".$leve."\","
  ."\"".$majo."\","
  ."\"".$pnum."\","
  ."\"".$pmai."\","
  ."\"".$hous."\","
  ."\"".$flor."\","
  ."\"".$text."\""
  ."\r\n";

$file = fopen("wx2019.csv", "a+");

while(true){
if(flock($file, LOCK_EX)){
  fwrite($file, 
         mb_convert_encoding($data,
                             'UTF-8',
                             mb_detect_encoding($data) ) );
  fflush($file);            // flush output before releasing the lock
  flock($file, LOCK_UN);    // 释放锁定
  break;
  }
}
fclose($file);
header('Location: postok.html');
exit;
?>