require(['jquery'], function($){
//alert("aaa");alert($().jquery);
	//效果
	$(document).ready(function(){$('.listimg').hover(function(){$(".summary",this).stop().animate({top:'110px'},{queue:false,duration:180});},function(){$(".summary",this).stop().animate({top:'165px'},{queue:false,duration:180});});});
	
	//评论的显示隐藏，id一般为widget内使用,类widget外使用
	$("#Yocms_image_list_90_toggle,.Yocms_image_list_90_toggle,#Yocms_image_list_90_close,.Yocms_image_list_90_close,#Yocms_image_list_90_open,.Yocms_image_list_90_open").live("click",function(event){
		$("#Yocms_goods_image_list_90").css("top",$(document).scrollTop()+50);
		$("#Yocms_goods_image_list_90").css("left",($(window).width())/4);
		$("#Yocms_goods_image_list_90").toggle();
	});
});
var Yocms_goods_image_list_94_is_load=1;