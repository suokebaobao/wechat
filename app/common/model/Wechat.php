<?php
namespace app\common\model;
use think\Model;
use EasyWeChat\Factory;
use think\facade\Request;
use think\facade\Db;
use think\facade\Cache;
use think\facade\Session;
use think\facade\Config;
use think\model\concern\SoftDelete;

class Wechat extends Model
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = 0;
    protected $autoWriteTimestamp = true;
    
    protected function base($query)
    {
        
    }
    //小程序API
    public static function wxapp()
    {
        $wxapp = Config::load('setting/wxapp','wxapp');
        $appid = $wxapp['appid'];
        $secret = $wxapp['appsecret'];

        $config = [
            'app_id' => $appid,
            'secret' => $secret,
            
            'log' => [
                'level' => 'debug',
                'file' => \think\facade\Env::get('runtime_path').'wechat.log',
            ],
        ];
        $app = Factory::miniProgram($config);
        return $app;
    }
    //公众号API
    public static function weixin()
    {
        $weixin = Config::load('setting/weixin');
        $config = [
            'app_id'  => $weixin['appid'],
            'secret'  => $weixin['appsecret'],
            'token'   => $weixin['token'],          // Token
            'aes_key' => $weixin['aes_key'], 
            'log' => [
                'level' => 'debug',
                'file' => \think\facade\Env::get('runtime_path').'wechat.log',
            ],
        ];
        $app = Factory::officialAccount($config);
        return $app;
    }
    //获取ACCESSTOKEN
    public static function access_token($true = false)
    {
        $app = self::weixin();
        $accessToken = $app->access_token;
        $token = $accessToken->getToken($true);
        return $token['access_token'];
    }

    
    
    
}