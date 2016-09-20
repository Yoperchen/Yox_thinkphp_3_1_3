<?php if (!defined('THINK_PATH')) exit();?><div class="Yocms_list_90">
<ul>
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$article): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Article/article_detail',array('article_id'=>$article['id']));?>" target="_blank"><?php echo ($article['title']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
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
<style type="text/css">、
.Yocms_list_90 li{list-style:none;}img{border:none;}em{font-style:normal;}
.Yocms_list_90 a{color:#555;text-decoration:none;outline:none;blr:this.onFocus=this.blur();}
.Yocms_list_90 a:hover{color:#000;text-decoration:underline;}
.Yocms_list_90 .clear{height:0;overflow:hidden;clear:both;}
.Yocms_list_90 h4{font-size:14px;height:27px;line-height:27px;padding-left:10px;border-bottom:#ddd 1px solid;}
.Yocms_list_90{width:98%;}
.Yocms_list_90 ul{padding:5px 10px;}
.Yocms_list_90 ul li{height:24px;line-height:24px;overflow:hidden;}
</style>