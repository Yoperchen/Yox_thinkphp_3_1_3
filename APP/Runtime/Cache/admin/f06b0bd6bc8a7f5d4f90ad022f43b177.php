<?php if (!defined('THINK_PATH')) exit(); if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$article): $mod = ($i % 2 );++$i;?><div class="Yocms_image_list_93 view-first">
	<a target="_blank" href="#" class="new-product-image">
	<img height="190" src="<?php echo (($article['img1'])?($article['img1']):'__PUBLIC__/Widget/ListArticle/Yocms_image_list_90/default_image.jpg'); ?>"></a>
	<div class="mask">
		<h4 class="title"><a title="<?php echo ($article['title']); ?>" class="text-hide" target="_blank" href="#"><?php echo ($article['title']); ?></a></h4>
		<p class="text"><?php echo ($article['desc']); ?></p>
	</div>
</div><?php endforeach; endif; else: echo "" ;endif; ?>
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
<style type="text/css">
/* CSS Document */
body{ padding:0; margin:0;}
img{ border:none;}
.view-first img{ -webkit-transition:all .2s ease-in; -moz-transition:all .2s ease-in; -o-transition:all .2s ease-in; -ms-transition:all .2s ease-in; transition:all .2s ease-in;}
div.mask-hover img, .Yocms_image_list_93:hover img{width:100px; height:100px;}
.Yocms_image_list_93{position:relative; text-align:center; cursor:default; width:190px; height:235px; margin-left:auto; margin-right:auto; overflow:hidden;float:left}
.Yocms_image_list_93 .mask{width:160px; overflow:hidden; margin:0 auto;}
.Yocms_image_list_93 .title{text-align:center; position:relative; font-size:12px; margin-top:16px; height:20px; line-height:20px;}
.Yocms_image_list_93 .title a{ color:#666; text-decoration:none;}
.Yocms_image_list_93 .text{position:relative; text-align:left; font:normal 12px/16px '宋体'; color:#999;}
</style>