<?php
    //-----------------------------------------
    //
    //          系统核心配置修改页面
    //
    //                皮卡丘
    //
    //              2020-08-08
    //
    //-----------------------------------------
    include '../check.php'; login_checker();
    include '../../api/module/database.php'; 
    db_putc("fy_confs","name","Global_Flag","data",$_POST["Flag"]);
    db_putc("fy_confs","name","Global_Year","data",$_POST["Year"]);
    db_putc("fy_confs","name","Global_Days","data",$_POST["Days"]);
    db_putc("fy_confs","name","Global_Week","data",$_POST["Week"]);
    db_putc("fy_confs","name","Global_Mont","data",$_POST["Mont"]);
    db_putc("fy_confs","name","Limits_Days","data",$_POST["nop_Days"]);
    db_putc("fy_confs","name","Limits_Week","data",$_POST["nop_Week"]);
    db_putc("fy_confs","name","Limits_Mont","data",$_POST["nop_Mont"]);
    header("Location: ../index.php");
?>