<?php
/*-------------获取维修须知内容-------------
		用法：web_requests_get
		返回：整张表内容db->form
----------------------------------------*/
include '../../module/database.php';
      $get_notice_tocken=$_GET["tocken"];
	echo db_getc("fy_confs","name","Global_Tips","data");
?>