<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>零零糖-汇聚每日热门、搞笑、有趣资讯-花儿开到千年无尽的芬芳</title>      
	<meta name="keywords" content="零零糖,花儿开到千年无尽的芬芳,糖友"/>  
	<meta name="description" content="每日严肃的、热门的、搞笑的、有趣的资讯" />
	<script type="text/javascript" src="__PUBLIC__/js/jquery.min.js"></script>
	<script type="text/javascript" src="__PUBLIC__/plugins/ckeditor/ckeditor.js"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<link rel="icon" href="/Public/favicon.ico" mce_href="/Public/favicon.ico" type="image/x-icon">
<style type="text/css">
*{margin:0;padding:0;}
body, html {
 margin: 0;
 padding:0 !important;
 padding:90px 0 32px 0;
 width:100%;
}
.header {
	background: #FFF;
	width: 100%;
	overflow: hidden;
	top: 0;
	width: 100%;
	text-align: center;
	background-color: #FFF;
}
.content {
 bottom:32px;
 width:100%;
 overflow:hidden;
 height:auto!important;
 height:100%;
 left: -3px;
 display:block;
 clear:both;
 width: 100%;
}
.main {
 height:100%;
 background:#FFF;
 overflow-y:auto;
 text-align:left;
 width:1200px;
 margin-left:auto;
 margin-right:auto;
}
.main>div>a{float: left;
    color: #333;
    text-decoration: none;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 5px;
    font-size: 15px;
    margin-left: 20px;
    background-color: #F0F4F8;height: 20px;}
.main>div>a:hover{ -webkit-transform: scale(0.9);    -moz-transform: scale(0.9); -o-transform: scale(0.9);}
.footer {
	background: #9CF;
	width: 100%;
	/*height: 40px;*/
	color: #e1efff;
	line-height: 32px;
	letter-spacing: 1px;
	text-align: center;
	clear: both;
	left: 0;
	background-color: #fff;
	 display:block;
}
</style>
</head>
<body>
<div class="header">
   <!-- 通用头部 开始-->
<?php echo W('Header',array('template'=>'Yocms_header_3'));?>
<!-- 通用头部 结束-->
</div>
<div class="content">
    <div class="main">
	<div style="display:block;height: 37px;"><a href="<?php echo U('Index/index@share');?>" title="新热榜">新热榜</a>
	<a style="background-color: #8E9AA6;color: #fff;" href="<?php echo U('Article/index@share');?>" title="信息爆炸的年代 , 每一次浏览都是与人擦肩而过">行人说</a>
	<a class="Yocms_user_add_article_2_toggle" style="background-color: #84A42B;
    border: 1px solid #8aab30;
    color: #FFF;
    display: inline-block;
    height: 20px;
    line-height: 20px;
    text-align: center;
    width: 134px;
    float: right;
    font-size: 14px;text-decoration: none;padding: 5px;" href="javascrip:;" title="此刻的心情最该与人邂逅">+ &nbsp;说一说</a>
	</div>
	<!-- 分享列表 开始-->
	<style type="text/css">.Yocms_image_list_90 .header{display:none}</style>
       <?php echo W('ListArticle',array('template'=>'Yocms_list_90','condition'=>$condition,'page'=>array('page_size'=>50),'page_template'=>1));?>
	   <!-- 分享列表 结束-->
  </div>
</div>
<div class="footer">
<!-- 通用尾部 开始-->
<?php echo W('Footer');?>
<!-- 通用尾部 结束-->
</div>
<?php echo W('AddArticle',array('template'=>'Yocms_user_add_article_2','action_url'=>U('Article/add_article@share')));?>
<style type="text/css">#Yocms_user_add_article_2{display:none;position: absolute;}</style>
</body>
</html>