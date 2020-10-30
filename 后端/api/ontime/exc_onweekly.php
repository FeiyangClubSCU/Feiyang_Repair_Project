<?php
/*--------------------------------------------*/
$exc_minute_path = dirname(dirname(__FILE__));
include $exc_minute_path.'/module/database.php';
/*----------------------------------------------
            *飞扬维修每周自动执行任务*
                 Code By Pikachu
                    2020-10-01
                    
            功能：清空每周报修记录
----------------------------------------------*/
echo "[".date("Y-m-d h:m:s")."] "."[飞扬维修]------每周定时任务------"."<br />\n";
echo "执行结果："     .db_putc("fy_datas","name","order_am1","data",0)."<br />\n";
echo "执行结果："     .db_putc("fy_datas","name","order_am2","data",0)."<br />\n";
echo "执行结果："     .db_putc("fy_datas","name",      "wa1","data",0)."<br />\n";
echo "执行结果："     .db_putc("fy_datas","name",      "wa2","data",0)."<br />\n";
echo "执行结果："     .db_putc("fy_datas","name",      "wa3","data",0)."<br />\n";
echo "执行结果："     .db_putc("fy_datas","name",      "wa4","data",0)."<br />\n";
echo "执行结果："     .db_putc("fy_datas","name",      "wa5","data",0)."<br />\n";
echo "执行结果："     .db_putc("fy_datas","name",      "wa6","data",0)."<br />\n";
echo "执行结果："     .db_putc("fy_datas","name",      "wa7","data",0)."<br />\n";
echo "执行结果："     .db_putc("fy_datas","name",      "wb1","data",0)."<br />\n";
echo "执行结果："     .db_putc("fy_datas","name",      "wb2","data",0)."<br />\n";
echo "执行结果："     .db_putc("fy_datas","name",      "wb3","data",0)."<br />\n";
echo "执行结果："     .db_putc("fy_datas","name",      "wb4","data",0)."<br />\n";
echo "执行结果："     .db_putc("fy_datas","name",      "wb5","data",0)."<br />\n";
echo "执行结果："     .db_putc("fy_datas","name",      "wb6","data",0)."<br />\n";
echo "执行结果："     .db_putc("fy_datas","name",      "wb7","data",0)."<br />\n";
echo "[".date("Y-m-d h:m:s")."] "."[飞扬维修]------每周任务完毕------"."<br />\n";
?>