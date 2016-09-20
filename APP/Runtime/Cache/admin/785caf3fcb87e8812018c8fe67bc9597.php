<?php if (!defined('THINK_PATH')) exit();?>﻿<div class="Yocms_header_3">
<div class="block clearfix">
    	<a href="<?php echo (($site_info['url'])?($site_info['url']):'/'); ?>" class="fleft"><img title="<?php echo (($site_info['site_name'])?($site_info['site_name']):'零零糖'); ?>" src="<?php echo (($site_info['logo'])?($site_info['logo']):'__PUBLIC__/Widget/Header/Yocms_header_1/linglingtang_short_coffee_logo.png'); ?>"></a>
        <div class="fright">
        	<form id="Yocms_header_3_search_form" action="http://www.baidu.com/s" method="get" enctype="multipart/form-data" target="_blank">
			<input id="Yocms_header_3_sougou" type="submit" value="搜狗搜索">
        	<input id="Yocms_header_3_keyword" type="text" name="wd" placeholder="请输入您感兴趣的关键词">
			<input type="hidden" name="ie" value="utf-8">
			<input id="Yocms_header_3_baidu" type="submit" value="百度">
			<input id="Yocms_header_3_yahoo" type="submit" value="雅虎搜索">
        	</form>
        </div>
    </div>
</div>
<style type="text/css">
.Yocms_header_3{
display: block;
    height: 60px;
    overflow: hidden;
}
.Yocms_header_3 *{margin:0px;}
.Yocms_header_3 p{margin-bottom:10px;}
.Yocms_header_3 div {
    text-align: left;
	font:12px/1.6 Verdana, Helvetica, sans-serif
}
.Yocms_header_3 .block {
    width: 1000px;
    clear: both;
    margin: 0 auto;
}
.Yocms_header_3 .clearfix {
    display: block;
    clear: both;
    float: none;
}
.Yocms_header_3 a {
    text-decoration: none;
    color: #333;
}
.Yocms_header_3 p{

}
.Yocms_header_3 .fleft {
    float: left;
}
.Yocms_header_3 a:link,.Yocms_header_3 a:visited {
    text-decoration: none;
    outline: none;
}
.Yocms_header_3 img {
    border: 0 none;
}
.Yocms_header_3 .fright {
    float: right;
}
.Yocms_header_3 .fright input[type="text"]{
	float:left;
	width:300px;
    display: block;
    height: 20px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.428571429;
    color: #555;
    vertical-align: middle;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
    -webkit-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
	border-top-right-radius: 0; 
     border-bottom-right-radius: 0; 
}
.Yocms_header_3 .fright input[type="submit"]{
	float:left;
	display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: normal;
    line-height: 1.428571429;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    cursor: pointer;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    -o-user-select: none;
    user-select: none;
	color: #fff;
    background-color: #428bca;
    border-color: #357ebd;
}
.Yocms_header_3 .c_red {
    color: #F00;
}
</style>
<!--<script src="__PUBLIC__/Widget/Header/Yocms_header_3/Yocms_header_3.js" type="text/javascript"></script>-->
<script>
require(['jquery'], function($){
if(typeof(Yocms_header_3_is_load)=="undefined"){
	$("body").append('<script src="__PUBLIC__/Widget/Header/Yocms_header_3/Yocms_header_3.js" type="text/javascript"><\/script>');
}
});
</script>