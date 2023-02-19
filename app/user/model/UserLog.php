<?php
namespace app\user\model;

use think\Model;
use think\Request;

class UserLog extends Model
{
    protected $autoWriteTimestamp = true;
    protected $type = [
       
    ];
    protected $globalScope = ['shop_id'];
    
    public function scopeShop_id($query)
    {
        $query->where('shop_id', ShopId());
    }
    
    //获取部门
    public function shop()
    {
        return $this->belongsTo(Shop::class,'shop_id','id')->bind(['shop_name'=>'name']);
    }
    
    
    
}