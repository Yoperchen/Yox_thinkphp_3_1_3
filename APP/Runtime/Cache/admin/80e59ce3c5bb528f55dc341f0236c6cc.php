<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" type="text/css" href="__PUBLIC__/Widget/ListDistrict/ListDistrict/ListDistrict_<?php echo (($css)?($css):'w1200_gray'); ?>.css">
<div id="ListDistrict" class="ListDistrict">
	<div class="header">
			<span style="color:#357ebd;font-size:15px;width:75px;float:left;font-family: cursive;    line-height: 55px;">地点</span>
			<span class="close" id="ListDistrict_toggle" title="关闭">x</span>
		</div>
	<!--  <form action="<?php echo (($action_url)?($action_url):'/'); ?>" method="post">-->
	<!-- TAB代码 开始 -->
	<div id="tab">
	  <div class="tabList">
		<ul>
			<li id="province_tab">省份</li>
			<li id="city_tab">城市</li>
			<li id="district_tab">区</li>
			<!--<li>售后保障</li>-->
		</ul>
	  </div>
	  <div class="tabCon">
		<div id="province_list">
			<dl>
			   <?php if(is_array($list["l1"])): $i = 0; $__LIST__ = $list["l1"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$districts): $mod = ($i % 2 );++$i;?><dt><?php echo ($key); ?></dt>
				<dd>
				<?php if(is_array($districts)): $k = 0; $__LIST__ = $districts;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$district): $mod = ($k % 2 );++$k;?><a title="<?php echo ($district["name"]); ?>" data-district-id="<?php echo ($district["id"]); ?>"><?php echo ($district["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
				</dd><?php endforeach; endif; else: echo "" ;endif; ?>
			</dl>
		</div>
		<div id="city_list">
			<?php if(is_array($list["l2"])): $i = 0; $__LIST__ = $list["l2"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$l2): $mod = ($i % 2 );++$i;?><dl id="<?php echo ($key); ?>" style="display:none">
				<dt><?php echo ($l2["up_info"]["name"]); ?></dt>
				<dd>
				<?php if(is_array($l2["district"])): $i = 0; $__LIST__ = $l2["district"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$district): $mod = ($i % 2 );++$i;?><a data-district-id="<?php echo ($district["id"]); ?>"><?php echo ($district["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
				</dd>
			</dl><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
		<div id="district_list">
		<?php if(is_array($list["l3"])): $i = 0; $__LIST__ = $list["l3"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$l3): $mod = ($i % 2 );++$i;?><dl id="<?php echo ($key); ?>" style="display:none">
				<dt><?php echo ($l3["up_info"]["name"]); ?></dt>
				<dd>
				<?php if(is_array($l3["district"])): $i = 0; $__LIST__ = $l3["district"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$district): $mod = ($i % 2 );++$i;?><a data-district-id="<?php echo ($district["id"]); ?>"><?php echo ($district["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
				</dd>
			</dl><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
		<div>服务承诺：<br/>零零糖平台卖家销售并发货的商品，由平台卖家提供发票和相应的售后服务。请您放心购买！ </div>
	  </div>
	</div>
	<!-- TAB代码 结束 -->
	<!--  </form>-->
	<div class="footer">列表板块</div>
</div>
<script>
require(['jquery'], function($){
	if(typeof(ListDistrict_is_load)=="undefined"){
		$("body").append('<script src="__PUBLIC__/Widget/ListDistrict/ListDistrict/ListDistrict.js" type="text/javascript"><\/script>');
	}
});
</script>