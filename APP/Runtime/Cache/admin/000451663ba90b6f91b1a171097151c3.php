<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" type="text/css" href="__PUBLIC__/Widget/ListWebsite/Yocms_list_94/Yocms_website_list_94_<?php echo (($css)?($css):'w1000_pink'); ?>.css">
<div class="Yocms_website_list_94" id="Yocms_website_list_94">
<!--	<div class="header">
		<span style="color:#357ebd;font-size:15px;width:200px;float:left;font-family: cursive;">热点</span>
		<span class="close" id="Yocms_website_list_93_toggle" title="关闭">x</span>
	</div>-->
	<div>
		<span><a href="http://v.qq.com/search.html?pagetype=3&amp;stj2=search.smartbox&amp;stag=txt.smart_index&amp;ms_key=%E6%88%91%E5%92%8C%E5%83%B5%E5%B0%B8%E6%9C%89%E4%B8%AA%E7%BA%A6%E4%BC%9A" target="_blank" class="yd-black">我和僵尸有个约会</a></span>
		<span><a href="http://www.soku.com/" target="_blank" class="yd-black">优酷搜库</a></span>
		<span><a href="http://video.baidu.com/" target="_blank" class="yd-black">百度视频搜索</a></span>
        <span><a href="http://video.youdao.com/" target="_blank" class="yd-black">有道视频搜索</a></span>
        <span><a href="http://www.google.com.hk/videohp" target="_blank" class="yd-black">谷歌视频搜索</a></span>
        <span><a href="http://movie.gougou.com/" target="_blank" class="yd-black">狗狗影视搜索</a></span>
        <span><a href="http://video.sogou.com/" target="_blank" class="yd-black">搜狗视频搜索</a></span>
        <span><a href="http://www.gudemao.com" target="_blank" class="yd-">古德猫视频搜索</a></span>
	</div>
	<input id="website_id" type="hidden" name="website_id" value="0">
	<!--<div class="footer">列表板块</div>-->
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
	if(typeof(Yocms_website_list_94_is_load)=="undefined"){
		$("body").append('<script src="__PUBLIC__/Widget/ListWebsite/Yocms_website_list_94/Yocms_website_list_94.js" type="text/javascript"><\/script>');
	}
});
</script>