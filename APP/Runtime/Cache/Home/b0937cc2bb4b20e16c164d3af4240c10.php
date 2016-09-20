<?php if (!defined('THINK_PATH')) exit();?>商品列表:<br/>
<?php if(is_array($goods_list)): $i = 0; $__LIST__ = $goods_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><li>商品id:<?php echo ($list['goods_id']); ?></li>
    <li>商品所属分类：<?php echo ($list['category']); ?></li>
   <li>分类排序：<?php echo ($list['sort']); ?></li>
   <li>商品所属商家：<?php echo ($list['store_id']); ?></li>
     <li>商品名称：<a href="<?php echo U('Home/Goods/good_detail?goods_id='.$list['goods_id']);?>"><?php echo ($list['goods_name']); ?></a></li>
    <li>商品价格：<?php echo ($list['price']); ?></li>
    <li>商品描述：<?php echo ($list['desc']); ?></li>
      <li>商品图片：<?php echo ($list['img']); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>