<?php
/*----------------------------------------------------------------------------------

                                *短信库核心密码配置*
                                  Code By Pikachu
                                     OCT01/2020
                                     
                               功能：记录短信发送账号
----------------------------------------------------------------------------------*/
namespace pika;
$dx_asid = "";//账号最高权限用户，请妥善保存
$dx_akey = "";//账号最高权限密钥，请妥善保存
$dx_apid = "";                          //腾讯云-短信应用id
$dx_sign = "飞扬维修";                            //腾讯云-短信的签名
$dx_pid1 = "";                              //登录验证-短信验证
$dx_pid2 = "";                              //技术通知-匹配成功
$dx_pid3 = "";                              //用户通知-匹配成功
$dx_pid4 = "";                              //用户通知-提交成功
$dx_pid5 = "";                              //用户通知-订单关闭
$dx_pid6 = "";                              //技术通知-订单关闭
?>