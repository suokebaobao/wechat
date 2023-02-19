<?php /*a:2:{s:52:"/etc/nginx/html/wechat/view/admin/wechat/index.phtml";i:1676799584;s:44:"/etc/nginx/html/wechat/view/admin/base.phtml";i:1676799584;}*/ ?>
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
            <a href="<?php echo url('admin/wechat/get_user'); ?>" class="layui-btn layui-btn-warm ajax-action"><i class="fa fa-star"></i> 更新会员</a>
        </div>
		<table class="layui-table layui-form">
			<thead>
				<tr>
					<th>ID</th>
                                        <th>头像</th>
					<th>昵称</th>
					<th>性别</th>
					<th>区域</th>
					<th>关注时间</th>
					<th>创建时间</th>
					<th>绑定情况</th>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "$empty" ;else: foreach($list as $key=>$v): ?>
				<tr>
					<td><?php echo htmlentities($v['id']); ?></td>
                                        <td><img src="<?php echo htmlentities($v['avatarurl']); ?>" width="60" height="60"></td>
					<td><?php echo htmlentities($v['nickname']); ?></td>
					<td><?php echo htmlentities($v['gender']); ?></td>
					<td><?php echo htmlentities($v['country']); ?>/<?php echo htmlentities($v['province']); ?>/<?php echo htmlentities($v['city']); ?></td>
					<td><?php echo htmlentities($v['subscribe_time']); ?></td>
					<td><?php echo htmlentities($v['create_time']); ?></td>
                                        <td>暂无</td>
				</tr>
				<?php endforeach; endif; else: echo "$empty" ;endif; ?>
			</tbody>
		</table>
		<div class="page"><?php echo $list; ?></div>
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