require(['jquery'], function($){
	//显示隐藏，id一般为widget内使用,类widget外使用
	$("#Yocms_district_list_90_toggle,.Yocms_district_list_90_toggle,#Yocms_district_list_90_close,.Yocms_district_list_90_close,#Yocms_district_list_90_open,.Yocms_district_list_90_open").live("click",function(event){
		$("#Yocms_district_list_90").css("top",($(window).height())/7);
		$("#Yocms_district_list_90").css("left",($(window).width())/4);
		$("#Yocms_district_list_90").toggle();
	})
	//选择
	$("#Yocms_district_list_90 ul li").live("click",function(){
	$("#Yocms_district_list_90 #district_id").val($(this).attr("data-district-id"));
})
});
var Yocms_district_list_90_is_load=1;