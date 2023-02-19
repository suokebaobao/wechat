<?php
namespace app\admin\controller;
use app\common\controller\AdminBase;
use think\facade\Db;
use think\facade\Request;
use think\facade\Session;
use think\facade\View;
use think\facade\Cookie;

use app\common\model\Wechat as Weixin;
use think\Model;

class Wechat extends AdminBase
{
    protected function _initialize()
    {
        parent::_initialize();
        $this->app = Weixin::weixin();
    }
    //微信用户
    public function index()
    {
        $list = Weixin::order('id desc')->paginate();
        return $this->fetch('index', ['list' => $list]);
    }
    //获取用户
    public function get_user()
    {
        $this->app = Weixin::weixin();
        $users = $this->app->user->list();
        foreach ($users['data']['openid'] as $r){
            $wechat = Weixin::where(['openid'=>$r])->find();
            if(!$wechat){
                $user = $this->app->user->get($r);
                if(!isset($user['unionid'])){
                    $user['unionid'] = '0';
                }
                //创建公众号资料
                Weixin::create([
                    'openid'         => $r,
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
        }
        $this->success('获取成功');
    }
    //自定义菜单
    public function menu()
    {

        return View::fetch();
    }


    
    
}
