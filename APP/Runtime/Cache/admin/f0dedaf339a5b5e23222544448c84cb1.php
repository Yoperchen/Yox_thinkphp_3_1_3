<?php if (!defined('THINK_PATH')) exit();?><style type="text/css">
.Yocms_list_90 *{margin:0;padding:0;}
.Yocms_list_90{border: 1px solid #ccc;border-radius: 20px;display:block;margin:0 auto; width:98%; position:relative;clear:both;overflow:auto}
.Yocms_list_90 .header{border-bottom: 1px solid #357ebd;width: 100%;height: 55px;border-top-left-radius: 25px;border-top-right-radius: 25px;}
.Yocms_list_90 span {height: 30px;font-size: 15px;margin: 10px;padding: 2px;display: block;float: left;width: 110px;text-align: left;line-height: 35px;}
.Yocms_list_90 .close{color:red;font-size:30px;width:45px;height:45px;float:right;font-family: cursive;cursor: pointer;border-radius: 20px;text-align: center;margin-top: 6px;}
.Yocms_list_90 .close:hover{background-color: #9c9c9c;}
.Yocms_list_90 li{list-style:none;width: 100%;}img{border:none;}em{font-style:normal;}
.Yocms_list_90 a{color:#555;text-decoration:none;outline:none;blr:this.onFocus=this.blur();}
.Yocms_list_90 a:hover{color:#000;text-decoration:underline;}
.Yocms_list_90 .clear{height:0;overflow:hidden;clear:both;}
.Yocms_list_90 h4{font-size:14px;height:27px;line-height:27px;padding-left:10px;border-bottom:#ddd 1px solid;}
.Yocms_list_90{width:98%;}
.Yocms_list_90 ul{padding:5px 10px;}
.Yocms_list_90 ul li{height:24px;line-height:24px;overflow:hidden;}
.Yocms_list_90 ul li span{height: 15px; line-height: 15px;padding: 0px;margin: 0px;    width: 75px;overflow: hidden;}
.Yocms_list_90 .footer{padding: 10px;font-size: 12px;color: #999;text-align: left;float: left;clear: both;border-bottom-left-radius: 25px;border-bottom-right-radius: 25px;width: 95%;}
</style>
<div class="Yocms_list_90" id="Yocms_list_order_90">
<div class="header">
	<span style="color:#357ebd;font-size:15px;width:200px;float:left;font-family: cursive;">文件</span>
	<span class="close" id="Yocms_list_order_90_toggle" title="关闭">x</span>
</div>
<ul>
		<li>
		<span>订单ID</span>
		<span style="width: 270px;">订单编号&nbsp;</span>
		<span>支付者&nbsp;</span>
		<span>收款商家&nbsp;</span>
		<span>购买数量&nbsp;</span>
		<span>订单名称&nbsp;</span>
		<span>总价&nbsp;</span>
		<span>支付金额&nbsp;</span>
		<span>使用余额&nbsp;</span>
		<span>使用积分&nbsp;</span>
		<span>优惠券价值&nbsp;</span>
		<span>物物交换&nbsp;</span>
		<span>支付方式&nbsp;</span>
		<span>订单状态</span>
		<span>操作</span>
		</li>
	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($i % 2 );++$i;?><li data-order-id="<?php echo ($order['id']); ?>">
		<span><?php echo ($order['id']); ?>&nbsp;</span>
		<span style="width: 270px;"><?php echo ($order['order_num']); ?> &nbsp;</span>
		<span><?php echo ($order['pay_money_user_id']); ?>&nbsp;</span>
		<span><?php echo ($order['get_money_store_id']); ?>&nbsp;</span>
		<span><?php echo ($order['buy_quantity']); ?>&nbsp;</span>
		<span><a title="" data-order-id="<?php echo ($order['id']); ?>" href="<?php echo U('Order/order_detail@Common',array('order_id'=>$order['id']));?>" target="_blank"><?php echo ($order['name']); ?></a>&nbsp;</span>
		<span><?php echo ($order['total_price']); ?>&nbsp;</span>
		<span><?php echo ($order['pay_price']); ?>&nbsp;</span>
		<span><?php echo ($order['use_funds']); ?>&nbsp;</span>
		<span><?php echo ($order['use_integral']); ?>&nbsp;</span>
		<span><?php echo ($order['user_coupon']); ?>&nbsp;</span>
		<span><?php echo ($order['pay_goods_id']); ?>&nbsp;</span>
		<span><?php echo ($order['payment_method']); ?>&nbsp;</span>
		<span><?php echo ($order['status']); ?>&nbsp;</span>
		<span><a href="">确认收货</a></span>
		</li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
<input id="order_id" type="hidden" name="order_id" value="0">
<div class="footer">列表板块</div>
</div>
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
<script>
//显示隐藏，id一般为widget内使用,类widget外使用
$("#Yocms_list_order_90_toggle,.Yocms_list_90_toggle,#Yocms_list_order_90_close,.Yocms_list_90_close,#Yocms_list_order_90_open,.Yocms_list_90_open").live("click",function(event){
	$("#Yocms_list_order_90").css("top",$(document).scrollTop()+50);
	$("#Yocms_list_order_90").css("left",($(window).width())/4);
	$("#Yocms_list_order_90").css("position","absolute");
	$("#Yocms_list_order_90").toggle();
})
</script>
<script>
$("#Yocms_list_order_90 ul li").live("click",function(){
	$("#Yocms_list_order_90 #order_id").val($(this).attr("data-order-id"));
})
</script>