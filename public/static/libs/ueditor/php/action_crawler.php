<?php
/**
 * 抓取远程图片
 * User: Jinqn
 * Date: 14-04-14
 * Time: 下午19:18
 */
use Qiniu\Auth as Auth;
use Qiniu\Storage\BucketManager;
use Qiniu\Storage\UploadManager;


set_time_limit(0);
include("Uploader.class.php");
include(__DIR__ ."/../../../../../vendor/qiniu/autoload.php");
$qiniuConfig = include(__DIR__ ."/../../../../../application/setting.php");


/* 上传配置 */
$config = array(
    "pathFormat" => $CONFIG['catcherPathFormat'],
    "maxSize" => $CONFIG['catcherMaxSize'],
    "allowFiles" => $CONFIG['catcherAllowFiles'],
    "oriName" => "remote.png"
);
$fieldName = $CONFIG['catcherFieldName'];

/* 抓取远程图片 */
$list = array();
if (isset($_POST[$fieldName])) {
    $source = $_POST[$fieldName];
} else {
    $source = $_GET[$fieldName];
}
foreach ($source as $imgUrl) {
    $item = new Uploader($imgUrl, $config, "remote");
    $info = $item->getFileInfo();
    //判断储存位置
    if($qiniuConfig['qiniu']['type']=='1'){//七牛
        $uploadImageUrl = (isHTTPS() ? 'https://' : 'http://').$_SERVER['HTTP_HOST'].$info["url"];
        $ch = curl_init($uploadImageUrl);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
        //读取图片信息
        $rawData = curl_exec($ch);
        curl_close($ch);
        //读取文件到本地
        //file_put_contents('aa.png',$rawData);
        #读取网上图片内容
        $imageData = $rawData;
        $auth = new Auth($qiniuConfig['qiniu']['upak'],$qiniuConfig['qiniu']['upsk']);
        $token = $auth->uploadToken($qiniuConfig['qiniu']['upbucket']);
        #上传的文件名
        $ext = substr($uploadImageUrl, strrpos($uploadImageUrl, '.'));  //后缀
        // 上传到七牛后保存的文件名
        $key = date('Y').'/'.date('md').'/'.date('YmdHis').rand(0,9999).substr(md5($uploadImageUrl),0,5) . $ext;
        $up    = new UploadManager();
        $mime  = $info["type"];
        list($rest, $err) = $up->put($token, $key, $imageData, null, $mime);
        $domain = $qiniuConfig['qiniu']['updomain'];
        array_push($list, array(
            "state" => $info["state"],
            "url" => $domain.$key,
            "size" => $info["size"],
            "title" => htmlspecialchars($info["title"]),
            "original" => htmlspecialchars($info["original"]),
            "source" => htmlspecialchars($imgUrl)
        ));
    }else{//本地存储
        array_push($list, array(
            "state" => $info["state"],
            "url" => $info["url"],
            "size" => $info["size"],
            "title" => htmlspecialchars($info["title"]),
            "original" => htmlspecialchars($info["original"]),
            "source" => htmlspecialchars($imgUrl)
        ));
    }
}
/* 返回抓取数据 */
return json_encode(array(
    'state'=> count($list) ? 'SUCCESS':'ERROR',
    'list'=> $list
));

function isHTTPS()
{
    if (defined('HTTPS') && HTTPS) return true;
    if (!isset($_SERVER)) return FALSE;
    if (!isset($_SERVER['HTTPS'])) return FALSE;
    if ($_SERVER['HTTPS'] === 1) {  //Apache
        return TRUE;
    } elseif ($_SERVER['HTTPS'] === 'on') { //IIS
        return TRUE;
    } elseif ($_SERVER['SERVER_PORT'] == 443) { //其他
        return TRUE;
    }
    return FALSE;
}