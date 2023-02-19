<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;
use think\facade\View;
use think\facade\Request;
use think\facade\Db;
use think\facade\Cache;
use think\facade\Session;
use app\common\model\User;
use app\common\model\UserAuthGroup;
use app\common\model\UserAuthRule;
use app\common\model\Shop as Shang;

class Shop extends AdminBase
{
    protected function _initialize()
    {
        parent::_initialize();
    }
    //商户列表
    public function index()
    {
        return $this->fetch('index', ['list' => Shang::order('id desc')->paginate()]);
    }
    //添加
    public function add()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            $verify = input('_verify', true);
            try{
                $this->validate($param, 'shop');
            }catch (\Exception $e){
                $this->error($e->getMessage());
            }
            empty($param['password']) && $this->error('密码不能为空');
            $result = Shang::create($param);
            if ($result == true) {
                //添加用户组
                $authgroup['shop_id'] = $result->id;
                $authgroup['name'] = "总经理";
                $authgroup['status'] = "1";
                $authgroup['rules'] = "124,125,128,132,133,141,127,140,142,126,129,130,131,77,78,81,82,83,79,84,85,86,137,138,139,80,87,1,2,3";
                $aug = UserAuthGroup::create($authgroup);
                //添加超级管理员
                $adduser['shop_id'] = $authgroup['shop_id'];
                $groupid = $aug->id;
                $adduser['name'] = $param['name'];
                $adduser['mobile'] = $param['mobile'];
                $adduser['password'] = $param['password'];
                $adduser['status'] = "1";
                $adduser['group_id'] = $groupid;
                $user = User::create($adduser);
                $this->success('操作成功', url('admin/shop/index'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        return $this->fetch('add');
    }
    //编辑
    public function edit()
    {
        $id = input('id') ?: '参数错误';
        $data = Shang::where('id',$id)->find();
        if ($this->request->isPost()) {
            $param = $this->request->param();
            //验证规则
            $verify = input('_verify', true);
            if($verify!='0'){
                try{
                    $this->validate($param, 'shop');
                }catch (\Exception $e){
                    $this->error($e->getMessage());
                }
            }
            $resule = Shang::update($param);

            if ($resule == true) {
                insert_admin_log('修改了商家');
                $this->success('修改成功');
            } else {
                $this->error($this->errorMsg);
            }
        }
        return $this->fetch('save',[
            'data' => $data,
        ]);
    }
    //删除
    public function del()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            Shang::destroy($param['id']);
            insert_admin_log('删除了商家');
            $this->success('删除成功');
        }
    }


}