<?php
    include '../check.php'; login_checker();
    include '../../api/module/getnewid.php';
    if($_GET['acts']==3){
        $users_updt_temp=db_getc("fy_users","id",$_GET['urid'],"name");
        echo "<script>var users_updt_conf=confirm(\"确认删除用户【".$users_updt_temp."】？此操作不能撤销！！\");"
        ."if(users_updt_conf==0) window.history.go(-1);"
        ."else window.location.href=\"https://fix.fyscu.com/admin/users/users_updt.php?type=1&acts=4&urid=".$_GET['urid']."\";"."</script>";
    }
    elseif($_GET['acts']==4){
        //返还ID
            id_push_nums("\""."id_user"."\"",$_GET['urid']);
        if(intval(db_getc("fy_users","id",$_GET['urid'],"hyid"))>2020000000)
            echo id_push_nums("\""."id_vips"."\"",db_getc("fy_users","id",$_GET['urid'],"hyid"));
        if(intval(db_getc("fy_users","id",$_GET['urid'],"wxid"))>2020000000)
            echo id_push_nums("\""."id_staf"."\"",db_getc("fy_users","id",$_GET['urid'],"wxid"));
        //删除用户
        db_delc("fy_users","id",  $_GET['urid']);
        db_delc("fy_staff","urid",$_GET['urid']);
        echo "<script>window.history.go(-1);</script>";
    }
    else{
        if($_GET['acts']==0){
            $users_updt_data=db_getc("fy_users","id",$_GET['urid'],"vips");
            if($users_updt_data==0
            //新增会员
            &&db_getc("fy_users","id",$_GET['urid'],"hyid")<2020000000){
                $users_updt_vips=id_new_viper();
                db_putc("fy_users","id",$_GET['urid'],"hyid",$users_updt_vips);
            }
            if($users_updt_data==1){
                if(db_getc("fy_users","id",$_GET['urid'],"hyid")>2020000000)
                    echo id_push_nums("\""."id_vips"."\"",db_getc("fy_users","id",$_GET['urid'],"hyid"));
                db_putc("fy_users","id",$_GET['urid'],"hyid",0);
            }
            $users_updt_name="vips";
        }
        if($_GET['acts']==1){
            $users_updt_data=db_getc("fy_users","id",$_GET['urid'],"bans");
            $users_updt_name="bans";
        }
        if($_GET['acts']==5){
            $users_updt_data=db_getc("fy_users","id",$_GET['urid'],"flag");
            $users_updt_name="flag";
        }
        if($users_updt_data==1) $users_updt_data=0;
        else                    $users_updt_data=1;
        db_putc("fy_users","id",$_GET['urid'],$users_updt_name,$users_updt_data);
        echo "<script>window.history.go(-1);</script>";
    }
?>