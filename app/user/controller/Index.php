<?php
namespace app\user\controller;

use app\common\controller\UserBase;
use think\facade\View;
use think\facade\Request;
use think\facade\Db;
use think\facade\Cache;
use think\facade\Session;

use app\common\model\UserAuthRule;
use app\common\model\User;

class Index extends UserBase
{
    protected $noLogin = ['login', 'captcha'];
    protected $noAuth = ['index','home','uploadImage','uploadFile', 'uploadVideo', 'icon', 'logout'];
    
    //后台首页
    public function index()
    {
        
        return View::fetch('index');
    }
    //首页
    public function home()
    {
        
        return View::fetch('home');
    }
    //登陆
    public function login()
    {
        is_user_login() && $this->redirect(url('user/index/index')); // 登录直接跳转
        if ($this->request->isPost()) {
            $param = $this->request->param();
            $result = $this->validate($param, 'login');
            if ($result !== true) {
                $this->error($result);
            }
            $admin = User::where([
                'mobile' => $param['mobile'],
                'password' => md5($param['password'])
            ])->find();
            if ($admin) {
                $admin['status'] != 1 && $this->error('账号已禁用');
                // 保存状态
                $auth = [
                    'user_id' => $admin['id'],
                    'shop_id' => $admin['shop_id'],
                    'mobile' => $admin['mobile'],
                ];
                Session::set('user_auth', $auth);
                Session::set('user_auth_sign', data_auth_sign($auth));
                // 更新信息
                User::update([
                    'last_login_time' => time(),
                    'last_login_ip'   => $this->request->ip(),
                    'login_count'     => $admin['login_count'] + 1,
                ],['id' => $admin['id']]);
                insert_user_log('登录了后台系统');
                $this->success('登录成功', url('@user'));
            } else {
                $this->error('账号或密码错误');
            }
        }
        return View::fetch('login');
    }
    // 退出登录
    public function logout()
    {
        insert_user_log('退出了后台系统');
        session('user_auth', null);
        session('user_auth_sign', null);
        return $this->redirect(url('user/index/login'));
    }
}
