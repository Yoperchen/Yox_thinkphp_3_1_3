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
<h2>社区列表</h2>
<br><br>
<h2>城市列表Yocms_list_city</2>
<?php echo W('ListDistrict',array('condition'=>array('group'=>'city_alphabet'),'template'=>'Yocms_list_city'));?><br>
<h2>社区列表ListDistrict</2>
<?php echo W('ListDistrict',array('condition'=>array('group'=>'province_alphabet'),'template'=>'ListDistrict'));?><br>
<h2>社区列表admin_store_select_community</2>
<?php echo W('ListDistrict',array('template'=>'admin_store_select_district'));?><br>
<h2>社区列表Yocms_list_90</2>
<?php echo W('ListDistrict',array('template'=>'Yocms_list_90'));?><br>
<h2>社区列表Yocms_list_select_90</2>
<?php echo W('ListDistrict',array('template'=>'Yocms_list_select_90'));?><br>

<br><br>

</body>
</html>