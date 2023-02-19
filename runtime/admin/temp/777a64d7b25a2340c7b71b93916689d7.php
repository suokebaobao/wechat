<?php /*a:1:{s:84:"D:\system\phpStudy_64\phpstudy_pro\WWW\liunuo-thinkphp6\view\admin\index\login.phtml";i:1583074303;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<title>登陆-HQadmin后台管理系统</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/static/hqui/libs/layui/css/layui.css">
<link href="/static/admin/login/css/style.css" rel='stylesheet' type='text/css' />
</head>
<body>
<div class="main">
    <div class="login">
        <h1>HQadmin后台管理系统</h1>
        <div class="inset">
            <!--start-main-->
            <form class="layui-form" id="loginForm" action="<?php echo url('admin/index/login'); ?>" method="post">
                <div>
                    <h2>账户登录</h2>
                    <span><label>用户名</label></span>
                    <span><input type="text" name="username" id="username" lay-verify="required" autocomplete="off" class="layui-input"></span>
                 </div>
                 <div>
                    <span><label>密码</label></span>
                    <span><input type="password" name="password" id="password" lay-verify="required" autocomplete="off" class="layui-input"></span>
                 </div>
                <div>
                    <span><input type="checkbox" name="remember_user" id="remember_user" checked title="记住密码"  lay-skin="primary"></span>
                </div>
                <div class="sign">
                    <button class="layui-btn layui-btn-fluid" lay-submit lay-filter="login">登录</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="copy-right">
    <p>&copy; 2016-2020 <a href="http://www.ennn.cn/">www.ennn.cn</a> All Rights Reserved</p>

</div>

<script src="/static/user/login/js/jquery.js"></script>
<script src="/static/js/jquery.cookie.js"></script>
<script src="/static/user/login/js/agree.js"></script>
<script src="/static/hqui/libs/layui/layui.js"></script>
<script>
    layui.use(['layer', 'form', 'jquery'], function(){
        var layer = layui.layer,
            form  = layui.form,
            $     = layui.jquery;
            
        form.on('submit(login)', function(data) {
            var index = layer.msg('登录中，请稍候', {
                icon: 16,
                time: false,
                shade: 0.3
            });
            if ($("#remember_user").prop("checked") == true) {
                    var user_name = $("#username").val();
                    var user_password = $("#password").val();
                    $.cookie("remember_user", "true", {
                            expires: 7
                    }); // 存储一个带7天期限的 cookie
                    $.cookie("user_name", user_name, {
                            expires: 7
                    }); // 存储一个带7天期限的 cookie
                    $.cookie("user_password", user_password, {
                            expires: 7
                    }); // 存储一个带7天期限的 cookie
            } else {
                    $.cookie("remember_user", "false", {
                            expires: -1
                    }); // 删除 cookie
                    $.cookie("user_name", '', {
                            expires: -1
                    });
                    $.cookie("user_password", '', {
                            expires: -1
                    });
            }
            $.ajax({
                url: data.form.action,
                type: data.form.method,
                dataType: 'json',
                data: $(data.form).serialize(),
                success: function(result) {
                    if (result.code === 1) {
                        location.href = result.url;
                    } else {
                        $('.captcha img').attr('src', '<?php echo url("user/index/captcha"); ?>?rand='+Math.random());
                        layer.close(index);
                        layer.msg(result.msg);
                    }
                },
                error: function (xhr, state, errorThrown) {
                    layer.close(index);
                    layer.msg(state + '：' + errorThrown);
                }
            });
            
            return false;
        });
        //
        
    });
  
</script>
<script>
    $(function() {
	if ($.cookie("remember_user")) {
		$("#remember_user").prop("checked", true);
		$("#username").val($.cookie("user_name"));
		$("#password").val($.cookie("user_password"));
                // 输入框内容变化按钮颜色发生变化
                $(".form-data input").siblings("label").hide();
                $(".log-btn").removeClass("off")
	}
});

function saveUserInfo() {
	
}
</script>
</body>
</html>