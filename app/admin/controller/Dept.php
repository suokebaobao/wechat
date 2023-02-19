<?php


namespace app\admin\controller;


use app\common\controller\AdminBase;
use think\facade\Db;

class Dept extends AdminBase
{
    protected function _initialize()
    {
        parent::_initialize();
    }
    public function getAlldept(){

        $list = Db::name('dept')->select();
        echo '<pre>';
        return json($list);
    }

    public function addDept(){
        $name = $this->request->post('name','');
        $res = Db::name('dept')->insert([
            'name' => mt_rand(0,9999).$name
        ]);
        echo $res;
    }

    public function editDept(){
        $id = $this->request->param('id',0);
        $name = $this->request->param('name',0);
        $res = Db::name('dept')->where(['id'=>$id])->update([
            'name' => mt_rand(0,9999).$name
        ]);
        return json($res);

    }


    /*
     * 岗位
     *
     * */
    public function getAllJob(){

    }

    /*
     * 添加岗位
     *
     * */
    public function addJob(){

    }

    /*
     * 修改岗位
     *
     * */
    public function editJob(){


    }


}