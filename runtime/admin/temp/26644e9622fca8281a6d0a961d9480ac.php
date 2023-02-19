<?php /*a:2:{s:83:"D:\system\phpStudy_64\phpstudy_pro\WWW\liunuo-thinkphp6\view\admin\shop\index.phtml";i:1583074303;s:77:"D:\system\phpStudy_64\phpstudy_pro\WWW\liunuo-thinkphp6\view\admin\base.phtml";i:1583074303;}*/ ?>
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
            <a href="<?php echo url('admin/shop/add'); ?>" data-width="500px" data-height="475px" class="layui-btn ajax-iframe"><i class="fa fa-plus-circle"></i> 添加</a>
        </div>
		<table class="layui-table layui-form">
			<thead>
				<tr>
                                    <th>ID</th>
                                    <th>名称</th>
                                    <th>联系人</th>
                                    <th>电话</th>
                                    <th>创建时间</th>
                                    <th>过期时间</th>
                                    <th>操作</th>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "$empty" ;else: foreach($list as $key=>$v): ?>
				<tr>
                                        <td><?php echo htmlentities($v['id']); ?></td>
					<td><?php echo htmlentities($v['name']); ?></td>
					<td><?php echo htmlentities($v['contact']); ?></td>
					<td><?php echo htmlentities($v['mobile']); ?></td>
					<td><?php echo htmlentities($v['create_time']); ?></td>
                                        <td><?php echo htmlentities($v['exp_time']); ?></td>
					<td>
                                            <a href="<?php echo url('admin/user/index', ['shop_id' => $v['id']]); ?>" data-width="80%" data-height="80%" class="layui-btn layui-btn-xs layui-btn-normal ajax-iframe"><i class="fa fa-user"></i> 用户管理</a>
                                            <a href="<?php echo url('admin/user_auth/addgroup', ['shop_id' => $v['id']]); ?>" data-width="80%" data-height="80%" class="layui-btn layui-btn-xs layui-btn-normal ajax-iframe"><i class="fa fa-user"></i> 新增角色</a>
                                            <a href="<?php echo url('admin/shop/edit', ['id' => $v['id']]); ?>" data-width="500px" data-height="380px" class="layui-btn layui-btn-xs layui-btn-normal ajax-iframe"><i class="fa fa-edit"></i> 编辑</a>
                                            <a href="<?php echo url('admin/shop/del', ['id' => $v['id']]); ?>" class="layui-btn layui-btn-xs layui-btn-danger ajax-delete"><i class="fa fa-trash-o"></i> 删除</a>
					</td>
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