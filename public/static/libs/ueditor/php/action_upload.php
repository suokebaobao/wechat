<?php
/**
 * 上传附件和上传视频
 * User: Jinqn
 * Date: 14-04-09
 * Time: 上午10:17
 */
use Qiniu\Auth as Auth;
use Qiniu\Storage\BucketManager;
use Qiniu\Storage\UploadManager;

set_time_limit(0);
include("Uploader.class.php");
include(__DIR__ ."/../../../../../vendor/qiniu/autoload.php");
$qiniuConfig = include(__DIR__ ."/../../../../../application/setting.php");
/* 上传配置 */
$base64 = "upload";
switch (htmlspecialchars($_GET['action'])) {
    case 'uploadimage':
        $config = array(
            "pathFormat" => $CONFIG['imagePathFormat'],
            "maxSize" => $CONFIG['imageMaxSize'],
            "allowFiles" => $CONFIG['imageAllowFiles']
        );
        $fieldName = $CONFIG['imageFieldName'];
        break;
    case 'uploadscrawl':
        $config = array(
            "pathFormat" => $CONFIG['scrawlPathFormat'],
            "maxSize" => $CONFIG['scrawlMaxSize'],
            "allowFiles" => $CONFIG['scrawlAllowFiles'],
            "oriName" => "scrawl.png"
        );
        $fieldName = $CONFIG['scrawlFieldName'];
        $base64 = "base64";
        break;
    case 'uploadvideo':
        $config = array(
            "pathFormat" => $CONFIG['videoPathFormat'],
            "maxSize" => $CONFIG['videoMaxSize'],
            "allowFiles" => $CONFIG['videoAllowFiles']
        );
        $fieldName = $CONFIG['videoFieldName'];
        break;
    case 'uploadfile':
    default:
        $config = array(
            "pathFormat" => $CONFIG['filePathFormat'],
            "maxSize" => $CONFIG['fileMaxSize'],
            "allowFiles" => $CONFIG['fileAllowFiles']
        );
        $fieldName = $CONFIG['fileFieldName'];
        break;
}

/* 生成上传实例对象并完成上传 */
$upfiles = new Uploader($fieldName, $config, $base64);

/**
 * 得到上传文件所对应的各个参数,数组结构
 * array(
 *     "state" => "",          //上传状态，上传成功时必须返回"SUCCESS"
 *     "url" => "",            //返回的地址
 *     "title" => "",          //新文件名
 *     "original" => "",       //原始文件名
 *     "type" => ""            //文件类型
 *     "size" => "",           //文件大小
 * )
 */
$info = $upfiles->getFileInfo();
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
    $upqn    = new UploadManager();
    $mime  = $info["type"];
    list($rest, $err) = $upqn->put($token, $key, $imageData, null, $mime);
    $domain = $qiniuConfig['qiniu']['updomain'];
    return json_encode(array(
        "state" => $info["state"],
        "url" => $domain.$key,
        "size" => $info["size"],
        "title" => htmlspecialchars($info["title"]),
        "type" => htmlspecialchars($info["type"]),
        "original" => htmlspecialchars($info["original"]),
        //"source" => htmlspecialchars($fieldName)
    ));
}else{//本地存储
    return json_encode(array(
        "state" => $info["state"],
        "url" => $info["url"],
        "size" => $info["size"],
        "title" => htmlspecialchars($info["title"]),
        "type" => htmlspecialchars($info["type"]),
        "original" => htmlspecialchars($info["original"]),
        //"source" => htmlspecialchars($fieldName)
    ));
}

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
