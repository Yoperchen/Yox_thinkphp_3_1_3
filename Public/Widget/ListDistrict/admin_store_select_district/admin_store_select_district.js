require(['jquery'], function($){
	//显示隐藏，id一般为widget内使用,类widget外使用
	$("#admin_store_select_district_toggle,.admin_store_select_district_toggle,#admin_store_select_district_close,.admin_store_select_district_close,#admin_store_select_district_open,.admin_store_select_district_open").live("click",function(event){
		$("#admin_store_select_district").css("top",($(window).height())/7);
		$("#admin_store_select_district").css("left",($(window).width())/4);
		$("#admin_store_select_district").toggle();
	})
});
var admin_store_select_district_is_load=1;