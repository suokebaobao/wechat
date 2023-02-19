/** EasyWeb iframe v3.1.6 date:2020-02-08 License By http://easyweb.vip */

// 以下代码是配置layui扩展模块的目录，每个页面都需要引入
layui.config({
    pageTabs: false,                // 关闭多标签
    defaultTheme: 'theme-my', // 默认主题
    cacheTab: true,                // 刷新页面不恢复已经打开的Tab
    maxTabNum: 20,                  // 最大打开的Tab数量
    openTabCtxMenu: false,          // 关闭Tab鼠标右键菜单
    tableName: 'easyweb-iframe',    // 存储表名
    getAjaxHeaders: function(){},
    ajaxSuccessBefore: function(){},
    version: '316',
    base: getProjectUrl() + 'hqui/module/'
}).extend({
    dropdown: 'dropdown/dropdown',
    notice: 'notice/notice',
    cascader: 'cascader/cascader',
    fileChoose: 'fileChoose/fileChoose',
    treeSelect: 'treeSelect/treeSelect',
    step: 'step-lay/step',
    treeTable: 'treeTable/treeTable',
    tagsInput: 'tagsInput/tagsInput',
    Split: 'Split/Split',
    Cropper: 'Cropper/Cropper',
    citypicker: 'city-picker/city-picker',
    zTree: 'zTree/zTree',
    dTree: 'dTree/dTree',
    introJs: 'introJs/introJs'
}).use(['layer', 'admin'], function () {
    var $ = layui.jquery;
    var layer = layui.layer;
    var admin = layui.admin;

    // 移除loading动画
    setTimeout(function () {
        admin.removeLoading();
    }, window === top ? 300 : 0);

});

// 获取当前项目的根路径，通过获取layui.js全路径截取assets之前的地址
function getProjectUrl() {
    var layuiDir = layui.cache.dir;
    if (!layuiDir) {
        var js = document.scripts, last = js.length - 1, src;
        for (var i = last; i > 0; i--) {
            if (js[i].readyState === 'interactive') {
                src = js[i].src;
                break;
            }
        }
        var jsPath = src || js[last].src;
        layuiDir = jsPath.substring(0, jsPath.lastIndexOf('/') + 1);
    }
    return layuiDir.substring(0, layuiDir.indexOf('hqui'));
}﻿