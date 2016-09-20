<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script type="text/javascript" src="__PUBLIC__/js/jquery.min.js"></script>
<title>商品管理</title>
</head>
<body>
<h1>订单管理</h1>
<form action="<?php echo U('Admin/Order/list_order');?>" method="post">
<table>
	<tr>
	<td>订单号</td>
	<td><input type="text" name="order_num" value=""></td>
	<td>日期搜索：</td>
	<td><input type="text" name="add_time1" value="<?php echo ($_REQUEST['add_time1']); ?>"> - <input type="text" name="add_time2" value="<?php echo ($_REQUEST['add_time2']); ?>"></td>
	<td></td>
	<td></td>
	</tr>
	<tr>
	<td>站点</td>
	<td><?php echo W('ListSite',array('template'=>'admin_select_ListSite','select_id'=>I('param.site_id','','int')));?></td>
	<td>商家</td>
	<td><?php echo W('ListShowStores',array('template'=>'admin_select_ListShowStores','select_id'=>I('param.store_id','','int')));?></td>
	<td>订单状态</td>
	<td><select>
		<option value="">请选择..</option>
		<option value="0">等待卖家付款</option>
		<option value="1">支付成功</option>
		<option value="2">支付失败</option>
		<option value="3">取消</option>
		<option value="9">已完成</option>
	</select></td>
	</tr>
	<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td><input type="submit" value="搜索"></td>
	</tr>
</table>
</form>
<table>
	<tr>
		<th>订单号</th><th>订单名称</th><th>手机号</th><th>订单状态</th><th>操作</th>
	</tr>
	<?php if(is_array($order_list_result["data"]["list"])): foreach($order_list_result["data"]["list"] as $key=>$order): ?><tr>
		<td><?php echo ($order["order_num"]); ?></td>
		<td><?php echo ($order["name"]); ?></td>
		<td><?php echo ($order["mobile"]); ?></td>
		<td><?php echo ($order["status"]); ?></td>
		<td><a href="<?php echo U('Admin/Order/detail_order',array('order_id'=>$order[order_id]));?>">详细</a>
		<a href="<?php echo U('Admin/Order/detail_order',array('is_export'=>1,'order_id'=>$order['order_id']));?>">导出</a></td>
		</tr><?php endforeach; endif; ?>
</table>
</body>
</html>