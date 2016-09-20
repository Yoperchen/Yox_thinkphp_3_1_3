<?php if (!defined('THINK_PATH')) exit();?><style type="text/css">
#Yocms_user_add_share_2{position: relative;background-color: #fff;border: 1px solid #ccc;border-radius: 20px;}
#Yocms_user_add_share_2 .header{border-bottom: 1px solid #357ebd;width: 100%;height: 55px;border-top-left-radius: 25px;border-top-right-radius: 25px;}
#Yocms_user_add_share_2 div{clear: both;width:100%;display: block;}
#Yocms_user_add_share_2 .close{color:red;font-size:30px;width:45px;height:45px;float:right;font-family: cursive;cursor: pointer;border-radius: 20px;text-align: center;margin-top: 6px;}
#Yocms_user_add_share_2 .close:hover{background-color: #9c9c9c;}
#Yocms_user_add_share_2 span{height: 30px;font-size: 15px;margin: 10px;padding: 2px;display: block;float:left;width: 110px;text-align: left;line-height: 35px;}
#Yocms_user_add_share_2 input{width: 60%;height: 30px;font-size: 23px;margin: 10px;padding: 2px;float:left;border: 1px solid #ccc;border-radius: 4px;}
#Yocms_user_add_share_2 form{width: 806px;margin-left: 15px;margin-right: auto;}
#Yocms_user_add_share_2 .footer{padding: 10px;font-size: 12px;color: #999;text-align: left;float: left;clear: both;border-bottom-left-radius: 25px;border-bottom-right-radius: 25px;width: 95%;}
</style>
<div id="Yocms_user_add_share_2" class="Yocms_user_add_share_2">
		<div class="header">
			<span style="color:#357ebd;font-size:15px;width:200px;height:45px;float:left;font-family: cursive;">分享新发现</span>
			<span class="close" id="Yocms_user_add_share_2_toggle" title="关闭">x</span>
		</div>
	<form action="<?php echo (($action_url)?($action_url):'/'); ?>" method="post">
		<input type="hidden" name="op" value="add">
		<div><span>标题:</span><input type="text" name="title" value="<?php echo ($data["title"]); ?>"><span id="Yocms_user_add_share_2_title_tip" style="color: red;">*必填</span></div>
		<div><span>链接：</span><input type="text" name="url" value="<?php echo ($data["url"]); ?>"><span id="Yocms_user_add_share_2_url_tip" style="color: blue;"></span></div>
		<div><span>图片地址:</span><input type="text" name="img1" value="<?php echo ($data["img1"]); ?>"><span id="Yocms_user_add_share_2_img1_tip" style="color: blue;"></span></div>
		<div><span>图片预览:</span><img id="Yocms_user_add_share_2_show_img" height="100" src="<?php echo ($data["img1"]); ?>"></div>
		<div><span>发表一下感言：</span><input type="text" name="share_say" value="<?php echo ($data["share_say"]); ?>"><span id="Yocms_user_add_share_2_share_say_tip" style="color: blue;"></span></div>
		<div><input style="width:97%;background-color: #428BCA;height: 35px;" type="submit" value="添加到零零糖新热版"></div>
		<div class="footer">添加内容板块</div>
	</form>
</div>
<script>
	//图片预览
	$("#Yocms_user_add_share_2 input[name='img1']").bind("change",function(){
		$("#Yocms_user_add_share_2_show_img").attr("src",$(this).val());
	})
</script>
<script>
	//显示隐藏，id一般为widget内使用,类widget外使用
	$("#Yocms_user_add_share_2_toggle,.Yocms_user_add_share_2_toggle,#Yocms_user_add_share_2_close,.Yocms_user_add_share_2_close,#Yocms_user_add_share_2_open,.Yocms_user_add_share_2_open").live("click",function(event){
		$("#Yocms_user_add_share_2").css("top",$(document).scrollTop()+50);
		$("#Yocms_user_add_share_2").css("left",($(window).width())/4);
		$("#Yocms_user_add_share_2").css("position","absolute");
		$("#Yocms_user_add_share_2").toggle();
	})
</script>