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
                                        <h4  style="display:inline;float:left;font-size:32px;">用户管理</h4>
                                        <div style="display:inline;float:right;height:41px;margin-right:-35px;margin:auto -50px">
                                            <form style="display:inline;height:50px" type="post" action="https://fix.fyscu.com/admin/users/users.php">
                                                <input name="keys" type="text" style="display:inline;width:27%;font-size: 0.60rem;" placeholder="输入搜索内容" class="form-control" />
                                                <input type="submit" style="display:inline;margin-top:-1.5px" value="搜索" class="btn btn-info" /></form>
                                            <button style="display:inline;margin-top:-1.5px" class="btn btn-success" onclick="window.location.href = 'https://fix.fyscu.com/admin/users/users_edit.php?type=0'">新增</button>
                                            <button style="display:inline;margin-top:-1.5px" class="btn btn-default" onclick="window.location.href = 'https://fix.fyscu.com/admin/users/users_impo.php?type=0'" disabled="disabled">导入</button></div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>编号</th>
                                                        <th>姓名</th>
                                                        <th>电话</th>
                                                        <th>邮箱</th>
                                                        <th>注册时间</th>
                                                        <th>是否会员</th>
                                                        <th>会员ID</th>
                                                        <th>是否技术</th>
                                                        <th>技术ID</th>
                                                        <th>停用</th>
                                                        <th>会话</th>
                                                        <th>短信</th>
                                                        <th>状态</th>
                                                        <th>初始化</th>
                                                        <!--<th>头像</th>--->
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
                                                    $users_data=db_alls("fy_users");
                                                    //---------------------------查找总页数--------------------------
                                                    while($user_rows=$users_data->fetch_assoc()) { 
                                                        $users_flag=0;
                                                        if($_GET['keys']!="")
                                                            { 
                                                            if( substr_count($user_rows["name"],$_GET['keys'])>0 
                                                              ||substr_count($user_rows["pnum"],$_GET['keys']) 
                                                              ||substr_count($user_rows["mail"],$_GET['keys']) 
                                                              ||substr_count($user_rows["hyid"],$_GET['keys']) 
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
                                                    $users_dat2=db_alls("fy_users");$user_page_loop=0;
                                                    //---------------------------查找总页数--------------------------
                                                    while($user_rows=$users_dat2->fetch_assoc()) { 
                                                        $users_flag=0;
                                                        if($_GET['keys']!="")
                                                            { 
                                                            if( substr_count($user_rows["name"],$_GET['keys'])>0 
                                                              ||substr_count($user_rows["pnum"],$_GET['keys']) 
                                                              ||substr_count($user_rows["mail"],$_GET['keys']) 
                                                              ||substr_count($user_rows["hyid"],$_GET['keys']) 
                                                              ||substr_count($user_rows["wxid"],$_GET['keys']) 
                                                              ||substr_count($user_rows["seid"],$_GET['keys'])
                                                              ||substr_count($user_rows["code"],$_GET['keys']) 
                                                              ||substr_count($user_rows["txtp"],$_GET['keys']) ) 
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
                                                                if($user_rows["vips"]==1) {
                                                                    $users_if_sata="btn-success";
                                                                    $users_if_satb="会员";
                                                                    
                                                                }
                                                                else                      {
                                                                    $users_if_sata="btn-info";
                                                                    $users_if_satb="用户";
                                                                } 
                                                                if($user_rows["fixs"]==1) {
                                                                    $users_if_fixs="<center><button disabled=\"disabled\" style=\"text-align:center;\" class=\"btn btn-warning\">是</button></center>"; 
                                                                    $users_if_addb="已是技工";
                                                                    $users_if_colp="btn-default";
                                                                    $users_if_banp=" disabled=\"disabled\" ";
                                                                }
                                                                else   {
                                                                    $users_if_fixs="<center><button disabled=\"disabled\" style=\"text-align:center;\" class=\"btn btn-default\">否</button></center>"; 
                                                                    $users_if_addb="添加技工";
                                                                    $users_if_colp="btn-warning";
                                                                    $users_if_banp="";
                                                                }                   
                                                                if($user_rows["bans"]==1) {
                                                                    $users_if_colo="btn-danger";
                                                                    $users_if_colb="停用";
                                                                }
                                                                else  {
                                                                    $users_if_colo="btn-info";
                                                                    $users_if_colb="启用";
                                                                }
                                                                if($user_rows["flag"]==1) {
                                                                    $users_if_flgo="btn-warning";
                                                                    $users_if_flag="维修中"; 
                                                                }
                                                                else   {
                                                                    $users_if_flgo="btn-default";
                                                                    $users_if_flag="空闲中"; 
                                                                }                   
                                                                if($user_rows["init"]==1) 
                                                                    $users_if_init="<center><button disabled=\"disabled\" style=\"text-align:center;\" class=\"btn btn-default\">是</button></center>"; 
                                                                else                      
                                                                    $users_if_init="<center><button disabled=\"disabled\" style=\"text-align:center;\" class=\"btn btn-warning\">否</button></center>"; 
                                                                if($user_rows["id"]<=2020000001 and $user_rows["id"]>=2020000000)
                                                                    $users_if_edit="disabled=\"disabled\"";
                                                                else
                                                                    $users_if_edit="";
                                                                echo '<tr>'; 
                                                                echo '<th scope="row">'.$user_rows["id"].'</th>' .'
                                                                        <td class="text-primary"><b>'.$user_rows["name"].'</b></td>' .'
                                                                        <td><b>'                        .$user_rows["pnum"].'</b></td>' .'
                                                                        <td><b>'                        .$user_rows["mail"].'</b></td>' .'
                                                                        <td><b>'                        .$user_rows["date"].'</b></td>' .'
                                                                        <td>'.'
                <button '.$users_if_edit.'class="btn '.$users_if_sata.'" onclick="window.location.href = \'https://fix.fyscu.com/admin/users/users_updt.php?type=1&acts=0&urid='.$user_rows["id"].'\'">'.$users_if_satb.'</button>
                                                                    '.'</td>' .'
                                                                        <td><b>'                        .$user_rows["hyid"].'</b></td>' .'
                                                                        <td><b>'                        .$users_if_fixs    .'</b></td>' .'
                                                                        <td><b>'                        .$user_rows["wxid"].'</b></td>' .'
                                                                        <td>'.'
                <button '.$users_if_edit.'class="btn '.$users_if_colo.'" onclick="window.location.href = \'https://fix.fyscu.com/admin/users/users_updt.php?type=1&acts=1&urid='.$user_rows["id"].'\'">'.$users_if_colb.'</button>
                                                                    '.'</td>'.'
                                                                        <td><b>'                        .$user_rows["seid"].'</b></td>' .'
                                                                        <td><b>'                        .$user_rows["code"].'</b></td>' .'
                                                                        <td><b>'.'
                <button '.$users_if_edit.'class="btn '.$users_if_flgo.'" onclick="window.location.href = \'https://fix.fyscu.com/admin/users/users_updt.php?type=1&acts=5&urid='.$user_rows["id"].'\'">'.$users_if_flag.'</button>
                                                                    '.'</td>'.'
                                                                        <td><b>'                        .$users_if_init    .'</b></td>' .'
                                                                    <!--<td><b>'                        .$user_rows["txtp"].'</b></td>' .'--->
                                                                        <td>' .'<div style="text-align:center;">
                                
<button '.$users_if_edit.'class="btn '.$users_if_colp.'" '.$users_if_banp.'onclick="window.location.href=\'https://fix.fyscu.com/admin/staff/staff_edit.php?type=0&acts=1&urid='.$user_rows["id"].'\'">'.$users_if_addb.'</button>
<button '.$users_if_edit.'class="btn btn-info"                             onclick="window.location.href=\'https://fix.fyscu.com/admin/users/users_edit.php?type=1&acts=2&urid='.$user_rows["id"].'\'">编辑信息</button>
<button '.$users_if_edit.'class="btn btn-danger"                           onclick="window.location.href=\'https://fix.fyscu.com/admin/users/users_updt.php?type=1&acts=3&urid='.$user_rows["id"].'\'">删除用户</button>
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
                        <button style="display:inline;" class="btn btn-success" onclick="window.location.href = 'https://fix.fyscu.com/admin/users/users.php?keys=<?php 
                            echo $_GET['keys']; ?>&page=<?php
                            echo $user_page_page>1?$user_page_page-1:1; ?>'      ">上一页</button>
                        <form  style="display:inline;" type="post" action="https://fix.fyscu.com/admin/users/users.php?keys=<?php 
                            echo $_GET['keys']; ?>">
                            <input name="page" type="text" style="display:inline;width:12%;font-size: 0.60rem;" placeholder="" class="form-control" value='<?php echo $user_page_page; ?>'/>
                            <b>/<?php echo $user_page_tota; ?>页</b>
                            <input type="submit" style="display:inline;margin-top:-1.5px" value="跳转" class="btn btn-info" />
                            <input type="hidden" style="display:inline;"  name="keys" value="<?php echo $_GET['keys']; ?>">
                        </form>
                        <button style="display:inline;" class="btn btn-success" onclick="window.location.href = 'https://fix.fyscu.com/admin/users/users.php?keys=<?php 
                            echo $_GET['keys']; ?>&page=<?php
                            echo $user_page_page<$user_page_tota?$user_page_page+1:$user_page_page; ?>'      ">下一页</button>
                    </div>
                </section>
            <?php include '../global/global_tails.php'; ?>
        </div>
        <?php include '../global/global_jsdat.php'; ?>
    </body>
</html>