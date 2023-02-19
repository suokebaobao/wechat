<?php

namespace app\user\model;
use think\facade\Session;
use think\Model;

class UserAuthRule extends Model
{
    // 获取导航栏
    public static function getNavbar()
    {
        $where = ['type' => 'nav', 'status' => 1];
        if (Session::get('user_auth.user_id') != '1') {
            $access  = User::with('userAuthGroup')->where('id', Session::get('user_auth.user_id'))->find();
            if($access){
                $where = "type='nav' and status = '1' and id in(".$access['rules'].")";
            }
        }
        $navs = self::where($where)->order('sort_order asc')->select();
        return collection($navs)->toArray();
    }
}