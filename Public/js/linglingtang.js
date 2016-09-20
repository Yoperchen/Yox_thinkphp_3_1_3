/**
* @description linglingtang.js 依赖于jquery、jquerycookie的零零糖模块 零零糖站点使用
* @author Yoper
* @email 944975166@qq.com
* @version 1.0  20160528
*/
;define(['jquery','jquerycookie'], function($){

	return {
		//设置主题颜色
		set_theme_color : function(theme_color)
		{
			$.cookie('theme_color', null); 
			$.cookie('theme_color', theme_color,{expires: 365*2, path: '/'}); //有效期2年
			window.location.href='?theme_color='+theme_color;
			//location.reload();
		},
		/**
		 * 弹出小部件
		 * @param string widget_name 小部件名称|ListArticle
		 * @param string template    小部件模版|Yocms_list_80
		 * @param json   condition   条件    |{ name: "John", location: "Boston" }
		 * @param string widget_id   节点id
		 * @return html
		 */
		alert_widget : function(widget_name,template,condition,widget_id)
		{
			if($('#'+widget_id).length>0)
			{
				$('#'+widget_id).toggle();
				return;
			}
			//thinkphp路径参数
			var s = {'s':'/Yocms_widget/get_widget'};
			//将路径参数和条件参数合并
			var param = $.extend({}, s,condition);
			$.ajax(
			    {
			        type:'get',
			        url : "/index.php",
			        dataType : 'text',
			        data: param,
			        //jsonp:"jsoncallback",
			        beforeSend : function(){
	                	var top = wh / 2;
	                	//var loadingPic = wap_root + 'tpl/imgs/loading.gif';
	                	$('<div id="prompt" style="width:'+dw+'px;height:'+dh+'px;position:fixed;top:0;left:0;z-index:1100;">'
	                			+'<div style="width:100%;height:90px;line-height:100px;text-align:center;position:fixed;top:'+top+'px;left:0;">'
	                				+'<b style="background:rgba(0,0,0,0.7) url('/*+loadingPic*/+') no-repeat 50% 28%;padding:15px;height:60px;border-radius:4px;line-height:100px;text-align:center;color:#efefef; display:inline-block;font-size:14px;box-shadow: 0px 0px 8px rgba(0,0,0,.4);">正在载入，请稍候...</b>'
	                			+'</div>'
	                	+'</div>').appendTo('body').fadeIn(500);
	                },
			        complete : function(){
	                	$('#prompt').fadeOut(1000).remove();
	                },
			        success  : function(data) {
			            //alert(data);
						$("body").append(data);
						$("#"+widget_id).css("display","none");
						$("#"+widget_id).css("position","absolute");
						$("#"+widget_id).css("top",$(document).scrollTop()+50);
						$("#"+widget_id).css("left",($(window).width())/8);
						$("#"+widget_id).toggle();
						
			        },
			        error : function(data) {
			            alert('fail');
			        }
			    }
			);
		},
		get_data : function(url,param,callback)
		{
			//var stype = stype || 'GET';
            $.ajax({
                type: 'GET',
                url:  url,
                dataType: 'json',
                data: param,  //{ name: "John", location: "Boston" }
                beforeSend : function(){
                	var top = wh / 2;
                	//var loadingPic = wap_root + 'tpl/imgs/loading.gif';
                	$('<div id="prompt" style="width:'+dw+'px;height:'+dh+'px;position:fixed;top:0;left:0;z-index:1100;">'
                			+'<div style="width:100%;height:90px;line-height:100px;text-align:center;position:fixed;top:'+top+'px;left:0;">'
                				+'<b style="background:rgba(0,0,0,0.7) url('/*+loadingPic*/+') no-repeat 50% 28%;padding:15px;height:60px;border-radius:4px;line-height:100px;text-align:center;color:#efefef; display:inline-block;font-size:14px;box-shadow: 0px 0px 8px rgba(0,0,0,.4);">正在载入，请稍候...</b>'
                			+'</div>'
                	+'</div>').appendTo('body').fadeIn(500);
                },
                complete : function(){
                	$('#prompt').fadeOut(1000).remove();
                },
                success: callback,
                error: function(xhr,status,errMsg){
                   //this.msgBox.alert({text:"网络不给力啊，再刷新试试看！"});
                }
            })
	    }
	};
});
