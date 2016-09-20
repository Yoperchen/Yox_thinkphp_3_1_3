<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" type="text/css" href="__PUBLIC__/Widget/ListDistrict/Yocms_list_90/Yocms_list_90_<?php echo (($css)?($css):'w1200_gray'); ?>.css">
<div class="Yocms_district_list_90" id="Yocms_district_list_90">
	<div class="header">
		<span style="color:#357ebd;font-size:15px;width:200px;float:left;font-family: cursive;">热点</span>
		<span class="close" id="Yocms_district_list_90_toggle" title="关闭">x</span>
	</div>
	<ul>
	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$district): $mod = ($i % 2 );++$i;?><li><a data-district-id="<?php echo ($district['id']); ?>" href="<?php echo U('district/district_detail@common',array('district_id'=>$district['id']));?>"><?php echo ($district['name']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
	</ul>
	<input id="district_id" type="hidden" name="district_id" value="0">
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
require(['jquery'], function($){
	if(typeof(Yocms_district_list_90_is_load)=="undefined"){
		$("body").append('<script src="__PUBLIC__/Widget/ListDistrict/Yocms_list_90/Yocms_list_90.js" type="text/javascript"><\/script>');
	}
});
</script>