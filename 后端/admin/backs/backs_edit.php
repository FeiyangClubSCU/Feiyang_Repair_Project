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
                                    <?php if($_GET[ 'type']==1)echo "查看反馈"; else echo "新增反馈"; ?></h4>
                            </div>
                            <div class="card-body">
                                <form style="display:inline;" action="https://fix.fyscu.com/admin/infos/infos_save.php" class="form-horizontal">
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">反馈ID</label>
                                        <div class="col-sm-10">
                                            <input name="tbid" type="text" class="form-control"  value="<?php
                                            if($_GET['type']==1) 
                                                echo $_GET['fkid'];
                                            ?>" readonly   >
                                        </div>
                                    </div>
                                    <div class="line"></div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">反馈用户ID</label>
                                        <div class="col-sm-10">
                                            <input name="urid" type="text" class="form-control" value="<?php
                                            echo db_getc("fy_feeds","fkid",$_GET['fkid'],"urid");
                                            ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">反馈时间</label>
                                        <div class="col-sm-10">
                                            <input name="time" type="text" class="form-control" value="<?php
                                            echo db_getc("fy_feeds","fkid",$_GET['fkid'],"time");
                                            ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">反馈手机</label>
                                        <div class="col-sm-10">
                                            <input name="pnum" type="text" class="form-control" value="<?php
                                            echo db_getc("fy_feeds","fkid",$_GET['fkid'],"pnum");
                                            ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">反馈昵称</label>
                                        <div class="col-sm-10">
                                            <input name="name" type="text" class="form-control" value="<?php
                                            echo db_getc("fy_feeds","fkid",$_GET['fkid'],"name");
                                            ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">反馈内容</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" readonly>
                                                <?php
                                                    echo db_getc("fy_feeds","fkid",$_GET['fkid'],"text");
                                                ?>
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="line"></div>
                                    <input type="hidden" name="type" value="<?php echo $_GET['type']; ?>">
                                </form>
                                <button style="display:inline;"  class="btn btn-warning" onclick="javascript:history.back(-1);">返回</button>
                            </div>
                        </div>
                    </div>
                    <?php include '../global/global_tails.php'; ?>
            </div>
            <?php include '../global/global_jsdat.php'; ?>
            </body>
    
    </html>