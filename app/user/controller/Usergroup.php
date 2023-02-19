<?php
namespace app\user\controller;

use app\common\controller\UserBase;
use think\facade\View;
use think\facade\Request;
use think\facade\Db;
use think\facade\Cache;
use think\facade\Session;
 
use app\user\model\UserAuthGroup;
use app\user\model\UserAuthRule;
use app\user\model\User;

class Usergroup extends UserBase
{
    public function index()
    {
        return $this->fetch('index', ['list' => list_to_level(UserAuthGroup::order('id desc')->select())]);
    }

    public function add()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            $param['shop_id'] = ShopId();
            $result = UserAuthGroup::create($param);
            if ($result == true) {
                insert_user_log('添加了用户组');
                $this->success('添加成功', url('@user/usergroup/index'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        $userAuthRule = collection(UserAuthRule::where(['status' => 1])->order('sort_order asc')->select())->toArray();
        foreach ($userAuthRule as $k => $v) {
            //$authRule[$k]['open'] = true;
        }
        
        return View::fetch('save', ['userAuthRule' => list_to_tree($userAuthRule),'pid' => UserAuthGroup::list_to_level()]);
    }

    public function edit()
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
                insert_user_log('修改了用户组');
                $this->success('修改成功', url('@user/usergroup/index'));
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
        return $this->fetch('save', ['data' => $data, 'userAuthRule' => list_to_tree($userAuthRule),'pid' => UserAuthGroup::list_to_level()]);
    }

    public function delGroup()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            UserAuthGroup::destroy($param['id']);
            insert_user_log('删除了用户组');
            $this->success('删除成功');
        }
    }
}
