<?php
$posts = $_GET;
$get_status_seid = $posts['seid'];  //获取会话号码
$get_status_pnum = $posts['pnum'];  //获取手机号码
$get_status_path = dirname(dirname(__FILE__));
include $get_status_path.'/../module/database.php';
include $get_status_path.'/../module/sendtext.php';

/*----------------------------------------------------------------------------------

                                   *确认维修完成*
                                  Code By Pikachu
                                     OCT01/2020
                                     
                          输入：x.php?seid=<会话编号>
                                     &pnum=<用户手机>
                          输出：0-失败,1-成功
----------------------------------------------------------------------------------*/
$get_status_flag = 0;
$get_status_user=db_alls('fy_users'); //获取用户表
while($get_status_row1=$get_status_user->fetch_assoc()){
    //echo "111111~";
    //echo $get_status_row1['pnum']."   ".$get_status_pnum."   ";
    //echo $get_status_row1['seid']."   ".$get_status_seid;
    if( $get_status_row1['pnum'] == $get_status_pnum        //查询用户登录信息
     && $get_status_row1['seid'] == $get_status_seid){
        //db_putc("fy_users","pnum",$get_status_row1['pnum'],"flag",0);
        //db_putc("fy_order","urid",$get_status_row1['id']  ,"flag",$posts['type']);
        db_putc("fy_order","tbid",$posts['tbid'],"flag",$posts['type']);
        db_putc("fy_order","tbid",$posts['tbid'],"wcsj","\"".date("Y-m-d h:i:s",time())."\"" );
        db_putc("fy_staff","wxid",db_getc("fy_order","tbid",$posts['tbid'],"wxid"),"flag",1);
        db_putc("fy_users","wxid",db_getc("fy_order","tbid",$posts['tbid'],"wxid"),"flag",0);
        db_putc("fy_users",  "id",db_getc("fy_order","tbid",$posts['tbid'],"urid"),"flag",0);
        //------------------------------------------------------------------------------------------------------
        $exc_minute_end_jgdh=db_getc("fy_users","wxid",db_getc("fy_order","tbid",$posts['tbid'],"wxid"),"pnum");
        $exc_minute_end_jgmz=db_getc("fy_users","wxid",db_getc("fy_order","tbid",$posts['tbid'],"wxid"),"name");
        $exc_minute_end_yhdh=db_getc("fy_users",  "id",db_getc("fy_order","tbid",$posts['tbid'],"urid"),"pnum");
        $exc_minute_end_yhmz=db_getc("fy_users",  "id",db_getc("fy_order","tbid",$posts['tbid'],"urid"),"name");
        $exc_minute_end_yh_time=db_getc("fy_order","tbid",$posts['tbid'],"time");
        $exc_minute_end_jg_time=db_getc("fy_order","tbid",$posts['tbid'],"jdsj");
        if($posts['type']==2)$exc_minute_end_wcsm="用户确认维修完成";
        if($posts['type']==3)$exc_minute_end_wcsm="用户放弃本次维修";
        if($posts['type']==4)$exc_minute_end_wcsm="技术人员确认完成";
        dx_send(6,"+86".$exc_minute_end_yhdh,
                        $exc_minute_end_yhmz."\",\"".$exc_minute_end_yh_time."\",\"".$exc_minute_end_wcsm."\"");
        dx_send(5,"+86".$exc_minute_end_jgdh,
                        $exc_minute_end_jgmz."\",\"".$exc_minute_end_jg_time."\",\"".$exc_minute_end_wcsm."\"");
        //echo "[".date("Y-m-d h:m:s")."] "."[飞扬维修]强制关闭订单：".$exc_minute_row1['tbid']."<br />\n";
        //echo "----------------------tbid:---------------------".$posts['tbid'].db_getc("fy_order","tbid",$posts['tbid'],"wxid");
        //echo "----------------------type:---------------------".$posts['type'].db_getc("fy_order","tbid",$posts['tbid'],"urid");
        $get_status_flag = 1;echo "1";break;
    }
}
if($get_status_flag!=1) echo "0";
?>