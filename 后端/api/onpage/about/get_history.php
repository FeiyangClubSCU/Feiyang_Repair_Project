<?php
$posts = $_GET;
$get_status_seid = $posts['seid'];  //获取会话号码
$get_status_pnum = $posts['pnum'];  //获取手机号码
$get_status_path = dirname(dirname(__FILE__));
include $get_status_path.'/../module/database.php';
/*----------------------------------------------------------------------------------

                                   *获取历史记录*
                                  Code By Pikachu
                                     OCT01/2020
                                     
                          输入：x.php?seid=<会话编号>
                                     &pnum=<用户手机>
                          输出：0-失败，否则历史列表
----------------------------------------------------------------------------------*/
$get_status_tmp0=0;
$get_status_tmp1=0;
$get_status_tmp2=0;
$get_status_data=array();
$get_status_user=db_alls('fy_users'); //获取用户表
$get_status_orde=db_alls('fy_order'); //获取订单表
$get_status_staf=db_alls('fy_staff'); //获取订单表
$get_status_usr2=db_alls('fy_users'); //获取用户表
while($get_status_row1=$get_status_user->fetch_assoc()){
    if( $get_status_row1['pnum'] == $get_status_pnum       //查询用户登录信息
     && $get_status_row1['seid'] == $get_status_seid){
        $get_status_tmp0=1;
        while($get_status_row2=$get_status_orde->fetch_assoc()){
            if($get_status_row1['fixs']==0) $get_status_cxid=$get_status_row2['urid'];
            else                            $get_status_cxid=$get_status_row2['wxid'];
            if( ($get_status_cxid == $get_status_row1['id']   and $get_status_row1['fixs']==0)
            or  ($get_status_cxid == $get_status_row1['wxid'] and $get_status_row1['fixs']==1)){
                    if($get_status_row1['fixs']==0) {      //是用户，应该查找技术员的信息
                        $get_status_usid=20200000;
                        $get_status_name=db_getc("fy_users","wxid",$get_status_row2['wxid'],"name");
                        $get_status_pnum=db_getc("fy_users","wxid",$get_status_row2['wxid'],"pnum");
                        $get_status_txtp=db_getc("fy_users","wxid",$get_status_row2['wxid'],"txtp");
                        /*while($get_status_row4=$get_status_staf->fetch_assoc()){
                            if( $get_status_row4['wxid'] == $get_status_row2['wxid']){
                                //$get_status_usid=$get_status_row4['urid'];
                                $get_status_qqid=$get_status_row4['qqid'];
                                
                                while($get_status_row3=$get_status_usr2->fetch_assoc()){
                                    if(  $get_status_row3['id'] == $get_status_usid){
                                            $get_status_name=$get_status_row3['name'];
                                            $get_status_pnum=$get_status_row3['pnum'];
                                            $get_status_txtp=$get_status_row3['txtp'];
                                        break;
                                    }
                                }
                            }
                        }*/
                    }
                    if($get_status_row1['fixs']==1) {                                //是技工，应该查找此用户的信息
                        $get_status_qqid=$get_status_row2['qqid'];
                        $get_status_name=db_getc("fy_users","id",$get_status_row2['urid'],"name");
                        $get_status_pnum=db_getc("fy_users","id",$get_status_row2['urid'],"pnum");
                        $get_status_txtp=db_getc("fy_users","id",$get_status_row2['urid'],"txtp");
                        /*while($get_status_row3=$get_status_usr2->fetch_assoc()){
                            if( $get_status_row3['id'] == $get_status_row2['urid']){
                                $get_status_name=$get_status_row3['name'];
                                $get_status_pnum=$get_status_row3['pnum'];
                                $get_status_txtp=$get_status_row3['txtp'];
                                break;
                             }
                        }*/
                    }
                    //if($get_status_tmp2==1) echo $get_status_json."`";
                    $get_status_tmp1=1;$get_status_tmp2=$get_status_tmp2+1;
                    if($get_status_tmp2>1)  echo "`";
                    $get_status_data=array("qqid"=>$get_status_qqid,
                                                         "name"=>$get_status_name,
                                                         "pnum"=>$get_status_pnum,
                                                         'txtp'=>$get_status_txtp,
                                                         "time"=>$get_status_row2['time'],
                                                         "jdsj"=>$get_status_row2['jdsj'],
                                                         "gmsj"=>$get_status_row2['gmsj'],
                                                         "flag"=>$get_status_row2['flag'],
                                                         "sbzl"=>$get_status_row2['sbzl'],
                                                         "dnpp"=>$get_status_row2['dnpp'],
                                                         "dnxh"=>$get_status_row2['dnxh'],
                                                         "wxsm"=>$get_status_row2['wxsm'],
                                                         "wxtp"=>$get_status_row2['wxtp'],
                                                         "bxzt"=>$get_status_row2['bxzt'],
                                                         "gzlx"=>$get_status_row2['gzlx'],
                                                         "wcsj"=>$get_status_row2['wcsj'],
                                                         "tbid"=>$get_status_row2['tbid'],
                                                        );
                    $get_status_json = json_encode($get_status_data);
                    //$get_status_json = str_replace(' ' , '-', $get_status_json);
                    //$get_status_json = str_replace('\n', '-', $get_status_json);
                    //$get_status_json = str_replace('\r', '-', $get_status_json);
                    //$get_status_json = str_replace('\t', '-', $get_status_json);
                    //$get_status_json = str_replace(20  , '-', $get_status_json);
                    //echo $get_status_json."`";
                    //$get_status_tmpp=json_decode($get_status_json);
                    //echo $get_status_tmpp;
                    echo $get_status_json;
                    //break;
            }
        }
        //$get_status_json = json_encode($get_status_data);
        //echo $get_status_json;
        
    }
    if($get_status_tmp0==1){
        $get_status_tmp1=1;
        break;
    }
}
if($get_status_tmp0!=1) echo "0";
?>