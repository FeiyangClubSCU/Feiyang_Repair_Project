<?php 
    include '../check.php'; login_checker(); 
    include '../../api/module/database.php'; 
    $users_data=db_alls( "fy_order"); ?>
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
                                    <?php if($_GET[ 'type']==1)echo "编辑订单"; else echo "新增订单"; ?></h4>
                            </div>
                            <div class="card-body">
                                <form style="display:inline;" action="https://fix.fyscu.com/admin/order/order_save.php" class="form-horizontal">
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">订单ID</label>
                                        <div class="col-sm-10">
                                            <input name="tbid" type="text" class="form-control"  value="<?php
                                            if($_GET['type']==1) 
                                                echo $_GET['tbid'];
                                            elseif (db_getc("fy_stack","name","id_orde","data")!="") {
                                                echo db_getc("fy_stack","name","id_orde","data");
                                            }
                                            else {
                                                $id_new_users_las=db_getc("fy_datas","name","id_tbid"    ,"data");
                                                $id_new_users_now=db_getc("fy_confs","name","Global_Year","data")*1000000+intval($id_new_users_las)+1;
                                                echo $id_new_users_now;
                                            }
                                            ?>" readonly   >
                                        </div>
                                    </div>
                                    <div class="line"></div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">技术ID</label>
                                        <div class="col-sm-10">
                                            <input name="wxid" type="text" class="form-control" value="<?php
                                            if($_GET['type']==1) 
                                                echo db_getc("fy_order","tbid",$_GET['tbid'],"wxid");
                                            ?>" <?php /*if($_GET['type']==1) echo "readonly"; */?> >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">技术姓名</label>
                                        <div class="col-sm-10">
                                            <input            type="text" class="form-control" value="<?php
                                            if($_GET['type']==1) 
                                                echo db_getc("fy_users","wxid",db_getc("fy_order","tbid",$_GET['tbid'],"wxid"),"name");
                                            ?>" readonly >
                                        </div>
                                    </div>
                                    <div class="line"></div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">用户ID</label>
                                        <div class="col-sm-10">
                                            <input name="urid" type="text" class="form-control" value="<?php
                                            if($_GET['type']==1) 
                                                echo db_getc("fy_order","tbid",$_GET['tbid'],"urid");
                                            ?>" <?php if($_GET['type']==1) echo "readonly"; ?> >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">用户姓名</label>
                                        <div class="col-sm-10">
                                            <input            type="text" class="form-control" value="<?php
                                            if($_GET['type']==1) 
                                                echo db_getc("fy_users","id",db_getc("fy_order","tbid",$_GET['tbid'],"urid"),"name");
                                            ?>" readonly  >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">接单开关</label>
                                        <div class="col-sm-10 mb-3">
                                            <select name="flag" class="form-control">
                                                <option value="0" <?php if ( $_GET['type']==1 && db_getc( "fy_order", "tbid",$_GET['tbid'], "flag")==0 ) echo "selected"; ?>>尚未接单</option>
                                                <option value="1" <?php if ( $_GET['type']==1 && db_getc( "fy_order", "tbid",$_GET['tbid'], "flag")==1 ) echo "selected"; ?>>正在维修</option>
                                                <option value="2" <?php if ( $_GET['type']==1 && db_getc( "fy_order", "tbid",$_GET['tbid'], "flag")==2 ) echo "selected"; ?>>用户确认</option>
                                                <option value="3" <?php if ( $_GET['type']==1 && db_getc( "fy_order", "tbid",$_GET['tbid'], "flag")==3 ) echo "selected"; ?>>用户放弃</option>
                                                <option value="4" <?php if ( $_GET['type']==1 && db_getc( "fy_order", "tbid",$_GET['tbid'], "flag")==4 ) echo "selected"; ?>>技术关闭</option>
                                                <option value="5" <?php if ( $_GET['type']==1 && db_getc( "fy_order", "tbid",$_GET['tbid'], "flag")==5 ) echo "selected"; ?>>系统关闭</option>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">创建时间</label>
                                        <div class="col-sm-10">
                                            <input             type="text" class="form-control" value="<?php
                                            if($_GET['type']==1) echo db_getc(" fy_order","tbid",$_GET['tbid'],"time");
                                            ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">接单时间</label>
                                        <div class="col-sm-10">
                                            <input             type="text" class="form-control" value="<?php
                                            if($_GET['type']==1) echo db_getc(" fy_order","tbid",$_GET['tbid'],"jdsj");
                                            ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">关闭时间</label>
                                        <div class="col-sm-10">
                                            <input             type="text" class="form-control" value="<?php
                                            if($_GET['type']==1) echo db_getc(" fy_order","tbid",$_GET['tbid'],"wcsj");
                                            ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">购买时间</label>
                                        <div class="col-sm-10">
                                            <input             type="text" class="form-control" value="<?php
                                            if($_GET['type']==1) echo db_getc(" fy_order","tbid",$_GET['tbid'],"gmsj");
                                            ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">手机号码</label>
                                        <div class="col-sm-10">
                                            <input name="pnum" type="text" class="form-control" value="<?php
                                            if($_GET['type']==1) 
                                                echo db_getc("fy_order","tbid",$_GET['tbid'],"pnum");
                                            ?>"  >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">设备种类</label>
                                        <div class="col-sm-10">
                                            <input             type="text" class="form-control" value="<?php
                                            if($_GET['type']==1) echo db_getc(" fy_order","tbid",$_GET['tbid'],"sbzl");
                                            ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">设备品牌</label>
                                        <div class="col-sm-10">
                                            <input             type="text" class="form-control" value="<?php
                                            if($_GET['type']==1) echo db_getc(" fy_order","tbid",$_GET['tbid'],"dnpp");
                                            ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">具体型号</label>
                                        <div class="col-sm-10">
                                            <input             type="text" class="form-control" value="<?php
                                            if($_GET['type']==1) echo db_getc(" fy_order","tbid",$_GET['tbid'],"dnxh");
                                            ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">保修状态</label>
                                        <div class="col-sm-10">
                                            <input             type="text" class="form-control" value="<?php
                                            if($_GET['type']==1) echo db_getc(" fy_order","tbid",$_GET['tbid'],"bxzt");
                                            ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">故障类型</label>
                                        <div class="col-sm-10">
                                            <input             type="text" class="form-control" value="<?php
                                            if($_GET['type']==1) echo db_getc(" fy_order","tbid",$_GET['tbid'],"gzlx");
                                            ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">QQ号码</label>
                                        <div class="col-sm-10">
                                            <input name="qqid" type="text" class="form-control" value="<?php
                                            if($_GET['type']==1) 
                                                echo db_getc("fy_order","tbid",$_GET['tbid'],"qqid");
                                            ?>" >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">维修说明</label>
                                        <div class="col-sm-10">
                                            <input name="wxsm" type="text" class="form-control" value="<?php
                                            if($_GET['type']==1) 
                                                echo db_getc("fy_order","tbid",$_GET['tbid'],"wxsm");
                                            ?>"  >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">维修图片</label>
                                        <div class="col-sm-10">
                                            <input             type="text" class="form-control" value="<?php
                                            if($_GET['type']==1) echo db_getc(" fy_order","tbid",$_GET['tbid'],"wxtp");
                                            ?>" readonly>
                                            <img src="<?php
                                                if($_GET['type']==1) {
                                                    echo "https://fix.fyscu.com/api/module/imagesup.png/"
                                                       .db_getc("fy_order","tbid",$_GET['tbid'],"wxtp");
                                                }
                                            ?>
                                            "/>
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