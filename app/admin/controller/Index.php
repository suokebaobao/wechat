<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;
use think\facade\View;
use think\facade\Request;
use think\facade\Db;
use think\facade\Cache;
use think\facade\Session;

use app\common\model\AuthGroupAccess;
use app\common\model\AuthRule;
use app\common\model\Admin;

class Index extends AdminBase
{
    protected $noLogin = ['login', 'captcha'];
    protected $noAuth = ['index', 'uploadImage', 'uploadFile', 'uploadVideo', 'icon', 'logout'];
    
    //后台首页
    public function index()
    {
        $userinfo = Session::get('admin_auth');
        return View::fetch('index',['userinfo'=>$userinfo]);
    }
    //默认首页
    public function home()
    {
        // 快捷导航
        $where = ['index' => 1, 'status' => 1];
        if (session('admin_auth.username') != config('administrator')) {
            $access      = AuthGroupAccess::with('authGroup')
                ->where('uid', session('admin_auth.admin_id'))->find();
            $where['id'] = ['in', $access['rules']];
        }
        $index = AuthRule::where($where)->order('pid asc,sort_order asc')->select();
        //统计信息
        
        // 服务器信息
        $server = [
            'os'                  => PHP_OS, // 服务器操作系统
            'sapi'                => PHP_SAPI, // 服务器软件
            'version'             => PHP_VERSION, // PHP版本
            'mysql'               => '5.7', // mysql 版本
            'root'                => $_SERVER['DOCUMENT_ROOT'], // 当前运行脚本所在的文档根目录
            'max_execution_time'  => ini_get('max_execution_time') . 's', // 最大执行时间
            'upload_max_filesize' => ini_get('upload_max_filesize'), // 文件上传限制
            'memory_limit'        => ini_get('memory_limit'), // 允许内存大小
            'date'                => date('Y-m-d H:i:s', time()), // 服务器时间
        ];
        return View::fetch('home', ['index' => $index, 'server' => $server]);
    }
    //登陆
    public function login()
    {
        is_admin_login() && $this->redirect(url('admin/index/index')); // 登录直接跳转
        if ($this->request->isPost()) {
            $param = $this->request->param();
            $result = $this->validate($param, 'login');
            if ($result !== true) {
                $this->error($result);
            }
            $admin = Admin::where([
                'username' => $param['username'],
                'password' => md5($param['password'])
            ])->find();

            if ($admin) {
                $admin['status'] != 1 && $this->error('账号已禁用');
                // 保存状态
                $auth = [
                    'admin_id' => $admin['id'],
                    'username' => $admin['username'],
                ];
                Session::set('admin_auth', $auth);
                Session::set('admin_auth_sign', data_auth_sign($auth));
                // 更新信息
                Admin::update([
                    'last_login_time' => time(),
                    'last_login_ip'   => $this->request->ip(),
                    'login_count'     => $admin['login_count'] + 1,
                ],['id' => $admin['id']]);
                insert_admin_log('登录了后台系统');
                $this->success('登录成功', url('@admin'));
            } else {

                $this->error('账号或密码错误');
            }
        }
        return View::fetch('login');
    }
    //修改密码
    public function editPassword()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            // 验证条件
            empty($param['password']) && $this->error('请输入旧密码');
            empty($param['new_password']) && $this->error('请输入新密码');
            empty($param['rep_password']) && $this->error('请输入确认密码');
            !check_password($param['new_password'], 6, 16) && $this->error('请输入6-16位的密码');
            $param['new_password'] != $param['rep_password'] && $this->error('两次密码不一致');
            $admin = Admin::where('id', session('admin_auth.admin_id'))->find();
            $admin['password'] != md5($param['password']) && $this->error('旧密码错误');
            $data = ['id' => session('admin_auth.admin_id'), 'password' => $param['new_password']];
            $result = Admin::update($data);
            if ($result == true) {
                insert_admin_log('修改了登录密码');
                session('admin_auth', null);
                session('admin_auth_sign', null);
                $this->success('更新成功', url('@admin/index/index'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        return $this->fetch('editPassword');
    }
    // 退出登录
    public function logout()
    {
        insert_admin_log('退出了后台系统');
        session('admin_auth', null);
        session('admin_auth_sign', null);
        return $this->redirect(url('admin/index/login'));
    }
}
