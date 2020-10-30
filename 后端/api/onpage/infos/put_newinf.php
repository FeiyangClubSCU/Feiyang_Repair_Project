<?php
$posts = $_GET;
$get_verify_text = $posts['text'];
$get_verify_pnum = $posts['pnum'];
$get_verify_seid = $posts['seid'];
$get_verify_flag = 0;
$get_verify_path = dirname(dirname(__FILE__));
include $get_verify_path.'/../module/getnewid.php';
/*----------------------------------------------------------------------------------

                                   *新增问题信息*
                                  Code By Pikachu
                                     OCT01/2020
                                     
                          输入：x.php?seid=<提问人会话>
                                     &pnum=<提问人手机>
                                     &text=<提问的内容>
                          输出：0-失败，1-成功
                          注意：提问文字不能超过1000字
----------------------------------------------------------------------------------*/
$get_verify_user=db_alls('fy_users'); //获取用户表
while($get_verify_row1=$get_verify_user->fetch_assoc()){
    if( $get_verify_row1['pnum'] == $get_verify_pnum       //查询用户登录信息
     && $get_verify_row1['seid'] == $get_verify_seid){
        $get_verify_name= $get_verify_row1['name'];
        $get_verify_info=id_new_infos();
        $get_verify_temp=
         "INSERT INTO fy_infos ("
         //标识区域
         ."ssid,urid,wzbt,twid"
         //--------
         .") VALUES ("
         //数据区域
         ."\""
         .$get_verify_info
         ."\""
         .","
         ."\""
         ."2020000000"
         ."\""
         .","
         ."\""
         .$get_verify_text
         ."\""
         .","
         ."\""
         .$get_verify_row1['id']
         ."\""
         .")";
         //echo $get_verify_temp;
         $get_verify_flag = 1;
         db_exec($get_verify_temp);
         break;
    }
}
echo $get_verify_flag;