<?php
$posts = $_POST;
$get_verify_text = $posts['text'];
$get_verify_pnum = $posts['pnum'];
$get_verify_seid = $posts['seid'];
$get_verify_ssid = $posts['ssid'];
$get_verify_flag = 0;
$get_verify_path = dirname(dirname(__FILE__));
include $get_verify_path.'/../module/getnewid.php';
/*----------------------------------------------------------------------------------

                                   *写入问题回答*
                                  Code By Pikachu
                                     OCT01/2020
                                     
                          输入：x.php?ssid=<问题标识符>
                                     &seid=<回答人会话>
                                     &pnum=<回答人手机>
                                     &text=<回答的问题>
                          输出：0-失败，1-成功
                          注意：问题文字不能超过1000字
----------------------------------------------------------------------------------*/
$get_verify_user=db_alls('fy_users'); //获取用户表
while($get_verify_row1=$get_verify_user->fetch_assoc()){
    if( $get_verify_row1['pnum'] == $get_verify_pnum       //查询用户登录信息
     && $get_verify_row1['seid'] == $get_verify_seid){
        $get_verify_name= $get_verify_row1['name'];
        db_putc("fy_infos","ssid",$get_verify_ssid,"text","'".$get_verify_text."'");
        db_putc("fy_infos","ssid",$get_verify_ssid,"urid","'".$get_verify_row1['id']."'");
        db_putc("fy_infos","ssid",$get_verify_ssid,"ansd",1);
        $get_verify_flag = 1;
        break;
    }
}
echo $get_verify_flag;