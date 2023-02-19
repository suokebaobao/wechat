<?php
namespace app\common\model;
use think\Model;
use think\model\concern\SoftDelete;

class Shop extends Model
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = 0;
    protected $autoWriteTimestamp = true;
    
    public function getExpTimeAttr($value)
    {
        return date('Y-m-d',$value);
    }
    public function setExpTimeAttr($value)
    {
        return strtotime($value);
    }
}