<?php
$posts = $_GET;
$get_verify_code = $posts['code'];  //获取会话号码
$get_verify_pnum = $posts['pnum'];  //获取手机号码
$get_verify_flag=0;
$get_verify_path = dirname(dirname(__FILE__));
include $get_verify_path.'/../module/database.php';
/*----------------------------------------------------------------------------------

                                   *核对短信验证码*
                                  Code By Pikachu
                                     OCT01/2020
                                     
                          输入：x.php?code=<四位数验证码>&pnum=<手机号>
                          输出：0-失败,否则是14位的随机seid用于每次验证
----------------------------------------------------------------------------------*/
      $get_verify_arryls=db_alls('fy_users');
while($get_verify_rowsls=$get_verify_arryls->fetch_assoc()){
    if( $get_verify_rowsls['pnum']==$get_verify_pnum && $get_verify_rowsls['code'] == $get_verify_code)
        $get_verify_flag=1;
        //echo $get_verify_rowsls['pnum']."   ".$get_verify_rowsls['code']."   ".$get_verify_flag."   \n";
}
//echo $get_verify_flag;
if($get_verify_flag==1){
    $get_verify_rand=rand(10000000000000, 99999999999999);
    $get_verify_temp="UPDATE fy_users SET "."seid=".$get_verify_rand." WHERE pnum=".$get_verify_pnum;
    db_exec($get_verify_temp);
    $get_verify_temp="UPDATE fy_users SET "."code='已登录' WHERE pnum=".$get_verify_pnum;
    db_exec($get_verify_temp);
    echo $get_verify_rand;
}
else echo "0";
?>