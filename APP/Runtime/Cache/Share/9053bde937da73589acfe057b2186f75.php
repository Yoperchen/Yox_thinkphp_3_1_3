<?php if (!defined('THINK_PATH')) exit();?><style type="text/css">
.Yocms_image_list_share_88 {border: 1px solid #ccc;border-radius: 20px;display:block;margin:0 auto; width:98%; position:relative;clear:both;min-height: 330px;overflow:auto}
.Yocms_image_list_share_88 .header{border-bottom: 1px solid #357ebd;width: 100%;height: 55px;border-top-left-radius: 25px;border-top-right-radius: 25px;}
.Yocms_image_list_share_88 span {height: 30px;font-size: 15px;margin: 10px;padding: 2px;display: block;float: left;width: 110px;text-align: left;line-height: 35px;}
.Yocms_image_list_share_88 .close{color:red;font-size:30px;width:45px;height:45px;float:right;font-family: cursive;cursor: pointer;border-radius: 20px;text-align: center;margin-top: 6px;}
.Yocms_image_list_share_88 .close:hover{background-color: #9c9c9c;}
.Yocms_image_list_share_88 ul {list-style-type: none;width: 100%;padding:0px;}
.Yocms_image_list_share_88 a {font: bold 20px/1.5 Helvetica, Verdana, sans-serif;color: #333;text-decoration: none;}
.Yocms_image_list_share_88 li img {float: left;margin: 0 15px 0 0;}
.Yocms_image_list_share_88 li p {font: 200 12px/1.5 Georgia, Times New Roman, serif;}
.Yocms_image_list_share_88 li {padding: 10px;overflow: auto;max-height:155px;}
.Yocms_image_list_share_88 li:hover {background: #eee;cursor: pointer;}
.Yocms_image_list_share_88 img{width:99px;}
.Yocms_image_list_share_88 .footer{padding: 10px;font-size: 12px;color: #999;text-align: left;float: left;clear: both;border-bottom-left-radius: 25px;border-bottom-right-radius: 25px;width: 95%;}

</style>
<div id="Yocms_image_list_share_88" class="Yocms_image_list_share_88">
<div class="header">
		<span style="color:#357ebd;font-size:15px;width:200px;float:left;font-family: cursive;">热点</span>
		<span class="close" id="Yocms_image_list_share_88_toggle" title="关闭">x</span>
	</div>
<ul>
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$share): $mod = ($i % 2 );++$i;?><li>
<img src="<?php echo (($share['img1'])?($share['img1']):'__PUBLIC__/Widget/ListGoods/Yocms_image_list_90/default_image.jpg'); ?>" />
<a target="_blank" href="<?php echo ($share['url']); ?>"><?php echo ($share['title']); ?></a>
<p><?php echo ($share['share_say']); ?>...<a target="_blank" style="font-size: 12px;" href="<?php echo U('Share/share_detail',array('share_id'=>$share['id']));?>">详细</a></p>
</li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
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
<div class="footer">列表板块</div>
</div>
<script>
//显示隐藏，id一般为widget内使用,类widget外使用
	$("#Yocms_image_list_share_88_toggle,.Yocms_image_list_share_88_toggle,#Yocms_image_list_share_88_close,.Yocms_image_list_share_88_close,#Yocms_image_list_share_88_open,.Yocms_image_list_share_88_open").live("click",function(event){
		$("#Yocms_image_list_share_88").css("top",$(document).scrollTop()+50);
		$("#Yocms_image_list_share_88").css("left",($(window).width())/4);
		$("#Yocms_image_list_share_88").toggle();
	})
</script>