<?php if (!defined('THINK_PATH')) exit();?><div class="Yocms_image_list_91">
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$article): $mod = ($i % 2 );++$i;?><div class="case-item">
		<div class="ih-item circle effect1">
			<a href="<?php echo U('Article/article_detail@'.$application,array('article_id'=>$article['id']));?>" target="_blank">
				<div class="spinner"></div>
				<div class="img"><img src="<?php echo (($article['img1'])?($article['img1']):'__PUBLIC__/Widget/ListArticle/Yocms_image_list_91/default_image.png'); ?>" alt="<?php echo ($article['title']); ?>"></div>
				<div class="info">
					<div class="info-back">
						<h3><?php echo ($article['title']); ?></h3>
						<p><?php echo ($article['desc']); ?></p>
					</div>
				</div>
			</a>
		</div>
	</div><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
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
<style type="text/css">
.Yocms_image_list_91 *{ margin:0;padding:0;list-style-type:none;}
.Yocms_image_list_91{overflow:hidden;/*width:1200px*/}
.Yocms_image_list_91 .case-item{float:left;margin:6px 30px;margin-bottom:20px}
.Yocms_image_list_91 .ih-item{position:relative;-webkit-transition:all .35s ease-in-out;-moz-transition:all .35s ease-in-out;transition:all .35s ease-in-out}
.Yocms_image_list_91 .ih-item,.ih-item *{ -webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}
.Yocms_image_list_91 .ih-item a{color:#333}
.Yocms_image_list_91 .ih-item a:hover{text-decoration:none}
.Yocms_image_list_91 .ih-item img{width:100%;height:100%}
.Yocms_image_list_91 .ih-item.circle,.ih-item.circle .img{position:relative;width:210px;height:210px;border-radius:50%}
.Yocms_image_list_91 .ih-item.circle .img:before{position:absolute;display:block;content:'';width:100%;height:100%;border-radius:50%;box-shadow:inset 0 0 0 16px rgba(255,255,255,.6),0 1px 2px rgba(0,0,0,.3);-webkit-transition:all .35s ease-in-out;-moz-transition:all .35s ease-in-out;transition:all .35s ease-in-out}
.Yocms_image_list_91 .ih-item.circle .img img{border-radius:50%}
.Yocms_image_list_91 .ih-item.circle .info{position:absolute;top:0;bottom:0;left:0;right:0;text-align:center;border-radius:50%;-webkit-backface-visibility:hidden;backface-visibility:hidden}
.Yocms_image_list_91 .ih-item.square{position:relative;width:316px;height:216px;border:8px solid #fff;box-shadow:1px 1px 3px rgba(0,0,0,.3)}
.Yocms_image_list_91 .ih-item.square .info{position:absolute;top:0;bottom:0;left:0;right:0;text-align:center;-webkit-backface-visibility:hidden;backface-visibility:hidden}
.Yocms_image_list_91 .ih-item.circle.effect1 .spinner{width:220px;height:220px;border:10px solid #ecab18;border-right-color:#1ad280;border-bottom-color:#1ad280;border-radius:50%;-webkit-transition:all .8s ease-in-out;-moz-transition:all .8s ease-in-out;transition:all .8s ease-in-out}
.Yocms_image_list_91 .ih-item.circle.effect1 .img{position:absolute;top:10px;bottom:0;left:10px;right:0;width:auto;height:auto}
.Yocms_image_list_91 .ih-item.circle.effect1 .img:before{display:none}
.Yocms_image_list_91 .ih-item.circle.effect1.colored .info{background:#1a4a72;background:rgba(26,74,114,.6)}
.Yocms_image_list_91 .ih-item.circle.effect1 .info{top:10px;bottom:0;left:10px;right:0;background:#333;background:rgba(0,0,0,.6);opacity:0;-webkit-transition:all .8s ease-in-out;-moz-transition:all .8s ease-in-out;transition:all .8s ease-in-out}
.Yocms_image_list_91 .ih-item.circle.effect1 .info h3{color:#fff;text-transform:uppercase;position:relative;letter-spacing:2px;font-size:24px;margin:0 30px;padding:55px 0 0;height:110px;text-shadow:0 0 1px white,0 1px 2px rgba(0,0,0,.3)}
.Yocms_image_list_91 .ih-item.circle.effect1 .info p{color:#bbb;padding:10px 5px;font-style:italic;margin:0 30px;font-size:12px;border-top:1px solid rgba(255,255,255,.5)}
.Yocms_image_list_91 .ih-item.circle.effect1 a:hover .spinner{ -webkit-transform:rotate(180deg);-moz-transform:rotate(180deg);-ms-transform:rotate(180deg);-o-transform:rotate(180deg);transform:rotate(180deg)}
.Yocms_image_list_91 .ih-item.circle.effect1 a:hover .info{opacity:1}
</style>