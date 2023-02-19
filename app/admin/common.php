<?php
use think\facade\Session;
use think\facade\Config;
/**
 * 修改扩展配置文件
 * @param array  $arr  需要更新或添加的配置
 * @param string $file 配置文件名(不需要后辍)
 * @return bool
 */
function extraconfig($arr = [], $file = 'website')
{
    if (is_array($arr)) {
        $filename = $file .'.php';
        $filepath = config_path() . $filename;
        if (!file_exists($filepath)) {
            $conf = "<?php return [];";
            file_put_contents($filepath, $conf);
        }
        $conf = include $filepath;
        foreach ($arr as $key => $value) {
            $conf[$key] = $value;
        }
        $time = date('Y/m/d H:i:s');
        $str = "<?php\r\n/**\r\n * 程兴科技（http://www.cxnetx.net）.\r\n * $time\r\n */\r\nreturn [\r\n";
        foreach ($conf as $key => $value) {
            $str .= "\t'$key' => '$value',";
            $str .= "\r\n";
        }
        $str .= '];';
        file_put_contents($filepath, $str);
        
        return true;
    } else {
        return false;
    }
}

/**
 * 检测管理员是否登录
 * @return integer 0/管理员ID
 */
function is_admin_login()
{
    $admin = Session::get('admin_auth');
    if (empty($admin)) {
        return 0;
    } else {
        return Session::get('admin_auth_sign') == data_auth_sign($admin) ? $admin['admin_id'] : 0;
    }
}
/**
 * 保存后台用户行为
 * @param string $remark 日志备注
 */
function insert_admin_log($remark)
{
    if (session('?admin_auth')) {
        \app\common\model\AdminLog::insert([
            'admin_id'    => Session::get('admin_auth.admin_id'),
            'username'    => Session::get('admin_auth.username'),
            'useragent'   => request()->server('HTTP_USER_AGENT'),
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
/**
 * 参数字段配置
 * @param string $remark 日志备注
 */
function field_config()
{
    $field = Config::load('admin/field','field');
    return $field;
}