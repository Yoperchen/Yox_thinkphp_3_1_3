<?php if (!defined('THINK_PATH')) exit();?><div class="Yocms_list_91"> 
<ul> 
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$article): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Article/article_detail@'.$application,array('article_id'=>$article['id']));?>"><?php echo ($article['title']); ?></a><?php echo (date("Y-m-d",$article['add_time'])); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul> 
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
.Yocms_list_91 { 
width:98%; 
height:auto; 
clear:both; 
} 
.Yocms_list_91 ul, .Yocms_list_91 li { 
list-style:none; 
} 
.Yocms_list_91 li { 
width:98%; 
height: 28px; 
text-align: right; 
background-repeat: no-repeat; 
background-position: 50px center; 
padding-left: 0px; 
line-height:28px; 
color:#CCC; 
border-bottom:dashed 1px #CCC; 
} 
.Yocms_list_91 li a { 
float:left; 
text-align:left; 
line-height:28px; 
color:#666; 
text-decoration:none; 
} 
.Yocms_list_91 li a:hover { 
color:#F00; 
} 
</style>