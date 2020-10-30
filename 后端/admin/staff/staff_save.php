<?php
    include '../check.php'; login_checker();
    include '../../api/module/getnewid.php';
    if($_GET['type']==0){
        $staff_save_nwid=id_new_staff();
        $staff_save_temp="INSERT INTO fy_staff "
                        ."(urid,wxid,last,next,aval,flag,qqky,qqid,sets,tips,wxcs)"
                        ."VALUES ("
                        ."\"".$_GET['urid']."\","
                        ."\"".$staff_save_nwid."\","
                        ."\"".$_GET['last']."\","
                        ."\"".$_GET['next']."\","
                        ."\"".$_GET['aval']."\","
                        ."\"".$_GET['flag']."\","
                        ."\"".$_GET['qqky']."\","
                        ."\"".$_GET['qqid']."\","
                        ."\"".$_GET['sets']."\","
                        ."\"".$_GET['tips']."\","
                        ."\"".$_GET['wxcs']."\""
                        .")";
        echo db_exec($staff_save_temp);
        db_putc("fy_users","id",$_GET['urid'],"fixs","1");
        db_putc("fy_users","id",$_GET['urid'],"wxid","\"".$staff_save_nwid."\"");
    }
    else{
        db_putc("fy_staff","urid",$_GET['urid'],"urid","\"".$_GET['urid']."\"");
        db_putc("fy_staff","urid",$_GET['urid'],"wxid","\"".$_GET['wxid']."\"");
        db_putc("fy_staff","urid",$_GET['urid'],"last","\"".$_GET['last']."\"");
        db_putc("fy_staff","urid",$_GET['urid'],"next","\"".$_GET['next']."\"");
        db_putc("fy_staff","urid",$_GET['urid'],"aval","\"".$_GET['aval']."\"");
        db_putc("fy_staff","urid",$_GET['urid'],"flag","\"".$_GET['flag']."\"");
        db_putc("fy_staff","urid",$_GET['urid'],"qqky","\"".$_GET['qqky']."\"");
        db_putc("fy_staff","urid",$_GET['urid'],"qqid","\"".$_GET['qqid']."\"");
        db_putc("fy_staff","urid",$_GET['urid'],"sets","\"".$_GET['sets']."\"");
        db_putc("fy_staff","urid",$_GET['urid'],"tips","\"".$_GET['tips']."\"");
        db_putc("fy_staff","urid",$_GET['urid'],"wxcs","\"".$_GET['wxcs']."\"");
    }
    header("Location: https://fix.fyscu.com/admin/staff/staff.php");
?>