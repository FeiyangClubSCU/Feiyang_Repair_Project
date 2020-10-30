<?php
/*------------------------------------------------------------*/
$posts = $_GET;$get_status_path = dirname(dirname(__FILE__));
include        $get_status_path.'/../module/database.php';
/*-------------------------------------------------------------
              查询用户禁止报修状态和系统是否空闲
提供：
    seid:会话编号
    pnum:手机号码
返回：
    0-用户可以报修
    1-系统禁止用户
    2-系统报修已满
    3-当前仅限会员
---------------------------------------------------------------*/
$get_status_seid = $posts['seid'];    //获取会话号码
$get_status_pnum = $posts['pnum'];    //获取手机号码
$get_status_user=db_alls('fy_users'); //获取用户数据 
if(db_getc("fy_confs","name","Global_Flag","data")==0
 ||db_getc("fy_datas","name","flag"       ,"data")==1)
  echo 2;
else
    while($get_status_last==0 &&
          $get_status_row1=$get_status_user->fetch_assoc()){
        if( $get_status_row1['pnum'] == $get_status_pnum    
         && $get_status_row1['seid'] == $get_status_seid){
            if($get_status_row1['vips']==1)
                echo $get_status_row1['bans'];
            else{
                if(db_getc("fy_datas","name","flag","data")==2
                 ||db_getc("fy_confs","name","Global_Flag","data")==2)
                    echo 3;
                else{
                    echo $get_status_row1['bans'];
                }
            }
        }
    }
?>