<?php if (!defined('THINK_PATH')) exit();?><div class="Yocms_image_list_89">
<ul>
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$article): $mod = ($i % 2 );++$i;?><li>
<img src="<?php echo (($article['img1'])?($article['img1']):'__PUBLIC__/Widget/ListArticle/Yocms_image_list_90/default_image.jpg'); ?>" />
<h3><?php echo ($article['title']); ?></h3>
<p><?php echo ($article['desc']); ?>...</p>
</li><?php endforeach; endif; else: echo "" ;endif; ?>
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
.Yocms_image_list_89 {
margin: 5px;
}
.Yocms_image_list_89 ul {
list-style-type: none;
width: 100%;
}
.Yocms_image_list_89 h3 {
font: bold 20px/1.5 Helvetica, Verdana, sans-serif;
}
.Yocms_image_list_89 li img {
float: left;
margin: 0 15px 0 0;
}
.Yocms_image_list_89 li p {
font: 200 12px/1.5 Georgia, Times New Roman, serif;
}
.Yocms_image_list_89 li {
padding: 10px;
overflow: auto;
}
.Yocms_image_list_89 li:hover {
background: #eee;
cursor: pointer;
}
.Yocms_image_list_89 img{
width:100%;
}
</style>