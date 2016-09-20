<?php if (!defined('THINK_PATH')) exit();?><div class="Yocms_list_91" empty="没有评论"> 
<ul> 
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "木有评论" ;else: foreach($__LIST__ as $key=>$comment): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Comment/comment_detail',array('comment_id'=>$comment['id']));?>"><?php echo ($comment['content']); ?></a><?php echo (date("Y-m-d",$comment['add_time'])); ?></li><?php endforeach; endif; else: echo "木有评论" ;endif; ?>
</ul> 
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