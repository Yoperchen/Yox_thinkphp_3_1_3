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
<h2>导航Navigation</h2>
<?php echo W('Navigation',array('template'=>'Navigation','condition'=>array('site_id'=>1),'page_template'=>'0'));?><br>
<br><br>
<h2>导航Navigation2</h2>
<?php echo W('Navigation',array('template'=>'Navigation2','condition'=>array('site_id'=>1),'page_template'=>'0'));?><br>
<h2>导航Yocms_navigation_200</h2>
<?php echo W('Navigation',array('template'=>'Yocms_navigation_200','condition'=>array('site_id'=>1),'page_template'=>'0'));?><br>
<h2>导航Yocms_navigation_201</h2>
<?php echo W('Navigation',array('template'=>'Yocms_navigation_201','condition'=>array('site_id'=>1),'page_template'=>'0'));?><br>
<h2>导航Yocms_navigation_202</h2>
<?php echo W('Navigation',array('template'=>'Yocms_navigation_202','condition'=>array('site_id'=>1),'page_template'=>'0'));?><br>
<h2>导航Yocms_navigation_203</h2>
<?php echo W('Navigation',array('template'=>'Yocms_navigation_203','condition'=>array('site_id'=>1),'page_template'=>'0'));?><br>
<h2>导航Yocms_navigation_204</h2>
<?php echo W('Navigation',array('template'=>'Yocms_navigation_204','condition'=>array('site_id'=>1),'page_template'=>'0'));?><br>
<h2>导航Yocms_navigation_205</h2>
<?php echo W('Navigation',array('template'=>'Yocms_navigation_205','condition'=>array('site_id'=>1),'page_template'=>'0'));?><br>
</body>
</html>