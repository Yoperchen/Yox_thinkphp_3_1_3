<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" type="text/css" href="__PUBLIC__/Widget/ListDistrict/Yocms_list_city/Yocms_list_city_<?php echo (($css)?($css):'w1200_gray'); ?>.css">
<div id="Yocms_list_city" class="Yocms_list_city" style="z-index:999999999">
	<div class="header">
			<span style="color:#357ebd;font-size:15px;width:75px;float:left;font-family: cursive;    line-height: 55px;">地点</span>
			<span class="close" id="Yocms_list_city_toggle" title="关闭">x</span>
		</div>
	<!--  <form action="<?php echo (($action_url)?($action_url):'/'); ?>" method="post">-->
	<!-- TAB代码 开始 -->
	<div id="tab">
	  <div class="tabList">
		<ul>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$alphabet): $mod = ($i % 2 );++$i;?><li <?php if($key == 'Hot'): ?>class="cur" style="color: #c52d2d;font-weight: 800;"<?php endif; ?>><?php echo ($key); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>
	  </div>
	  <div class="tabCon">
	  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$districts): $mod = ($i % 2 );++$i;?><div <?php if($key == 'Hot'): ?>class="cur"<?php endif; ?>>
			<dl>
			   
				<dt><?php echo ($key); ?></dt>
				<dd>
				<?php if(is_array($districts)): $k = 0; $__LIST__ = $districts;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$district): $mod = ($k % 2 );++$k;?><a title="<?php echo ($district["name"]); ?>" data-district-id="<?php echo ($district["id"]); ?>"><?php echo ($district["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
				</dd>
				
			</dl>
		</div><?php endforeach; endif; else: echo "" ;endif; ?>
	  </div>
	</div>
	<!-- TAB代码 结束 -->
	<!--  </form>-->
	<div class="footer">列表板块</div>
</div>
<script>
require(['jquery'], function($){
	if(typeof(Yocms_list_city_is_load)=="undefined"){
		$("body").append('<script src="__PUBLIC__/Widget/ListDistrict/Yocms_list_city/Yocms_list_city.js" type="text/javascript"><\/script>');
	}
});
</script>