<?php if (!defined('THINK_PATH')) exit();?> <!DOCTYPE html>
<html>
 <head> 
  <meta charset="utf-8" /> 
      <title>零零糖——每天精选100个有深度的微信头条</title>     
  <meta name="keywords" content="零零糖——每天精选100个有深度的微信头条,零零糖,一百头条,分享头条,我的零零糖,微头条,深度微信头条,必读的微信头条,微信聚合,微信头条,微信精选" />
<meta name="description" content="零零糖，每天精选网友分享的有深度的微信头条!微头条，好的头条，源自分享，分享微信文章!分享到朋友圈只要朋友看到，分享到零零糖更多人看到！发扬互联网分享精神！我的零零糖,我的分享！" /> 
 <link rel="stylesheet" type="text/css" href="../Public/base.css" /> 
  <link rel="stylesheet" type="text/css" href="../Public/wtt201311.css" /> 
   <link rel="stylesheet" type="text/css" href="../Public/bootcss.css" /> 
  <link rel="shortcut icon" href="../Public/image/favicon.ico" type="image/x-icon" /> 

 </head> 
 <body> 
<!-- 通用头部--> 
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
     <li><a href="<?php echo U('Yo80007/Index/index');?>"class="nav-active">首页</a></li> 
     <li><a href="<?php echo U('Yo80007/Index/index');?>"  >科技</a></li>
	 <li><a href="<?php echo U('Yo80007/Index/index');?>"  >商业</a></li>
	 <li><a href="<?php echo U('Yo80007/Index/index');?>"  >人文</a></li>
	 <li><a href="<?php echo U('Yo80007/Index/index');?>"  >案例</a></li>    
     <li><div style="position:relative;"><div style="position:absolute; top:0px; height:20px; font-size:10px; width:30px; line-height:20px; right:0px;">
	 <img title="网友分享的文章聚合沉淀池子，主编从中选择文章为100头条，欢迎网友分享文章！好的头条源自分享！我分享我快乐！" src="../Public/image/new.jpg" /></div></div>      <a    title="网友分享的文章聚合沉淀池子，主编从中选择文章为100头条，欢迎网友分享文章！好的头条源自分享！我分享我快乐！ " href="/index.php?m=Index&a=apool" >文池
      </a>      
      </li>
     <!--  <li><a href="http://www.100toutiao.com/index.php?m=Index&a=index&cat=99">推荐</a></li> -->
      <!-- <li><a href="http://www.100toutiao.com/index.php?m=Index&a=index&cat=99">推荐</a></li>-->
    </ul> 
    <ul style="float:right;" id="login"> 
  <!--   <li><a id="login_a" href="/index.php?g=User&m=Login&a=index">登录</a></li>--> 
     <li>
	 <?php if($_SESSION['id']!= ''): ?><a id="login_a" href="<?php echo U('Yo80007/User/index');?>"><?php echo ((session('name'))?(session('name')):"这家伙很懒，什么也没留下"); ?></a>
	 <?php else: ?>
	 <a id="login_a" href="<?php echo U('Yo80007/User/login');?>">登录</a><?php endif; ?>
	 </li>
     <div class="clearfix"></div> 
    </ul> 
   </div> 
  </div> 

  <!-- 内容 --> 
  <div id="content"> 
    
    
    
   <div class="wrapper"> 
    <div class="box-left bgfff  pb10 box-shadow">
    
     <div class="box-left-header" >
             精选头条            
<div style="float: right; margin-right: 10px;">

			<form class="form-inline" name="ssform" id="ssform" role="form"
			method="get" action="index.php?m=Index&a=index&cat=">
	<div class="form-group has-success has-feedback" style="color:#239e24;" >
  <!-- 零零糖，欢迎大家一起来阅读、分享、互动！ -->
		<input style="display:none;" type="text" name='title' class="form-control" id="title"
			placeholder="输入关键词，回车搜索">
		<span class="sssub glyphicon glyphicon-search form-control-feedback"></span>
	</div>
	</form>
</div>


      </div>
       
<div id='loginp' style="text-align:center; display:none; position:fixed; z-index:999; top:50%;"> <div style="position:relative"><div style="position:absolute; left:-60px;-webkit-background-size: 50px; -webkit-box-shadow: gray 1px 1px 8px; box-shadow: gray 1px 1px 8px; border-radius:2px; padding:8px;">  
    <a href="login.php" title="登录就是主编，可以分享自己认为是的头条,组成自己的零零糖！"><span class="glyphicon glyphicon-log-in"></span></a>
    </div></div></div>

     <?php if(is_array($result['data']['list'])): foreach($result['data']['list'] as $key=>$vo): ?><div class="box-list wx-text-thumb" id="<?php echo ($vo["id"]); ?>">
	  <div class="wx-text"> 
      <a name="a7747"></a> 
      <h3><a href="<?php echo U('Yo80007/News/article_detail',array('id'=>$vo['id']));?>" aid="<?php echo ($vo["id"]); ?>" class="open" title="<?php echo ($vo["title"]); ?>" target="_blank"><?php echo ($vo["title"]); ?></a></h3> 
      <p class="wx-intro"><?php echo ($vo["desc"]); ?><a href="<?php echo U('Yo80007/News/article_detail',array('id'=>$vo.id));?>" class="open" title="<?php echo ($vo["title"]); ?>" target="_blank"></a></p> 
      <div class="wx-info"> 
      <span class="wx-source"><a href="/index.php?m=Index&a=showMp&id=816"  title="深度指数(3星)" style="color:#50a055;">财富人生 </a><span style="color:#40b647;"> (
     
     
     深度指数：      <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span>           <span class="glyphicon glyphicon-star-empty" style="color:#CCC;"></span><span class="glyphicon glyphicon-star-empty" style="color:#CCC;"></span>    )  
         </span> </span>                
            <span class="wx-read"  style=" display:none;"><i style="display:block;width:10px;height: 15px;background: url(/Public/images/img/hot.png) 0 0 no-repeat;float:left;margin-right:3px;"></i><b style="color:#db4c3b;"></b></span> 
       <span class="wx-read" style="margin-right:20px;"></span> 
       
       <span class="wx-time" f="47分钟前">47分钟前  &nbsp;&nbsp; 网友 <a href="/index.php?m=Index&a=wode&uid=273" style="color:#50a055;" title="查看匿名用户分享推荐的零零糖"> 匿名用户 分享</a>  &nbsp;&nbsp; <a href="/index.php?m=Index&a=ftsm"  style="color:#50a055;"  title="您也可以分享-查看分享说明！"><span class="glyphicon glyphicon-share"></span>&nbsp;</a>  </span> 
       
      </div> 
     </div> 
     <div class="wx-thumb"> 
      <a href="/index.php?m=Index&a=show&cat=3&id=31558      " aid="31558" class="open" target="block">
      
      <img class="lazy" src="http://mmbiz.qpic.cn/mmbiz/XL4T9iaPIKLXibianQk5NoxtVC0wfxsg7QbsJYQ39ibIdic7Vqpeh6tV2IEibjQJzHg9lPCInFxP1XaQias9J73rI0ibSw/0" width="135" height="90" alt="[]-✿生娃后，最束手无策的第一年。太全了！超实用！" title="[]-✿生娃后，最束手无策的第一年。太全了！超实用！" />
      </a> 
     </div> 
     <div class="clearfix"></div>
     </div><?php endforeach; endif; ?>
    <style>
    .pager{margin-top:10px;text-align:center;margin-bottom:10px;}
    .pager-right{float:right;}
    .pager a{display:inline-block;padding:0px 10px;font-size:12px;background:#e1e1e1;margin:0 2px;color:#000;border:1px solid #ccc;-moz-border-radius: 3px;
-webkit-border-radius: 3px;
border-radius: 3px;}
    .pager span.current{display:inline-block;padding:0px 10px;font-size:12px;background:#aea9ac;margin:0 2px;color:#fff;border:1px solid #ccc;-moz-border-radius: 3px;
-webkit-border-radius: 3px;
border-radius: 3px;}
    .pager a:hover{border:1px solid #4aaf3a;color:#4aaf3a;}
</style> 
    <div class="pager"> 
	<a href="<?php echo U('Yo80007/Index/index',array('p'=>$result['data']['page']['page']-1));?>">上一页</a>   &nbsp;
     <a href="<?php echo U('Yo80007/Index/index',array('p'=>$result['data']['page']['page']+1));?>">下一页</a>   &nbsp;
	 <span class="current"><?php echo ($result['data']['page']['page']); ?></span>&nbsp;
	 <a href="<?php echo U('Yo80007/Index/index',array('p'=>$result['data']['page']['page']+1));?>">&nbsp;<?php echo ($result['data']['page']['page']+1); ?>&nbsp;</a>&nbsp;
	 <a href="<?php echo U('Yo80007/Index/index',array('p'=>$result['data']['page']['page']+2));?>">&nbsp;<?php echo ($result['data']['page']['page']+2); ?>&nbsp;</a>&nbsp;
	 <a href="<?php echo U('Yo80007/Index/index',array('p'=>$result['data']['page']['page']+3));?>">&nbsp;<?php echo ($result['data']['page']['page']+3); ?>&nbsp;</a>&nbsp;
	 <a href="<?php echo U('Yo80007/Index/index',array('p'=>$result['data']['page']['page']+4));?>">&nbsp;<?php echo ($result['data']['page']['page']+4); ?>&nbsp;</a> 
	 <a href="<?php echo U('Yo80007/Index/index',array('p'=>$result['data']['page']['page']+5));?>">&nbsp;<?php echo ($result['data']['page']['page']+5); ?>&nbsp;</a> 
	 <a href="<?php echo U('Yo80007/Index/index',array('p'=>$result['data']['page']['page_count']));?>" >最后一页</a>   
	 </div> 
    <!--<div class="box-more" id="box-more">更多加载中·····</div>--> 
   </div> 
    <div class="box-right" id="sidebar"> 
   <div class="mbox-rank mb10 box-shadow1" style="width:260px;display:none;">
    <div class="mbox-rank-content">
        <a href="http://mp.weixin.qq.com/s?__biz=MjM5NDgwNzUwMA==&mid=201552911&idx=1&sn=99315d9ab085ba19c8196cd5cdfe34bd#rd" target="_blank"><img src="http://www.linglingtang.com/Public/images/dake.png" alt="【微创新总裁实战营•第15期】分众传媒董事局主席江南春 • 互联网创新教练金错刀 " width="260"></a>
    </div>
</div>
    <!-- <div class="mbox-rank mb10" style="width:260px;"> 
     <div class="mbox-rank-content"> 
    

     <img src="/Public/images/wetoutiao_app.png" width="260" alt="" /> 
     </div> 
    </div> -->
    

    <div id="sidebar-follow"> 
    
    
    <div class="mbox-rank mb10 box-shadow" style="width:260px;display:none;" id="24hrb"> 
     
   

      <div class="mbox-rank-header" >
           零零糖，有深度的微信头条！精选网友分享的微信头条。好的头条，源自分享！
      </div> 
      
     </div>
     
      
     <div class="mbox-rank mb10 box-shadow" style="width:260px;" id="24hrb"> 
     
   

      <div class="mbox-rank-header" >
       24小时最热榜   
      </div> 
<div class="mbox-rank-content"> 
       <ul id="hots">
	    <?php if(is_array($hot_24_hours_result['data']['list'])): foreach($hot_24_hours_result['data']['list'] as $key=>$vo): ?><li>
	   <span><?php echo ($key+1); ?></span>
	   <a target="_blank" href="<?php echo U('Yo80007/News/article_detail',array('id'=>$vo['id']));?>" title="<?php echo ($vo['title']); ?>" >
	   <?php echo ($vo['title']); ?>
	   </a>
	   </li><?php endforeach; endif; ?>
       </ul> 
          
        <a class="yq" href="javascript:yunqikan();" style="display:none;color:#50a055;" title="拼手气随便看看！">
        <img src="/Public/images/yunqikan.gif" width="16"> 拼手气随便看看
       
       </a>
      </div> 
     </div>
     
         <div class="mbox-rank mb10 box-shadow" style="width:260px;"> 
      <div class="mbox-rank-header">
      最热网友分享榜
      </div> 
     <div class="mbox-rank-content"> 
       <ul id="mps">
       <li><i style="">1</i> <a target="_blank" href="/index.php?m=Index&amp;a=wode&amp;uid=60" title="查看榜上有名的零零糖">榜上有名</a></li>
       <li><i style="">2</i> <a target="_blank" href="/index.php?m=Index&amp;a=wode&amp;uid=6" title="查看一百头条的零零糖">一百头条</a></li>
       <li><i style="">3</i> <a target="_blank" href="/index.php?m=Index&amp;a=wode&amp;uid=3" title="查看彪哥的零零糖">彪哥</a></li>
       <li><i style="">4</i> <a target="_blank" href="/index.php?m=Index&amp;a=wode&amp;uid=273" title="查看匿名用户的零零糖">匿名用户</a></li>
       <li><i style="">5</i> <a target="_blank" href="/index.php?m=Index&amp;a=wode&amp;uid=9" title="查看sunxin的零零糖">sunxin</a></li>
       <li><i style="">6</i> <a target="_blank" href="/index.php?m=Index&amp;a=wode&amp;uid=61" title="查看新消息的零零糖">新消息</a></li>
       <li><i style="">7</i> <a target="_blank" href="/index.php?m=Index&amp;a=wode&amp;uid=4" title="查看龚进辉的零零糖">龚进辉</a></li>
       <li><i style="">8</i> <a target="_blank" href="/index.php?m=Index&amp;a=wode&amp;uid=58" title="查看中国新贵族的零零糖">中国新贵族</a></li>
       <li><i style="">9</i> <a target="_blank" href="/index.php?m=Index&amp;a=wode&amp;uid=281" title="查看大头轩的零零糖">大头轩</a></li>
       <li><i style="">10</i> <a target="_blank" href="/index.php?m=Index&amp;a=wode&amp;uid=38" title="查看A星辰的零零糖">A星辰</a></li>
       </ul> 
      
      </div> 
     </div>
     
     <div class="mbox-rank mb10 box-shadow" style="width:260px;" id="ztzrb"> 
     
   

      <div class="mbox-rank-header" >
                 昨天最热头条
      </div> 
      <div class="mbox-rank-content"> 
       <ul id="ztzr">
       <li><i style="">1</i><a target="_blank" href="/index.php?m=Index&amp;a=show&amp;cat=0&amp;id=31369" title="长得丑不可怕，可怕的是觉得自己丑">长得丑不可怕，可怕的是觉得自己...</a></li>
       </ul> 
     
      </div>
     </div>
     
     
     <div class="mbox-rank mb10 box-shadow" style="width:260px;display:none;"> 
     <div class="mbox-rank-content"> 
   

  
     

   <div class="mbox-rank-header"  >
      最近一周点赞榜
      
      </div> 
      <div class="mbox-rank-content"> 
       <ul id="ups"> 
       <img src="/Public/images/ajax-loader.gif">
       
       </ul> 
      </div> 
 

     </div> 
    </div>
    
     <div class="mbox-rank mb10 box-shadow" style="width:260px;"> 
 
   

   <div class="mbox-rank-header">
      关注“零零糖”微信服务号
      
      </div> 
      <div class="mbox-rank-content"> 
       <ul id="gzfwh"> 
      <img src="../Public/image/yibaitt2.jpg" width="260"  title="搜索'零零糖'微信公众账号或微信号‘yibaitt’或直接扫描关注我们!" alt="搜索'零零糖'微信公众账号或微信号‘yibaitt’或直接扫描关注我们!" /> 
       
       </ul> 
       
             
<br>1、关注后可以分享文章（复制微信连接发到“零零糖”公号，即可分享到零零糖）。
<br>2、回复关心的词搜索相关有深度的微信头条。
<br>3、有零零糖最新分享、24小时热榜菜单，方便手机微信随时随地看有深度的微信头条！ 
      </div> 
 

    </div>
    
    
    
     <div class="mbox-rank mb10 box-shadow" style="width:260px;"> 
 
   

   <div class="mbox-rank-header">
      下载“零零糖”App安卓版
      
      </div> 
      <div class="mbox-rank-content"> 
       <ul id="appandroid"> 
      <a href="http://app.linglingtang.com/100toutiao.apk" target="_blank">
      <img src="../Public/image/100toutiaodown.jpg" width="260"  title="扫描二维码下载安装app安卓客户端" alt="扫描二维码下载安装app安卓版" /> </a><br />

      <strong>提示：</strong> 如果扫描下载，请不要用微信扫描，用其他浏览器或者二维码工具扫描下载。<br />

       可以直接点击下载到电脑传送到手机安装！
       </ul> 
      </div> 
 

    </div>
    
     <div class="mbox-rank mb10 box-shadow" style="width:260px;" id="bdad"> 
     <div class="mbox-rank-header">
    金错刀钱规则
      </div> 
     <div class="mbox-rank-content"> 
  


<embed src="http://player.video.qiyi.com/9365718e975669f44d40895d31be3184/0/0/v_19rrnwcmwc.swf-albumId=341257600-tvId=341257600-isPurchase=0-cnId=24" allowFullScreen="true" quality="high" width="260" height="180" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash"></embed>   

 


      
    </div> 
    </div>

      
    
    
    </div> 
    
    
    
    
   </div> 		
  </div>  
  <div class="clearfix"></div> 
    <style>
  
#footer{width: 100%;line-height:30px;text-align:center;margin:40px auto 20px;color: #999;font-family:Arial;}
#footer a{padding:0 5px;color: #999}


 </style> 
  <div id="footer"> 
  
  <p> <span>Copyright&nbsp;&copy; 2014 <a href="http://www.100toutiao.com">100toutiao.com</a>  All Rights Reserved 京ICP备14007529号-1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> </p>
  <!--  <img src="/Public/images/yibaitt.jpg" width="80" height="80" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />
 -->
 
<strong  style="color:#000">零零糖，每天精选有深度的微信头条！好的头条，源自分享！关注“零零糖”方便随时看最新分享，可以复制微信连接发到公号分享文章，回复关键词查询相关头条文章！</strong>
 		 
	  <p style="color:#000">文章均来自网友分享，如果您对文章内容观点，知识产权等有争议问题请联系内容发布方处理。如果有建议或需要本站处理事宜，
	  请关注微信公众号："零零糖"反馈或者加微信：linglingtangcom联系我们。
  </p>
 <p>零零糖网友交流QQ群：430087494 欢迎加入</p>

  </div> 
  <div id="lookMore"></div> 

  <script>
  (new SidebarFollow()).init({
      element: jQuery('#header'),
      distanceToTop: 0
  });
	
	
	
  	//查看推荐
    $('.eva').on('click', function(){
	  	   location.href="http://www.linglingtang.com/login.php";
  layer.msg('请先登录才能查看推荐！！点右上角登录，用微信扫一下即可登录，无需填写注册信息的！！', 5, 1);  
});
    
	
	$('.shendu').on('click', function (e) {
	 

  	  var recordToid = $(this).attr("data_id");
	  if($("#shendu_" + recordToid).css("display")=="none"){
	      $("#shendu_"+recordToid).css("display","block");
	  }else{
		  $("#shendu_"+recordToid).css('display','none');
		}

	
	
	  
 });
 
 
 $('.sssub').on('click', function (e) {
	  var title = $("#title").val();
		if(title==""){
			
			layer.msg('请先输入要搜索的关键词！', 1, 1);
			$("#title").css("display","");
		}else{
			
			$('#ssform').submit();
		}
       	 
       	});
   </script> 
  
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"slide":{"type":"slide","bdImg":"1","bdPos":"right","bdTop":"100"}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
 </body>
</html>