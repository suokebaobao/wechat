<?php
namespace app\wechat\controller;
use app\common\controller\IndexBase;
use app\common\model\Wechat;
use EasyWeChat\Factory;
use think\Request;

class Api extends IndexBase
{
    protected function _initialize()
    {
        parent::_initialize();
        $this->app = Wechat::weixin();
    }
    //商家列表
    public function index()
    {
        $app = $this->app;
        // 校验开发者微信服务器 // $this->ckServer();exit(); 
        $app->server->push(function ($message) { 
            switch ($message['MsgType']) { 
                case 'event':
                    $returnInfo = $this->eventHandler($message); 
                    return $returnInfo; 
                    break; 
                case 'text': 
                    return '收到文字消息'; break; 
                case 'image': 
                    return '收到图片消息'; break; 
                case 'voice': 
                    return '收到语音消息'; break; 
                case 'video': 
                    return '收到视频消息'; break; 
                case 'location': 
                    return '收到坐标消息'; break; 
                case 'link': 
                    return '收到链接消息'; break; 
                default: 
                    return '收到其它消息'; break; 
            } 
        }); 
        $response = $app->server->serve();
        //$response = $app->server->serve();
        // 将响应输出
        $response->send();// Laravel 里请使用：return $response;
    }
    //获取信息
    private function eventHandler($messageEvent) { 
        switch ($messageEvent['Event']) { 
            case 'subscribe': 
                //关注事件
                $this->subscribe($messageEvent['FromUserName']);
                //二维码事件
                $eventkey = substr($messageEvent['EventKey'], 0,8);
                if($eventkey == 'qrscene_'){
                    $this->qrscene($messageEvent['FromUserName'],substr($messageEvent['EventKey'],8));
                }
                return '欢迎订阅'; 
                break;
            case 'unsubscribe': 
                $this->unsubscribe($messageEvent['FromUserName']);
                return '欢迎订阅'; 
                break;
            default:
                $this->qrscene($messageEvent['FromUserName'],$messageEvent['EventKey']);
                
                return '绑定成功'; 
                break; 
        } 
    }
    //获取OPENID等
    //关注事件
    private function subscribe($openid) { 
        $app = $this->app;
        //检查用户
        $wechat = model('wechat')->where('openid',$openid)->find();
        $user = $app->user->get($openid);
        if(!$wechat){
            //创建公众号资料
            model('wechat')->create([
                'openid'         => $openid,
                'nickname'       => $user['nickname'],
                'gender'         => $user['sex'],
                'country'        => $user['country'],
                'province'       => $user['province'],
                'city'           => $user['city'],
                'avatarurl'      => $user['headimgurl'],
                'unionid'        => $user['unionid'],
                'subscribe'      => $user['subscribe'],
                'subscribe_time' => $user['subscribe_time'],
            ]);
        }else{
            model('wechat')->where(['openid'=>$openid])->update([
                'openid'         => $openid,
                'nickname'       => $user['nickname'],
                'gender'         => $user['sex'],
                'country'        => $user['country'],
                'province'       => $user['province'],
                'city'           => $user['city'],
                'avatarurl'      => $user['headimgurl'],
                'unionid'        => $user['unionid'],
                'subscribe'      => $user['subscribe'],
                'subscribe_time' => $user['subscribe_time'],
            ]);
        }
        return ;
    }
    //取消关注事件
    private function unsubscribe($openid)
    { 
        $app = $this->app;
        $user = $app->user->get($openid);
        model('wechat')->where(['openid'=>$openid])->update([
                'subscribe'      => $user['subscribe'],
                'subscribe_time' => $user['subscribe_time'],
            ]);
        $wechat = model('wechat')->where(['openid'=>$openid])->find();

        return ;
    }
    //二维码绑定
    private function qrscene($openid,$message)
    {
        db('customer')->where(['id'=>$message])->update(['openid'=>$openid]);
        return ;
    }
    
}
