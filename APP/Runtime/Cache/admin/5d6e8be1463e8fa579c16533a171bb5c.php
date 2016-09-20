<?php if (!defined('THINK_PATH')) exit();?><style type="text/css">
.Yocms_image_list_88 {margin: 5px;}
.Yocms_image_list_88 ul {list-style-type: none;width: 100%;padding:0px;}
.Yocms_image_list_88 h3 {font: bold 20px/1.5 Helvetica, Verdana, sans-serif;}
.Yocms_image_list_88 li img {float: left;margin: 0 15px 0 0;border-radius: 25px;}
.Yocms_image_list_88 li p {font: 200 12px/1.5 Georgia, Times New Roman, serif;}
.Yocms_image_list_88 li {padding: 10px;overflow: auto;}
.Yocms_image_list_88 li:hover {background: #eee;cursor: pointer;}
.Yocms_image_list_88 img{width:99px;}
</style>
<div class="Yocms_image_list_88">
<ul>
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "没有评论" ;else: foreach($__LIST__ as $key=>$comment): $mod = ($i % 2 );++$i;?><li>
<img src="<?php echo (($comment['img1'])?($comment['img1']):'__PUBLIC__/Uploads/default_avatar/face_1.jpg'); ?>" />
<h3><?php echo ($comment['title']); ?></h3>
<p><?php echo ($comment['content']); ?>...</p>
</li><?php endforeach; endif; else: echo "没有评论" ;endif; ?>

</ul>
</div>