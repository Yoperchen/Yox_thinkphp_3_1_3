require(['jquery'], function($){
	//显示隐藏，id一般为widget内使用,类widget外使用
	$("#Yocms_list_select_90_toggle,.Yocms_list_select_90_toggle,#Yocms_list_select_90_close,.Yocms_list_select_90_close,#Yocms_list_select_90_open,.Yocms_list_select_90_open").live("click",function(event){
		$("#Yocms_list_select_90").css("top",($(window).height())/7);
		$("#Yocms_list_select_90").css("left",($(window).width())/4);
		$("#Yocms_list_select_90").toggle();
	})
	//选择
	$("#Yocms_list_select_90 ul li").live("click",function(){
	$("#Yocms_list_select_90 #district_id").val($(this).attr("data-district-id"));
	//
	$(".Yocms_list_select_90 ul li a").live("click",function(){
		//alert($(this).attr("data-district-id"))
		$.ajax(
			    {
			        type:'get',
			        url : $(".Yocms_list_select_90").attr("data-action-url"),
			        data:{district_id:$(this).attr("data-district-id")},
			        //dataType : 'text',
			        jsonp:"jsoncallback",
			        success  : function(data) {
						if(data.status>0){
							if(data.message==''){
								$(".Yocms_list_select_90_footer").html(data.message);
							}
							else{
								$(".Yocms_list_select_90_footer").html('select_fail');
							}
						}
						else
						{
							$(".Yocms_list_select_90_footer").html("閫夋嫨澶辫触");
						}
			        },
			        error : function(data) {
			            alert('request_fail');
			        }
			    }
			);
	})
})
});
var Yocms_list_90_is_load=1;