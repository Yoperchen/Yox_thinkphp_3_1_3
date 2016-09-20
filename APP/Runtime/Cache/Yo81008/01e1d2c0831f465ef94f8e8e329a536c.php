<?php if (!defined('THINK_PATH')) exit();?>﻿<!doctype html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<meta name="baidu-site-verification" content="7DVfJZhPVt" />
<meta property="qc:admins" content="1001526117641674167416763757" />
<meta name="keywords" content="零零糖,购物大全,零零糖网址导航,网购导航,购物导航,零零糖购物网站,零零糖我和僵尸有个约会,零零糖马小玲,零零糖况天佑"/>
<meta name="description" content="零食的零，糖果的糖。零零糖和马小零为喜欢购物的小伙伴们提供丰富的购物体验哦,么么哒;集合全国各大购物网站,常用网站网址,我和购物有个零零糖约会"/>
<title>零零糖首页_上网、购物、搜索、爱学习从这里开始_网购首页_购物网站</title>
<link href="../Public/nav_<?php echo ((cookie('theme_color'))?(cookie('theme_color')):'pink'); ?>.css?201311221" rel="stylesheet" type="text/css" />
<link href="../Public/suggest_<?php echo ((cookie('theme_color'))?(cookie('theme_color')):'pink'); ?>.css?201311221" type="text/css" rel="stylesheet" />
<link href="../Public/s_form_<?php echo ((cookie('theme_color'))?(cookie('theme_color')):'pink'); ?>.css?201311221" type="text/css" rel="stylesheet" />
<link href="../Public/index_<?php echo ((cookie('theme_color'))?(cookie('theme_color')):'pink'); ?>.css?201311221" type="text/css" rel="stylesheet" />
<link rel="icon" href="__PUBLIC__/favicon.ico" mce_href="__PUBLIC__/favicon.ico" type="image/x-icon">
<script type="text/javascript" src="__PUBLIC__/js/require.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/main.js"></script>
</head>
<body>
<link href="../Public/mini_header_<?php echo ((cookie('theme_color'))?(cookie('theme_color')):'pink'); ?>.css" rel="stylesheet" type="text/css" />
<div id="top">
    <div class="top-wrap">
              <a href="<?php echo U('Index/index@yo81008');?>" title="首页" style="color:#D80321">零零糖</a> - 零食的零，糖果的糖 - 上网、购物、搜索、爱学习从这里开始
    		<div class="userinfo">
			<a id="community_name" data-community-id="<?php echo ((cookie('community_id'))?(cookie('community_id')):'44'); ?>" title="学校名称" style="color:#D80321"><?php echo ((cookie('community_name'))?(cookie('community_name')):'北京大学'); ?></a>
			<a href="javascript:;" onclick="get_community_list(this)" title="选择学校">切换</a>&nbsp;
			<?php if($_SESSION['id']!= ''): ?>欢迎您<!--<a href="<?php echo U('User/index@Yo81008');?>" title="喵~"><?php echo ((session('name'))?(session('name')):"这家伙很懒，什么也没留下"); ?></a>-->
			<a href="<?php echo U('User/logout@Yo81008');?>">退出</a>
 			<?php else: ?>
			<form id="login_form" name="login_form" action="<?php echo U('Index/login@Yo81008');?>" method="post">
                <span>账号</span>
                <input type="text" id="user_id" name="id"/>
                <span>密码</span>
                <input type="password" id="user_password" name="password" />
                <input style="border-radius: 15px;  BACKGROUND: #FF0000;border: 1px solid #FFFFFF;color: #fff;cursor: pointer;" type="submit" name="submit_login" value="登陆"/>
            </form>
			没有帐号?去<a style="color:green;" href="<?php echo U('Index/register@Yo81008');?>">注册</a><?php endif; ?>
        </div>
    </div>
</div>
<script>
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
</script>


<div style="width: 1000px;margin: 0 auto;">
	<div id="hd">
	            <!-- logo -->
	            <a class="logo" href="http://www.linglingtang.com/" title="零零糖网购首页" onclick="" target="_blank">
				<img src="../Public/image/logo_<?php echo ((cookie('theme_color'))?(cookie('theme_color')):'pink'); ?>.png" alt="零零糖购物LOGO" title="零零糖">
				</a>
	            <!-- 日历 -->
	            <div id="calendarWrap">
	    <p class="date" curdate="1399951259983">
	        <span>逛逛街</span>
	        <span>&nbsp;</span>
	        <span class="time">买东西</span>
	    </p>
	            <p class="qa">
	        <a href="http://union.click.jd.com/jdc?e=&p=AyIEZRhaFgAaB1YdXCUBEwRXE1sWBBs3EUQDS10iXhBeGh4cDFsFRgYKWUcYB0UHC1pNUgFSRxwKEA5RBAJQXk83HWcfEXF0BQl7KE11blQxUz9nXVJZJRdXJQMiBFEZWxYCEgdRK2t0cCJGOxJTFwsW&t=W1dCFBBFC15CWggEAEAdQFkJBQNKV0ZOSRJTFwsWGAxeB0g%3D" onclick="" target="_blank">天天特价精选<!--Yoper--></a>
	    </p>
	    </div>  
		<div class="weatherWrap" style="left:308px;">
			<div style="
		    float: left;
		    width: 27%;
		    display: block;
		    height: 100%;
		    padding-left: 12px;
		    padding-top: 14px;
		">
		  <span id="month_day" style="margin-top: 0px;padding-bottom: 10px;display: block;color: #999;">6月27日(五)</span>

		  <span style="margin-top: 10px;padding-bottom: 10px;    display: block;color: #999;"><!--农历五月十二--></span>
		  </div>
		  <div style="float: left; width: 40%;display: block;height: 100%; padding-left: 12px;padding-top: 14px;">
		  <span id="city_namecn" style="color: #999;"></span><a onclick="get_district_list(this)" style="color:#999" href="javascript:;">(切换)</a>
		  <span id="weather_phenomenon" style="color: #999;"></span>
		  <span id="temperature" style="color: #999;"></span>
		  <span id="wind_power" style="color: #999; display: block;"></span>
		    </div>
		</div>
				<!-- 广告 -->
	            <div id="adao">
				<!--京东推广-->
				<a title="女生主题" onclick="set_theme_color($(this).attr('data-theme-color'))" href="javascript:;" data-theme-color="pink"><img height="100%" src="../Public/image/face/luo_1.gif"></a>
				<a title="男生主题" onclick="set_theme_color($(this).attr('data-theme-color'))" href="javascript:;" data-theme-color="dark"><img height="100%" src="../Public/image/face/luo_2.png"></a>
				<a title="白色主题" onclick="set_theme_color($(this).attr('data-theme-color'))" href="javascript:;" data-theme-color="white"><img height="100%" src="../Public/image/face/luo_3.png"></a>
				<a title="主题待开发" onclick="set_theme_color($(this).attr('data-theme-color'))" href="javascript:;" data-theme-color="dark"><img height="100%" src="../Public/image/face/luo_4.png"></a>
				<a title="主题待开发" onclick="set_theme_color($(this).attr('data-theme-color'))" href="javascript:;" data-theme-color="pink"><img height="100%" src="../Public/image/face/luo_5.png"></a>
				<a title="主题待开发" onclick="set_theme_color($(this).attr('data-theme-color'))" href="javascript:;" data-theme-color="dark"><img height="100%" src="../Public/image/face/luo_6.png"></a>
				<!--京东推广-->
				</div>
		<link href="../Public/search_tag_index_<?php echo ((cookie('theme_color'))?(cookie('theme_color')):'pink'); ?>.css" rel="stylesheet" type="text/css" />
   <!-- 搜索 -->
    <div id="searchWrap">
    <!-- logos 切换 -->
    <!--<a class="logo" href="<?php echo U('Yo81001/Index/index');?>" onclick="" target="_blank">零零糖网购网址</a>-->
    <!-- ...搜索... -->
    <div class="csearch-box">
        <ul class="cnav-list clearfix">
            <li class="current"><a href="#">百度</a></li>
            <li style="width:20px;"><span class="spline">|</span></li>
			<li><a href="javascript:;">京东</a></li>
			<li style="width:20px;"><span class="spline">|</span></li>
			<li><a href="javascript:;">淘宝</a></li>
            <li style="width:20px;"><span class="spline">|</span></li>
            <li><a href="javascript:;">视频</a></li>
            <li style="width:20px;"><span class="spline">|</span></li>
			<li><a href="javascript:;">图片</a></li>
            <li style="width:20px;"><span class="spline">|</span></li>
            <li><a href="javascript:;">热闻</a></li>
            <li style="width:20px;"><span class="spline">|</span></li>
			<li><a href="javascript:;">音乐</a></li>
            <li style="width:20px;"><span class="spline">|</span></li>
            <li><a href="javascript:;">词典</a></li>
        </ul>
        <!-- Begin 搜索相关 -->
        <form method="get" action="http://www.baidu.com/s" class="c-fm-w"  target="_blank">
		<img src="../Public/image/face/luo_1.gif" style="float: left;height: 30px;">
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
<script>
require(['jquery'], function($){
	$(function($) {
	    // 搜索部分的逻辑 - 数据部分见 sejson.js 文件

	    var $wrap = $('#searchWrap');
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
</script>
	</div>
</div>
			<script>

			require(['jquery'], function($){

			$.ajax({    
			     type:'post',    
			     url:"<?php echo U('Yo81008/Index/get_weather_info');?>",
			     data:{},    
			     cache:false,    
			     dataType:'json',   
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
		require(['linglingtang'], function(linglingtang){
			set_theme_color =function (theme_color)
			{
			linglingtang.set_theme_color(theme_color);
			}
		});
			</script>
 <div id="doc2">
        <!-- 中间区域-->
        <div id="bd">
            <div id="yao-main">
    <div class="yao-b">
        <!-- 推荐模块 -->
        <div id="recommendLinks" class="mod clearfix">
		                        <span>
                                    <a href="http://www.qq.com" target="_blank" class="yd- icon icon-qq" onclick=" ">腾讯网</a>
									<!--<a href="http://qzone.qq.com/" target="_blank" class="yd-" onclick=" ">空间</a>-->
                                                </span>
                        <span>
                                    <a href="http://www.sina.com.cn" target="_blank" class="yd- icon icon-sina" onclick=" ">新浪网</a>
                                    <!--<a href="http://weibo.com/?c=spr_mthz_163_163mz_weibo_t001" target="_blank" class="yd-" onclick=" ">微博</a>-->
                                                </span>
						<span>
                                    <a href="http://www.baidu.com/" target="_blank" class="yd- icon icon-baidu" onclick=" ">百度一下</a>
                                     <!--<a href="http://tieba.baidu.com/" target="_blank" class="yd-" onclick=" ">贴吧</a>-->
                                                </span>
                        <span>
                                    <a href="http://www.sohu.com/" target="_blank" class="yd- icon icon-sohu" onclick=" ">搜狐网</a>
                                    <!-- <a href="http://tv.sohu.com/" target="_blank" class="yd-" onclick=" ">视频</a>-->
                                                </span>
                        <span>
                                    <a href="http://www.163.com" target="_blank" class="yd- icon icon-163" onclick=" ">网易网</a>
                                     <!--<a href="http://mail.163.com" target="_blank" class="yd-" onclick=" ">邮箱</a>-->
                                                </span>

                        <span>
                                    <a href="http://www.ifeng.com/" target="_blank" class="yd- icon icon-ifeng" onclick=" ">凤凰网</a>
                                     <!--<a href="http://tech.ifeng.com/" target="_blank" class="yd-" onclick=" ">科技</a>-->
                                                </span>
						<span>
									<!--<img src="../Public/image/yuan.png">-->
                                    <a href="http://www.taobao.com/" target="_blank" class="yd- icon icon-taobao" onclick=" ">
									淘宝网
									</a>
                                                </span>
                       <span>
                                    <a href="http://union.click.jd.com/jdc?e=&p=AiIBZRprFDJWWA1FBCVbV0IUEEULRFRBSkAOClBMW0srE05%2BewIqbS52YkZTLkUyFQUIAQFJHRkOIgZlGF8XAhEHVRtfJTJzdWU%3D&t=W1dCFBBFC0RUQUpADgpQTFtL" target="_blank" class="yd-red icon icon-jd" onclick=" ">
									京东商城<!--Yoper--></a>
                                                </span>
					   <span>
                                    <a href="http://tmall.com" target="_blank" class="yd- yd-green icon icon-tmall" onclick=" ">
									天猫商城</a>
                                                </span>
					   <span>
                                    <a href="http://cps.gome.com.cn/home/JoinUnion?sid=6934&wid=9188&feedback=&to=http://www.gome.com.cn" target="_blank" class="yd- icon icon-gome" onclick=" ">
									国美
									<!--Yoper--></a>
                                                </span>
					   <span>
                                    <a href="http://www.meilishuo.com?nmref=NM_s11883_0_meilishuo&channel=40106" target="_blank" class="yd- icon icon-meilishuo" onclick=" ">
									美丽说<!--Yoper--></a>
                                                </span>
					   <span>
                                    <a href="http://click.yhd.com/?ut=1070220854&s=NGE4YTFlZTFmZDAxMzA2ZWExM2ZmYTI4ZjYzYjg4NWQ5NjZhNmE2YjdkMDU0ZDk5NDY5Y2FmNGY0MzQ2MTdiYmVhYmIyZmI4NDIxMjk4MDg0Yjk0NTNhOWU3MmU2NDg1&cv=1" target="_blank" class="yd- yd-green" onclick=" ">
									一号店<!--Yoper--></a>
                                                </span>
						<span>
                                    <a href="http://www.mogujie.com/trade/click?c=19&u=138ydum&t=http%3A%2F%2Fwww.mogujie.com" target="_blank" class="yd-" onclick=" ">蘑菇街<!--Yoper--></a>
                                                </span>
					   <span>
                                    <a href="http://www.vancl.com/?source=divencheng" target="_blank" class="yd-" onclick=" ">凡客诚品</a>
                                                </span>
					   <span>
                                    <a href="http://www.yixun.com" target="_blank" class="yd-" onclick=" ">易迅网</a>
                                                </span>
					   <span>
                                    <a href="http://union.suning.com/aas/open/vistorAd.action?userId=5100054&webSiteId=0&adInfoId=00&adBookId=0&vistURL=http://www.suning.com" target="_blank" class="yd- yd-green" onclick=" ">苏宁易购<!--Yoper--></a>
                                                </span>
					   <span>
                                    <a href="http://r.union.meituan.com/url/visit/?a=1&key=c7e44d9f04c1dd2e57de362040010b80776&url=http%3A%2F%2Fwww.meituan.com" target="_blank" class="yd- yd-red" onclick=" ">美团网<!--Yoper--></a>
                                                </span>
					   <span>
                                    <a href="http://www.jumei.com/" target="_blank" class="yd-" onclick=" ">聚美优品</a>
                                                </span>
						<span>
                                    <a href="http://www.youku.com/" target="_blank" class="yd- icon icon-youku" onclick=" ">优酷网</a>
                                                </span>
						<span>
                                    <a href="http://www.iqiyi.com/" target="_blank" class="yd- yd-green icon icon-iqiyi" onclick=" ">爱奇艺</a>
                                                </span>
                        <span>
                                    <a href="http://www.xinhuanet.com/" target="_blank" class="yd- icon icon-xinhuanet" onclick=" ">新华</a>
									<!--<a href="http://www.people.com.cn/" target="_blank" class="yd-" onclick=" ">人民网</a>-->
                                                </span>
                        <span>
                                    <a href="http://danhuaer.com/" target="_blank" class="yd- icon icon-danhuaer" onclick=" ">蛋花儿</a>
                                                </span>
						<span>
                                    <a href="http://www.4399.com/" target="_blank" class="yd- icon icon-4399" onclick=" ">4399游戏</a>
									<!--<a href="http://www.3366.com/" target="_blank" class="yd-" onclick=" ">3366</a>-->
                                                </span>
                        <span>
                                    <a href="http://www.pconline.com.cn/" target="_blank" class="yd- icon icon-pconline" onclick=" ">太平洋</a>
                                                </span>
                        <span>
                                    <a href="http://www.renren.com/" target="_blank" class="yd-" onclick=" ">人人网</a>
                                                </span>
                        <span>
                                    <a href="http://www.10086.cn/service" target="_blank" class="yd-" onclick=" ">中国移动</a>
                                                </span>
                        <span>
                                    <a href="http://www.cntv.cn/" target="_blank" class="yd-" onclick=" ">央视网</a>
                                                </span>
                        <span>
                                    <a href="http://www.douban.com/" target="_blank" class="yd-" onclick=" ">豆瓣</a>
                                                </span>
                        <span>
                                    <a href="http://www.autohome.com.cn/" target="_blank" class="yd-" onclick=" ">汽车之家</a>
                                                </span>
                        <span>
                                    <a href="http://union.dangdang.com/transfer.php?from=P-327755&ad_type=10&sys_id=1&backurl=http%3A%2F%2Fwww.dangdang.com" target="_blank" class="yd- yd-red" onclick=" ">当当网<!--Yoper--></a>
                                                </span>
                        <span>		<a href="http://www.58.com/" target="_blank" class="yd- icon icon-58" onclick=" ">58同城</a>
                                    <!--<a href="http://www.ganji.com/" target="_blank" class="yd-" onclick=" ">赶集网</a>-->
                                                </span>
                        <span>
                                    <a href="http://www.zhaopin.com/" target="_blank" class="yd-" onclick=" ">智联招聘</a>
                                                </span>
                        <span>
                                    <a href="http://www.mangocity.com/" target="_blank" class="yd-" onclick=" ">芒果旅行网</a>
                                                </span>
                        <span>
                                    <a href="http://www.sfbest.com" target="_blank" class="yd-" onclick=" ">顺丰优选</a>
                                                </span>
                        <span>
                                    <a href="http://www.icbc.com.cn" target="_blank" class="yd-" onclick=" ">工商银行</a>
                                                </span>
                        <span>
                                    <a href="http://www.jiayuan.com/" target="_blank" class="yd-" onclick=" ">世纪佳缘</a>
                                                </span>
                        <span>
                                    <a href="http://www.nuomi.com" target="_blank" class="yd-" onclick=" ">糯米网</a>
                                                </span>
                        <span>
                                    <a href="http://www.amazon.cn" target="_blank" class="yd- yd-green" onclick=" ">亚马逊</a>
                                                </span>
                        <span>
                                    <a href="http://click.union.vip.com/redirect.php?url=eyJzY2hlbWVjb2RlIjoiZjVhMDVkNjYiLCJkZXN0dXJsIjoiaHR0cDpcL1wvd3d3LnZpcC5jb20iLCJ1Y29kZSI6InV2OHdmZ3hvIn0=" target="_blank" class="yd- yd-green" onclick=" ">唯品会<!--Yoper--></a>
                                                </span>
                        <span>
                                    <a href="http://sex.guokr.com/" target="_blank" class="yd- yd-green" onclick=" ">知性</a>
                                                </span>
						<span>
                                    <a href="http://www.vjia.com/WebSource/WebSource.aspx?source=Yoper&url=http://www.vjia.com" target="_blank" class="yd- icon icon-vjia" onclick=" ">vjia商城<!--Yoper--></a>
                                                </span>
						<span>
                                    <a href="http://union.500.com/pages/interfacehezuo.php?coopid=1605&adid=97" target="_blank" class="yd-" onclick=" ">500彩票</a>
                                                </span>
						<span>
                                    <a href="http://union.moonbasa.com/rd/rd.aspx?e=-999&adtype=0&unionid=Yoper&subunionid=&other=&url=http%3a%2f%2fwww.moonbasa.com%3ftype%3d0%26cn%3d13960%26other%3dunionid%3aYoper%7cadtype%3a0%7cadid%3a-999%7cadwords%3a%26adsiteid%3d10000007" target="_blank" class="yd- yd-red" onclick=" ">梦芭莎<!--Yoper--></a>
                                                </span>
 						<span>
                                    <a href="http://union.click.jd.com/jdc?e=&p=AyIEZRhaFgAaB1YdXCUBEwRXE1sWBBs3EUQDS10iXhBeGh4cDFsFRgYKWUcYB0UHC1pNUgFSRxwKEA5RBAJQXk83Nl4ITFcXXit%2BJk0ATlg2QDARe2xTExdXJQMiBFEZWxYCEgdRK2t0cCJGOxJTFwsW&t=W1dCFBBFC15CWggEAEAdQFkJBQNKV0ZOSRJTFwsWGAxeB0g%3D" target="_blank" class="yd- yd-red" onclick=" ">妠妮娅旗舰店<!--Yoper--></a>
                                                </span>
						<span>
                                    <a href="http://union.click.jd.com/jdc?e=&p=AyIEZRhSEwAXB1QfUiUBGwFXHlsUBRE3EUQDS10iXhBeGh4cDFsFRgYKWUcYB0UHC1pNUgFSRxUAEwRUHkRMR05aZWsGFgFNeFVNPhNkdH1RWVNhfmVeN2tXGTITN1YfWRUBEgdVH2slY2A3FHVbFwMRBlA%3D&t=W1dCFBBFC15CWggEAEAdQFkJBQNKV0ZOSRtZFAETAkpCHklf" target="_blank" class="yd- yd-red" onclick=" ">倍恩日用专营店<!--Yoper--></a>
                                                </span>
						<span>
                                    <a href="http://union.click.jd.com/jdc?e=&p=AyIBZRprFDJWWA1FBCVbV0IUEEULX0pFEAQAQB1AWQkFBk1AVxgMXgdIDEBXEBdfFAEWGlEaWBIfEgRUE1glQVp7IUVBdkFwXwlYXXN0a0MtfgJWVB4LZRhSHAYWBlYZXyUBFgVVGFsVAhY3ZXopJTI%3D&t=W1dCFBBFC19KRRAEAEAdQFkJBQZNQFcYDF4HSAxAVxAXXxQBFhpRGlgSHxIEVBNY" target="_blank" class="yd- yd-red" onclick=" ">女表<!--Yoper--></a>
                                                </span>
						<span>
                                    <a href="http://union.click.jd.com/jdc?e=&p=AyIEZRhSHQYbAVAcXCUBGw9REl0QChE3EUQDS10iXhBeGh4cDFsFRgYKWUcYB0UHC1pNUgFSRxUCGw9QGkRMR05aZXNZSkthDwsFOXNSSgAteTBPYHoEIGtXGTITN1YfWRUBEgdVH2slY2A3FHVbFQsaAlQ%3D&t=W1dCFBBFC15CWggEAEAdQFkJBQNKV0ZOSRtbHAoXBkpCHklf" target="_blank" class="yd- yd-red" onclick=" ">诺韩女性<!--Yoper--></a>
                                                </span>
						<span>
                                    <a href="http://union.click.jd.com/jdc?e=&p=AyIHZRhTFAYbAVASUiUCEgdTHlkXBBEOZV8ETVxNNwxeHlQJDBkNXg9JHUlSSkkFSRwSB1UdXhcAFARcBAJQXk83MWQIUWMMWD54GFFgcmIJBV9XZxIPExdXJQMiBFEZWxYCEgdRK2t0cCJGOxtTFgoV&t=W1dCFBBFC1pXUwkEAEAdQFkJBVsVAhQCVxldFgsNXhBHBg%3D%3D" target="_blank" class="yd- yd-red" onclick=" ">连体裙式游泳衣<!--Yoper--></a>
                                                </span>
						<span>
                                    <a href="http://union.click.jd.com/jdc?e=&p=AyIBZRprFDJWWA1FBCVbV0IUEEULUEtXCkQPSB1JUkpJBUkcGg5QHUcdCxYHSkIeSV8ifghZGUFiDAI1GB9hYXJlIEw8FWJCUVkXaxYLGwNRGlgXBiIEURlbFgISB1Era3RwIjc%3D&t=W1dCFBBFC1BLVwpED0gdSVJKSQVJHBoOUB1HHQsWB0pCHklf" target="_blank" class="yd- yd-red" onclick=" ">书房、家居<!--Yoper--></a>
                                                </span>
                    </div>
        
                                
                                        <div class="mod">
										<?php echo W('WidgetHeader',array('template'=>'WidgetHeader_2','css'=>'whp_'.cookie('theme_color'), 'Yocms_data'=>array('widget'=>'aa','list'=>array( array('title'=>'视频','src'=> U('Yo81008/Index/video'),'description'=>''), array('title'=>'小说','src'=>U('Yo81008/Index/xiaoshuo'),'description'=>''), array('title'=>'音乐','src'=>U('Yo81008/Index/yinyue'),'description'=>''), array('title'=>'游戏','src'=>U('Yo81008/Index/youxi'),'description'=>''), array('title'=>'社区','src'=>U('Yo81008/Index/shequ'),'description'=>''), array('title'=>'购物','src'=>U('Yo81008/Index/gouwu'),'description'=>''), array('title'=>'我和僵尸有个约会','src'=>'http://v.qq.com/search.html?pagetype=3&stj2=search.smartbox&stag=txt.smart_index&ms_key=%E6%88%91%E5%92%8C%E5%83%B5%E5%B0%B8%E6%9C%89%E4%B8%AA%E7%BA%A6%E4%BC%9A','description'=>'')))));?>

            <div class="bd clearfix">
                <dl>
                                    <dt>[<a href="<?php echo U('Yo81008/Index/video');?>" target="_blank" onclick="">视频</a>]</dt>
                                        <dd><a href="http://www.youku.com/" target="_blank" class="yd-black" onclick="">优酷网</a></dd>
										<dd><a href="http://www.iqiyi.com/" target="_blank" class="yd-black" onclick="">爱奇艺</a></dd>
                                        <dd><a href="http://v.163.com/" target="_blank" class="yd-black" onclick="">网易视频</a></dd>
                                        <dd><a href="http://tv.sohu.com/hdtv/" target="_blank" class="yd-black" onclick="">搜狐高清</a></dd>
                                        <dd><a href="http://www.letv.com/" target="_blank" class="yd-black" onclick="">乐视网</a></dd>
                                        <dd><a href="http://www.6.cn/" target="_blank" class="yd-" onclick="">美女秀场</a></dd>
                                        <dd class="more"><a href="<?php echo U('Yo81008/Index/shipin');?>" target="_blank" onclick="">更多&raquo;</a></dd>

                                    <dt>[<a href="<?php echo U('Yo81008/Index/xiaoshuo');?>" target="_blank" onclick="">小说</a>]</dt>
                                        <dd><a href="http://www.cc222.com/union/url/?uId=182" target="_blank" class="yd-" onclick="">烟雨红尘</a></dd>
                                        <dd><a href="http://www.qidian.com/" target="_blank" class="yd-" onclick="">起点中文网</a></dd>
                                        <dd><a href="http://www.hongxiu.com/" target="_blank" class="yd-" onclick="">红袖添香</a></dd>
                                        <dd><a href="http://www.xxsy.net/" target="_blank" class="yd-" onclick="">潇湘书院</a></dd>
                                        <dd><a href="http://book.6164.com" target="_blank" class="yd-" onclick="">言情小说</a></dd>
                                        <dd><a href="http://book.sina.com.cn/" target="_blank" class="yd-" onclick="">新浪读书</a></dd>
                                        <dd class="more"><a href="<?php echo U('Yo81008/Index/xiaoshuo');?>" target="_blank" onclick="">更多&raquo;</a></dd>

                                    <dt>[<a href="<?php echo U('Yo81008/Index/yinyue');?>" target="_blank" onclick="">音乐</a>]</dt>
                                        <dd><a href="http://www.koowo.com/mbox.down2?src=kwun0271" target="_blank" class="yd-" onclick="">酷我音乐盒</a></dd>
                                        <dd><a href="http://music.baidu.com/" target="_blank" class="yd-" onclick="">百度音乐</a></dd>
                                        <dd><a href="http://www.1ting.com/" target="_blank" class="yd-" onclick="">一听音乐网</a></dd>
                                        <dd><a href="http://www.google.cn/music/homepage" target="_blank" class="yd-" onclick="">谷歌音乐</a></dd>
                                        <dd><a href="http://www.xiami.com/" target="_blank" class="yd-" onclick="">虾米音乐</a></dd>
                                        <dd><a href="http://www.kugou.com/" target="_blank" class="yd-" onclick="">酷狗音乐</a></dd>
                                        <dd class="more"><a href="<?php echo U('Yo81008/Index/yinyue');?>" target="_blank" onclick="">更多&raquo;</a></dd>

                                    <dt>[<a href="<?php echo U('Yo81008/Index/youxi');?>" target="_blank" onclick="">游戏</a>]</dt>
                                        <dd><a href="http://hd.51wan.com/33288p14003q667j0.html" target="_blank" class="yd-red" onclick="">范特西篮球2</a></dd>
                                        <dd><a href="http://www.17173.com/" target="_blank" class="yd-black" onclick="">17173</a></dd>
                                        <dd><a href="http://hd.51wan.com/33288p14003q646j0.html" target="_blank" class="yd-black" onclick="">暗黑三国</a></dd>
                                        <dd><a href="http://hd.51wan.com/33288p14003q638j0.html" target="_blank" class="yd-black" onclick="">英雄战姬</a></dd>
                                        <dd><a href="http://hd.51wan.com/33288p14003q665j0.html" target="_blank" class="yd-green" onclick="">圣火令</a></dd>
                                        <dd><a href="http://hd.51wan.com/33288p14003q620j0.html" target="_blank" class="yd-black" onclick="">攻城掠地</a></dd>
                                        <dd class="more"><a href="<?php echo U('Yo81008/Index/youxi');?>" target="_blank" onclick="">更多&raquo;</a></dd>

                                    <dt>[<a href="<?php echo U('Yo81008/Index/shequ');?>" target="_blank" onclick="">社区</a>]</dt>
                                        <dd><a href="http://www.tianya.cn/" target="_blank" class="yd-" onclick="">天涯社区</a></dd>
                                        <dd><a href="http://bbs.163.com/" target="_blank" class="yd-" onclick="">网易论坛</a></dd>
                                        <dd><a href="http://tieba.baidu.com/" target="_blank" class="yd-" onclick="">百度贴吧</a></dd>
                                        <dd><a href="http://dzh.mop.com/" target="_blank" class="yd-" onclick="">猫扑大杂烩</a></dd>
                                        <dd><a href="http://www.douban.com/" target="_blank" class="yd-" onclick="">豆瓣</a></dd>
                                        <dd><a href="http://www.renren.com/" target="_blank" class="yd-" onclick="">人人网</a></dd>
                                        <dd class="more"><a href="<?php echo U('Yo81008/Index/shequ');?>" target="_blank" onclick="">更多&raquo;</a></dd>
                                </dl>
            </div>
        </div>
        <div class="mod">
		<?php echo W('WidgetHeader',array('template'=>'WidgetHeader_2','css'=>'whp_'.cookie('theme_color'), 'Yocms_data'=>array('widget'=>'aa','list'=>array( array('title'=>'新闻','src'=> U('Yo81008/Index/xinwen'),'description'=>''), array('title'=>'军事','src'=>U('Yo81008/Index/junshi'),'description'=>''), array('title'=>'体育','src'=>U('Yo81008/Index/tiyu'),'description'=>''), array('title'=>'财经','src'=>U('Yo81008/Index/caijing'),'description'=>''), array('title'=>'汽车','src'=>U('Yo81008/Index/qiche'),'description'=>''),))));?>
            <div class="bd clearfix">
                <dl>
                                    <dt>[<a href="<?php echo U('Yo81008/Index/xinwen');?>" target="_blank" onclick="">新闻</a>]</dt>
                                        <dd><a href="http://news.163.com" target="_blank" class="yd-black" onclick="">网易新闻</a></dd>
                                        <dd><a href="http://news.sina.com.cn" target="_blank" class="yd-black" onclick="">新浪新闻</a></dd>
                                        <dd><a href="http://news.sohu.com" target="_blank" class="yd-black" onclick="">搜狐新闻</a></dd>
                                        <dd><a href="http://news.6164.com/" target="_blank" class="yd-black" onclick="">今日热点</a></dd>
                                        <dd><a href="http://paper.people.com.cn" target="_blank" class="yd-black" onclick="">人民日报</a></dd>
                                        <dd><a href="http://news.qq.com" target="_blank" class="yd-black" onclick="">腾讯新闻</a></dd>
                                        <dd class="more"><a href="<?php echo U('Yo81008/Index/xinwen');?>" target="_blank" onclick="">更多&raquo;</a></dd>

                                    <dt>[<a href="<?php echo U('Yo81008/Index/junshi');?>" target="_blank" onclick="">军事</a>]</dt>
                                        <dd><a href="http://military.china.com/zh_cn/" target="_blank" class="yd-black" onclick="">中华军事</a></dd>
                                        <dd><a href="http://war.news.163.com/" target="_blank" class="yd-black" onclick="">网易军事</a></dd>
                                        <dd><a href="http://mil.news.sina.com.cn/" target="_blank" class="yd-black" onclick="">新浪军事</a></dd>
                                        <dd><a href="http://www.tiexue.net/" target="_blank" class="yd-black" onclick="">铁血网</a></dd>
                                        <dd><a href="http://news.ifeng.com/mil/" target="_blank" class="yd-black" onclick="">凤凰网军事</a></dd>
                                        <dd><a href="http://junshi.xilu.com/" target="_blank" class="yd-black" onclick="">西陆军事</a></dd>
                                        <dd class="more"><a href="<?php echo U('Yo81008/Index/junshi');?>" target="_blank" onclick="">更多&raquo;</a></dd>

                                    <dt>[<a href="<?php echo U('Yo81008/Index/tiyu');?>" target="_blank" onclick="">体育</a>]</dt>
                                        <dd><a href="http://sports.163.com/" target="_blank" class="yd-" onclick="">网易体育</a></dd>
                                        <dd><a href="http://sports.sina.com.cn/" target="_blank" class="yd-" onclick="">新浪体育</a></dd>
                                        <dd><a href="http://www.hoopchina.com/" target="_blank" class="yd-" onclick="">虎扑体育</a></dd>
                                        <dd><a href="http://sports.cn.yahoo.com/" target="_blank" class="yd-" onclick="">雅虎体育</a></dd>
                                        <dd><a href="http://sports.sina.com.cn/global/" target="_blank" class="yd-" onclick="">新浪国际足球</a></dd>
                                        <dd><a href="http://sports.sina.com.cn/nba/" target="_blank" class="yd-" onclick="">新浪NBA</a></dd>
                                        <dd class="more"><a href="<?php echo U('Yo81008/Index/tiyu');?>" target="_blank" onclick="">更多&raquo;</a></dd>

                                    <dt>[<a href="<?php echo U('Yo81008/Index/caijing');?>" target="_blank" onclick="">财经</a>]</dt>
                                        <dd><a href="http://www.eastmoney.com/" target="_blank" class="yd-" onclick="">东方财富网</a></dd>
                                        <dd><a href="http://www.hexun.com/" target="_blank" class="yd-" onclick="">和讯财经</a></dd>
                                        <dd><a href="http://money.163.com/" target="_blank" class="yd-" onclick="">网易财经</a></dd>
                                        <dd><a href="http://www.jrj.com/" target="_blank" class="yd-" onclick="">金融界</a></dd>
                                        <dd><a href="http://finance.sina.com.cn/" target="_blank" class="yd-" onclick="">新浪财经</a></dd>
                                        <dd><a href="http://www.imeigu.com/" target="_blank" class="yd-" onclick="">i美股</a></dd>
                                        <dd class="more"><a href="<?php echo U('Yo81008/Index/caijing');?>" target="_blank" onclick="">更多&raquo;</a></dd>

                                    <dt>[<a href="<?php echo U('Yo81008/Index/qiche');?>" target="_blank" onclick="">汽车</a>]</dt>
                                        <dd><a href="http://www.autohome.com.cn/" target="_blank" class="yd-" onclick="">汽车之家</a></dd>
                                        <dd><a href="http://auto.163.com/" target="_blank" class="yd-red" onclick="">网易汽车</a></dd>
                                        <dd><a href="http://auto.sina.com.cn/" target="_blank" class="yd-" onclick="">新浪汽车</a></dd>
                                        <dd><a href="http://chexian.sinosig.com/" target="_blank" class="yd-red" onclick="">阳光车险</a></dd>
                                        <dd><a href="http://www.pcauto.com.cn/" target="_blank" class="yd-" onclick="">太平洋汽车网</a></dd>
                                        <dd><a href="http://so.iautos.cn/wb/163/so.jsp" target="_blank" class="yd-" onclick="">第一车网</a></dd>
                                        <dd class="more"><a href="<?php echo U('Yo81008/Index/qiche');?>" target="_blank" onclick="">更多&raquo;</a></dd>
                                </dl>
            </div>
        </div>
                                <div class="mod">
								<?php echo W('WidgetHeader',array('template'=>'WidgetHeader_2','css'=>'whp_'.cookie('theme_color'), 'Yocms_data'=>array('widget'=>'aa','list'=>array( array('title'=>'购物','src'=> U('Yo81008/Index/gouwu'),'description'=>''), array('title'=>'银行','src'=>U('Yo81008/Index/yinhang'),'description'=>''), array('title'=>'彩票','src'=>U('Yo81008/Index/caipiao'),'description'=>''), array('title'=>'手机','src'=>U('Yo81008/Index/shouji'),'description'=>''), array('title'=>'旅游','src'=>U('Yo81008/Index/lvyou'),'description'=>''),))));?>
            <div class="bd clearfix">
                <dl>
                                    <dt>[<a href="<?php echo U('Yo81008/Index/gouwu');?>" target="_blank" onclick="">购物</a>]</dt>
                                        <dd><a href="http://click.union.vip.com/redirect.php?url=eyJzY2hlbWVjb2RlIjoiZjVhMDVkNjYiLCJkZXN0dXJsIjoiaHR0cDpcL1wvd3d3LnZpcC5jb20iLCJ1Y29kZSI6InV2OHdmZ3hvIn0=" target="_blank" class="yd-" onclick="">唯品会<!--Yoper--></a></dd>
                                        <dd><a href="http://union.dangdang.com/transfer.php?from=P-327755&ad_type=10&sys_id=1&backurl=http%3A%2F%2Fwww.dangdang.com" target="_blank" class="yd-" onclick="">当当网<!--Yoper--></a></dd>
                                        <dd><a href="http://union.click.jd.com/jdc?e=&p=AiIBZRprFDJWWA1FBCVbV0IUEEULRFRBSkAOClBMW0srE05%2BewIqbS52YkZTLkUyFQUIAQFJHRkOIgZlGF8XAhEHVRtfJTJzdWU%3D&t=W1dCFBBFC0RUQUpADgpQTFtL" target="_blank" class="yd-green" onclick="">京东商城</a></dd>
                                        <dd><a href="http://www.jumei.com" target="_blank" class="yd-red" onclick="">聚美优品</a></dd>
                                        <dd><a href="http://click.yhd.com/?ut=1070220854&s=NGE4YTFlZTFmZDAxMzA2ZWExM2ZmYTI4ZjYzYjg4NWQ5NjZhNmE2YjdkMDU0ZDk5NDY5Y2FmNGY0MzQ2MTdiYmVhYmIyZmI4NDIxMjk4MDg0Yjk0NTNhOWU3MmU2NDg1&cv=1" target="_blank" class="yd-" onclick="">1号店<!--Yoper--></a></dd>
                                        <dd><a href="http://cps.gome.com.cn/home/JoinUnion?sid=6934&wid=9188&feedback=&to=http://www.gome.com.cn" target="_blank" class="yd-" onclick="">国美在线<!--Yoper--></a></dd>
                                        <dd class="more"><a href="<?php echo U('Yo81008/Index/gouwu');?>" target="_blank" onclick="">更多&raquo;</a></dd>

                                    <dt>[<a href="<?php echo U('Yo81008/Index/yinhang');?>" target="_blank" onclick="">银行</a>]</dt>
                                        <dd><a href="http://www.icbc.com.cn/" target="_blank" class="yd-black" onclick="">中国工商银行</a></dd>
                                        <dd><a href="http://www.abchina.com/" target="_blank" class="yd-black" onclick="">中国农业银行</a></dd>
                                        <dd><a href="http://www.ccb.com/" target="_blank" class="yd-black" onclick="">中国建设银行</a></dd>
                                        <dd><a href="http://www.psbc.com/" target="_blank" class="yd-black" onclick="">中国邮政储蓄</a></dd>
                                        <dd><a href="http://www.bankcomm.com/" target="_blank" class="yd-black" onclick="">交通银行</a></dd>
                                        <dd><a href="https://epay.163.com/" target="_blank" class="yd-black" onclick="">网易宝</a></dd>
                                        <dd class="more"><a href="<?php echo U('Yo81008/Index/yinhang');?>" target="_blank" onclick="">更多&raquo;</a></dd>

                                    <dt>[<a href="<?php echo U('Yo81008/Index/caipiao');?>" target="_blank" onclick="">彩票</a>]</dt>
                                        <dd><a href="http://www.500.com/" target="_blank" class="yd-red" onclick="">500彩票</a></dd>
                                        <dd><a href="http://www.zhcw.com/" target="_blank" class="yd-" onclick="">中彩网(官网)</a></dd>
                                        <dd><a href="http://www.9188.com/" target="_blank" class="yd-" onclick="">双色球</a></dd>
                                        <dd><a href="http://www.9188.com/" target="_blank" class="yd-" onclick="">9188彩票</a></dd>
                                        <dd><a href="http://caipiao.163.com" target="_blank" class="yd-" onclick="">网易彩票</a></dd>
                                        <dd><a href="backurl=http://www.9188.com/kaijiang/" target="_blank" class="yd-" onclick="">开奖结果</a></dd>
                                        <dd class="more"><a href="<?php echo U('Yo81008/Index/caipiao');?>" target="_blank" onclick="">更多&raquo;</a></dd>

                                    <dt>[<a href="<?php echo U('Yo81008/Index/shouji');?>" target="_blank" onclick="">手机</a>]</dt>
                                        <dd><a href="http://mobile.163.com/" target="_blank" class="yd-" onclick="">网易手机</a></dd>
                                        <dd><a href="http://www.imobile.com.cn/" target="_blank" class="yd-" onclick="">手机之家</a></dd>
                                        <dd><a href="http://tech.sina.com.cn/mobile/" target="_blank" class="yd-" onclick="">新浪手机</a></dd>
                                        <dd><a href="http://mobile.pconline.com.cn/" target="_blank" class="yd-" onclick="">太平洋手机</a></dd>
                                        <dd><a href="http://mobile.zol.com.cn/" target="_blank" class="yd-" onclick="">ZOL手机</a></dd>
                                        <dd><a href="http://www.xiaomi.com/index.php" target="_blank" class="yd-" onclick="">小米手机</a></dd>
                                        <dd class="more"><a href="<?php echo U('Yo81008/Index/shouji');?>" target="_blank" onclick="">更多&raquo;</a></dd>

                                    <dt>[<a href="<?php echo U('Yo81008/Index/lvyou');?>" target="_blank" onclick="">旅游</a>]</dt>
                                        <dd><a href="http://www.ly.com" target="_blank" class="yd-" onclick="">同程旅游网</a></dd>
                                        <dd><a href="http://www.qmango.com" target="_blank" class="yd-" onclick="">青芒果</a></dd>
                                        <dd><a href="http://www.kuxun.cn" target="_blank" class="yd-" onclick="">酷讯机票</a></dd>
                                        <dd><a href="http://travel.elong.com/hotel/" target="_blank" class="yd-" onclick="">艺龙酒店</a></dd>
                                        <dd><a href="http://www.zhuna.cn/" target="_blank" class="yd-" onclick="">住哪儿网</a></dd>
                                        <dd><a href="http://www.lvmama.com" target="_blank" class="yd-" onclick="">驴妈妈</a></dd>
                                        <dd class="more"><a href="<?php echo U('Yo81008/Index/lvyou');?>" target="_blank" onclick="">更多&raquo;</a></dd>
                                </dl>
            </div>
        </div>
                                <div class="mod">
								<?php echo W('WidgetHeader',array('template'=>'WidgetHeader_2','css'=>'whp_'.cookie('theme_color'), 'Yocms_data'=>array('widget'=>'aa','list'=>array( array('title'=>'邮箱','src'=>U('Yo81008/Index/youxiang'),'description'=>''), array('title'=>'团购','src'=>U('Yo81008/Index/tuangou'),'description'=>''), array('title'=>'女性','src'=>U('Yo81008/Index/nvxing'),'description'=>''), array('title'=>'闪游','src'=>U('Yo81008/Index/shanyou'),'description'=>''), array('title'=>'房产','src'=>U('Yo81008/Index/fangchan'),'description'=>''),))));?>
            <div class="bd clearfix">
                <dl>
                                    <dt>[<a href="<?php echo U('Yo81008/Index/youxiang');?>" target="_blank" onclick="">邮箱</a>]</dt>
                                        <dd><a href="http://mail.163.com/" target="_blank" class="yd-black" onclick="">163邮箱</a></dd>
                                        <dd><a href="http://www.126.com/" target="_blank" class="yd-black" onclick="">126邮箱</a></dd>
                                        <dd><a href="http://gmail.google.com/" target="_blank" class="yd-black" onclick="">Gmail</a></dd>
                                        <dd><a href="http://mail.qq.com/" target="_blank" class="yd-black" onclick="">QQ邮箱</a></dd>
                                        <dd><a href="http://www.hotmail.com/" target="_blank" class="yd-black" onclick="">Hotmail</a></dd>
                                        <dd><a href="http://mail.sina.com.cn/" target="_blank" class="yd-black" onclick="">新浪邮箱</a></dd>
                                        <dd class="more"><a href="<?php echo U('Yo81008/Index/youxiang');?>" target="_blank" onclick="">更多&raquo;</a></dd>

                                    <dt>[<a href="<?php echo U('Yo81008/Index/tuangou');?>" target="_blank" onclick="">团购</a>]</dt>
                                        <dd><a href="http://www.lashou.com/" target="_blank" class="yd-" onclick="">拉手网</a></dd>
                                        <dd><a href="http://t.dianping.com" target="_blank" class="yd-" onclick="">大众点评团</a></dd>
                                        <dd><a href="http://www.nuomi.com" target="_blank" class="yd-red" onclick="">百度糯米<!--Yoper--></a></dd>
                                        <dd><a href="http://www.jumei.com/" target="_blank" class="yd-" onclick="">聚美优品</a></dd>
                                        <dd><a href="http://bj.meituan.com/" target="_blank" class="yd-red" onclick="">美团</a></dd>
                                        <dd><a href="http://t.yhd.com/" target="_blank" class="yd-" onclick="">1号团</a></dd>
                                        <dd class="more"><a href="<?php echo U('Yo81008/Index/tuangou');?>" target="_blank" onclick="">更多&raquo;</a></dd>

                                    <dt>[<a href="<?php echo U('Yo81008/Index/nvxing');?>" target="_blank" onclick="">女性</a>]</dt>
                                        <dd><a href="http://www.rayli.com.cn/" target="_blank" class="yd-" onclick="">瑞丽女性网</a></dd>
                                        <dd><a href="http://lady.163.com/" target="_blank" class="yd-" onclick="">网易女人</a></dd>
                                        <dd><a href="http://www.meilishuo.com" target="_blank" class="yd-" onclick="">美丽说<!--Yoper--></a></dd>
                                        <dd><a href="http://www.mogujie.com/" target="_blank" class="yd-" onclick="">蘑菇街<!--Yoper--></a></dd>
                                        <dd><a href="http://www.ellechina.com/?dressup=false" target="_blank" class="yd-" onclick="">ELLE中国</a></dd>
                                        <dd><a href="http://www.128p.com/" target="_blank" class="yd-" onclick="">看美女</a></dd>
                                        <dd class="more"><a href="<?php echo U('Yo81008/Index/nvxing');?>" target="_blank" onclick="">更多&raquo;</a></dd>

                                    <dt>[<a href="<?php echo U('Yo81008/Index/yeyou');?>" target="_blank" onclick="">页游</a>]</dt>
                                        <dd><a href="http://hd.51wan.com/33288p14003q534j0.html" target="_blank" class="yd-" onclick="">大闹天宫OL</a></dd>
                                        <dd><a href="http://hd.51wan.com/33288p14003q493j0.html" target="_blank" class="yd-" onclick="">女神联盟</a></dd>
                                        <dd><a href="http://hd.51wan.com/33288p14003q480j0.html" target="_blank" class="yd-" onclick="">南帝北丐2</a></dd>
                                        <dd><a href="http://hd.51wan.com/33288p14003q611j0.html" target="_blank" class="yd-" onclick="">仙侠道</a></dd>
                                        <dd><a href="http://hd.51wan.com/33288p14003q431j0.html" target="_blank" class="yd-" onclick="">烈焰3</a></dd>
                                        <dd><a href="http://hd.51wan.com/33288p14003q332j0.html" target="_blank" class="yd-" onclick="">街机三国</a></dd>
                                        <dd class="more"><a href="<?php echo U('Yo81008/Index/yeyou');?>" target="_blank" onclick="">更多&raquo;</a></dd>

                                    <dt>[<a href="<?php echo U('Yo81008/Index/fangchan');?>" target="_blank" onclick="">房产</a>]</dt>
                                        <dd><a href="http://www.soufun.com/" target="_blank" class="yd-" onclick="">搜房网</a></dd>
                                        <dd><a href="http://house.163.com/" target="_blank" class="yd-" onclick="">网易房产</a></dd>
                                        <dd><a href="http://house.sina.com.cn/" target="_blank" class="yd-" onclick="">新浪房产</a></dd>
                                        <dd><a href="http://www.focus.cn/" target="_blank" class="yd-" onclick="">搜狐焦点网</a></dd>
                                        <dd><a href="http://www.ganji.com/fang/" target="_blank" class="yd-" onclick="">赶集网房产</a></dd>
                                        <dd><a href="http://www.lovo.cn" target="_blank" class="yd-" onclick="">罗莱家纺</a></dd>
                                        <dd class="more"><a href="<?php echo U('Yo81008/Index/fangchan');?>" target="_blank" onclick="">更多&raquo;</a></dd>
                                </dl>
								<dl>
								<script type="text/javascript">var jd_union_unid="253121115",jd_ad_ids="507:6",jd_union_pid="CNuj3KHRKRDbpNl4GgAgrZGCiwEqAA==";var jd_width=728;var jd_height=90;var jd_union_euid="";</script>
								<script type="text/javascript" charset="utf-8" src="http://u.x.jd.com/static/js/auto.js"></script>
								</dl>
            </div>
        </div>
            </div>
</div>                <div class="yao-b">
    <div class="oneborder">
        <!-- 实用工具 -->
        <div class="mod-side mod-tools">
            <div class="hd">
                <h2 class="clearfix">
				<!--<span>热门动态</span><span>好友动态</span>-->
				<span>常用工具</span>
				</h2>
            </div>
            <div class="bd">
                <ul>
                                        <li class="tool1">
                        <!--<img class="tools-icon" src="../Public/image/shiyong.png">-->
                        <strong><a href="http://translate.google.cn/" target="_blank" onclick="">在线翻译</a></strong>
                        <em><a href="http://www.qunar.com" target="_blank" onclick="">机票酒店</a></em>
                    </li>
                                        <li class="tool2">
                        <!--<img class="tools-icon" src="../Public/image/movie.png">-->
                        <strong><a href="http://movie.youku.com/" target="_blank" onclick="">电  影</a></strong>
                        <em><a href="http://www.sogou.com/sogou?query=%e7%be%8e%e5%9b%bd%e9%98%9f%e9%95%bf2&pid=sogou-netb-51be2fed6c55f5aa-7224" target="_blank" onclick="ct(this,'left.toolsite.right','美国队长2','');">美国队长2</a></em>
                    </li>
                                        <li class="tool3">
                        <!--<img class="tools-icon" src="../Public/image/tvshow.png">-->
                        <strong><a href="http://v.qq.com/tv/" target="_blank" onclick="">电视剧</a></strong>
                        <em><a href="http://www.sogou.com/sogou?query=%e6%ad%a5%e6%ad%a5%e6%83%8a%e6%83%85&pid=sogou-netb-51be2fed6c55f5aa-7224" target="_blank" onclick="ct(this,'left.toolsite.right','步步惊情','');">步步惊情</a></em>
                    </li>
                                        <li class="tool4">
                        <!--<img class="tools-icon" src="../Public/image/gouwu.png">-->
                        <strong><a href="<?php echo U('Yo81008/Index/tuangou');?>" target="_blank" onclick="">团  购</a></strong>
                        <em><a href="http://tsm.nuomi.com/ClickService/click?url=http%3A%2F%2Fwww.nuomi.com%3Fcid%3Dnuomi_union_8247" target="_blank" onclick="">百度糯米<!--Yoper--></a></em>
                    </li>
                                        <li class="tool5">
                        <!--<img class="tools-icon" src="../Public/image/music.png">-->
                        <strong><a href="<?php echo U('Yo81008/Index/yinyue');?>" target="_blank" onclick="">音  乐</a></strong>
                        <em><a href="http://www.koowo.com/mbox.down2?src=kwun0271" target="_blank" onclick="">酷我音乐盒</a></em>
                    </li>
                                        <li class="tool6">
                        <!--<img class="tools-icon" src="../Public/image/game.png">-->
                        <strong><a href="<?php echo U('Yo81008/Index/xiaoyouxi');?>" target="_blank" onclick="">小游戏</a></strong>
                        <em><a href="http://hd.51wan.com/33288p14003q534j0.html" target="_blank" onclick="">大闹天宫OL</a></em>
                    </li>
                                    </ul>
            </div>
        </div>
        <!-- 热门新闻 -->
        <div class="mod-side mod-news">
            <div class="bd">
                <h3><span>热门新闻</span></h3>
                <ul>
                    <li>
                                                <span>[<a href="http://news.6164.com/" target="_blank" onclick="">头条</a>]</span>
                        <a href="http://news.163.com/13/0909/10/98ARHBN700014JB5.html" target="_blank" onclick="">朝鲜大阅兵庆建国 金正恩出席</a>
                    </li>
                    <li>
                                                <span>[<a href="http://sports.163.com/" target="_blank" onclick="">体育</a>]</span>
                        <a href="http://sports.163.com/13/0909/14/98B9H6A900051CAQ.html" target="_blank" onclick="">张继科爆冷不敌小将无缘四强</a>
                    </li>
                    <li>
                                                <span>[<a href="http://ent.163.com/" target="_blank" onclick="">娱乐</a>]</span>
                        <a href="http://ent.163.com/13/0909/16/98BI2A7S00031H2L.html" target="_blank" onclick="">霍建华方面否认与张馨予恋情</a>
                    </li>
                    <li>
                                                <span>[<a href="http://tech.163.com/" target="_blank" onclick="">科技</a>]</span>
                        <a href="http://digi.163.com/13/0909/07/98AICS9M00162Q5T.html" target="_blank" onclick="">预热：苹果发布会消息汇总</a>
                    </li>
                    <li>
                                                <span>[<a href="http://money.163.com/" target="_blank" onclick="">财经</a>]</span>
                        <a href="http://money.163.com/13/0909/01/989UC47N00253B0H.html" target="_blank" onclick="">大庆油田招投标黑幕:目标企业中不了就废标</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- 手机充值 -->
        <div id="chongzhi" class="mod-side mod-chongzhi">
            <div class="bd">
                <p>
                    <a target="_blank" class="cz-mobile cz-active" href="http://mall.163.com/mobile/fill.html" onclick="">手机充值</a>
                    <span class="spline">|</span>
                    <a target="_blank" class="cz-jipiao" href="http://www.kuxun.cn" onclick="">机&nbsp;票</a>
                    <span class="spline">|</span>
                    <a target="_blank" class="cz-dianka" href="http://mall.163.com/game/queryGame.html" onclick="">点卡购买</a>
                </p>
                <form class="fm-mobile" target="_blank" action="http://shop.163.com/mobile/tofill.html" method="post">
                    <input name="chargeAccount" class="txt" type="text" name="1" placeholder="输入手机号" />
                    <input type="text" name="faceValue" value="" style="width:35px;height:16px;margin:0;padding:0;  -moz-border-radius: 15px; -webkit-border-radius: 15px;border-radius: 15px;"/> 元
                    <input class="btn" type="submit" value="充值" />
                    <p class="mobile-mistake" style="display:none;"></p>
                </form>
            </div>
        </div>
        
                        <div class="mod-side mod-scommon">
            <div class="hd">
                <h2 class="clearfix"><span>生活服务</span></h2>
            </div>
            <div class="bd">
                <div class="clearfix">
                					<span><a href="<?php echo U('Yo81008/Index/gouwu');?>" target="_blank" >购物</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/caipiao');?>" target="_blank" >彩票</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/chaxun');?>" target="_blank" >查询</a></span>
                                    <span><a href="http://www.sogou.com/sogou?query=%CC%EC%C6%F8&query=%CC%EC%C6%F8&pid=sogou-netb-51be2fed6c55f5aa-7224" target="_blank" >天气</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/caijing');?>" target="_blank" >股票</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/jijin');?>" target="_blank" >基金</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/yinhang');?>" target="_blank" >银行</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/lvyou');?>" target="_blank" >旅游</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/fangchan');?>" target="_blank" >房产</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/caipu');?>" target="_blank" >菜谱</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/qiche');?>" target="_blank" >汽车</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/ditu');?>" target="_blank" >地图</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/jiankang');?>" target="_blank" >健康</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/chongwu');?>" target="_blank" >宠物</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/nvxing');?>" target="_blank" >女性</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/tuangou');?>" target="_blank" >团购</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/ertong');?>" target="_blank" >儿童</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/zhaopin');?>" target="_blank" >招聘</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/zhiye');?>" target="_blank" >职业</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/shouji');?>" target="_blank" >手机</a></span>
                                    <span><a href="http://gaokao.chsi.com.cn/sch/" target="_blank" >大学</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/dianshi');?>" target="_blank" >电视</a></span>
                                    <span><a href="http://chexian.sinosig.com/simplePremium/lianmeng.jsp" target="_blank" >车险</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/liaotian');?>" target="_blank" >聊天</a></span>
                                </div>
            </div>
        </div>
                <div class="mod-side mod-scommon">
            <div class="hd">
                <h2 class="clearfix"><span>娱乐休闲</span></h2>
            </div>
            <div class="bd">
                <div class="clearfix">
                					<span><a href="<?php echo U('Yo81008/Index/yinyue');?>" target="_blank" >音乐</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/youxi');?>" target="_blank" >游戏</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/shipin');?>" target="_blank" >视频</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/dianying');?>" target="_blank" >电影</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/xinwen');?>" target="_blank" >新闻</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/xiaoshuo');?>" target="_blank" >小说</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/junshi');?>" target="_blank" >军事</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/tupian');?>" target="_blank" >图片</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/dongman');?>" target="_blank" >动漫</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/xingzuo');?>" target="_blank" >星座</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/tiyu');?>" target="_blank" >体育</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/nba');?>" target="_blank" >NBA</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/jiaoyou');?>" target="_blank" >交友</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/mingxing');?>" target="_blank" >明星</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/shequ');?>" target="_blank" >社区</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/yeyou');?>" target="_blank" >页游</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/kongjian');?>" target="_blank" >空间</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/xiaohua');?>" target="_blank" >笑话</a></span>
                                </div>
            </div>
        </div>
        <div class="mod-side mod-scommon">
            <div class="hd">
                <h2 class="clearfix"><span>其他</span></h2>
            </div>
            <div class="bd">
                <div class="clearfix">
                					<span><a href="<?php echo U('Yo81008/Index/ruanjian');?>" target="_blank" >软件</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/youxiang');?>" target="_blank" >邮箱</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/gongyi');?>" target="_blank" >公益</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/shadu');?>" target="_blank" >杀毒</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/sheji');?>" target="_blank" >设计</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/diannao');?>" target="_blank" >电脑</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/zhuomian');?>" target="_blank" >桌面</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/zhengfu');?>" target="_blank" >政府</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/sheying');?>" target="_blank" >摄影</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/yingyu');?>" target="_blank" >英语</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/kaoshi');?>" target="_blank" >考试</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/jiaoxue');?>" target="_blank" >教学</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/quyi');?>" target="_blank" >曲艺</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/qinqi');?>" target="_blank" >琴棋</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/baoxian');?>" target="_blank" >保险</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/guowai');?>" target="_blank" >国外</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/falv');?>" target="_blank" >法律</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/laonian');?>" target="_blank" >老年</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/aihao');?>" target="_blank" >爱好</a></span>
                                    <span><a href="<?php echo U('Yo81008/Index/weibo');?>" target="_blank" >微博</a></span>
                                </div>
            </div>
        </div>
            </div>
</div>
        </div>
<!-- 底部 -->
<style type="text/css">

</style>
 <div id="ft">
            <!-- 常用软件/游戏专区/Chrome app -->
	<div id="bottomNav">
            <dl>
        <dt>游戏专区：</dt>
                        <dd><a href="http://lol.qq.com/" target="_blank">英雄联盟</a></dd>
                <dd><a href="http://dnf.qq.com/main.shtml" target="_blank">DNF</a></dd>
                <dd><a href="http://hd.51wan.com/33288p14003q692j0.html" target="_blank">胜利11人</a></dd>
                <dd><a href="http://hd.51wan.com/33288p14003q646j0.html" target="_blank">暗黑三国</a></dd>
                <dd><a href="http://hd.51wan.com/33288p14003q620j0.html" target="_blank">攻城掠地</a></dd>
                <dd><a href="http://hd.51wan.com/33288p14003q677j0.html" target="_blank">傲剑2</a></dd>
                <dd><a href="http://hd.51wan.com/33288p14003q534j0.html" target="_blank">大闹天宫</a></dd>
                <dd><a href="http://hd.51wan.com/33288p14003q665j0.html" target="_blank">圣火令</a></dd>
                <dd><a href="http://hd.51wan.com/33288p14003q611j0.html" target="_blank">仙侠道</a></dd>
                <dd><a href="http://hd.51wan.com/33288p14003q638j0.html" target="_blank">英雄战姬</a></dd>
                <dd><a href="http://www.5173.com/?recommenduserid=US08122946261122-038D" target="_blank">5173</a></dd>
                                <dd class="more"><a href="youxi.html" target="_blank">更多&raquo;</a></dd>
    </dl>
        <dl>
        <dt>常用网站：</dt>
        		<dd><a href="http://www.handu.com/" target="_blank">韩都衣舍</a></dd>
                <dd><a href="http://click.union.vip.com/redirect.php?url=eyJzY2hlbWVjb2RlIjoiZjVhMDVkNjYiLCJkZXN0dXJsIjoiaHR0cDpcL1wvd3d3LnZpcC5jb20iLCJ1Y29kZSI6InV2OHdmZ3hvIn0=" target="_blank">唯品会<!--Yoper--></a></dd>
                <dd><a href="http://www.kugou.com/" target="_blank">酷狗音乐</a></dd>
                <dd><a href="http://www.pptv.com/" target="_blank">PPTV</a></dd>
                <dd><a href="<?php echo U('Yo81008/Index/tuangou');?>" target="_blank">团购大全</a></dd>
                <dd><a href="http://union.click.jd.com/jdc?e=&p=AiIBZRprFDJWWA1FBCVbV0IUEEULUEtXCkQPSB1JUkpJBUkcQVMFXx5dHUtCCUZrcXRhWlxYMHJhZHkGGgIWclQBEHwJZQ4eN1QrWBEAEgRVG1sRMiJmJys%3D&t=W1dCFBBFC1BLVwpED0gdSVJKSQVJHEFTBV8eXR1LQglG" target="_blank">美妆萌萌大<!--Yoper--></a></dd>
                <dd><a href="http://www.mmbang.com/bang/446/86085" target="_blank">儿歌视频下载</a></dd>
                <dd><a href="http://dl.xunlei.com/" target="_blank">迅雷</a></dd>
                <dd><a href="http://union.click.jd.com/jdc?e=&p=AyIEZRhaFgAaB1YdXCUBEwRXE1sWBBs3EUQDS10iXhBeGh4cDFsFRgYKWUcYB0UHC1pNUgFSRxwKEA5RBAJQXk83HWcfEXF0BQl7KE11blQxUz9nXVJZJRdXJQMiBFEZWxYCEgdRK2t0cCJGOxJTFwsW&t=W1dCFBBFC15CWggEAEAdQFkJBQNKV0ZOSRJTFwsWGAxeB0g%3D" target="_blank">商品特价</a></dd>
                <dd><a href="http://www.douban.com/" target="_blank">豆瓣网</a></dd>
                        <dd class="more"><a href="cool.html" target="_blank">更多&raquo;</a></dd>
    </dl>
    </div>
<div id="icp">
<a href="#">关于我们</a>
<span class="c_fnl">|</span>
<a href="feedback/" target="_blank">联系我们</a>
<span class="c_fnl">|</span>
<a href="http://www.linglingtang.com" title="零零糖" target="_blank">零零糖</a>
<span class="c_fnl">|</span>
<a href="http://www.linglingtang.com" title="星美电影" target="_blank">星美电影</a>
<br/>
<p>
友情链接
<a href="http://www.xingmeihui.com" title="星美汇" target="_blank">星美汇</a>
<span class="c_fnl">|</span>
<a href="http://linglingtang.uz.taobao.com/" title="我爱零零糖" target="_blank">零零糖淘宝店</a>
<span class="c_fnl">|</span>
<a href="http://cps.gome.com.cn/home/JoinUnion?&sid=123&wid=978&feedback=71201046290" target="_blank" title="国美在线">国美在线</a>
<span class="c_fnl">|</span>
<a href="http://union.click.jd.com/jdc?e=&p=AiIBZRprFDJWWA1FBCVbV0IUEEULRFRBSkAOClBMW0srE05%2BewIqbS52YkZTLkUyFQUIAQFJHRkOIgZlGF8XAhEHVRtfJTJzdWU%3D&t=W1dCFBBFC0RUQUpADgpQTFtL" target="_blank" title="京东">京商城东</a>
<span class="c_fnl">|</span>
<a href="http://www.mogujie.com/trade/click?c=19&u=138ydum&t=http%3A%2F%2Fwww.mogujie.com" target="_blank" title="蘑菇街">蘑菇街</a>
<span class="c_fnl">|</span>
<a href="http://www.baobeihuijia.com/" target="_blank" title="寻找丢失的孩子">宝贝回家</a>
</p>
<p class="c_fcopyright">我的上网主页 - 网购首页 - 我和僵尸有个约会<span class="c_fnl">|</span><a title="关于本站与我和僵尸有个约会" href="<?php echo U('Yo81008/Index/aboutmaxiaoling');?>">关于本站</a>
    <a href="#">手机版</a>&nbsp;Power By Yocms 粤ICP备15029177号</p>
</div> 
</div>

</div>
<script>
//百度统计
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?7e7d6d8d917a74a8e39b9846eff5ecfa";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>

<script type="text/javascript" src="../Public/common.js?201311221"></script>
</body>
</html>