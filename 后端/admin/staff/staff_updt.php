<?php
    include '../check.php'; login_checker();
    include '../../api/module/getnewid.php';
    if($_GET['acts']==3){
        $staff_updt_temp=db_getc("fy_users","id",$_GET['urid'],"name");
        echo "<script>var staff_updt_conf=confirm(\"确认删除技术人员【".$staff_updt_temp."】？此操作不能撤销！！\");"
        ."if(staff_updt_conf==0) window.history.go(-1);"
        ."else window.location.href=\"https://fix.fyscu.com/admin/staff/staff_updt.php?type=1&acts=4&urid=".$_GET['urid']."\";"."</script>";
    }
    elseif($_GET['acts']==4){
        id_push_nums("\""."id_staf"."\"",db_getc("fy_staff","urid",$_GET['urid'],"wxid"));
        db_putc("fy_users","id",$_GET['urid'],"fixs","0");
        db_putc("fy_users","id",$_GET['urid'],"wxid","0");
        db_delc("fy_staff","urid",$_GET['urid']);
        echo "<script>window.history.go(-1);</script>";
    }
    else{
        if($_GET['acts']==0){
            $staff_updt_data=db_getc("fy_staff","urid",$_GET['urid'],"flag");
            $staff_updt_name="flag";
        }
        if($_GET['acts']==1){
            $staff_updt_data=db_getc("fy_staff","urid",$_GET['urid'],"qqky");
            $staff_updt_name="qqky";
        }
        if($_GET['acts']==5){
            $staff_updt_data=db_getc("fy_staff","urid",$_GET['urid'],"sets");
            $staff_updt_name="sets";
        }
        if($_GET['acts']==6){
            $staff_updt_data=db_getc("fy_staff","urid",$_GET['urid'],"aval");
            $staff_updt_name="aval";
        }
        if($staff_updt_data==1) $staff_updt_data=0;
        else                    $staff_updt_data=1;
        db_putc("fy_staff","urid",$_GET['urid'],$staff_updt_name,$staff_updt_data);
        echo "<script>window.history.go(-1);</script>";
    }
?>