<?php /*a:2:{s:88:"D:\system\phpStudy_64\phpstudy_pro\WWW\liunuo-thinkphp6\view\admin\user_auth\group.phtml";i:1583074303;s:77:"D:\system\phpStudy_64\phpstudy_pro\WWW\liunuo-thinkphp6\view\admin\base.phtml";i:1583074303;}*/ ?>
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
		    <a href="<?php echo url('admin/user_auth/addGroup'); ?>" class="layui-btn"><i class="fa fa-plus-circle"></i> 添加用户组</a>
        </div>
		<table class="layui-table layui-form">
			<thead>
				<tr>
					<th>ID</th>
					<th>用户组</th>
					<th>描述</th>
					<th>状态</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "$empty" ;else: foreach($list as $key=>$v): ?>
				<tr>
					<td><?php echo htmlentities($v['id']); ?></td>
					<td><?php echo htmlentities($v['name']); ?></td>
					<td><?php echo htmlentities($v['description']); ?></td>
					<td>
						<input type="checkbox" name="status" lay-skin="switch" lay-filter="*" lay-text="启用|禁用" data-url="<?php echo url('admin/user_auth/editGroup', ['id' => $v['id']]); ?>" <?php if($v['status'] == 1): ?>checked="checked"<?php endif; ?>>
					</td>
					<td>
						<a href="<?php echo url('admin/user_auth/editGroup', ['id' => $v['id']]); ?>" class="layui-btn layui-btn-sm layui-btn-normal"><i class="fa fa-edit"></i> 编辑</a>
						<a href="<?php echo url('admin/user_auth/delGroup', ['id' => $v['id']]); ?>" class="layui-btn layui-btn-sm layui-btn-danger ajax-delete"><i class="fa fa-trash-o"></i> 删除</a>
					</td>
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