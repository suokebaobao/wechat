<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;
use think\facade\View;
use think\facade\Request;
use think\facade\Db;
use think\facade\Cache;
use think\facade\Session;
use app\common\model\User as Yonghu;
use app\common\model\UserAuthGroup;
use app\common\model\UserAuthRule;
use app\common\model\Shop;

class User extends AdminBase
{
    protected function _initialize()
    {
        parent::_initialize();
    }

    public function index()
    {
        $shop_id = input('shop_id');
        if($shop_id){
            Yonghu::where(['shop_id'=> $shop_id]);
        }
        $list = Yonghu::with('shop')->order('id desc')->paginate();
        return $this->fetch('index', ['list' => $list]);
    }

    public function add()
    {
        $shop_id = input('shop_id')?:'0';
        if ($this->request->isPost()) {
            $param = $this->request->param();
            $param['shop_id'] = $shop_id;
            empty($param['password']) && $this->error('密码不能为空');
            //验证规则
            $verify = input('_verify', true);
            if($verify!='0'){
                try{
                    $this->validate($param, 'user');
                }catch (\Exception $e){
                    $this->error($e->getMessage());
                }
            }
            $result = Yonghu::create($param);
            if ($result == true) {
                insert_admin_log('添加了用户');
                $this->success('添加成功');
            } else {
                $this->error($this->errorMsg);
            }
        }
        return $this->fetch('save', ['userAuthGroup' => UserAuthGroup::where(['shop_id'=>$shop_id,'status'=>1])->select()]);
    }

    public function edit()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            if (empty($param['password'])) {
                unset($param['password']);
            }
            //验证规则
            $verify = input('_verify', true);
            if($verify!='0'){
                try{
                    $this->validate($param, 'user');
                }catch (\Exception $e){
                    $this->error($e->getMessage());
                }
            }
            $data = Yonghu::update($param);
            
            if ($data == true) {
                insert_admin_log('修改了用户');
                $this->success('修改成功', url('admin/user/index'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        $data = Yonghu::where('id', input('id'))->find();
        return $this->fetch('save', [
            'data' => $data,
            'userAuthGroup' => UserAuthGroup::where(['shop_id'=>$data['shop_id'],'status'=>1])->select(),]);
    }

    public function del()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            Yonghu::destroy($param['id']);
            insert_admin_log('删除了管理员');
            $this->success('删除成功');
        }
    }

    public function export()
    {
        $data = collection(Yonghu::field('id,name,mobile')->order('id desc')->select())->toArray();
        array_unshift($data, ['ID', '用户名', '手机号']);
        insert_admin_log('导出了用户');
        export_excel($data, date('YmdHis'));
    }

    public function log()
    {
        return $this->fetch('log', ['list' => \app\common\model\UserLog::with('shop')->order('create_time desc')->paginate(config('page_number'))]);
    }

    public function truncate()
    {
        if ($this->request->isPost()) {
            //Db()->query('TRUNCATE ' . config('database.prefix') . 'user_log');
            $this->success('操作成功');
        }
    }


    
}
