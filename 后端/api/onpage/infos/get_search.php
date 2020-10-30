<?php
$posts = $_GET;
$get_status_flag=0;
$get_status_init=0;
$get_status_istp=0;
$get_status_tips = '';
$get_status_tips = $posts['tips'];
$get_status_path = dirname(dirname(__FILE__));
include $get_status_path.'/../module/database.php';
/*----------------------------------------------------------------------------------

                                   *搜索问题列表*
                                  Code By Pikachu
                                     OCT01/2020
                                     
                          输入：x.php?tips=<问题关键字>
                          输出：0-失败,否则是问题列表
----------------------------------------------------------------------------------*/
$get_status_info=db_alls('fy_infos'); //获取用户表
while($get_status_row1=$get_status_info->fetch_assoc()){
    if($get_status_row1['ansd']==1){
        $get_status_full=$get_status_row1['tips'];
        $get_status_name=db_getc("fy_users","id",$get_status_row1['urid'],"name");
        $get_status_fixs=db_getc("fy_users","id",$get_status_row1['urid'],"fixs");
        $get_status_txtp=db_getc("fy_users","id",$get_status_row1['urid'],"txtp");
        if($posts['tips']==''){
            if($get_status_istp!=0)echo "`";
            $get_status_init=$get_status_init+1;
            $get_status_tstr=str_replace("\r\n", '', $get_status_row1['text']);
            $get_status_json =  json_encode(array('ssid'=>$get_status_row1['ssid'],
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
            $get_status_istp=1;
            echo $get_status_json;
            continue;
        }
        if($get_status_init==5){$get_status_flag=1;break;}
        if($get_status_tips!=''){
            $get_status_part=explode(" ",$get_status_full);
            foreach ($get_status_part as &$get_status_temp){
                if(!empty($get_status_temp)&&strstr($get_status_tips,$get_status_temp)!=false){
                    if($get_status_istp!=0)echo "`";
                    $get_status_tstr=str_replace("\r\n", '', $get_status_row1['text']);
                    $get_status_json =  json_encode(array('ssid'=>$get_status_row1['ssid'],
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
                    $get_status_istp=1;
                    echo $get_status_json;
                    break;
                }
            }
        }
    }
    
}

if($get_status_flag!=1) echo "0";
?>