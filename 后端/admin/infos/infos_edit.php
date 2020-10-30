<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php 
    include '../check.php'; login_checker(); 
    include '../../api/module/database.php'; 
    $users_data=db_alls( "fy_infos"); ?>
    <html>
        <?php include '../global/global_heads.php'; ?>
        <body>
            <?php include '../global/global_naves.php'; ?>
            <div class="page">
                <?php include '../global/global_title.php'; ?>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <h4>
                                    <?php if($_GET[ 'type']==1)echo "编辑问题"; else echo "新增问题"; ?></h4>
                            </div>
                            <div class="card-body">
                                <form method="post" style="display:inline;" action="https://fix.fyscu.com/admin/infos/infos_save.php" class="form-horizontal">
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">问题ID</label>
                                        <div class="col-sm-10">
                                            <input name="ssid" type="text" class="form-control"  value="<?php
                                            if($_GET['type']==1) 
                                                echo $_GET['ssid'];
                                            elseif  (db_getc("fy_stack","name","id_info","data")!="") {
                                                echo db_getc("fy_stack","name","id_info","data");
                                            }
                                            else {
                                                $id_new_users_las=db_getc("fy_datas","name","id_info"    ,"data");
                                                $id_new_users_now=db_getc("fy_confs","name","Global_Year","data")*1000000+intval($id_new_users_las)+1;
                                                echo $id_new_users_now;
                                            }
                                            ?>" readonly   >
                                        </div>
                                    </div>
                                    <div class="line"></div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">回答者编号</label>
                                        <div class="col-sm-10">
                                            <input name="urid" type="text" class="form-control" value="<?php
                                            if($_GET['type']==1) 
                                                echo db_getc("fy_infos","ssid",$_GET['ssid'],"urid");
                                            ?>" <?php /*if($_GET['type']==1) echo "readonly"; */?> >
                                        </div>
                                    </div>
                                    <div class="line"></div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">提问者编号</label>
                                        <div class="col-sm-10">
                                            <input name="twid" type="text" class="form-control" value="<?php
                                            if($_GET['type']==1) 
                                                echo db_getc("fy_infos","ssid",$_GET['ssid'],"twid");
                                            ?>" <?php if($_GET['type']==1) echo "readonly"; ?> >
                                        </div>
                                    </div>
                                    <div class="line"></div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">点赞数</label>
                                        <div class="col-sm-10">
                                            <input name="good" type="text" class="form-control" value="<?php
                                            if($_GET['type']==1) 
                                                echo db_getc("fy_infos","ssid",$_GET['ssid'],"good");
                                            ?>" >
                                        </div>
                                    </div>
                                    <div class="line"></div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">回答状态</label>
                                        <div class="col-sm-10 mb-3">
                                            <select name="ansd" class="form-control">
                                                <option value="0" <?php if ( $_GET['type']==1 && db_getc( "fy_infos", "ssid",$_GET['ssid'], "ansd")==0 ) echo "selected"; ?>>尚未回答</option>
                                                <option value="1" <?php if ( $_GET['type']==1 && db_getc( "fy_infos", "ssid",$_GET['ssid'], "ansd")==1 ) echo "selected"; ?>>已经回答</option>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="line"></div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">提问时间</label>
                                        <div class="col-sm-10">
                                            <input name="date" type="text" class="form-control" value="<?php
                                            if($_GET['type']==1) 
                                                echo db_getc("fy_infos","ssid",$_GET['ssid'],"date");
                                            ?>" readonly >
                                        </div>
                                    </div>
                                    <div class="line"></div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">关联问题</label>
                                        <div class="col-sm-10">
                                            <input name="cont" type="text" class="form-control" value="<?php
                                            if($_GET['type']==1) 
                                                echo db_getc("fy_infos","ssid",$_GET['ssid'],"cont");
                                            ?>" >
                                        </div>
                                    </div>
                                    <div class="line"></div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">问题摘要</label>
                                        <div class="col-sm-10">
                                            <input name="tips" type="text" class="form-control" value="<?php
                                            if($_GET['type']==1) 
                                                echo db_getc("fy_infos","ssid",$_GET['ssid'],"tips");
                                            ?>" >
                                        </div>
                                    </div>
                                    <div class="line"></div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">问题内容</label>
                                        <div class="col-sm-10">
                                            <input name="wzbt" type="text" class="form-control" value="<?php
                                            if($_GET['type']==1) 
                                                echo db_getc("fy_infos","ssid",$_GET['ssid'],"wzbt");
                                            ?>" >
                                        </div>
                                    </div>
                                    <div class="line"></div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">回答内容</label>
                                        <div class="col-sm-10">
                                            <input name="text" type="text" class="form-control" value="<?php
                                            if($_GET['type']==1) 
                                                echo quotemeta(htmlspecialchars(db_getc("fy_infos","ssid",$_GET['ssid'],"text")));
                                            ?>" >
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