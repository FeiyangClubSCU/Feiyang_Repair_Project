<?php
/*--------------------------------------------*/
$exc_minute_path = dirname(dirname(__FILE__));
include $exc_minute_path.'/module/database.php';
/*----------------------------------------------
            *飞扬维修每天自动执行任务*
                 Code By Pikachu
                    2020-10-01
                    
            功能：清空每天报修记录
----------------------------------------------*/
echo "[".date("Y-m-d h:m:s")."] "."[飞扬维修]------每日定时任务------"."<br />\n";
echo "执行结果：".db_putc("fy_datas","name",     "flag","data",0)     ."<br />\n";
echo "执行结果：".db_putc("fy_datas","name","order_vip","data",0)     ."<br />\n";
echo "执行结果：".db_putc("fy_datas","name","order_nop","data",0)     ."<br />\n";
echo "[".date("Y-m-d h:m:s")."] "."[飞扬维修]------每日任务完毕------"."<br />\n";
?>