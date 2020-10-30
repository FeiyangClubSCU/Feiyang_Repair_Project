<?php 
    include '../check.php'; login_checker(); 
    include '../../api/module/database.php'; 
    $users_data=db_alls( "fy_users"); ?>
<html>
    <?php include '../global/global_heads.php'; ?>
    <body>
        <?php include '../global/global_naves.php'; ?>
        <div class="page">
            <?php include '../global/global_title.php'; ?>
            <section>
                <div class="container-fluid">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <h4>
                                    <?php if($_GET[ 'type']==1)echo "编辑用户"; else echo "新增用户"; ?></h4>
                            </div>
                            <div class="card-body">
                                <form style="display:inline;" action="https://fix.fyscu.com/admin/users/users_save.php" class="form-horizontal">
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">ID</label>
                                        <div class="col-sm-10">
                                            <input name="id" type="text" class="form-control" readonly value="<?php
                                            if($_GET['type']==1) 
                                                echo db_getc("fy_users","id",$_GET['urid'],"id");
                                            elseif (db_getc("fy_stack","name","id_user","data")!="") {
                                                echo db_getc("fy_stack","name","id_user","data");
                                            }
                                            else {
                                            $id_new_users_las=db_getc("fy_datas","name","id_user"    ,"data");
                                            $id_new_users_now=db_getc("fy_confs","name","Global_Year","data")*1000000+intval($id_new_users_las)+1;
                                            echo $id_new_users_now;
                                            }
                                            ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">姓名</label>
                                        <div class="col-sm-10">
                                            <input name="name" type="text" class="form-control" value="<?php
                                            if($_GET['type']==1) echo db_getc(" fy_users","id",$_GET['urid'],"name");
                                            ?>">
                                        </div>
                                    </div>
                                    <div class="line"></div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">手机</label>
                                        <div class="col-sm-10">
                                            <input name="pnum" type="text" class="form-control" value="<?php
                                            if($_GET['type']==1) echo db_getc(" fy_users","id",$_GET['urid'],"pnum");
                                            ?>">
                                        </div>
                                    </div>
                                    <div class="line"></div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">邮件</label>
                                        <div class="col-sm-10">
                                            <input name="mail" type="email" name="password" class="form-control" value="<?php
                                            if($_GET['type']==1) echo db_getc("fy_users","id",$_GET['urid'],"mail");
                                            ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">会员身份</label>
                                        <div class="col-sm-10 mb-3">
                                            <select name="vips" class="form-control">
                                                <option value="0" <?php if ( $_GET['type']==1 && db_getc( "fy_users", "id",$_GET['urid'], "vips")==0 ) echo "selected"; ?>>普通用户</option>
                                                <option value="1" <?php if ( $_GET['type']==1 && db_getc( "fy_users", "id",$_GET['urid'], "vips")==1 ) echo "selected"; ?>>飞扬会员</option></select>
                                        </div>
                                    </div>
                                    <div class="line"></div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">会员ID</label>
                                        <div class="col-sm-10">
                                            <input name="hyid" type="text" class="form-control" value="<?php
                                            if($_GET['type']==1) echo db_getc("fy_users","id",$_GET['urid'],"hyid");
                                            ?>">
                                        </div>
                                    </div>
                                    <div class="line"></div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">技术人员</label>
                                        <div class="col-sm-10 mb-3">
                                            <select name="fixs" class="form-control">
                                                <option value="0" <?php if ( $_GET[ 'type']==1 && db_getc( "fy_users", "id",$_GET['urid'], "fixs")==0 ) echo "selected"; ?>>普通用户</option>
                                                <option value="1" <?php if ( $_GET[ 'type']==1 && db_getc( "fy_users", "id",$_GET['urid'], "fixs")==1 ) echo "selected"; ?>>技术人员</option></select>
                                        </div>
                                    </div>
                                    <div class="line"></div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">技术ID</label>
                                        <div class="col-sm-10">
                                            <input name="wxid" type="text" class="form-control" value="<?php
                                            if($_GET['type']==1) echo db_getc("fy_users","id",$_GET['urid'],"wxid");
                                            ?>">
                                        </div>
                                    </div>
                                    <div class="line"></div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">禁止报修</label>
                                        <div class="col-sm-10 mb-3">
                                            <select name="bans" class="form-control">
                                                <option value="0" <?php if ( $_GET['type']==1 && db_getc( "fy_users", "id",$_GET['urid'], "bans")==0 ) echo "selected"; ?>>否</option>
                                                <option value="1" <?php if ( $_GET['type']==1 && db_getc( "fy_users", "id",$_GET['urid'], "bans")==1 ) echo "selected"; ?>>是</option></select>
                                        </div>
                                    </div>
                                    <div class="line"></div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">会话ID</label>
                                        <div class="col-sm-10">
                                            <input name="seid" type="text" class="form-control" readonly value="<?php
                                            if($_GET['type']==1) echo db_getc("fy_users","id",$_GET['urid'],"seid");
                                            ?>">
                                        </div>
                                    </div>
                                    <div class="line"></div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">短信ID</label>
                                        <div class="col-sm-10">
                                            <input name="code" type="text" class="form-control" readonly value="<?php
                                            if($_GET['type']==1) echo db_getc("fy_users","id",$_GET['urid'],"code");
                                            ?>">
                                        </div>
                                    </div>
                                    <div class="line"></div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">头像ID</label>
                                        <div class="col-sm-10">
                                            <input name="txtp" type="text" class="form-control" readonly value="<?php
                                            if($_GET['type']==1) echo db_getc("fy_users","id",$_GET['urid'],"txtp");
                                            ?>">
                                        </div>
                                    </div>
                                    <div class="line"></div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">报修状态</label>
                                        <div class="col-sm-10 mb-3">
                                            <select name="flag" class="form-control">
                                                <option value="0" <?php if ( $_GET['type']==1 && db_getc( "fy_users", "id",$_GET[ 'urid'], "flag")==0 ) echo "selected"; ?>>当前空闲</option>
                                                <option value="1" <?php if ( $_GET['type']==1 && db_getc( "fy_users", "id",$_GET[ 'urid'], "flag")==1 ) echo "selected"; ?>>正在报修</option></select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">初始化状态</label>
                                        <div class="col-sm-10 mb-3">
                                            <select name="init" class="form-control">
                                                <option value="0" <?php if ( $_GET['type']==1 && db_getc( "fy_users", "id",$_GET[ 'urid'], "init")==0 ) echo "selected"; ?>>否</option>
                                                <option value="1" <?php if ( $_GET['type']==1 && db_getc( "fy_users", "id",$_GET[ 'urid'], "init")==1 ) echo "selected"; ?>>是</option>
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" name="type" value="<?php echo $_GET['type']; ?>">
                                    <input  style="display:inline;"  class="btn btn-success" value="确认修改" type="submit"/>
                                    
                                </form>
                                <button style="display:inline;"  class="btn btn-warning" onclick="javascript:history.back(-1);">放弃修改</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php include '../global/global_tails.php'; ?>
            <?php include '../global/global_jsdat.php'; ?>
    </body>
</html>