<?php
    include '../check.php'; login_checker();
    include '../../api/module/getnewid.php';
    header("Location: https://fix.fyscu.com/admin/order/order.php");
?>