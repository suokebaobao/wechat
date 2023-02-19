<?php

namespace app\common\model;

use think\Model;

class Page extends Model
{
    protected $pk = 'cid';
    protected $autoWriteTimestamp = true;

    public function setPhotoAttr($value)
    {
        return serialize($value);
    }

    public function getPhotoAttr($value)
    {
        return unserialize($value);
    }

    public function setContentAttr($value)
    {
        return htmlspecialchars_decode($value);
    }

    public function category()
    {
        return $this->belongsTo('category', 'id', 'id')->bind(['name','show_template']);
    }
    //更新单页
    static function update_page($model,$id,$title) {
        //检查是否单页
        if ($model == 'page'){
            //检查是否有数据
            $data = self::where(['cid'=>$id])->find();
            if(!$data){
                self::create([
                    'cid'    => $id,
                    'title' => $title,
                ]);
            }else{
                //检查是否有数据
                $data = self::where(['cid'=>$id])->find();
                if($data){
                    self::destroy($id);
                }
            }
        }
    }
    static function update_url($cid) {
        $col = self::where(['cid'=>$cid])->find();
        //获取规则
        $url = '/page/'.$col['cid'].'.html';
        self::where(['cid'=>$cid])->update(['url'=>$url]);
        return ;
    }
    //新建
    public static function CreateNewpage($cid) {
        //查询是否添加了
        $data = self::where('cid',$cid)->find();
        if(!$data){
            self::create([
                'cid'     => $cid,
            ]);
        }
        return ;
    }
    
}