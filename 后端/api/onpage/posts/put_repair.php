<?php
$posts = $_GET;
include $get_verify_path.'/../module/getnewid.php';
include $get_verify_path   .'/module/sendtext.php';
$get_verify_seid = $posts['seid'];  //获取会话号码
$get_verify_pnum = $posts['pnum'];  //获取手机号码
$get_verify_path = dirname(dirname(__FILE__));
/*----------------------------------------------------------------------------------

                                   *提交维修表单*
                                  Code By Pikachu
                                     OCT01/2020
                                     
                          功能：小程序端的维修表单写进系统
----------------------------------------------------------------------------------*/
$get_verify_fixs ="";
$get_verify_flag ="";
$get_verify_flag =0;

      $get_verify_arryls=db_alls('fy_users');
while($get_verify_rowsls=$get_verify_arryls->fetch_assoc()){
    if( $get_verify_rowsls['pnum']==$get_verify_pnum && $get_verify_rowsls['seid'] == $get_verify_seid){
        $get_verify_flag=1;
        $get_verify_newi=id_new_order();
         $get_status_temp=
         "INSERT INTO fy_order ("
         //标识区域
         ."tbid,pnum,urid,gmsj,sbzl,dnpp,dnxh,wxsm,wxtp,bxzt,gzlx,qqid"
         //--------
         .") VALUES ("
         //数据区域
         //订单id
         .$get_verify_newi
         .","
         //手机号
         .$posts['pnum']
         .","
         //用户id
         .$get_verify_rowsls['id']
         .","
         ."\""
         .$posts['gmsj']
         ."\""
         .","
         ."\""
         .$posts['sblx']
         ."\""
         .","
         ."\""
         .$posts['dnpp']
         ."\""
         .","
         ."\""
         .$posts['dnxh']
         ."\""
         .","
         ."\""
         .$posts['wxsm']
         ."\""
         .","
         ."\""
         .$posts['wxtp']
         ."\""
         .","
         ."\""
         .$posts['bxzt']
         ."\""
         .","
         ."\""
         .$posts['gzlx']
         ."\""
         .","
         ."\""
         .$posts['qqid']
         ."\""
         .")";
         echo $get_status_temp;
         echo "https://fix.fyscu.com/api/module/imagesup.png/".$posts['wxtp'];
        db_exec($get_status_temp);
        db_putc("fy_users","id",$get_verify_rowsls['id'],"flag",1);
        $get_verify_pnum=db_getc("fy_users","id",$get_verify_rowsls['id'],"pnum");
        $get_verify_name=db_getc("fy_users","id",$get_verify_rowsls['id'],"name");
        $get_verify_time=date('m-d h:i', time());
        dx_send(4,"+86".$get_verify_pnum,$get_verify_name."\",\"".$get_verify_time."\"");
        break;
    }
}
if($get_verify_flag!=1) echo "1";
?>