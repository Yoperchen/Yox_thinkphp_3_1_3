<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" type="text/css" href="__PUBLIC__/Widget/ListComment/Yocms_image_list_94/ListComment.css">
<style type="text/css"></style>
<div id="Yocms_comment_image_list_94" class="Yocms_image_list_94">
	<div class="header">
		<span style="color:#357ebd;font-size:15px;width:200px;height:45px;float:left;font-family: cursive;">热点评论</span>
		<span class="close" id="Yocms_comment_image_list_94_close" title="关闭评论">x</span>
	</div>
	<form action="<?php echo (($action_url)?($action_url): U('Comment/add_comment@common')); ?>" method="post">
	 	<input type="hidden" name="article_id" value="<?php echo ($condition['article_id']); ?>">
	 	<input type="hidden" name="goods_id" value="<?php echo ($condition['goods_id']); ?>">
	 	<input type="hidden" name="share_id" value="<?php echo ($condition['share_id']); ?>">
	 	<input type="hidden" name="collect_id" value="<?php echo ($condition['collect_id']); ?>">
	 	<input type="hidden" name="file_id" value="<?php echo ($condition['file_id']); ?>">
	 	<input type="hidden" name="rental_id" value="<?php echo ($condition['rental_id']); ?>">
	 	<input type="hidden" name="cuisine_id" value="<?php echo ($condition['cuisine_id']); ?>">
	 	<input type="hidden" name="course_id" value="<?php echo ($condition['course_id']); ?>">
	 	<input type="hidden" name="order_id" value="<?php echo ($condition['order_id']); ?>">
	 	<input type="hidden" name="store_id" value="<?php echo ($condition['store_id']); ?>">
	 	<input type="hidden" name="user_id" value="<?php echo ($condition['user_id']); ?>">
		<textarea name="content" placeholder="君看一叶舟,出没风尘里"></textarea>
		<input type="submit" value="评论">
	</form>
	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$comment): $mod = ($i % 2 );++$i;?><div class="comment_list">
		<div class="comment">
			<div class="parent_comment">
				<!--用户头像-->
				<span class="comment_left"><a title="<?php echo ($comment['user']['nick_name']); ?>的小窝" href="#"><img height="50" src="<?php echo (($comment['user']['avatar'])?($comment['user']['avatar']):'__PUBLIC__/Uploads/default_avatar/face_1.jpg'); ?>"></a></span>
				<div class="comment_right">
					<!--用户名称-->
					<span class="comment_name"><a title="TA的热评" href="#"><?php echo (($comment['user']['nick_name'])?($comment['user']['nick_name']):'游客'); ?></a></span>
					<!--评论的内容-->
					<span comment-id="<?php echo ($comment['id']); ?>" class="comment_content"><?php echo ($comment['content']); ?></span>
					<span comment-id="<?php echo ($comment['id']); ?>" class="judge up">[顶]</span>
					<span comment-id="<?php echo ($comment['id']); ?>" class="judge down">[踩下去]</span>
					<span comment-id="<?php echo ($comment['id']); ?>" class="judge reply">[回复]</span>
					<span comment-id="<?php echo ($comment['id']); ?>" class="judge complaint" href="#" >[举报]</span>
					<form id="reply_form_<?php echo ($comment['id']); ?>" action="<?php echo (($action_url)?($action_url): U('Comment/add_comment@common')); ?>" method="post">
						<input type="hidden" name="pid" value="<?php echo ($comment['id']); ?>">
						<input type="hidden" name="article_id" value="<?php echo ($condition['article_id']); ?>">
					 	<input type="hidden" name="goods_id" value="<?php echo ($condition['goods_id']); ?>">
					 	<input type="hidden" name="share_id" value="<?php echo ($condition['share_id']); ?>">
					 	<input type="hidden" name="collect_id" value="<?php echo ($condition['collect_id']); ?>">
					 	<input type="hidden" name="file_id" value="<?php echo ($condition['file_id']); ?>">
					 	<input type="hidden" name="rental_id" value="<?php echo ($condition['rental_id']); ?>">
					 	<input type="hidden" name="cuisine_id" value="<?php echo ($condition['cuisine_id']); ?>">
					 	<input type="hidden" name="course_id" value="<?php echo ($condition['course_id']); ?>">
					 	<input type="hidden" name="order_id" value="<?php echo ($condition['order_id']); ?>">
					 	<input type="hidden" name="store_id" value="<?php echo ($condition['store_id']); ?>">
					 	<input type="hidden" name="user_id" value="<?php echo ($condition['user_id']); ?>">
						<textarea name="content" placeholder="手拿菜刀砍电线，一路火花带闪电."></textarea>
						<input type="submit" value="回复">
					</form>
				</div>
				<!--回复的评论开始-->
				<?php if(is_array($comment["children"])): $i = 0; $__LIST__ = $comment["children"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$children): $mod = ($i % 2 );++$i;?><div class="child_comment">
					<!--子评论开始-->
					<!--用户头像-->
					<span class="comment_left"><a title="<?php echo ($children['user']['nick_name']); ?>的小窝" href="#"><img height="50" src="<?php echo (($children['user']['avatar'])?($children['user']['avatar']):'__PUBLIC__/Uploads/default_avatar/face_1.jpg'); ?>"></a></span>
					<div class="comment_right">
						<!--用户名称-->
						<span class="comment_name"><a title="TA的热评" href="#"><?php echo (($children['user']['nick_name'])?($children['user']['nick_name']):'游客'); ?></a></span>
						<!--评论的内容-->
						<span class="comment_content"><?php echo ($children['content']); ?></span>
						<!--子评论结束-->
					</div>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>
				<!--回复的评论结束-->
			</div>
		</div>
	 </div><?php endforeach; endif; else: echo "" ;endif; ?>
	<div class="footer">列表内容板块</div>
	<!--<script src="__PUBLIC__/Widget/ListComment/Yocms_image_list_94/ListComment.js" type="text/javascript"></script>-->
<script>
require(['jquery'], function($){
if(typeof(Yocms_comment_image_list_94_is_load)=="undefined"){
	$("body").append('<script src="__PUBLIC__/Widget/ListComment/Yocms_image_list_94/ListComment.js" type="text/javascript"><\/script>');
}
});
</script>
	
</div>