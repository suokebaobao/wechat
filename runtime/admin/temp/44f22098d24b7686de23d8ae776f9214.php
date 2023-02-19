<?php /*a:2:{s:86:"D:\system\phpStudy_64\phpstudy_pro\WWW\liunuo-thinkphp6\view\admin\uploads\index.phtml";i:1583074303;s:77:"D:\system\phpStudy_64\phpstudy_pro\WWW\liunuo-thinkphp6\view\admin\base.phtml";i:1583074303;}*/ ?>
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
        width: 200px;
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
        <table id="tableTrack" lay-filter="tableTrack"></table>
        <!-- 表格操作列 -->
        <script type="text/html" id="tableTBTrack">
            <a href="<?php echo url('admin/uploads/del'); ?>?id={{d.id}}" class="layui-btn layui-btn-danger layui-btn-sm ajax-delete">删除</a>
        </script>
        <!-- 权限列 -->
        <script type="text/html" id="status">
            {{# if(d.status == '0'){ }}
            <a class="layui-btn layui-btn-primary layui-btn-sm">失效</a>
            {{# }else if(d.status == '1'){ }}
            <a class="layui-btn layui-btn-sm">正常</a>
            {{# } }}
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
            elem: '#tableTrack',
            url: "<?php echo url('admin/uploads/index_json'); ?>",
            page: true,
            cols: [[
                {type:'numbers',title:'#'},
                {
                    align: 'center', templet: function (d) {
                        var url = d.file_url + '/' + d.file_name;
                        return '<img src="' + url + '" class="tdImg" tb-img/>';
                    }, title: '图片', width: 300, unresize: true
                },
                {field: 'shop_id', sort: true, templet: '#tableAdminid', title: '商家'},
                {field: 'user_id', align: 'center', sort: true, title: '用户'},
                {field: 'storage', align: 'center', sort: true, title: '储存位置'},
                {field: 'file_size', align: 'center', sort: true, title: '文件大小'},
                {field: 'status', sort: true, templet: '#status', title: '状态'},
                {align: 'center', toolbar: '#tableTBTrack', title: '操作', minWidth: 200}
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
        
        // 点击图片放大
        $(document).off('click.tbImg').on('click.tbImg', '[tb-img]', function () {
            layer.photos({photos: {data: [{src: $(this).attr('src')}]}, shade: .1, closeBtn: true});
        });
        
    });
</script>

</body>
</html>