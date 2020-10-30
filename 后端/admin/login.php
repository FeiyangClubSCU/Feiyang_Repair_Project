<?php
    include 'code/CaptchaClient.php';
    include '../api/module/database.php';
    //  判断是否登陆---------------------------------------
    $login = false;
    $lifes = 600;
    session_set_cookie_params($lifes);
    session_start();
    if (isset($_SESSION["login"]) 
           && $_SESSION["login"] === true) 
        echo"<script>history.go(-1);</script>";
    //  获取登录信息---------------------------------------
    $posts = $_POST;
    foreach ($posts  as  $key => $value)
             $posts[$key] = trim($value);
    //  判定验证信息---------------------------------------
    if($_SERVER['REQUEST_METHOD']== 'POST'){
        $appId = "b4f11125fb26b4fd3010ba2146cf36a7";
        $appMd = "857c0a73e4cd74993102e79a2323a884";
        $client = new CaptchaClient($appId,$appMd);
        $client->setTimeOut(2);
        $vertoken = $posts["loginvertoken"];
        $response = $client->verifyToken($vertoken);
        echo $response->serverStatus;
        echo $response->result;
        if($response->result){
            $password = md5($posts["loginpassword"]);
        	$username =     $posts["loginusername"];
        	$datas_arry=db_alls('fy_admin');{
        	while($user_rows=$datas_arry->fetch_assoc())
            if($username == $user_rows["user"] 
            && $password == $user_rows["pass"]){
              	$_SESSION["login"] = true;
              	$_SESSION["users"] = $user_rows["user"];
              	header("Location: index.php");}}}
            else
            echo "<script>alert('请完成验证')</script>";
    }
    //  ---------------------------------------------------
?>

<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>飞扬维修 - 系统管理</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="all,follow">
        <link rel="stylesheet" href="js/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="js/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="js/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
        <link rel="stylesheet" href="css/fontastic.css">
        <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
        <link rel="stylesheet" href="css/custom.css">
        <link rel="shortcut" href="img/favicon.ico"></head>
    <!-- Main File-->
    <script src="js/front.js"></script>
    <body>
        <div class="page login-page">
            <div class="container">
                <div class="form-outer text-center d-flex align-items-center">
                    <div class="form-inner">
                        <div class="logo text-uppercase">
                            <span>飞扬维修</span>
                            <strong class="text-primary">- 后台管理</strong></div>
                        <br />
                        <div align="center">
                            <img src='./img/fylogo.png' style='heigh:128px;width:128px' /></div>
                        <p>欢迎登陆飞扬俱乐部维修管理平台</p>
                        <form id="loginform" method="post" action="" class="text-left form-validate">
                            <div class="form-group-material">
                                <input id="login-username" type="text" name="loginusername" required data-msg="请输入账号" class="input-material">
                                <label for="login-username" class="label-material">账号</label></div>
                            <div class="form-group-material">
                                <input id="login-password" type="password" name="loginpassword" required data-msg="请输入密码" class="input-material">
                                <label for="login-password" class="label-material">密码</label></div>
                            <input id="login-vertoken" name="loginvertoken" type="hidden" required data-msg="请完成验证" class="input-material" />
                            <div class="form-group text-center">
                                <div id="c1"></div>
                                <br />
                                <br />
                                <br />
                                <input id="comfi" type="submit" class="btn btn-primary" value="登录" />
                            </div>
                        </form>
                        <br />
                        <a href="http://btm.fyscu.com/">服务管理</a>
                        <a href="https://fyscu.com/">飞扬官网</a>
                        <p>Welcome to the Maintenance Management Mlatform of Feiyang Club &copy;2020</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- JavaScript files-->
        <script src="js/jquery/jquery.min.js"></script>
        <script src="js/popper.js/umd/popper.min.js"></script>
        <script src="js/bootstrap/js/bootstrap.min.js"></script>
        <script src="js/grasp.min.js"></script>
        <script src="js/jquery.cookie/jquery.cookie.js"></script>
        <script src="js/jquery-validation/jquery.validate.min.js"></script>
        <script src="js/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="https://cdn.dingxiang-inc.com/ctu-group/captcha-ui/index.js"></script>
        <script type="text/javascript">var passtoken = "";
            var myCaptcha = _dx.Captcha(document.getElementById('c1'), {
                appId: 'b4f11125fb26b4fd3010ba2146cf36a7',
                style: 'inline',
                inlineFloatPosition: 'down',
                success: function(token) {
                    passtoken = token;
                    document.getElementById("login-vertoken").value = passtoken;
                }
            })
        </script>
    </body>
</html>