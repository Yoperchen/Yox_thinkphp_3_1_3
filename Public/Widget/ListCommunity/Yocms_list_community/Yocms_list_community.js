;require(['jquery','jquerycookie'], function($){
	//显示隐藏，id一般为widget内使用,类widget外使用
	$("#Yocms_list_community_toggle,.Yocms_list_community_toggle,#Yocms_list_community_close,.Yocms_list_community_close,#Yocms_list_community_open,.Yocms_list_community_open").live("click",function(event){
		$("#Yocms_list_community").css("top",($(window).height())/7);
		$("#Yocms_list_community").css("left",($(window).width())/8);
		$("#Yocms_list_community").toggle();
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
      $("#Yocms_list_community .cur>dl>dd>a").live("click",function(){
    	  var community_id=$(this).attr("data-community-id");
	  var community_name=$(this).attr("title");
    	  $.cookie('community_id', community_id,{expires: 365, path: '/'}); //有效期1年
	  $.cookie('community_name', community_name,{expires: 365, path: '/'}); //有效期1年
    	  //隐藏城市选择器
    	  $("#Yocms_list_community").css("display","none");
	  location.reload();
      });
      
});
var Yocms_list_community_is_load=1;
console.log(Yocms_list_community_is_load);