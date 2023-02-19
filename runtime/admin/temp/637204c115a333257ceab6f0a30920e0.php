<?php /*a:2:{s:92:"D:\system\phpStudy_64\phpstudy_pro\WWW\liunuo-thinkphp6\view\admin\user_auth\saveGroup.phtml";i:1583074303;s:77:"D:\system\phpStudy_64\phpstudy_pro\WWW\liunuo-thinkphp6\view\admin\base.phtml";i:1583074303;}*/ ?>
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
    <div class="layui-card-header">编辑数据</div>
    <div class="layui-card-body">
        <form action="<?php echo request()->url(); ?>" class="layui-form" method="post">
            <div class="layui-form-item">
                <label class="layui-form-label">用户组</label>
                <div class="layui-input-block">
                    <input type="text" name="name" value="<?php echo htmlentities((isset($data['name']) && ($data['name'] !== '')?$data['name']:'')); ?>" autocomplete="off" placeholder="请输入用户组" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">描述</label>
                <div class="layui-input-block">
                    <textarea name="description" placeholder="请输入描述" class="layui-textarea"><?php echo htmlentities((isset($data['description']) && ($data['description'] !== '')?$data['description']:'')); ?></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">授权</label>
                <div class="layui-input-block">
                    <input type="hidden" name="rules" value="<?php echo htmlentities((isset($data['rules']) && ($data['rules'] !== '')?$data['rules']:'')); ?>" id="rules">
                    <div  class="ztree" id="userAuthRule"></div>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-filter="*" lay-submit="">保存</button>
                    <button class="layui-btn layui-btn-primary" type="reset">重置</button>
                </div>
            </div>
        </form>
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
    check: {
        enable: true,
        chkboxType: {'Y': 'ps', 'N': 's'},
    },
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
    },
    callback: {
        onCheck: function () {
            var zTree = $.fn.zTree.getZTreeObj('userAuthRule');
            var rules = [];
            $.each(zTree.getCheckedNodes(), function (i, z) {
                rules.push(z.id);
            });
            $('#rules').val(rules.join(','));
        }
    }
}, <?php echo json_encode($userAuthRule); ?>);
</script>

</body>
</html>