<?php
namespace app\admin\controller;
use app\common\controller\AdminBase;
use think\facade\Db;
use think\facade\Request;
use think\facade\Session;
use think\facade\View;
use think\facade\Cookie;
use app\common\model\Category;
use app\common\model\CategoryModel;
use app\common\model\Page as P;

class Page extends AdminBase
{
    protected function _initialize()
    {
        parent::_initialize();
    }

    public function index()
    {
        $list = Category::where('model','page')->with(['page'])->order('id desc')->paginate();

        return $this->fetch('index', ['list' => $list]);
    }
    public function edit()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            P::update($param,['id'=>$param['id']]);
            insert_admin_log('修改了单页内容');
            $this->success('修改成功', url('@admin/page/index'));
        }
        return $this->fetch('save', ['data' => P::with(['category'])->where('id',input('id'))->find(),'show_template'=> Category::show_template()]);
    }

}