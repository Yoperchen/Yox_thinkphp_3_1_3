require(['jquery'], function($){
//alert("aaa");alert($().jquery);

	//回复
	$("#Yocms_comment_image_list_94 .reply").live("click",function(event){
		$("#Yocms_comment_image_list_94 #reply_form_"+$(this).attr('comment-id')).toggle();
	});
	
	//顶
	$("#Yocms_comment_image_list_94 .up").live("click",function(event){
		$(this).text('[已顶]');
		$(this).css('color','#74AFE3');
		$(this).css('cursor','auto');
//		$(this).unbind("click"); //移除click事件
		$.ajax( {
			url:common_url+'index.php?s=/Comment/update_comment.html',// 跳转到 action  
			data:{id : $(this).attr("comment-id"),up :1},  
			 type:'post',  
			 cache:false,  
			 dataType:'json',  
			 success:function(data) {  
			     if(data.msg =="true" ){  
			 // view("修改成功！");  
			 alert("修改成功！");  
			         window.location.reload();  
			     }else{  
			         view(data.msg);  
			     }  
			  },  
			  error : function() {  
			       // view("异常！");  
			   alert("异常！");  
			}  
			});
	});
	
	//踩下去
	$("#Yocms_comment_image_list_94 .down").live("click",function(event){
		$(this).text('[已踩]');
		$(this).css('color','#B4D9F9');
		$(this).css('cursor','auto');
		$.ajax( {
			url:common_url+'index.php?s=/Comment/update_comment.html',// 跳转到 action  
			data:{id : $(this).attr("comment-id"),up :-1},  
			 type:'post',  
			 cache:false,  
			 dataType:'json',  
			 success:function(data) {  
			     if(data.msg =="true" ){  
			 // view("修改成功！");  
			 alert("修改成功！");  
			         window.location.reload();  
			     }else{  
			         view(data.msg);  
			     }  
			  },  
			  error : function() {  
			       // view("异常！");  
			   alert("异常！");  
			}  
			});
	});
	
	//举报
	$("#Yocms_comment_image_list_94 .complaint").live("click",function(event){

	});
	
	//评论的显示隐藏，id一般为widget内使用,类widget外使用
	$("#Yocms_comment_image_list_94_toggle,.Yocms_comment_image_list_94_toggle,#Yocms_comment_image_list_94_close,.Yocms_comment_list_94_close,#Yocms_comment_image_list_94_open,.Yocms_comment_image_list_94_open").live("click",function(event){
		$("#Yocms_comment_image_list_94").css("top",$(document).scrollTop()+50);
		$("#Yocms_comment_image_list_94").css("left",($(window).width())/4);
		$("#Yocms_comment_image_list_94").toggle();
	});
});
var Yocms_comment_image_list_94_is_load=1;
console.log(Yocms_comment_image_list_94_is_load);