<?php if (!defined('THINK_PATH')) exit();?><link href="__PUBLIC__/Widget/ListStore/ListStore/ListStore_<?php echo (($css)?($css):'w105_pink'); ?>.css" rel="stylesheet"/>
<div class="ListStore" id="ListStore">
<div class="header">
	<span style="">商家</span>
	<span class="close" id="ListStore_toggle" title="关闭">x</span>
</div>
<ul>
	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$store): $mod = ($i % 2 );++$i;?><li data-store-id="<?php echo ($store['id']); ?>"><a title="<?php echo ($store['store_name']); ?>" data-store-id="<?php echo ($store['id']); ?>" href="<?php echo U('store/store_detail@Common',array('store_id'=>$store['id']));?>" target="_blank"><?php echo ($store['store_name']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
<input id="store_id" type="hidden" name="store_id" value="0">
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
<script src="__PUBLIC__/Widget/ListStore/ListStore/ListStore.js" type="text/javascript"></script>