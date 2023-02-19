<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;
use think\facade\View;
use think\facade\Request;
use think\facade\Db;
use think\facade\Cache;
use think\facade\Session;

use app\common\model\Admin as Guanli;
use app\common\model\AuthGroup;
use app\common\model\AuthGroupAccess;
use app\common\model\AuthRule;

class Admin extends AdminBase
{
    protected function _initialize()
    {
        parent::_initialize();
    }

    public function index()
    {
        return View::fetch('index');
    }
    public function index_json($limit='15')
    {
        $list = Guanli::with(['authGroupAccess','authGroup'])->order('id desc')->paginate($limit);
        $this->result($list);
    }

    public function add()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            empty($param['password']) && $this->error('密码不能为空');
            $result = Guanli::create($param);
            if ($result == true) {
                AuthGroupAccess::create(['uid' => $result->id, 'group_id' => $param['group_id']]);
                insert_admin_log('添加了管理员');
                $this->success('添加成功', url('@admin/admin/index'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        return View::fetch('save', ['authGroup' => AuthGroup::where('status', 1)->select()]);
    }

    public function edit()
    {
        if ($this->request->isPost()) {
            $param  = $this->request->param();
            
            if (empty($param['password'])) {
                unset($param['password']);
            }
            //验证规则
            $verify = input('_verify', true);
            if($verify!='0'){
                try{
                    $this->validate($param, 'admin');
                }catch (\Exception $e){
                    $this->error($e->getMessage());
                }
            }
            //更新数据
            $resule = Guanli::update($param,['id'=>$param['id']]);
            if ( $resule == true) {
                $verify && AuthGroupAccess::update(['group_id' => $param['group_id']], ['uid' => $param['id']]);
                insert_admin_log('修改了管理员');
                $this->success('修改成功', url('@admin/admin/index'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        return View::fetch('save', [
            'data'      => Guanli::with('authGroupAccess')->where('id', input('id'))->find(),
            'authGroup' => AuthGroup::where('status', 1)->select(),
        ]);
    }

    public function del()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            Guanli::destroy($param['id']);
            AuthGroupAccess::where('uid', $param['id'])->delete();
            insert_admin_log('删除了管理员');
            $this->success('删除成功');
            
        }
    }

    public function log()
    {
        return $this->fetch();
    }
    public function log_json($limit='15')
    {
        $list = \app\common\model\AdminLog::order('create_time desc')->paginate($limit);
        $this->result($list);
    }

    public function truncate()
    {
        if ($this->request->isPost()) {
            Db::name('admin_log')->delete(true);
            $this->success('操作成功');
        }
    }
}
