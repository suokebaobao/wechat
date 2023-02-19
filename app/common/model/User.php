<?php
namespace app\common\model;
use think\Model;
use think\model\concern\SoftDelete;

class User extends Model
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = 0;
    protected $autoWriteTimestamp = true;
    
    protected function base($query)
    {

    }
    public function setPasswordAttr($value)
    {
        return md5($value);
    }

    public function userAuthGroup()
    {
        return $this->belongsTo('userAuthGroup', 'group_id', 'id')->bind('name');
    }
    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id', 'id')->bind(['shop_name'=>'name']);
    }
    
}