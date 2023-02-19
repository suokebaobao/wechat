<?php

namespace app\admin\validate;

use think\Validate;

class shop extends Validate
{
    protected $rule = [
        'name' => 'require',
        'mobile' => 'mobile',
        'exp_time' => 'require',
    ];

    protected $message = [
        'name.require' => '分类名称不能为空',
        'mobile.mobile' => '手机号码格式错误',
        'exp_time.require' => '过期时间不能为空',
    ];
}
