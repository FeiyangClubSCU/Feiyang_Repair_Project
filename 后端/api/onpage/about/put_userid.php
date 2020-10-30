<?php
$posts = $_GET;
$get_verify_seid = $posts['seid'];
$get_verify_pnum = $posts['pnum'];
$get_verify_mail = $posts['mail'];
$get_verify_name = $posts['name']; 
$get_verify_txtp = $posts['txtp']; 
$get_verify_flag = 0;
$get_verify_path = dirname(dirname(__FILE__));
include $get_verify_path.'/../module/getnewid.php';
/*----------------------------------------------------------------------------------

                                   *写入用户信息*
                                  Code By Pikachu
                                     OCT01/2020
                                     
                          输入：x.php?seid=<会话编号>
                                     &pnum=<用户手机>
                                     &mail=<邮件地址>
                                     &name=<用户姓名>
                                     &txtp=<头像图片>
                          输出：0-失败，1-成功
----------------------------------------------------------------------------------*/
        $get_verify_arryls=db_alls('fy_users');
while($get_verify_rowsls=$get_verify_arryls->fetch_assoc()){
    if( $get_verify_rowsls['pnum']==$get_verify_pnum && $get_verify_rowsls['seid'] == $get_verify_seid){
        db_putc("fy_users","pnum",$get_verify_rowsls['pnum'],"name","'".$get_verify_name."'");
        db_putc("fy_users","pnum",$get_verify_rowsls['pnum'],"mail","'".$get_verify_mail."'");
        db_putc("fy_users","pnum",$get_verify_rowsls['pnum'],"init",1);
        if($get_verify_txtp!=""){
            db_putc("fy_users","pnum",$get_verify_rowsls['pnum'],"txtp","'".$get_verify_txtp."'");
        }
        $get_verify_flag=1;break;
    }    
}
if($get_verify_flag!=1) echo "1";
?>