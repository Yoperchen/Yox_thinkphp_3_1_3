<?php if (!defined('THINK_PATH')) exit();?>   <div id="nav"><ul>
     <?php if(is_array($navigation)): $i = 0; $__LIST__ = $navigation;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i; if($nav['count']==''): ?>
   <li><a <?php echo ($nav['blank']==1?' target="_blank"':''); ?> href="<?php echo ($nav["url"]); ?>"><?php echo ($nav["name"]); ?></a></li><li class="vline"></li>
<?php endif; endforeach; endif; else: echo "" ;endif; ?> 
</ul></div>



<style type="text/css">
#nav{
	height: 44px;
	width: 850px;
	background: #FFF;
	margin:10px auto;
	}
.vline{
	background: #999;
	width: 1px;
	height: 20px;
	}
#nav ul{
	margin:0px;
	padding: 0px;
	list-style-type: none;
}
#nav li{
	float: left;
	font-family: Arial;
	font-weight: bold;
	font-size: 12px;
	text-align: center;
}
#nav li a{
	display: block;
	width: 105px;
	line-height: 28px;
	color:  #666;	
	text-decoration: none;
	border-top: 4px solid #0F35A5;
	}
#nav li a:hover{
	color:  #7C8DD9;
	border-top: 4px solid #7C8DD9;	
}
</style>