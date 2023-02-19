<?php /*a:2:{s:88:"D:\system\phpStudy_64\phpstudy_pro\WWW\liunuo-thinkphp6\view\admin\category\models.phtml";i:1583074303;s:77:"D:\system\phpStudy_64\phpstudy_pro\WWW\liunuo-thinkphp6\view\admin\base.phtml";i:1583074303;}*/ ?>
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
    <div class="layui-card-body">
        <div class="layui-btn-group">
		    <a href="<?php echo url('admin/category/models_add'); ?>" class="layui-btn ajax-iframe" data-width="400px" data-height="300px"><i class="fa fa-plus-circle"></i> 添加</a>
        </div>
    </div>
    <table id="tableList" lay-filter="tableList"></table>
    <!-- 表格操作列 -->
    <script type="text/html" id="tableTBTrack">
        <a href="<?php echo url('admin/category/models_field'); ?>?model={{d.model}}" class="layui-btn ajax-iframe" data-width="1000px" data-height="640px">字段列表</a>
        <a href="<?php echo url('admin/category/models_edit'); ?>?id={{d.id}}" class="layui-btn ajax-iframe" data-width="400px" data-height="300px">修改</a>
        <a href="<?php echo url('admin/category/models_del'); ?>?id={{d.id}}" class="layui-btn layui-btn-danger ajax-delete">删除</a>
    </script>
    <!-- 表格操作列 -->
    <script type="text/html" id="field">
        {{# var i;for(i=0;i< d.field_list.length;i++){ }}
        <a href="<?php echo url('admin/category/models_field_edit'); ?>?id={{d.field_list[i].id}}" class="layui-btn layui-btn-normal ajax-iframe layui-btn-sm" data-width="630px" data-height="480px">{{d.field_list[i].title}}</a>
        {{# } }}
    </script>
    <!-- 权限列 -->
    <script type="text/html" id="status">
        <input type="checkbox" name="status" lay-skin="switch" lay-filter="*" lay-text="启用|禁用" data-url="<?php echo url('admin/article/edit'); ?>?id={{d.id}}" {{d.status==1?'checked':''}}>
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
            url: "<?php echo url('admin/category/models_json'); ?>",
            page: false,
            cellMinWidth: 100,
            size:'lg',even:true,
            cols: [[
                {type:'numbers',title:'#'},
                {field: 'name', align: 'left', sort: true, title: '模型名称'},
                {field: 'model', align: 'left', sort: true, title: '模型'},
                {align: 'left', sort: true, title: '字段列表',templet:'#field',minWidth:450},
                {align: 'center', sort: true, title: '状态',templet:'#status'},
                {align: 'center', toolbar: '#tableTBTrack', title: '操作'}
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