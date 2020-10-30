<?php
    include '../check.php'; login_checker();
    include '../../api/module/getnewid.php';
    if($_POST['type']==0){
        $staff_save_nwid=id_new_infos();
        $staff_save_temp="INSERT INTO fy_infos"
                        ."(ssid,urid,twid,good,ansd,cont,tips,wzbt,text)"
                        ."VALUES ("
                        ."\"".$staff_save_nwid."\","
                        ."\"".$_POST['urid']."\","
                        ."\"".$_POST['twid']."\","
                        ."\"".$_POST['good']."\","
                        ."\"".$_POST['ansd']."\","
                        ."\"".$_POST['cont']."\","
                        ."\"".$_POST['tips']."\","
                        ."\"".$_POST['wzbt']."\","
                        ."\"".$_POST['text']."\""
                        .")";
        echo db_exec($staff_save_temp);
    }
    else{
        db_putc("fy_infos","ssid",$_POST['ssid'],"ssid","\"".$_POST['ssid']."\"");
        db_putc("fy_infos","ssid",$_POST['ssid'],"urid","\"".$_POST['urid']."\"");
        db_putc("fy_infos","ssid",$_POST['ssid'],"twid","\"".$_POST['twid']."\"");
        db_putc("fy_infos","ssid",$_POST['ssid'],"good","\"".$_POST['good']."\"");
        db_putc("fy_infos","ssid",$_POST['ssid'],"ansd","\"".$_POST['ansd']."\"");
        db_putc("fy_infos","ssid",$_POST['ssid'],"cont","\"".$_POST['cont']."\"");
        db_putc("fy_infos","ssid",$_POST['ssid'],"wzbt","\"".$_POST['wzbt']."\"");
        db_putc("fy_infos","ssid",$_POST['ssid'],"text","\"".$_POST['text']."\"");
        db_putc("fy_infos","ssid",$_POST['ssid'],"tips","\"".$_POST['tips']."\"");
    }
    header("Location: https://fix.fyscu.com/admin/infos/infos.php");
?>