<?php if (!defined('THINK_PATH')) exit();?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>主编登录 - 100头条 - 每天精选100个有深度的微信头条</title>
<meta http-equiv="Cache-Control" content="no-cache" />
<meta name="viewport" content="initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="MobileOptimized" content="320"/>
<link href="../Public/reset.css" rel="stylesheet" type="text/css" media="all">
<link href="../Public/loginReg.css" rel="stylesheet" type="text/css" media="all">

</head>
<body class="yahei">
<div class="left">
  <div class="con">
    <div class="info"> <a href="http://www.100toutiao.com/" target="_blank" class="code-pic"> <img class="app-pic" src="/Public/User/images/login-reg-qrcode.jpg" width="100" height="100"> </a>
      <p>微信：yibaitt</p>
    </div>
  </div>
</div>
<div class="right">
  <div class="logo"><a href="http://www.100toutiao.com/"><img src="/Public/User/images/login-reg-logo.gif" alt="100头条" width="300"></a><br>
    <span class="slogan">金错刀和他的朋友们，<br/>每天精选100个有深度的微信头条！</span> 
  </div>
  <form name="loginForm" method="post" action="<?php echo U('Yo80007/User/login');?>" class="J_ajaxForm">
  	<p class="info-tips">没有账号？<a href="/index.php?g=User&m=Regist&a=index">立即注册</a> 
    <a href="http://www.100toutiao.com/login.php">微信登录</a>
 
    <p class="form-error">&nbsp;</p>
    <div class="form-row">
      <input id="id" name="id" type="text" class="basic-input" maxlength="60" value="" tabindex="1" placeholder="用户名、手机、邮箱">
    </div>
    <div class="form-row">
      <input id="password" name="password" type="password" class="basic-input" maxlength="30" tabindex="2" placeholder="密码">
    </div>
    <div class="form-row" style="display:none;">
      <input id="password" name="verify" type="verify" class="short-input" maxlength="10" tabindex="2" placeholder="验证码"><a href="javascript:document.getElementById('code_img').src='/index.php?g=Api&m=Checkcode&a=index?time='+Math.random();void(0);" class="change_img" title="看不清，换一张！"><img id="code_img" src="/index.php?g=Api&m=Checkcode&a=index"></a>
    </div>
    <div>
      <button class="btn-submit J_ajax_submit_btn">登录</button>
      <div class="remember-item">
        <label class="remember-label"><input type="checkbox" id="cookieTime" name="cookieTime" tabindex="4" checked=""> 记住我 </label>
        <span class="forget-pass">|&nbsp;<a href="#">忘记密码了</a></span> </div>
    </div>
  </form>
  <div class="copyright-info">Copyright © 2014 100toutiao.com All Right Reserved. </div>
</div>

</body>
</html>