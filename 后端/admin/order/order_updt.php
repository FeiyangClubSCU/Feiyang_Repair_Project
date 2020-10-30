<?php
    include '../check.php'; login_checker();
    include '../../api/module/getnewid.php';
    include '../../api/module/sendtext.php';
    if($_GET['acts']==3){
        $staff_updt_temp=db_getc("fy_users","id",db_getc("fy_order","tbid",$_GET['tbid'],"urid"),"name");
        echo "<script>var staff_updt_conf=confirm(\"确认删除【".$staff_updt_temp."】的订单？此操作不能撤销！！\");"
        ."if(staff_updt_conf==0) window.history.go(-1);"
        ."else window.location.href=\"https://fix.fyscu.com/admin/order/order_updt.php?type=1&acts=4&tbid=".$_GET['tbid']."\";"."</script>";
    }
    elseif($_GET['acts']==4){
        id_push_nums("\""."id_orde"."\"",$_GET['tbid']);
        db_putc("fy_users","id",db_getc("fy_order","tbid",$_GET['tbid'],"urid"),"flag","0");
        db_putc("fy_staff","wxid",db_getc("fy_order","tbid",$_GET['tbid'],"wxid"),"aval","1");
        db_delc("fy_order","tbid",$_GET['tbid']);
        //sleep(11);
        echo "<script>window.history.go(-1);</script>";
        //header("Location: staff.php");
    }
    
    else{
        if($_GET['acts']==0){
            $staff_updt_temp=db_getc("fy_users","id",db_getc("fy_order","tbid",$_GET['tbid'],"urid"),"name");
            echo "<script>var staff_updt_conf=confirm(\"确认关闭【".$staff_updt_temp."】的订单？此操作不能撤销！！\");"
                ."if(staff_updt_conf==0) window.history.go(-1);"
                ."else window.location.href=\"https://fix.fyscu.com/admin/order/order_updt.php?type=1&acts=1&tbid=".$_GET['tbid']."\";"."</script>";
        }
        if($_GET['acts']==1){
            db_putc("fy_order","tbid",$_GET['tbid'],"flag","5");
            db_putc("fy_order","tbid",$_GET['tbid'],"wcsj","\"".date("Y-m-d h:i:s",time())."\"" );
            db_putc("fy_users","id",db_getc("fy_order","tbid",$_GET['tbid'],"urid"),"flag","0");
            db_putc("fy_staff","wxid",db_getc("fy_order","tbid",$_GET['tbid'],"wxid"),"flag","1");
            //------------------------------------------------------------------------------------------------------
            $exc_minute_end_jgdh=db_getc("fy_users","wxid",db_getc("fy_order","tbid",$_GET['tbid'],"wxid"),"pnum");
            $exc_minute_end_jgmz=db_getc("fy_users","wxid",db_getc("fy_order","tbid",$_GET['tbid'],"wxid"),"name");
            $exc_minute_end_yhdh=db_getc("fy_users",  "id",db_getc("fy_order","tbid",$_GET['tbid'],"urid"),"pnum");
            $exc_minute_end_yhmz=db_getc("fy_users",  "id",db_getc("fy_order","tbid",$_GET['tbid'],"urid"),"name");
            $exc_minute_end_yh_time=db_getc("fy_order","tbid",$_GET['tbid'],"time");
            $exc_minute_end_jg_time=db_getc("fy_order","tbid",$_GET['tbid'],"jdsj");
            dx_send(6,"+86".$exc_minute_end_yhdh,
                            $exc_minute_end_yhmz."\",\"".$exc_minute_end_yh_time."\",\""."系统管理手动关闭"."\"");
            dx_send(5,"+86".$exc_minute_end_jgdh,
                            $exc_minute_end_jgmz."\",\"".$exc_minute_end_jg_time."\",\""."系统管理手动关闭"."\"");
            //------------------------------------------------------------------------------------------------------            
        }
        echo "<script>window.history.go(-1);</script>";
        //header("Location: staff.php");
    }
    
?>