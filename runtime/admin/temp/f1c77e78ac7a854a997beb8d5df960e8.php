<?php /*a:2:{s:81:"D:\system\phpStudy_64\phpstudy_pro\WWW\liunuo-thinkphp6\view\admin\shop\add.phtml";i:1583074303;s:77:"D:\system\phpStudy_64\phpstudy_pro\WWW\liunuo-thinkphp6\view\admin\base.phtml";i:1583074303;}*/ ?>
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
                <label class="layui-form-label">过期时间</label>
                <div class="layui-input-block">
                    <input type="text" name="exp_time" value="<?php echo htmlentities((isset($data['exp_time']) && ($data['exp_time'] !== '')?$data['exp_time']:'')); ?>" id="exptime" autocomplete="off"  class="layui-input">
                </div>
            </div>
            <hr>
            <div class="layui-form-item">
                <label class="layui-form-label">商家名称</label>
                <div class="layui-input-block">
                    <input type="text" name="name" value="<?php echo htmlentities((isset($data['name']) && ($data['name'] !== '')?$data['name']:'')); ?>" autocomplete="off" placeholder="请输入商户名称" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">联系人</label>
                <div class="layui-input-block">
                    <input type="text" name="contact" value="<?php echo htmlentities((isset($data['contact']) && ($data['contact'] !== '')?$data['contact']:'')); ?>" autocomplete="off" placeholder="请输入联系人" class="layui-input">
                </div>
            </div>
            <hr>
            <div class="layui-form-item">
                <label class="layui-form-label">手机号</label>
                <div class="layui-input-block">
                    <input type="text" name="mobile" value="<?php echo htmlentities((isset($data['mobile']) && ($data['mobile'] !== '')?$data['mobile']:'')); ?>" autocomplete="off" placeholder="请输入手机号" lay-verify="phone|number" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">登陆密码</label>
                <div class="layui-input-block">
                    <input type="password" name="password" value="" autocomplete="off" placeholder="请输入密码" class="layui-input">
                </div>
            </div>
            
            

            
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <input type="hidden" name="id" value="<?php echo htmlentities((isset($data['id']) && ($data['id'] !== '')?$data['id']:'')); ?>" autocomplete="off" placeholder="" class="layui-input">
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

<script type="text/javascript">
    <?php $today = date('Y-m-d',time());?>
    laydate.render({
        elem: '#exptime'
        ,min: '<?php echo htmlentities($today); ?>'
        ,max: '2080-10-14'
    });
    
</script>
<script type="text/javascript" src="/static/city-picker/assets/data.js"></script>
<script type="text/javascript">
    var defaults = {
        s1: 'province',
        s2: 'city',
        s3: 'area',
        v1: '福建省',
        v2: '福州',
        v3: '台江区'
    };

</script>
<script type="text/javascript" src="/static/city-picker/assets/province.js"></script>

</body>
</html>