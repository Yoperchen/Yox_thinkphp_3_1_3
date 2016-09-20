<?php if (!defined('THINK_PATH')) exit();?><table>
<tr>
	<td>订单ID</td>
	<td>订单编号</td>
	<td>支付用户</td>
	<td>收款商家</td>
	<td>购买数量</td>
	<td>订单名称</td>
	<td>订单总价</td>
	<td>支付金额</td>
	<td>使用站点余额</td>
	<td>使用积分</td>
	<td>使用优惠券价值</td>
	<td>交换物品</td>
	<td>支付方式</td>
	<td>订单状态</td>
	<td>操作</td>
</tr>
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($i % 2 );++$i;?><tr>
	<td><?php echo ($order['order_id']); ?></td>
	<td><?php echo ($order['order_num']); ?></td>
	<td><?php echo ($order['pay_money_user_id']); ?></td>
	<td><?php echo ($order['get_money_store_id']); ?></td>
	<td><?php echo ($order['buy_quantity']); ?></td>
	<td><?php echo ($order['name']); ?></td>
	<td><?php echo ($order['total_price']); ?></td>
	<td><?php echo ($order['pay_price']); ?></td>
	<td><?php echo ($order['use_funds']); ?></td>
	<td><?php echo ($order['use_integral']); ?></td>
	<td><?php echo ($order['user_coupon']); ?></td>
	<td><?php echo ($order['pay_goods_id']); ?></td>
	<td><?php echo ($order['payment_method']); ?></td>
	<td><?php echo ($order['status']); ?></td>
	<td><a href="#">修改</a>&nbsp;<a href="#">删除</a></td>
</tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>