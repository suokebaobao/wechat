var layer = layui.layer,
    form = layui.form,
    element = layui.element,
    laydate = layui.laydate,
    upload = layui.upload,
    table = layui.table;

// 通用提交
form.on('submit(*)', function (data) {
    var index = layer.msg('提交中，请稍候', {
        icon: 16,
        time: false,
        shade: 0.3
    });
    $(data.elem).attr('disabled', true);
    $.ajax({
        url: data.form.action,
        type: data.form.method,
        dataType: 'json',
        data: $(data.form).serialize(),
        success: function (result) {
            if (result.code === 1 && result.url != '') {
                setTimeout(function () {
                    location.href = result.url;
                }, 1000);
            } else {
                $(data.elem).attr('disabled', false);
            }
            layer.close(index);
            layer.msg(result.msg);
        },
        error: function (xhr, state, errorThrown) {
            layer.close(index);
            layer.msg(state + '：' + errorThrown);
        }
    });
    return false;
});
// 父窗口通用提交
form.on('submit(i)', function (data) {
    var index = layer.msg('提交中，请稍候', {
        icon: 16,
        time: false,
        shade: 0.3
    });
    $.ajax({
        url: data.form.action,
        type: data.form.method,
        dataType: 'json',
        data: $(data.form).serialize(),
        success: function (result) {
            if (result.code === 1) {
                setTimeout(function () {
                    parent.location.reload();
                }, 1000);
            }
            layer.close(index);
            layer.msg(result.msg);
        },
        error: function (xhr, state, errorThrown) {
            layer.close(index);
            layer.msg(state + '：' + errorThrown);
        }
    });
    return false;
});
// 通用开关
form.on('switch(*)', function (data) {
    var index = layer.msg('修改中，请稍候', {
        icon: 16,
        time: false,
        shade: 0.3
    });
    // 参数
    var obj = {};
    obj[$(this).attr('name')] = this.checked == true ? 1 : 0;
    obj['_verify'] = 0;
    $.ajax({
        url: $(this).data('url'),
        type: 'post',
        dataType: 'json',
        data: obj,
        success: function (result) {
            layer.close(index);
            layer.msg(result.msg);
        },
        error: function (xhr, state, errorThrown) {
            layer.close(index);
            layer.msg(state + '：' + errorThrown);
        }
    });
});
// 通用全选
form.on('checkbox(*)', function (data) {
    $('.layui-table tbody input[lay-skin="primary"]').each(function (index, item) {
        item.checked = data.elem.checked;
    });
    form.render('checkbox');
});
// 通用提交
$('.ajax-submit').on('click', function () {
    var than = $(this);
    var form = $(this).parents('form');
    var index = layer.msg('提交中，请稍候', {
        icon: 16,
        time: false,
        shade: 0.3
    });
    than.attr('disabled', true);
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        dataType: 'json',
        data: $(data.form).serialize(),
        success: function (result) {
            if (result.code === 1 && result.url != '') {
                setTimeout(function () {
                    location.href = result.url;
                }, 1000);
            } else {
                than.attr('disabled', false);
            }
            layer.close(index);
            layer.msg(result.msg);
        },
        error: function (xhr, state, errorThrown) {
            layer.close(index);
            layer.msg(state + '：' + errorThrown);
        }
    });
    return false;
});
// 通用异步
$('.ajax-action').on('click', function () {
    var url = $(this).attr('href');
    var index = layer.msg('请求中，请稍候', {
        icon: 16,
        time: false,
        shade: 0.3
    });
    $.ajax({
        url: url,
        type: 'post',
        dataType: 'json',
        success: function (result) {
            if (result.code === 1 && result.url != '') {
                setTimeout(function () {
                    location.href = result.url;
                }, 1000);
            }
            layer.close(index);
            layer.msg(result.msg);
        },
        error: function (xhr, state, errorThrown) {
            layer.close(index);
            layer.msg(state + '：' + errorThrown);
        }
    });
    return false;
});
// 通用异步
// 数据表格专用
$('body').on('click','.ajax-action',function(){
    var url = $(this).attr('href');
    var index = layer.msg('请求中，请稍候', {
        icon: 16,
        time: false,
        shade: 0.3
    });
    $.ajax({
        url: url,
        type: 'post',
        dataType: 'json',
        success: function (result) {
            if (result.code === 1 && result.url != '') {
                setTimeout(function () {
                    location.href = result.url;
                }, 1000);
            }
            layer.close(index);
            layer.msg(result.msg);
        },
        error: function (xhr, state, errorThrown) {
            layer.close(index);
            layer.msg(state + '：' + errorThrown);
        }
    });
    return false;
});
// 通用更新
$('.ajax-update').on('blur', function () {
    // 参数
    var obj = {};
    obj[$(this).attr('name')] = $(this).val();
    obj['_verify'] = 0;
    $.ajax({
        url: $(this).data('url'),
        type: 'post',
        dataType: 'json',
        data: obj,
        success: function (result) {
            if (result.code === 1) {
                layer.msg(result.msg);
                setTimeout(function () {
                    location.reload();
                }, 1000);
            }
        },
        error: function (xhr, state, errorThrown) {
            layer.close(index);
            layer.msg(state + '：' + errorThrown);
        }
    });
    return false;
});
// 数据表格专用
$('body').on('blur','.ajax-update',function(){
    // 参数
    var obj = {};
    obj[$(this).attr('name')] = $(this).val();
    obj['_verify'] = 0;
    $.ajax({
        url: $(this).data('url'),
        type: 'post',
        dataType: 'json',
        data: obj,
        success: function (result) {
            if (result.code === 1) {
                layer.msg(result.msg);
                setTimeout(function () {
                    location.reload();
                }, 1000);
            }
        },
        error: function (xhr, state, errorThrown) {
            layer.close(index);
            layer.msg(state + '：' + errorThrown);
        }
    });
    return false;
});
// 通用删除
$('.ajax-delete').on('click', function () {
    var url = $(this).attr('href');
    layer.confirm('确定删除？', {
        icon: 3,
        title: '提示'
    }, function (index) {
        var index = layer.msg('删除中，请稍候', {
            icon: 16,
            time: false,
            shade: 0.3
        });
        $.ajax({
            url: url,
            type: 'post',
            dataType: 'json',
            success: function (result) {
                if (result.code === 1 && result.url != '') {
                    setTimeout(function () {
                        location.href = result.url;
                    }, 1000);
                }
                layer.close(index);
                layer.msg(result.msg);
            },
            error: function (xhr, state, errorThrown) {
                layer.close(index);
                layer.msg(state + '：' + errorThrown);
            }
        });
    });
    return false;
});
//数据表格专用
$('body').on('click','.ajax-delete',function(){
    var url = $(this).attr('href');
    layer.confirm('确定删除？', {
        icon: 3,
        title: '提示'
    }, function (index) {
        var index = layer.msg('删除中，请稍候', {
            icon: 16,
            time: false,
            shade: 0.3
        });
        $.ajax({
            url: url,
            type: 'post',
            dataType: 'json',
            success: function (result) {
                if (result.code === 1 && result.url != '') {
                    setTimeout(function () {
                        location.href = result.url;
                    }, 1000);
                }
                layer.close(index);
                layer.msg(result.msg);
            },
            error: function (xhr, state, errorThrown) {
                layer.close(index);
                layer.msg(state + '：' + errorThrown);
            }
        });
    });
    return false;
});
//数据表格专用
$('body').on('click','.ajax-detail',function(){
    var title = $(this).html();
    var url = $(this).attr('href');
    var index = layer.open({
        title: title,
        type: 2,
        content: url,
        success: function (layero, index) {
            setTimeout(function () {
                layer.tips('点击此处返回', '.layui-layer-setwin .layui-layer-close', {
                    tips: 3
                });
            }, 500)
        }
    })
    layer.full(index);
    return false;
});
// 通用详情
$('.ajax-detail').on('click', function () {
    var title = $(this).html();
    var url = $(this).attr('href');
    var index = layer.open({
        title: title,
        type: 2,
        content: url,
        success: function (layero, index) {
            setTimeout(function () {
                layer.tips('点击此处返回', '.layui-layer-setwin .layui-layer-close', {
                    tips: 3
                });
            }, 500)
        }
    })
    layer.full(index);
    return false;
});
// 通用窗口
$('.ajax-iframe').on('click', function() {
    var title = $(this).html();
    var url = $(this).attr('href');
    var width = $(this).data('width');
    var height = $(this).data('height');
    var index = layer.open({
        title: title,
        
        type: 2,
        shadeClose:true,
        area: [width, height],
        content: url,
    })
    return false;
});
//数据表格专用
$('body').on('click','.ajax-iframe',function(){
    var title = $(this).html();
    var url = $(this).attr('href');
    var width = $(this).data('width');
    var height = $(this).data('height');
    var index = layer.open({
        title: title,
        type: 2,
        anim: 5,
        shadeClose:true,
        area: [width, height],
        content: url,
    })
    return false;
});
// 通用搜索
$('.ajax-search').on('click', function () {
    var form = $(this).parents('form');
    var url = form.attr('action');
    var query = form.serialize();
    query = query.replace(/(&|^)(\w*?\d*?\-*?_*?)*?=?((?=&)|(?=$))/g, '');
    query = query.replace(/^&/g, '');
    if (url.indexOf('?') > 0) {
        url += '&' + query;
    } else {
        url += '?' + query;
    }
    location.href = url;
    return false;
});
// 通用批量
$('.ajax-batch').on('click', function () {
    var url = $(this).attr('href');
    var val = [];
    $('.layui-table tbody input[lay-skin="primary"]:checked').each(function (i) {
        val[i] = $(this).val();
    });
    if (val === undefined || val.length == 0) {
        layer.msg('请选择数据');
        return false;
    }
    var index = layer.msg('请求中，请稍候', {
        icon: 16,
        time: false,
        shade: 0.3
    });
    // 参数
    var obj = {};
    obj[$('.layui-table tbody input[lay-skin="primary"]:checked').attr('name')] = val;
    obj['_verify'] = 0;
    $.ajax({
        url: url,
        type: 'post',
        dataType: 'json',
        data: obj,
        success: function (result) {
            if (result.code === 1 && result.url != '') {
                setTimeout(function () {
                    location.reload();
                }, 1000);
            }
            layer.close(index);
            layer.msg(result.msg);
        },
        error: function (xhr, state, errorThrown) {
            layer.close(index);
            layer.msg(state + '：' + errorThrown);
        }
    });
    return false;
});
// 头像上传
upload.render({
    elem: '.ajax-avatar',
    url: '/admin/uploads/uploadImage',
    done: function (result) {
        // 上传完毕回调
        if (result.code === 1) {
            $('#test-upload-normal-img').attr('src', result.url);
            this.item.prev('input').val(result.url);
            layer.msg('上传成功');
        } else {
            layer.msg(result.msg);
        }
    }
});
// 通用上传
upload.render({
    elem: '.ajax-images',
    url: '/admin/uploads/uploadImage',
    done: function (result) {
        // 上传完毕回调
        if (result.code === 1) {
            this.item.prev('input').val(result.url);
        } else {
            layer.msg(result.msg);
        }
    }
});
upload.render({
    elem: '.ajax-file',
    url: '/admin/uploads/uploadFile',
    accept: 'file', // 普通文件
    done: function (result) {
        // 上传完毕回调
        if (result.code === 1) {
            this.item.prev('input').val(result.url);
        } else {
            layer.msg(result.msg);
        }
    }
});
upload.render({
    elem: '.ajax-video',
    url: '/admin/uploads/uploadVideo',
    accept: 'video', // 视频文件
    done: function (result) {
        // 上传完毕回调
        if (result.code === 1) {
            this.item.prev('input').val(result.url);
        } else {
            layer.msg(result.msg);
        }
    }
});
// 通用相册
upload.render({
    elem: '.ajax-photos',
    url: '/admin/uploads/uploadImage',
    multiple: true,
    done: function (result) {
        // 上传完毕回调
        if (result.code === 1) {
            var html = '<div class="layui-form-item"><label class="layui-form-label"></label><div class="layui-input-block"><input type="text" name="photo[]" value="' + result.url + '" autocomplete="off" readonly class="layui-input"><button type="button" class="layui-btn layui-btn-primary layui-btn-position delete-photo"><i class="fa fa-times-circle"></i></button></div></div>';
            this.item.parents('.layui-form-item').after(html);
        } else {
            layer.msg(result.msg);
        }
    }
});
// 删除相册
$('.layui-form').delegate('.delete-photo', 'click', function () {
    $(this).parents('.layui-form-item').remove();
});

// 点击图片放大
$(document).off('click.tbImg').on('click.tbImg', '[tb-img]', function () {
    layer.photos({photos: {data: [{src: $(this).attr('src')}]}, shade: .1, closeBtn: true});
});