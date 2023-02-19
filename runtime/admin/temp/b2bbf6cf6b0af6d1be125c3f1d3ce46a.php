<?php /*a:3:{s:85:"D:\system\phpStudy_64\phpstudy_pro\WWW\liunuo-thinkphp6\view\admin\article\save.phtml";i:1583074303;s:77:"D:\system\phpStudy_64\phpstudy_pro\WWW\liunuo-thinkphp6\view\admin\base.phtml";i:1583074303;s:86:"D:\system\phpStudy_64\phpstudy_pro\WWW\liunuo-thinkphp6\view\admin\article\dtree.phtml";i:1583074303;}*/ ?>
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
  
<link rel="stylesheet" href="/static/hqui/module/dtree/dtree.css"/>
<link rel="stylesheet" href="/static/hqui/module/dtree/font/dtreefont.css"/>
<link rel="stylesheet" href="/static/hqui/module/admin.css?v=316"/>
<style>
    #treeTbTree {
        height: 800px;
        overflow: auto;
    }

    @media screen and (max-width: 768px) {
        #treeTbTree {
            height: auto;
        }
    }

    /** dtree选中颜色重写 */
    .dtree-theme-item-this {
        background-color: #eeeeee !important;
    }
</style>
<style>
    .ew-iframe-body {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        overflow: auto;
    }
</style>

</head>
<body>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        
<!-- 正文开始 -->
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <!-- 左树 -->
        <div class="layui-col-sm12 layui-col-md4 layui-col-lg2">
            <div class="layui-card">
                <div class="layui-card-body mini-bar" >
  <ul id="treeTbTree" class="dtree" data-id="0"></ul>
</div>
            </div>
        </div>
        <!-- 右表 -->
        <div class="layui-col-sm12 layui-col-md8 layui-col-lg10">
            <div class="layui-card">
                <!--内容-->
                <div class="layui-card-body">
                    <form action="<?php echo request()->url(); ?>" class="layui-form" method="post">
                        <div class="layui-form-item">
                            <label class="layui-form-label">分类</label>
                            <div class="layui-input-block">
                                <select name="cid">
                                    <option value="">请选择所属分类</option>
                                    <?php if(is_array($category) || $category instanceof \think\Collection || $category instanceof \think\Paginator): if( count($category)==0 ) : echo "" ;else: foreach($category as $key=>$v): ?>
                                    <option value="<?php echo htmlentities($v['id']); ?>" <?php if(isset($data) and $data['cid'] == $v['id'] or $v['id'] == input('cid')): ?>selected="selected"<?php endif; ?>><?php if($v['level'] != '1'): ?>|<?php for($i=1;$i<$v['level'];$i++){echo ' ----';} ?><?php endif; ?> <?php echo htmlentities($v['name']); ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">标题</label>
                            <div class="layui-input-block">
                                <input type="text" name="title" value="<?php echo htmlentities((isset($data['title']) && ($data['title'] !== '')?$data['title']:'')); ?>" autocomplete="off" placeholder="" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">封面</label>
                            <div class="layui-input-block">
                                <input type="hidden" name="image" value="<?php echo htmlentities((isset($data['image']) && ($data['image'] !== '')?$data['image']:'/static/img/no_image_100x100.jpg')); ?>" autocomplete="off" placeholder="" class="layui-input">
                                <div class="layui-upload-list ajax-avatar">
                                    <img class="layui-upload-img" id="test-upload-normal-img" src="<?php echo htmlentities((isset($data['image']) && ($data['image'] !== '')?$data['image']:'/static/img/no_image_100x100.jpg')); ?>" height="130">
                                </div>
                            </div>
                        </div>
                        <?php if(is_array($field) || $field instanceof \think\Collection || $field instanceof \think\Paginator): if( count($field)==0 ) : echo "" ;else: foreach($field as $key=>$r): ?>
                        <!--input-->
                        <?php if($r['type'] == 'input'): if($r['is_sys'] == '1'): ?>
                            <div class="layui-form-item">
                                <label class="layui-form-label"><?php echo htmlentities($r['title']); ?></label>
                                <div class="layui-input-block">
                                    <input type="text" name="<?php echo htmlentities($r['name']); ?>" autocomplete="off" value="<?php echo htmlentities((isset($data[$r['name']]) && ($data[$r['name']] !== '')?$data[$r['name']]:'')); ?>" placeholder="请输入<?php echo htmlentities($r['title']); ?>" class="layui-input">
                                </div>
                            </div>
                            <?php else: ?>
                            <div class="layui-form-item">
                                <label class="layui-form-label"><?php echo htmlentities($r['title']); ?></label>
                                <div class="layui-input-block">
                                    <input type="text" name="<?php echo htmlentities($r['name']); ?>" autocomplete="off" value="<?php echo htmlentities((isset($data['jdata'][$r['name']]) && ($data['jdata'][$r['name']] !== '')?$data['jdata'][$r['name']]:'')); ?>" placeholder="请输入<?php echo htmlentities($r['title']); ?>" class="layui-input">
                                </div>
                            </div>
                            <?php endif; ?>
                        <!--textarea-->
                        <?php elseif($r['type'] == 'textarea'): if($r['is_sys'] == '1'): ?>
                            <div class="layui-form-item">
                                <label class="layui-form-label"><?php echo htmlentities($r['title']); ?></label>
                                <div class="layui-input-block">
                                    <textarea name="<?php echo htmlentities($r['name']); ?>" placeholder="请输入<?php echo htmlentities($r['title']); ?>" class="layui-textarea"><?php echo htmlentities((isset($data[$r['name']]) && ($data[$r['name']] !== '')?$data[$r['name']]:'')); ?></textarea>
                                </div>
                            </div>
                            <?php else: ?>
                            <div class="layui-form-item">
                                <label class="layui-form-label"><?php echo htmlentities($r['title']); ?></label>
                                <div class="layui-input-block">
                                    <textarea name="<?php echo htmlentities($r['name']); ?>" placeholder="请输入<?php echo htmlentities($r['title']); ?>" class="layui-textarea"><?php echo htmlentities((isset($data['jdata'][$r['name']]) && ($data['jdata'][$r['name']] !== '')?$data['jdata'][$r['name']]:'')); ?></textarea>
                                </div>
                            </div>
                            <?php endif; ?>
                        <!--select-->
                        <?php elseif($r['type'] == 'select'): ?>
                        <div class="layui-form-item">
                            <label class="layui-form-label"><?php echo htmlentities($r['title']); ?></label>
                            <div class="layui-input-block">
                                <select name="<?php echo htmlentities($r['name']); ?>">
                                    <?php $_5f1103466a746=parse_attr($r['options']); if(is_array($_5f1103466a746) || $_5f1103466a746 instanceof \think\Collection || $_5f1103466a746 instanceof \think\Paginator): if( count($_5f1103466a746)==0 ) : echo "" ;else: foreach($_5f1103466a746 as $value=>$name): ?>
                                    <option value="<?php echo htmlentities($value); ?>" <?php if(isset($data) and $data['jdata'][$r['name']] == $value): ?>selected<?php elseif(!isset($data) and $r['value'] == $value): ?>selected<?php endif; ?>><?php echo htmlentities($name); ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                        </div>
                        <!--radio-->
                        <?php elseif($r['type'] == 'radio'): ?>
                        <div class="layui-form-item">
                            <label class="layui-form-label"><?php echo htmlentities($r['title']); ?></label>
                            <div class="layui-input-block">
                                <?php $_5f1103466a35e=parse_attr($r['options']); if(is_array($_5f1103466a35e) || $_5f1103466a35e instanceof \think\Collection || $_5f1103466a35e instanceof \think\Paginator): if( count($_5f1103466a35e)==0 ) : echo "" ;else: foreach($_5f1103466a35e as $value=>$name): ?>
                                <input type="radio" name="<?php echo htmlentities($r['name']); ?>" value="<?php echo htmlentities($value); ?>" title="<?php echo htmlentities($name); ?>" <?php if(isset($data) and $data['jdata'][$r['name']] == $value): ?>checked <?php elseif(!isset($data) and $r['value'] == $value): ?>checked<?php endif; ?>/>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </div>
                        </div>
                        <!--upload-->
                        <?php elseif($r['type'] == 'upload'): if($r['is_sys'] == '1'): ?>
                            <div class="layui-form-item">
                                <label class="layui-form-label"><?php echo htmlentities($r['title']); ?></label>
                                <div class="layui-input-block">
                                    <input type="text" name="<?php echo htmlentities($r['name']); ?>" value="<?php echo htmlentities((isset($data[$r['name']]) && ($data[$r['name']] !== '')?$data[$r['name']]:'')); ?>" autocomplete="off" placeholder="请上传<?php echo htmlentities($r['title']); ?>" class="layui-input">
                                    <button type="button" class="layui-btn layui-btn-primary layui-btn-position ajax-images"><i class="fa fa-file-image-o"></i> 选择图片</button>
                                </div>
                            </div>
                            <?php else: ?>
                            <div class="layui-form-item">
                                <label class="layui-form-label"><?php echo htmlentities($r['title']); ?></label>
                                <div class="layui-input-block">
                                    <input type="text" name="<?php echo htmlentities($r['name']); ?>" value="<?php echo htmlentities((isset($data['jdata'][$r['name']]) && ($data['jdata'][$r['name']] !== '')?$data['jdata'][$r['name']]:'')); ?>" autocomplete="off" placeholder="请上传<?php echo htmlentities($r['title']); ?>" class="layui-input">
                                    <button type="button" class="layui-btn layui-btn-primary layui-btn-position ajax-images"><i class="fa fa-file-image-o"></i> 选择图片</button>
                                </div>
                            </div>
                            <?php endif; ?>
                        <!--photo-->
                        <?php elseif($r['type'] == 'photo'): ?>
                        <div class="layui-form-item">
                            <label class="layui-form-label"><?php echo htmlentities($r['title']); ?></label>
                            <div class="layui-input-inline" style="width:112px;">
                                <input type="hidden" name="photo">
                                <button type="button" class="layui-btn layui-btn-primary ajax-photos"><i class="fa fa-file-image-o"></i> 选择图片</button>
                            </div>
                            <div class="layui-form-mid layui-word-aux">允许多文件上传，不支持ie8/9</div>
                        </div>
                        <?php if(!empty($data['photo'])): if(is_array($data['photo']) || $data['photo'] instanceof \think\Collection || $data['photo'] instanceof \think\Paginator): if( count($data['photo'])==0 ) : echo "" ;else: foreach($data['photo'] as $key=>$v): ?>
                        <div class="layui-form-item">
                            <label class="layui-form-label"></label>
                            <div class="layui-input-block">
                                <input type="text" name="photo[]" value="<?php echo htmlentities($v); ?>" autocomplete="off" readonly class="layui-input">
                                <button type="button" class="layui-btn layui-btn-primary layui-btn-position delete-photo"><i class="fa fa-times-circle"></i></button>
                            </div>
                        </div>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        <?php endif; ?>
                        <!--editor-->
                        <?php elseif($r['type'] == 'editor'): ?>
                        <div class="layui-form-item">
                            <label class="layui-form-label"><?php echo htmlentities($r['title']); ?></label>
                            <div class="layui-input-block">
                                <textarea name="<?php echo htmlentities($r['name']); ?>" placeholder="请输入<?php echo htmlentities($r['title']); ?>" id="editor_<?php echo htmlentities($r['name']); ?>" style="height:400px;"><?php echo htmlentities((isset($data['jdata'][$r['name']]) && ($data['jdata'][$r['name']] !== '')?$data['jdata'][$r['name']]:'')); ?></textarea>
                            </div>
                        </div>
                        <!--编辑器-->
                        <script src="/static/libs/ueditor/ueditor.config.js"></script>
                        <script src="/static/libs/ueditor/ueditor.all.min.js"></script>
                        <script src="/static/libs/ueditor/lang/zh-cn/zh-cn.js"></script>
                        <script>
                            UE.getEditor('editor_<?php echo htmlentities($r['name']); ?>',{
                                // initialFrameWidth :800,// 设置编辑器宽度
                                initialFrameHeight:400,// 设置编辑器高度
                                scaleEnabled:true,
                                serverUrl: "<?php echo url('admin/uploads/editor'); ?>"
                            });
                        </script>
                        <?php endif; ?>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        <div class="layui-form-item">
                            <label class="layui-form-label">内容</label>
                            <div class="layui-input-block">
                                <textarea name="content" placeholder="请输入内容" id="editor" style="height:400px;"><?php echo htmlentities((isset($data['content']) && ($data['content'] !== '')?$data['content']:'')); ?></textarea>
                            </div>
                        </div>
                        
                        <div class="layui-form-item">
                            <label class="layui-form-label">页面模板</label>
                            <div class="layui-input-block">
                                <select name="template">
                                    <?php if(is_array($show_template) || $show_template instanceof \think\Collection || $show_template instanceof \think\Paginator): if( count($show_template)==0 ) : echo "" ;else: foreach($show_template as $key=>$r): ?>
                                    <option value="<?php echo htmlentities($r); ?>" <?php if(isset($data) and $data['template'] == $r): ?>selected="selected"<?php endif; ?>><?php echo htmlentities($r); ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-input-block">
                                <button class="layui-btn" lay-filter="*" lay-submit="">保存</button>
                                <button class="layui-btn layui-btn-primary" type="reset">重置</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!--内容-->
            </div>
        </div>

    </div>
</div>

    </div>
</div>
<script type="text/javascript" src="/static/hqui/libs/layui/layui.all.js"></script>
<script type="text/javascript" src="/static/js/jquery.min.js"></script>
<script type="text/javascript" src="/static/js/layui.base.js"></script>
<script type="text/javascript" src="/static/hqui/js/common.js?v=316"></script>

<script>
    layui.extend({dtree:'dtree/dtree'}).use(['layer', 'form', 'table', 'util', 'dtree', 'index'], function () {
        var $ = layui.jquery;
        var layer = layui.layer;
        var form = layui.form;
        var table = layui.table;
        var util = layui.util;
        var dtree = layui.dtree;
        var admin = layui.admin;
        var dropdown = layui.dropdown;
        var index = layui.index;
        var cid = "<?php echo input('cid'); ?>";
        // 渲染表格
        var insTb = table.render({
            elem: '#tableTbTree',
            url: '/admin/article/get_content?cid='+ cid,
            page: true,
            limit:15,
            limits:[15,30,45,60,75,90],
            cellMinWidth: 100,
            cols: [[
                {type:'checkbox',title:'#'},
                {field: 'title', align: 'left', sort: true, title: '标题', minWidth: 380},
                {field: 'category_name', align: 'center', sort: true, title: '栏目', width:120},
                {align: 'center', sort: true, title: '排序',templet:'#sort_order',width:120},
                {align: 'center', sort: true, title: '置顶',templet:'#is_top',width:100},
                {align: 'center', sort: true, title: '热门',templet:'#is_hot',width:100},
                {align: 'center', sort: true, title: '状态',templet:'#status',width:100},
                {field: 'create_time', align: 'center', sort: true, title: '时间',width:160},
                {align: 'center', toolbar: '#tableTBOrder', title: '操作',width: 170}
            ]],
            parseData: function(res){ //res 即为原始返回的数据
                return {
                  "code": res.code, //解析接口状态
                  "msg": res.msg, //解析提示文本
                  "count": res.data.total, //解析数据长度
                  "data": res.data.data //解析数据列表
                };
            }
        });

        // 树形渲染
        var treeTbTree = dtree.render({
            elem: '#treeTbTree',
            url: '/admin/article/get_category_tree',
            none: "请先添加数据？",
            type:'all',
            initLevel: '5',
            dot: false,
            line:true,
            method: 'GET'
        });

        // 树形点击事件
        dtree.on('node("treeTbTree")', function (obj) {
            var data = obj.param;
            //console.log(data)
            if(!data.leaf){
                var $div = obj.dom;
                treeTbTree.clickSpread($div);  //调用内置函数展开节点
            }
            //判断点开页面
            if(data.leaf === true){
//                console.log(obj.parentParam)
                //console.log(data);
                var url = "<?php echo url('admin/article/index'); ?>?cid=" + data.nodeId;
                window.location.href = url;
//                index.openTab({
//                    title: data.context, 
//                    url: "<?php echo url('admin/article/index'); ?>?cid=" + data.nodeId,
//                });
            }
        });

    });
</script>
<!--编辑器-->
<script src="/static/libs/ueditor/ueditor.config.js"></script>
<script src="/static/libs/ueditor/ueditor.all.min.js"></script>
<script src="/static/libs/ueditor/lang/zh-cn/zh-cn.js"></script>
<script>
    UE.getEditor('editor',{
        // initialFrameWidth :800,// 设置编辑器宽度
        initialFrameHeight:400,// 设置编辑器高度
        scaleEnabled:true,
        serverUrl: "<?php echo url('admin/uploads/editor'); ?>"
    });
</script>


</body>
</html>