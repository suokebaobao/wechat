<?php
namespace app\common\model;

use think\Model;
use think\Request;

class UserLog extends Model
{
    protected $autoWriteTimestamp = true;
    protected $type = [
       
    ];
    protected function base($query)
    {

    }
    //获取部门
    public function shop()
    {
        return $this->belongsTo(Shop::class,'shop_id','id')->bind(['shop_name'=>'name']);
    }
    
    
    
}