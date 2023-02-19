<?php /*a:2:{s:80:"D:\system\phpStudy_64\phpstudy_pro\WWW\liunuo-thinkphp6\view\admin\ad\save.phtml";i:1583074303;s:77:"D:\system\phpStudy_64\phpstudy_pro\WWW\liunuo-thinkphp6\view\admin\base.phtml";i:1583074303;}*/ ?>
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
        <form action="<?php echo request()->url(); ?>" class="layui-form" method="post">
            <div class="layui-form-item">
                <label class="layui-form-label">* 广告图片</label>
                <div class="layui-input-block">
                    <input type="text" name="image" value="<?php echo htmlentities((isset($data['image']) && ($data['image'] !== '')?$data['image']:'')); ?>" autocomplete="off" placeholder="请上传图片" class="layui-input">
                    <button type="button" class="layui-btn layui-btn-primary layui-btn-position ajax-images"><i class="fa fa-file-image-o"></i> 选择图片</button>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">* 所属分类</label>
                <div class="layui-input-block">
                    <select name="category">
                        <option value="">请选择所属分类</option>
                        <?php if(is_array($category) || $category instanceof \think\Collection || $category instanceof \think\Paginator): if( count($category)==0 ) : echo "" ;else: foreach($category as $k=>$v): ?>
                        <option value="<?php echo htmlentities($v['id']); ?>" <?php if(isset($data) and $data['category'] == $v['id']): ?>selected="selected"<?php endif; ?>><?php echo htmlentities($v['name']); ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">* 广告名称</label>
                <div class="layui-input-block">
                    <input type="text" name="name" value="<?php echo htmlentities((isset($data['name']) && ($data['name'] !== '')?$data['name']:'')); ?>" autocomplete="off" placeholder="请输入名称" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">广告描述</label>
                <div class="layui-input-block">
                    <textarea name="description" autocomplete="off" placeholder="请输入描述" class="layui-textarea"><?php echo htmlentities((isset($data['description']) && ($data['description'] !== '')?$data['description']:'')); ?></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">广告链接</label>
                <div class="layui-input-block">
                    <input type="text" name="url" value="<?php echo htmlentities((isset($data['url']) && ($data['url'] !== '')?$data['url']:'')); ?>" autocomplete="off" placeholder="http://" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">打开方式</label>
                <div class="layui-input-block">
                    <input type="radio" name="target" value="_self" title="默认" checked="checked">
                    <input type="radio" name="target" value="_blank" title="新窗口" <?php if(isset($data) and $data['target'] == '_blank'): ?>checked="checked"<?php endif; ?>>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-filter="i" lay-submit="">保存</button>
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