<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<script data-main="__PUBLIC__/js/main" type="text/javascript" src="__PUBLIC__/js/require.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>test</title>
</head>
<body>
<h1>test</h1>
<h2>评论列表Yocms_image_list_88</h2>
<?php echo W('ListComment',array('template'=>'Yocms_image_list_88','condition'=>array(),'page_template'=>'0'));?><br>
<h2>评论列表Yocms_image_list_94</h2>
<?php echo W('ListComment',array('template'=>'Yocms_image_list_94','condition'=>array(),'page_template'=>'0'));?><br>
<br><br>
<h2>添加评论Yocms_add_comment_1</h2>
<?php echo W('AddComment',array('template'=>'Yocms_add_comment_1'));?><br>
<br><br>
</body>
</html>