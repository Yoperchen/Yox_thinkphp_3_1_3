<?php if (!defined('THINK_PATH')) exit();?><style type="text/css">
.Yocms_image_list_90{border: 1px solid #ccc;border-radius: 20px;display:block;margin:0 auto; width:98%; position:relative;clear:both;min-height: 330px;overflow:auto}
.Yocms_image_list_90 *{margin:0;padding:0;}
.Yocms_image_list_90 .header{border-bottom: 1px solid #357ebd;width: 100%;height: 55px;border-top-left-radius: 25px;border-top-right-radius: 25px;}
.Yocms_image_list_90 span {height: 30px;font-size: 15px;margin: 10px;padding: 2px;display: block;float: left;width: 110px;text-align: left;line-height: 35px;}
.Yocms_image_list_90 .close{color:red;font-size:30px;width:45px;height:45px;float:right;font-family: cursive;cursor: pointer;border-radius: 20px;text-align: center;margin-top: 6px;}
.Yocms_image_list_90 .close:hover{background-color: #9c9c9c;}
.Yocms_image_list_90 a{font-family:Tahoma,Helvetica,Arial,sans-serif; font-size:14px; color:#666; text-decoration:none; outline:none;}
.Yocms_image_list_90 ul li{margin-left:20px;}
.Yocms_image_list_90 .clear{clear:both;}
.Yocms_image_list_90 .summary{background:#333;}
.Yocms_image_list_90 .listbox{float:left; margin-bottom:20px; padding:10px; _padding:10px 10px 8px 10px ;background:#f6f6f6; width:250px; height:240px; position:relative;list-style: none;}
.Yocms_image_list_90 .listimg{float:left; width:260px; height:165px; position:relative; overflow:hidden;}
.Yocms_image_list_90 .listimg img{background:#333; width:260px; top:0; left:0; position:absolute;}
.Yocms_image_list_90 .summary{width:260px;height:165px;top:165px;left:0;position:absolute;}
.Yocms_image_list_90 .summarytxt{text-align: left;margin:5px 10px;width:250px;height:auto;line-height:22px;font-size:12px;color:#cfcfcf;}
.Yocms_image_list_90 .listinfo{_margin-bottom:3px; padding-left:10px; width:250px; line-height:22px; font-size:12px;}
.Yocms_image_list_90 .listinfo a{font-size:12px;}
.Yocms_image_list_90 .listtitle{float:left; margin-top:8px; _margin-top:-2px; width:250px; font-size:14px;text-align: left;}
.Yocms_image_list_90 .listtitle a{font-size:14px;height: 25px;overflow: hidden;display: block;}
.Yocms_image_list_90 .listtitle a:hover{color:#f55555;}
.Yocms_image_list_90 .listtag{text-align: left;float:left;padding-left:18px;background:url(__PUBLIC__/Widget/ListArticle/Yocms_image_list_90/taglist.gif) 0 5px no-repeat;width:232px;color:#999;}
.Yocms_image_list_90 .listtag a{margin:0 8px 0 0;margin:2px 8px -2px 09;_margin:0 8px 0 0;color:#999;}
.Yocms_image_list_90 .listtag a:hover{color:#2ad2bb;}
.Yocms_image_list_90 .listdate{float:left;margin-right:13px;padding-left:18px;background:url(__PUBLIC__/Widget/ListArticle/Yocms_image_list_90/time.gif) 0 5px no-repeat;color:#999;}
.Yocms_image_list_90 .listview{cursor: pointer;float:left;margin-right:13px;padding-left:24px;background:url(__PUBLIC__/Widget/ListArticle/Yocms_image_list_90/view.gif) 0 5px no-repeat;color:#999;}
.Yocms_image_list_90 .listcomment{cursor: pointer;float:left;margin-right:13px;padding-left:20px;background:url(__PUBLIC__/Widget/ListArticle/Yocms_image_list_90/comment.gif) 0 5px no-repeat;color:#999;}
.Yocms_image_list_90 .listdemo a{float:left;margin-top:0;margin-top:2px9;_margin-top:0;color:#999;white-space:nowrap;}
.Yocms_image_list_90 .listdemo a:hover{color:#2ad2bb;}
.Yocms_image_list_90 .footer{padding: 10px;font-size: 12px;color: #999;text-align: left;float: left;clear: both;border-bottom-left-radius: 25px;border-bottom-right-radius: 25px;width: 95%;}
</style>
<div id="Yocms_image_list_90" class="Yocms_image_list_90">
	<div class="header">
		<span style="color:#357ebd;font-size:15px;width:200px;float:left;font-family: cursive;">热点</span>
		<span class="close" id="Yocms_image_list_90_toggle" title="关闭">x</span>
	</div>
  <ul>
  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$share): $mod = ($i % 2 );++$i;?><li class="listbox mr20">
      <div class="listimg"> <a href="<?php echo (($share['url'])?($share['url']):U('Share/share_detail',array('share_id'=>$share['id']))); ?>" title="<?php echo ($share['title']); ?>" target="_blank">
      <img src="<?php echo (($share['img1'])?($share['img1']):'__PUBLIC__/Widget/ListGoods/Yocms_image_list_90/default_image.jpg'); ?>" class="attachment-thumbnail wp-post-image" alt="<?php echo ($share['share_say']); ?>" /></a>
        <div class="summary">
          <div class="summarytxt">
            <p><?php echo (($share['share_say'])?($share['share_say']):'分享者木有说话'); ?></p>
          </div>
        </div>
      </div>
      <div class="listinfo">
        <div class="listtitle">
		<a href="<?php echo (($share['url'])?($share['url']):U('Share/share_detail',array('share_id'=>$share['id']))); ?>" title="<?php echo ($share['title']); ?>" target="_blank"><?php echo ($share['title']); ?></a>
		</div>
        <div class="listtag"><a href="<?php echo ($share['host']); ?>" target="_blank" rel="tag">站点</a><a href="<?php echo ($share['host']); ?>" rel="tag">杂志</a></div>
        <div class="listdate"><?php echo (date("Y-m-d",$share['add_time'])); ?></div>
        <div class="listview"><?php echo (($share['view'])?($share['view']):'167'); ?></div>
        <div onclick="get_comment_list(this)" class="listcomment" share-data-id="<?php echo (($share['id'])?($share['id']):'0'); ?>">评论</div>
        <div class="listdemo"><a href="<?php echo U('Share/share_detail',array('share_id'=>$share['id']));?>" rel="external nofollow" target="_blank">详细</a></div>
      </div>
    </li><?php endforeach; endif; else: echo "" ;endif; ?>
  </ul>
	<div class="footer">列表板块</div>
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
<script>
//上滑效果
$(document).ready(function(){$('.listimg').hover(function(){$(".summary",this).stop().animate({top:'110px'},{queue:false,duration:180});},function(){$(".summary",this).stop().animate({top:'165px'},{queue:false,duration:180});});});
</script>
<script>
	//显示隐藏，id一般为widget内使用,类widget外使用
	$("#Yocms_image_list_90_toggle,.Yocms_image_list_90_toggle,#Yocms_image_list_90_close,.Yocms_image_list_90_close,#Yocms_image_list_90_open,.Yocms_image_list_90_open").live("click",function(event){
		$("#Yocms_image_list_90").css("top",$(document).scrollTop()+50);
		$("#Yocms_image_list_90").css("left",($(window).width())/4);
		$("#Yocms_image_list_90").css("position","absolute");
		$("#Yocms_image_list_90").toggle();
	})
</script>
<script type="text/javascript">
//获取评论列表
function get_comment_list(obj)
{
	$.ajax(
	    {
	        type:'get',
	        url : "http://share.linglingtang.me/index.php?s=/Yocms_widget/get_widget&Widget=ListComment&template=Yocms_image_list_94&condition[share_id]="+$(obj).attr('share-data-id')+"&action_url=<?php echo U('Comment/add_comment');?>&t=default_theme",
	        dataType : 'text',
	        //jsonp:"jsoncallback",
	        success  : function(data) {
	            //alert(data);
				if($("#Yocms_comment_image_list_94").length>0)
				{
					//元素存在就移除
					$("#Yocms_comment_image_list_94").html('&nbsp;');
					$("#Yocms_comment_image_list_94").remove();
					//alert('remove');
				}
				$("body").append(data);
				$("#Yocms_comment_image_list_94").css("display","none");
				$("#Yocms_comment_image_list_94").css("width","500px");
				$("#Yocms_comment_image_list_94").css("position","absolute");
				$("#Yocms_comment_image_list_94").css("top",$(document).scrollTop()+50);
				$("#Yocms_comment_image_list_94").css("left",($(window).width())/4);
				$("#Yocms_comment_image_list_94").toggle();
				
	        },
	        error : function(data) {
	            alert('fail');
	        }
	    }
	);
}
</script>
<script>
//评论的显示隐藏，id一般为widget内使用,类widget外使用
$("#Yocms_comment_image_list_94_toggle,.Yocms_comment_image_list_94_toggle,#Yocms_comment_image_list_94_close,.Yocms_comment_image_list_94_close,#Yocms_comment_image_list_94_open,.Yocms_comment_image_list_94_open").live("click",function(event){
	$("#Yocms_comment_image_list_94").css("top",$(document).scrollTop()+50);
	$("#Yocms_comment_image_list_94").css("left",($(window).width())/4);
	$("#Yocms_comment_image_list_94").toggle();
})
</script>