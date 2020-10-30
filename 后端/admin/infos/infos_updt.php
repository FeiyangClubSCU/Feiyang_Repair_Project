<?php
    include '../check.php'; login_checker();
    include '../../api/module/getnewid.php';
    if($_GET['acts']==3){
        $staff_updt_temp=db_getc("fy_infos","ssid",$_GET['ssid'],"wzbt");
        echo "<script>var staff_updt_conf=confirm(\"确认删除问题:【".$staff_updt_temp."】？此操作不能撤销！！\");"
        ."if(staff_updt_conf==0) window.history.go(-1);"
        ."else window.location.href=\"https://fix.fyscu.com/admin/infos/infos_updt.php?type=1&acts=4&ssid=".$_GET['ssid']."\";"."</script>";
    }
    elseif($_GET['acts']==4){
        id_push_nums("\""."id_info"."\"",$_GET['ssid']);
        db_delc("fy_infos","ssid",$_GET['ssid']);
        echo "<script>window.history.go(-1);</script>";
    }
    else{
        if($_GET['acts']==2){
            $staff_updt_temp=db_getc("fy_infos","ssid",$_GET['ssid'],"wzbt");
            echo "<script>var staff_updt_conf=confirm(\"确认关闭问题【".$staff_updt_temp."】？此操作不能撤销！！\");"
                ."if(staff_updt_conf==0) window.history.go(-1);"
                ."else window.location.href=\"https://fix.fyscu.com/admin/infos/infos_updt.php?type=1&acts=1&ssid=".$_GET['ssid']."\";"."</script>";
        }
        if($_GET['acts']==1){
            db_putc("fy_infos","ssid",$_GET['ssid'],"ansd","1");
        }
       echo "<script>window.history.go(-1);</script>";
    }
?>