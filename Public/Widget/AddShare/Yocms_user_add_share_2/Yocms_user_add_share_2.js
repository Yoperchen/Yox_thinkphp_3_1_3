require(['jquery'], function($){
	//图片预览
	$("#Yocms_user_add_share_2 input[name='img1']").bind("change",function(){
		$("#Yocms_user_add_share_2_show_img").attr("src",$(this).val());
	})
	//显示隐藏，id一般为widget内使用,类widget外使用
	$("#Yocms_user_add_share_2_toggle,.Yocms_user_add_share_2_toggle,#Yocms_user_add_share_2_close,.Yocms_user_add_share_2_close,#Yocms_user_add_share_2_open,.Yocms_user_add_share_2_open").live("click",function(event){
		$("#Yocms_user_add_share_2").css("top",$(document).scrollTop()+50);
		$("#Yocms_user_add_share_2").css("left",($(window).width())/4);
		$("#Yocms_user_add_share_2").css("position","absolute");
		$("#Yocms_user_add_share_2").toggle();
	})
});
var Yocms_user_add_share_is_load=1;