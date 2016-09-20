<?php if (!defined('THINK_PATH')) exit();?>
    <!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>编辑部 - 100头条 - 每天精选100个有深度微信头条</title>
<meta http-equiv="Cache-Control" content="no-cache" />
<meta name="viewport" content="initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="MobileOptimized" content="320"/>
<link href="../Public/reset.css" rel="stylesheet" type="text/css" media="all">
<link href="../Public/user.css" rel="stylesheet" type="text/css" media="all">
<link href="../Public/default.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="../Public/bootcss.css" /> 
</head>
<body class="yahei">
  <!-- 导航--> 
  <div style='display:none'><script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1253005137'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s19.cnzz.com/stat.php%3Fid%3D1253005137' type='text/javascript'%3E%3C/script%3E"));</script></div>
  <div id="header" class="box-shadow"> 
   <div class="fixed-nav" > 
    <div style="float:left;position:relative; padding:0px; margin:0px;">
     <div style="position:absolute;top:-7px; height:78px; font-size:10px; width:159px; line-height:159px; left:0px;">
       <a href="/"  title="100头条，有深度的微信头条！精选网友分享的微信头条。好的头条，源自分享！"> <img src="../Public/image/100toutiao.jpg" style="width:159px;height:78px; " />
   </a>
   
     </div>
     <div style=" display:none;position:absolute;     
     color:#FFF; top:0px; height:12px; font-size:10px; width:180px; line-height:12px; left:100px;
      -webkit-animation:0.5s ease 1 forwards;
    -webkit-animation-duration:2s;
    -webkit-animation-name:demo;
    -moz-animation:0.5s ease 1 forwards;
    -moz-animation-name:demo;
    -moz-animation-duration:2s;
     ">有深度的微信头条！
	 </div>
    </div> 
    <ul style="float:left;margin-left: 200px;"> 
     <li><a href="<?php echo U('Yo80007/Index/Index');?>"class="nav-active">首页</a></li> 
     <li><a href="<?php echo U('Yo80007/Index/Index');?>"  >科技</a></li>
	 <li><a href="<?php echo U('Yo80007/Index/Index');?>"  >商业</a></li>
	 <li><a href="<?php echo U('Yo80007/Index/Index');?>"  >人文</a></li>
	 <li><a href="<?php echo U('Yo80007/Index/Index');?>"  >案例</a></li>    
     <li><div style="position:relative;"><div style="position:absolute; top:0px; height:20px; font-size:10px; width:30px; line-height:20px; right:0px;"><img title="网友分享的文章聚合沉淀池子，主编从中选择文章为100头条，欢迎网友分享文章！好的头条源自分享！我分享我快乐！" src="../Public/image/new.jpg" /></div></div>      <a    title="网友分享的文章聚合沉淀池子，主编从中选择文章为100头条，欢迎网友分享文章！好的头条源自分享！我分享我快乐！ " href="/index.php?m=Index&a=apool" >文池
      </a>      
      </li>
     <!--  <li><a href="http://www.100toutiao.com/index.php?m=Index&a=index&cat=99">推荐</a></li> -->
      <!-- <li><a href="http://www.100toutiao.com/index.php?m=Index&a=index&cat=99">推荐</a></li>-->
    </ul> 
    <ul style="float:right;" id="login"> 
  <!--   <li><a id="login_a" href="/index.php?g=User&m=Login&a=index">登录</a></li>--> 
     <li>
	 <?php if($_SESSION['id']!= ''): ?><a id="login_a" href="<?php echo U('Yo80007/User/Index');?>"><?php echo (session('name')); ?></a>
	 <?php else: ?>
	 <a id="login_a" href="<?php echo U('Yo80007/User/login');?>">登录</a><?php endif; ?>
	 </li>
     <div class="clearfix"></div> 
    </ul> 
   </div> 
  </div> 

 <section>
 <div id="main" class="wrap clear">
    <div class="user-left fl">
 
 
   <dl>
    <dt>内容管理</dt>
       <dd><a href="/index.php?g=User&m=Article&a=lists" >我的文章</a></dd>    <dd><a href="/index.php?g=User&m=Article&a=addArticle" >分享文章</a></dd>
  </dl>
   
   
   <dl>
    <dt>个人中心</dt>
	<dd><a href="<?php echo U('Yo80007/User/Index');?>" class="sel">首页</a></dd>
    <dd><a href="<?php echo U('Yo80007/User/profile');?>" >个人信息</a></dd>
    <dd><a href="<?php echo U('Yo80007/User/avatar');?>" >修改头像</a></dd>
    <dd><a href="<?php echo U('Yo80007/User/logout');?>" >退出登录</a></dd>
  </dl>  </div>
    <div class="user-right fr">
      <div class="user-info clear"> <img src='#' onerror="this.src='/Public/User/images/index-plugins-4.gif'">
        <h3><b><?php echo (session('name')); ?></b><small>（实习主编）</small></h3>
        <p><span>上次登录时间：2015-02-05 23:19:24</span><span>上次登录IP：113.65.44.132</span></p>
      </div>
      <div class="user-desc clear">
        <ul>
          <li>
            <h3>已推荐文章</h3>
            <a href="/index.php?g=User&m=Article&a=lists">0</a></li>
          <li>
            <h3>积分</h3>
            <span>0</a></span>
          <li>
            <h3></h3>
            <span></span></li>
          <li style="border:none; width:172px;">
            <h3></h3>
            <span></span></li>
        </ul>
      </div>      <div class="user-msg">
        <h3>使用帮助</h3>
        <p> 遇到错误或者不清楚的欢迎加群：201923866 进群交流！<br>
          
      </div>
    </div>
  </div>
</section>
    <style>
  
#footer{width: 100%;line-height:30px;text-align:center;margin:40px auto 20px;color: #999;font-family:Arial;}
#footer a{padding:0 5px;color: #999}


 </style> 
  <div id="footer"> 
  
  <p> <span>Copyright&nbsp;&copy; 2014 <a href="http://www.100toutiao.com">100toutiao.com</a>  All Rights Reserved 京ICP备14007529号-1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> </p>
  <!--  <img src="/Public/images/yibaitt.jpg" width="80" height="80" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />
 -->
 
<strong  style="color:#000">100头条，每天精选有深度的微信头条！好的头条，源自分享！关注“100头条”方便随时看最新分享，可以复制微信连接发到公号分享文章，回复关键词查询相关头条文章！</strong>
 		 
	  <p style="color:#000">文章均来自网友分享，如果您对文章内容观点，知识产权等有争议问题请联系内容发布方处理。如果有建议或需要本站处理事宜，
	  请关注微信公众号："100头条"反馈或者加微信：yibaitoutiao联系我们。
  </p>
 <p>100头条网友交流QQ群：430087494 欢迎加入</p>

  </div> 
  <div id="lookMore"></div> 

</body>
</html>