<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;
use think\facade\Config as Con;
use think\facade\View;
use think\facade\Request;
use think\facade\Db;
use think\facade\Cache;
use think\facade\Session;
use app\common\model\System;

class Config extends AdminBase
{
    protected function _initialize()
    {
        parent::_initialize();
    }
    
    public function setting()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            extraconfig($param, 'admin/website');
            $this->success('设置成功');
        }
        $list = Con::load('admin/website','website');
        return View::fetch('setting', ['list' => $list]);
    }
    
    public function param()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            if(isset($param['type']) and $param['type']=='on'){
                $param['type'] = '1';
            }else{
                $param['type'] = '0';
            }
            extraconfig($param, 'setting/'.$param['model']);
            $this->success('设置成功');
        }
        $model = input('model')?:'qiniu';
        $list = Con::load('setting/'.$model,'$model');
        return $this->fetch('param_'.$model, ['list' => $list]);
    }

    public function upload()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            extraconfig($param, 'admin/upload_setting');

            insert_admin_log('修改了上传设置');
            $this->success('保存成功');
        }
        $data = Con::load('admin/website','upload_setting');
        return $this->fetch('upload', ['data' => $data]);
    }

    public function contactInfo(){
        $list = Con::load('admin/website','website');
        if($this->request->isAjax()){
            $data = $this->request->param('data',[]);
            $list['contact_info'] = $data;
            extraconfig($list, 'admin/website');
            return json(1);
        }
        return json($list['contact_info']);
    }
}
