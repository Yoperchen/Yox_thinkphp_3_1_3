<?php if (!defined('THINK_PATH')) exit();?> <!DOCTYPE html>
<html>
 <head> 
  <meta charset="utf-8" /> 
      <title>100头条——每天精选100个有深度的微信头条</title>     
  <meta name="keywords" content="100头条——每天精选100个有深度的微信头条,100头条,一百头条,分享头条,我的100头条,微头条,深度微信头条,必读的微信头条,微信聚合,微信头条,微信精选" />
<meta name="description" content="100头条，每天精选网友分享的有深度的微信头条!微头条，好的头条，源自分享，分享微信文章!分享到朋友圈只要朋友看到，分享到100头条更多人看到！发扬互联网分享精神！我的100头条,我的分享！" /> 
 <link rel="stylesheet" type="text/css" href="../Public/base.css" /> 
  <link rel="stylesheet" type="text/css" href="../Public/wtt201311.css" /> 
   <link rel="stylesheet" type="text/css" href="../Public/bootcss.css" /> 
  <link rel="shortcut icon" href="../Public/image/favicon.ico" type="image/x-icon" /> 

 </head> 
 <body> 
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
     <li><a id="login_a" href="login.php">登录</a></li>
     <div class="clearfix"></div> 
    </ul> 
   </div> 
  </div> 

  <!-- 内容 --> 
  <div id="content"> 
    
    
    
   <div class="wrapper"> 
    <div class="box-left"> 
     <!--
					
					
					<div id="jincuodao_wx">
						<img src="/Public/images/jincuodao_wx.png" />
					</div>
	--> 
     <div class="box-view box-shadow"> 
     <div class="fy"> <h1><?php echo ($article_detail_result["data"]["title"]); ?><small>
        </small></h1><a name="top"></a></div>
  
  <div style="border-bottom:#ececec 1px solid; color:#c7c5c5; text-align:center; padding:10px; height:30px;margin-bottom:20px;">
    科技说 / 深度指数：      <span class="glyphicon glyphicon-star" style="color:#41af28"></span><span class="glyphicon glyphicon-star" style="color:#41af28"></span><span class="glyphicon glyphicon-star" style="color:#41af28"></span>           <span class="glyphicon glyphicon-star-empty" style="color:#ececec;"></span><span class="glyphicon glyphicon-star-empty" style="color:#ececec;"></span>  <div class="bdsharebuttonbox bdshare-button-style0-16" style="float:right;" data-bd-bind="1421898974993"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信">分享到微信</a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a></div>
  </div>
      
          
    <div style="line-height:36px;">
       <?php echo ($article_detail_result["data"]["content"]); ?>
       </div>
      
	<p style="border-bottom:#d9d9d9 1px solid">&nbsp;</p> 
	
     <div style="text-align:center;  position:fixed; z-index:999; top:50%;"> <div style="position:relative"><div style="position:absolute; left:-100px;-webkit-background-size: 50px; -webkit-box-shadow: gray 1px 1px 8px; box-shadow: gray 1px 1px 8px; border-radius:2px; padding:8px;">  
           <span class="glyphicon glyphicon-user" style="color:#0C0;"></span>
     <br>

    
     </div> </div></div>
     
      <div class="bdsharebuttonbox bdshare-button-style0-16" style="float:right;" data-bd-bind="1421898974993"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信">分享到微信朋友圈</a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a></div>
           
       <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{},"image":{"viewList":["weixin","qzone","tsina","tqq","renren"],"viewText":"分享到：","viewSize":"32"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["weixin","qzone","tsina","tqq","renren"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
     
     
      <p>
      
      分享源自微信公众账号：<strong style="color:#F00">科技说 </strong>  (<a target="_blank" style="color:#d9d9d9" href="http://mp.weixin.qq.com/s?__biz=MjM5MDEzOTc0MA==&amp;mid=216854659&amp;idx=1&amp;sn=20f45dfa0ddb9c1c7f12bee95afe4af9#rd">阅读原文</a>)
      
      
      </p>

  		
  		
  		 	<p>&nbsp;</p> 
	 
	    <p style="text-align:center;">
	    <!-- <a class="likenum" a_id="31768" title="喜欢"  href="javascript:"><span class="glyphicon glyphicon-heart" style="color:#d9d9d9;" >     
     </span> <span class="glyphicon-heart_num"  style="color:#000;" >14</span></a>&nbsp;&nbsp;
	  <a class="up" data_id="31768" title="顶一下"  href="javascript:"><span class="glyphicon glyphicon-thumbs-up" style="color:#d9d9d9;" id=" 5" >      
     </span> <span class="glyphicon-thumbs-up_num" style="color:#000;">5</span></a>&nbsp;&nbsp;
 <a class="down" data_id="31768" title="踩一下"  href="javascript:"><span class="glyphicon glyphicon-thumbs-down" style="color:#d9d9d9;" id=" 0" >
      
     </span> <span class="glyphicon-thumbs-down_num" style="color:#000;">0</span></a>
     
      -->
      &nbsp;&nbsp;
	 
	  <a class="eva" data_id="31768" title="感觉不错就点我推荐下吧！" href="javascript:"><span class="glyphicon glyphicon-comment" style="color:#41af28;" id="eva">
         
     </span> <span class="glyphicon-comment_num" style="color:#000;display:none;">1</span><span style="color:#41af28;">推荐</span></a></p>
      <p style="text-align:center; display:none;"><img src="/Public/images/wzdbad.png" data-bd-imgshare-binded="1"></p>

 <!--    <div class="likenum" aid=" 31768" style="margin:0 auto;margin-top:30px;padding-left:44px;font-size:24px;color:#FFF;width:100px;height:60px;line-height:40px;background: url(/Public/images/img/love_.png) 0 0 no-repeat;">
     
    -->

     </div>
     <div class="mbox-rank mt10 pl20 box-shadow"> 
      <div class="box-left-header">
       <span>源自<a href="/index.php?m=Index&amp;a=showMp&amp;id=1098" style="color:#2E9F54;" title="查看科技说更多微信">科技说</a></span> 的最新微信头条
      </div> 
      <div class="mbox-rank-content" id="relalist"> 
       <ul id="others"></ul> 
      </div> 
     </div> 
     
     <div class="mbox-rank mt10 pl20 box-shadow">
     <br>

 

<br>

     </div>
     <div id="wx-comment" class="mt10"> 
     
     </div> 
     
    </div>
    <div class="box-right" id="sidebar"> 
   <div class="mbox-rank mb10 box-shadow1" style="width:260px;display:none;">
    <div class="mbox-rank-content">
        <a href="http://mp.weixin.qq.com/s?__biz=MjM5NDgwNzUwMA==&mid=201552911&idx=1&sn=99315d9ab085ba19c8196cd5cdfe34bd#rd" target="_blank"><img src="http://www.100toutiao.com/Public/images/dake.png" alt="【微创新总裁实战营•第15期】分众传媒董事局主席江南春 • 互联网创新教练金错刀 " width="260"></a>
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
           100头条，有深度的微信头条！精选网友分享的微信头条。好的头条，源自分享！
      </div> 
      
     </div>
     
      
     <div class="mbox-rank mb10 box-shadow" style="width:260px;" id="24hrb"> 
     
   

      <div class="mbox-rank-header" >
       24小时最热榜   
      </div> 
<div class="mbox-rank-content"> 
       <ul id="hots">
       <li><span>1</span><a target="_blank" href="/index.php?m=Index&amp;a=show&amp;cat=2&amp;id=31498" title="大公国际发布266个P2P平台黑名单，陆金所等平台被预警（含榜单）">大公国际发布266个P2P平台...</a></li>
       <li><span>2</span><a target="_blank" href="/index.php?m=Index&amp;a=show&amp;cat=1&amp;id=31597" title="微信朋友圈广告体今天火了">微信朋友圈广告体今天火了</a></li>
       <li><span>3</span><a target="_blank" href="/index.php?m=Index&amp;a=show&amp;cat=100&amp;id=31378" title="父亡娘改嫁6岁儿童独自吃草生活到12岁">父亡娘改嫁6岁儿童独自吃草生活...</a></li>
       <li><span>4</span><a target="_blank" href="/index.php?m=Index&amp;a=show&amp;cat=0&amp;id=31425" title="朋友圈卖面膜月入3万？宰的就是你！检测5款横扫朋友圈的面膜，你还敢用吗？">朋友圈卖面膜月入3万？宰的就是...</a></li>
       <li><span>5</span><a target="_blank" href="/index.php?m=Index&amp;a=show&amp;cat=3&amp;id=31457" title="当男人穿上女人的衣服…那画面太美我不敢看！">当男人穿上女人的衣服…那画面太...</a></li>
       <li><span>6</span><a target="_blank" href="/index.php?m=Index&amp;a=show&amp;cat=3&amp;id=31376" title="有一种女人，你伤不起">有一种女人，你伤不起</a></li>
       <li><span>7</span><a target="_blank" href="/index.php?m=Index&amp;a=show&amp;cat=3&amp;id=31456" title="黄浦区书记、区长被撤职！外滩踩踏事件处分11名官员">黄浦区书记、区长被撤职！外滩踩...</a></li>
       <li><span>8</span><a target="_blank" href="/index.php?m=Index&amp;a=show&amp;cat=100&amp;id=31589" title="创意产业之父:创意有所为要靠细节铸就">创意产业之父:创意有所为要靠细...</a></li>
       <li><span>9</span><a target="_blank" href="/index.php?m=Index&amp;a=show&amp;cat=0&amp;id=31428" title="男人病危 , 他的情人和妻子分别一前一后进入病房后，竟然....">男人病危 , 他的情人和妻子分...</a></li>
       <li><span>10</span><a target="_blank" href="/index.php?m=Index&amp;a=show&amp;cat=3&amp;id=31371" title="“舰娘吧70万事件”的背后，你该看到什么？|游戏葡萄">“舰娘吧70万事件”的背后，你...</a></li>
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
       <li><i style="">1</i> <a target="_blank" href="/index.php?m=Index&amp;a=wode&amp;uid=60" title="查看榜上有名的100头条">榜上有名</a></li>
       <li><i style="">2</i> <a target="_blank" href="/index.php?m=Index&amp;a=wode&amp;uid=6" title="查看一百头条的100头条">一百头条</a></li>
       <li><i style="">3</i> <a target="_blank" href="/index.php?m=Index&amp;a=wode&amp;uid=3" title="查看彪哥的100头条">彪哥</a></li>
       <li><i style="">4</i> <a target="_blank" href="/index.php?m=Index&amp;a=wode&amp;uid=273" title="查看匿名用户的100头条">匿名用户</a></li>
       <li><i style="">5</i> <a target="_blank" href="/index.php?m=Index&amp;a=wode&amp;uid=9" title="查看sunxin的100头条">sunxin</a></li>
       <li><i style="">6</i> <a target="_blank" href="/index.php?m=Index&amp;a=wode&amp;uid=61" title="查看新消息的100头条">新消息</a></li>
       <li><i style="">7</i> <a target="_blank" href="/index.php?m=Index&amp;a=wode&amp;uid=4" title="查看龚进辉的100头条">龚进辉</a></li>
       <li><i style="">8</i> <a target="_blank" href="/index.php?m=Index&amp;a=wode&amp;uid=58" title="查看中国新贵族的100头条">中国新贵族</a></li>
       <li><i style="">9</i> <a target="_blank" href="/index.php?m=Index&amp;a=wode&amp;uid=281" title="查看大头轩的100头条">大头轩</a></li>
       <li><i style="">10</i> <a target="_blank" href="/index.php?m=Index&amp;a=wode&amp;uid=38" title="查看A星辰的100头条">A星辰</a></li>
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
      关注“100头条”微信服务号
      
      </div> 
      <div class="mbox-rank-content"> 
       <ul id="gzfwh"> 
      <img src="../Public/image/yibaitt2.jpg" width="260"  title="搜索'100头条'微信公众账号或微信号‘yibaitt’或直接扫描关注我们!" alt="搜索'100头条'微信公众账号或微信号‘yibaitt’或直接扫描关注我们!" /> 
       
       </ul> 
       
             
<br>1、关注后可以分享文章（复制微信连接发到“100头条”公号，即可分享到100头条）。
<br>2、回复关心的词搜索相关有深度的微信头条。
<br>3、有100头条最新分享、24小时热榜菜单，方便手机微信随时随地看有深度的微信头条！ 
      </div> 
 

    </div>
    
    
    
     <div class="mbox-rank mb10 box-shadow" style="width:260px;"> 
 
   

   <div class="mbox-rank-header">
      下载“100头条”App安卓版
      
      </div> 
      <div class="mbox-rank-content"> 
       <ul id="appandroid"> 
      <a href="http://app.100toutiao.com/100toutiao.apk" target="_blank">
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
 
<strong  style="color:#000">100头条，每天精选有深度的微信头条！好的头条，源自分享！关注“100头条”方便随时看最新分享，可以复制微信连接发到公号分享文章，回复关键词查询相关头条文章！</strong>
 		 
	  <p style="color:#000">文章均来自网友分享，如果您对文章内容观点，知识产权等有争议问题请联系内容发布方处理。如果有建议或需要本站处理事宜，
	  请关注微信公众号："100头条"反馈或者加微信：yibaitoutiao联系我们。
  </p>
 <p>100头条网友交流QQ群：430087494 欢迎加入</p>

  </div> 
  <div id="lookMore"></div> 

  <script>
	
	
  	//查看推荐
    $('.eva').on('click', function(){
	  	   location.href="http://www.100toutiao.com/login.php";
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
 </body>
</html>