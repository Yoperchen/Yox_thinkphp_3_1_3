require(['jquery','jquerycookie'], function($){
	//显示隐藏，id一般为widget内使用,类widget外使用
	$("#Yocms_list_city_toggle,.Yocms_list_city_toggle,#Yocms_list_city_close,.Yocms_list_city_close,#Yocms_list_city_open,.Yocms_list_city_open").live("click",function(event){
		$("#Yocms_list_city").css("top",($(window).height())/7);
		$("#Yocms_list_city").css("left",($(window).width())/8);
		$("#Yocms_list_city").toggle();
	});
	//tab切换
	$("#tab .tabList ul li").each(function(index){
        $(this).click(function(){
	  $(".tabCon").css("display","block");
          $(".tabList .cur").removeClass("cur");
          $(".tabCon >div").removeClass("cur");
          //$(".tabCon >div").css("display","none")
          $(this).addClass("cur");
          $(".tabCon > div:eq("+index+")").addClass("cur");
          //$(".tabCon > div:eq("+index+")").css("display","block");
        });
      });
      $("#Yocms_list_city .cur>dl>dd>a").live("click",function(){
    	  var city_id=$(this).attr("data-district-id");
    	  $.cookie('city_id', city_id,{expires: 365, path: '/'}); //有效期1年
    	  //隐藏城市选择器
    	  $("#Yocms_list_city").css("display","none");
	  location.reload();
      });
      
});
var Yocms_list_city_is_load=1;
console.log(Yocms_list_city_is_load);