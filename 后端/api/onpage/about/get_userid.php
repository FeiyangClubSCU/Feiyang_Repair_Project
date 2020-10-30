<?php
$posts = $_GET;
$get_status_seid = $posts['seid'];  //获取会话号码
$get_status_pnum = $posts['pnum'];  //获取手机号码
$get_status_path = dirname(dirname(__FILE__));
include $get_status_path.'/../module/database.php';
/*-------------------------------------------------------------
              查询用户是不是用户和是不是技术员和会员
链接：          
    /api/onpage/about/get_userid.php
提供：
    seid:会话编号
    pnum:手机号码
返回：
    0-技术人员
    1-一般用户
    2-会员用户
---------------------------------------------------------------*/
$get_status_fixs = 0;
$get_status_flag = 0;
$get_status_last = 0;
$get_status_outp = 0;
$get_status_user=db_alls('fy_users'); //获取用户表
$get_status_orde=db_alls('fy_order'); //获取订单表
while($get_status_last==0 &&
      $get_status_row1=$get_status_user->fetch_assoc()){
    if( $get_status_row1['pnum'] == $get_status_pnum       //查询用户登录信息
     && $get_status_row1['seid'] == $get_status_seid){
        $get_status_flag =1;
        if($get_status_row1['fixs']==0)$get_status_fixs=1;
        else                           $get_status_fixs=0;
        if($get_status_fixs==1 
       and $get_status_row1['vips']==1)$get_status_fixs=2;
        $get_status_json =  json_encode(array(  'name'=>$get_status_row1['name'],
                                                'mail'=>$get_status_row1['mail'],
                                                'txtp'=>$get_status_row1['txtp'],
                                                'fixs'=>$get_status_fixs,
                                                'pnum'=>$get_status_row1['pnum']
                                            ),JSON_UNESCAPED_UNICODE);
                $get_status_flag=1;
                $get_status_istp=1;
                echo $get_status_json;
                break;
    }
}
if($get_status_flag!=1) echo "0";
?>