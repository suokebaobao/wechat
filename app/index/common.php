<?php
use think\helper\Str;
use think\facade\Config;
use think\facade\Db;
use app\common\model\Article;
use app\common\model\Category;
use app\common\model\Page;
/**
 * 读取文章模板
 */
function seo($type)
{
    $website = Config::load('admin/website');
    //首页
    switch (request()->action())
    {
    case 'lists':
        $category = Category::where('id', input('id'))->find();
        $seo = $website;
        $seo['title'] = $category['name'].' - '.$website['sitename'];
        $seo['keywords'] = $category['keywords']?$category['keywords']:$website['keywords'];
        $seo['description'] = $category['description']?$category['description']:$website['description'];
        break;
    case 'show':
        $article = Article::with('category')->where('id', input('id'))->find();
        $seo = $website;
        $seo['title'] = $article['title'].' - '.$article['category_name'].' - '.$website['sitename'];
        $seo['keywords'] = $article['keywords']?$article['keywords']:$website['keywords'];
        $seo['description'] = $article['description']?$article['description']:$website['description'];
        break;
    case 'page':
        $page = Page::with('category')->where('id', input('id'))->find();
        $seo = $website;
        $seo['title'] = $article['title'].' - '.$article['category_name'].' - '.$website['sitename'];
        $seo['keywords'] = $article['keywords']?$article['keywords']:$website['keywords'];
        $seo['description'] = $article['description']?$article['description']:$website['description'];
        break;
    default:
        $seo = $website;
    }
    return $seo[$type];
}
/**
 * 阅读量增加
 */
function view_article($tablename,$id)
{
    Db::name($tablename)->where('id',$id)->inc('view')->update();
    return ;
}
/**
 * 广告获取
 */
function get_ad($id,$order='desc')
{
    $list = \app\common\model\Ad::where(['category'=>$id,'status'=>'1'])->order('sort_order $order')->select();
    return $list;
}
/**
 * 友情链接获取
 */
function get_link($id,$order='desc')
{
    $list = \app\common\model\Link::where(['category'=>$id,'status'=>'1'])->order('sort_order $order')->select();
    return $list;
}
/**
 * 上下页
 */
function frontAfter($id,$model = 'article')
{
    $article = Db::name($model)->where('id',$id)->find();
    $front = Db::name($model)->where(['cid'=>$article['cid']])->where('id','<',$id)->order(['id'=>'desc'])->find();
    $after = Db::name($model)->where(['cid'=>$article['cid']])->where('id','>',$id)->order(['id'=>'asc'])->find();
    $no['url'] = '#';
    $no['title'] = '没有了';
    $data['front'] = empty($front)?$no:$front;
    $data['after'] = empty($after)?$no:$after;
    return $data;
}
/**
 * 读取文章模板
 */
function get_template($template)
{
    return str_replace('.phtml','',$template);
}