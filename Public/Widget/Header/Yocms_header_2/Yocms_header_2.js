require(['jquery','linglingtang'], function($,linglingtang){
	//主题颜色
	set_theme_color =function (theme_color)
	{
		linglingtang.set_theme_color(theme_color);
	}
	//天气
	$.ajax({    
	     type:'post',    
	     url:yo81008_url+'index.php',
	     data:{s:'/Index/get_weather_info'},    
	     cache:false,    
	     dataType:'jsonp',   
	     success:function(data){      
	               //alert(data.H);  
				   if(data.H<16){
				   $('#country_namecn').html(data.c.c9);//国家中文名
				   $('#country_nameen').html(data.c.c9);//国家英文名
				   $('#city_namecn').html(data.c.c3);//城市中文名
				   $('#city_nameen').html(data.c.c3);//城市英文名
				   $('#weather_phenomenon').html(data.f.f1[0].fa);//天气现象
				   $('#wind_power').html(data.f.f1[0].fe+''+data.f.f1[0].fg);//风/方向
				   $('#temperature').html(data.f.f1[0].fc+'~'+data.f.f1[0].fd+'℃');//温度
				   $('#month_day').html(data.month_day+'('+data.week+')');//月日
				   }else{
				   $('#country_namecn').html(data.c.c9);//国家中文名
				   $('#country_nameen').html(data.c.c9);//国家英文名
				   $('#city_namecn').html(data.c.c3);//城市中文名
				   $('#city_nameen').html(data.c.c3);//城市英文名
				   $('#weather_phenomenon').html(data.f.f1[1].fa);//天气现象
				   $('#wind_power').html(data.f.f1[1].fe+''+data.f.f1[1].fg);//风/方向
				   $('#temperature').html(data.f.f1[1].fc+'~'+data.f.f1[1].fd+'℃');//温度
				   $('#month_day').html(data.month_day+'('+data.week+')');//月日
				   }
	      },    
	      error:function(){
			//alert('bb');
		}    
	}); 
	//城市列表
	get_district_list =function (obj)
	{
	if($("#Yocms_list_city").length>0)
	{
		$("#Yocms_list_city").toggle();
		return;
	}
	$.ajax(
	    {
	        type:'get',
	        url : "/index.php?s=/Yocms_widget/get_widget&Widget=ListDistrict&template=Yocms_list_city&condition[group]=city_alphabet",
	        dataType : 'text',
	        //jsonp:"jsoncallback",
	        success  : function(data) {
	            //alert(data);
				$("body").append(data);
				$("#Yocms_list_city").css("display","none");
				$("#Yocms_list_city").css("position","absolute");
				$("#Yocms_list_city").css("top",$(document).scrollTop()+50);
				$("#Yocms_list_city").css("left",($(window).width())/8);
				$("#Yocms_list_city").toggle();
				
	        },
	        error : function(data) {
	            alert('fail');
	        }
	    }
		);
	}
});
var Yocms_header_2_is_load=1;
console.log(Yocms_header_2_is_load);