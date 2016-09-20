<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" type="text/css" href="__PUBLIC__/Widget/ListArticle/Yocms_list_95/Yocms_article_list_95_<?php echo (($css)?($css):'whp_pink'); ?>.css">
<div class="Yocms_article_list_95" id="Yocms_article_list_95">
<!--	<div class="header">
		<span style="color:#357ebd;font-size:15px;width:200px;float:left;font-family: cursive;">热点</span>
		<span class="close" id="Yocms_article_list_95_toggle" title="关闭">x</span>
	</div>-->
	<dl>
	<?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "暂时没有数据" ;else: foreach($__LIST__ as $key=>$article): $mod = ($k % 2 );++$k;?><!-- <dt>[<a href="/index.php?s=/Index/xinwen.html" target="_blank" onclick="">新闻</a>]</dt> -->
        <dd><a href="<?php echo (($article['url'])?($article['url']):U('Article/article_detail@'.$application,array('article_id'=>$article['id']))); ?>" target="_blank" class="yd-black" onclick=""><?php echo (($article['title'])?($article['title']):'标题'); ?></a></dd>
        <!--  <dd class="more"><a href="/index.php?s=/Index/xinwen.html" target="_blank" onclick="">更多»</a></dd>--><?php endforeach; endif; else: echo "暂时没有数据" ;endif; ?>
	</dl>
	<input id="article_id" type="hidden" name="article_id" value="0">
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
	if(typeof(Yocms_article_list_95_is_load)=="undefined"){
		$("body").append('<script src="__PUBLIC__/Widget/ListArticle/Yocms_list_95/Yocms_article_list_95.js" type="text/javascript"><\/script>');
	}
});
</script>