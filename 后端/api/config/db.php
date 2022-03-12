<?php
/*----------------------------------------------------------------------------------

                                *数据库核心密码配置*
                                  Code By Pikachu
                                     OCT01/2020
                                     
                                功能：记录数据库账号
----------------------------------------------------------------------------------*/
$db_conf_dbug = false;            //数据库调试输出，警告：开启时小程序端无法正常使用
$db_conf_getc = false;            //读取也输出内容，警告：此开关开启时不得进行写操作
$db_conf_addr = "";      //数据库连接地址
$db_conf_user = "";         //数据库连接账号
$db_conf_pswd = "";         //数据库连接密码
$db_conf_name = "";         //数据库连接名称
$db_conf_root = ""; //数据库最高权限，警告：此密码是root密码，请勿泄露
?>