<?php /*a:2:{s:82:"D:\system\phpStudy_64\phpstudy_pro\WWW\liunuo-thinkphp6\view\admin\admin\log.phtml";i:1583074303;s:77:"D:\system\phpStudy_64\phpstudy_pro\WWW\liunuo-thinkphp6\view\admin\base.phtml";i:1583074303;}*/ ?>
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
            <a href="<?php echo url('admin/admin/truncate'); ?>" class="layui-btn layui-btn-danger ajax-delete"><i class="fa fa-trash-o"></i> 一键清空</a>
        </div>
    </div>
    
    <table id="tableList" lay-filter="tableList"></table>

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
            url: "<?php echo url('admin/admin/log_json'); ?>",
            page: true,
            cellMinWidth: 100,
            limit:'15',
            limits:['15','30','50','100','200','500'],
            size:'lg',even:true,
            cols: [[
                {type:'numbers',title:'#'},
                {field: 'username', align: 'left', sort: true, title: '管理员'},
                {field: 'ip', align: 'left', sort: true, title: 'IP地址'},
                {field: 'url', align: 'left', sort: true, title: '请求链接'},
                {field: 'method', align: 'left', sort: true, title: '请求类型'},
                {field: 'type', align: 'left', sort: true, title: '资源类型'},
                {field: 'create_time', align: 'left', sort: true, title: '操作时间'},
                {field: 'remark', align: 'left', sort: true, title: '操作行为',minWidth:450}
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