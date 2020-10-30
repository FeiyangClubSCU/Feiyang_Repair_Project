<?php
/*----------------------------------------
        查询技术人员自定义参数信息
提供：
    seid:会话编号
    pnum:手机号码
返回：json
    next-下一次天数
    aval-是否开接单
    qqky-是否用QQ号
    qqid-QQ号的内容
    sets-保留的参数
----------------------------------------*/
$posts = $_GET;
$get_status_path = dirname(dirname(__FILE__));
include $get_status_path.'/../module/database.php';
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
        $get_status_json = json_encode(array(
            "next"=>db_getc("fy_staff","urid",$get_status_row1["id"],"next"),
            "aval"=>db_getc("fy_staff","urid",$get_status_row1["id"],"aval"),
            "qqky"=>db_getc("fy_staff","urid",$get_status_row1["id"],"qqky"),
            "qqid"=>db_getc("fy_staff","urid",$get_status_row1["id"],"qqid"),
            "sets"=>db_getc("fy_staff","urid",$get_status_row1["id"],"sets"),
        ),JSON_UNESCAPED_UNICODE);
        echo $get_status_json;
        break;
    }
}
?>