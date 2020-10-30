<?php
    include './check.php'; login_checker();
    include './../api/module/getnewid.php';
    include './../api/config/db.php';
    include 'code/CaptchaClient.php';
    //  获取登录信息---------------------------------------
    $posts = $_POST;
    foreach ($posts  as  $key => $value)
             $posts[$key] = trim($value);
    //  判定验证信息---------------------------------------
    if($posts["user"]!="" 
    && $posts["pass"]!="")
    {
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
                $chang_temp=db_getc("fy_admin","user",$_SESSION["users"],"pass");
                if($posts["pass"]!=$posts["conf"]){
                    echo "<script>alert('两次密码不符')</script>";
                    echo "<script>window.history.go(-1);</script>";
                }
                elseif($chang_temp==""){
                    echo "<script>alert('你的操作非法')</script>";
                    echo "<script>window.history.go(-1);</script>";
                }
                else{
                    //echo $db_conf_root;echo $posts['root'];exit();
                    if($db_conf_root!=$posts['root']){
                        echo "<script>alert('你的权限不足')</script>";
                        echo "<script>window.history.go(-1);</script>"; 
                    }
                    else{
                        if(db_getc("fy_admin","user",$posts["user"],"id")!=""){
                            echo "<script>alert('用户已经存在')</script>";
                            echo "<script>window.history.go(-1);</script>"; 
                        }
                        else{
                            $chang_news=id_new_admin();
                            $chang_pass=md5($posts["pass"]);
                            echo db_exec("INSERT INTO fy_admin (id,user,pass,name) ".
                            "VALUES (".
                            "\"".$chang_news.   "\",\""
                                .$posts["user"]."\",\""
                                .$chang_pass.   "\",\""
                                .db_getc("fy_confs","name","Global_Year","data").$posts["name"]."\")");
                            //exit();
                            echo "<script>alert('添加管理成功')</script>";
                            echo "<script>window.location.href=\"https://fix.fyscu.com/admin/\"</script>";
                        }
                    }
                }
            }
            else
                echo "<script>alert('请完成验证')</script>";
        }
    }
    //  ---------------------------------------------------
?>

<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>飞扬维修管理系统 - 添加管理</title>
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
                            <strong class="text-primary">- 添加管理</strong></div>
                        <br />
                        <div align="center">
                            <!--
                            style="display:inline-block;float:left;"
                            -->
                            <img src='./img/fylogo.png' style='heigh:128px;width:128px' /></div>
                        <p>你正在添加飞扬维修报修系统管理员账号</p>
                        <form id="loginform" method="post" action="admin.php" class="text-left form-validate" style="display:inline-block;">
                            <div class="form-group-material" >
                                <input type="text"     name="user" required data-msg="账号" class="input-material" />
                                <label class="label-material" style="display:inline-block;text-align:right;">新用户账号</label>
                            </div>
                            <div class="form-group-material">
                                <input type="password" name="pass" required data-msg="密码" class="input-material" />
                                <label class="label-material" style="display:inline-block;text-align:right;">新用户密码</label>
                            </div>
                            <div class="form-group-material">
                                <input type="password" name="conf" required data-msg="确认" class="input-material" />
                                <label class="label-material" style="display:inline-block;text-align:right;">请再次输入</label>
                            </div>
                            <div class="form-group-material">
                                <input type="text" name="name" required data-msg="确认" class="input-material" />
                                <label class="label-material" style="display:inline-block;text-align:right;">部门和姓名</label>
                            </div>
                            <div class="form-group-material">
                                <input type="text" name="root" required data-msg="确认" class="input-material" />
                                <label class="label-material" style="display:inline-block;text-align:right;">系统授权码</label>
                            </div>
                          <input id="login-vertoken" name="loginvertoken" type="hidden" required data-msg="验证" class="input-material" />
                            <div class="form-group text-center">
                                <div id="c1"></div>
                                <br />
                                <br />
                                <br />
                                <input  style="display:inline;" type="submit" class="btn btn-primary"                                  value="确认添加" />
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <button style="display:inline;" type="button" class="btn btn-warning"  onclick="javascript:history.back(-1);">放弃添加</button>
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