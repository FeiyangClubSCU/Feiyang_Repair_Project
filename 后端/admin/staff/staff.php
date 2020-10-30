<?php
include '../check.php'; login_checker();
include '../../api/module/database.php';
?>
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
                                        <h4  style="display:inline;float:left;font-size:32px;">技工管理</h4>
                                        <div style="display:inline;float:right;height:41px;margin-right:-35px;margin:auto -50px">
                                            <form style="display:inline;height:50px" type="post" action="https://fix.fyscu.com/admin/staff/staff.php">
                                                <input name="keys" type="text" style="display:inline;width:27%;font-size: 0.60rem;" placeholder="输入搜索内容" class="form-control" />
                                                <input type="submit" style="display:inline;margin-top:-1.5px" value="搜索" class="btn btn-info" /></form>
                            <button style="display:inline;margin-top:-1.5px" class="btn btn-success" onclick="window.location.href = 'https://fix.fyscu.com/admin/staff/staff_edit.php?type=0'"                    >新增</button>
                            <button style="display:inline;margin-top:-1.5px" class="btn btn-default" onclick="window.location.href = 'https://fix.fyscu.com/admin/staff/staff_impo.php?type=0'" disabled="disabled">导入</button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>用户编号</th>
                                                        <th>姓名</th>
                                                        <th>技工ID</th>
                                                        <th>邮箱</th>
                                                        <th>上次时间</th>
                                                        <th>下次天数</th>
                                                        <th>接单次数</th>
                                                        <th>允许接单</th>
                                                        <th>是否可用</th>
                                                        <th>是否QQ</th>
                                                        <th>QQ号码</th>
                                                        <th>自定参数</th>
                                                        <th>备注内容</th>
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
                                                    $users_data=db_alls("fy_staff");
                                                    //---------------------------查找总页数--------------------------
                                                    while($user_rows=$users_data->fetch_assoc()) { 
                                                        $users_flag=0;
                                                        if($_GET['keys']!="")
                                                            { 
                                                            if( substr_count($user_rows["name"],$_GET['keys'])>0 
                                                              ||substr_count($user_rows["pnum"],$_GET['keys']) 
                                                              ||substr_count($user_rows["mail"],$_GET['keys']) 
                                                              ||substr_count($user_rows["hyid"],$_GET['keys']) 
                                                              ||substr_count($user_rows["wxcs"],$_GET['keys']) 
                                                              ||substr_count($user_rows["wxid"],$_GET['keys']) 
                                                              ||substr_count($user_rows["seid"],$_GET['keys'])
                                                              ||substr_count($user_rows["code"],$_GET['keys']) 
                                                              ||substr_count($user_rows["txtp"],$_GET['keys']) 
                                                              ||substr_count($user_rows["id"],$_GET['keys']) 
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
                                                    $users_dat2=db_alls("fy_staff");$user_page_loop=0;
                                                    //---------------------------查找总页数--------------------------
                                                    while($user_rows=$users_dat2->fetch_assoc()) { 
                                                        $users_flag=0;
                                                        if($_GET['keys']!="")
                                                            { 
                                                            if( substr_count($user_rows["urid"],$_GET['keys'])>0 
                                                              ||substr_count($user_rows["wxid"],$_GET['keys']) 
                                                              ||substr_count($user_rows["last"],$_GET['keys']) 
                                                              ||substr_count($user_rows["next"],$_GET['keys']) 
                                                              ||substr_count($user_rows["aval"],$_GET['keys']) 
                                                              ||substr_count($user_rows["wxcs"],$_GET['keys'])
                                                              ||substr_count($user_rows["flag"],$_GET['keys'])
                                                              ||substr_count($user_rows["qqky"],$_GET['keys']) 
                                                              ||substr_count($user_rows["qqid"],$_GET['keys']) 
                                                              ||substr_count($user_rows["sets"],$_GET['keys']) 
                                                              ||substr_count($user_rows["tips"],$_GET['keys']) 
                                                              ) 
                                                                $users_flag= 1; 
                                                            } 
                                                            else 
                                                                $users_flag= 1; 
                                                            if ($users_flag==1)
                                                                {
                                                                 $user_page_loop= $user_page_loop+1;
                                                                if($user_page_loop> $user_page_lens* $user_page_page
                                                                 ||$user_page_loop<=$user_page_lens*($user_page_page-1))
                                                                    continue;
                                                                if($user_rows["flag"]==1) {
                                                                    $staff_if_aval="btn-success";
                                                                    $staff_if_avac="空闲";
                                                                    
                                                                }
                                                                else                      {
                                                                    $staff_if_aval="btn-warning";
                                                                    $staff_if_avac="忙碌";
                                                                } 
                                                                if($user_rows["qqky"]==1) {
                                                                    $staff_if_qqkl="btn-default";
                                                                    $staff_if_qqkc="是";
                                                                    
                                                                }
                                                                else                      {
                                                                    $staff_if_qqkl="btn-danger ";
                                                                    $staff_if_qqkc="否";
                                                                } 
                                                                if($user_rows["sets"]==1) {
                                                                    $staff_if_setl="btn-info";
                                                                    $staff_if_setc="是";
                                                                    
                                                                }
                                                                else                      {
                                                                    $staff_if_setl="btn-default";
                                                                    $staff_if_setc="否";
                                                                }
                                                                if($user_rows["aval"]==1) {
                                                                    $staff_if_flal="btn-success";
                                                                    $staff_if_flac="允许";
                                                                    
                                                                }
                                                                else                      {
                                                                    $staff_if_flal="btn-danger ";
                                                                    $staff_if_flac="停用";
                                                                } 
                                                                if($user_rows["wxid"]<=2020000001)
                                                                    $staff_if_edit="disabled=\"disabled\"";
                                                                else
                                                                    $staff_if_edit="";
                                                                echo '<tr>'; 
                                                                echo '  <th scope="row">'.$user_rows["urid"].'</th>' .'
                                                                        <td class="text-primary"><b>'.db_getc("fy_users","id",$user_rows["urid"],"name").'</b></td>' .'
                                                                        <td><b>'                        .$user_rows["wxid"].'</b></td>' .'
                                                                        <td><b>'                     .db_getc("fy_users","id",$user_rows["urid"],"mail").'</b></td>' .'
                                                                        <td><b>'                        .$user_rows["last"].'</b></td>' .'
                                                                        <td><b>'                        .$user_rows["next"].'</b></td>' .'
                                                                        <td><b>'                        .$user_rows["wxcs"].'</b></td>' 
.'<td><button '.$staff_if_edit.'class="btn '.$staff_if_flal.'" onclick="window.location.href = \'https://fix.fyscu.com/admin/staff/staff_updt.php?type=1&acts=6&urid='.$user_rows["urid"].'\'">'.$staff_if_flac.'</button></td>' 
.'<td><button '.$staff_if_edit.'class="btn '.$staff_if_aval.'" onclick="window.location.href = \'https://fix.fyscu.com/admin/staff/staff_updt.php?type=1&acts=0&urid='.$user_rows["urid"].'\'">'.$staff_if_avac.'</button></td>' 
.'<td><button '.$staff_if_edit.'class="btn '.$staff_if_qqkl.'" onclick="window.location.href = \'https://fix.fyscu.com/admin/staff/staff_updt.php?type=1&acts=1&urid='.$user_rows["urid"].'\'">'.$staff_if_qqkc.'</button></td>'
                                                                        .'<td><b>'                      .$user_rows["qqid"].'</b></td>' 
.'<td><button '.$staff_if_edit.'class="btn '.$staff_if_setl.'" onclick="window.location.href = \'https://fix.fyscu.com/admin/staff/staff_updt.php?type=1&acts=5&urid='.$user_rows["urid"].'\'">'.$staff_if_setc.'</button></td>'
                                                                        .'<td><b>'                      .$user_rows["tips"].'</b></td>' 
                                                                        .'<td><div style="text-align:center;">
    <button '.$staff_if_edit.'class="btn btn-info"                             onclick="window.location.href = \'https://fix.fyscu.com/admin/staff/staff_edit.php?type=1&acts=2&urid='.$user_rows["urid"].'\'">编辑信息</button>
    <button '.$staff_if_edit.'class="btn btn-danger"                           onclick="window.location.href = \'https://fix.fyscu.com/admin/staff/staff_updt.php?type=1&acts=3&urid='.$user_rows["urid"].'\'">删除技工</button>
                                                              </div>' 
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
                        <button style="display:inline;" class="btn btn-success" onclick="window.location.href = 'https://fix.fyscu.com/admin/staff/staff.php?keys=<?php 
                            echo $_GET['keys']; ?>&page=<?php
                            echo $user_page_page>1?$user_page_page-1:1; ?>'      ">上一页</button>
                        <form  style="display:inline;" type="post" action="https://fix.fyscu.com/admin/staff/staff.php?keys=<?php 
                            echo $_GET['keys']; ?>">
                            <input name="page" type="text" style="display:inline;width:12%;font-size: 0.60rem;" placeholder="" class="form-control" value='<?php echo $user_page_page; ?>'/>
                            <b>/<?php echo $user_page_tota; ?>页</b>
                            <input type="submit" style="display:inline;margin-top:-1.5px" value="跳转" class="btn btn-info" />
                            <input type="hidden" style="display:inline;"  name="keys" value="<?php echo $_GET['keys']; ?>">
                        </form>
                        <button style="display:inline;" class="btn btn-success" onclick="window.location.href = 'https://fix.fyscu.com/admin/staff/staff.php?keys=<?php 
                            echo $_GET['keys']; ?>&page=<?php
                            echo $user_page_page<$user_page_tota?$user_page_page+1:$user_page_page; ?>'      ">下一页</button>
                    </div>
                </section>
                <?php include '../global/global_tails.php'; ?>
        </div>
        <?php include '../global/global_jsdat.php'; ?>
        </body>

</html>