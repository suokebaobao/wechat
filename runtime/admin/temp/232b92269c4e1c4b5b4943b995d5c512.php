<?php /*a:2:{s:86:"D:\system\phpStudy_64\phpstudy_pro\WWW\liunuo-thinkphp6\view\admin\auth\saveRule.phtml";i:1583074303;s:79:"D:\system\phpStudy_64\phpstudy_pro\WWW\liunuo-thinkphp6\view\admin\iframe.phtml";i:1583074303;}*/ ?>
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

<form action="<?php echo request()->url(); ?>" class="layui-form layui-form-pane" method="post">
    <div class="layui-form-item">
        <label class="layui-form-label">名称</label>
        <div class="layui-input-block">
            <input type="text" name="name" value="<?php echo htmlentities((isset($data['name']) && ($data['name'] !== '')?$data['name']:'')); ?>" autocomplete="off" placeholder="请输入名称" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">控制器</label>
        <div class="layui-input-block">
            <input type="text" name="url" value="<?php echo htmlentities((isset($data['url']) && ($data['url'] !== '')?$data['url']:'')); ?>" autocomplete="off" placeholder="admin/index/index" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">图标</label>
        <div class="layui-input-block">
            <input type="text" name="icon" value="<?php echo htmlentities((isset($data['icon']) && ($data['icon'] !== '')?$data['icon']:'')); ?>" autocomplete="off" placeholder="fa fa-image" class="layui-input">
            <a href="<?php echo url('admin/index/icon'); ?>" class="layui-btn layui-btn-primary layui-btn-position ajax-icon"><i class="fa fa-plus-circle"></i></a>
        </div>
    </div>
    <div class="layui-form-item" pane>
        <label class="layui-form-label">菜单显示？</label>
        <div class="layui-input-block">
            <input type="radio" name="type" value="nav" title="是" <?php if(empty($data) or isset($data) and $data['type'] == 'nav'): ?>checked="checked"<?php endif; ?>>
            <input type="radio" name="type" value="auth" title="否" <?php if(isset($data) and $data['type'] == 'auth'): ?>checked="checked"<?php endif; ?>>
        </div>
    </div>
    <div class="layui-form-item" pane>
        <label class="layui-form-label">快捷方式？</label>
        <div class="layui-input-block">
            <input type="radio" name="index" value="1" title="是" <?php if(isset($data) and $data['index'] == 1): ?>checked="checked"<?php endif; ?>>
            <input type="radio" name="index" value="0" title="否" <?php if(empty($data) or isset($data) and $data['index'] == 0): ?>checked="checked"<?php endif; ?>>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">排序</label>
        <div class="layui-input-block">
            <input type="text" name="sort_order" value="<?php echo htmlentities((isset($data['sort_order']) && ($data['sort_order'] !== '')?$data['sort_order']:'0')); ?>" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <input type="hidden" name="id" value="<?php echo htmlentities((isset($data['id']) && ($data['id'] !== '')?$data['id']:'')); ?>">
            <input type="hidden" name="pid" value="<?php echo htmlentities((isset($data['pid']) && ($data['pid'] !== '')?$data['pid']:app('request')->param('id'))); ?>">
            <button class="layui-btn" lay-filter="i" lay-submit="">保存</button>
            <button class="layui-btn layui-btn-primary" type="reset">重置</button>
        </div>
    </div>
</form>

<script type="text/javascript" src="/static/hqui/libs/layui/layui.all.js"></script>
<script type="text/javascript" src="/static/js/jquery.min.js"></script>
<script type="text/javascript" src="/static/js/layui.base.js"></script>
<script type="text/javascript" src="/static/hqui/js/common.js?v=316"></script>

</body>
</html>