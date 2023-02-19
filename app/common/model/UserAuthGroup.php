<?php
namespace app\common\model;
use think\Model;
use think\model\concern\SoftDelete;

class UserAuthGroup extends Model
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = 0;
    protected $autoWriteTimestamp = true;
    protected function base($query)
    {

    }
}