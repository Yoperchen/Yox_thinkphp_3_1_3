require(['jquery'], function($){
	get_community_list =function (obj)
	{
	if($("#Yocms_list_community").length>0)
	{
		$("#Yocms_list_community").toggle();
		return;
	}
	$.ajax(
	    {
	        type:'get',
	        url : "/index.php?s=/Yocms_widget/get_widget&Widget=ListCommunity&template=Yocms_list_community&condition[group]=alphabet",
	        dataType : 'text',
	        //jsonp:"jsoncallback",
	        success  : function(data) {
	            //alert(data);
				$("body").append(data);
				$("#Yocms_list_community").css("display","none");
				$("#Yocms_list_community").css("position","absolute");
				$("#Yocms_list_community").css("top",$(document).scrollTop()+50);
				$("#Yocms_list_community").css("left",($(window).width())/8);
				$("#Yocms_list_community").toggle();
						
	        },
	        error : function(data) {
	            alert('fail');
	        }
	    }
	);
	}
});
var MiniHeader_is_load=1;
console.log(MiniHeader_is_load);