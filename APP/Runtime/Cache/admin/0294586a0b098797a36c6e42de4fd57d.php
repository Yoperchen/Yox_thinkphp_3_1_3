<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript" src="__PUBLIC__/js/jquery.min.js"></script>
	<script language="javascript">
		$(document).ready(function() {
			$("#Yocms_navigation_203 li a").wrapInner( '<span class="out"></span>' );
			$("#Yocms_navigation_203 li a").each(function() {
				$( '<span class="over">' +  $(this).text() + '</span>' ).appendTo( this );
			});
			$("#Yocms_navigation_203 li a").hover(function() {
				$(".out",	this).stop().animate({'top':	'40px'},	300); // move down - hide
				$(".over",	this).stop().animate({'top':	'0px'},		300); // move down - show
			}, function() {
				$(".out",	this).stop().animate({'top':	'0px'},		300); // move up - show
				$(".over",	this).stop().animate({'top':	'-40px'},	300); // move up - hide
			});
		});
	</script>
<div id="Yocms_navigation_203" class="Yocms_navigation_203">
	<ul>
	<?php if(is_array($list)): foreach($list as $key=>$navigation): ?><li><a title="<?php echo (($navigation['description'])?($navigation['description']):$navigation['name']); ?>" href="<?php echo ($navigation['url']); ?>"><?php echo ($navigation['name']); ?></a></li><?php endforeach; endif; ?>
	<!--<li><a href="#">企业文化</a></li>
	<li><a href="#">产品展示</a></li>
	<li><a href="#">新闻中心</a></li>
	<li><a href="#">阳光服务</a></li>
	<li><a href="#">加盟代理</a></li>
	<li><a href="#">在线咨询</a></li>-->
	</ul>
	<div class="cls"></div>
</div>
<style type="text/css">
.Yocms_navigation_203 .cls {clear: both;}
.Yocms_navigation_203 a:focus { outline: none; }
.Yocms_navigation_203 .xgsm {
	padding: 0px;
	width: 800px;
	margin-top: 40px;
	margin-right: auto;
	margin-bottom: 20px;
	margin-left: auto;
}
.Yocms_navigation_203 .xgsm p {
	line-height: 1.8em;
	padding: 0px;
	margin: 0px;
	color: #666666;
}
.Yocms_navigation_203 {
	height: 40px;
	display: block;
	padding: 0px;
	width: 100%;
	margin-top: 0px;
	margin-right: auto;
	margin-bottom: 40px;
	margin-left: auto;
}
.Yocms_navigation_203 ul {list-style: none;padding: 0;margin: 0;}
.Yocms_navigation_203 ul li {
	/* width and height of the menu items */  
	float: left;
	overflow: hidden;
	position: relative;
	line-height: 40px;
	text-align: center;
}
.Yocms_navigation_203 ul li a {
	/* must be postioned relative  */ 
	position: relative;
	display: block;
	width: 90px;
	height: 40px;
	font-family: "微软雅黑", "宋体";
	font-size: 12px;
	text-decoration: none;
	cursor: pointer;
}
.Yocms_navigation_203 ul li a span {
	/* all layers will be absolute positioned */
	position: absolute;
	left: 0;
	width: 90px;
}
.Yocms_navigation_203 ul li a span.out {top: 0px;}
.Yocms_navigation_203 ul li a span.over,
.Yocms_navigation_203 ul li a span.bg {/* hide */  top: -40px;}
#Yocms_navigation_203 {background: #000;		}
#Yocms_navigation_203 ul li a {color: #999999;}
#Yocms_navigation_203 ul li a span.over {color: #000;background-color: #f0f0f0;}
</style>