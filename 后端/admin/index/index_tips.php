<?php
    //-----------------------------------------
    //
    //          系统公告内容修改页面
    //
    //                皮卡丘
    //
    //              2020-08-08
    //
    //-----------------------------------------
    include '../check.php'; login_checker();
    include '../../api/module/database.php'; 
    $keyWord=addslashes(htmlspecialchars($_POST["Tips"]));
    db_putc("fy_confs","name","Global_Tips","data","\"".$keyWord."\"");
    header("Location: ../index.php");
?>