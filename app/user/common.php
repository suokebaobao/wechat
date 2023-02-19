<?php
use think\facade\Session;
use think\facade\Request;
use think\facade\Config;
use think\facade\Db;
/**
 * 检测会员是否登录
 * @return integer 0/管理员ID
 */
function is_user_login()
{
    $user = Session::get('user_auth');
    if (empty($user)) {
        return 0;
    } else {
        return Session::get('user_auth_sign') == data_auth_sign($user) ? $user['user_id'] : 0;
    }
}

/**
 * 保存前台用户行为
 * @param string $remark 日志备注
 */
function insert_user_log($remark)
{
    if (request()->isMobile()) {
        $m = '1';
    }else{
        $m = '0';
    }
    if (session('?user_auth')) {
        Db::name('user_log')->insert([
            'shop_id'     => Session::get('user_auth.shop_id'),
            'client'     => $m,
            'user_id'     => Session::get('user_auth.user_id'),
            'ip'          => request()->ip(),
            'url'         => request()->url(true),
            'method'      => request()->method(),
            'type'        => request()->type(),
            'param'       => json_encode(request()->param()),
            'remark'      => $remark,
            'create_time' => time(),
        ]);
    }
}
//网站信息
function seo($type)
{
    $website = Config::load('admin/website');
    return $website[$type];
}
//获取用户ID
function UserId()
{
    $info = session('user_auth.user_id');
    return $info;
}
//获取商家ID
function ShopId()
{
    $info = session('user_auth.shop_id');
    return $info;
}