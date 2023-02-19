<?php /*a:2:{s:86:"D:\system\phpStudy_64\phpstudy_pro\WWW\liunuo-thinkphp6\view\admin\category\save.phtml";i:1583074303;s:77:"D:\system\phpStudy_64\phpstudy_pro\WWW\liunuo-thinkphp6\view\admin\base.phtml";i:1583074303;}*/ ?>
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
                <label class="layui-form-label">* 所属父级</label>
                <div class="layui-input-block">
                    <select name="pid" lay-filter="pid" lay-search>
                        <option value="0">顶级分类</option>
                        <?php if(is_array($category) || $category instanceof \think\Collection || $category instanceof \think\Paginator): if( count($category)==0 ) : echo "" ;else: foreach($category as $key=>$v): ?>
                        <option value="<?php echo htmlentities($v['id']); ?>" <?php if(isset($data) and $data['pid'] == $v['id']): ?>selected="selected"<?php endif; if(isset($data) and $data['id'] == $v['id']): ?>disabled<?php endif; ?>><?php if($v['level'] != '1'): ?>|<?php for($i=1;$i<$v['level'];$i++){echo ' ----';} ?><?php endif; ?> <?php echo htmlentities($v['name']); ?></option> 
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select> 
                </div>
            </div> 
            <div class="layui-form-item">
                <label class="layui-form-label">* 所属模型</label>
                <div class="layui-input-block">
                    <select name="model" id="model" >
                        <?php if(is_array($models) || $models instanceof \think\Collection || $models instanceof \think\Paginator): if( count($models)==0 ) : echo "" ;else: foreach($models as $key=>$r): ?>
                        <option value="<?php echo htmlentities($r['model']); ?>" <?php if(isset($data) and $data['model'] == $r['model']): ?>selected="selected"<?php endif; ?>><?php echo htmlentities($r['name']); ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">分类名称</label>
                <div class="layui-input-block">
                    <input type="text" name="name" value="<?php echo htmlentities((isset($data['name']) && ($data['name'] !== '')?$data['name']:'')); ?>" autocomplete="off" placeholder="请输入分类名称" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">英文名称</label>
                <div class="layui-input-block">
                    <input type="text" name="name_en" value="<?php echo htmlentities((isset($data['name_en']) && ($data['name_en'] !== '')?$data['name_en']:'')); ?>" autocomplete="off" placeholder="请输入英文名称" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">分类封面</label>
                <div class="layui-input-block">
                    <input type="text" name="image" value="<?php echo htmlentities((isset($data['image']) && ($data['image'] !== '')?$data['image']:'')); ?>" autocomplete="off" placeholder="请上传分类封面" class="layui-input">
                    <button type="button" class="layui-btn layui-btn-primary layui-btn-position ajax-images"><i class="fa fa-file-image-o"></i> 选择图片</button>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">关键字</label>
                <div class="layui-input-block">
                    <input type="text" name="keywords" value="<?php echo htmlentities((isset($data['keywords']) && ($data['keywords'] !== '')?$data['keywords']:'')); ?>" autocomplete="off" placeholder="请输入关键字" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">描述</label>
                <div class="layui-input-block">
                    <textarea name="description" autocomplete="off" placeholder="请输入描述" class="layui-textarea"><?php echo htmlentities((isset($data['description']) && ($data['description'] !== '')?$data['description']:'')); ?></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">分类模板</label>
                <div class="layui-input-block">
                    <select name="list_template">
                        <?php if(is_array($list_template) || $list_template instanceof \think\Collection || $list_template instanceof \think\Paginator): if( count($list_template)==0 ) : echo "" ;else: foreach($list_template as $key=>$r): ?>
                        <option value="<?php echo htmlentities($r); ?>" <?php if(isset($data) and $data['list_template'] == $r): ?>selected="selected"<?php endif; ?>><?php echo htmlentities($r); ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">详情模板</label>
                <div class="layui-input-block">
                    <select name="show_template">
                        <?php if(is_array($show_template) || $show_template instanceof \think\Collection || $show_template instanceof \think\Paginator): if( count($show_template)==0 ) : echo "" ;else: foreach($show_template as $key=>$r): ?>
                        <option value="<?php echo htmlentities($r); ?>" <?php if(isset($data) and $data['show_template'] == $r): ?>selected="selected"<?php endif; ?>><?php echo htmlentities($r); ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
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

<script>
    form.on('select(pid)', function(data){
        var that = $(this);
        var cid = data.value;
        $.ajax({ 
            type: 'POST',
            url: "<?php echo url('admin/category/get_pcategory'); ?>",
            data:{id:cid},
            success:function(ret) {
                console.log(ret.data);
                $('#model').empty();
                $('#model').append("<option value="+ret.data.model+">"+ret.data.name+"</option>");
                form.render('select');
            },
            dataType:'json',
        });
    });
</script>

</body>
</html>