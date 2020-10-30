<?php
/*----------------------------------------------------------------------------------

                                   *获取问题详情*
                                  Code By Pikachu
                                     OCT01/2020
                                     
                          输入：x.php?ssid=<问题编号>
                          输出：0-失败,否则是问题详情
----------------------------------------------------------------------------------*/
$posts = $_GET;
$get_status_flag=0;
$get_status_tips = $posts['ssid'];
$get_status_path = dirname(dirname(__FILE__));
include $get_status_path.'/../module/database.php';
$get_status_info=db_alls('fy_infos'); //获取用户表
while($get_status_row1=$get_status_info->fetch_assoc()){
    if($get_status_tips == $get_status_row1['ssid']){
       $get_status_name=db_getc("fy_users","id",$get_status_row1['urid'],"name");
       $get_status_fixs=db_getc("fy_users","id",$get_status_row1['urid'],"fixs");
       $get_status_txtp=db_getc("fy_users","id",$get_status_row1['urid'],"txtp");
       $get_status_tstr=str_replace("\r\n", '', $get_status_row1['text']);
       $get_status_json =  json_encode(array( 'ssid'=>$get_status_row1['ssid'],
                                              'wzbt'=>$get_status_row1['wzbt'],
                                              'date'=>$get_status_row1['date'],
                                              'cont'=>$get_status_row1['cont'],
                                              'good'=>$get_status_row1['good'],
                                              'name'=>$get_status_name,
                                              'fixs'=>$get_status_fixs,
                                              'text'=>$get_status_tstr,
                                              'txtp'=>$get_status_txtp
                                             ),JSON_UNESCAPED_UNICODE);
        $get_status_flag=1;
        echo $get_status_json;
        break;
    }
}

if($get_status_flag!=1) echo "0";
?>