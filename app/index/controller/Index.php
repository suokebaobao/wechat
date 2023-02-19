<?php
namespace app\index\controller;
use app\common\controller\Base;
use think\facade\View;
use app\common\model\Article;
use app\common\model\Category;
use app\common\model\Page;

class Index extends Base
{
    //protected $middleware = ['name'=>'5'];
    
    protected function initialize()
    {
        parent::initialize();
        View::assign('menu', Category::select());
    }
    //首页
    public function index()
    {
        return "六诺科技.文档地址:http://www.ennn.cn/";
    }
    //列表页
    public function lists($id)
    {
        $data = Category::where('id',$id)->find();
        if($data['model']=="article"){
            $list = Article::where('cid',$id)->paginate(9);
        }elseif($data['model']=="page"){
            $list = Page::where('id',$id)->find();
        }
        return $this->fetch(get_template($data['list_template']),['data'=>$data,'list'=>$list]);
    }
    //详情页
    public function show($id)
    {
        $data = Article::with('category')->where('id',$id)->find();
        view_article('article', $id);
        return $this->fetch(get_template($data['template']),['data'=>$data]);
    }
    
}
