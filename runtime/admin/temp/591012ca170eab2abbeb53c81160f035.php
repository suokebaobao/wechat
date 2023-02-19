<?php /*a:3:{s:86:"D:\system\phpStudy_64\phpstudy_pro\WWW\liunuo-thinkphp6\view\admin\article\index.phtml";i:1583074303;s:77:"D:\system\phpStudy_64\phpstudy_pro\WWW\liunuo-thinkphp6\view\admin\base.phtml";i:1583074303;s:86:"D:\system\phpStudy_64\phpstudy_pro\WWW\liunuo-thinkphp6\view\admin\article\dtree.phtml";i:1583074303;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>HQadmin</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="/static/hqui/libs/layui/css/layui.css"/>
    <link rel="stylesheet" href="/static/hqui/module/admin.css?v=316"/>
  <link rel="stylesheet" href="/static/css/fonts.css">
  <link rel="stylesheet" href="/static/css/base.css">
  
<link rel="stylesheet" href="/static/hqui/module/dtree/dtree.css"/>
<link rel="stylesheet" href="/static/hqui/module/dtree/font/dtreefont.css"/>
<link rel="stylesheet" href="/static/hqui/module/admin.css?v=316"/>
<style>
    #treeTbTree {
        height: 720px;
        overflow: auto;
    }

    @media screen and (max-width: 768px) {
        #treeTbTree {
            height: auto;
        }
    }

    /** dtree选中颜色重写 */
    .dtree-theme-item-this {
        background-color: #eeeeee !important;
    }
</style>
<style>
    .ew-iframe-body {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        overflow: auto;
    }
</style>

</head>
<body>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        
<!-- 正文开始 -->

<div class="layui-row layui-col-space15">
    <!-- 左树 -->
    <div class="layui-col-sm12 layui-col-md4 layui-col-lg2">
        <div class="layui-card">
            <div class="layui-card-body mini-bar" >
  <ul id="treeTbTree" class="dtree" data-id="0"></ul>
</div>
        </div>
    </div>
    <!-- 右表 -->
    <div class="layui-col-sm12 layui-col-md8 layui-col-lg10">
        <div class="layui-card">
            <div class="layui-card-header">
                <form action="<?php echo url('admin/article/index'); ?>" class="layui-form" method="get">
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <div class="layui-btn-group">
                                <a href="<?php echo url('admin/article/add', ['cid' => input('cid')]); ?>" class="layui-btn">添加数据</a>
                            </div>
                        </div>
                        
                        <div class="layui-inline">
                            <input type="text" name="title" value="<?php echo input('title'); ?>" autocomplete="off" placeholder="请输入标题" class="layui-input"/>
                        </div>
                        <div class="layui-inline">
                            <select name="cid">
                                <option value="">全部分类</option>
                                <?php if(is_array($category) || $category instanceof \think\Collection || $category instanceof \think\Paginator): if( count($category)==0 ) : echo "" ;else: foreach($category as $key=>$v): ?>
                                <option value="<?php echo htmlentities($v['id']); ?>" <?php if(input('cid') == $v['id']): ?>selected="selected"<?php endif; ?>><?php if($v['level'] != '1'): ?>|<?php $__FOR_START_1602605668__=1;$__FOR_END_1602605668__=$v['level'];for($i=$__FOR_START_1602605668__;$i < $__FOR_END_1602605668__;$i+=1){ ?> ----<?php } ?><?php endif; ?> <?php echo htmlentities($v['name']); ?></option>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                        <div class="layui-inline">
                            <select name="is_top">
                                <option value="">是否置顶</option>
                                <option value="1" <?php if(input('?is_top') and (input('is_top') == 1)): ?> selected="selected"<?php endif; ?>>是</option>
                                <option value="0" <?php if(input('?is_top') and (input('is_top') == 0)): ?> selected="selected"<?php endif; ?>>否</option>
                            </select>
                        </div>
                        <div class="layui-inline">
                            <select name="is_hot">
                                <option value="">是否推荐</option>
                                <option value="1" <?php if(input('?is_hot') and (input('is_hot') == 1)): ?> selected="selected"<?php endif; ?>>是</option>
                                <option value="0" <?php if(input('?is_hot') and (input('is_hot') == 0)): ?> selected="selected"<?php endif; ?>>否</option>
                            </select>
                        </div>
                        <div class="layui-inline">
                            <button class="layui-btn layui-btn-primary ajax-search"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
                
            </div>
            <table id="tableTbTree" lay-filter="tableTbTree"></table>
            <!-- 表格操作列 -->
            <script type="text/html" id="tableTBOrder">
                <a href="<?php echo url('admin/article/edit'); ?>?id={{d.id}}" class="layui-btn layui-btn-sm">修改</a>
                <a href="<?php echo url('admin/article/del'); ?>?id={{d.id}}" class="layui-btn layui-btn-danger layui-btn-sm ajax-delete">删除</a>
            </script>
            <!-- 权限列 -->
            <script type="text/html" id="is_top">
                <input type="checkbox" name="is_top" lay-skin="switch" lay-filter="*" lay-text="是|否" data-url="<?php echo url('admin/article/edit'); ?>?id={{d.id}}" {{d.is_top==1?'checked':''}}>
            </script>
            <!-- 权限列 -->
            <script type="text/html" id="is_hot">
                <input type="checkbox" name="is_hot" lay-skin="switch" lay-filter="*" lay-text="是|否" data-url="<?php echo url('admin/article/edit'); ?>?id={{d.id}}" {{d.is_hot==1?'checked':''}}>
            </script>
            <!-- 权限列 -->
            <script type="text/html" id="status">
                <input type="checkbox" name="status" lay-skin="switch" lay-filter="*" lay-text="发布|禁用" data-url="<?php echo url('admin/article/edit'); ?>?id={{d.id}}" {{d.status==1?'checked':''}}>
            </script>
            <!-- 权限列 -->
            <script type="text/html" id="sort_order">
                <input type="text" name="sort_order" value="{{d.sort_order}}" autocomplete="off" class="layui-input ajax-update" data-url="<?php echo url('admin/article/edit'); ?>?id={{d.id}}">
            </script>

        </div>
    </div>

</div>


    </div>
</div>
<script type="text/javascript" src="/static/hqui/libs/layui/layui.all.js"></script>
<script type="text/javascript" src="/static/js/jquery.min.js"></script>
<script type="text/javascript" src="/static/js/layui.base.js"></script>
<script type="text/javascript" src="/static/hqui/js/common.js?v=316"></script>

<script>
    layui.extend({dtree:'dtree/dtree'}).use(['layer', 'form', 'table', 'util', 'dtree', 'index'], function () {
        var $ = layui.jquery;
        var layer = layui.layer;
        var form = layui.form;
        var table = layui.table;
        var util = layui.util;
        var dtree = layui.dtree;
        var admin = layui.admin;
        var dropdown = layui.dropdown;
        var index = layui.index;
        var cid = "<?php echo htmlentities($cid); ?>";
        var title = "<?php echo input('title'); ?>";
        var is_top = "<?php echo input('is_top'); ?>";
        var is_hot = "<?php echo input('is_hot'); ?>";
        // 渲染表格
        var insTb = table.render({
            elem: '#tableTbTree',
            url: '/admin/article/get_content',
            where:{cid:cid,title:title,is_hot:is_hot,is_top:is_top},
            page: true,
            limit:15,
            limits:[15,30,45,60,75,90],
            cellMinWidth: 100,
            cols: [[
                {type:'numbers',title:'#',field:'id'},
                {field: 'title', align: 'left', sort: true, title: '标题', minWidth: 380},
                {field: 'category_name', align: 'center', sort: true, title: '栏目', width:120},
                {align: 'center', sort: true, title: '排序',templet:'#sort_order',width:120},
                {align: 'center', sort: true, title: '置顶',templet:'#is_top',width:100},
                {align: 'center', sort: true, title: '推荐',templet:'#is_hot',width:100},
                {align: 'center', sort: true, title: '状态',templet:'#status',width:100},
                {field: 'create_time', align: 'center', sort: true, title: '时间',width:160},
                {align: 'center', toolbar: '#tableTBOrder', title: '操作',width: 170}
            ]],
            parseData: function(res){ //res 即为原始返回的数据
                return {
                  "code": res.code, //解析接口状态
                  "msg": res.msg, //解析提示文本
                  "count": res.data.total, //解析数据长度
                  "data": res.data.data //解析数据列表
                };
            }
        });

        // 树形渲染
        var treeTbTree = dtree.render({
            elem: '#treeTbTree',
            url: '/admin/article/get_category_tree',
            none: "请先添加数据？",
            type:'all',
            initLevel: '5',
            dot: false,
            line:true,
            method: 'GET'
        });

        // 树形点击事件
        dtree.on('node("treeTbTree")', function (obj) {
            var data = obj.param;
            //console.log(data)
            if(!data.leaf){
                var $div = obj.dom;
                treeTbTree.clickSpread($div);  //调用内置函数展开节点
            }
            //判断点开页面
            if(data.leaf === true){
//                console.log(obj.parentParam)
                //console.log(data);
                var url = "<?php echo url('admin/article/index'); ?>?cid=" + data.nodeId;
                window.location.href = url;
//                index.openTab({
//                    title: data.context, 
//                    url: "<?php echo url('admin/article/index'); ?>?cid=" + data.nodeId,
//                });
            }
        });
        
    });
</script>

</body>
</html>