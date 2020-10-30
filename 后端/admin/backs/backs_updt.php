<?php
    include '../check.php'; login_checker();
    include '../../api/module/getnewid.php';
    if($_GET['acts']==3){
        echo "<script>var staff_updt_conf=confirm(\"确认删除反馈【".$_GET['fkid']."】？此操作不能撤销！！\");"
        ."if(staff_updt_conf==0) window.history.go(-1);"
        ."else window.location.href=\"https://fix.fyscu.com/admin/backs/backs_updt.php?type=1&acts=4&fkid=".$_GET['fkid']."\";"."</script>";
    }
    elseif($_GET['acts']==4){
        id_push_nums("\""."id_feed"."\"",$_GET['fkid']);
        db_delc("fy_feeds","fkid",$_GET['fkid']);
        echo "<script>window.history.go(-1);</script>";
    }
?>