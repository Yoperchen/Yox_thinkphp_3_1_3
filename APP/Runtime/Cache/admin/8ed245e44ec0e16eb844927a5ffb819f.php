<?php if (!defined('THINK_PATH')) exit();?><script src="__PUBLIC__/js/jquery.min.js" type="text/javascript"></script>
<div class="Yocms_navigation_204" id="Yocms_navigation_204">
	<div class="box" style="display:block;">
	<?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$navigation): $mod = ($k % 2 );++$k; if($k <= 8): ?><a title="<?php echo ($navigation['name']); ?>" class="t<?php echo ($k); ?>" href="<?php echo ($navigation['url']); ?>"><?php echo (msubstr($navigation['name'],0,3,'utf-8',false)); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
		<!--<a class="t1" href="http://www.16sucai.com/"></a>
		<a class="t2" href="http://www.16sucai.com/"></a>
		<a class="t3" href="http://www.16sucai.com/"></a>
		<a class="t4" href="http://www.16sucai.com/"></a>
		<a class="t5" href="http://www.16sucai.com/"></a>
		<a class="t6" href="http://www.16sucai.com/"></a>-->
	</div>
</div>
<style type="text/css">
.Yocms_navigation_204{width:80px;height:80px;position:fixed;top:5px;left:15px;background:url(__PUBLIC__/Widget/Navigation/Yocms_navigation_204/menu.png) no-repeat;cursor:move;}
.Yocms_navigation_204 .box{width:300px;height:253px;background:url(__PUBLIC__/Widget/Navigation/Yocms_navigation_204/m-bg.png) repeat;position:absolute;top:-88px;left:-85px;display:none;}
.Yocms_navigation_204 .box a{background:url(__PUBLIC__/Widget/Navigation/Yocms_navigation_204/m1.png) no-repeat;position:absolute;    font-size: 12px;
    vertical-align: middle;
    line-height: 59px;
    overflow: hidden;
    color: #fff;
    text-decoration: none;
	text-align: center;}
.Yocms_navigation_204 .box a:hover{background:url(__PUBLIC__/Widget/Navigation/Yocms_navigation_204/m2.png) no-repeat;}
.Yocms_navigation_204 .box .t1{background-position:0px 0px;width:49px;height:59px;left:75px;top:8px;}
.Yocms_navigation_204 .box .t2{background-position:0px -80px;width:49px;height:52px;left:165px;top:24px;}
.Yocms_navigation_204 .box .t3{background-position:0px -160px;width:58px;height:50px;left:200px;top:84px;}
.Yocms_navigation_204 .box .t4{background-position:0px -240px;width:54px;height:49px;left:188px;top:154px;}
.Yocms_navigation_204 .box .t5{background-position:0px -320px;width:50px;height:57px;left:115px;top:189px;}
.Yocms_navigation_204 .box .t6{background-position:0px -400px;width:50px;height:54px;left:30px;top:185px;}
.Yocms_navigation_204 .box .t7{background-position:0px -477px;width:58px;height:54px;left:0px;top:133px;}
.Yocms_navigation_204 .box .t8{background-position:0px -542px;width:58px;height:54px;left:5px;top:57px;}
.Yocms_navigation_204 .box .t1:hover{background-position:0px 0px;}
.Yocms_navigation_204 .box .t2:hover{background-position:0px -80px;}
.Yocms_navigation_204 .box .t3:hover{background-position:0px -160px;}
.Yocms_navigation_204 .box .t4:hover{background-position:0px -240px;}
.Yocms_navigation_204 .box .t5:hover{background-position:0px -320px;}
.Yocms_navigation_204 .box .t6:hover{background-position:0px -400px;}
.Yocms_navigation_204 .box .t7:hover{background-position:0px -477px;}
.Yocms_navigation_204 .box .t8:hover{background-position:0px -542px;}
</style>
<script>
//浮动导航条展开与收缩
$(function () {
    var box = $('.Yocms_navigation_204 .box');
    $('.Yocms_navigation_204').hover(function () {
        box.stop().show(300);
    }, function () {
        box.stop().hide(150);
    })
})

//浮动导航条拖动
$(function () {
    var box = document.getElementById('Yocms_navigation_204');
    box.onmousedown = function (event) {
        var e = event || window.event,
  t = e.target || e.srcElement,
        //鼠标按下时的坐标x1,y1
  x1 = e.clientX,
  y1 = e.clientY,
        //鼠标按下时的左右偏移量
  dragLeft = this.offsetLeft,
  dragTop = this.offsetTop;
        document.onmousemove = function (event) {
            var e = event || window.event,
  t = e.target || e.srcElement,
            //鼠标移动时的动态坐标
  x2 = e.clientX,
  y2 = e.clientY,
            //鼠标移动时的坐标的变化量
  x = x2 - x1,
  y = y2 - y1;
            box.style.left = (dragLeft + x) + 'px';
            box.style.top = (dragTop + y) + 'px';
        }
        document.onmouseup = function () {
            this.onmousemove = null;
        }
    }
})
</script>