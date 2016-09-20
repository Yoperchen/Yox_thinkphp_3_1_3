<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" type="text/css" href="__PUBLIC__/Widget/ListWebsite/Yocms_list_95/Yocms_website_list_95_<?php echo (($css)?($css):'whp_pink'); ?>.css">
<div class="Yocms_website_list_95" id="Yocms_website_list_95">
<!--	<div class="header">
		<span style="color:#357ebd;font-size:15px;width:200px;float:left;font-family: cursive;">热点</span>
		<span class="close" id="Yocms_website_list_95_toggle" title="关闭">x</span>
	</div>-->
	<dl>
         <dt>[<a href="<?php echo (($Yocms_data["url"])?($Yocms_data["url"]):'http://www.linglingtang.com'); ?>" target="_blank" onclick=""><?php echo (($Yocms_data["title"])?($Yocms_data["title"]):'标题'); ?></a>]</dt>
         <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$website): $mod = ($i % 2 );++$i;?><dd><a href="<?php echo ($website["url"]); ?>" title="<?php echo ($website["name"]); ?>" target="_blank" class="yd-black" onclick=""><?php echo (($website["short_name"])?($website["short_name"]):$website.name); ?></a></dd><?php endforeach; endif; else: echo "" ;endif; ?>
             <dd class="more"><a href="<?php echo (($Yocms_data["url"])?($Yocms_data["url"]):'http://www.linglingtang.com); ?>" target="_blank" onclick="">更多»</a></dd>
             <!-- 
         <dt>[<a href="/index.php?s=/Index/xiaoshuo.html" target="_blank" onclick="">小说</a>]</dt>
             <dd><a href="http://www.cc222.com/union/url/?uId=182" target="_blank" class="yd-" onclick="">烟雨红尘</a></dd>
             <dd><a href="http://www.qidian.com/" target="_blank" class="yd-" onclick="">起点中文网</a></dd>
             <dd><a href="http://www.hongxiu.com/" target="_blank" class="yd-" onclick="">红袖添香</a></dd>
             <dd><a href="http://www.xxsy.net/" target="_blank" class="yd-" onclick="">潇湘书院</a></dd>
             <dd><a href="http://book.6164.com" target="_blank" class="yd-" onclick="">言情小说</a></dd>
             <dd><a href="http://book.sina.com.cn/" target="_blank" class="yd-" onclick="">新浪读书</a></dd>
             <dd class="more"><a href="/index.php?s=/Index/xiaoshuo.html" target="_blank" onclick="">更多»</a></dd>

         <dt>[<a href="/index.php?s=/Index/yinyue.html" target="_blank" onclick="">音乐</a>]</dt>
             <dd><a href="http://www.koowo.com/mbox.down2?src=kwun0271" target="_blank" class="yd-" onclick="">酷我音乐盒</a></dd>
             <dd><a href="http://music.baidu.com/" target="_blank" class="yd-" onclick="">百度音乐</a></dd>
             <dd><a href="http://www.1ting.com/" target="_blank" class="yd-" onclick="">一听音乐网</a></dd>
             <dd><a href="http://www.google.cn/music/homepage" target="_blank" class="yd-" onclick="">谷歌音乐</a></dd>
             <dd><a href="http://www.xiami.com/" target="_blank" class="yd-" onclick="">虾米音乐</a></dd>
             <dd><a href="http://www.kugou.com/" target="_blank" class="yd-" onclick="">酷狗音乐</a></dd>
             <dd class="more"><a href="/index.php?s=/Index/yinyue.html" target="_blank" onclick="">更多»</a></dd>

         <dt>[<a href="/index.php?s=/Index/youxi.html" target="_blank" onclick="">游戏</a>]</dt>
             <dd><a href="http://hd.51wan.com/33288p14003q667j0.html" target="_blank" class="yd-red" onclick="">范特西篮球2</a></dd>
             <dd><a href="http://www.17173.com/" target="_blank" class="yd-black" onclick="">17173</a></dd>
             <dd><a href="http://hd.51wan.com/33288p14003q646j0.html" target="_blank" class="yd-black" onclick="">暗黑三国</a></dd>
             <dd><a href="http://hd.51wan.com/33288p14003q638j0.html" target="_blank" class="yd-black" onclick="">英雄战姬</a></dd>
             <dd><a href="http://hd.51wan.com/33288p14003q665j0.html" target="_blank" class="yd-green" onclick="">圣火令</a></dd>
             <dd><a href="http://hd.51wan.com/33288p14003q620j0.html" target="_blank" class="yd-black" onclick="">攻城掠地</a></dd>
             <dd class="more"><a href="/index.php?s=/Index/youxi.html" target="_blank" onclick="">更多»</a></dd>

         <dt>[<a href="/index.php?s=/Index/shequ.html" target="_blank" onclick="">社区</a>]</dt>
             <dd><a href="http://www.tianya.cn/" target="_blank" class="yd-" onclick="">天涯社区</a></dd>
             <dd><a href="http://bbs.163.com/" target="_blank" class="yd-" onclick="">网易论坛</a></dd>
             <dd><a href="http://tieba.baidu.com/" target="_blank" class="yd-" onclick="">百度贴吧</a></dd>
             <dd><a href="http://dzh.mop.com/" target="_blank" class="yd-" onclick="">猫扑大杂烩</a></dd>
             <dd><a href="http://www.douban.com/" target="_blank" class="yd-" onclick="">豆瓣</a></dd>
             <dd><a href="http://www.renren.com/" target="_blank" class="yd-" onclick="">人人网</a></dd>
             <dd class="more"><a href="/index.php?s=/Index/shequ.html" target="_blank" onclick="">更多»</a></dd>
              -->
     </dl>
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
<?php echo ($page['page_str']);  endif; ?>
</div> 
<script>
require(['jquery'], function($){
	if(typeof(Yocms_website_list_95_is_load)=="undefined"){
		$("body").append('<script src="__PUBLIC__/Widget/ListWebsite/Yocms_list_95/Yocms_website_list_95.js" type="text/javascript"><\/script>');
	}
});
</script>