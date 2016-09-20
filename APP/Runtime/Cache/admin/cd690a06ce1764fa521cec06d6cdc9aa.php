<?php if (!defined('THINK_PATH')) exit();?><div class="nav clearfix">
    	<ul class="block">
    	<?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$navigation): $mod = ($k % 2 );++$k;?><li><a href="<?php echo ($navigation['url']); ?>" <?php if($k > 1): ?>class="L"<?php endif; ?>><?php echo ($navigation['name']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
			<!--
            <li><a href="" class="L">关于我们</a></li>
            <li><a href="" class="L">服务范围</a></li>
            <li><a href="" class="L">新闻中心</a></li>
            <li><a href="" class="L">工程案例</a></li>
            <li><a href="" class="L">联系我们</a></li>
			-->
        </ul>
    </div>
<style type="text/css">
.nav {
    background: url(__PUBLIC__/Widget/Header/Yocms_header1/nav_bj.jpg) repeat-x;
    height: 40px;
    line-height: 40px;
	overflow: hidden;
}
.nav ul li {
    float: left;
}
li {
    list-style-type: none;
}
.nav ul li a.L {
    background: url(__PUBLIC__/Widget/Header/Yocms_header1/nav_li.jpg) no-repeat left center;
}
.nav ul li a {
    color: #FFF;
    display: block;
    float: left;
    font-size: 15px;
    width: 166px;
    text-align: center;
	text-decoration: none;
}
.nav ul li a:hover{
	background-color: #0275C8;
    border-radius: 25px;
}
</style>