<?php
include '../check.php'; login_checker();
include '../../api/module/database.php';
?>
<html>
    <html>
    <?php include '../global/global_heads.php'; ?>
    <body>
        <?php include '../global/global_naves.php'; ?>
        <div class="page">
            <?php include '../global/global_title.php'; ?>
                <section>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6" style="flex:0 0 100%!important;max-width:100%!important">
                                <div class="card">
                                    <div class="card-header">
                                        <h4  style="display:inline;float:left;font-size:32px;">订单管理</h4>
                                        <div style="display:inline;float:right;height:41px;margin-right:-35px;margin:auto -50px">
                                            <form style="display:inline;height:50px" type="post" action="https://fix.fyscu.com/admin/order/order.php">
                                                <input name="keys" type="text" style="display:inline;width:27%;font-size: 0.60rem;" placeholder="输入搜索内容" class="form-control" />
                                                <input type="submit" style="display:inline;margin-top:-1.5px" value="搜索" class="btn btn-info" /></form>
                                            <button style="display:inline;margin-top:-1.5px" class="btn btn-success" onclick="window.location.href = 'https://fix.fyscu.com/admin/order/order_edit.php?type=0'">新增</button>
                                            <button style="display:inline;margin-top:-1.5px" class="btn btn-default" onclick="window.location.href = 'https://fix.fyscu.com/admin/order/order_impo.php?type=0'" disabled="disabled">导入</button></div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-sm">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align:center;">订单编号</th>
                                                        <th style="text-align:center;">用户</th>
                                                        <th style="text-align:center;">技术员</th>
                                                        <th style="text-align:center;">维修状态</th>
                                                        <th style="text-align:center;">创建时间</th>
                                                        <th style="text-align:center;">接单时间</th>
                                                        <th style="text-align:center;">关闭时间</th>
                                                        <th style="text-align:center;">购买时间</th>
                                                        <th style="text-align:center;">用户手机</th>
                                                        <th style="text-align:center;">设备种类</th>
                                                        <th style="text-align:center;">电脑品牌</th>
                                                        <th style="text-align:center;">电脑型号</th>
                                                        <th style="text-align:center;">保修状态</th>
                                                        <th style="text-align:center;">故障类型</th>
                                                        <th style="text-align:center;">用户QQ号</th>
                                                        <!--<th style="text-align:center;">维修说明</th>-->
                                                        <th style="text-align:center;">操作</th></tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                    $user_page_page=1;
                                                    if($_GET['page']!='')
                                                        try {
                                                            $user_page_page=intval($_GET['page']);
                                                        } catch (Exception $erro) {
                                                            header("Location: index.php");
                                                        }
                                                    else{
                                                        $user_page_page=1;
                                                    }
                                                    $user_page_lens=20;//单页长度
                                                    $user_page_loop= 0;//当前项数
                                                    $user_page_tota= 1;//总共页数
                                                    $user_page_ltmp= 0;//页码计数
                                                    $order_data=db_alls("fy_order");
                                                    //---------------------------查找总页数--------------------------
                                                    while($user_rows=$order_data->fetch_assoc()) { 
                                                        $order_flag=0;
                                                        if($_GET['keys']!="")
                                                            { 
                                                            if( substr_count($user_rows["tbid"],$_GET['keys'])>0 
                                                              ||substr_count($user_rows["sbzl"],$_GET['keys']) 
                                                              ||substr_count($user_rows["dnpp"],$_GET['keys']) 
                                                              ||substr_count($user_rows["dnxh"],$_GET['keys'])
                                                              ||substr_count($user_rows["wxsm"],$_GET['keys']) 
                                                              ||substr_count($user_rows["gzlx"],$_GET['keys']) 
                                                              ||substr_count($user_rows["wxid"],$_GET['keys']) 
                                                              ||substr_count($user_rows["qqid"],$_GET['keys']) 
                                                              ||substr_count($user_rows["urid"],$_GET['keys']) 
                                                              ||substr_count(db_getc("fy_users","id",$user_rows['urid'],"name"),$_GET['keys']) 
                                                              ) 
                                                                $user_page_ltmp=$user_page_ltmp+1; 
                                                            } 
                                                            else 
                                                                $user_page_ltmp =$user_page_ltmp+1; 
                                                            if ($user_page_ltmp>=$user_page_lens){
                                                                $user_page_tota =$user_page_tota+1;
                                                                $user_page_ltmp=0;
                                                            }
                                                    }
                                                    $order_dat2=db_alls("fy_order");$user_page_loop=0;
                                                    //---------------------------查找总页数--------------------------
                                                    while($user_rows=$order_dat2->fetch_assoc()) { 
                                                        $order_flag=0;
                                                        if($_GET['keys']!="")
                                                            { 
                                                            if( substr_count($user_rows["tbid"],$_GET['keys'])>0 
                                                              ||substr_count($user_rows["sbzl"],$_GET['keys']) 
                                                              ||substr_count($user_rows["dnpp"],$_GET['keys']) 
                                                              ||substr_count($user_rows["dnxh"],$_GET['keys'])
                                                              ||substr_count($user_rows["wxsm"],$_GET['keys']) 
                                                              ||substr_count($user_rows["gzlx"],$_GET['keys']) 
                                                              ||substr_count($user_rows["wxid"],$_GET['keys']) 
                                                              ||substr_count($user_rows["qqid"],$_GET['keys']) 
                                                              ||substr_count($user_rows["urid"],$_GET['keys']) 
                                                              ||substr_count(db_getc("fy_users","id",$user_rows['urid'],"name"),$_GET['keys']) 
                                                              ) 
                                                                $order_flag= 1; 
                                                            } 
                                                            else 
                                                                $order_flag= 1; 
                                                            if ($order_flag==1)
                                                                {
                                                                 $user_page_loop= $user_page_loop+1;
                                                                if($user_page_loop> $user_page_lens* $user_page_page
                                                                 ||$user_page_loop<=$user_page_lens*($user_page_page-1))
                                                                    continue;
                                                                if(    $user_rows["tbid"]<=2020000000) 
                                                                    $order_if_edit="disabled=\"disabled\"";
                                                                else 
                                                                    $order_if_edit="";
                                                                if(    $user_rows["flag"]==0) {
                                                                    $order_if_csss="btn-warning";
                                                                    $order_if_text="等待接单";
                                                                    $staff_if_bans="";
                                                                }
                                                                elseif($user_rows["flag"]==1) {
                                                                    $order_if_csss="btn-info";
                                                                    $order_if_text="正在维修";
                                                                    $staff_if_bans="";
                                                                }
                                                                elseif($user_rows["flag"]==2) {
                                                                    $order_if_csss="btn-success";
                                                                    $order_if_text="用户确认";
                                                                    $staff_if_bans="disabled=\"disabled\"";
                                                                }
                                                                elseif($user_rows["flag"]==3) {
                                                                    $order_if_csss="btn-default";
                                                                    $order_if_text="用户放弃";
                                                                    $staff_if_bans="disabled=\"disabled\"";
                                                                }
                                                                elseif($user_rows["flag"]==4) {
                                                                    $order_if_csss="btn-default";
                                                                    $order_if_text="技工关闭";
                                                                    $staff_if_bans="disabled=\"disabled\"";
                                                                }
                                                                elseif($user_rows["flag"]==5) {
                                                                    $order_if_csss="btn-danger";
                                                                    $order_if_text="系统关闭";
                                                                    $staff_if_bans="disabled=\"disabled\"";
                                                                }
                                                                if($order_if_edit == "" && $user_rows["flag"]<=1) 
                                                                    $order_if_kyfp="";
                                                                else
                                                                    $order_if_kyfp="disabled=\"disabled\"";
                                                                echo '<tr>'; 
                                                                echo '<th scope="row">'.$user_rows["tbid"].'</th>' 
                                                                    .'<td><b>'.db_getc("fy_users","id",$user_rows["urid"],"name").'</b></td>' 
                                                                    .'<td><b>'.db_getc("fy_users","wxid",$user_rows["wxid"],"name").'</b></td>' 
.'<td>
<button '.$staff_if_bans.'class="btn '.$order_if_csss.'" onclick="window.location.href = \'https://fix.fyscu.com/admin/order/order_updt.php?type=1&acts=0&tbid='.$user_rows["tbid"].'\'">'.$order_if_text.'</button></td>' 
                                                                    .'<td>'.$user_rows["time"].'</td>' 
                                                                    .'<td>'.$user_rows["jdsj"].'</td>'
                                                                    .'<td>'.$user_rows["wcsj"].'</td>' 
                                                                    .'<td>'.$user_rows["gmsj"].'</td>' 
                                                                    .'<td>'.$user_rows["pnum"].'</td>' 
                                                                    .'<td>'.$user_rows["sbzl"].'</td>' 
                                                                    .'<td>'.$user_rows["dnpp"].'</td>' 
                                                                    .'<td>'.$user_rows["dnxh"].'</td>' 
                                                                    .'<td>'.$user_rows["bxzt"].'</td>' 
                                                                    .'<td>'.$user_rows["gzlx"].'</td>' 
                                                                    .'<td>'.$user_rows["qqid"].'</td>' 
                                                                    //3.'<td>'.$user_rows["wxsm"].'</td>' 
                                                                    .'<td><div style=\"text-align:center;\">'
.' <button '.$order_if_kyfp.'class="btn btn-warning" onclick="window.location.href = \'https://fix.fyscu.com/admin/order/order_edit.php?type=1&acts=1&tbid='.$user_rows["tbid"].'\'">分配</button>'
.' <button '.$order_if_edit.'class="btn btn-info"    onclick="window.location.href = \'https://fix.fyscu.com/admin/order/order_edit.php?type=1&acts=2&tbid='.$user_rows["tbid"].'\'">编辑</button>'
.' <button '.$order_if_edit.'class="btn btn-danger"  onclick="window.location.href = \'https://fix.fyscu.com/admin/order/order_updt.php?type=1&acts=3&tbid='.$user_rows["tbid"].'\'">删除</button>'
                                                                    .'</td>' ; 
                                                        echo '</tr>'; 
                                                    } 
                                                } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="display:inline;float:right;margin:auto -50px">
                        <button style="display:inline;" class="btn btn-success" onclick="window.location.href = 'https://fix.fyscu.com/admin/order/order.php?keys=<?php 
                            echo $_GET['keys']; ?>&page=<?php
                            echo $user_page_page>1?$user_page_page-1:1; ?>'      ">上一页</button>
                        <form  style="display:inline;" type="post" action="https://fix.fyscu.com/admin/order/order.php?keys=<?php 
                            echo $_GET['keys']; ?>">
                            <input name="page" type="text" style="display:inline;width:12%;font-size: 0.60rem;" placeholder="" class="form-control" value='<?php echo $user_page_page; ?>'/>
                            <b>/<?php echo $user_page_tota; ?>页</b>
                            <input type="submit" style="display:inline;margin-top:-1.5px" value="跳转" class="btn btn-info" />
                            <input type="hidden" style="display:inline;"  name="keys" value="<?php echo $_GET['keys']; ?>">
                        </form>
                        <button style="display:inline;" class="btn btn-success" onclick="window.location.href = 'https://fix.fyscu.com/admin/order/order.php?keys=<?php 
                            echo $_GET['keys']; ?>&page=<?php
                            echo $user_page_page<$user_page_tota?$user_page_page+1:$user_page_page; ?>'      ">下一页</button>
                    </div>
                    
                   
                </section>
                <?php include '../global/global_tails.php'; ?>
        </div>
        <?php include '../global/global_jsdat.php'; ?>
        </body>

</html>