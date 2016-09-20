<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" type="text/css" href="__PUBLIC__/Widget/MiniHeader/MiniHeader/MiniHeader_<?php echo (($css)?($css):'w1200_gray'); ?>.css">
<div id="MiniHeader" class="MiniHeader">
	<div class="top-wrap">
              <a href="<?php echo U('Index/index@yo81008');?>" title="首页" style="color:#D80321">零零糖</a> - 零食的零，糖果的糖 - 上网、购物、搜索、爱学习从这里开始
    		<div class="userinfo">
			<a id="community_name" data-community-id="<?php echo ((cookie('community_id'))?(cookie('community_id')):'44'); ?>" title="学校名称" style="color:#D80321"><?php echo ((cookie('community_name'))?(cookie('community_name')):'北京大学'); ?></a>
			<a href="javascript:;" onclick="get_community_list(this)" title="选择学校">切换</a>&nbsp;
			<?php if($_SESSION['id']!= ''): ?>欢迎您<!--<a href="<?php echo U('User/index@Yo81008');?>" title="喵~"><?php echo ((session('name'))?(session('name')):"这家伙很懒，什么也没留下"); ?></a>-->
			<a href="<?php echo U('User/logout@Yo81008');?>">退出</a>
 			<?php else: ?>
			<form id="login_form" name="login_form" action="<?php echo U('Index/login@Yo81008');?>" method="post">
                <span>账号</span>
                <input type="text" id="user_id" name="id"/>
                <span>密码</span>
                <input type="password" id="user_password" name="password" />
                <input style="border-radius: 15px;  BACKGROUND: #FF0000;border: 1px solid #FFFFFF;color: #fff;cursor: pointer;" type="submit" name="submit_login" value="登陆"/>
            </form>
			没有帐号?去<a style="color:green;" href="<?php echo U('Index/register@Yo81008');?>">注册</a><?php endif; ?>
        </div>
    </div>
</div>
<script>
require(['jquery'], function($){
	if(typeof(MiniHeader_is_load)=="undefined"){
		$("body").append('<script src="__PUBLIC__/Widget/MiniHeader/MiniHeader/MiniHeader.js" type="text/javascript"><\/script>');
	}
});
</script>