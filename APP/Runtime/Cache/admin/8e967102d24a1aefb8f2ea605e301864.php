<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet"  type="text/css" href="../Public/style.css"/>
	<script type="text/javascript" src="__PUBLIC__/js/jquery.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>超级管理员 - YO开源系统-永久免费- power by 零零糖 - YoperMan - 2014~2015</title>
</head>
<body color="blue-1" class="blue-1">

<div class="header">
  <div class="logo"><!-- <img src="images/logo.png">-->YO开源系统 LOGO</div>
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
        零零糖科技        [超级管理员] </span> </li>
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
            <h1>订单管理</h1>
            <span class="box-bg open close" title="展开与收缩"></span> </div>
        </div>
        <div class="menu-block-content">
          <ul class="sidebar-menu-list">
            <li> <a href="<?php echo U('Admin/Order/list_order');?>" target="admin_iframe" title="添加商品" class="menu-list-label"> 订单列表</a> <a href="#" title="添加文章" class="box-bg menu-list-add"></a> </li>
          </ul>
        </div>
      </div>
      <div class="menu-block">
        <div class="box-bg menu-block-top">
          <div class="top-title">
            <h1>产品管理</h1>
            <span class="box-bg open close" title="展开与收缩"></span> </div>
        </div>
        <div class="menu-block-content">
          <ul class="sidebar-menu-list">
            <li> <a href="<?php echo U('Admin/Goods/addGoods');?>" target="admin_iframe" title="添加商品" class="menu-list-label"> 添加商品 </a> <a href="#" title="添加文章" class="box-bg menu-list-add"></a> </li>
            <li> <a href="<?php echo U('Admin/Goods/listGoods');?>"  target="admin_iframe"  title="商品列表" class="menu-list-label"> 商品列表 </a> <a href="#" title="商品列表" class="box-bg menu-list-add"></a> </li>
            <li> <a href="<?php echo U('Admin/Goods/listGoodsCategory');?>"  target="admin_iframe"  title="商品列表" class="menu-list-label"> 商品分类</a> <a href="#" title="商品列表" class="box-bg menu-list-add"></a> </li>
          </ul>
        </div>
      </div>
	  <div class="menu-block">
        <div class="box-bg menu-block-top">
          <div class="top-title">
            <h1>优惠管理</h1>
            <span class="box-bg open close" title="展开与收缩"></span> </div>
        </div>
        <div class="menu-block-content">
          <ul class="sidebar-menu-list">
            <li> <a href="<?php echo U('Admin/Coupon/list_coupon');?>" target="admin_iframe" title="优惠券管理" class="menu-list-label"> 优惠券管理</a> <a href="#" title="优惠券管理" class="box-bg menu-list-add"></a> </li>
            <li> <a href="<?php echo U('Admin/Coupon/list_batch');?>"  target="admin_iframe"  title="优惠批次管理" class="menu-list-label"> 优惠批次管理 </a> <a href="#" title="优惠批次管理" class="box-bg menu-list-add"></a> </li>
          </ul>
        </div>
      </div>
            <div class="menu-block">
        <div class="box-bg menu-block-top">
          <div class="top-title">
            <h1>文章管理</h1>
            <span class="box-bg open close" title="展开与收缩"></span> </div>
        </div>
        <div class="menu-block-content">
          <ul class="sidebar-menu-list">
            <li> <a href="<?php echo U('Admin/Article/add_article');?>" target="admin_iframe" title="商城列表" class="menu-list-label">添加文章</a> <a href="#" title="添加文章分类" class="box-bg menu-list-add"></a> </li>
            <li> <a href="<?php echo U('Admin/Article/list_article');?>" title="文章列表"  target="admin_iframe"  class="menu-list-label">文章列表</a> <a href="#" title="添加线路分类" class="box-bg menu-list-add"></a> </li>
             <li> <a href="<?php echo U('Admin/Article/list_article_category');?>" title="添加商城"  target="admin_iframe"  class="menu-list-label">文章分类</a> <a href="#" title="添加线路分类" class="box-bg menu-list-add"></a> </li>
          </ul>
        </div>
      </div>
      <div class="menu-block">
        <div class="box-bg menu-block-top">
          <div class="top-title">
            <h1>会员管理</h1>
            <span class="box-bg open" title="展开与收缩"></span> </div>
        </div>
        <div class="menu-block-content">
          <ul class="sidebar-menu-list">
            <!--<li> <a href="/admin/user/staff" title="员工管理" class="menu-list-label">员工管理</a> <a href="#" title="添加员工" class="box-bg menu-list-add"></a> </li>
            <li> <a href="/admin/user/role" title="角色管理" class="menu-list-label">角色管理</a> <a href="#" title="添加角色" class="box-bg menu-list-add"></a> </li>-->
            <li> <a href="#" title="权限管理" class="menu-list-label">权限管理</a> </li>
            <li> <a href="<?php echo U('Admin/User/list_user');?>" target="admin_iframe" title="会员列表" class="menu-list-label">会员列表</a> </li>
            <!--<li> <a href="#" title="账号修改" class="menu-list-label">账号修改</a> </li>
            <li> <a href="#" title="同行管理" class="menu-list-label">同行管理</a> <a href="#" title="添加同行" class="box-bg menu-list-add"></a> </li>-->
          </ul>
        </div>
      </div>
      <div class="menu-block">
        <div class="box-bg menu-block-top">
          <div class="top-title">
            <h1>第三方管理</h1>
            <span class="box-bg open close" title="展开与收缩"></span> </div>
        </div>
        <div class="menu-block-content">
          <ul class="sidebar-menu-list">
            <li> <a href="<?php echo U('Admin/Partner/list_partner');?>" title="添加商城"  target="admin_iframe"  class="menu-list-label">第三方列表</a> <a href="#" title="添加线路分类" class="box-bg menu-list-add"></a> </li>
            <li> <a href="<?php echo U('Admin/Site/list_site');?>" target="admin_iframe" title="站点管理" class="menu-list-label">站点管理</a> <a href="#" title="添加文章分类" class="box-bg menu-list-add"></a> </li>
            <li> <a href="<?php echo U('Admin/Store/list_store');?>" target="admin_iframe" title="商家管理"  class="menu-list-label">商家管理</a> <a href="#" title="添加线路分类" class="box-bg menu-list-add"></a> </li>
            <!-- <li> <a href="wechatMallList.php" target="admin_iframe" title="商城列表" class="menu-list-label">微商城模版选择</a> <a href="#" title="添加文章分类" class="box-bg menu-list-add"></a> </li> -->
      
          </ul>
        </div>
      </div>
      <div class="menu-block">
        <div class="box-bg menu-block-top">
          <div class="top-title">
            <h1>APP应用管理</h1>
            <span class="box-bg open close" title="展开与收缩"></span> </div>
        </div>
        <div style="display: none;"  class="menu-block-content">
          <ul class="sidebar-menu-list">
            <li> <a href="<?php echo U('Admin/App/app_store');?>"   target="admin_iframe"   title="App商城" class="menu-list-label">苹果App商城</a> <a href="#" title="申请苹果App商城" class="box-bg menu-list-add"></a> </li>
            <li> <a href="<?php echo U('Admin/App/app_news');?>"   target="admin_iframe"   title="App新闻客户端" class="menu-list-label">安卓App新闻客户端</a> <a href="#" title="申请安卓App新闻客户端" class="box-bg menu-list-add"></a> </li>
          </ul>
        </div>
      </div>
      
      <div class="menu-block">
        <div class="box-bg menu-block-top">
          <div class="top-title">
            <h1>系统设置</h1>
            <span class="box-bg open close" title="展开与收缩"></span> </div>
        </div>
        <div class="menu-block-content">
          <ul class="sidebar-menu-list">
            <li> <a href="<?php echo U('Admin/Navigation/list_navigation');?>"  target="admin_iframe" title="菜单列表" class="menu-list-label">菜单导航</a> <a href="#" title="添加菜单项" class="box-bg menu-list-add"></a> </li>
            <li> <a href="#" title="表单管理" class="menu-list-label">表单管理</a> <a href="#" title="添加菜单项" class="box-bg menu-list-add"></a> </li>
            <li> <a href="#" title="支付设置" class="menu-list-label">支付设置</a>  <a href="#" title="添加菜单项" class="box-bg menu-list-add"></a> </li>
            <li> <a href="<?php echo U('Admin/Setting/list_setting');?>" target="admin_iframe" title="系统设置" class="menu-list-label">站点设置</a>  <a href="#" title="添加菜单项" class="box-bg menu-list-add"></a> </li>
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
      <iframe name="admin_iframe" width="100%" height="680px" min-height="680px" 
      frameborder="0" class="main-win" style="border: medium none; display: inline;" id="win-undefined"  src="<?php echo U('Admin/Index/main');?>" >
      </iframe>
      
    </div>
  </div>
</div>
<!-- 页尾脚本 -->

</body>
</html>