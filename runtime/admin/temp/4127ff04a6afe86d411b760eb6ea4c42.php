<?php /*a:2:{s:87:"D:\system\phpStudy_64\phpstudy_pro\WWW\liunuo-thinkphp6\view\admin\category\index.phtml";i:1583074303;s:77:"D:\system\phpStudy_64\phpstudy_pro\WWW\liunuo-thinkphp6\view\admin\base.phtml";i:1583074303;}*/ ?>
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
  
</head>
<body>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        
<div class="layui-card">
    <div class="layui-card-header">
        <div class="layui-btn-group">
            <a href="<?php echo url('admin/category/add'); ?>" class="layui-btn ajax-iframe" data-width="750px" data-height="690px"><i class="fa fa-plus-circle"></i> 添加分类</a>
        </div>
    </div>
    
    <table id="tableList" lay-filter="tableList"></table>
    <!-- 表格操作列 -->
    <script type="text/html" id="tableTBTrack">
        <a href="<?php echo url('admin/category/edit'); ?>?id={{d.id}}" class="layui-btn layui-btn-normal ajax-iframe" data-width="750px" data-height="690px">编辑</a>
        <a href="<?php echo url('admin/category/del'); ?>?id={{d.id}}" class="layui-btn layui-btn-danger ajax-delete">删除</a>
    </script>
    <!-- 权限列 -->
    <script type="text/html" id="categoryname">
        {{# if(d.level == '1'){ }}
        <i class="fa fa-caret-square-o-right" aria-hidden="true"></i>
        {{# }else if(d.level == '2'){ }}
        &nbsp;&nbsp;&nbsp;<i class="fa fa-caret-square-o-down" aria-hidden="true"></i>
        {{# }else if(d.level == '3'){ }}
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-square-o-down" aria-hidden="true"></i>
        {{# } }}
        <b>{{d.name}}</b>
    </script>
    <!-- 权限列 -->
    <script type="text/html" id="sort">
        <input type="text" name="sort_order" value="{{d.sort_order}}" autocomplete="off" class="layui-input ajax-update" data-url="<?php echo url('admin/category/edit'); ?>?id={{d.id}}">
    </script>
    <!-- 权限列 -->
    <script type="text/html" id="link">
        <a href="{{d.url}}" class="layui-btn layui-btn-xs" target="_blank"> 打开连接</a>
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
            url: "<?php echo url('admin/category/index_json'); ?>",
            page: false,
            cellMinWidth: 100,
            size:'lg',even:true,
            cols: [[
                {type:'numbers',title:'#'},
                {align: 'left', sort: true, title: '分类名称',templet:'#categoryname'},
                {field: 'model_name', align: 'left', sort: true, title: '模型'},
                {field: 'list_template', align: 'center', sort: true, title: '列表模板'},
                {field: 'show_template', align: 'center', sort: true, title: '详情模板'},
                {align: 'center', sort: true, title: '页面',templet:'#link'},
                {align: 'center', sort: true, title: '排序',templet:'#sort',width:150},
                {align: 'center', toolbar: '#tableTBTrack', title: '操作', minWidth: 200}
            ]],
            parseData: function(res){ //res 即为原始返回的数据
                return {
                  "code": res.code, //解析接口状态
                  "msg": res.msg, //解析提示文本
                  "count": res.data, //解析数据长度
                  "data": res.data //解析数据列表
                };
            }
        });

    });

</script>

</body>
</html>