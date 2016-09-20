require(['jquery'], function($){
	//上滑效果
	$(document).ready(function(){$('.listimg').hover(function(){$(".summary",this).stop().animate({top:'110px'},{queue:false,duration:180});},function(){$(".summary",this).stop().animate({top:'165px'},{queue:false,duration:180});});});
	//评论列表
	//function get_comment_list(obj)
	get_comment_list =function (obj)
	{
	$.ajax(
	    {
	        type:'get',
	        url : share_url+"index.php?s=/Yocms_widget/get_widget&Widget=ListComment&template=Yocms_image_list_94&condition[share_id]="+$(obj).attr('share-data-id')+"&action_url={:U('Comment/add_comment')}&t=default_theme",
	        dataType : 'text',
	        //jsonp:"jsoncallback",
	        success  : function(data) {
	            //alert(data);
				if($("#Yocms_comment_image_list_94").length>0)
				{
					//元素存在就移除
					$("#Yocms_comment_image_list_94").html('&nbsp;');
					$("#Yocms_comment_image_list_94").remove();
					//alert('remove');
				}
				$("body").append(data);
				$("#Yocms_comment_image_list_94").css("display","none");
				$("#Yocms_comment_image_list_94").css("width","500px");
				$("#Yocms_comment_image_list_94").css("position","absolute");
				$("#Yocms_comment_image_list_94").css("top",$(document).scrollTop()+50);
				$("#Yocms_comment_image_list_94").css("left",($(window).width())/4);
				$("#Yocms_comment_image_list_94").toggle();
				
	        },
	        error : function(data) {
	            alert('fail');
	        }
	    }
	);
}
	//显示隐藏，id一般为widget内使用,类widget外使用
	$("#Yocms_image_list_90_toggle,.Yocms_image_list_90_toggle,#Yocms_image_list_90_close,.Yocms_image_list_90_close,#Yocms_image_list_90_open,.Yocms_image_list_90_open").live("click",function(event){
		$("#Yocms_image_list_90").css("top",$(document).scrollTop()+50);
		$("#Yocms_image_list_90").css("left",($(window).width())/4);
		$("#Yocms_image_list_90").css("position","absolute");
		$("#Yocms_image_list_90").toggle();
	})
});
var Yocms_ListShare_image_list_90_is_load=1;
console.log(Yocms_ListShare_image_list_90_is_load);