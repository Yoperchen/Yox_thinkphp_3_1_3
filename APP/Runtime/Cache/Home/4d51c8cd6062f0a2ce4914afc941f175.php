<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml">   
<head>   
	<title>首页 - 花儿开到千年无尽的芬芳</title>      
	<script type="text/javascript" src="__PUBLIC__/js/jquery.min.js"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<link rel="stylesheet"  type="text/css" href="../Public/style.css"/>
	<style type="text/css">
	div{ padding: 3px 20px;} 
	body{ background: #fff; color: #333;}
	h2{font-size:36px}
	div.result{border:1px solid #d4d4d4; background:#FFC;color:#393939; padding:8px 10px;float:auto; width:450px;margin:2px}
	a{text-decoration:none; color:gray;}
	a:hover{color:#F60;}
	div.page{border:1px solid #d4d4d4; background:#333;color:white; padding:5px 15px;float:auto; width:450px;margin:2px;text-align:right}
	</style>
</head> 
<body>
<!-- 通用头部 开始-->
<?php echo W('Header',array('template'=>'Yocms_header_1'));?>
<!-- 通用头部 结束-->
<!-- 商品分类 开始-->
<?php echo W('ListShowGoodsCategory');?>
<!-- 商品分类 结束-->

<!-- 商品分类1列表 开始-->
<?php echo W('ListShowGoods',array('goods_category'=>1));?>
<!-- 商品分类1列表 结束-->
<!-- 商品分类2列表 开始-->
<?php echo W('ListShowGoods',array('goods_category'=>2));?>
<!-- 商品分类2列表 结束-->

	<h2>ThinkPHP示例：ajax分页操作</h2>
	<div class="result">
		可以更改IndexAction文件中param数组的<b>target</b>和<b>pagesId</b>参数查看和普通分页的区别。
	</div>
	<div id="content">
	<table cellpadding=3 cellspacing=5>
	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><form action="" method="post">
	<tr>
		<td style="border-bottom:1px solid silver;">
			<span style="color:gray">
			<?php echo ($vo["goods_id"]); ?>-<?php echo ($vo["goods_name"]); ?>-[ <?php echo (date('Y-m-d H:i:s',$vo["last_update"])); ?> ]-价格：<?php echo ($vo["shop_price"]); ?>
			<input type="submit" name="提交">
			</span>  
		</td>
	</tr>
	</form><?php endforeach; endif; else: echo "" ;endif; ?>
	<tr></tr>
</table>
<div class="result page" id="page"><?php echo ($page); ?></div>
	</div> <br/><br/><br/>
	
这是home主题1<br/>
<a href="index.php?t=default_theme">切换到home主题1</a><br/>
<a href="index.php?t=default_theme2">切换到home主题2</a>
<br/><br/>
<a href="index.php?t=default_theme2&g=wap">切换到wap主题2</a><br/>
<a href="index.php?t=default_theme&g=wap">切换到wap主题1</a>
<br/><br/>
<a href="index.php?t=default_theme2&g=user">切换到user主题2</a><br/>
<a href="index.php?t=default_theme&g=user">切换到user主题1</a>
<br/><br/>
<a href="index.php?t=default_theme2&g=admin">切换到admin主题2</a><br/>
<a href="index.php?t=default_theme&g=admin">切换到admin主题1</a>
<br/>
<?php echo W('Footer');?>
</body>
</html>