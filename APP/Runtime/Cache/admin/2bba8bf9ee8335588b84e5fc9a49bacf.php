<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript" src="__PUBLIC__/plugins/mzp-packed/mzp-packed.js"></script>
<div class="Yocms_image_list_92">
	<div class="left-pro">
		<div class="t1">
			<img src="__PUBLIC__/Widget/DetailGoods/Yocms_image_list_92/gotop.gif" id="gotop" />
			<div id="showArea">
				<a href="<?php echo (($data['img1'])?($data['img1']):'__PUBLIC__/Widget/DetailGoods/Yocms_image_list_92/img01.jpg'); ?>" rel="zoom1" rev="__PUBLIC__/Widget/DetailGoods/Yocms_image_list_92/img01.jpg">
				<img src="<?php echo (($data['img1'])?($data['img1']):'__PUBLIC__/Widget/DetailGoods/Yocms_image_list_92/img01s.jpg'); ?>" /></a>
				<a href="<?php echo (($data['img1'])?($data['img1']):'__PUBLIC__/Widget/DetailGoods/Yocms_image_list_92/img02.jpg'); ?>" rel="zoom1" rev="__PUBLIC__/Widget/DetailGoods/Yocms_image_list_92/img02.jpg">
				<img src="<?php echo (($data['img1'])?($data['img1']):'__PUBLIC__/Widget/DetailGoods/Yocms_image_list_92/img02s.jpg'); ?>" /></a>
				<a href="<?php echo (($data['img1'])?($data['img1']):'__PUBLIC__/Widget/DetailGoods/Yocms_image_list_92/img03.jpg'); ?>" rel="zoom1" rev="__PUBLIC__/Widget/DetailGoods/Yocms_image_list_92/img03.jpg">
				<img src="<?php echo (($data['img1'])?($data['img1']):'__PUBLIC__/Widget/DetailGoods/Yocms_image_list_92/img03s.jpg'); ?>" /></a>
				<a href="<?php echo (($data['img1'])?($data['img1']):'__PUBLIC__/Widget/DetailGoods/Yocms_image_list_92/img01.jpg'); ?>" rel="zoom1" rev="__PUBLIC__/Widget/DetailGoods/Yocms_image_list_92/img01.jpg">
				<img src="<?php echo (($data['img1'])?($data['img1']):'__PUBLIC__/Widget/DetailGoods/Yocms_image_list_92/img01s.jpg'); ?>" /></a>
				<a href="<?php echo (($data['img1'])?($data['img1']):'__PUBLIC__/Widget/DetailGoods/Yocms_image_list_92/img02.jpg'); ?>" rel="zoom1" rev="__PUBLIC__/Widget/DetailGoods/Yocms_image_list_92/img02.jpg">
				<img src="<?php echo (($data['img1'])?($data['img1']):'__PUBLIC__/Widget/DetailGoods/Yocms_image_list_92/img02s.jpg'); ?>" /></a>
				<a href="<?php echo (($data['img1'])?($data['img1']):'__PUBLIC__/Widget/DetailGoods/Yocms_image_list_92/img03.jpg'); ?>" rel="zoom1" rev="__PUBLIC__/Widget/DetailGoods/Yocms_image_list_92/img03.jpg">
				<img src="<?php echo (($data['img1'])?($data['img1']):'__PUBLIC__/Widget/DetailGoods/Yocms_image_list_92/img03s.jpg'); ?>" /></a>
				<a href="<?php echo (($data['img1'])?($data['img1']):'__PUBLIC__/Widget/DetailGoods/Yocms_image_list_92/img01.jpg'); ?>" rel="zoom1" rev="__PUBLIC__/Widget/DetailGoods/Yocms_image_list_92/img01.jpg">
				<img src="<?php echo (($data['img1'])?($data['img1']):'__PUBLIC__/Widget/DetailGoods/Yocms_image_list_92/img01s.jpg'); ?>" /></a>
				<a href="<?php echo (($data['img1'])?($data['img1']):'__PUBLIC__/Widget/DetailGoods/Yocms_image_list_92/img02.jpg'); ?>" rel="zoom1" rev="__PUBLIC__/Widget/DetailGoods/Yocms_image_list_92/img02.jpg">
				<img src="<?php echo (($data['img1'])?($data['img1']):'__PUBLIC__/Widget/DetailGoods/Yocms_image_list_92/img02s.jpg'); ?>" /></a>
			</div>
			<img src="__PUBLIC__/Widget/DetailGoods/Yocms_image_list_92/gobottom.gif" id="gobottom"/>
		</div>
		<div class="t2">
		<a href="<?php echo (($data['img1'])?($data['img1']):'__PUBLIC__/Widget/DetailGoods/Yocms_image_list_92/img01.jpg'); ?>" id="zoom1" class="MagicZoom MagicThumb">
		<img src="<?php echo (($data['img1'])?($data['img1']):'__PUBLIC__/Widget/DetailGoods/Yocms_image_list_92/img01.jpg'); ?>" id="main_img" class="main_img" style="width:400px; height:400px;" /></a>
		</div>
	</div>
		<div class="right-pro">
			<div>
				<span class="gray clear"><?php echo (($data['name'])?($data['name']):'木有萌萌的标题'); ?></span>
				<span class="red clear"><?php echo (($data['desc'])?($data['desc']):'木有萌萌的描述'); ?></span>
			</div>
			<div>
				<span class="price"><i>价 格</i>￥<?php echo (($data['price'])?($data['price']):'木有萌萌的价格'); ?></span>
				<span class="buy"><a target="_blank" href="<?php echo U('Order/index@Home',array('goods_id'=>$data['goods_id'],'buy_quantity'=>1));?>">快速购买</a></span>
			</div>
		</div>
		
	<!-- TAB代码 开始 -->
	<div id="tab">
	  <div class="tabList">
		<ul>
			<li class="cur">商品详情</li>
			<li>商品评价</li>
			<li>会员收藏</li>
			<li>售后保障</li>
		</ul>
	  </div>
	  <div class="tabCon">
		<div class="cur"><?php echo (($data['content'])?($data['content']):'木有萌萌的内容'); ?></div>
		<div><?php echo W('ListComment',array('template'=>'Yocms_list_91','condition'=>array('goods_id'=>$data['goods_id'])));?></div>
		<div>被风吹过的夏天、江南、一千年以后</div>
		<div>服务承诺：<br/>
零零糖平台卖家销售并发货的商品，由平台卖家提供发票和相应的售后服务。请您放心购买！
注：因厂家会在没有任何提前通知的情况下更改产品包装、产地或者一些附件，本司不能确保客户收到的货物与商城图片、产地、附件说明完全一致。只能确保为原厂正货！并且保证与当时市场上同样主流新品一致。若本商城没有及时更新，请大家谅解！ </div>
	  </div>
	</div>
	<!-- TAB代码 结束 -->

</div>
<div class="clear"></div>
<style type="text/css">
.Yocms_image_list_92{width:965px;margin:20px auto;font-family:arial,"microsoft yahei";text-decoration:none;}
.Yocms_image_list_92 .left-pro{margin-bottom:5px;width:520px; padding:20px 10px;border:1px solid #ccc;text-align:left;float:left}
.Yocms_image_list_92 .left-pro .t1{width:100px;float:left}
.Yocms_image_list_92 .left-pro .t2{width:352px;text-indent:0;float:left;padding-left:10px}
.Yocms_image_list_92 .left-pro .t2 img{text-indent:0;}
.Yocms_image_list_92 .right-pro{float:right;width:415px}
.Yocms_image_list_92 .right-pro .red{color:#e4393c;display:block;font-size:14px;margin-bottom: 3px;}
.Yocms_image_list_92 .right-pro .gray{color:#666;display:block;margin: 3px;}
.Yocms_image_list_92 .right-pro .price{color:#e4393c;font-size:20px;margin: 10px;}
.Yocms_image_list_92 .right-pro .price i{color:#666;font-size:12px;}
.Yocms_image_list_92 .right-pro .buy,.right-pro a{color:#fff;width:75;height:35px;line-height:35px;display:block;background-color:#e4393c;vertical-align: middle;text-align: center;text-decoration:none;margin: 11px;-moz-border-radius: 12px;      /* Gecko browsers */-webkit-border-radius: 12px;   /* Webkit browsers */border-radius:12px;            /* W3C syntax */}
.Yocms_image_list_92 .clear{clear:both;}

.Yocms_image_list_92 #showArea img{cursor:pointer;display:block;margin-bottom:5px;width:68px;padding:1px;border:1px solid #ccc;height:68px;float:left}
.Yocms_image_list_92 #main_img{cursor:pointer;display:block}
.Yocms_image_list_92 #gotop{cursor:pointer;display:block;margin-left:9px}
.Yocms_image_list_92 #gobottom{cursor:pointer;display:block;margin-left:9px}
.Yocms_image_list_92 #showArea{height:379px;margin:10px;overflow:hidden}

/* CSS class for zoomed area */
.MagicZoomBigImageCont{border:1px solid #91b817;overflow:hidden}
.MagicZoomBigImageCont img{width:800px;height:800px}
.MagicZoomBigImageCont iframe{width:300px;height:300px}
.MagicZoomHeader{font:10px Tahoma, Verdana, Arial, sans-serif;color:#fff;background:#91b817;text-align:center !important}
.MagicZoomPup{border:1px solid #aaa;background:#fff;cursor:hand;left:0}
.MagicZoomLoading{text-align:center;background:#fff;color:#444;opacity:0.8;padding:3px 3px 3px 3px !important;display:none}
.MagicZoomLoading img{padding-top:3px !important}
.MagicThumb{cursor:url(cursor/zoomin.cur), pointer;outline:none}
.MagicThumb-zoomed{cursor:default}
.MagicThumb span{display:none}
.MagicThumb-image{border:1px solid #ccc;outline:none}
.MagicThumb-image-zoomed{cursor:url(cursor/zoomout.cur), pointer}
.MagicThumb-caption{color:#333333;background-color:#F0F0F0;border:1px solid #CCC;border-top:none;font-family:Verdana, Helvetica;font-size:11px;padding:8px 16px}
.MagicThumb-controlbar{display:block;height:18px}
.MagicThumb-controlbar a{display:block;width:180px;height:180px;margin:0px 1px;outline:none;float:left;overflow:hidden}
.MagicThumb-controlbar a span{display:block;width:1000px;height:1000px;background:transparent url(Yocms_image_list_92/controlbar.png) no-repeat 0 0;outline:none;position:absolute;left:0px;top:0px}
.MagicThumb-loading{border:1px solid #000;background:#fff url(__PUBLIC__/Widget/DetailGoods/Yocms_image_list_92/loader.gif) no-repeat 2px 50%;padding:2px 2px 2px 22px;margin:0;text-decoration:none;text-align:left;font-size:8pt;font-family:sans-serif;}


/* tab 开始 */
.Yocms_image_list_92 ul,li{list-style:none;}
.Yocms_image_list_92 #tab{position:relative;width: 100%;clear: both;min-height: 135px;}
.Yocms_image_list_92 .tabList{height:35px;}
#tab .tabList ul li{
	float:left;
	background:#fefefe;
	background:-moz-linear-gradient(top, #fefefe, #ededed);	
	background:-o-linear-gradient(left top,left bottom, from(#fefefe), to(#ededed));
	background:-webkit-gradient(linear,left top,left bottom, from(#fefefe), to(#ededed));
	border:1px solid #ccc;
	padding:5px 0;
	width:100px;
	text-align:center;
	margin-left:-1px;
	position:relative;
	cursor:pointer;
}
#tab .tabCon{
	left:-1px;
	border:1px solid #ccc;
	border-top:none;
	width:100%;
}
#tab .tabCon >div{
	padding:10px;
	display:none;
	width:100%;
}
#tab .tabList li.cur{
	border-bottom:none;
	background:#fff;
}
#tab .tabCon div.cur{
	display:block;
}
/* tab 结束 */
</style>
<script type="text/javascript">
//放大镜 js代码
function jQuery(e) {return document.getElementById(e);}
document.getElementsByClassName = function(cl) {
    var retnode = [];
    var myclass = new RegExp('\\b'+cl+'\\b');
    var elem = this.getElementsByTagName('*');
    for (var i = 0; i < elem.length; i++) {
        var classes = elem[i].className;
        if (myclass.test(classes)) retnode.push(elem[i]);
    }
    return retnode;
}
var MyMar;
var speed = 1; //速度，越大越慢
var spec = 1; //每次滚动的间距, 越大滚动越快
var ipath = '.__PUBLIC__/Widget/DetailGoods/Yocms_image_list_92/'; //图片路径
var thumbs = document.getElementsByClassName('thumb_img');
for (var i=0; i<thumbs.length; i++) {
    thumbs[i].onmouseover = function () {jQuery('main_img').src=this.rel; jQuery('main_img').link=this.link;};
    thumbs[i].onclick = function () {location = this.link}
}
jQuery('main_img').onclick = function () {location = this.link;}
jQuery('gotop').onmouseover = function() {this.src = ipath + 'gotop2.gif'; MyMar=setInterval(gotop,speed);}
jQuery('gotop').onmouseout = function() {this.src = ipath + 'gotop.gif'; clearInterval(MyMar);}
jQuery('gobottom').onmouseover = function() {this.src = ipath + 'gobottom2.gif'; MyMar=setInterval(gobottom,speed);}
jQuery('gobottom').onmouseout = function() {this.src = ipath + 'gobottom.gif'; clearInterval(MyMar);}
function gotop() {jQuery('showArea').scrollTop-=spec;}
function gobottom() {jQuery('showArea').scrollTop+=spec;}
</script>
<script type="text/javascript">
//TAB js代码
$(function(){
          $("#tab .tabList ul li").each(function(index){
            $(this).click(function(){
              $(".tabList .cur").removeClass("cur");
              $(".tabCon >div").removeClass("cur");
              //$(".tabCon >div").css("display","none")
              $(this).addClass("cur");
              $(".tabCon > div:eq("+index+")").addClass("cur");
              //$(".tabCon > div:eq("+index+")").css("display","block");
            })
          })                
        })
</script>