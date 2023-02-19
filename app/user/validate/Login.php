<?php

namespace app\user\validate;

use think\Validate;

class Login extends Validate
{
    protected $rule = [
        'mobile' => 'require',
        'password' => 'require',
        //'captcha'  => 'require|captcha',
    ];

    protected $message = [
        'mobile.require' => '请输入手机号码',
        'password.require' => '请输入密码',
        //'captcha.require'  => '请输入验证码',
        //'captcha.captcha'  => '验证码错误',
    ];
}
