<?php if (!defined('THINK_PATH')) exit();?><div class="Yocms_image_list_90">
  <ul>
  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$article): $mod = ($i % 2 );++$i;?><li class="listbox mr20">
      <div class="listimg"> <a href="<?php echo U('Article/article_detail@'.$application,array('article_id'=>$article['id']));?>" title="<?php echo ($article['title']); ?>" target="_blank">
      <img src="<?php echo (($article['view'])?($article['view']):'__PUBLIC__/Widget/ListArticle/Yocms_image_list_90/default_image.jpg'); ?>" class="attachment-thumbnail wp-post-image" alt="WordPress中文博客主题Truepixel" /></a>
        <div class="summary">
          <div class="summarytxt">
            <p><?php echo (($article['desc'])?($article['desc']):'文字太好没有描述'); ?></p>
          </div>
        </div>
      </div>
      <div class="listinfo">
        <div class="listtitle"><a href="<?php echo U('Article/article_detail',array('article_id'=>$article['id']));?>" title="<?php echo ($article['title']); ?>" target="_blank"><?php echo ($article['title']); ?></a></div>
        <div class="listtag"><a href="<?php echo ($article['id']); ?>" rel="tag">博客</a><a href="<?php echo ($article['id']); ?>" rel="tag">杂志</a></div>
        <div class="listdate"><?php echo (date("Y-m-d",$article['add_time'])); ?></div>
        <div class="listview"><?php echo (($article['view'])?($article['view']):'167'); ?></div>
        <div class="listcomment">16</div>
        <div class="listdemo"><a href="<?php echo U('Article/article_detail',array('article_id'=>$article['id']));?>" rel="external nofollow" target="_blank">详细</a></div>
      </div>
    </li><?php endforeach; endif; else: echo "" ;endif; ?>
  </ul>
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
/*body{padding-top:50px; background:#e6e6e6; font-family:Tahoma,Helvetica,Arial,sans-serif; font-size:14px; color:#666; text-decoration:none;}*/
.Yocms_image_list_90 *{margin:0;padding:0;}
.Yocms_image_list_90{margin:0 auto; width:1200px; position:relative;}
.Yocms_image_list_90 a{font-family:Tahoma,Helvetica,Arial,sans-serif; font-size:14px; color:#666; text-decoration:none; outline:none;}
.Yocms_image_list_90 ul li{margin-left:20px;}
.Yocms_image_list_90 .clear{clear:both;}
.Yocms_image_list_90 .summary{background:#333;}
.Yocms_image_list_90 .listbox{float:left; margin-bottom:20px; padding:10px; _padding:10px 10px 8px 10px ;background:#f6f6f6; width:260px; height:240px; position:relative;list-style: none;}
.Yocms_image_list_90 .listimg{float:left; width:260px; height:165px; position:relative; overflow:hidden;}
.Yocms_image_list_90 .listimg img{background:#333; width:260px; height:165px; top:0; left:0; position:absolute;}
.Yocms_image_list_90 .summary{width:260px;height:165px;top:165px;left:0;position:absolute;}
.Yocms_image_list_90 .summarytxt{text-align: left;margin:5px 10px;width:250px;height:auto;line-height:22px;font-size:12px;color:#cfcfcf;}
.Yocms_image_list_90 .listinfo{_margin-bottom:3px; padding-left:10px; width:250px; line-height:22px; font-size:12px;}
.Yocms_image_list_90 .listinfo a{font-size:12px;}
.Yocms_image_list_90 .listtitle{float:left; margin-top:8px; _margin-top:-2px; width:250px; font-size:14px;text-align: left;}
.Yocms_image_list_90 .listtitle a{font-size:14px;height: 25px;overflow: hidden;display: block;}
.Yocms_image_list_90 .listtitle a:hover{color:#f55555;}
.Yocms_image_list_90 .listtag{text-align: left;float:left;padding-left:18px;background:url(__PUBLIC__/Widget/ListArticle/Yocms_image_list_90/taglist.gif) 0 5px no-repeat;width:232px;color:#999;}
.Yocms_image_list_90 .listtag a{margin:0 8px 0 0;margin:2px 8px -2px 09;_margin:0 8px 0 0;color:#999;}
.Yocms_image_list_90 .listtag a:hover{color:#2ad2bb;}
.Yocms_image_list_90 .listdate{float:left;margin-right:13px;padding-left:18px;background:url(__PUBLIC__/Widget/ListArticle/Yocms_image_list_90/time.gif) 0 5px no-repeat;color:#999;}
.Yocms_image_list_90 .listview{float:left;margin-right:13px;padding-left:24px;background:url(__PUBLIC__/Widget/ListArticle/Yocms_image_list_90/view.gif) 0 5px no-repeat;color:#999;}
.Yocms_image_list_90 .listcomment{float:left;margin-right:13px;padding-left:20px;background:url(__PUBLIC__/Widget/ListArticle/Yocms_image_list_90/comment.gif) 0 5px no-repeat;color:#999;}
.Yocms_image_list_90 .listdemo a{float:left;margin-top:0;margin-top:2px9;_margin-top:0;color:#999;white-space:nowrap;}
.Yocms_image_list_90 .listdemo a:hover{color:#2ad2bb;}
</style>
<!-- <script src="__PUBLIC__/Widget/ListArticle/Yocms_image_list_90/Yocms_image_list_90.js" type="text/javascript"></script> -->
<script>
require(['jquery'], function($){
	if(typeof(Yocms_image_article_list_90_is_load)=="undefined"){
		$("body").append('<script src="__PUBLIC__/Widget/ListArticle/Yocms_image_list_90/Yocms_image_list_90.js" type="text/javascript"><\/script>');
	}
});
</script>