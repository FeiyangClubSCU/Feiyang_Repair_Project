<?php
/*-------------获取用户登录状态-------------
		用法：x.php?pnum=xxxx&seid=xxxx
		返回：1-有效登录，0-无效或不存在
----------------------------------------*/
$get_status_flag=0;
$get_status_pnum=$_GET['pnum'];
$get_status_seid=$_GET['seid'];
include '../../module/database.php';
      $get_status_arryls=db_alls('fy_users');
while($get_status_rowsls=$get_status_arryls->fetch_assoc())
    if($get_status_rowsls['pnum']==$get_status_pnum)
      if($get_status_rowsls['seid']==$get_status_seid)
          $get_status_flag=1;
  echo $get_status_flag;
	 
?>