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
<h2>商品列表Yocms_list_90</h2>
<?php echo W('ListGoods',array('template'=>'Yocms_list_90','condition'=>array('goods_id'=>1),'page_template'=>'0'));?><br>
<h2>商品列表Yocms_image_list_90</h2>
<?php echo W('ListGoods',array('template'=>'Yocms_image_list_90','condition'=>array('goods_id'=>1),'page_template'=>'0'));?><br>
<h2>商品列表Yocms_image_list_91</h2>
<?php echo W('ListGoods',array('template'=>'Yocms_image_list_91','condition'=>array('goods_id'=>1),'page_template'=>'0'));?><br>

<h2>商品详情Yocms_image_list_92</h2>
<?php echo W('DetailGoods',array('template'=>'Yocms_image_list_92','condition'=>array('goods_id'=>1),'page_template'=>'0'));?><br>
<h2>商品详情Yocms_detail_1</h2>
<?php echo W('DetailGoods',array('template'=>'Yocms_detail_1','condition'=>array('goods_id'=>1),'page_template'=>'0'));?><br>
<br><br>
</body>
</html>