<?php /*a:2:{s:86:"D:\system\phpStudy_64\phpstudy_pro\WWW\liunuo-thinkphp6\view\admin\config\upload.phtml";i:1583074303;s:77:"D:\system\phpStudy_64\phpstudy_pro\WWW\liunuo-thinkphp6\view\admin\base.phtml";i:1583074303;}*/ ?>
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
    <div class="layui-card-header">上传设置</div>
    <div class="layui-card-body">
        <form action="<?php echo request()->url(); ?>" class="layui-form" method="post">
            <div class="layui-form-item">
                <label class="layui-form-label">图片压缩</label>
                <div class="layui-input-block">
                    <input type="hidden" name="is_thumb" value="0">
                    <input type="checkbox" name="is_thumb" value="1" lay-skin="switch" lay-text="开启|关闭" <?php if(isset($data['is_thumb']) and $data['is_thumb'] == '1'): ?>checked="checked"<?php endif; ?>>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">最大宽度</label>
                <div class="layui-input-inline">
                    <input type="text" name="max_width" value="<?php echo htmlentities((isset($data['max_width']) && ($data['max_width'] !== '')?$data['max_width']:'')); ?>" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">px</div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">最大高度</label>
                <div class="layui-input-inline">
                    <input type="text" name="max_height" value="<?php echo htmlentities((isset($data['max_height']) && ($data['max_height'] !== '')?$data['max_height']:'')); ?>" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">px</div>
            </div>
            <hr>
            
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

</body>
</html>