<?php
function login_checker(){
    $login = false;
    $lifes= 600;
    session_set_cookie_params($lifes);
    session_start();
    //  判断是否登陆
    if (isset($_SESSION["login"]) 
           && $_SESSION["login"] === true) 
    {
        
    }
    else {
              $_SESSION["login"] = false;
        header("Location: https://fix.fyscu.com/admin/login.php");
    }
}
?>