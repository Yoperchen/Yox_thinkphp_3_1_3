require(['jquery'], function($){
	//显示隐藏，id一般为widget内使用,类widget外使用
	$("#Yocms_image_article_list_88_toggle,.Yocms_image_list_88_toggle,#Yocms_image_article_list_88_close,.Yocms_image_list_88_close,#Yocms_image_article_list_88_open,.Yocms_image_list_88_open").live("click",function(event){
		$("#Yocms_image_article_list_88").css("top",$(document).scrollTop()+50);
		$("#Yocms_image_article_list_88").css("left",($(window).width())/4);
		$("#Yocms_image_article_list_88").toggle();
	})
});
var Yocms_image_article_list_88_is_load=1;