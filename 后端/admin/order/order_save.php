<?php
    include '../check.php'; login_checker();
    include '../../api/module/getnewid.php';
    if($_GET['type']==0){
        $staff_save_nwid=id_new_order();
        $staff_save_temp="INSERT INTO fy_order"
                        ."(tbid,wxid,urid,flag,pnum,qqid,wxsm)"
                        ."VALUES ("
                        ."\"".$staff_save_nwid."\","
                        ."\"".$_GET['wxid']."\","
                        ."\"".$_GET['urid']."\","
                        ."\"0\","
                        ."\"".$_GET['pnum']."\","
                        ."\"".$_GET['qqid']."\","
                        ."\"".$_GET['wxsm']."\""
                        .")";
        echo db_exec($staff_save_temp);
        db_putc("fy_users",  "id",$_GET['urid'],"flag","1");
        db_putc("fy_staff","wxid",$_GET['wxid'],"aval","0");
        db_putc("fy_staff","wxid",$_GET['wxid'],"last","\"".date("Y-m-d H:i:s")."\"");
    }
    else{
        db_putc("fy_order","tbid",$_GET['tbid'],"wxid","\"".$_GET['wxid']."\"");
        db_putc("fy_order","tbid",$_GET['tbid'],"urid","\"".$_GET['urid']."\"");
        db_putc("fy_order","tbid",$_GET['tbid'],"pnum","\"".$_GET['pnum']."\"");
        db_putc("fy_order","tbid",$_GET['tbid'],"qqid","\"".$_GET['qqid']."\"");
        db_putc("fy_order","tbid",$_GET['tbid'],"wxsm","\"".$_GET['wxsm']."\"");
        db_putc("fy_order","tbid",$_GET['tbid'],"flag","\"".$_GET['flag']."\"");
    }
    header("Location: https://fix.fyscu.com/admin/order/order.php");
?>