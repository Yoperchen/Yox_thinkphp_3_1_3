<?php if (!defined('THINK_PATH')) exit();?><link href="__PUBLIC__/Widget/ListOrder/ListOrder/ListOrder_<?php echo (($css)?($css):'w1200'); ?>.css" rel="stylesheet"/>
<div id="ListOrder">
<div class="header">
	<span style="color:#357ebd;font-size:15px;width:200px;float:left;font-family: cursive;">订单</span>
	<span class="close" id="ListOrder_toggle" title="关闭">x</span>
</div>
<table class="gridtable">
	<tr>
		<?php if($css == 'w1200'): ?><th>订单ID</th><?php endif; ?>
		<th>订单编号</th>
		<?php if($css == 'w1200'): ?><th>支付者</th>
		<th>收款商家</th>
		<th>购买数量</th>
		<th>订单名称</th><?php endif; ?>
		<th>总价</th>
		<th>支付金额</th>
		<th>使用余额</th>
		<th>使用积分</th>
		<th>优惠券价值</th>
		<th>交换物</th>
		<th>支付方式</th>
		<th>状态</th>
		<th>操作</th>
	</tr>
	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($i % 2 );++$i;?><tr>
		<?php if($css == 'w1200'): ?><td><?php echo ($order['id']); ?></td><?php endif; ?>
		<td><?php echo ($order['order_num']); ?></td>
		<?php if($css == 'w1200'): ?><td><?php echo ($order['pay_money_user_id']); ?></td>
		<td><?php echo ($order['get_money_store_id']); ?></td>
		<td><?php echo ($order['buy_quantity']); ?></td>
		<td><?php echo ($order['name']); ?></td><?php endif; ?>
		<td><?php echo ($order['total_price']); ?></td>
		<td><?php echo ($order['pay_price']); ?></td>
		<td><?php echo (($order['use_funds'])?($order['use_funds']):'无'); ?></td>
		<td><?php echo (($order['use_integral'])?($order['use_integral']):'无'); ?></td>
		<td><?php echo (($order['user_coupon'])?($order['user_coupon']):'无'); ?></td>
		<td><?php echo (($order['pay_goods_id'])?($order['pay_goods_id']):'无'); ?></td>
		<td><?php echo (($order['payment_method'])?($order['payment_method']):'未知'); ?></td>
		<td><?php echo ($order['status']); ?></td>
		<td>
		<a href="">详情</a>&nbsp;|&nbsp;
		<?php if($order['status'] != 9): ?><a href="">确认收货</a>
		<?php else: ?>
		<a href="">投诉</a><?php endif; ?>
		</td>
	</tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>
<div class="Yocms_page">
<!-- 分页 -->
<?php if($page_template == '' OR $page_template == 0): ?><!-- 不显示分页0 -->
<?php elseif($page_template == 1): ?>
<!-- 分页模版1 -->
<?php echo ($page['page_str']); ?>
<style type="text/css">
.Yocms_page{clear: both;text-align: center;width: 100%;height: 30px;line-height: 30px;display: block;}
.Yocms_page a{}
.Yocms_page span{}
.Yocms_page .current{}
</style>
<?php elseif($page_template == 2): ?>
<style type="text/css">
.Yocms_next_page{background-color: #e1e1e1;
    width: 100%;
    display: block;
    height: 35px;
    vertical-align: middle;
    line-height: 35px;
    color: #514F4F;
    text-decoration: none;
	}
</style>
<a class="Yocms_next_page" href="#">下一页</a>
<!-- 分页模版2 -->
<?php else: ?>
<!-- 默认分页模版 -->
<?php echo ($page['page_str']); endif; ?>
</div> 
<div class="footer">列表板块</div>
</div>
<script>
//显示隐藏，id一般为widget内使用,类widget外使用
$("#ListOrder_toggle,.ListOrder_toggle,#ListOrder_close,.ListOrder_close,#ListOrder_open,.ListOrder_open").live("click",function(event){
	$("#ListOrder").css("top",$(document).scrollTop()+50);
	$("#ListOrder").css("left",($(window).width())/4);
	$("#ListOrder").css("position","absolute");
	$("#ListOrder").toggle();
})
</script>