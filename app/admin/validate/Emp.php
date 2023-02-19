<?php

namespace app\admin\validate;

use think\Validate;

class Emp extends Validate
{
    protected $rule = [
        'name'   => 'require',
        'mobile'   => 'require|mobile',
        'password' => 'min:6|max:16',
    ];

    protected $message = [
        'mobile.require'   => '手机号不能为空',
        'mobile.mobile'    => '手机号码格式不正确',
        'password.min'     => '密码长度不能小于6位',
        'password.max'     => '密码长度不能大于16位',
    ];
}
