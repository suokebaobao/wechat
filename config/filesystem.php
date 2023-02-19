<?php

use think\facade\Env;

return [
    // 默认磁盘
    'default' => Env::get('filesystem.driver', 'local'),
    // 磁盘列表
    'disks'   => [
        'local'  => [
            'type' => 'local',
            'root' => app()->getRuntimePath() . 'storage',
        ],
        'public' => [
            // 磁盘类型
            'type'       => 'local',
            // 磁盘路径
            'root'       => app()->getRootPath() . 'public',
            // 磁盘路径对应的外部URL路径
            'url'        => '/public',
            // 可见性
            'visibility' => 'public',
        ],
        // 更多的磁盘配置信息
        //增加下面配置项
        'qiniu' =>[	//完全可以自定义的名称
            'type'=>'qiniu',	//可以自定义,实际上是类名小写
        ]
    ],
];
