<?php /*a:2:{s:87:"D:\system\phpStudy_64\phpstudy_pro\WWW\liunuo-thinkphp6\view\admin\user_auth\rule.phtml";i:1583074303;s:77:"D:\system\phpStudy_64\phpstudy_pro\WWW\liunuo-thinkphp6\view\admin\base.phtml";i:1583074303;}*/ ?>
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
  
<link rel="stylesheet" href="/static/libs/ztree/css/zTreeStyle/zTreeStyle.css">

</head>
<body>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        
<div class="layui-card">
    <div class="layui-card-body">
        <div class="layui-btn-group">
            <a href="javascript:;" class="layui-btn" id="addRule"><i class="fa fa-plus-circle"></i> 添加规则</a>
            <a href="javascript:;" class="layui-btn layui-btn-normal" id="editRule"><i class="fa fa-edit"></i> 编辑规则</a>
            <a href="javascript:;" class="layui-btn layui-btn-danger" id="delRule"><i class="fa fa-trash-o"></i> 删除规则</a>
        </div>
        <div class="ztree" id="userAuthRule"></div>
    </div>
</div>

    </div>
</div>
<script type="text/javascript" src="/static/hqui/libs/layui/layui.all.js"></script>
<script type="text/javascript" src="/static/js/jquery.min.js"></script>
<script type="text/javascript" src="/static/js/layui.base.js"></script>
<script type="text/javascript" src="/static/hqui/js/common.js?v=316"></script>

<script src="/static/libs/ztree/js/jquery.ztree.all.min.js"></script>
<script>
$.fn.zTree.init($("#userAuthRule"), {
    view: {
        dblClickExpand: false,
        showLine: true,
        showIcon: false,
        selectedMulti: false
    },
    edit: {
        enable: true,
        editNameSelectAll: true,
        showRemoveBtn: false,
        showRenameBtn: false
    },
    data: {
        simpleData: {
            enable: true
        }
    }
}, <?php echo json_encode($userAuthRule); ?>);

$('#addRule').on('click', function(){
    var zTree = $.fn.zTree.getZTreeObj('userAuthRule'),
        nodes = zTree.getSelectedNodes(),
        treeNode = nodes[0];
    var id = treeNode == undefined ? 0 : treeNode.id;
    var index = layer.open({
        title: '添加规则',
        type: 2,
        area: ['430px', '430px'],
        content: '<?php echo url("admin/user_auth/addRule"); ?>?id=' + id,
    });
});

$('#editRule').on('click', function(){
    var zTree = $.fn.zTree.getZTreeObj('userAuthRule'),
        nodes = zTree.getSelectedNodes(),
        treeNode = nodes[0];
    if (nodes.length == 0) {
        layer.msg('请先选择一个节点');
        return false;
    } else {
        var id = treeNode.id;
        var index = layer.open({
            title: '修改规则',
            type: 2,
            area: ['430px', '430px'],
            content: '<?php echo url("admin/user_auth/editRule"); ?>?id=' + id
        });
    }
});

$('#delRule').on('click', function(){
    layer.confirm('确定删除？', {
        icon: 3,
        title: '提示'
    }, function(index) {
        var zTree = $.fn.zTree.getZTreeObj('userAuthRule'),
            nodes = zTree.getSelectedNodes(),
            treeNode = nodes[0];
        if (nodes.length == 0) {
            layer.msg('请先选择一个节点');
            return false;
        } else {
            var id = treeNode.id;
            var index = layer.msg('删除中，请稍候', {
                icon: 16,
                time: false,
                shade: 0.3
            });
            $.ajax({
                url: '<?php echo url("admin/user_auth/delRule"); ?>?id=' + id,
                type: 'post',
                dataType: 'json',
                success: function(result) {
                    if (result.code === 1 && result.url != '') {
                        setTimeout(function() {
                            location.href = result.url;
                        }, 1000);
                    }
                    layer.close(index);
                    layer.msg(result.msg);
                },
                error: function (xhr, state, errorThrown) {
                    layer.close(index);
                    layer.msg(state + '：' + errorThrown);
                }
            });
        }
    });
    return false;
});
</script>

</body>
</html>