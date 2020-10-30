<?php
$posts = $_GET;
$get_status_flag=0;
$get_status_istp=0;
$get_status_path = dirname(dirname(__FILE__));
include $get_status_path.'/../module/database.php';
/*----------------------------------------------------------------------------------

                             *获取当前没回答的问题列表*
                                  Code By Pikachu
                                     OCT01/2020
                                     
                          输入：x.php
                          输出：0-失败,否则是问题列表
----------------------------------------------------------------------------------*/
$get_status_info=db_alls('fy_infos');
$get_status_user=db_alls('fy_users');
while($get_status_row1=$get_status_info->fetch_assoc()){
    if($get_status_row1['ansd']==0){
        $get_status_name=$get_status_fixs=$get_status_txtp='0';
        while($get_status_row2=$get_status_user->fetch_assoc()){
            if($get_status_row2['id']==$get_status_row1['twid']){
                $get_status_name=$get_status_row2['name'];
                $get_status_fixs=$get_status_row2['fixs'];
                $get_status_txtp=$get_status_row2['txtp'];
            }
        }
        if($get_status_istp!=0)echo "`";
        $get_status_tstr=str_replace("\r\n", '', $get_status_row1['text']);
        $get_status_json =  json_encode(array('ssid'=>$get_status_row1['ssid'],
                                                  'wzbt'=>$get_status_row1['wzbt'],
                                                  'date'=>$get_status_row1['date'],
                                                  'cont'=>$get_status_row1['cont'],
                                                  'good'=>$get_status_row1['good'],
                                                  'ansd'=>$get_status_row1['ansd'],
                                                  'name'=>$get_status_name,
                                                  'fixs'=>$get_status_fixs,
                                                  'text'=>$get_status_tstr,
                                                  'txtp'=>$get_status_txtp
                                                 ),JSON_UNESCAPED_UNICODE);
        $get_status_flag=1;$get_status_istp=1;
        echo $get_status_json;
    }
}
if($get_status_flag!=1) 
    echo "0";
?>