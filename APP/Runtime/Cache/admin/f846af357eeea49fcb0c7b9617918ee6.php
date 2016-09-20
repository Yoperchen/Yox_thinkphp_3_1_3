<?php if (!defined('THINK_PATH')) exit();?><link href="__PUBLIC__/Widget/ListGoods/Yocms_image_list_90/ListGoods_<?php echo (($css)?($css):'w1200'); ?>.css" rel="stylesheet"/>
<div class="Yocms_image_list_90">
  <ul>
  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goods): $mod = ($i % 2 );++$i;?><li class="listbox mr20">
      <div class="listimg"> <a href="<?php echo U('Goods/goods_detail',array('goods_id'=>$goods['id']));?>" title="<?php echo ($goods['title']); ?>" target="_blank">
      <img src="<?php echo (($goods['view'])?($goods['view']):'__PUBLIC__/Widget/ListGoods/Yocms_image_list_90/default_image.jpg'); ?>" class="attachment-thumbnail wp-post-image" alt="WordPress中文博客主题Truepixel" /></a>
        <div class="summary">
          <div class="summarytxt">
            <p><?php echo (($goods['desc'])?($goods['desc']):'木有描述'); ?></p>
          </div>
        </div>
      </div>
      <div class="listinfo">
        <div class="listtitle"><a href="<?php echo U('Goods/goods_detail',array('goods_id'=>$goods['id']));?>" title="<?php echo ($goods['title']); ?>" target="_blank"><?php echo (($goods['title'])?($goods['title']):'木有标题'); ?></a></div>
        <div class="listtag"><a href="<?php echo ($goods['store_id']); ?>" rel="tag">商家</a><a href="<?php echo ($goods['category_id']); ?>" rel="tag">商品分类</a></div>
        <!-- <div class="listdate"><?php echo (date("Y-m-d",$goods['add_time'])); ?></div> -->
        <div class="listview"><?php echo (($goods['view'])?($goods['view']):'167'); ?></div>
        <div class="listcomment">16</div>
        <div class="listdemo"><a href="<?php echo U('Goods/goods_detail',array('goods_id'=>$goods['id']));?>" rel="external nofollow" target="_blank">详细</a></div>
      </div>
    </li><?php endforeach; endif; else: echo "" ;endif; ?>
  </ul>
  <div class="Yocms_page">
<!-- 分页 -->
<?php if($page_template == '' OR $page_template == 0): ?><!-- 不显示分页0 -->
<?php elseif($page_template == 1): ?>
<!-- 分页模版1 -->
<?php echo ($page['page_str']); ?>
<style type="text/css">
.Yocms_page{clear: both;text-align: center;width: 100%;height: 30px;line-height: 30px;display: block;}
.Yocms_page a{}
.Yocms_page span{}
.Yocms_page .current{}
</style>
<?php elseif($page_template == 2): ?>
<style type="text/css">
.Yocms_next_page{background-color: #e1e1e1;
    width: 100%;
    display: block;
    height: 35px;
    vertical-align: middle;
    line-height: 35px;
    color: #514F4F;
    text-decoration: none;
	}
</style>
<a class="Yocms_next_page" href="#">下一页</a>
<!-- 分页模版2 -->
<?php else: ?>
<!-- 默认分页模版 -->
<?php echo ($page['page_str']); endif; ?>
</div> 
  <div class="footer">列表内容板块</div>
</div>
<script src="__PUBLIC__/Widget/ListGoods/Yocms_image_list_90/ListGoods.js" type="text/javascript"></script>