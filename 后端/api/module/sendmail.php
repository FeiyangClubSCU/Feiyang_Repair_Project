<?php
/*----------------------------------------------------------------------------------

                                      *发送邮件*
                                  Code By Pikachu
                                     OCT01/2020
                                     
                                 功能：发送通知邮件
----------------------------------------------------------------------------------*/
$exc_sendmail = dirname(dirname(__FILE__));
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once("phpmails/PHPMailer.php");
require_once("phpmails/Exception.php");
require_once("phpmails/POP3.php");
require_once("phpmails/SMTP.php");
include $exc_sendmail."/config/yx.php";
class email
{
    public static function send($head,$html,$text,$addr,
    $mail_host,$mail_user,$mail_pass,$mail_port,
    $mail_from,$mail_name,$mail_dbug)
    {
        //echo $mail_from;
        $mail = new PHPMailer(false);
        try {
            //echo $mail_pass; 
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;  
            $mail->isSMTP();                                     
            $mail->Host       = $mail_host;             
            $mail->SMTPAuth   = true;                            
            $mail->Username   = $mail_user;             
            $mail->Password   = $mail_pass;                       
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  
            $mail->Port       = $mail_port;                             
            $mail->setFrom($mail_from,$mail_name);
            $mail->addAddress($addr);
            $mail->isHTML(true);
            $mail->Subject = $head;
            $mail->Body    = $html;
            $mail->AltBody = $text;
            $mail->send();
            echo "[".date("Y-m-d h:m:s")."] "."[飞扬邮件]成功发送邮件：".$addr."<br />\n";
            return 0;
        } 
        catch (Exception $e) {
            echo "[".date("Y-m-d h:m:s")."] "."[飞扬邮件]发送邮件失败：".$addr."<br />\n";
            echo "[".date("Y-m-d h:m:s")."] "."[飞扬邮件]失败原因：";
            echo substr($mail->ErrorInfo,0,14);
            echo "<br />\n";
            return 1;
        }
    }
}
function yx_send($head,$html,$text,$addr){
    $exc_sendmail = dirname(dirname(__FILE__));
    include $exc_sendmail."/config/yx.php";
    $post = email::send($head,$html,$text,$addr,
    $mail_host,$mail_user,$mail_pass,
    $mail_port,$mail_from,$mail_name,$mail_dbug);
}
?>