require(['jquery','linglingtang'], function($,linglingtang){

	$(function($) {
	    // 搜索部分的逻辑 - 数据部分见 sejson.js 文件

	    var $wrap = $('#Yocms_search_tag_3');
	    var $tabs = $wrap.find('ul.cnav-list');
	    var $form = $wrap.find('form');

	    // 搜索form数据
	    var searchUrl = [
	        "http://www.baidu.com/s",
			"http://search.jd.com/Search",
			"http://s.taobao.com/search",
	        "http://video.baidu.com/v",
	        "http://image.baidu.com/i",
	        //"http://news.baidu.com/ns",
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
		$wrap.find("#query").attr("name","keyword");
		$wrap.find("#query").attr("value","裙子");
		$wrap.find("#enc").attr("name","enc");
		}
		else if(url=="http://www.baidu.com/s"){
		$wrap.find("#query").attr("name","wd");
		$wrap.find("#query").attr("value","新番动漫");
		$wrap.find("#enc").attr("name","ie");
		}else if(url=="http://s.taobao.com/search"){
		$wrap.find("#query").attr("name","q");
		$wrap.find("#query").attr("value","睡衣");
		$wrap.find("#enc").attr("name","ie");
		}else if(url=="http://video.baidu.com/v"){
		$wrap.find("#query").attr("name","word");
		$wrap.find("#query").attr("value","我和僵尸有个约会");
		$wrap.find("#enc").attr("name","ie");
		}else if(url=="http://image.baidu.com/i"){
		$wrap.find("#query").attr("name","wd");
		$wrap.find("#query").attr("value","搞笑图片");
		$wrap.find("#enc").attr("name","ie");
		}else if(url=="http://news.baidu.com/ns"){
		$wrap.find("#query").attr("name","word");
		$wrap.find("#query").attr("value","国内新闻");
		$wrap.find("#enc").attr("name","ie");
		}else if(url=="http://mp3.sogou.com/music.so"){
		$wrap.find("#query").attr("name","query");
		$wrap.find("#query").attr("value","星语心愿");
		}else if(url=="http://dict.baidu.com/s"){
		$wrap.find("#query").attr("name","wd");
		$wrap.find("#query").attr("value","天天向上");
		$wrap.find("#enc").attr("name","ie");
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