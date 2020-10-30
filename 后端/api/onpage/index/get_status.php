<?php
$posts = $_GET;
$get_status_seid = $posts['seid'];  //获取会话号码
$get_status_pnum = $posts['pnum'];  //获取手机号码
$get_status_path = dirname(dirname(__FILE__));
include $get_status_path.'/../module/database.php';
/*----------------------------------------------------------------------------------

                                   *获取身份状态*
                                  Code By Pikachu
                                     OCT01/2020
                                     
                          输入：x.php?seid=<会话编号>
                                     &pnum=<用户手机>
                          输出：四位数，分别代表：
                                1：0-技工，1-用户
                                2：0-空闲，1-忙碌
                                3：0-用户未初始化
                                4：0-普通，1-会员
----------------------------------------------------------------------------------*/
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
        $get_status_fixs=$get_status_row1['fixs'];         //保存技工当前状态
        if($get_status_row1['fixs']=='0') echo 1;          //获取用户是否技工
        //echo $get_status_row1['fixs'];
        else                              echo 0;
        if($get_status_row1['flag']=='0') echo 0;
        else {
            $get_status_outp=1;
            while($get_status_row2=$get_status_orde->fetch_assoc()){
                if( $get_status_row1['fixs']== 0
                &&  $get_status_row2['urid']==$get_status_row1['id']
                &&  $get_status_row2['flag'] <= 1){  //用户人员订单遍历
                    $get_status_outp=($get_status_row2['flag']+1)%5%4%3; 
                    $get_status_last=1;
                }
                if( $get_status_row1['fixs']== 1
                &&  $get_status_row2['wxid']==$get_status_row1['wxid']
                &&  $get_status_row2['flag'] <= 1){  //技术人员订单遍历
                $get_status_outp=1; 
                $get_status_last=1;break;
                }
            }
            echo $get_status_outp;
        }
        $get_status_flag=1;
        echo $get_status_row1['init'];
        echo $get_status_row1['vips'];
    }
    if($get_status_last==1) break;
}

if($get_status_flag!=1) echo "0";
?>