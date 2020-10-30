<?php
    include '../check.php'; login_checker();
    include '../../api/module/getnewid.php';
    if($_GET['type']==0){
        $users_save_nwid=id_new_users();
        $users_save_temp="INSERT INTO fy_users "
                        ."(id,pnum,vips,fixs,seid,bans,code,mail,flag,hyid,wxid,init,txtp,name)"
                        ."VALUES ("
                        ."\"".$users_save_nwid."\","
                        ."\"".$_GET['pnum']."\","
                        ."\"".$_GET['vips']."\","
                        ."\"".$_GET['fixs']."\","
                        ."\"".$_GET['seid']."\","
                        ."\"".$_GET['bans']."\","
                        ."\"".$_GET['code']."\","
                        ."\"".$_GET['mail']."\","
                        ."\"".$_GET['flag']."\","
                        ."\"".$_GET['hyid']."\","
                        ."\"".$_GET['wxid']."\","
                        ."\"".$_GET['init']."\","
                        ."\"".$_GET['txtp']."\","
                        ."\"".$_GET['name']."\""
                        .")";
        db_exec($users_save_temp);
    }
    else{
        db_putc("fy_users","id",$_GET['id'],"pnum","\"".$_GET['pnum']."\"");
        db_putc("fy_users","id",$_GET['id'],"vips","\"".$_GET['vips']."\"");
        db_putc("fy_users","id",$_GET['id'],"fixs","\"".$_GET['fixs']."\"");
        db_putc("fy_users","id",$_GET['id'],"seid","\"".$_GET['seid']."\"");
        db_putc("fy_users","id",$_GET['id'],"bans","\"".$_GET['bans']."\"");
        db_putc("fy_users","id",$_GET['id'],"code","\"".$_GET['code']."\"");
        db_putc("fy_users","id",$_GET['id'],"mail","\"".$_GET['mail']."\"");
        db_putc("fy_users","id",$_GET['id'],"flag","\"".$_GET['flag']."\"");
        db_putc("fy_users","id",$_GET['id'],"hyid","\"".$_GET['hyid']."\"");
        db_putc("fy_users","id",$_GET['id'],"wxid","\"".$_GET['wxid']."\"");
        db_putc("fy_users","id",$_GET['id'],"init","\"".$_GET['init']."\"");
        db_putc("fy_users","id",$_GET['id'],"txtp","\"".$_GET['txtp']."\"");
        db_putc("fy_users","id",$_GET['id'],"name","\"".$_GET['name']."\"");
    }
    header("Location: https://fix.fyscu.com/admin/users/users.php");
?>


<!--//id=20200000&name=分配中&pnum=10000000000&mail=root%40fyscu.com&vips=1&hyid=20200000&fixs=1&wxid=20200000&bans=0&seid=0&code=0000&txtp=0.png&flag=0&init=1&type=1-->