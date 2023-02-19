<?php
namespace app\admin\controller;
date_default_timezone_set("Asia/Chongqing");
error_reporting(E_ERROR);
header("Content-Type: text/html; charset=utf-8");
use app\common\controller\AdminBase;
use think\facade\View;
use think\facade\Request;
use think\facade\Db;
use think\facade\Cache;
use think\facade\Session;
use think\facade\Env;
use think\facade\Filesystem;
use think\facade\Config;

use app\common\model\Uploads as UploadsModel;

class Uploads extends AdminBase
{
    protected $noAuth = [ 'uploadImage', 'uploadFile', 'uploadVideo', 'editor'];
    
    public function index()
    {
        return $this->fetch('index');
    }
    public function index_json($limit='15')
    {
        $list = UploadsModel::order('id desc')->paginate($limit);
        $this->result($list);
    }

    //上传图片
    public function uploadImage()
    {
        try {
            $file = request()->file('file');
            //处理图片
            UploadsModel::UploadValidate($file);
            $params = Config::load('setting/qiniu','qiniu');
            //判断上传位置
            if($params['type']=='1'){//七牛
                $key = date('Y/md/His_').substr(microtime(), 2, 6).'_'.mt_rand(0,999).'.'.$file->getOriginalExtension();
                $qiniu = new \app\common\library\Qiniu();
                $url = $params['domain'].$qiniu->upload($file->getRealPath(), $key);
                UploadsModel::CreateInfoAdmin('qiniu',$params['domain'], $key, $file->getSize(), $file->getOriginalMime());
                insert_admin_log('上传了图片');
                return ['code' => 1, 'url' => $url,'msg'=>'上传成功'];
            }else{//默认本地
                $savename = Filesystem::disk('public')->putFile('uploads',$file);
                $url = request()->domain().'/'.$savename;
                UploadsModel::CreateInfoAdmin('local','', $savename, $file->getSize(), $file->getOriginalMime());
                insert_admin_log('上传了图片');
                return ['code' => 1, 'url' => $url,'msg'=>'上传成功'];
            }
        } catch (\Exception $e) {
            return ['code' => 0, 'msg' => $e->getMessage()];
        }
    }
    //删除图片
    public function del()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            $files = UploadsModel::where('id',$param['id'])->find();
            //判断存储位置
            if($files->getData('storage')=='qiniu'){
                $qiniuconfig = Config::load('setting/qiniu','qiniu');
                $key = $files['file_name'];
                $qiniu = new \app\common\library\Qiniu();
                $qiniu->delete($key);
                UploadsModel::destroy($param['id']);
                insert_admin_log('删除了图片');
                $this->success('删除成功');
            }elseif($files->getData('storage')=='local'){
                $result = unlink($files['file_name']);
                if($result){
                    $delete = UploadsModel::destroy($param['id']);
                    insert_admin_log('删除了图片');
                    $this->success('删除成功');
                }else{
                    $delete = UploadsModel::destroy($param['id']);
                    UploadsModel::where('id',$param['id'])->update(['status'=>'0']);
                    $this->success('删除失败');
                }
            }
            
        }
    }
    //Ueditor 上传
    public function editor()
    {
        $CONFIG = json_decode(preg_replace("/\/\*[\s\S]+?\*\//", "", file_get_contents(request()->domain()."/static/libs/ueditor/config.json")), true);
        $action = input('action');
        switch ($action) {
            case 'config':
                $result =  json_encode($CONFIG);
                //$result =  $this->config();
                break;
            /* 上传图片 */
            case 'uploadimage':
		        $fieldName = $CONFIG['imageFieldName'];
		        $result = $this->upFile($fieldName);
		        break;
            /* 上传涂鸦 */
            case 'uploadscrawl':
		        $config = array(
		            "pathFormat" => $CONFIG['scrawlPathFormat'],
		            "maxSize" => $CONFIG['scrawlMaxSize'],
		            "allowFiles" => $CONFIG['scrawlAllowFiles'],
		            "oriName" => "scrawl.png"
		        );
		        $fieldName = $CONFIG['scrawlFieldName'];
		        $base64 = "base64";
		        $result = $this->upBase64($config,$fieldName);
		        break;
            /* 上传视频 */
            case 'uploadvideo':
		        $fieldName = $CONFIG['videoFieldName'];
		        $result = $this->upFile($fieldName);
		        break;
            /* 上传文件 */
            case 'uploadfile':
		        $fieldName = $CONFIG['fileFieldName'];
		        $result = $this->upFile($fieldName);
                break;
            /* 列出图片 */
            case 'listimage':
			    $allowFiles = $CONFIG['imageManagerAllowFiles'];
			    $listSize = $CONFIG['imageManagerListSize'];
			    $path = $CONFIG['imageManagerListPath'];
			    $get =$_GET;
			    $result =$this->fileList($allowFiles,$listSize,$get);
                break;
            /* 列出文件 */
            case 'listfile':
			    $allowFiles = $CONFIG['fileManagerAllowFiles'];
			    $listSize = $CONFIG['fileManagerListSize'];
			    $path = $CONFIG['fileManagerListPath'];
			    $get = $_GET;
			    $result = $this->fileList($allowFiles,$listSize,$get);
                break;
            /* 抓取远程文件 */
            case 'catchimage':
                $config = array(
                        "pathFormat" => $CONFIG['catcherPathFormat'],
                        "maxSize" => $CONFIG['catcherMaxSize'],
                        "allowFiles" => $CONFIG['catcherAllowFiles'],
                        "oriName" => "remote.png"
                    );
                    $fieldName = $CONFIG['catcherFieldName'];
                    /* 抓取远程图片 */
                    $list = array();
                    isset($_POST[$fieldName]) ? $source = $_POST[$fieldName] : $source = $_GET[$fieldName];

                    foreach($source as $imgUrl){
                        $info = json_decode($this->saveRemote($config,$imgUrl),true);
                        array_push($list, array(
                            "state" => $info["state"],
                            "url" => '/'.$info["url"],
                            "size" => $info["size"],
                            "title" => htmlspecialchars($info["title"]),
                            "original" => htmlspecialchars($info["original"]),
                            "source" => htmlspecialchars($imgUrl)
                        ));
                    }

                    $result = json_encode(array(
                        'state' => count($list) ? 'SUCCESS':'ERROR',
                        'list' => $list
                    ));
                break;
            default:
                $result = json_encode(array(
                    'state' => 'success'
                ));
                break;
        }
 
        /* 输出结果 */
        if(isset($_GET["callback"])){
            if(preg_match("/^[\w_]+$/", $_GET["callback"])){
                echo htmlspecialchars($_GET["callback"]).'('.$result.')';
            }else{
                echo json_encode(array(
                    'state' => 'callback参数不合法'
                ));
            }
        }else{
            echo $result;
        }
    }

    //上传文件
    private function upFile($fieldName){
        $file = request()->file($fieldName);
        //处理图片
        UploadsModel::UploadValidate($file);
        $params = Config::load('setting/qiniu','qiniu');
        //判断上传位置
        if($params['type']=='1'){//七牛
            $key = date('Y/md/His_').substr(microtime(), 2, 6).'_'.mt_rand(0,999).'.'.$file->getOriginalExtension();
            $qiniu = new \app\common\library\Qiniu();
            $url = $params['domain'].$qiniu->upload($file->getRealPath(), $key);
            UploadsModel::CreateInfoAdmin('qiniu',$params['domain'], $key, $file->getSize(), $file->getOriginalMime());
            $data = array(
                'state' => 'SUCCESS',
                'url' => $url,
                'title' => $file->getOriginalName(),
                'original' => $file->getOriginalMime(),
                'type' => '.' . $file->getOriginalMime(),
                'size' =>$file->getSize(),
            );
            return json_encode($data);
        }else{//默认本地
            $savename = Filesystem::disk('public')->putFile('uploads',$file);
            if($savename){//上传成功
                UploadsModel::CreateInfoAdmin('local','', $savename, $file->getSize(), $file->getOriginalMime());
                $data=array(
                    'state' => 'SUCCESS',
                    'url' => '/'.$savename,
                    'title' => $file->getOriginalName(),
                    'original' => $file->getOriginalMime(),
                    'type' => '.' . $file->getOriginalMime(),
                    'size' =>$file->getSize(),
                );
            }else{
                $data=array(
                    'state' => '出错',
                );
            }
            return json_encode($data);
        }
            
    }

    //列出图片
    private function fileList($allowFiles,$listSize,$get){
            $dirname = './uploads/';
            $allowFiles = substr(str_replace(".","|",join("",$allowFiles)),1);

            /* 获取参数 */
            $size = isset($get['size']) ? htmlspecialchars($get['size']) : $listSize;
            $start = isset($get['start']) ? htmlspecialchars($get['start']) : 0;
            $end = $start + $size;

            /* 获取文件列表 */
            $path = $dirname;
            $files = $this->getFiles($path,$allowFiles);
            if(!count($files)){
                return json_encode(array(
                    "state" => "no match file",
                    "list" => array(),
                    "start" => $start,
                    "total" => count($files)
                ));
            }

            /* 获取指定范围的列表 */
            $len = count($files);
            for($i = min($end, $len) - 1, $list = array(); $i < $len && $i >= 0 && $i >= $start; $i--){
                $list[] = $files[$i];
            }

            /* 返回数据 */
            $result = json_encode(array(
                "state" => "SUCCESS",
                "list" => $list,
                "start" => $start,
                "total" => count($files)
            ));

            return $result;
    }

    /*
     * 遍历获取目录下的指定类型的文件
     * @param $path
     * @param array $files
     * @return array
    */
    private function getFiles($path,$allowFiles,&$files = array()){
        if(!is_dir($path)) return null;
        if(substr($path,strlen($path)-1) != '/') $path .= '/';
        $handle = opendir($path);

        while(false !== ($file = readdir($handle))){
            if($file != '.' && $file != '..'){
                $path2 = $path.$file;
                if(is_dir($path2)){
                    $this->getFiles($path2,$allowFiles,$files);
                }else{
                        if(preg_match("/\.(".$allowFiles.")$/i",$file)){
                            $files[] = array(
                                'url' => substr($path2,1),
                                'mtime' => filemtime($path2)
                            );
                        }
                }
            }
        }

        return $files;
}

    //抓取远程图片
    private function saveRemote($config,$fieldName)
    {
        $imgUrl = htmlspecialchars($fieldName);
        $imgUrl = str_replace("&","&",$imgUrl);

        //http开头验证
        if(strpos($imgUrl,"http") !== 0){
            $data=array(
                    'state' => '链接不是http链接',
                );
            return json_encode($data);
        }
        //获取请求头并检测死链
        $heads = get_headers($imgUrl);
        if(!(stristr($heads[0],"200") && stristr($heads[0],"OK"))){
            $data=array(
                    'state' => '链接不可用',
                );
            return json_encode($data);
        }
        //格式验证(扩展名验证和Content-Type验证)
        $fileType = strtolower(strrchr($imgUrl,'.'));
        if(!in_array($fileType,$config['allowFiles']) || stristr($heads['Content-Type'],"image")){
            $data=array(
                    'state' => '链接contentType不正确',
                );
            return json_encode($data);
        }

        //打开输出缓冲区并获取远程图片
        ob_start();
        $context = stream_context_create(
            array('http' => array(
                'follow_location' => false // don't follow redirects
            ))
        );
        readfile($imgUrl,false,$context);
        $img = ob_get_contents();
        ob_end_clean();
        preg_match("/[\/]([^\/]*)[\.]?[^\.\/]*$/",$imgUrl,$m);

        $dirname = './uploads/remote/'.date('Ymd').'/';
        $file['oriName'] = $m ? $m[1] : "";
        $file['filesize'] = strlen($img);
        $file['ext'] = strtolower(strrchr($config['oriName'],'.'));
        $file['name'] = uniqid().$file['ext'];
        $file['fullName'] = $dirname.$file['name'];
        $fullName = $file['fullName'];
            
        //检查文件大小是否超出限制
        if($file['filesize'] >= ($config["maxSize"])){
            $data=array(
                'state' => '文件大小超出网站限制',
            );
            return json_encode($data);
        }
        //创建目录失败
        if(!file_exists($dirname) && !mkdir($dirname,0777,true)){
                $data=array(
                        'state' => '目录创建失败',
                );
                return json_encode($data);
        }else if(!is_writeable($dirname)){
                $data=array(
                        'state' => '目录没有写权限',
                );
                return json_encode($data);
        }
        //移动文件
        if(!(file_put_contents($fullName, $img) && file_exists($fullName))){ //移动失败
                $data=array(
                        'state' => '写入文件内容错误',
                );
                return json_encode($data);
        }else{ //移动成功
            UploadsModel::CreateInfoAdmin('local','', $file['oriName'], $file['filesize'], $file['oriName']);
            $data=array(
                'state' => 'SUCCESS',
                'url' => substr($file['fullName'],2),
                'title' => $file['name'],
                'original' => $file['oriName'],
                'type' => $file['ext'],
                'size' => $file['filesize'],
            );
        }
        return json_encode($data);
    }

/*
     * 处理base64编码的图片上传
     * 例如：涂鸦图片上传
    */
    private function upBase64($config,$fieldName){
        $base64Data = $_POST[$fieldName];
        $img = base64_decode($base64Data);

        $dirname = './uploads/scrawl/';
        $file['filesize'] = strlen($img);
        $file['oriName'] = $config['oriName'];
        $file['ext'] = strtolower(strrchr($config['oriName'],'.'));
        $file['name'] = uniqid().$file['ext'];
        $file['fullName'] = $dirname.$file['name'];
        $fullName = $file['fullName'];

        //检查文件大小是否超出限制
        if($file['filesize'] >= ($config["maxSize"])){
                $data=array(
                        'state' => '文件大小超出网站限制',
                );
                return json_encode($data);
        }

        //创建目录失败
        if(!file_exists($dirname) && !mkdir($dirname,0777,true)){
            $data=array(
                        'state' => '目录创建失败',
                );
                return json_encode($data);
        }else if(!is_writeable($dirname)){
            $data=array(
                        'state' => '目录没有写权限',
                );
                return json_encode($data);
        }

        //移动文件
        if(!(file_put_contents($fullName, $img) && file_exists($fullName))){ //移动失败
        $data=array(
                'state' => '写入文件内容错误',
            );
        }else{ //移动成功
            UploadsModel::CreateInfoAdmin('0', $file['oriName'], $file['filesize'], $file['oriName'],substr($file['fullName'],1));
            $data=array(
                'state' => 'SUCCESS',
                'url' => '/'.substr($file['fullName'],1),
                'title' => $file['name'],
                'original' => $file['oriName'],
                'type' => $file['ext'],
                'size' => $file['filesize'],
            );
        }
        return json_encode($data);
    }
    
}
