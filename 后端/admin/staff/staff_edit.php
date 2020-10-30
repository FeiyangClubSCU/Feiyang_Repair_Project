<?php 
    include '../check.php'; login_checker(); 
    include '../../api/module/database.php'; 
    $users_data=db_alls( "fy_users"); 
?>
<html>
    <?php include '../global/global_heads.php'; ?>
    <body>
        <?php include '../global/global_naves.php'; ?>
        <div class="page">
            <?php include '../global/global_title.php'; ?>
                <section>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <h4>
                                    <?php if($_GET[ 'type']==1)echo "编辑技术员"; else echo "新增技术员"; ?></h4>
                            </div>
                            <div class="card-body">
                                <form style="display:inline;" action="https://fix.fyscu.com/admin/staff/staff_save.php" class="form-horizontal">
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">ID</label>
                                        <div class="col-sm-10">
                                            <input name="urid" type="text" class="form-control"  value="<?php
                                                echo $_GET['urid'];
                                            ?>" <?php if($_GET['type']==1) echo "readonly"; ?>   >
                                        </div>
                                    </div>
                                    <div class="line"></div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">技术ID</label>
                                        <div class="col-sm-10">
                                            <input name="wxid" type="text" class="form-control" value="<?php
                                            if($_GET['type']==1) 
                                                echo db_getc("fy_staff","urid",$_GET['urid'],"wxid");
                                            elseif (db_getc("fy_stack","name","id_staf","data")!='') {
                                                echo db_getc("fy_stack","name","id_staf","data");
                                            }
                                            else {
                                                $id_new_users_las=db_getc("fy_datas","name","id_staf"    ,"data");
                                                $id_new_users_now=db_getc("fy_confs","name","Global_Year","data")*1000000+intval($id_new_users_las)+1;
                                                echo $id_new_users_now;
                                            }
                                            ?>" readonly >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">姓名</label>
                                        <div class="col-sm-10">
                                            <input name="name" type="text" class="form-control" value="<?php
                                            if($_GET['type']==1) echo db_getc(" fy_users","id",$_GET['urid'],"name");
                                            ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="line"></div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">上次接单</label>
                                        <div class="col-sm-10">
                                            <input name="last" type="text" class="form-control" value="<?php
                                            if($_GET['type']==1) echo db_getc("fy_staff","urid",$_GET['urid'],"last");
                                            ?>">
                                        </div>
                                    </div>
                                    <div class="line"></div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">下次天数</label>
                                        <div class="col-sm-10">
                                            <input name="next" type="text" class="form-control" value="<?php
                                                if($_GET['type']==1) echo db_getc("fy_staff","urid",$_GET['urid'],"next");
                                                else echo 3;
                                            ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">接单次数</label>
                                        <div class="col-sm-10">
                                            <input name="wxcs" type="text" class="form-control" value="<?php
                                            if($_GET['type']==1) echo db_getc("fy_staff","urid",$_GET['urid'],"wxcs");
                                            ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">技工开关</label>
                                        <div class="col-sm-10 mb-3">
                                            <select name="aval" class="form-control">
<option value="1" <?php if ( $_GET['type']==1 && db_getc( "fy_staff", "urid",$_GET['urid'], "aval")==1 ) echo "selected"; ?>>正常接单</option>
<option value="0" <?php if ( $_GET['type']==1 && db_getc( "fy_staff", "urid",$_GET['urid'], "aval")==0 ) echo "selected"; ?>>停止接单</option>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="line"></div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">可用标识</label>
                                        <div class="col-sm-10 mb-3">
                                            <select name="flag" class="form-control">
                                                <option value="1" <?php if ( $_GET[ 'type']==1 && db_getc( "fy_staff", "urid",$_GET['urid'], "flag")==1 ) echo "selected"; ?>>可用</option>
                                                <option value="0" <?php if ( $_GET[ 'type']==1 && db_getc( "fy_staff", "urid",$_GET['urid'], "flag")==0 ) echo "selected"; ?>>忙碌</option>
                                                </select>
                                        </div>
                                    </div>

                                    <div class="line"></div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">使用QQ</label>
                                        <div class="col-sm-10 mb-3">
                                            <select name="qqky" class="form-control">
                                                <option value="0" <?php if ( $_GET['type']==1 && db_getc( "fy_staff", "urid",$_GET['urid'], "qqky")==0 ) echo "selected"; ?>>否</option>
                                                <option value="1" <?php if ( $_GET['type']==1 && db_getc( "fy_staff", "urid",$_GET['urid'], "qqky")==1 ) echo "selected"; ?>>是</option></select>
                                        </div>
                                    </div>
                                    <div class="line"></div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">QQ号码</label>
                                        <div class="col-sm-10">
                                            <input name="qqid" type="text" class="form-control" value="<?php
                                            if($_GET['type']==1) echo db_getc("fy_staff", "urid",$_GET['urid'], "qqid");
                                            ?>">
                                        </div>
                                    </div>
                                    <div class="line"></div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">自定参数</label>
                                        <div class="col-sm-10 mb-3">
                                            <select name="sets" class="form-control">
                                                <option value="0" <?php if ( $_GET['type']==1 && db_getc( "fy_staff", "urid",$_GET['urid'], "sets")==0 ) echo "selected"; ?>>否</option>
                                                <option value="1" <?php if ( $_GET['type']==1 && db_getc( "fy_staff", "urid",$_GET['urid'], "sets")==1 ) echo "selected"; ?>>是</option></select>
                                        </div>
                                    </div>
                                    <div class="line"></div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">备注内容</label>
                                        <div class="col-sm-10">
                                            <input name="tips" type="text" class="form-control" value="<?php
                                            if($_GET['type']==1) echo db_getc("fy_staff", "urid",$_GET['urid'], "tips");
                                            ?>">
                                        </div>
                                    </div>
                                    <div class="line"></div>
                                    <input type="hidden" name="type" value="<?php echo $_GET['type']; ?>">
                                    <input  style="display:inline;"  class="btn btn-success" value="确认修改" type="submit"/>
                                    
                                </form>
                                <button style="display:inline;"  class="btn btn-warning" onclick="javascript:history.back(-1);">放弃修改</button>
                            </div>
                        </div>
                    </div>
                    <?php include '../global/global_tails.php'; ?>
            </div>
            <?php include '../global/global_jsdat.php'; ?>
            </body>
    
    </html>