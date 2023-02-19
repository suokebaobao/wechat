<?php
namespace app\user\model;
use think\Model;
use think\model\concern\SoftDelete;

class UserAuthGroup extends Model
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = 0;
    protected $autoWriteTimestamp = true;
    protected $globalScope = ['shop_id'];
    
    public function scopeShop_id($query)
    {
        $query->where('shop_id', ShopId());
    }
    
    //获取权限组列表
    static function list_to_level() {
        $list = list_to_level(self::order('id desc')->select());
        return $list;
    }

}