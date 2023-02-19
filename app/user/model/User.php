<?php
namespace app\user\model;
use think\Model;
use think\model\concern\SoftDelete;

class User extends Model
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
    public function setPasswordAttr($value)
    {
        return md5($value);
    }

    public function userAuthGroup()
    {
        return $this->belongsTo(UserAuthGroup::class, 'group_id', 'id')->bind(['rules']);
    }
    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id', 'id')->bind(['shop_name'=>'name']);
    }
    
}