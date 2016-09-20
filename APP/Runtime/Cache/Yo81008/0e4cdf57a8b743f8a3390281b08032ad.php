<?php if (!defined('THINK_PATH')) exit();?>﻿<!doctype html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<meta name="keywords" content="购物大全,网址导航,网购导航,购物导航,购物网站,我和僵尸有个约会,马小玲,况天佑"/>
<meta name="description" content="零零糖和马小零的办公室为喜欢购物的小伙伴们提供丰富的购物体验哦,么么哒;集合全国各大购物网站,常用网站网址,我和僵尸有个约会"/>
<title>零零糖_我和僵尸有个约会_视频</title>
<link href="../Public/nav_<?php echo ((cookie('theme_color'))?(cookie('theme_color')):'pink'); ?>.css?201311221" rel="stylesheet" type="text/css" />
<link href="../Public/suggest_<?php echo ((cookie('theme_color'))?(cookie('theme_color')):'pink'); ?>.css?201311221" type="text/css" rel="stylesheet" />
<link href="../Public/s_form_<?php echo ((cookie('theme_color'))?(cookie('theme_color')):'pink'); ?>.css?201311221" type="text/css" rel="stylesheet" />
<link href="../Public/index_other_<?php echo ((cookie('theme_color'))?(cookie('theme_color')):'pink'); ?>.css?201311221" type="text/css" rel="stylesheet" />
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
 <div id="doc1">
 <div id="hd">
   <!-- 搜索 -->
    <div id="searchWrap">
    <!-- logos 切换 -->
    <!--<a class="logo" href="<?php echo U('Yo81001/Index/index');?>" onclick="" target="_blank">零零糖网购网址</a>-->
    <!-- ...搜索... -->
    <div class="csearch-box">
        <ul class="cnav-list clearfix">
            <li class="current"><a href="#">百度</a></li>
            <li><span class="spline">|</span></li>
			<li><a href="#">京东购物</a></li>
            <li><span class="spline">|</span></li>
            <li><a href="#">视频</a></li>
            <li><span class="spline">|</span></li>
			<li><a href="#">图片</a></li>
            <li><span class="spline">|</span></li>
            <li><a href="#">热闻</a></li>
            <li><span class="spline">|</span></li>
            <li><a href="#">词典</a></li>
        </ul>
        <!-- Begin 搜索相关 -->
        <form method="get" action="http://www.baidu.com/s" class="c-fm-w"  target="_blank">
            <!--Begin 搜索框 -->
            <span class="s-inpt-w" style="width:503px;">
                <input type="text" style="width:494px;" value="" class="s-inpt" autocomplete="off" name="wd" id="query" />
                <!-- Begin 这两个SPAN 尽量写一行 -->
            </span><span class="s-btn-w">
                <!-- #End 这两个SPAN 尽量写一行 -->
                <input type="submit" class="s-btn" value="搜索一下" />
                <input type="hidden" value="utf-8" name="enc" id="enc">
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
</div> 
</div>
<style type="text/css">
#hd {
  font-size: 12px;
  height: 175px;
  position: relative;
  z-index: 1;
}
#searchWrap {
  bottom: 10px;
  height: 90px;
  position: absolute;
  width: 85%;
}
.csearch-box {
  position: absolute;
  left: 240px;
  top: 9px;
  z-index: 1;
}
.cnav-list {
  margin: 0 0 0 2px;
}
.cnav-list li {
  float: left;
  font-size: 14px;
  width: 78px;
  text-align: center;
}
#doc1 .cnav-list li {
  width: auto;
}
.spline {
  color: #D5D5D5;
  margin: 0 5px;
  line-height: 28px;
}
#doc1 .cnav-list li span.spline {
  width: 12px;
  line-height: 24px;
}
.c-fm-w {
  position: relative;
  display: inline-block;
  margin: 3px 0 0 0;
  z-index: 2;
  width: 615px !important;
}
.s-inpt-w {
  display: inline-block;
  width: 504px;
  height: 37px;
  background-position: 0 -67px;
  vertical-align: top;
  margin-left: 5px;
  margin-right: 5px;
}
.s-inpt {
  border: none;
  outline: none;
  background: transparent;
  width: 494px;
  font: 16px arial;
  height: 25px;
  padding: 7px 5px 3px;
  padding: 9px 5px 2px\9;
  position: relative;
  z-index: 5;
  background: #FAA5A5;
  -moz-border-radius: 15px;
  -webkit-border-radius: 15px;
  border-radius: 15px;
}
.s-btn {
  cursor: pointer;
  height: 34px;
  width: 88px;
  font-size: 14px;
  font-weight: bold;
  text-align: center;
  border: none;
  background: none;
  position: relative;
  z-index: 1;
  background: #F00;
  color: white;
  -moz-border-radius: 15px;
  -webkit-border-radius: 15px;
  border-radius: 15px;
  cursor: pointer;
}
.s-btn-w {
  cursor: pointer;
  display: inline-block;
  height: 37px;
  width: 90px;
}
</style>
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
	        "http://video.baidu.com/v",
	        "http://image.baidu.com/i",
	        "http://news.baidu.com/ns",
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

        <!-- 中间区域-->
        <div id="bd">
            <div id="crumble">
               <a href="<?php echo U('Yo81001/Index/index');?>" title="零零糖网购首页" onclick="">首页</a>
               <span>&gt;</span>视频
            </div>
                        
                                                        <div class="mod mod-secpage">
                    <div class="hd">
                        <h2>视频搜索</h2>
                        <i class="dotline"></i>
                    </div>
                                        <div class="bd clearfix">
										<span><a href="http://v.qq.com/search.html?pagetype=3&stj2=search.smartbox&stag=txt.smart_index&ms_key=%E6%88%91%E5%92%8C%E5%83%B5%E5%B0%B8%E6%9C%89%E4%B8%AA%E7%BA%A6%E4%BC%9A" target="_blank" class="yd-black">我和僵尸有个约会</a></span>
										<span><a href="http://www.soku.com/" target="_blank" class="yd-black">优酷搜库</a></span>
										<span><a href="http://video.baidu.com/" target="_blank" class="yd-black">百度视频搜索</a></span>
                                            <span><a href="http://video.youdao.com/" target="_blank" class="yd-black">有道视频搜索</a></span>
                                            
                                            <span><a href="http://www.google.com.hk/videohp" target="_blank" class="yd-black">谷歌视频搜索</a></span>
                                            <span><a href="http://movie.gougou.com/" target="_blank" class="yd-black">狗狗影视搜索</a></span>
                                            <span><a href="http://video.sogou.com/" target="_blank" class="yd-black">搜狗视频搜索</a></span>
                                            <span><a href="http://www.gudemao.com" target="_blank" class="yd-">古德猫视频搜索</a></span>
                                        </div>
                </div>  
                                <div class="mod mod-secpage">
                    <div class="hd">
                        <h2>视频</h2>
                        <i class="dotline"></i>
                    </div>
                                        <div class="bd clearfix">
                                            <span><a href="http://www.youku.com/" target="_blank" class="yd-black">优酷网</a></span>
                                            <span><a href="http://v.163.com/open" target="_blank" class="yd-black">网易公开课</a></span>
                                            <span><a href="http://www.cntv.cn/" target="_blank" class="yd-black">中国网络电视台</a></span>
											<span><a href="http://www.mianbao.com/" target="_blank" class="yd-">面包网</a></span>
											<span><a href="http://www.zhandi.cc/" target="_blank" class="yd-">战地影院</a></span>
                                            <span><a href="http://www.m1905.com/" target="_blank" class="yd-black">M1905电影网</a></span>
                                            <span><a href="http://www.mumudv.com" target="_blank" class="yd-">木木影视</a></span>
                                            <span><a href="http://www.tudou.com/" target="_blank" class="yd-black">土豆网</a></span>
                                            <span><a href="http://tv.sohu.com/hdtv/" target="_blank" class="yd-black">搜狐高清</a></span>
                                            <span><a href="http://video.sina.com.cn/" target="_blank" class="yd-black">新浪视频</a></span>
                                            <span><a href="http://bb.news.qq.com/" target="_blank" class="yd-black">腾讯视频</a></span>
                                            <span><a href="http://tv.hao123.com/" target="_blank" class="yd-black">电视剧排行榜</a></span>
                                            <span><a href="http://v.163.com/" target="_blank" class="yd-black">网易视频</a></span>
                                            <span><a href="http://www.iqiyi.com/" target="_blank" class="yd-black">爱奇艺</a></span>
                                            <span><a href="http://www.imgo.tv/" target="_blank" class="yd-black">芒果TV</a></span>
                                            <span><a href="http://www.letv.com/" target="_blank" class="yd-black">乐视网</a></span>
                                            <span><a href="http://www.pomoho.com/" target="_blank" class="yd-black">爆米花网</a></span>
                                            <span><a href="http://www.ku6.com/" target="_blank" class="yd-black">酷6网</a></span>
                                            <span><a href="http://www.joy.cn/" target="_blank" class="yd-black">激动网</a></span>
                                            <span><a href="http://www.jstv.com/" target="_blank" class="yd-black">江苏卫视</a></span>
                                            <span><a href="http://www.v1.cn/" target="_blank" class="yd-black">第一视频</a></span>
                                            <span><a href="http://v.huanqiu.com/" target="_blank" class="yd-black">环球网视频</a></span>
                                            <span><a href="http://www.56.com/" target="_blank" class="yd-black">56网</a></span>
                                            <span><a href="http://www.xunlei.com/" target="_blank" class="yd-black">迅雷看看</a></span>
                                            <span><a href="http://6.cn/" target="_blank" class="yd-black">六间房</a></span>
                                            <span><a href="http://www.smgbb.cn/2010/tv" target="_blank" class="yd-black">东方宽屏</a></span>
                                            <span><a href="http://www.longbuluo.com/" target="_blank" class="yd-">龙部落</a></span>
                                            <span><a href="http://www.s2wo.com/" target="_blank" class="yd-">高清百度影音</a></span>
                                            <span><a href="http://v.6164.com" target="_blank" class="yd-">2015最新电影</a></span>
                                            <span><a href="http://click.t3nlink.com/link/131473/" target="_blank" class="yd-">美女秀场</a></span>
                                        </div>
                </div>  
                                <div class="mod mod-secpage">
                    <div class="hd">
                        <h2>网络电视</h2>
                        <i class="dotline"></i>
                    </div>
                                        <div class="bd clearfix">
                                            <span><a href="http://www.pps.tv/" target="_blank" class="yd-black">PPS</a></span>
                                            <span><a href="http://www.pptv.com/" target="_blank" class="yd-black">PPTV</a></span>
                                            <span><a href="http://www.funshion.com/" target="_blank" class="yd-black">风行</a></span>
                                            <span><a href="http://www.uusee.com/" target="_blank" class="yd-black">UUsee</a></span>
                                            <span><a href="http://live.qq.com/" target="_blank" class="yd-black">QQlive</a></span>
                                            <span><a href="http://www.xunlei.com/" target="_blank" class="yd-black">迅雷看看</a></span>
                                        </div>
                </div>  
                                <div class="mod mod-secpage">
                    <div class="hd">
                        <h2>综艺节目</h2>
                        <i class="dotline"></i>
                    </div>
                                        <div class="bd clearfix">
                                            <span><a href="http://fcwr.jstv.com/" target="_blank" class="yd-black">非诚勿扰</a></span>
                                            <span><a href="http://video.youdao.com/search?q=%E5%BF%AB%E4%B9%90%E5%A4%A7%E6%9C%AC%E8%90%A5&keyfrom=hao163" target="_blank" class="yd-black">快乐大本营</a></span>
                                            <span><a href="http://video.youdao.com/search?q=%E5%A4%A9%E5%A4%A9%E5%90%91%E4%B8%8A&keyfrom=hao163" target="_blank" class="yd-black">天天向上</a></span>
                                            <span><a href="http://www.qiyi.com/zongyi/aqllk.html" target="_blank" class="yd-black">爱情连连看</a></span>
                                            <span><a href="http://video.youdao.com/search?q=%E5%BA%B7%E7%86%99%E6%9D%A5%E4%BA%86&keyfrom=hao163" target="_blank" class="yd-black">康熙来了</a></span>
                                            <span><a href="http://www.qiyi.com/zongyi/wmyhb.html" target="_blank" class="yd-black">我们约会吧</a></span>
                                            <span><a href="http://baidu.cntv.cn/podcast/PODC1268034682921157" target="_blank" class="yd-black">星光大道</a></span>
                                            <span><a href="http://baidu.cntv.cn/page/PAGE1268812341046484" target="_blank" class="yd-black">百家讲坛</a></span>
                                            <span><a href="http://www.qiyi.com/zongyi/glxqt.html" target="_blank" class="yd-black">给力星期天</a></span>
                                            <span><a href="http://video.youdao.com/search?q=%E5%B9%B8%E7%A6%8F%E9%AD%94%E6%96%B9&keyfrom=hao163" target="_blank" class="yd-black">幸福魔方</a></span>
                                            <span><a href="http://www.qiyi.com/zongyi/wajgc.html" target="_blank" class="yd-black">我爱记歌词</a></span>
                                        </div>
                </div>  
                                <div class="mod mod-secpage">
                    <div class="hd">
                        <h2>体育直播</h2>
                        <i class="dotline"></i>
                    </div>
                                        <div class="bd clearfix">
                                            <span><a href="http://sports.cntv.cn/" target="_blank" class="yd-black">CNTV体育台</a></span>
                                            <span><a href="http://www.zhibo8.com/" target="_blank" class="yd-black">直播吧</a></span>
                                            <span><a href="http://www.360bo.com/" target="_blank" class="yd-black">360播</a></span>
                                            <span><a href="http://www.hoopchina.com/tv/" target="_blank" class="yd-black">NBA直播</a></span>
                                            <span><a href="http://live.sports.pptv.com/" target="_blank" class="yd-black">PPTV体育电视</a></span>
                                        </div>
                </div>  
                                        
            <a id="back" href="<?php echo U('Yo81001/Index/index');?>" title="零零糖网购首页" onclick="">返回首页</a>            
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


    </div>
    <script src="../Public/common.js?201311221"></script>
</body>
</html>