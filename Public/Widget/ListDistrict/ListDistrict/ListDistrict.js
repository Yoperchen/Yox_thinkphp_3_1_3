require(['jquery','jquerycookie'], function($){
	//显示隐藏，id一般为widget内使用,类widget外使用
	$("#ListDistrict_toggle,.ListDistrict_toggle,#ListDistrict_close,.ListDistrict_close,#ListDistrict_open,.ListDistrict_open").live("click",function(event){
		$("#ListDistrict").css("top",($(window).height())/7);
		$("#ListDistrict").css("left",($(window).width())/4);
		$("#ListDistrict").toggle();
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
      $("#ListDistrict #province_list dl dd a").live("click",function(){
    	  var province_id=$(this).attr("data-district-id");
    	  
    	  $("#ListDistrict .tabList ul li").removeClass("cur");
    	  $("#ListDistrict .tabList ul li#city_tab").addClass("cur");
    	  $("#ListDistrict #province_list").removeClass("cur");
    	  $("#ListDistrict #district_list").removeClass("cur");
    	  $("#ListDistrict #city_list").addClass("cur");
    	  
    	  //隐藏省份，显示城市
    	  $("#ListDistrict #city_list dl[id^='upid_']").css("display","none");
    	  $("#ListDistrict #city_list #upid_"+province_id).css("display","block");
      });
      $("#ListDistrict #city_list dl dd a").live("click",function(){
    	  var city_id=$(this).attr("data-district-id");
    	  
    	  $("#ListDistrict .tabList ul li").removeClass("cur");
    	  $("#ListDistrict .tabList ul li#district_tab").addClass("cur");
    	  $("#ListDistrict #province_list").removeClass("cur");
    	  $("#ListDistrict #city_list").removeClass("cur");
    	  $("#ListDistrict #district_list").addClass("cur");
    	  
    	  //隐藏城市，显示地区div
    	  $("#ListDistrict #district_list dl[id^='upid_']").css("display","none");
    	  $("#ListDistrict #district_list #upid_"+city_id).css("display","block");
      });
      $("#ListDistrict #city_list dl dd a").live("click",function(){
    	  $("#ListDistrict #city_list dl dd a").removeAttr("selected");
    	  $(this).attr("selected","selected");
      })
      $("#ListDistrict #district_list dl dd a").live("click",function(){
          var district_id=$(this).attr("data-district-id");
    	  //隐藏选择器、省份、城市、区
    	  $("#ListDistrict .tabCon").css("display","none");
    	  $("#ListDistrict .tabList .cur").removeClass("cur");
    	  $("#ListDistrict #district_list dl dd a").removeAttr("selected");
    	  $(this).attr("selected","selected");
	  $.cookie('district_id', district_id,{expires: 365, path: '/'}); //有效期1年
	  $("#ListDistrict").css("display","none");
	  location.reload();
      })
      
});
var ListDistrict_is_load=1;