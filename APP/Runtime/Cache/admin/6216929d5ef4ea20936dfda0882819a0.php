<?php if (!defined('THINK_PATH')) exit();?>﻿<div class="Yocms_header1">
<div class="block clearfix">
    	<a href="/index.php?s=/Index/index.html" class="fleft"><img title="<?php echo (($site_info['site_name'])?($site_info['site_name']):'没有名称'); ?>" src="<?php echo (($site_info['logo'])?($site_info['logo']):'__PUBLIC__/Widget/Header/Yocms_header_1/logo.png'); ?>"></a>
		<img class="banner" src="<?php echo (($site_info['banner'])?($site_info['banner']):'__PUBLIC__/Widget/Header/Yocms_header_1/banner.jpg'); ?>">
        <div class="fright">
        	<p class="tright"><a title="<?php echo (($site_info['site_name'])?($site_info['site_name']):'零零糖'); ?>" onclick="SetHome(window.location)" href="javascript:void(0)">设为首页</a> | <a onclick="AddFavorite(window.location,document.title)" href="javascript:void(0)">加入收藏</a></p>
            <p class="f16 c_red">咨询电话：<?php echo ($site_info['mobile']); ?></p>
        </div>
    </div>
</div>
<style type="text/css">
.Yocms_header1{
display: block;
    height: 60px;
    overflow: hidden;
}
.Yocms_header1 *{margin:0px;}
.Yocms_header1 .banner{
width: 480px;
    overflow: hidden;
    margin: 0px;
}
.Yocms_header1 p{margin-bottom:10px;}
.Yocms_header1 div {
    text-align: left;
	font:12px/1.6 Verdana, Helvetica, sans-serif
}
.Yocms_header1 .block {
    width: 1000px;
    clear: both;
    margin: 0 auto;
}
.Yocms_header1 .clearfix {
    display: block;
    clear: both;
    float: none;
}
.Yocms_header1 a {
    text-decoration: none;
    color: #333;
}
.Yocms_header1 p{

}
.Yocms_header1 .fleft {
    float: left;
}
.Yocms_header1 a:link,.Yocms_header1 a:visited {
    text-decoration: none;
    outline: none;
}
.Yocms_header1 img {
    border: 0 none;
}
.Yocms_header1 .fright {
    float: right;
}
.Yocms_header1 .c_red {
    color: #F00;
}
</style>