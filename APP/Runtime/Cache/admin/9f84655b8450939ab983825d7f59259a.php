<?php if (!defined('THINK_PATH')) exit();?><link href="__PUBLIC__/Widget/AddArticle/Yocms_user_add_article_2/Yocms_user_add_article_2_<?php echo (($css)?($css):'w1200_gray'); ?>.css" rel="stylesheet"/>
<div id="Yocms_user_add_article_2" class="Yocms_user_add_article_2">
		<div class="header">
			<span style="color:#357ebd;font-size:15px;width:200px;height:45px;float:left;font-family: cursive;">分享新发现</span>
			<span class="close" id="Yocms_user_add_article_2_toggle" title="关闭">x</span>
		</div>
	<form action="<?php echo (($action_url)?($action_url):U('Article/add_article@'.$application)); ?>" method="post">
		<input type="hidden" name="op" value="add">
		<div class="line"><span class="title">标题:</span><input type="text" name="title" value="<?php echo ($data["title"]); ?>"><span class="title" id="Yocms_user_add_article_2_title_tip" style="color: red;">*必填</span></div>
		<!--<div><span>分类:</span><select name="type"><option value=""></option></select><span class="title" id="Yocms_user_add_article_2_category_tip" style="color: blue;"></span></div>-->
		<div class="line"><span class="title">类型:</span><select name="type"><option value="2">普通文章</option><option value="5">说一说</option><option value="4">日志</option><option value="3">论坛帖</option><option value="1">公告</option></select><span class="title" id="Yocms_user_add_article_2_type_tip" style="color: blue;"><!--1:公告;2:普通文章;3:论坛贴;4日志;5说说--></span></div>
		<div class="line"><span class="title">链接：</span><input type="text" name="url" value="<?php echo ($data["url"]); ?>"><span class="title" id="Yocms_user_add_article_2_url_tip" style="color: blue;"></span></div>
		<div class="line"><span class="title">图片地址:</span><input type="text" name="img1" value="<?php echo ($data["img1"]); ?>"><span class="title" id="Yocms_user_add_article_2_img1_tip" style="color: blue;"></span></div>
		<div class="line"><span class="title">图片预览:</span><img id="Yocms_user_add_article_2_show_img" height="100" src="<?php echo ($data["img1"]); ?>"></div>
		<div class="line"><span class="title">描述：</span><textarea name="desc"><?php echo ($data["desc"]); ?></textarea><span class="title" id="Yocms_user_add_article_2_desc_tip" style="color: blue;"></span></div>
		<div  class="line" style="height:380px"><span class="title">内容：</span><textarea id="article_editor" name="content"><?php echo ($data["content"]); ?></textarea><span class="title" id="Yocms_user_add_article_2_content_tip" style="color: blue;"></span></div>
		<div class="line"><input type="submit" value="添加"></div>
	</form>
	<div class="footer">添加内容板块</div>
</div>
<!-- <script src="__PUBLIC__/Widget/AddArticle/Yocms_user_add_article_2/Yocms_user_add_article_2.js" type="text/javascript"></script> -->
<script type="text/javascript" src="/Public/plugins/ckeditor/ckeditor.js"></script>
<script>
require(['jquery'], function($){
	if(typeof(Yocms_user_add_article_is_load)=="undefined"){
		$("body").append('<script src="__PUBLIC__/Widget/AddArticle/Yocms_user_add_article_2/Yocms_user_add_article_2.js" type="text/javascript"><\/script>');
	}
		CKEDITOR.replace( 'article_editor',
		{
		toolbar :
        [
            ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
			['Link','Unlink','Anchor','Smiley'],
			'/',
            ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
			['Styles','Format','Font','FontSize'],
   			['TextColor','BGColor'],
        ]}
		);
});
</script>