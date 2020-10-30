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
                                        <h4  style="display:inline;float:left;font-size:32px;">反馈管理</h4>
                                        <div style="display:inline;float:right;height:41px;margin-right:-35px;margin:auto -50px">
                                            <form style="display:inline;height:50px" type="post" action="https://fix.fyscu.com/admin/backs/backs.php">
                                                <input name="keys" type="text" style="display:inline;width:27%;font-size: 0.60rem;" placeholder="输入搜索内容" class="form-control" />
                                                <input type="submit" style="display:inline;margin-top:-1.5px" value="搜索" class="btn btn-info" /></form>
                                            <button style="display:inline;margin-top:-1.5px" class="btn btn-success" onclick="window.location.href = 'https://fix.fyscu.com/admin/feeds/feeds_edit.php?type=0'" disabled="disabled">新增</button>
                                            <button style="display:inline;margin-top:-1.5px" class="btn btn-default" onclick="window.location.href = 'https://fix.fyscu.com/admin/feeds/feeds_impo.php?type=0'" disabled="disabled">导入</button></div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-sm">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align:center;">反馈编号</th>
                                                        <th style="text-align:center;">反馈用户</th>
                                                        <th style="text-align:center;">反馈时间</th>
                                                        <th style="text-align:center;">用户称呼</th>
                                                        <th style="text-align:center;">用户手机</th>
                                                        <th style="text-align:center;">反馈内容</th>
                                                        <th style="text-align:center;">操作</th></tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                    $feeds_page_page=1;
                                                    if($_GET['page']!='')
                                                        try {
                                                            $feeds_page_page=intval($_GET['page']);
                                                        } catch (Exception $erro) {
                                                            header("Location: index.php");
                                                        }
                                                    else{
                                                        $feeds_page_page=1;
                                                    }
                                                    $feeds_page_lens=20;//单页长度
                                                    $feeds_page_loop= 0;//当前项数
                                                    $feeds_page_tota= 1;//总共页数
                                                    $feeds_page_ltmp= 0;//页码计数
                                                    $feeds_data=db_alls("fy_feeds");
                                                    //---------------------------查找总页数--------------------------
                                                    while($feeds_rows=$feeds_data->fetch_assoc()) { 
                                                        $feeds_flag=0;
                                                        if($_GET['keys']!="")
                                                            { 
                                                            if( substr_count($feeds_rows["fkid"],$_GET['keys'])>0 
                                                              ||substr_count($feeds_rows["urid"],$_GET['keys']) 
                                                              ||substr_count($feeds_rows["pnum"],$_GET['keys']) 
                                                              ||substr_count($feeds_rows["name"],$_GET['keys'])
                                                              ||substr_count($feeds_rows["text"],$_GET['keys']) 
                                                              ||substr_count(db_getc("fy_users","id",$feeds_rows['urid'],"name"),$_GET['keys']) 
                                                              ) 
                                                                $feeds_page_ltmp=$feeds_page_ltmp+1; 
                                                            } 
                                                            else 
                                                                $feeds_page_ltmp =$feeds_page_ltmp+1; 
                                                            if ($feeds_page_ltmp>=$feeds_page_lens){
                                                                $feeds_page_tota =$feeds_page_tota+1;
                                                                $feeds_page_ltmp=0;
                                                            }
                                                    }
                                                    $feeds_dat2=db_alls("fy_feeds");$feeds_page_loop=0;
                                                    //---------------------------查找总页数--------------------------
                                                    while($feeds_rows=$feeds_dat2->fetch_assoc()) { 
                                                        $feeds_flag=0;
                                                        if($_GET['keys']!="")
                                                            { 
                                                            if( substr_count($feeds_rows["fkid"],$_GET['keys'])>0 
                                                              ||substr_count($feeds_rows["urid"],$_GET['keys']) 
                                                              ||substr_count($feeds_rows["pnum"],$_GET['keys']) 
                                                              ||substr_count($feeds_rows["name"],$_GET['keys'])
                                                              ||substr_count($feeds_rows["text"],$_GET['keys']) 
                                                              ||substr_count(db_getc("fy_users","id",$feeds_rows['urid'],"name"),$_GET['keys']) 
                                                              ) 
                                                                $feeds_flag= 1; 
                                                            } 
                                                            else 
                                                                $feeds_flag= 1; 
                                                            if ($feeds_flag==1)
                                                                {
                                                                 $feeds_page_loop= $feeds_page_loop+1;
                                                                if($feeds_page_loop> $feeds_page_lens* $feeds_page_page
                                                                 ||$feeds_page_loop<=$feeds_page_lens*($feeds_page_page-1))
                                                                    continue;
                                                                if(strlen($feeds_rows["text"])>60)
                                                                    $feeds_text=mb_substr($feeds_rows["text"],0,60)."..........";
                                                                else
                                                                    $feeds_text=$feeds_rows["text"];
                                                                if( $feeds_rows["fkid"]<=2020000000) 
                                                                    $feeds_if_edit="disabled=\"disabled\"";
                                                                else 
                                                                    $feeds_if_edit="";
                                                                echo '<tr>'; 
                                                                echo '<th scope="row" style="text-align:center;>'.$feeds_rows["fkid"].'</th>'
                                                                    .'<td><b style="text-align:center;">'.$feeds_rows["fkid"].'</b></td>'
                                                                    .'<td><b style="text-align:center;">'.db_getc("fy_users","id",$feeds_rows["urid"],"name").'</b></td>' 
                                                                    .'<td><b style="text-align:center;">'.$feeds_rows["time"].'</b></td>'
                                                                    .'<td><b style="text-align:center;">'.$feeds_rows["name"].'</b></td>' 
                                                                    .'<td><b style="text-align:center;">'.$feeds_rows["pnum"].'</b></td>' 
                                                                    .'<td><b style="text-align:center;">'.$feeds_text        .'</b></td>' 
                                                                    .'<td><div style=\"text-align:center;\">'
.' <button '.$feeds_if_edit.'class="btn btn-info"    onclick="window.location.href = \'https://fix.fyscu.com/admin/backs/backs_edit.php?type=1&acts=2&fkid='.$feeds_rows["fkid"].'\'">查看</button>'
.' <button '.$feeds_if_edit.'class="btn btn-danger"  onclick="window.location.href = \'https://fix.fyscu.com/admin/backs/backs_updt.php?type=1&acts=3&fkid='.$feeds_rows["fkid"].'\'">删除</button>'
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
                        <button style="display:inline;" class="btn btn-success" onclick="window.location.href = 'https://fix.fyscu.com/admin/backs/backs.php?keys=<?php 
                            echo $_GET['keys']; ?>&page=<?php
                            echo $feeds_page_page>1?$feeds_page_page-1:1; ?>'      ">上一页</button>
                        <form  style="display:inline;" type="post" action="https://fix.fyscu.com/admin/backs/backs.php?keys=<?php 
                            echo $_GET['keys']; ?>">
                            <input name="page" type="text" style="display:inline;width:12%;font-size: 0.60rem;" placeholder="" class="form-control" value='<?php echo $feeds_page_page; ?>'/>
                            <b>/<?php echo $feeds_page_tota; ?>页</b>
                            <input type="submit" style="display:inline;margin-top:-1.5px" value="跳转" class="btn btn-info" />
                            <input type="hidden" style="display:inline;"  name="keys" value="<?php echo $_GET['keys']; ?>">
                        </form>
                        <button style="display:inline;" class="btn btn-success" onclick="window.location.href = 'https://fix.fyscu.com/admin/backs/backs.php?keys=<?php 
                            echo $_GET['keys']; ?>&page=<?php
                            echo $feeds_page_page<$feeds_page_tota?$feeds_page_page+1:$feeds_page_page; ?>'      ">下一页</button>
                    </div>
                    
                   
                </section>
                <?php include '../global/global_tails.php'; ?>
        </div>
        <?php include '../global/global_jsdat.php'; ?>
        </body>

</html>