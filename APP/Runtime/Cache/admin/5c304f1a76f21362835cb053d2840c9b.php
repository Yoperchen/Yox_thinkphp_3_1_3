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
<h2>商家列表ListStore</h2>
<?php echo W('ListStore',array('template'=>'ListStore','condition'=>array('belong_user_id'=>1),'page_template'=>'0'));?><br>
<h2>商家列表Yocms_list_90</h2>
<?php echo W('ListStore',array('template'=>'Yocms_list_90','condition'=>array('belong_user_id'=>1),'page_template'=>'0'));?><br>

<br><br>

</body>
</html>