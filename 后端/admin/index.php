<?php
    include 'check.php'; login_checker();
    include '../api/module/database.php'; 
    $datas_arry=db_alld("fy_datas","data"); 
?>
  <html>
    <?php include 'global/global_heads.php'; ?>
    <body>
        <?php include 'global/global_naves.php'; ?>
        <div class="page">
            <?php include 'global/global_title.php'; ?>
            <section class="dashboard-counts section-padding">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-2 col-md-4 col-6">
                            <div class="wrapper count-title d-flex">
                                <div class="icon">
                                    <i class="icon-user"></i>
                                </div>
                                <div class="name">
                                    <strong class="text-uppercase">今日报修</strong>
                                    <span>Today Order</span>
                                    <div class="count-number">
                                        <?php echo $datas_arry[5]+$datas_arry[6]; ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-4 col-6">
                            <div class="wrapper count-title d-flex">
                                <div class="icon">
                                    <i class="icon-padnote"></i>
                                </div>
                                <div class="name">
                                    <strong class="text-uppercase">本周报修</strong>
                                    <span>This Week</span>
                                    <div class="count-number">
                                        <?php echo $datas_arry[3]+$datas_arry[4]; ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-4 col-6">
                            <div class="wrapper count-title d-flex">
                                <div class="icon">
                                    <i class="icon-check"></i>
                                </div>
                                <div class="name">
                                    <strong class="text-uppercase">本月报修</strong>
                                    <span>This Month</span>
                                    <div class="count-number">
                                        <?php echo $datas_arry[2]; ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-4 col-6">
                            <div class="wrapper count-title d-flex">
                                <div class="icon">
                                    <i class="icon-list"></i>
                                </div>
                                <div class="name">
                                    <strong class="text-uppercase">总技术员</strong>
                                    <span>All Staffs</span>
                                    <div class="count-number">
                                        <?php echo $datas_arry[8]; ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-4 col-6">
                            <div class="wrapper count-title d-flex">
                                <div class="icon">
                                    <i class="icon-list-1"></i>
                                </div>
                                <div class="name">
                                    <strong class="text-uppercase">总用户数</strong>
                                    <span>All Users</span>
                                    <div class="count-number">
                                        <?php echo $datas_arry[7]; ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-4 col-6">
                            <div class="wrapper count-title d-flex">
                                <div class="icon">
                                    <i class="icon-list-1"></i>
                                </div>
                                <div class="name">
                                    <strong class="text-uppercase">总订单数</strong>
                                    <span>Total Order</span>
                                    <div class="count-number">
                                        <?php echo $datas_arry[9]; ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-4 col-6">
                            <div class="wrapper count-title d-flex">
                                <div class="icon">
                                    <i class="icon-list-1"></i>
                                </div>
                                <div class="name">
                                    <strong class="text-uppercase">总问答数</strong>
                                    <span>Total Question</span>
                                    <div class="count-number">
                                        <?php echo $datas_arry[10]; ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-4 col-6">
                            <div class="wrapper count-title d-flex">
                                <div class="icon">
                                    <i class="icon-list-1"></i>
                                </div>
                                <div class="name">
                                    <strong class="text-uppercase">总会员数</strong>
                                    <span>Total Vips</span>
                                    <div class="count-number">
                                        <?php echo $datas_arry[18]; ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-4 col-6">
                            <div class="wrapper count-title d-flex">
                                <div class="icon">
                                    <i class="icon-list-1"></i>
                                </div>
                                <div class="name">
                                    <strong class="text-uppercase">总反馈数</strong>
                                    <span>Total Feedback</span>
                                    <div class="count-number">
                                        <?php echo $datas_arry[19]; ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-4 col-6">
                            <div class="wrapper count-title d-flex">
                                <div class="icon">
                                    <i class="icon-list-1"></i>
                                </div>
                                <div class="name">
                                    <strong class="text-uppercase">总管理数</strong>
                                    <span>Total Admin</span>
                                    <div class="count-number">
                                        <?php echo $datas_arry[20]; ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-4 col-6">
                            <div class="wrapper count-title d-flex">
                                <div class="icon">
                                    <i class="icon-list-1"></i>
                                </div>
                                <div class="name">
                                    <strong class="text-uppercase">全局年份</strong>
                                    <span>Year</span>
                                    <div class="count-number">
                                        <?php echo db_getc("fy_confs","name","Global_Year","data")
                                        ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-4 col-6">
                            <div class="wrapper count-title d-flex">
                                <div class="icon">
                                    <i class="icon-list-1"></i>
                                </div>
                                <div class="name">
                                    <strong class="text-uppercase">全局配额</strong>
                                    <span>Order Flag</span>
                                    <div class="count-number">
                                        <?php 
                                            if($datas_arry[0]==1) echo "满"; 
                                            if($datas_arry[0]==0) echo "空"; 
                                        ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Header Section-->
            <section class="dashboard-header section-padding">
                <div class="container-fluid">
                    <div class="row d-flex align-items-md-stretch">
                        <!-- To Do List-->
                        <div class="col-lg-3 col-md-6">
                            <div class="card to-do">
                                <form method="post" action="index/index_conf.php">
                                    <h2 class="display h4">全局状态</h2>
                                    <br />
                                    <h3 class="display h4">配额状态：
        <?php 
            if(db_getc( "fy_confs", "name", "Global_Flag", "data")==0){
                $index_info_color="badge-danger";
                $index_info_texts="全局设置关闭报修 系统停止接单";
            }
            elseif(db_getc( "fy_confs", "name", "Global_Flag", "data")==2){
                $index_info_color="badge-info";
                $index_info_texts="全局设置仅限会员 系统限制接单";
            }
            else{
                if($datas_arry[0]==1) {
                    $index_info_color="badge-danger";
                    $index_info_texts="当前报修名额已满 系统停止接单";
                }
                elseif($datas_arry[0]==0){
                    $index_info_color="badge-success";
                    $index_info_texts="当前报修名额充足 系统正常接单";
                }
                elseif($datas_arry[0]==2){
                    $index_info_color="badge-warning";
                    $index_info_texts="当前游客配额已满 系统限制接单";
                }
            }
            
            echo '<div style="font-size:15px;" class="badge '.$index_info_color.'">'.$index_info_texts.'</div></a></li>'; 
        ?>
                                    </h3>
                                    <br />
                                    <div style="display:inline-block;float:left;width:100%;" class="display h4">全局开关：
                                        <select name="Flag" style="display:inline-block;width:60%;" name="index_switch" class="form-control">
                                            <option value="1" <?php if(db_getc( "fy_confs", "name", "Global_Flag", "data")==1) echo "selected";?>>全部开启</option>
                                            <option value="0" <?php if(db_getc( "fy_confs", "name", "Global_Flag", "data")==0) echo "selected";?>>全部关闭</option>
                                            <option value="2" <?php if(db_getc( "fy_confs", "name", "Global_Flag", "data")==2) echo "selected";?>>仅限会员</option></select>
                                    </div>
                                    <h3 class="display h4">时间年份：
                                        <input name="Year" style="display:inline-block;width:60%" ; placeholder="年份：如2020" value="<?php echo db_getc("fy_confs","name","Global_Year","data");?>" class="form-control"></h3>
                                    <br />
                                    <dev>
                                        <h3 style="display:inline;" class="display h4">每天限制：
                                            <input name="Days" style="display:inline-block;width:15%" ; placeholder="年份：如2020" value="<?php echo db_getc("fy_confs","name","Global_Days","data");?>" class="form-control"></h3>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <h3 style="display:inline;" class="display h4">每天游客：
                                            <input name="nop_Days" style="display:inline-block;width:15%" ; placeholder="年份：如2020" value="<?php echo db_getc("fy_confs","name","Limits_Days","data");?>" class="form-control"></h3>
                                    </dev><br /><br />
                                    <dev>
                                        <h3 style="display:inline;" class="display h4">每周限制：
                                            <input name="Week" style="display:inline-block;width:15%" ; placeholder="年份：如2020" value="<?php echo db_getc("fy_confs","name","Global_Week","data");?>" class="form-control"></h3>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <h3 style="display:inline;" class="display h4">每周游客：
                                            <input name="nop_Week" style="display:inline-block;width:15%" ; placeholder="年份：如2020" value="<?php echo db_getc("fy_confs","name","Limits_Week","data");?>" class="form-control"></h3>
                                    </dev><br /><br />
                                    <dev>
                                        <h3 style="display:inline;" class="display h4">每月限制：
                                            <input name="Mont" style="display:inline-block;width:60%" ; placeholder="年份：如2020" value="<?php echo db_getc("fy_confs","name","Global_Mont","data");?>" class="form-control"></h3>&nbsp;&nbsp;&nbsp;&nbsp;
                                    </dev><br /><br />
                                    <br />
                                    <input style="width:85%;" type="submit" value="保存设置" class="btn btn-warning"></form>
                            </div>
                        </div>
                        <!-- Pie Chart-->
                        <div class="col-lg-3 col-md-6">
                            <div class="card project-progress">
                                <h2 class="display h4">公告内容</h2>
                                <p style="font-size:107%;">小程序端显示公告内容</p>
                                <form method="post" action="index/index_tips.php">
                                    <textarea name="Tips" type="text" style="width:80%;" cols=2 rows="14.5" class="form-control"><?php echo preg_replace( "#\t#", "",db_getc( "fy_confs", "name", "Global_Tips", "data"));?></textarea>
                                    <br />
                                    <input style="width:80%;" type="submit" value="修改公告" class="btn btn-info"></form>
                            </div>
                        </div>
                        <!-- Line Chart -->
                        <div class="col-lg-6 col-md-12 flex-lg-last flex-md-first align-self-baseline">
                            <div class="card sales-report">
                                <h2 class="display h4">本周报修情况</h2>
                                <p>本周报修情况分布</p>
                                <div class="line-chart">
                                    <canvas id="lineCahrt"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Statistics Section-->
            <section class="statistics">
                <div class="container-fluid">
                    <div class="row d-flex">
                        <div style="width:150%;" class="col-lg-3 col-md-6">
                            <div style="width:100%;!important" class="card project-progress">
                                <h2 class="text-primary">今日报修</h2>
                                <p>今日报修情况分布</p>
                                <div class="pie-chart">
                                    <canvas id="pieChart" width="300" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card data-usage">
                                <h2 class="text-primary">本月报修</h2>
                                <br />
                                <br />
                                <small>计划占比&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; 占用/总共</small>
                                <div class="row d-flex align-items-center">
                                    <div class="col-sm-6">
                                        <strong>
                                            <?php $index_if_datas=db_getc("fy_confs","name","Global_Mont","data");if($index_if_datas==0)echo 0; else echo round( 100*$datas_arry[2] / $index_if_datas ); ?>%</strong>
                                        <!---<div id="progress-circle" class="d-flex align-items-center justify-content-center"></div>---></div>
                                    <div class="col-sm-6">
                                        <strong class="text-primary">
                                            <?php echo $datas_arry[2]; ?>/
                                                <?php echo db_getc("fy_confs","name","Global_Mont","data"); ?></strong>
                                        <span></span>
                                    </div>
                                </div>
                                <br />
                                <br />
                                <h2 class="text-primary">总共报修</h2>
                                <div class=" income text-center">
                                    <br />
                                    <div class="icon">
                                        <i class="icon-line-chart"></i>
                                    </div>
                                    <div class="number">
                                        <?php echo $datas_arry[1]; ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card user-activity">
                                <h2 class="text-primary">本周配额</h2>
                                <div class="number">
                                    <?php echo $datas_arry[3]+$datas_arry[4]; ?></div>
                                <br />
                                <br />
                                <h3 class="h4 display">本周已报修</h3>
                                <div class="progress">
                                    <div role="progressbar" style="width: 
                                    <?php
                                    if(db_getc("fy_confs","name","Global_Week","data")==0) echo 0;
                                    else echo 100*($datas_arry[3]+$datas_arry[4])/intval(db_getc("fy_confs","name","Global_Week","data"));
                                    ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar bg-primary">
                                    </div>
                                </div>
                                <br />
                                <br />
                                <div class="page-statistics d-flex justify-content-between">
                                    <div class="page-statistics-left">
                                        <span>本周报修配额</span>
                                        <strong>
                                            <?php echo db_getc("fy_confs","name","Global_Week","data"); ?></strong>
                                    </div>
                                    <div class="page-statistics-right">
                                        <span>使用占比</span>
                                        <strong>
                                            <?php if(db_getc("fy_confs","name","Global_Week","data")==0) echo 0; else echo (100*$datas_arry[3]+$datas_arry[4])/db_getc("fy_confs","name","Global_Week","data"); ?>%</strong></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!------------------------------------------------------------------------------------------------------------------------------------>
            <?php include 'global/global_tails.php'; ?>
        </div>
        <?php include 'global/global_jsdat.php'; ?>
        <script>/*global $, document, Chart, LINECHART, data, options, window*/
            $(document).ready(function() {
                'use strict';
                // Main Template Color
                var brandPrimary = '#33b35a';
                // ------------------------------------------------------- //
                // Line Chart
                // ------------------------------------------------------ //
                var LINECHART = $('#lineCahrt');
                var myLineChart = new Chart(LINECHART, {
                    type: 'line',
                    options: {
                        legend: {
                            display: false
                        }
                    },
                    data: {
                        labels: ["周一", "周二", "周三", "周四", "周五", "周六", "周天"],
                        datasets: [{
                            label: "会员报修情况",
                            fill: true,
                            lineTension: 0.3,
                            backgroundColor: "rgba(77, 193, 75, 0.4)",
                            borderColor: brandPrimary,
                            borderCapStyle: 'butt',
                            borderDash: [],
                            borderDashOffset: 0.0,
                            borderJoinStyle: 'miter',
                            borderWidth: 1,
                            pointBorderColor: brandPrimary,
                            pointBackgroundColor: "#fff",
                            pointBorderWidth: 1,
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: brandPrimary,
                            pointHoverBorderColor: "rgba(220,220,220,1)",
                            pointHoverBorderWidth: 2,
                            pointRadius: 1,
                            pointHitRadius: 0,
                            data: [ <?php echo $datas_arry[11]; ?>, 
                                    <?php echo $datas_arry[12]; ?>, 
                                    <?php echo $datas_arry[13]; ?>, 
                                    <?php echo $datas_arry[14]; ?>, 
                                    <?php echo $datas_arry[15]; ?>, 
                                    <?php echo $datas_arry[16]; ?>, 
                                    <?php echo $datas_arry[17]; ?>],
                            spanGaps: false
                        },
                        {
                            label: "游客报修情况",
                            fill: true,
                            lineTension: 0.3,
                            backgroundColor: "rgba(75,192,192,0.4)",
                            borderColor: "rgba(75,192,192,1)",
                            borderCapStyle: 'butt',
                            borderDash: [],
                            borderDashOffset: 0.0,
                            borderJoinStyle: 'miter',
                            borderWidth: 1,
                            pointBorderColor: "rgba(75,192,192,1)",
                            pointBackgroundColor: "#fff",
                            pointBorderWidth: 1,
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: "rgba(75,192,192,1)",
                            pointHoverBorderColor: "rgba(220,220,220,1)",
                            pointHoverBorderWidth: 2,
                            pointRadius: 1,
                            pointHitRadius: 10,
                            data: [ <?php echo $datas_arry[21]; ?>, 
                                    <?php echo $datas_arry[22]; ?>, 
                                    <?php echo $datas_arry[23]; ?>, 
                                    <?php echo $datas_arry[24]; ?>, 
                                    <?php echo $datas_arry[25]; ?>, 
                                    <?php echo $datas_arry[26]; ?>, 
                                    <?php echo $datas_arry[27]; ?>],
                            spanGaps: false
                        }]
                    }
                });

                // ------------------------------------------------------- //
                // Pie Chart
                // ------------------------------------------------------ //
                var PIECHART = $('#pieChart');
                var myPieChart = new Chart(PIECHART, {
                    type: 'doughnut',
                    data: {
                        labels: ["会员", "非会员", ],
                        datasets: [{
                            data: [ <?php echo $datas_arry[5]; ?>, 
                                    <?php echo $datas_arry[6]; ?>, 0],
                            borderWidth: [1, 1],
                            backgroundColor: [brandPrimary, "rgba(75,192,192,1)", "#FFCE56"],
                            hoverBackgroundColor: [brandPrimary, "rgba(75,192,192,1)", "#FFCE56"]
                        }]
                    }
                });

            });</script>
    </body>

</html>