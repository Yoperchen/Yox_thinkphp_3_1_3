<?php if (!defined('THINK_PATH')) exit();?>订单确认页
<?php echo (($data['name'])?($data['name']):'无name'); ?><br/>
<?php echo (($data['site_id'])?($data['site_id']):'无site_id'); ?><br/>
<?php echo (($data['order_num'])?($data['order_num']):'无order_num'); ?><br/>
<?php echo (($data['goods_id'])?($data['goods_id']):'无goods_id'); ?><br/>
<?php echo (($data['buy_quantity'])?($data['buy_quantity']):'无buy_quantity'); ?><br/>

<?php echo (($data['address'])?($data['address']):'无address'); ?><br/>
<?php echo (($data['mobile'])?($data['mobile']):'无mobile'); ?><br/>

<?php echo (($data['total_price'])?($data['total_price']):'无total_price'); ?><br/>
<?php echo (($data['pay_price'])?($data['pay_price']):'无pay_price'); ?><br/>
<a target="_blank" href="<?php echo U('Order/index@Home',array('goods_id'=>$data['goods_id'],'buy_quantity'=>1));?>">去支付</a>