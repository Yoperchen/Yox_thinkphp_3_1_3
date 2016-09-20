<?php if (!defined('THINK_PATH')) exit();?><style type="text/css">
#Yocms_user_add_message_2{position: relative;background-color: #fff;border: 1px solid #ccc;border-radius: 20px;}
#Yocms_user_add_message_2 .header{border-bottom: 1px solid #357ebd;width: 100%;height: 55px;border-top-left-radius: 25px;border-top-right-radius: 25px;}
#Yocms_user_add_message_2 div{clear: both;width:100%;display: block;}
#Yocms_user_add_message_2 .close{color:red;font-size:30px;width:45px;height:45px;float:right;font-family: cursive;cursor: pointer;border-radius: 20px;text-align: center;margin-top: 6px;}
#Yocms_user_add_message_2 .close:hover{background-color: #9c9c9c;}
#Yocms_user_add_message_2 span{height: 30px;font-size: 15px;margin: 10px;padding: 2px;display: block;float:left;width: 110px;text-align: left;line-height: 35px;}
#Yocms_user_add_message_2 input{width: 98%;height: 30px;font-size: 16px;margin-left: auto;margin-right: auto;padding: 2px;float:left;border: 1px solid #ccc;border-radius: 4px;}
#Yocms_user_add_message_2 form{width: 99%;margin-left: auto;margin-right: auto;}
#Yocms_user_add_message_2 .footer{padding: 10px;font-size: 12px;color: #999;text-align: left;float: left;clear: both;border-bottom-left-radius: 25px;border-bottom-right-radius: 25px;width: 95%;}
</style>
<div id="Yocms_user_add_message_2" class="Yocms_user_add_message_2">
		<div class="header">
			<span style="color:#357ebd;font-size:15px;width: 45%;max-width: 130px;height:45px;float:left;font-family: cursive;">发送消息</span>
			<span class="close" id="Yocms_user_add_message_2_toggle" title="关闭">x</span>
		</div>
	<form id="add_message_form" action="<?php echo (($action_url)?($action_url):'/'); ?>" method="post">
		<input type="hidden" name="op" value="add">
		<input type="hidden" name="from_user_id" value="<?php echo ($data["from_user_id"]); ?>">
		<input type="hidden" name="to_user_id" value="<?php echo ($data["to_user_id"]); ?>">
		<input type="hidden" name="to_group_id" value="<?php echo ($data["to_group_id"]); ?>">
		<div><input type="text" name="message_content" value="<?php echo ($data["message_content"]); ?>"></div>
		<div><input style="width:97%;background-color: #428BCA;height: 35px;" type="submit" value="发送"></div>
		<div class="footer">添加内容板块</div>
	</form>
</div>
<script>
	//显示隐藏，id一般为widget内使用,类widget外使用
	$("#Yocms_user_add_message_2_toggle,.Yocms_user_add_message_2_toggle,#Yocms_user_add_message_2_close,.Yocms_user_add_message_2_close,#Yocms_user_add_message_2_open,.Yocms_user_add_message_2_open").live("click",function(event){
		$("#Yocms_user_add_message_2").css("top",$(document).scrollTop()+50);
		$("#Yocms_user_add_message_2").css("left",($(window).width())/4);
		$("#Yocms_user_add_message_2").toggle();
	})
</script>
<script>
//表单提交
$("#add_message_form").submit(function()
{
	if ($("input[name='message_content']").val() == ""){
		alert("内容不能为空！");
		$("input[name='message_content']").focus();
		return false;
	}
	$.ajax({
        cache: true,
        type: "POST",
        url:$(this).attr('action'),
        data:$(this).serialize(),// 你的formid
        async: false,
        success: function(data) 
        {
            //$(this).parent().html(data);
			$("input[name='message_content']").val("");
			$("input[name='message_content']").focus();
			$("#Yocms_user_add_message_2 .footer").html("发送成功");
        	//alert("发送成功");
        },
        error: function(data) 
        {
			$("#Yocms_user_add_message_2 .footer").html("发送失败");
            //alert("Connection error");
        }
    });
	return false;
	})
</script>