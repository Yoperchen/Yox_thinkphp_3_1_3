<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="__PUBLIC__/js/require.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/main.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>test</title>
</head>
<body>
<h1>test</h1>
<h2>文章详情Yocms_detail_1</h2>
<?php echo W('DetailArticle',array('template'=>'Yocms_detail_1','condition'=>array('article_id'=>30),'page_template'=>'0'));?><br>
<h2>文章列表Yocms_list_90</h2>
<?php echo W('ListArticle',array('template'=>'Yocms_list_90','page_template'=>'0'));?><br>
<h2>文章列表Yocms_list_91</h2>
<?php echo W('ListArticle',array('template'=>'Yocms_list_91','page_template'=>'0'));?><br>
<h2>文章列表Yocms_list_92</h2>
<?php echo W('ListArticle',array('template'=>'Yocms_list_92','page_template'=>'0'));?><br>
<h2>文章列表Yocms_list_93</h2>
<?php echo W('ListArticle',array('template'=>'Yocms_list_93','css'=>'','page_template'=>'0'));?><br>
<h2>文章列表Yocms_list_94</h2>
<?php echo W('ListArticle',array('template'=>'Yocms_list_94','page_template'=>'0'));?><br>
<h2>文章列表Yocms_list_95</h2>
<?php echo W('ListArticle',array('template'=>'Yocms_list_95','css'=>'whp_dark','page_template'=>'0'));?><br>
<h2>文章列表Yocms_image_list_88</h2>
<?php echo W('ListArticle',array('template'=>'Yocms_image_list_88','page_template'=>'0'));?><br>
<h2>文章列表Yocms_image_list_89</h2>
<?php echo W('ListArticle',array('template'=>'Yocms_image_list_89','page_template'=>'0'));?><br>
<h2>文章列表Yocms_image_list_90</h2>
<?php echo W('ListArticle',array('template'=>'Yocms_image_list_90','page_template'=>'0'));?><br>
<h2>文章列表Yocms_image_list_91</h2>
<?php echo W('ListArticle',array('template'=>'Yocms_image_list_91','page_template'=>'0'));?><br>
<h2>文章列表Yocms_image_list_92</h2>
<?php echo W('ListArticle',array('template'=>'Yocms_image_list_92','page_template'=>'0'));?><br>
<h2>文章列表Yocms_image_list_93</h2>
<?php echo W('ListArticle',array('template'=>'Yocms_image_list_93','page_template'=>'0'));?><br>
<h2>添加文章Yocms_user_add_article_2</h2>
<?php echo W('AddArticle',array('template'=>'Yocms_user_add_article_2','css'=>'w750_gray','page_template'=>'0'));?><br>
<br><br>
</body>
</html>