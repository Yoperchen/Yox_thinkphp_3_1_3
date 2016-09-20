<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="title" content="" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta name="language" content="chinese" />
<title>七爷租车-中国最大私家车共享平台 </title>
<link rel="stylesheet" href="../Public/style.css" type="text/css" media="all"/>
<script type="text/javascript" src="__Public__/js/jquery-1.10.2.js"></script>
<!--[if lte IE 6]>
	<script src="/qiyezuche/Tpl/Home/default_theme/Public/js/DD_belatedPNG_0.0.8a-min.js"></script>
	<script>
	  DD_belatedPNG.fix('div,li,a,h3,span,img,.png_bg,ul,input,dd,dt,a');
	</script>
<![endif]-->
</head>
<body>
<!--header-->
	<!--header-->
<div id="top">
  <div class="wrapper">
    <div class="logo"><img src="../Public/image/logo.png" width="299" height="90" /></div>
    <div class="logo_txt"><img src="../Public/image/logo_txt.png" width="527" height="42" /></div>
  </div>
</div>
<div id="menu">
  <div class="wrapper">
    <div class="nav">
        <ul>
        <li  ><a href="<?php echo U('Index/index');?>">首页</a></li>
        <li class="current"><a href="<?php echo U('Car/car_list');?>">我要租车</a></li>
        <!--<li ><a href="<?php echo U('Aircraft/aircraft_list');?>">租飞机</a></li>
		<li ><a href="<?php echo U('Cruises/cruises_list');?>">租游轮</a></li>
        <li ><a href="<?php echo U('Hotels/hotels_list');?>">酒店</a></li>-->
        <li ><a href="<?php echo U('Index/violation');?>">租车流程</a></li>
        <li ><a href="<?php echo U('Index/process');?>">相关协议</a></li>
        <li ><a href="<?php echo U('News/index');?>">新闻资讯</a></li>
        <li ><a href="<?php echo U('Index/about');?>">关于我们</a></li>
        <li ><a href="<?php echo U('Index/contact');?>">联系我们</a></li>
         
        </ul>
    </div>
   <div class="login">
    	     	<ul>
    	<li class="signup"><a href="<?php echo U('Reg/index');?>">注册</a></li>
        <li class="login"><a href="<?php echo U('Login/index');?>">登录</a></li>
        </ul>    </div>
  </div>
</div>
<!--content-->
<div class="flow_title">
</div>
<div class="wrapper m20 mb50"><br/>
<img src="../Public/image/img_flow01.jpg" width="1000" height="389" class="imgdb" />
<img src="../Public/image/img_flow02.jpg" width="1000" height="607" class="imgdb" />
<img src="../Public/image/img_flow03.jpg" width="1000" height="554" class="imgdb" />
</div>
<!--footer-->
<div id="footer">
  <div class="copy_black">粤ICP备11017824号-4 / 粤ICP证130164号
  <br />广州市公安局天河分局备案编号:110105000501
  <br />Copyright &copy;  2012-2016
   <a href="http://www.linglingtang.com">零零糖</a>|
   <a href="http://linglingtang.uz.taobao.com">礼物</a>
  </div>
</div>
</body>
</html>