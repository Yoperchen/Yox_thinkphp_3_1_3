<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" type="text/css" href="__PUBLIC__/Widget/SearchForm/Yocms_search_tag_1/Yocms_search_tag_1_<?php echo (($css)?($css):'w1200_gray'); ?>.css">
<!-- 搜索 -->
<div id="Yocms_search_tag_1">
    <!-- logos 切换 -->
    <!--<a class="logo" href="<?php echo U('Yo81001/Index/index');?>" onclick="" target="_blank">零零糖网购网址</a>-->
    <!-- ...搜索... -->
    <div class="csearch-box">
        <ul class="cnav-list clearfix">
            <li class="current"><a href="#">百度</a></li>
            <li class="w_small"><span class="spline">|</span></li>
			<li class="w_big"><a href="javascript:;">京东</a></li>
			<li class="w_small"><span class="spline">|</span></li>
			<li class="w_big"><a href="javascript:;">淘宝</a></li>
            <li class="w_small"><span class="spline">|</span></li>
            <li class="w_big"><a href="javascript:;">视频</a></li>
            <li class="w_small"><span class="spline">|</span></li>
			<li class="w_big"><a href="javascript:;">图片</a></li>
            <li class="w_small"><span class="spline">|</span></li>
            <li class="w_big"><a href="javascript:;">热闻</a></li>
            <li class="w_small"><span class="spline">|</span></li>
			<li class="w_big"><a href="javascript:;">音乐</a></li>
            <li class="w_small"><span class="spline">|</span></li>
            <li class="w_big"><a href="javascript:;">词典</a></li>
        </ul>
        <!-- Begin 搜索相关 -->
        <form method="get" action="http://www.baidu.com/s" class="c-fm-w"  target="_blank">
		<img src="__PUBLIC__/Widget/SearchForm/Yocms_search_tag_1/luo_1.gif" style="float: left;height: 30px;">
            <!--Begin 搜索框 -->
            <span class="s-inpt-w">
                <input type="text"  value="" class="s-inpt" autocomplete="off" name="wd" id="query" />
                <!-- Begin 这两个SPAN 尽量写一行 -->
            </span><span class="s-btn-w">
                <!-- #End 这两个SPAN 尽量写一行 -->
                <input type="submit" class="s-btn" value="搜索一下" />
                <input type="hidden" value="utf-8" name="enc" id="enc">
				<a href="http://v.qq.com/search.html?pagetype=3&stj2=search.smartbox&stag=txt.smart_index&ms_key=%E6%88%91%E5%92%8C%E5%83%B5%E5%B0%B8%E6%9C%89%E4%B8%AA%E7%BA%A6%E4%BC%9A">●我和僵尸有个约会</a>
            </span>
            <!--End 搜索框 -->
            <div class="sg-wrap" style="width: 502px;display:none">
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <td valign="top">
                            <ul class="sg-result-list"></ul>
                        </td>
                        <td class="sob-wrap"></td>
                    </tr>
                </table>
            </div>
        </form>
        <!--#End 搜索相关-->
        <!-- #End 搜索框 --> 
    </div>
	<div class="search_keyword">
	<a target="_blank" href="http://search.jd.com/Search?keyword=%E8%BF%9E%E8%A1%A3%E8%A3%99%20%E5%A4%8F&enc=utf-8">连衣裙</a>
	<a target="_blank" href="http://search.jd.com/Search?keyword=%E6%89%93%E5%BA%95%E8%A1%AB&enc=utf-8">打底衫</a>
	<a target="_blank" href="http://search.jd.com/Search?keyword=%E9%9D%A2%E8%86%9C&enc=utf-8">面膜</a>
	<a target="_blank" href="http://list.jd.com/list.html?cat=1318,1463,1484">跑步机</a>
	<a target="_blank" href="http://search.jd.com/Search?keyword=%E5%90%B8%E5%B0%98%E5%99%A8&enc=utf-8">家用吸尘器</a>
	</div>
</div> 
<style type="text/css">
body{
background: url(../Public/image/love_bg_index.jpg) no-repeat 0px 29px;
background-color: #FDE2EB;
}
</style>
<script>
require(['jquery'], function($){
	if(typeof(Yocms_search_tag_1_is_load)=="undefined"){
		$("body").append('<script src="__PUBLIC__/Widget/SearchForm/Yocms_search_tag_1/Yocms_search_tag_1.js" type="text/javascript"><\/script>');
	}
});
</script>