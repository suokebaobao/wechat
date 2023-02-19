<?php /*a:2:{s:83:"D:\system\phpStudy_64\phpstudy_pro\WWW\liunuo-thinkphp6\view\admin\link\index.phtml";i:1583074303;s:77:"D:\system\phpStudy_64\phpstudy_pro\WWW\liunuo-thinkphp6\view\admin\base.phtml";i:1583074303;}*/ ?>
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
  
<style>
    #tableTbImg + .layui-table-view .layui-table-body tbody > tr > td {
        padding: 0;
    }

    #tableTbImg + .layui-table-view .layui-table-body tbody > tr > td > .layui-table-cell {
        height: 146px;
        line-height: 146px;
    }

    .tdImg {
        width: 350px;
        height: 90px;
        cursor: zoom-in;
        border-radius: 10%;
        border: 2px solid #dddddd;
    }
</style>

</head>
<body>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        
<div class="layui-card">
    <div class="layui-card-header">
        
        <form action="<?php echo url('admin/link/index'); ?>" class="layui-form" method="get">
            <div class="layui-form-item">
                <div class="layui-input-inline">
                    <a href="<?php echo url('admin/link/add'); ?>" class="layui-btn ajax-iframe" data-width="80%" data-height="535px"><i class="fa fa-plus-circle"></i> 添加链接</a>
                </div>
                <div class="layui-input-inline">
                    <input name="name" type="text" placeholder="请输入名称" autocomplete="off" value="<?php echo input('name'); ?>" class="layui-input" />
                </div>
                <div class="layui-input-inline">
                    <select name="category">
                        <option value="">全部分类</option>
                        <?php if(is_array($category) || $category instanceof \think\Collection || $category instanceof \think\Paginator): if( count($category)==0 ) : echo "" ;else: foreach($category as $k=>$v): ?>
                        <option value="<?php echo htmlentities($v['id']); ?>" <?php if(input('category') == $v['id']): ?>selected="selected"<?php endif; ?>><?php echo htmlentities($v['name']); ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
                <div class="layui-input-inline">
                    <button class="layui-btn layui-btn-primary ajax-search"><i class="fa fa-search"></i></button>
                </div>
                <div class="layui-btn-group">
                    <a href="<?php echo url('admin/link/category'); ?>" class="layui-btn ajax-iframe" data-width="700px" data-height="400px"><i class="fa fa-plus-circle"></i> 分类管理</a>
                </div>
            </div>
        </form>
    </div>
    
    <table id="tableList" lay-filter="tableList"></table>
    <!-- 表格操作列 -->
    <script type="text/html" id="tableTBTrack">
        <a href="<?php echo url('admin/link/edit'); ?>?id={{d.id}}" class="layui-btn ajax-iframe" data-width="80%" data-height="535px">修改</a>
        <a href="<?php echo url('admin/link/del'); ?>?id={{d.id}}" class="layui-btn layui-btn-danger ajax-delete">删除</a>
    </script>
    <!-- 权限列 -->
    <script type="text/html" id="status">
        <input type="checkbox" name="status" lay-skin="switch" lay-filter="*" lay-text="正常|锁定" data-url="<?php echo url('admin/link/edit'); ?>?id={{d.id}}" {{d.status==1?'checked':''}}>
    </script>
    <!-- 权限列 -->
    <script type="text/html" id="sort_order">
        <input type="text" name="sort_order" value="{{d.sort_order}}" autocomplete="off" class="layui-input ajax-update" data-url="<?php echo url('admin/link/edit'); ?>?id={{d.id}}">
    </script>
</div>

    </div>
</div>
<script type="text/javascript" src="/static/hqui/libs/layui/layui.all.js"></script>
<script type="text/javascript" src="/static/js/jquery.min.js"></script>
<script type="text/javascript" src="/static/js/layui.base.js"></script>
<script type="text/javascript" src="/static/hqui/js/common.js?v=316"></script>

<script>
    layui.use(['layer', 'form', 'table', 'util', 'dropdown'], function () {
        var $ = layui.jquery;
        var layer = layui.layer;
        var form = layui.form;
        var table = layui.table;
        var util = layui.util;
        var admin = layui.admin;
        var dropdown = layui.dropdown;

        // 渲染回访表格
        var insTb = table.render({
            elem: '#tableList',
            url: "<?php echo url('admin/link/index_json',['name'=>input('name'),'category'=>input('category')]); ?>",
            page: true,
            cellMinWidth: 100,
            limit:'15',
            limits:['15','30','50','100','200','500'],
            size:'lg',even:true,
            cols: [[
                {type:'numbers',title:'#'},
                {
                    align: 'center', templet: function (d) {
                        var url = d.image;
                        return '<img src="' + url + '" class="tdImg" tb-img/>';
                    }, title: '图片', width: 300, unresize: true
                },
                {field: 'category_name', align: 'left', sort: true, title: '分类',width:180},
                {field: 'name', align: 'left', sort: true, title: '名称'},
                {align: 'center', sort: true, title: '排序',templet:'#sort_order',width:100},
                {align: 'center', sort: true, title: '状态',templet:'#status',width:100},
                {align: 'center', toolbar: '#tableTBTrack', title: '操作', width: 190}
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

    });

</script>

</body>
</html>