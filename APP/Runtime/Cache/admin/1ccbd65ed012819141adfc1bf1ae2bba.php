<?php if (!defined('THINK_PATH')) exit();?><div class="Yocms_add_comment_1" id="Yocms_add_comment_1">
	<div class="header">
		<span style="color:#357ebd;font-size:15px;width:200px;height:45px;float:left;font-family: cursive;">热点评论</span>
		<span class="close" id="Yocms_add_comment_1" title="关闭评论">x</span>
	</div>
	<form action="<?php echo (($action_url)?($action_url): U('Comment/add_comment')); ?>" method="post">
	 	<div><span>文章ID:</span><input type="text" name="article_id" value=""></div>
	 	<div><span>商品ID:</span><input type="text" name="goods_id" value=""></div>
	 	<div><span>分享ID:</span><input type="text" name="share_id" value=""></div>
	 	<div><span>收藏ID:</span><input type="text" name="collect_id" value=""></div>
	 	<div><span>文件ID:</span><input type="text" name="file_id" value=""></div>
	 	<div><span>出租ID:</span><input type="text" name="rental_id" value=""></div>
	 	<div><span>菜式ID:</span><input type="text" name="cuisine_id" value=""></div>
	 	<div><span>课程ID:</span><input type="text" name="course_id" value=""></div>
	 	<div><span>订单ID:</span><input type="text" name="order_id" value=""></div>
	 	<div><span>商家ID:</span><input type="text" name="store_id" value=""></div>
	 	<div><span>用户ID:</span><input type="text" name="user_id" value=""></div>
		<div><span>评论内容:</span><textarea name="content" placeholder="君看一叶舟,出没风尘里"></textarea></div>
		<div><input type="submit" value="评论"></div>
	</form>
	<div class="footer">列表内容板块</div>
	<style type="text/css">	
	.Yocms_add_comment_1{border: 1px solid #ccc;border-radius: 20px;display:block;background-color: #fff;position: absolute;width: 98%;}
	.Yocms_add_comment_1 .header{border-bottom: 1px solid #357ebd;width: 100%;height: 55px;border-top-left-radius: 25px;border-top-right-radius: 25px;}
	.Yocms_add_comment_1 .close{color:red;font-size:30px;width:45px;height:45px;float:right;font-family: cursive;cursor: pointer;border-radius: 20px;text-align: center;margin-top: 6px;}
	.Yocms_add_comment_1 div{clear: both;width:100%;display: block;}
	.Yocms_add_comment_1 span{height: 30px;font-size: 15px;margin: 10px;padding: 2px;display: block;float:left;width: 110px;text-align: left;line-height: 35px;}
	.Yocms_add_comment_1 input{width: 60%;height: 30px;font-size: 23px;margin: 10px;padding: 2px;float:left;border: 1px solid #ccc;border-radius: 4px;}
	.Yocms_add_comment_1 form{clear: both;width: 100%;}
	.Yocms_add_comment_1 form textarea{clear: both;display: block;width: 95%;margin: 10px;color: #656464;margin-left: auto;      margin-right: auto;border-radius: 10px;height: 60px;border: 1px solid #ccc;padding: 5px;outline: none;}
	.Yocms_add_comment_1 form input[type="submit"]{width: 50%;height: 30px;line-height: 30px;text-align: center;clear: both;margin-left: auto;margin-right: auto;display: block;border: 1px solid #ccc;background-color: #428BCA;border-radius: 4px;color: #fff;outline: none;float: none;}
	.Yocms_add_comment_1 .footer{padding: 10px;font-size: 12px;color: #999;text-align: left;float: left;clear: both;border-bottom-left-radius: 25px;border-bottom-right-radius: 25px;width: 95%;}	
	</style>
</div>