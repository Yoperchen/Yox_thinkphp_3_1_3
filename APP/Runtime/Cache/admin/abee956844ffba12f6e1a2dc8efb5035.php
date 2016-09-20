<?php if (!defined('THINK_PATH')) exit(); if(is_array($navigation)): $i = 0; $__LIST__ = $navigation;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i; if($nav['count']==''): ?>
                   		<!-- 顶级导航 -->
                 		 <a target="_blank" href="<?php echo ($nav["url"]); ?>"> <?php echo ($nav["name"]); ?></a>
                   <?php endif; ?>
                   
                   <?php if($nav['count']=='---'): ?>
                   <!-- 二级导航 -->
                  		 -<a target="_blank" href="<?php echo ($nav["url"]); ?>"><?php echo ($nav["name"]); ?></a>
                   <?php endif; ?>
                   
                   <?php if($nav['count']=='------'): ?>
                    <!-- 三级导航 -->
                  --<a target="_blank" href="<?php echo ($nav["url"]); ?>"><?php echo ($nav["name"]); ?></a>
		<?php endif; ?>
		<br/><?php endforeach; endif; else: echo "" ;endif; ?>