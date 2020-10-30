<?php
/*----------------------------------------------------------------------------------

                                      *发送短信*
                                  Code By Pikachu
                                     OCT01/2020
                                     
                                 功能：发送通知短信
----------------------------------------------------------------------------------*/
$dx_path = dirname(dirname(__FILE__));
include $dx_path.'/module/txclouds.api/TCloudAutoLoader.php';
use TencentCloud\Common\Credential;
use TencentCloud\Common\Profile\ClientProfile;
use TencentCloud\Common\Profile\HttpProfile;
use TencentCloud\Common\Exception\TencentCloudSDKException;
use TencentCloud\Sms\V20190711\SmsClient;
use TencentCloud\Sms\V20190711\Models\SendSmsRequest;
function dx_send($dx_type,$dx_pnum,$dx_data){
    $dx_path = dirname(dirname(__FILE__));
    include $dx_path.'/config/dx.php';
    if($dx_type==1) $dx_pids=$dx_pid1;
    if($dx_type==2) $dx_pids=$dx_pid2;
    if($dx_type==3) $dx_pids=$dx_pid3;
    if($dx_type==4) $dx_pids=$dx_pid4;
    if($dx_type==5) $dx_pids=$dx_pid5;
    if($dx_type==6) $dx_pids=$dx_pid6;
    try {
        $cred = new Credential($dx_asid, $dx_akey);
        $httpProfile = new HttpProfile();
        $httpProfile->setEndpoint("sms.tencentcloudapi.com");
        $clientProfile = new ClientProfile();
        $clientProfile->setHttpProfile($httpProfile);
        $client = new SmsClient($cred, "ap-chengdu", $clientProfile);
        $req = new SendSmsRequest();
        $params = '{
            "PhoneNumberSet":["'.$dx_pnum.'"],
            "TemplateID":"'.$dx_pids.'",
            "Sign":"'.$dx_sign.'",
            "TemplateParamSet":["'.$dx_data.'],
            "SmsSdkAppid":"'.$dx_apid.'"
        }';
        //echo $params;
        $req->fromJsonString($params);
        $resp = $client->SendSms($req);
        //print_r($resp->toJsonString());
        //$file = fopen("msglog.log", "a") or die("Unable to open file!");
        //$text = $resp->toJsonString()."\n";
        //fwrite($file, $text);
        //fclose($file);
    }
    catch(TencentCloudSDKException $e) {
        echo $e;
    }
}

?>