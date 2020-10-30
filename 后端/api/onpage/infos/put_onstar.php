<?php
$posts = $_GET;
$get_status_flag=0;
$get_status_tips = $posts['ssid'];
$get_status_path = dirname(dirname(__FILE__));
include $get_status_path.'/../module/database.php';
/*----------------------------------------------------------------------------------

                                   *新增问题点赞*
                                  Code By Pikachu
                                     OCT01/2020
                                     
                          输入：x.php?ssid=<问题标识符>
                          输出：0-失败，1-成功
----------------------------------------------------------------------------------*/
$get_status_info=db_alls('fy_infos'); //获取用户表
while($get_status_row1=$get_status_info->fetch_assoc()){
    if($get_status_tips == $get_status_row1['ssid']){
        $get_status_temp=  $get_status_row1['good'];
        db_putc('fy_infos',"ssid",$posts['ssid'],"good",$get_status_temp+1);
        $get_status_flag=1;
        echo "1";
        break;
    }
}

if($get_status_flag!=1) echo "0";
?>