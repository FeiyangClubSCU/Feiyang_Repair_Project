<?php
/*-------------获取短信验证码-------------
		用法：x.php?pnum=xxxxxxxxxxxxx
		返回：1-发送成功，0-系统错误
----------------------------------------*/
$get_pncode_flag=0;
$get_status_rand=rand(1000, 9999);
$get_pncode_pnum=$_GET['pnum'];
$get_pncode_path = dirname(dirname(__FILE__));
//include $get_pncode_path.'/../module/database.php';
include $get_pncode_path.'/../module/sendtext.php';
include $get_pncode_path.'/../module/getnewid.php';
      $get_pncode_arryls=db_alls('fy_users');
while($get_pncode_rowsls=$get_pncode_arryls->fetch_assoc())
    if( $get_pncode_rowsls['pnum']==$get_pncode_pnum)
        $get_pncode_flag=1;
if ($get_pncode_flag==0){
    $get_status_newi=id_new_users();
    $get_status_temp=
     "INSERT INTO fy_users"
    ." (id,pnum,code,txtp) VALUES ("
    .$get_status_newi.","
    .$get_pncode_pnum.","
    .$get_status_rand.","
    ."\""
    ."0.png"
    ."\""
    .")";
    db_exec($get_status_temp);
    }
else{
     $get_status_temp="UPDATE fy_users SET code="
    .$get_status_rand." WHERE pnum="
    .$get_pncode_pnum;
    db_exec($get_status_temp);}
    dx_send(1,"+86".$get_pncode_pnum,$get_status_rand."\"");
?>
