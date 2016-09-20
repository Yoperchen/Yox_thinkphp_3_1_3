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
<h2>头部</h2>
<br><br>
<h2>Yocms_header_1</h2>
<?php echo W('Header',array('template'=>'Yocms_header_1','condition'=>array('site_id'=>1)));?><br>
<h2>Yocms_header_2</h2>
<!--<?php echo W('Header',array('template'=>'Yocms_header_2','condition'=>array('site_id'=>1)));?><br>-->
<?php echo W('Header',array('template'=>'Yocms_header_2','css'=>'w415_pink','condition'=>array('site_id'=>1)));?><br>
<h2>Yocms_header_3</h2>
<?php echo W('Header',array('template'=>'Yocms_header_3','condition'=>array('site_id'=>1)));?><br>
</body>
</html>