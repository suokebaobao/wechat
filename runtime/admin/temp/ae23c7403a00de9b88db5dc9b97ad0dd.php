<?php /*a:2:{s:54:"/etc/nginx/html/wechat/view/admin/config/setting.phtml";i:1676799584;s:44:"/etc/nginx/html/wechat/view/admin/base.phtml";i:1676799584;}*/ ?>
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
    <div class="layui-card-header">网站设置</div>
    <div class="layui-card-body" pad15>
        <div class="layui-form" wid100 lay-filter="">
        <form action="<?php echo url('admin/config/setting'); ?>" class="layui-form" method="post">
            <div class="layui-form-item">
                <label class="layui-form-label">网站LOGO</label>
                <div class="layui-input-block">
                    <div class="layui-upload-list">
                        <img class="layui-upload-img" id="test-upload-normal-img" src="<?php echo htmlentities((isset($list['logo']) && ($list['logo'] !== '')?$list['logo']:'')); ?>" width="110" height="110">
                    </div>
                    <input type="hidden" name="logo" value="<?php echo htmlentities((isset($list['logo']) && ($list['logo'] !== '')?$list['logo']:'')); ?>" autocomplete="off" placeholder="" class="layui-input">
                    <button type="button" class="layui-btn ajax-avatar"><i class="fa fa-file-image-o"></i> 选择图片</button>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">网站名称</label>
                <div class="layui-input-block">
                    <input type="text" name="sitename" value="<?php echo htmlentities($list['sitename']); ?>"  class="layui-input">
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">首页标题</label>
                <div class="layui-input-block">
                    <textarea name="title" class="layui-textarea"><?php echo htmlentities($list['title']); ?></textarea>
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">META关键词</label>
                <div class="layui-input-block">
                    <textarea name="keywords" class="layui-textarea" placeholder="多个关键词用英文状态 , 号分割"><?php echo htmlentities($list['keywords']); ?></textarea>
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">META描述</label>
                <div class="layui-input-block">
                    <textarea name="description" class="layui-textarea"><?php echo htmlentities($list['description']); ?></textarea>
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">版权信息</label>
                <div class="layui-input-block">
                    <textarea name="copyright" class="layui-textarea"><?php echo htmlentities($list['copyright']); ?></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">备案信息</label>
                <div class="layui-input-inline" style="width: 400px;">
                    <input type="text" name="beian" value="<?php echo htmlentities($list['beian']); ?>" class="layui-input">
                </div>
                <div class="layui-input-inline layui-input-company">工信部备案信息</div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit  lay-filter="*">确认保存</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>

    </div>
</div>
<script type="text/javascript" src="/static/hqui/libs/layui/layui.all.js"></script>
<script type="text/javascript" src="/static/js/jquery.min.js"></script>
<script type="text/javascript" src="/static/js/layui.base.js"></script>
<script type="text/javascript" src="/static/hqui/js/common.js?v=316"></script>

</body>
</html>