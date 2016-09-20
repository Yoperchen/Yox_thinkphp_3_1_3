<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" type="text/css" href="__PUBLIC__/Widget/WidgetHeader/WidgetHeader_2/WidgetHeader_2_<?php echo (($css)?($css):'whp_gray'); ?>.css">
<div class="WidgetHeader_2">
<h2>
	<?php if(is_array($Yocms_data["list"])): $k = 0; $__LIST__ = $Yocms_data["list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$title): $mod = ($k % 2 );++$k; if($k != 1): ?><span class="spline">-</span><?php endif; ?>
	<a title="<?php echo (($title["description"])?($title["description"]):$title['title']); ?>" href="<?php echo (($title["src"])?($title["src"]):'#'); ?>" target="_blank" onclick=""><?php echo ($title["title"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
</h2>
    <i class="dotline"></i>
</div>
<script>
require(['jquery'], function($){
	if(typeof(WidgetHeader_2_is_load)=="undefined"){
		$("body").append('<script src="__PUBLIC__/Widget/WidgetHeader/WidgetHeader_2/WidgetHeader_2.js" type="text/javascript"><\/script>');
	}
});
</script>