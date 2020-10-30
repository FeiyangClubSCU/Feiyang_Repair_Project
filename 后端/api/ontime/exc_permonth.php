<?php
/*--------------------------------------------*/
$exc_minute_path = dirname(dirname(__FILE__));
include $exc_minute_path.'/module/database.php';
/*----------------------------------------------
            *飞扬维修每月自动执行任务*
                 Code By Pikachu
                    2020-10-01
                    
            功能：清空每月报修记录
----------------------------------------------*/
echo "[".date("Y-m-d h:m:s")."] "."[飞扬维修]------每月定时任务------"."<br />\n";
echo "执行结果："     .db_putc("fy_datas","name","month_num","data",0)."<br />\n";
echo "[".date("Y-m-d h:m:s")."] "."[飞扬维修]------每月任务完毕------"."<br />\n";
?>