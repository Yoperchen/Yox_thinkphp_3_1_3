<?php if (!defined('THINK_PATH')) exit();?><link href="__PUBLIC__/Widget/Navigation/Yocms_navigation_202/Yocms_navigation_202_<?php echo (($css)?($css):'w750_gray'); ?>.css" rel="stylesheet"/>
<div id="Yocms_navigation_202" class="Yocms_navigation_202">
	<ul>
	<?php if(is_array($list)): foreach($list as $key=>$navigation): ?><li><a title="<?php echo (($navigation['description'])?($navigation['description']):$navigation['name']); ?>" href="<?php echo ($navigation['url']); ?>"><?php echo ($navigation['name']); ?></a></li><?php endforeach; endif; ?>
	<!-- <li><a href="#">企业文化</a></li>
	<li><a href="#">产品展示</a></li>
	<li><a href="#">新闻中心</a></li>
	<li><a href="#">阳光服务</a></li>
	<li><a href="#">加盟代理</a></li>
	<li><a href="#">在线咨询</a></li> -->
	</ul>
	<div class="cls"></div>
</div>
<script src="__PUBLIC__/Widget/Navigation/Yocms_navigation_202/Yocms_navigation_202.js" type="text/javascript"></script>