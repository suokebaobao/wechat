<?php
namespace app\common\model;
use Qcloud\Sms\SmsSingleSender;
use think\facade\Config;
use think\Model;

class Sms extends Model
{
    protected function base($query)
    {
        
    }
    //单发
    static function smsSend(){
        $qcloudsms = Config::load('setting/qcloudsms','qcloudsms');
        // 短信应用SDK AppID
        $appid = $qcloudsms['appid'];
        // 短信应用SDK AppKey
        $appkey = $qcloudsms['appkey'];
        // 你的手机号码。
        $phoneNumber = "13055556455";
        // 短信模板ID，需要在短信应用中申请
        $templateId = 296211; // NOTE: 这里的模板ID`7839`只是一个示例，真实的模板ID需要在短信控制台中申请
        // 签名
        $smsSign = "定时宝"; // NOTE: 这里的签名只是示例，请使用真实的已申请的签名，签名参数使用的是`签名内容`，而不是`签名ID`
        // 单发短信
        try {
            $ssender = new SmsSingleSender($appid, $appkey);
            $result = $ssender->send(0, "86", $phoneNumber,
            "123456为您的登录验证码，请于5分钟内填写。如非本人操作，请忽略本短信。", "", "");
            $rsp = json_decode($result);
            echo $result;
        } catch(\Exception $e) {
            echo var_dump($e);
        }
            //暂停3秒
            sleep(3);
            // 指定模板ID单发短信
        try {
            $ssender = new SmsSingleSender($appid, $appkey);
            $params = ["654321", "5"];
            $result = $ssender->sendWithParam("86", $phoneNumber, $templateId,
            $params, $smsSign, "", ""); // 签名参数未提供或者为空时，会使用默认签名发送短信
            $rsp = json_decode($result);
            echo $result;
        } catch(\Exception $e) {
            echo var_dump($e);
        }
    }
    //群发短信
    static function smsMulti(){
        // 短信应用SDK AppID
        $appid = 1400009099; // 1400开头
        // 短信应用SDK AppKey
        $appkey = "9ff91d87c2cd7cd0ea762f141975d1df37481d48700d70ac37470aefc60f9bad";
        // 需要发送短信的手机号码
        $phoneNumbers = ["21212313123", "12345678902", "12345678903"];
        // 短信模板ID，需要在短信应用中申请
        $templateId = 7839; // NOTE: 这里的模板ID`7839`只是一个示例，真实的模板ID需要在短信控制台中申请
        // 签名
        $smsSign = "腾讯云"; // NOTE: 这里的签名只是示例，请使用真实的已申请的签名，签名参数使用的是`签名内容`，而不是`签名ID`
        // 群发
        try {
            $msender = new SmsMultiSender($appid, $appkey);
            $result = $msender->send(0, "86", $phoneNumbers,
            "123456为您的登录验证码，请于5分钟内填写。如非本人操作，请忽略本短信。", "", "");
            $rsp = json_decode($result);
            echo $result;
        } catch(\Exception $e) {
            echo var_dump($e);
        }
            //暂停3秒
            sleep(3);
            // 指定模板ID群发
        try {
            $msender = new SmsMultiSender($appid, $appkey);
            $params = ["654321", "5"];
            $result = $msender->sendWithParam("86", $phoneNumbers,
            $templateId, $params, $smsSign, "", ""); // 签名参数未提供或者为空时，会使用默认签名发送短信
            $rsp = json_decode($result);
            echo $result;
        } catch(\Exception $e) {
            echo var_dump($e);
        }
    }


}