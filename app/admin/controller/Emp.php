<?php


namespace app\admin\controller;

use think\facade\Db;

class Emp extends \app\common\controller\AdminBase
{
    protected function _initialize()
    {
        parent::_initialize();
    }

    public function index()
    {
        $id = input('id');
        if($id){
            Db::name('emp')->where(['id'=> $id]);
        }
        $list = Db::name('emp')->order('id desc')->select();

        return $this->fetch('index', ['list' => $list]);
    }

    public function add()
    {
        if($this->request->isAjax()){
            $data = $this->request->param('data',[]);
            Db::name('emp')->insert($data);
            return json(1);
        }

        return json(1);
    }

    public function editEmp(){


    }




}