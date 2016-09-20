require(['jquery'], function($){
	//显示隐藏，id一般为widget内使用,类widget外使用
	$("#Yocms_image_article_list_89_toggle,.Yocms_image_list_89_toggle,#Yocms_image_article_list_89_close,.Yocms_image_list_89_close,#Yocms_image_article_list_89_open,.Yocms_image_list_89_open").live("click",function(event){
		$("#Yocms_image_article_list_89").css("top",$(document).scrollTop()+50);
		$("#Yocms_image_article_list_89").css("left",($(window).width())/4);
		$("#Yocms_image_article_list_89").toggle();
	})
});
var Yocms_image_article_list_89_is_load=1;