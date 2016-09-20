<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<title><?php echo ($site_info['data']['site_name']); ?></title>
<meta name="description" content="[!--pagedes--]" />
<meta name="keywords" content="[!--pagekey--]" />
<link href="../Public/master.css" type="text/css" rel="stylesheet" />
<link href="../Public/base.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="../Public/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="../Public/jquery.SuperSlide.2.1.1.js"></script>

</head>


<body>
<div class="head clearfix yh">
	<!--logo-->
    <div class="logo block clearfix">
    	<a href="<?php echo U('Yo81009/Index/index');?>" class="fleft"><img src="../Public/image/logo.png"></a>
        <div class="fright">
        	<p class="tright"><a onclick="SetHome(window.location)" href="javascript:void(0)">设为首页</a> | <a onclick="AddFavorite(window.location,document.title)" href="javascript:void(0)">加入收藏</a></p>
            <br>
            <p class="f16 c_red">咨询电话：18028571804</p>
        </div>
    </div>
    
    <!--nav-->
	<div class="nav clearfix">
    	<ul class="block">
        	<li><a href="<?php echo U('Yo81009/Index/index');?>">网站首页</a></li>
			<?php if(is_array($navigation_result["data"]["list"])): foreach($navigation_result["data"]["list"] as $key=>$vo): ?><li><a href="<?php echo ($vo['url']); ?>" class="L"><?php echo ($vo['name']); ?></a></li><?php endforeach; endif; ?>
			 <!--
            <li><a href="" class="L">关于我们</a></li>
            <li><a href="" class="L">服务范围</a></li>
            <li><a href="" class="L">新闻中心</a></li>
            <li><a href="" class="L">工程案例</a></li>
            <li><a href="" class="L">联系我们</a></li>
			-->
        </ul>
    </div>
    
    <div class="focusBox">
			<ul class="pic">
					<li><a href="#" target="_blank"><img src="../Public/image/banner.jpg"/></a></li>
					<li><a href="#" target="_blank"><img src="../Public/image/banner.jpg"/></a></li>
					<li><a href="#" target="_blank"><img src="../Public/image/banner.jpg"/></a></li>
					<li><a href="#" target="_blank"><img src="../Public/image/banner.jpg"/></a></li>
			</ul>
			<ul class="hd">
				<li></li>
				<li></li>
				<li></li>
				<li></li>
			</ul>
	</div>


</div>

<div class="main clearfix ofHidden block yh">

	<!--左侧-->
	<div class="sidebar fleft">
    	<div class="title">服务项目 Service</div>
        <ul class="menu">
        	<li>拆旧、敲墙、酒店、商场</li>
            <li>宾馆拆旧工程</li>
            <li>建筑工地废旧厂房拆酒店</li>
            <li>娱乐场所</li>
            <li>建筑工地及家庭</li>
        </ul>
        <div class="title mt10">联系我们 Contact</div>
        <div class="contact_nr">
        	<p><b class="f15">XX工程有限公司</b></p>
            <p>电话：18028571804</p>
            <p>传真：020-123456789</p>
            <p>地址：广州天河区羊城国际商贸大厦</p>
            <p>网址：www.linglingtang.com</p>
        </div>
        
    </div>

	<!--右侧-->
    <div class="main_right fright">
    
    	<div class="clearfix">
        
    	<!--公司简介-->
    	<div class="company fleft">
        	<div class="t1"><a href="<?php echo U('Yo81009/Article/article_list');?>"><img src="../Public/image/more.jpg"></a><span>公司简介</span></div>
            <div class="nr f13">
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;拆旧 各种砸墙、砸地砖 铲墙皮、旧房改造，拆隔墙门窗等 清理垃圾 建筑垃圾 垃圾清理 敲墙 敲墙、改结构 酒店、商场,宾馆拆旧工程： 室内结构包括（拆吊顶、拆电缆电线、拆通风系统、拆隔间、拆地板、砸墙、砸地平,室外结构包括：拆广告牌、拆霓虹灯、拆铝合金门窗等。 建筑工地： 拆活动房、拆配电房、拆建筑废料、拆电线电缆、拆水暖器件、拆钢管扣件及门窗材料等。...<a href="" class="c_red">[详细]</a></p>
            <p><img src="../Public/image/gs_t.jpg" width="395" height="105"></p>
            </div>
        </div>
        
        <!--新闻中心-->
        <div class="news fright">
        	<div class="t1"><a href="<?php echo U('Yo81009/Article/article_list');?>"><img src="../Public/image/more.jpg"></a><span>新闻中心</span></div>
            <ul>
			<?php if(is_array($result_article_list["data"]["list"])): foreach($result_article_list["data"]["list"] as $key=>$vo): ?><li><a href="<?php echo U('Yo81009/Article/content',array('id'=>$vo['id']));?>"><?php echo ($vo['title']); ?></a></li><?php endforeach; endif; ?>
            <!--<li><a href="<?php echo U('Yo81009/Article/content',array('id'=>1));?>">这里是新闻标题这里是新闻标题这里是新闻标题</a></li>
                <li><a href="<?php echo U('Yo81009/Article/content',array('id'=>1));?>">这里是新闻标题这里是新闻标题这里是新闻标题</a></li>
                <li><a href="<?php echo U('Yo81009/Article/content',array('id'=>1));?>">这里是新闻标题这里是新闻标题这里是新闻标题</a></li>
                <li><a href="<?php echo U('Yo81009/Article/content',array('id'=>1));?>">这里是新闻标题这里是新闻标题这里是新闻标题</a></li>
                <li><a href="<?php echo U('Yo81009/Article/content',array('id'=>1));?>">这里是新闻标题这里是新闻标题这里是新闻标题</a></li>
                <li><a href="<?php echo U('Yo81009/Article/content',array('id'=>1));?>">这里是新闻标题这里是新闻标题这里是新闻标题</a></li>
                <li><a href="<?php echo U('Yo81009/Article/content',array('id'=>1));?>">这里是新闻标题这里是新闻标题这里是新闻标题</a></li>
                <li><a href="<?php echo U('Yo81009/Article/content',array('id'=>1));?>">这里是新闻标题这里是新闻标题这里是新闻标题</a></li>
				-->
            </ul>
        </div>
        
        
        </div>
        
        <!--产品展示-->
        <div class="cp_show clearfix">
        	<div class="title t1"><a href="<?php echo U('Yo81009/Image/image_list');?>"><img src="../Public/image/more.jpg"></a>案例展示</div>
            <div class="picScroll">
		
		<ul>
			<li><a target="_blank" href="#"><img _src="../Public/image/cp_cp.png" src="../Public/image/blank.png" /><p>案例展示名称</p></a></li>
			<li><a target="_blank" href="#"><img _src="../Public/image/cp_cp.png" src="../Public/image/blank.png" /><p>案例展示名称</p></a></li>
			<li><a target="_blank" href="#"><img _src="../Public/image/cp_cp.png" src="../Public/image/blank.png" /><p>案例展示名称</p></a></li>
			<li><a target="_blank" href="#"><img _src="../Public/image/cp_cp.png" src="../Public/image/blank.png" /><p>案例展示名称</p></a></li>
			<li><a target="_blank" href="#"><img _src="../Public/image/cp_cp.png" src="../Public/image/blank.png" /><p>案例展示名称</p></a></li>
			<li><a target="_blank" href="#"><img _src="../Public/image/cp_cp.png" src="../Public/image/blank.png" /><p>案例展示名称</p></a></li>
			<li><a target="_blank" href="#"><img _src="../Public/image/cp_cp.png" src="../Public/image/blank.png" /><p>案例展示名称</p></a></li>
			<li><a target="_blank" href="#"><img _src="../Public/image/cp_cp.png" src="../Public/image/blank.png" /><p>案例展示名称</p></a></li>
			<li><a target="_blank" href="#"><img _src="../Public/image/cp_cp.png" src="../Public/image/blank.png" /><p>案例展示名称</p></a></li>
			<li><a target="_blank" href="#"><img _src="../Public/image/cp_cp.png" src="../Public/image/blank.png" /><p>案例展示名称</p></a></li>
		</ul>

	</div>
        </div>
        
    </div>


</div>
<!-- 底部-->
<div class="foot tcenter yh f13">
	<p>联系人：陈先生 18028571804</p>
	<p>Copyright © 2014-2015 www.linglingtang.com,All Rights Reserved 粤ICP备12345678号</p>
    
</div>


<script src="../Public/all.js" type="text/javascript"></script>
</body>
</html>