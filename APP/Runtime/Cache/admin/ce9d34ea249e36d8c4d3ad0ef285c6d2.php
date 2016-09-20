<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" type="text/css" href="__PUBLIC__/Widget/ListDistrict/admin_store_select_district/admin_store_select_district_<?php echo (($css)?($css):'w1200_gray'); ?>.css">
<div id="admin_store_select_district" class="admin_store_select_district">
	<div class="header">
			<span style="color:#357ebd;font-size:15px;width:200px;float:left;font-family: cursive;">热点</span>
			<span class="close" id="admin_store_select_district_toggle" title="关闭">x</span>
		</div>
	<form action="<?php echo (($action_url)?($action_url):'/'); ?>" method="post">
	<select name="district_id">
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$district): $mod = ($i % 2 );++$i;?><option value="<?php echo ($district['id']); ?>" <?php if(($district["id"]) == $select_id): ?>selected<?php endif; ?>><?php echo ($district['name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
	</select>
	</form>
	<div class="footer">列表板块</div>
</div>
<script>
require(['jquery'], function($){
	if(typeof(admin_store_select_district_is_load)=="undefined"){
		$("body").append('<script src="__PUBLIC__/Widget/ListDistrict/admin_store_select_district/admin_store_select_district.js" type="text/javascript"><\/script>');
	}
});
</script>