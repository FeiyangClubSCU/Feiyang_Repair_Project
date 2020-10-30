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
                                        <h4  style="display:inline;float:left;font-size:32px;">提问管理</h4>
                                        <div style="display:inline;float:right;height:41px;margin-right:-35px;margin:auto -50px">
                                            <form style="display:inline;height:50px" type="post" action="https://fix.fyscu.com/admin/infos/infos.php">
                                                <input name="keys" type="text" style="display:inline;width:27%;font-size: 0.60rem;" placeholder="输入搜索内容" class="form-control" />
                                                <input type="submit" style="display:inline;margin-top:-1.5px" value="搜索" class="btn btn-info" /></form>
                                            <button style="display:inline;margin-top:-1.5px" class="btn btn-success" onclick="window.location.href = 'https://fix.fyscu.com/admin/infos/infos_edit.php?type=0'">新增</button>
                                            <button style="display:inline;margin-top:-1.5px" class="btn btn-default" onclick="window.location.href = 'https://fix.fyscu.com/admin/infos/infos_impo.php?type=0'" disabled="disabled">导入</button></div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-sm">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align:center;">索引编号</th>
                                                        <th style="text-align:center;">回答人</th>
                                                        <th style="text-align:center;">提问者</th>
                                                        <th style="text-align:center;">点赞数</th>
                                                        <th style="text-align:center;">回答状态</th>
                                                        <th style="text-align:center;">提问时间</th>
                                                        <th style="text-align:center;">关联问题</th>
                                                        <th style="text-align:center;">问题摘要</th>
                                                        <th style="text-align:center;">提问内容</th>
                                                        <th style="text-align:center;">回答内容</th>
                                                        <th style="text-align:center;">操作</th></tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                    $infos_page_page=1;
                                                    if($_GET['page']!='')
                                                        try {
                                                            $infos_page_page=intval($_GET['page']);
                                                        } catch (Exception $erro) {
                                                            header("Location: index.php");
                                                        }
                                                    else{
                                                        $infos_page_page=1;
                                                    }
                                                    $infos_page_lens=20;//单页长度
                                                    $infos_page_loop= 0;//当前项数
                                                    $infos_page_tota= 1;//总共页数
                                                    $infos_page_ltmp= 0;//页码计数
                                                    $infos_data=db_alls("fy_infos");
                                                    //---------------------------查找总页数--------------------------
                                                    while($infos_rows=$infos_data->fetch_assoc()) { 
                                                        $infos_flag=0;
                                                        if($_GET['keys']!="")
                                                            { 
                                                            if( substr_count($infos_rows["ssid"],$_GET['keys'])>0 
                                                              ||substr_count($infos_rows["urid"],$_GET['keys']) 
                                                              ||substr_count($infos_rows["twid"],$_GET['keys']) 
                                                              ||substr_count($infos_rows["good"],$_GET['keys'])
                                                              ||substr_count($infos_rows["ansd"],$_GET['keys']) 
                                                              ||substr_count($infos_rows["cont"],$_GET['keys']) 
                                                              ||substr_count($infos_rows["tipe"],$_GET['keys']) 
                                                              ||substr_count($infos_rows["wzbt"],$_GET['keys']) 
                                                              ||substr_count($infos_rows["txet"],$_GET['keys']) 
                                                              ||substr_count(db_getc("fy_users","id",$infos_rows['urid'],"name"),$_GET['keys']) 
                                                              ||substr_count(db_getc("fy_users","id",$infos_rows['twid'],"name"),$_GET['keys']) 
                                                              ) 
                                                                $infos_page_ltmp=$infos_page_ltmp+1; 
                                                            } 
                                                            else 
                                                                $infos_page_ltmp =$infos_page_ltmp+1; 
                                                            if ($infos_page_ltmp>=$infos_page_lens){
                                                                $infos_page_tota =$infos_page_tota+1;
                                                                $infos_page_ltmp=0;
                                                            }
                                                    }
                                                    $infos_dat2=db_alls("fy_infos");$infos_page_loop=0;
                                                    //---------------------------查找总页数--------------------------
                                                    while($infos_rows=$infos_dat2->fetch_assoc()) { 
                                                        $infos_flag=0;
                                                        if($_GET['keys']!="")
                                                            { 
                                                            if( substr_count($infos_rows["ssid"],$_GET['keys'])>0 
                                                              ||substr_count($infos_rows["urid"],$_GET['keys']) 
                                                              ||substr_count($infos_rows["twid"],$_GET['keys']) 
                                                              ||substr_count($infos_rows["good"],$_GET['keys'])
                                                              ||substr_count($infos_rows["ansd"],$_GET['keys']) 
                                                              ||substr_count($infos_rows["cont"],$_GET['keys']) 
                                                              ||substr_count($infos_rows["tipe"],$_GET['keys']) 
                                                              ||substr_count($infos_rows["wzbt"],$_GET['keys']) 
                                                              ||substr_count($infos_rows["txet"],$_GET['keys']) 
                                                              ||substr_count(db_getc("fy_users","id",$infos_rows['urid'],"name"),$_GET['keys']) 
                                                              ||substr_count(db_getc("fy_users","id",$infos_rows['twid'],"name"),$_GET['keys']) 
                                                              ) 
                                                                $infos_flag= 1; 
                                                            } 
                                                            else 
                                                                $infos_flag= 1; 
                                                            if ($infos_flag==1)
                                                                {
                                                                 $infos_page_loop= $infos_page_loop+1;
                                                                if($infos_page_loop> $infos_page_lens* $infos_page_page
                                                                 ||$infos_page_loop<=$infos_page_lens*($infos_page_page-1))
                                                                    continue;
                                                                if(    $infos_rows["ansd"]==0) {
                                                                    $infos_if_csss="";
                                                                    $infos_if_text="等待";
                                                                    $infos_if_bans="                      class=\"btn btn-warning\"";
                                                                }
                                                                else {
                                                                    $infos_if_csss="";
                                                                    $infos_if_text="已答";
                                                                    $infos_if_bans="disabled=\"disabled\" class=\"btn btn-success\"";
                                                                }
                                                                if(strlen($infos_rows["tips"])>10)
                                                                    $infos_tips=mb_substr($infos_rows["tips"],0,10)."...";
                                                                else
                                                                    $infos_tips=$infos_rows["tips"];
                                                                if(strlen($infos_rows["wzbt"])>20)
                                                                    $infos_wzbt=mb_substr($infos_rows["wzbt"],0,20)."...";
                                                                else
                                                                    $infos_wzbt=$infos_rows["wzbt"];
                                                                if(strlen($infos_rows["text"])>20)
                                                                    $infos_text=mb_substr($infos_rows["text"],0,20)."...";
                                                                else
                                                                    $infos_text=$infos_rows["text"];
                                                                echo '<tr>'; 
                                                                echo 
                                                            '<th scope="row">'.$infos_rows["ssid"].'</th>' 
                                                                    .'<td><b>'.db_getc("fy_users","id",$infos_rows["urid"],"name").'</b></td>' 
                                                                    .'<td><b>'.db_getc("fy_users","id",$infos_rows["twid"],"name").'</b></td>' 
                                                                    .'<td><b>'.$infos_rows["good"].'</b></td>'
.'<td><button '.$infos_if_bans.' onclick="window.location.href = \'https://fix.fyscu.com/admin/infos/infos_updt.php?type=1&acts=2&ssid='.$infos_rows["ssid"].'\'">'.$infos_if_text.'</button></td>' 
                                                                    .'<td><b>'.$infos_rows["date"].'</b></td>'
                                                                    .'<td><b>'.$infos_rows["cont"].'</b></td>'
                                                                    .'<td><b>'.$infos_tips.'</b></td>'
                                                                    .'<td><b>'.$infos_wzbt.'</b></td>'
                                                                    .'<td><b>'.$infos_text.'</b></td>'
                                                                    .'<td><div style=\"text-align:center;\">'
.' <button '.$infos_if_edit.'class="btn btn-info"    onclick="window.location.href = \'https://fix.fyscu.com/admin/infos/infos_edit.php?type=1&acts=0&ssid='.$infos_rows["ssid"].'\'">编辑</button>'
.' <button '.$infos_if_edit.'class="btn btn-danger"  onclick="window.location.href = \'https://fix.fyscu.com/admin/infos/infos_updt.php?type=1&acts=3&ssid='.$infos_rows["ssid"].'\'">删除</button>'
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
                        <button style="display:inline;" class="btn btn-success" onclick="window.location.href = 'https://fix.fyscu.com/admin/infos/infos.php?keys=<?php 
                            echo $_GET['keys']; ?>&page=<?php
                            echo $infos_page_page>1?$infos_page_page-1:1; ?>'      ">上一页</button>
                        <form  style="display:inline;" type="post" action="https://fix.fyscu.com/admin/infos/infos.php?keys=<?php 
                            echo $_GET['keys']; ?>">
                            <input name="page" type="text" style="display:inline;width:12%;font-size: 0.60rem;" placeholder="" class="form-control" value='<?php echo $infos_page_page; ?>'/>
                            <b>/<?php echo $infos_page_tota; ?>页</b>
                            <input type="submit" style="display:inline;margin-top:-1.5px" value="跳转" class="btn btn-info" />
                            <input type="hidden" style="display:inline;"  name="keys" value="<?php echo $_GET['keys']; ?>">
                        </form>
                        <button style="display:inline;" class="btn btn-success" onclick="window.location.href = 'https://fix.fyscu.com/admin/infos/infos.php?keys=<?php 
                            echo $_GET['keys']; ?>&page=<?php
                            echo $infos_page_page<$infos_page_tota?$infos_page_page+1:$infos_page_page; ?>'      ">下一页</button>
                    </div>
                    
                   
                </section>
                <?php include '../global/global_tails.php'; ?>
        </div>
        <?php include '../global/global_jsdat.php'; ?>
        </body>

</html>