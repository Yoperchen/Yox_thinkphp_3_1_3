require(['jquery'], function($){
	$("#Yocms_header_3_sougou").click(function(){
		$("#Yocms_header_3_search_form").attr("action","https://www.sogou.com/web");
		$("#Yocms_header_3_keyword").attr("name","query");
		$("#Yocms_header_3_search_form").submit();
	})
	$("#Yocms_header_3_baidu").click(function(){
		$("#Yocms_header_3_search_form").attr("action","http://www.baidu.com/s");
		$("#Yocms_header_3_keyword").attr("name","wd");
		$("#Yocms_header_3_search_form").submit();
	})
	$("#Yocms_header_3_yahoo").click(function(){
		$("#Yocms_header_3_search_form").attr("action","https://search.yahoo.com/search");
		$("#Yocms_header_3_keyword").attr("name","p");
		$("#Yocms_header_3_search_form").submit();
	})
});
var Yocms_header_3_is_load=1;