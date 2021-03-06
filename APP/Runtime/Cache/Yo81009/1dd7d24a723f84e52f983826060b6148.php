<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<head>
<script type="text/javascript">
$(document).ready(function(){
var clientWidth =  $(document.body).outerWidth(true);//浏览器时下窗口文档body的总宽度 包括border padding 
var sidebar          =  $("#sidebar").width();
var main_width =  clientWidth-sidebar;
$("#main").css("width",main_width-10);//主窗口的宽度 = body的宽 - #sidebar的宽 - 10
$("#main").css("height",$(document.body).outerHeight(true)-$(".header").outerWeight());
});
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Yocms 后台- Power by YoperMan - 2013</title>
<style type="text/css">
body, p, div, span, td, th, input, select, textarea {
	font: 13px/160% Arial, Tahoma, Helvetica, sans-serif;
}
body {
	height: 100%;
	overflow: hidden;
	width: 100%;
	margin: 0;
	padding: 0;
}
a {
	text-decoration: none;
}
body.blue-1 {
	background: url("../Public/admin_image/body-blue-1.gif") repeat-y scroll 0 0 #E2E9EA;
}
.header {
	background-color: #3C86C5;
	height: 80px;
	overflow: hidden;
	position: relative;
	width: 100%;
}
.header .logo {
	height: 80px;
	left: 0;
	position: absolute;
	top: 0;
	width: 196px;
}
.blue-1 .header-right {
	background-image: url(../Public/image/header-blue-1.gif);
	background-repeat: no-repeat;
	background-position: 0px 0px;
}
.header-right {
	height: 80px;
	position: absolute;
	right: 0;
	top: 0;
	width: 775px;
}
.header .header-right ul {
	float: right;
	height: 24px;
	list-style: none outside none;
	margin-right: 15px;
	margin-top: 10px;
	width: 500px;
}
.header .header-right ul li {
	color: #FFFFFF;
	float: right;
	font: 12px/24px Verdana, Geneva, sans-serif;
	padding: 0 5px;
}
.header .header-right ul li a {
	color: #FFFFFF;
	font: 12px/24px Verdana, Geneva, sans-serif;
}
.skin {
	float: right;
	font-size: 0;
	height: 11px;
	padding: 14px 15px 0 0;
	width: 80%;
}
.skin span {
	background-image: url("../Public/admin_image/skinbt.png");
	cursor: pointer;
	float: right;
	height: 11px;
	margin: 0 2px;
	width: 14px;
}
.skin .s4 {
	background-position: 0 -55px;
}
.skin .s3 {
	background-position: 0 -99px;
}
.skin .s2 {
	background-position: 0 -33px;
}
.s1.skin-current {
	background-position: -14px -22px;
}
.s2.skin-current {
	background-position: -14px -33px;
}
.s3.skin-current {
	background-position: -14px -99px;
}
.skin .s4 {
	background-position: 0 -55px;
}
.top-title h1 {
	cursor: default;
	float: left;
	font-size: 14px;
	font-weight: bold;
}
.sidebar {
	float: left;
	position: relative;
	width: 148px;
}
.left-menu {
	display: block;
	height: 100%;
	left: 0;
	overflow: hidden;
	padding-left: 7px;
	top: 1px;
	width: 140px;
}
.sidebar-menu {
	display: block;
	overflow-x: hidden;
	overflow-y: auto;
	width: 140px;
}
.menu-block {
	margin-top: 3px;
	width: 131px;
}
.menu-block-top {
	background-position: 0 0;
	height: 30px;
	margin-bottom: 4px;
	overflow: hidden;
	width: 131px;
}
ul, menu, dir {
	display: block;
	list-style-type: disc;
	-webkit-margin-before: 1em;
	-webkit-margin-after: 1em;
	-webkit-margin-start: 0px;
	-webkit-margin-end: 0px;
	-webkit-padding-start: 40px;
}
ul, p, img {
	margin: 0px;
	padding: 0px;
}
.blue-1 .sidebar-menu-list-hover, .blue-1 .box-bg {
	background-image: url("../Public/admin_image/blue-1-bg.png");
}
.blue-1 .top-title h1 {
	color: #275D96;
}
.top-title span {
	width: 14px;
	height: 14px;
	display: block;
	float: right;
	margin-top: 6px;
	cursor: pointer;
	overflow: hidden;
}
.sidebar .top-title .close {
	background-position: -14px -36px;
}
.sidebar .top-title .open {
	background-position: 0 -36px;
}
.blue-1 .sidebar-menu-list-hover, .blue-1 .box-bg {
	background-image: url("../Public/admin_image/blue-1-bg.png");
}
.menu-block-content {
	overflow: hidden;
}
.menu-block-content .sidebar-menu-list {
	margin-left: 13px;
	overflow: hidden;
	width: 106px;
}
.menu-block-content .sidebar-menu-list li {
	display: block;
	float: left;
	height: 23px;
	line-height: 23px;
	margin-top: 2px;
	overflow: hidden;
	padding: 0 3px;
	width: 100px;
}
.menu-block-content .sidebar-menu-list li:hover {
	background-image: url("../Public/admin_image/blue-1-bg.png");
	background-position: 0 -52px;
}
.menu-list-label {
	color: #444444;
	display: block;
	float: left;
	font-size: 12px;
	width: 80px;
}
.blue-1 .sidebar-menu-list-hover, .blue-1 .box-bg {
	background-image: url("../Public/admin_image/blue-1-bg.png");
}
.menu-list-add {
	background-position: 0 -199px;
	color: #337BA1;
	display: inline-block;
	float: right;
	font-size: 12px;
	height: 14px;
	line-height: 14px;
	margin-top: 5px;
	text-align: right;
	width: 14px;
}
.blue-1 .sidebar-menu-list-hover, .blue-1 .box-bg {
	background-image: url("../Public/admin_image/blue-1-bg.png");
}
.main {
	margin-right: 8px;
	overflow: hidden;
	float: left;
	margin-bottom: 8px;
	display: inline;
}
.col-1 {
	background: none repeat scroll 0 0 #FFFFFF;
	border: 1px solid #f4f6f5;
	margin-top: 9px;
}
.content {
	overflow: hidden;
	position: relative;
}
iframe[Attributes Style] {
border-top-width: 0px;
border-right-width: 0px;
border-bottom-width: 0px;
border-left-width: 0px;
width: 100%;
height: 100%;
}
</style>
</head>
<body color="blue-1" class="blue-1">
<div class="header">
  <div class="logo"><!-- <img src="../Public/admin_image/logo.png">-->Yocms 系统 LOGO</div>
  <div class="header-right">
    <ul>
      <li id="guide"> <a href="#" title="我的面板">我的面板</a> </li>
      <li>|</li>
      <li> <a target="_blank" href="#">网站首页</a> </li>
      <li>|</li>
      <li> <a target="_blank" href="#">官方网站</a> </li>
      <li>|</li>
      <li> <a href="#">[退出]</a> </li>
      <li> <span>您好
        零零糖 科技        [超级管理员] </span> </li>
    </ul>
    <!--风格控制切换 开始 skin-current为当前状态-->
    <div class="skin"> <span val="black-1" class="s4"></span> <span val="purple-1" class="s3"></span> <span val="green-1" class="s2"></span> <span val="blue-1" class="s1 skin-current"></span> </div>
    <!--风格控制切换 结束--> 
  </div>
</div>
<div class="sidebar" id="sidebar"> 
  <!--当左边栏隐藏时class="sidebar"要加入class="sidebar left-menu-on" -->
  <div class="left-menu"> 
    <!--当左边栏隐藏时class="left-menu"要加上style="display:none;" -->
    <div class="sidebar-menu" style="height:100%;">
      <div class="menu-block">
        <div class="box-bg menu-block-top">
          <div class="top-title">
            <h1>产品管理</h1>
            <span class="box-bg open close" title="展开与收缩"></span> </div>
        </div>
        <div class="menu-block-content">
          <ul class="sidebar-menu-list">
            <!--<li> <a href="addGoods.php" target="admin_iframe" title="添加商品" class="menu-list-label"> 添加商品 </a> <a href="#" title="添加文章" class="box-bg menu-list-add"></a> </li>-->
            <!--<li> <a href="../module/productModule/productModule.php"  target="admin_iframe"  title="商品列表" class="menu-list-label"> 商品列表 </a> <a href="#" title="添加线路" class="box-bg menu-list-add"></a> </li>-->
            <li> <a href="<?php echo U('Yo81009/Admin/get_article_list');?>"  target="admin_iframe"  title="文章列表" class="menu-list-label"> 文章列表 </a> <a href="#" title="文章列表" class="box-bg menu-list-add"></a> </li>
			<li> <a href="<?php echo U('Yo81009/Admin/add_article');?>"  target="admin_iframe"  title="添加文章" class="menu-list-label"> 添加文章 </a> <a href="#" title="添加文章" class="box-bg menu-list-add"></a> </li>
          </ul>
        </div>
      </div>
      <div class="menu-block">
        <div class="box-bg menu-block-top">
          <div class="top-title">
            <h1>微商城管理</h1>
            <span class="box-bg open close" title="展开与收缩"></span> </div>
        </div>
        <div class="menu-block-content">
          <ul class="sidebar-menu-list">
            <li> <a href="wechatMallList.php" target="admin_iframe" title="商城列表" class="menu-list-label">商城列表</a> <a href="#" title="添加文章分类" class="box-bg menu-list-add"></a> </li>
            <li> <a href="AddWechatMall.php" title="添加商城"  target="admin_iframe"  class="menu-list-label">添加商城</a> <a href="#" title="添加线路分类" class="box-bg menu-list-add"></a> </li>
          </ul>
        </div>
      </div>
      <div class="menu-block">
        <div class="box-bg menu-block-top">
          <div class="top-title">
            <h1>手机端网站管理</h1>
            <span class="box-bg open close" title="展开与收缩"></span> </div>
        </div>
        <div class="menu-block-content">
          <ul class="sidebar-menu-list">
            <!--<li> <a href="#" title="页面列表" class="menu-list-label">页面</a> <a href="#" title="添加页面" class="box-bg menu-list-add"></a> </li>-->
            <li> <a href="#" title="菜单列表" class="menu-list-label">菜单</a> <a href="#" title="添加菜单项" class="box-bg menu-list-add"></a> </li>
            <!--<li> <a href="#" title="域名列表" class="menu-list-label">域名</a> <a href="#" title="添加域名" class="box-bg menu-list-add"></a> </li>-->
            <li> <a href="#" title="表单管理" class="menu-list-label">表单管理</a> </li>
            <li> <a href="#" title="支付设置" class="menu-list-label">支付设置</a> </li>
            <li> <a href="#" title="系统设置" class="menu-list-label">系统设置</a> </li>
          </ul>
        </div>
      </div>
      <div class="menu-block">
        <div class="box-bg menu-block-top">
          <div class="top-title">
            <h1>会员管理</h1>
            <span class="box-bg open" title="展开与收缩"></span> </div>
        </div>
        <div style="display: none;" class="menu-block-content">
          <ul class="sidebar-menu-list">
            <li> <a href="/admin/user/staff" title="员工管理" class="menu-list-label">员工管理</a> <a href="#" title="添加员工" class="box-bg menu-list-add"></a> </li>
            <li> <a href="/admin/user/role" title="角色管理" class="menu-list-label">角色管理</a> <a href="#" title="添加角色" class="box-bg menu-list-add"></a> </li>
            <li> <a href="#" title="权限管理" class="menu-list-label">权限管理</a> </li>
            <li> <a href="#" title="会员列表" class="menu-list-label">会员列表</a> </li>
            <li> <a href="#" title="账号修改" class="menu-list-label">账号修改</a> </li>
            <li> <a href="#" title="同行管理" class="menu-list-label">同行管理</a> <a href="#" title="添加同行" class="box-bg menu-list-add"></a> </li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!--当左边栏隐藏时加入class="open-close open"--> 
</div>
<div id="main" class="main" style="width:1118px; height: 100%;">
  <div class="col-1">
    <div id="win-list" class="content" style="height: 100%;"> 
      <!--主要窗口-->
      <iframe name="admin_iframe" width="100%" height="100%" frameborder="0" class="main-win" style="border: medium none; display: inline;" id="win-undefined"  src="<?php echo U('Yo81009/Admin/main');?>" onload="this.height=this.contentWindow.document.documentElement.scrollHeight"></iframe>

    </div>
  </div>
</div>
<!-- 页尾脚本 -->

</body>
</html>

</body>
</html>