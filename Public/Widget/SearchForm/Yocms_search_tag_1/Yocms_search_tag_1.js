require(['jquery','linglingtang'], function($,linglingtang){

	$(function($) {
	    // 搜索部分的逻辑 - 数据部分见 sejson.js 文件

	    var $wrap = $('#Yocms_search_tag_1');
	    var $tabs = $wrap.find('ul.cnav-list');
	    var $form = $wrap.find('form');

	    // 搜索form数据
	    var searchUrl = [
	        "http://www.baidu.com/s",
			"http://search.jd.com/Search",
			"http://s.taobao.com/search",
	        "http://video.baidu.com/v",
	        "http://image.baidu.com/i",
	        "http://news.baidu.com/ns",
			'http://mp3.sogou.com/music.so',
	        "http://dict.baidu.com/s"
	    ];
	    // ---------------------------------------------------------------
	    // 切换垂搜 tab
	    $tabs.find("li a").click(function(e) {
	        // update look
	        var li = $(this).parent();
	        if (li.hasClass("current")) return;
	        $tabs.find(".current").removeClass("current");
	        li.addClass("current");
	        // get index
	        var index = $tabs.find("li a").index($(this));
	        // get info
	        var url = searchUrl[index];
		if(url=="http://search.jd.com/Search")
		{
		$("#query").attr("name","keyword");
		$("#query").attr("value","裙子");
		$("#enc").attr("name","enc");
		}
		else if(url=="http://www.baidu.com/s"){
		$("#query").attr("name","wd");
		$("#query").attr("value","新番动漫");
		$("#enc").attr("name","ie");
		}else if(url=="http://s.taobao.com/search"){
		$("#query").attr("name","q");
		$("#query").attr("value","睡衣");
		$("#enc").attr("name","ie");
		}else if(url=="http://video.baidu.com/v"){
		$("#query").attr("name","word");
		$("#query").attr("value","我和僵尸有个约会");
		$("#enc").attr("name","ie");
		}else if(url=="http://image.baidu.com/i"){
		$("#query").attr("name","wd");
		$("#query").attr("value","搞笑图片");
		$("#enc").attr("name","ie");
		}else if(url=="http://news.baidu.com/ns"){
		$("#query").attr("name","word");
		$("#query").attr("value","国内新闻");
		$("#enc").attr("name","ie");
		}else if(url=="http://mp3.sogou.com/music.so"){
		$("#query").attr("name","query");
		$("#query").attr("value","星语心愿");
		}else if(url=="http://dict.baidu.com/s"){
		$("#query").attr("name","wd");
		$("#query").attr("value","天天向上");
		$("#enc").attr("name","ie");
		}
	        // update form
	        $form.attr("action", url);
	        e.preventDefault();
	    });
	    // init form
	    $form.attr("action", searchUrl[0]);
	});
});
var Yocms_search_tag_1_is_load=1;
console.log(Yocms_search_tag_1_is_load);