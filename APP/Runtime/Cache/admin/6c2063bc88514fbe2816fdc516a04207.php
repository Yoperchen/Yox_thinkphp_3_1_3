<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<script src="__PUBLIC__/js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="__PUBLIC__/plugins/ckeditor/ckeditor.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>test</title>
</head>
<body>
<h1>test</h1>

<h2>订单列表ListOrder w750</h2>
<?php echo W('ListOrder',array('template'=>'ListOrder','css'=>'w750','condition'=>$condition,'page_template'=>'0'));?>
<!-- 
<h2>订单列表ListOrder w1200</h2>
<?php echo W('ListOrder',array('template'=>'ListOrder','css'=>'w1200','condition'=>$condition,'page_template'=>'0'));?>
 -->
<h2>订单列表Yocms_list_90</h2>
<?php echo W('ListOrder',array('template'=>'Yocms_list_90','condition'=>$condition,'page_template'=>'0'));?>
<h2>订单列表admin_store_ListOrder</h2>
<?php echo W('ListOrder',array('template'=>'admin_store_ListOrder','condition'=>$condition,'page_template'=>'0'));?>
<h2>订单</h2>
<?php echo W('DetailOrder',array('template'=>'DetailOrder','condition'=>array('order_id'=>34)));?><br>
<?php echo U('Order/return_url@Home');?>
<br><br>
</body>
</html>