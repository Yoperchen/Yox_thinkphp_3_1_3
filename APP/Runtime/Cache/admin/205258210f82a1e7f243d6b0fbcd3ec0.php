<?php if (!defined('THINK_PATH')) exit();?><div class="Yocms_detail_1">
<div class="title clearfix">
<font class="yh f16">商品</font><span class="fright f12">网站首页 &gt; <a href="#">商品中心</a></span>
</div>
  <div class="newsnr">
      <h1 class="bt"><?php echo (($data['name'])?($data['name']):'没有标题'); ?></h1>
      <div class="date"><span><?php echo (date('Y年m月d日',$data['add_time'])); ?></span>
	  <span>来源：<a href="<?php echo ($data['from_url']); ?>" target="_blank"><?php echo (($data['author'])?($data['author']):'无'); ?></a></span>
	  <span>浏览数: <?php echo ($data['view']); ?></span></div>
      <div class="nr">
        <?php echo (($data['content'])?($data['content']):'没有内容'); ?>
      </div>
      
      <div class="share clearfix">
		<div class="fright"><a href="javascript:window.print()" class="print">打印本页</a></div>
		<div class="fright"><a href="javascript:window.close()" class="close">关闭窗口</a></div>
    </div>
    
    <div class="down clearfix">
    	<div class="fright">
        <div class="bdsharebuttonbox bdshare-button-style1-24" data-bd-bind="1442668935576">
        <a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
        <a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
        <a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a>
        <a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a>
        <a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
        </div>
        </div>
        
        <div class="fleft"><!--
    	<p>上一篇：<a href="">新闻列表</a></p>
        <p>上一篇：<a href="">新闻列表</a></p>  -->
        </div>
    </div>
  </div>
 </div>
<style type="text/css">
.Yocms_detail_1 {
    color: #000;
    background: #FFF;
    font: 12px/1.6 Verdana, Helvetica, sans-serif;
    text-align: center;
}
.Yocms_detail_1 *{
    margin: 0;
    padding: 0;
}
.Yocms_detail_1 div {
    text-align: left;
}
.Yocms_detail_1 a {
    text-decoration: none;
    color: #333;
}
.Yocms_detail_1 a:link, a:visited {
    text-decoration: none;
    outline: none;
}
.Yocms_detail_1 .clearfix {
    display: block;
    clear: both;
    float: none;
}
.Yocms_detail_1 .fleft {
    float: left;
}
.Yocms_detail_1 .fright {
    float: right;
}
.Yocms_detail_1 .f12 {
    font-size: 12px;
}
.Yocms_detail_1 .f16 {
    font-size: 16px;
}
.Yocms_detail_1 .yh {
    font-family: 微软雅黑;
}
.Yocms_detail_1 .title span a {
    color: #ababab;
}
.Yocms_detail_1 .title span {
    color: #ababab;
    background: url(__PUBLIC__/Widget/DetailArticle/Yocms_detail_1/bg_home.gif) no-repeat left center;
    padding-left: 20px;
}
.Yocms_detail_1 .title {
    height: 40px;
    line-height: 40px;
    color: #0061aa;
    border-bottom: 1px solid #d9d9d9;
}
.Yocms_detail_1 .newsnr h1.bt {
    font: normal 24px/30px 微软雅黑;
    line-height: 30px;
    text-align: center;
    padding: 20px 0 0px 0;
    font-weight: normal;
}
.Yocms_detail_1 .newsnr .date {
    display: block;
    width: 700px;
    margin: 0 auto;
    padding: 10px 0 20px 0;
    text-align: center;
    color: #4D4B4B;
    background: url(__PUBLIC__/Widget/DetailArticle/Yocms_detail_1/point.gif) left bottom repeat-x;
    margin-bottom: 10px;
}
.Yocms_detail_1 .newsnr .date span {
    padding: 0 20px;
}
.Yocms_detail_1 .newsnr .nr {
    padding: 10px;
    font-size: 14px;
    line-height: 1.8;
}
.Yocms_detail_1 .newsnr .nr p {
    margin-bottom: 10px;
}
.Yocms_detail_1 .newsnr .share {
    border-top: 1px dotted #CCCCCC;
    padding-top: 10px;
    padding-left: 350px;
}
.Yocms_detail_1 .newsnr .share div.fleft {
    height: 36px;
    line-height: 36px;
    margin-left: 60px;
    _margin-left: 30px;
}
.Yocms_detail_1 .newsnr .share a.print {
    display: block;
    float: left;
    width: 50px;
    background: url(__PUBLIC__/Widget/DetailArticle/Yocms_detail_1/print.png) no-repeat left center;
    padding-left: 20px;
}
.Yocms_detail_1 .newsnr .share a.close {
    display: block;
    float: left;
    width: 50px;
    background: url(__PUBLIC__/Widget/DetailArticle/Yocms_detail_1/close.png) no-repeat left center;
    padding-left: 20px;
}
.Yocms_detail_1 .newsnr .down {
    padding: 5px 10px;
    font-size: 13px;
}
.Yocms_detail_1 .newsnr .down .fright {
    padding-top: 20px;
    width: 180px;
}
.Yocms_detail_1 .newsnr .down .fleft p {
    height: 30px;
    line-height: 30px;
    color: #375e85;
}
.Yocms_detail_1 .newsnr .down .fleft p a {
    color: #375e85;
}
</style>