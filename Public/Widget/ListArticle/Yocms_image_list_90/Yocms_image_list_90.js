require(['jquery'], function($){
	$(document).ready(function(){$('.listimg').hover(function(){$(".summary",this).stop().animate({top:'110px'},{queue:false,duration:180});},function(){$(".summary",this).stop().animate({top:'165px'},{queue:false,duration:180});});});

	//显示隐藏，id一般为widget内使用,类widget外使用
	$("#Yocms_image_article_list_90_toggle,.Yocms_image_list_90_toggle,#Yocms_image_article_list_90_close,.Yocms_image_list_90_close,#Yocms_image_article_list_90_open,.Yocms_image_list_90_open").live("click",function(event){
		$("#Yocms_image_article_list_90").css("top",$(document).scrollTop()+50);
		$("#Yocms_image_article_list_90").css("left",($(window).width())/4);
		$("#Yocms_image_article_list_90").toggle();
	})
});
var Yocms_image_article_list_90_is_load=1;