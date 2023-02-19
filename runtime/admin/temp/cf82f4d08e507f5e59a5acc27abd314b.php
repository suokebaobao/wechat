<?php /*a:2:{s:91:"D:\system\phpStudy_64\phpstudy_pro\WWW\liunuo-thinkphp6\view\admin\config\param_qiniu.phtml";i:1583074303;s:77:"D:\system\phpStudy_64\phpstudy_pro\WWW\liunuo-thinkphp6\view\admin\base.phtml";i:1583074303;}*/ ?>
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
    <div class="layui-card-header">参数配置</div>
    <div class="layui-card-body" pad15>
        <div class="layui-tab">
            <ul class="layui-tab-title">
                <li class="layui-this"><a href="<?php echo url('admin/config/param',['model'=>'qiniu']); ?>">七牛配置</a></li>
                <li><a href="<?php echo url('admin/config/param',['model'=>'weixin']); ?>">公众号配置</a></li>
                <li><a href="<?php echo url('admin/config/param',['model'=>'wxapp']); ?>">微信小程序</a></li>
                <li><a href="<?php echo url('admin/config/param',['model'=>'wxpay']); ?>">微信支付</a></li>
                <li><a href="<?php echo url('admin/config/param',['model'=>'qcloudsms']); ?>">腾讯短信</a></li>
                <li><a href="<?php echo url('admin/config/param',['model'=>'baiduapp']); ?>">百度小程序</a></li>
            </ul>
            <div class="layui-tab-content">
                <div class="layui-tab-item layui-show">
                    <form action="<?php echo url('admin/config/param',['model'=>'qiniu']); ?>" class="layui-form" method="post">
                    <div class="layui-form-item">
                        <label class="layui-form-label">AccessKey</label>
                        <div class="layui-input-inline" style="width: 400px;">
                            <input type="checkbox" name="type" lay-skin="switch" lay-text="七牛|本地" <?php if($list['type']=='1'): ?> checked<?php endif; ?>>
                        </div>
                        <div class="layui-input-inline layui-input-company"></div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">AccessKey</label>
                        <div class="layui-input-inline" style="width: 400px;">
                            <input type="text" name="ak" value="<?php echo htmlentities($list['ak']); ?>" class="layui-input">
                        </div>
                        <div class="layui-input-inline layui-input-company"></div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">SecretKey</label>
                        <div class="layui-input-inline" style="width: 400px;">
                            <input type="text" name="sk" value="<?php echo htmlentities($list['sk']); ?>" class="layui-input">
                        </div>
                        <div class="layui-input-inline layui-input-company"></div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">空间bucket</label>
                        <div class="layui-input-inline" style="width: 400px;">
                            <input type="text" name="bucket" value="<?php echo htmlentities($list['bucket']); ?>" class="layui-input">
                        </div>
                        <div class="layui-input-inline layui-input-company"></div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">空间域名</label>
                        <div class="layui-input-inline" style="width: 400px;">
                            <input type="text" name="domain" value="<?php echo htmlentities($list['domain']); ?>" class="layui-input">
                        </div>
                        <div class="layui-input-inline layui-input-company"></div>
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
        <div class="layui-form" wid100 lay-filter="">
        
            
            
            
            
        
        </div>
    </div>
</div>

    </div>
</div>
<script type="text/javascript" src="/static/hqui/libs/layui/layui.all.js"></script>
<script type="text/javascript" src="/static/js/jquery.min.js"></script>
<script type="text/javascript" src="/static/js/layui.base.js"></script>
<script type="text/javascript" src="/static/hqui/js/common.js?v=316"></script>

<script src="https://cdn.bootcss.com/jquery/2.2.3/jquery.min.js"></script>
<script>
    element.on('tab(demo)', function(data){
            var that = $(this);
            var model = data.value;
            console.log(data);
            $.ajax({ 
                type: 'POST',
                url: "/user/charge/get_course_data/",
                data:{course_id:course_id},
                success:function(ret) {    
                    //console.log(ret);
                    that.closest("tr").find("select[name='course_data_id[]']").empty();
                    that.closest("tr").find("select[name='course_data_id[]']").append("<option value=''>请选择专业</option>");
                    $.each(ret, function(i,item){
                        //console.log(item.level);
                        that.closest("tr").find("select[name='course_data_id[]']").append("<option value="+item.id+">"+item.level+"</option>");
                    });
                    form.render('select');
                },
                dataType:'json',
            });
        });
</script>

</body>
</html>