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

class UserAuth extends AdminBase
{
    protected function _initialize()
    {
        parent::_initialize();
    }

    public function group()
    {
        return $this->fetch('group', ['list' => UserAuthGroup::paginate()]);
    }

    public function addGroup()
    {
        if ($this->request->isPost()) {
            $result = UserAuthGroup::create($this->request->param());
            if ($result == true) {
                insert_admin_log('添加了用户组');
                $this->success('添加成功', url('@admin/user_auth/group'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        $userAuthRule = collection(UserAuthRule::where(['status' => 1])->order('sort_order asc')->select())->toArray();
        foreach ($userAuthRule as $k => $v) {
            //$authRule[$k]['open'] = true;
        }
        
        return View::fetch('saveGroup', ['userAuthRule' => list_to_tree($userAuthRule)]);
    }

    public function editGroup()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            $verify = input('_verify', true);
            //验证规则
            if($verify!='0'){
                try{
                    $this->validate($param, 'UserAuthGroup');
                }catch (\Exception $e){
                    $this->error($e->getMessage());
                }
            }
            //更新数据
            $resule = UserAuthGroup::update($param);
            if ( $resule == true) {
                insert_admin_log('修改了用户组');
                $this->success('修改成功', url('@admin/user_auth/group'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        $data     = UserAuthGroup::where('id', input('id'))->find();
        $userAuthRule = collection(UserAuthRule::where(['status' => 1])->order('sort_order asc')->select())->toArray();
        foreach ($userAuthRule as $k => $v) {
            // $authRule[$k]['open'] = true;
            $userAuthRule[$k]['checked'] = in_array($v['id'], explode(',', $data['rules']));
        }
        return $this->fetch('saveGroup', ['data' => $data, 'userAuthRule' => list_to_tree($userAuthRule)]);
    }

    public function delGroup()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            UserAuthGroup::destroy($param['id']);
            insert_admin_log('删除了用户组');
            $this->success('删除成功');
        }
    }

    public function rule()
    {
        $userAuthRule = collection(UserAuthRule::where(['status' => 1])->order('sort_order asc')->select())->toArray();
        foreach ($userAuthRule as $k => $v) {
            // $userAuthRule[$k]['open'] = true;
        }
        return $this->fetch('rule', ['userAuthRule' => list_to_tree($userAuthRule)]);
    }

    public function addRule()
    {
        if ($this->request->isPost()) {
            $result = UserAuthRule::create($this->request->param());
            if ($result == true) {
                insert_admin_log('添加了用户权限规则');
                $this->success('添加成功', url('@admin/user_auth/rule'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        return $this->fetch('saveRule');
    }

    public function editRule()
    {
        if ($this->request->isPost()) {
            $result = UserAuthRule::update($this->request->param());
            if ($result == true) {
                insert_admin_log('修改了用户权限规则');
                $this->success('修改成功', url('@admin/user_auth/rule'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        return $this->fetch('saveRule', ['data' => UserAuthRule::where('id', input('id'))->find()]);
    }

    public function delRule()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            UserAuthRule::where('pid', input('id'))->count() && $this->error('请先删除子节点');
            UserAuthRule::destroy($param['id']);
            insert_admin_log('删除了用户权限规则');
            $this->success('删除成功');
        }
    }
}
