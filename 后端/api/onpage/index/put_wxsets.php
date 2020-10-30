<?php
/*----------------------------------------
        设置技术人员自定义参数信息
提供：
    seid:会话编号
    pnum:手机号码
    next:下次天数
    aval:是否接单
    qqky:QQ号使用
    qqid:QQ号内容
    sets:保留参数
返回：
    0-成功
    1-失败
----------------------------------------*/
$posts = $_GET;
$get_status_path = dirname(dirname(__FILE__));
include $get_status_path.'/../module/database.php';
$get_status_flag = 1;
$get_status_seid = $posts['seid'];    //获取会话号码
$get_status_pnum = $posts['pnum'];    //获取手机号码
$get_status_user=db_alls('fy_users'); //获取用户数据
/*
if(db_getc("fy_confs","name","Global_Flag","data")==0
 ||db_getc("fy_datas","name","flag"       ,"data")==1)
    return 2;
*/
while($get_status_last==0 &&
      $get_status_row1=$get_status_user->fetch_assoc()){
    if( $get_status_row1['pnum'] == $get_status_pnum    
     && $get_status_row1['seid'] == $get_status_seid){
            db_putc("fy_staff","urid",$get_status_row1["id"],"next",$posts['next']);
            db_putc("fy_staff","urid",$get_status_row1["id"],"aval",$posts['aval']);
            db_putc("fy_staff","urid",$get_status_row1["id"],"qqky",$posts['qqky']);
            db_putc("fy_staff","urid",$get_status_row1["id"],"qqid",$posts['qqid']);
            db_putc("fy_staff","urid",$get_status_row1["id"],"sets",$posts['sets']);
        $get_status_flag = 0;
    }
}
echo $get_status_flag;
?>