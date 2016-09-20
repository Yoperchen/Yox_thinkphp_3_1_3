/**
* @description 初始化全局
* @author Yoper
* @email 944975166@qq.com
* @version 1.0  20160528
*/
;//var common_url = "http://common.linglingtang.me/index.php?s=/Comment/index.html";
var adminstore_url = "http://adminstore.linglingtang.me/";
var common_url = "http://common.linglingtang.me/";
var GameHtml5 = "http://gamehtml5.linglingtang.me/";
var home_url = "http://home.linglingtang.me/";
var share_url = "http://share.linglingtang.me/";
var user_url = "http://user.linglingtang.me/";
var yo80007_url = "http://yo80007.linglingtang.me/";
var yo81008_url = "http://yo81008.linglingtang.me/";
var yo81009_url = "http://yo81009.linglingtang.me/";
requirejs.config({
	baseUrl : "Public",
    paths : {
        jquery         :'js/jquery.min',
        jqueryform     :'js/jquery.form',
        jquerycookie  :'js/jquery.cookie',
        ckeditor       :"plugins/ckeditor/ckeditor",//编辑器
        jqueryqrcode  :"js/jquery.qrcode.min",//二维码
        jquerylazyload:"plugins/jquery.lazyload/jquery.lazyload",//异步加载图片
	linglingtang  :'js/linglingtang'
    },
    shim: {
        ckeditor: {
            deps: ['jquery']
        },
        jquerycookie: {
            deps: ['jquery']
        },
        jqueryform: {
        	deps: ['jquery']
        }
    }

});
