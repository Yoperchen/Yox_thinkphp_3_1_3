<?php if (!defined('THINK_PATH')) exit();?><style type="text/css">
.Yocms_list_90{width:98%;position: relative;background-color: #fff;border: 1px solid #ccc;border-radius: 20px;}
.Yocms_list_90 .header{border-bottom: 1px solid #357ebd;width: 100%;height: 55px;border-top-left-radius: 25px;border-top-right-radius: 25px;display: block;clear: both; overflow: hidden;}
.Yocms_list_90 .header span{height: 30px;font-size: 15px;margin: 10px;padding: 2px;display: block;float:left;width: 110px;text-align: left;line-height: 35px;}
.Yocms_list_90 .header .close{color:red;font-size:30px;width:45px;height:45px;float:right;font-family: cursive;cursor: pointer;border-radius: 20px;text-align: center;margin-top: 6px;}
.Yocms_list_90 .header .close:hover{background-color: #9c9c9c;}
.Yocms_list_90 li{list-style:none;}img{border:none;}em{font-style:normal;}
.Yocms_list_90 a{color:#555;text-decoration:none;outline:none;blr:this.onFocus=this.blur();float:left;margin-left:5px;}
.Yocms_list_90 a:hover{color:#000;text-decoration:underline;}
.Yocms_list_90 .avatar{float: left;border-radius: 30px;vertical-align: middle; cursor: pointer;}
.Yocms_list_90 .clear{height:0;overflow:hidden;clear:both;}
.Yocms_list_90 h4{font-size:14px;height:27px;line-height:27px;padding-left:10px;border-bottom:#ddd 1px solid;}
.Yocms_list_90 ul{padding:5px 10px;max-height:368px;overflow-x:hidden;overflow-y: auto;}
.Yocms_list_90 ul li{height:45px;line-height:45px;overflow:hidden;}
.Yocms_list_90 .footer{padding: 10px;font-size: 12px;color: #999;text-align: left;float: left;clear: both;border-bottom-left-radius: 25px;border-bottom-right-radius: 25px;width: 95%;}
</style>
<div id="Yocms_list_message_90" class="Yocms_list_90">
	<div class="header">
		<span style="color:#357ebd;font-size:15px;width:45%;max-width:130px;height:35px;float:left;font-family: cursive;">分享新发现</span>
		<span class="close" id="Yocms_list_message_90_toggle" title="关闭">x</span>
	</div>
<ul>
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$message): $mod = ($i % 2 );++$i;?><li>
<img title="<?php echo (($message['from_user_info']['nick_name'])?($message['from_user_info']['nick_name']):'木有名字'); ?>的头像" src="<?php echo (($message['from_user_info']['avatar'])?($message['from_user_info']['avatar']):'__PUBLIC__/Uploads/default_avatar/face_1.jpg'); ?>" class="avatar" width="40" height="40">
<a href="javascript:;" target="_blank"><?php echo ($message['message_content']); ?></a>
</li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
	<div class="footer">列表内容板块</div>
</div>
<script>
	//显示隐藏，id一般为widget内使用,类widget外使用
	$("#Yocms_list_message_90_toggle,.Yocms_list_message_90_toggle,#Yocms_list_message_90_close,.Yocms_list_message_90_close,#Yocms_list_message_90_open,Yocms_list_message_90_open").live("click",function(event){
		$("#Yocms_list_message_90").css("top",$(document).scrollTop()+50);
		$("#Yocms_list_message_90").css("left",($(window).width())/4);
		$("#Yocms_list_message_90").toggle();
	})
</script>