<?php
/*--------------------------------------------*/
$exc_minute_path = dirname(dirname(__FILE__));
include $exc_minute_path.'/module/database.php';
include $exc_minute_path.'/module/sendtext.php';
include $exc_minute_path.'/module/sendmail.php';
/*----------------------------------------------
            *飞扬维修每分钟自动执行任务*
                 Code By Pikachu
                    2020-10-01
                    
    功能：判断系统是否空闲，遍历订单并进行分配
    结构：-------------------------------------
        遍历设置（检查设置额度）
        查询技工状态（是否全满）
        查询游客额度（是否全满）
            是：结束
            否：查询订单，有未分配订单则：
                遍历技工，找出间隔最大的技工
                再次遍历技工，找有空闲最大的
                分配订单，发送短信，发送邮件
----------------------------------------------*/


/*---------------------------------------判断系统额度是否已满---------------------------------*/
    $exc_minute_flag=0;
        echo "[".date("Y-m-d h:m:s")."] "."[飞扬维修]------开始执行查询------"."<br />\n";
    if(db_getc("fy_datas","name","order_vip","data")
      +db_getc("fy_datas","name","order_nop","data")
     >=db_getc("fy_confs","name","Global_Days","data")){
        echo "[".date("Y-m-d h:m:s")."] "."[飞扬维修]------今日额度已满------"."<br />\n"; 
        db_putc("fy_datas","name","flag","data",1);
     }
elseif(db_getc("fy_datas","name","order_am1","data")
      +db_getc("fy_datas","name","order_am2","data")
     >=db_getc("fy_confs","name","Global_Week","data")){
        echo "[".date("Y-m-d h:m:s")."] "."[飞扬维修]------本周额度已满------"."<br />\n";
        db_putc("fy_datas","name","flag","data",1);
     }
elseif(db_getc("fy_datas","name","month_num","data")
     >=db_getc("fy_confs","name","Global_Mont","data")){
        echo "[".date("Y-m-d h:m:s")."] "."[飞扬维修]------本月额度已满------"."<br />\n";
        db_putc("fy_datas","name","flag","data",1);
     }
/*---------------------------------------判断技术人员是否已满---------------------------------*/
else{
    $exc_minute_aval=1;
    $exc_minute_staf=db_alls('fy_staff');
    while($exc_minute_row2=$exc_minute_staf->fetch_assoc()){
        if((strtotime(date("Y-m-d h:i"))-strtotime(
              $exc_minute_row2['last']))/86400>intval($exc_minute_row2['next'])
            &&$exc_minute_row2['flag']==1 &&          $exc_minute_row2['aval']==1){
            $exc_minute_aval=0;
        }
    }
    if($exc_minute_aval==0) 
        echo "[".date("Y-m-d h:m:s")."] "."[飞扬维修]技术员状态：当前额度充足"."<br />\n";
    else                    
        echo "[".date("Y-m-d h:m:s")."] "."[飞扬维修]技术员状态：当前额度已满"."<br />\n";
    db_putc("fy_datas","name","flag","data",$exc_minute_aval);
/*----------------------------------------判断游客额度是否已满--------------------------------*/
        if(db_getc("fy_datas","name","order_nop","data")
         >=db_getc("fy_confs","name","Limits_Days","data")){
            echo "[".date("Y-m-d h:m:s")."] "."[飞扬维修]------今日游客已满------"."<br />\n"; 
            db_putc("fy_datas","name","flag","data",2);
        }
    elseif(db_getc("fy_datas","name","order_am2","data")
         >=db_getc("fy_confs","name","Limits_Week","data")){
            echo "[".date("Y-m-d h:m:s")."] "."[飞扬维修]------本周游客已满------"."<br />\n";
            db_putc("fy_datas","name","flag","data",2);
        }
/*-------------------------------------------------------修复订单错误------------------------------------------------------*/
    $exc_minute_ord1=db_alls('fy_order'); 
    while($exc_minute_row5=$exc_minute_ord1->fetch_assoc()){
        echo "[".date("Y-m-d h:m:s")."] "."[飞扬维修]选中未完订单：".$exc_minute_row5['tbid']."<br />\n";
        if($exc_minute_row5['flag']<=1){
            db_putc("fy_users","id",$exc_minute_row5['urid'],"flag","1");
            if($exc_minute_row5['flag']=='1'){
                db_putc("fy_staff","wxid",$exc_minute_row5['wxid'],"flag",0);
                db_putc("fy_users","wxid",$exc_minute_row5['wxid'],"flag",1);
            }
        }
    }
    /*---------------------------------------------------------------------------------------------------------------------*/
    //----------------------------------------遍历订单信息-------------------------------------------------------------------
    $exc_minute_orde=db_alls('fy_order');
    while($exc_minute_row1=$exc_minute_orde->fetch_assoc()){
        if($exc_minute_row1['flag']==0){
            echo "[".date("Y-m-d h:m:s")."] "."[飞扬维修]当前选中订单：".$exc_minute_row1['tbid']."<br />\n";
            $exc_minute_flag=1;$exc_minute_ttts=0;
            //----------------------------------------获取最空闲技工---------------------------------------------------------
            $exc_minute_stax=db_alls('fy_staff'); 
            $exc_minute_maxt=0; //记录最大维修间隔
            $exc_minute_maid=0; //记录最大维修技工
            while($exc_minute_rowx=$exc_minute_stax->fetch_assoc()){
                //遍历系统，找出最久没维修的人
                if( strtotime(date("Y-m-d h:i"))-
                    strtotime($exc_minute_rowx['last']) / 86400 >intval($exc_minute_rowx['next']))
                    if($exc_minute_rowx['flag']==1&&$exc_minute_rowx['aval']==1)
                        if($exc_minute_maxt < strtotime(date("Y-m-d h:i"))-strtotime($exc_minute_rowx['last']) ){
                           $exc_minute_maxt = strtotime(date("Y-m-d h:i"))-strtotime($exc_minute_rowx['last']); 
                           $exc_minute_maid = $exc_minute_rowx['wxid'];
                        }
                    
            }
            $exc_minute_staf=db_alls('fy_staff'); 
            while($exc_minute_row2=$exc_minute_staf->fetch_assoc()){
                if(
                    strtotime(date("Y-m-d h:i"))-
                    strtotime($exc_minute_row2['last']) / 86400 
                   >intval($exc_minute_row2['next'])
                  )
                    $exc_minute_flag=1;
                else
                    $exc_minute_flag=0;
                //找出有空闲并且最久没维修的人
                if(
                      ($exc_minute_flag==1                        //满足维修间隔条件
                     &&$exc_minute_row2['wxid']==$exc_minute_maid)//满足最大维修间隔
                    &&($exc_minute_row2['flag']==1                //满足自定开关状态
                     &&$exc_minute_row2['aval']==1)               //满足当前空闲状态                                                                     
                  ){
                    db_putc("fy_order","tbid",$exc_minute_row1['tbid'],"flag",1);                                    //设置订单状态
                    db_putc("fy_order","tbid",$exc_minute_row1['tbid'],"jdsj","\"".date("Y-m-d h:i:s",time())."\""); //设置接单时间
                    db_putc("fy_order","tbid",$exc_minute_row1['tbid'],"wxid",$exc_minute_row2['wxid']);             //设置技工是谁
                    db_putc("fy_staff","wxid",$exc_minute_row2['wxid'],"flag",0);                                    //设置技工状态
                    db_putc("fy_staff","wxid",$exc_minute_row2['wxid'],"last","\"".strval(date("Y-m-d H:i:s"))."\"");//设置技工时间
                    
                    //-------------------------------获取订单的用户和技工信息，写入系统日志----------------------------------------
                    echo "[".date("Y-m-d h:m:s")."] "."[飞扬维修]当前选中技工：".$exc_minute_row2['wxid']  ."<br />\n";
                    if(db_getc("fy_users","id",$exc_minute_row1['urid'],"vips")==1){      //按照会员写入订单
                        $exc_weekly_tstk='order_am1';
                        $exc_weekly_ttip='a';
                        $exc_daysly_tstr='order_vip';
                    }
                    else{                                                                 //按照普通用户处理
                        $exc_weekly_tstk='order_am2';
                        $exc_weekly_ttip='b';
                        $exc_daysly_tstr='order_nop';
                    }
                        
                    $exc_weekly_time='w'.$exc_weekly_ttip.strval(date("w",time()));       //获取每周统计键名
                    $exc_weekly_temp=db_getc("fy_datas","name",$exc_weekly_time,"data")+1;//获取每周统计数据
                    $exc_weekly_alls=db_getc("fy_datas","name",$exc_weekly_tstk,"data")+1;//获取每周汇总数据
                    $exc_daysly_alls=db_getc("fy_datas","name",$exc_daysly_tstr,"data")+1;//获取每天报修数据
                    $exc_months_alls=db_getc("fy_datas","name","month_num"     ,"data")+1;//获取总共报修数据
                    $exc_totals_alls=db_getc("fy_datas","name","total_num"     ,"data")+1;//获取总共报修数据
                    db_putc("fy_datas","name","total_num"     ,"data",$exc_totals_alls);  //写入总共报修数据
                    db_putc("fy_datas","name","month_num"     ,"data",$exc_months_alls);  //写入总共报修数据
                    db_putc("fy_datas","name",$exc_daysly_tstr,"data",$exc_daysly_alls);  //写入每天报修数据
                    db_putc("fy_datas","name",$exc_weekly_tstk,"data",$exc_weekly_alls);  //写入每周汇总数据
                    db_putc("fy_datas","name",$exc_weekly_time,"data",$exc_weekly_temp);  //写入每周汇总数据
                    //-----------------------------------设置用户和技工当前状态------------------------------------------------
                    db_putc("fy_users","wxid",$exc_minute_row2['wxid'],"flag",1);         //写入技工状态-忙碌
                    db_putc("fy_users",  "id",$exc_minute_row1['urid'],"flag",1);         //写入用户状态-忙碌
                    $exc_totals_wxcs=db_getc("fy_staff","wxid",$exc_minute_row2['wxid'],"wxcs")+1;             //获取技工订单数
                                     db_putc("fy_staff","wxid",$exc_minute_row2['wxid'],"wxcs",$exc_totals_wxcs);//写入新订单数
                    //--------------------------获取接单时间和星期几，发送邮件和短信通知---------------------------------------
                    $exc_totals_jgdh=db_getc("fy_users","wxid",$exc_minute_row2['wxid'],"pnum");//技工电话
                    $exc_totals_jgmz=db_getc("fy_users","wxid",$exc_minute_row2['wxid'],"name");//技工姓名
                    $exc_totals_yhdh=db_getc("fy_users","id"  ,$exc_minute_row1['urid'],"pnum");//用户电话
                    $exc_totals_yhmz=db_getc("fy_users","id"  ,$exc_minute_row1['urid'],"name");//用户姓名
                    //-------------------------------------------判断有没有QQ--------------------------------------------------
                    if(db_getc("fy_staff","wxid",$exc_minute_row1['wxid'],"qqky")==1)
                        $exc_totals_jgqq=db_getc("fy_staff","wxid",$exc_minute_row1['wxid'],"qqid");
                    else
                        $exc_totals_jgqq="未提供";
                    //-------------------------------------------发送通知短信--------------------------------------------------
                    echo "[".date("Y-m-d h:m:s")."] "."[飞扬维修]已发送短信： ".$exc_totals_jgdh."<br />\n";
                    echo "[".date("Y-m-d h:m:s")."] "."[飞扬维修]已发送短信： ".$exc_totals_yhdh."<br />\n";
                    dx_send(2,"+86".$exc_totals_jgdh,
                                    $exc_totals_jgmz."\",\"".$exc_totals_yhmz."\",\"".$exc_totals_yhdh."\"");
                    dx_send(3,"+86".$exc_totals_yhdh,
                                    $exc_totals_yhmz."\",\"".$exc_totals_jgmz."\",\"".$exc_totals_jgdh."\"");
                    //-------------------------------------------发送通知邮件--------------------------------------------------
                    $exc_totals_jsyx=db_getc("fy_users","wxid",$exc_minute_row1['wxid'],"mail");//技工邮箱
                    $exc_totals_yhyx=db_getc("fy_users","id"  ,$exc_minute_row1['urid'],"mail");//用户邮箱
                    $exc_totals_html="<h2>飞扬维修订单：".$exc_minute_row1['tbid']."</h2>"
                                    ."<h4>&ensp;&ensp;&ensp;&ensp;"
                                    ."亲爱的 报修同学 / 技术人员 ：<br />"
                                    ."&ensp;&ensp;&ensp;&ensp;"
                                    ."你的维修单已经 分配 / 接单 ，"
                                    ."请尽快联系对方，下面是维修单详细信息：</h4>"
                                    ."<h4>提交时间：".$exc_minute_row1['time']."</h4>"
                                    ."<h4>用户姓名：".$exc_totals_yhmz        ."</h4>"
                                    ."<h4>技术姓名：".$exc_totals_jgmz        ."</h4>"
                                    ."<h4>购买时间：".$exc_minute_row1['gmsj']."</h4>"
                                    ."<h4>用户号码：".$exc_totals_yhdh        ."</h4>"
                                    ."<h4>技工号码：".$exc_totals_jgdh        ."</h4>"
                                    ."<h4>技工联系：QQ".$exc_totals_jgqq      ."</h4>"
                                    ."<h4>设备种类：".$exc_minute_row1['sbzl']."</h4>"
                                    ."<h4>电脑品牌：".$exc_minute_row1['dnpp']."</h4>"
                                    ."<h4>电脑型号：".$exc_minute_row1['dnxh']."</h4>"
                                    ."<h4>维修说明：</h4>&nbsp;&nbsp;&nbsp;&nbsp;".$exc_minute_row1['wxsm'].""
                                    ."<br /><h4>维修图片：</h4>&nbsp;&nbsp;&nbsp;&nbsp;"
                                    ."<img src=\"https://fix.fyscu.com/api/module/imagesup.png/"
                                    .$exc_minute_row1['wxtp']."\"></img>"
                                    ."<br /> 此致！<a href=\"https://www.fyscu.com/\">"
                                    ."四川大学飞扬俱乐部</a> - <a href=\"https://fix.fyscu.com/\" >飞扬维修系统</a>";
                    yx_send("【飞扬维修】你的订单已经分配给了：".$exc_totals_jgmz,$exc_totals_html,   "",$exc_totals_yhyx);
                    yx_send("【飞扬维修】你接到来自：".$exc_totals_yhmz."的维修订单",$exc_totals_html,"",$exc_totals_jsyx);
                    $exc_minute_ttts=1;break;
                }
            }
            /*---------------------------------------------------输出结果----------------------------------------------------------*/
            if($exc_minute_ttts==1)echo "[".date("Y-m-d h:m:s")."] "."[飞扬维修]成功分配订单：".$exc_minute_row1['tbid']."<br />\n";
            else                  {echo "[".date("Y-m-d h:m:s")."] "."[飞扬维修]未能分配订单：".$exc_minute_row1['tbid']."<br />\n";
                                   db_putc("fy_datas","name","flag","data",1);
            }
            /*---------------------------------------------------------------------------------------------------------------------*/
        }
    }
}
/*----------------------------------------------------------自动关闭超时订单-------------------------------------------------------*/
$exc_minute_orde=db_alls('fy_order');
while($exc_minute_row1=$exc_minute_orde->fetch_assoc()){
    if((strtotime(date("Y-m-d h:i"))-strtotime($exc_minute_row1['time']))/86400
       >=db_getc("fy_confs","name","Global_Time","data")
    &&  $exc_minute_row1["flag"]<2){
        db_putc("fy_order","tbid",$exc_minute_row1['tbid'],"flag",5);//设置订单状态
        db_putc("fy_users",  "id",$exc_minute_row1['urid'],"flag",0);//设置用户状态
        db_putc("fy_users","wxid",$exc_minute_row1['wxid'],"flag",0);//设置技工状态
        db_putc("fy_staff","wxid",$exc_minute_row1['wxid'],"flag",1);//设置技工空闲
        $exc_minute_end_jgdh=db_getc("fy_users","wxid",$exc_minute_row1['wxid'],"pnum");//获取技工电话
        $exc_minute_end_jgmz=db_getc("fy_users","wxid",$exc_minute_row1['wxid'],"name");//获取技工姓名
        $exc_minute_end_yhdh=db_getc("fy_users",  "id",$exc_minute_row1['urid'],"pnum");//获取用户电话
        $exc_minute_end_yhmz=db_getc("fy_users",  "id",$exc_minute_row1['urid'],"name");//获取用户姓名
        $exc_minute_end_yh_time=$exc_minute_row1['time'];//获取用户报修时间
        $exc_minute_end_jg_time=$exc_minute_row1['jdsj'];//获取技工接单时间
        dx_send(6,"+86".$exc_minute_end_yhdh,$exc_minute_end_yhmz."\",\"".$exc_minute_end_yh_time."\",\""."长时间未处理订单"."\"");
        dx_send(5,"+86".$exc_minute_end_jgdh,$exc_minute_end_jgmz."\",\"".$exc_minute_end_jg_time."\",\""."长时间未处理订单"."\"");
        echo "[".date("Y-m-d h:m:s")."] "."[飞扬维修]强制关闭订单：".$exc_minute_row1['tbid']."<br />\n";
    }
}
/*---------------------------------------------------------------------------------------------------------------------------------*/
if($exc_minute_flag==0) echo "[".date("Y-m-d h:m:s")."] "."[飞扬维修]********暂无订单********"."<br />\n";
                        echo "[".date("Y-m-d h:m:s")."] "."[飞扬维修]------执行查询完毕------"."<br />\n";
/*---------------------------------------------------------------------------------------------------------------------------------*/
?>
