<?php if (!defined('THINK_PATH')) exit();?><br/>商品分类:<br/>
                <?php if(is_array($good_category_list)): $i = 0; $__LIST__ = $good_category_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cat): $mod = ($i % 2 );++$i; if($cat['count']==''): ?>
                   		<!-- 顶级分类 -->
                 		 <a href="<?php echo ($cat["id"]); ?>"> <?php echo ($cat["name"]); ?></a>
                   <?php endif; ?>
                   
                   <?php if($cat['count']=='---'): ?>
                   <!-- 二级分类 -->
                  		 -<a href="<?php echo ($cat["id"]); ?>"><?php echo ($cat["name"]); ?></a>
                   <?php endif; ?>
                   
                   <?php if($cat['count']=='------'): ?>
                    <!-- 三级分类 -->
                 		  --<a href="<?php echo ($cat["id"]); ?>"><?php echo ($cat["name"]); ?></a>
                   <?php endif; ?>
                   <br/><?php endforeach; endif; else: echo "" ;endif; ?>