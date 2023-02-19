<?php /*a:2:{s:81:"D:\system\phpStudy_64\phpstudy_pro\WWW\liunuo-thinkphp6\view\admin\user\log.phtml";i:1583074303;s:77:"D:\system\phpStudy_64\phpstudy_pro\WWW\liunuo-thinkphp6\view\admin\base.phtml";i:1583074303;}*/ ?>
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
        <div class="layui-btn-group">
            <a href="<?php echo url('admin/user/truncate'); ?>" class="layui-btn layui-btn-danger ajax-delete"><i class="fa fa-trash-o"></i> 一键清空</a>
        </div>
        <table class="layui-table layui-form">
            <thead>
                <tr>
                    <th>商户</th>
                    <th>客户端</th>
                    <th>会员</th>
                    <th>IP地址</th>
                    <th>请求链接</th>
                    <th>请求类型</th>
                    <th>资源类型</th>
                    <th>操作行为</th>
                    <th>操作时间</th>
                </tr>
            </thead>
            <tbody>
                <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "$empty" ;else: foreach($list as $key=>$v): ?>
                <tr>
                    <td><?php echo model('shop')->get($v['sid'])['name']; ?></td>
                    <td><?php if($v['is_m']=='0'): ?>PC<?php else: ?>移动端<?php endif; ?></td>
                    <td><?php echo htmlentities($v['username']); ?></td>
                    <td><?php echo htmlentities($v['ip']); ?></td>
                    <td><?php echo htmlentities($v['url']); ?></td>
                    <td><?php echo htmlentities($v['method']); ?></td>
                    <td><?php echo htmlentities($v['type']); ?></td>
                    <td><?php echo htmlentities($v['remark']); ?></td>
                    <td><?php echo htmlentities($v['create_time']); ?></td>
                </tr>
                <?php endforeach; endif; else: echo "$empty" ;endif; ?>
            </tbody>
        </table>
        <div class="page"><?php echo htmlentities($list->render()); ?></div>
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