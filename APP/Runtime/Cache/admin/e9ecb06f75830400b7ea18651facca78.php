<?php if (!defined('THINK_PATH')) exit();?><div class="Yocms_image_list_92"> 
<div class="inner"> 
<ul class="rank_list"> 
<?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "暂时没有数据" ;else: foreach($__LIST__ as $key=>$article): $mod = ($k % 2 );++$k;?><li <?php if($k <= 3): ?>class="top3"<?php endif; ?>><em><?php echo ($k); ?></em>
<a href="<?php echo (($article['url'])?($article['url']):U('Article/article_detail@'.$application,array('article_id'=>$article['id']))); ?>"><?php echo ($article['title']); ?></a><span><?php echo (($article['view'])?($article['view']):'1'); ?></span></li><?php endforeach; endif; else: echo "暂时没有数据" ;endif; ?>
</ul> 
</div> 
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
<style type="text/css"> 
.Yocms_image_list_92 { font-size:12px; text-align:center;} 
.Yocms_image_list_92 ul, .Yocms_image_list_92 li { list-style:none;} 
.Yocms_image_list_92 a{ text-decoration:none; color:#3381BF;float: left;} 
.Yocms_image_list_92 a:hover{ text-decoration:underline;} 
.Yocms_image_list_92 { height:260px;} 
.Yocms_image_list_92 .box2 { border:1px solid #ADDFF2; text-align:left; overflow:hidden; color:#9C9C9C; text-align:left;} 
.Yocms_image_list_92 .box2 { margin-bottom:7px;} 
.Yocms_image_list_92 .box2 .inner{ padding:8px; line-height:18px; overflow:hidden; color:#3083C7;} 
.Yocms_image_list_92 .box2 a{ color:#3083C7; white-space:nowrap;} 
.Yocms_image_list_92 .rank_list{ line-height:14px; margin:auto; padding-top:5px;padding:0px;} 
.Yocms_image_list_92 .rank_list li{ height:14px; margin-bottom:8px; width:290px; padding-left:20px; white-space:nowrap; overflow:hidden; position:relative;width:98%} 
.Yocms_image_list_92 .rank_list li.top3 em{ background:#FFE4B7; border:1px solid #FFBB8B; color:#FF6800;} 
.Yocms_image_list_92 .rank_list em{ position:absolute; left:0; top:0; width:15px; height:12px; border:1px solid #B1E0F4; color:#6298CC; font-style:normal; font-size:10px; font-family:Arial; background:#E6F0FD; text-align:center; line-height:12px; overflow:hidden;} 
.Yocms_image_list_92 .rank_list span{  width:40px; color:#B7B7B7; text-align:right; height:14px; background:#fff; float:right;} 
</style>