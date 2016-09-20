require(['jquery'], function($){
	//显示隐藏，id一般为widget内使用,类widget外使用
	$("#ListStore_toggle,.ListStore_toggle,#ListStore_close,.ListStore_close,#ListStore_open,.ListStore_open").live("click",function(event){
		$("#ListStore").css("top",$(document).scrollTop()+50);
		$("#ListStore").css("left",($(window).width())/4);
		$("#ListStore").css("position","absolute");
		$("#ListStore").toggle();
	})
	//选择赋值
	$("#ListStore ul li").live("click",function(){
		$("#ListStore #store_id").val($(this).attr("data-store-id"));
	})
});
var ListStore_is_load=1;