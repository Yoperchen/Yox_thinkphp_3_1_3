<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>   
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<script type="text/javascript" src="__PUBLIC__/js/require.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/main.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/jquery.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/plugins/ckeditor/ckeditor.js"></script>
<title>我的个人空间-零零糖-汇聚每日热门、搞笑、有趣资讯</title>
<link rel="icon" href="/Public/favicon.ico" mce_href="/Public/favicon.ico" type="image/x-icon">
<style type="text/css">
*{ margin:0; padding:0}
body{ text-align:center}
#wrapper{margin-left:auto;margin-right:auto;text-align:left;}
#header,#footer{clear:both;text-align:center;}
h1,p{padding:10px;}
#main{float:left;min-width:720px;width:70%}
#main>div>a{float: left;color: #333;text-decoration: none;border: 1px solid #ccc;border-radius: 5px;padding: 5px;font-size: 15px;margin-left: 20px;background-color: #F0F4F8;height: 20px;}
#main>div#extrabar>a{clear:both;margin: 5px;}
#content{float:right;min-width:480px;width:70%;color:#333;background-color:#fff;}
#extrabar{float:left;min-width:240px;width:30%;height:360px;color:#fff;background-color:#fff;}
.box{float:left;min-width:240px;width:33%;height:auto;}
#sidebar{ float:left;}
.minwidth{width:1200px;}
.maxwidth{width:960px;}
.minwidth #sidebar{width:240px;}
.maxwidth #sidebar{width:240px;}
.s1{color:#000;background-color:#fff;font-size: 12px;}
.s2{color:#000;background-color:#fff;font-size: 12px;}
.s3{color:#000;background-color:#fff;font-size: 12px;}
</style>
</head>
<body>

<div id="wrapper" class="minwidth">
	<div id="header">
	<?php echo W('Header',array('template'=>'Yocms_header_3'));?>
	</div>
	<div id="main">
	<div style="display:block;height: 37px;">
		<a href="<?php echo U('User/index@share');?>" title="新热榜">新热榜</a>
		<a onclick="get_article_list(this)" href="javascript:;" article-data-type="5" title="信息爆炸的年代 , 每一次浏览都是与人擦肩而过">行人说</a>
		<a href="javascript:alert('暂时还没有开通哦')" title="每一个小区,就是一个学校,每一个学校,就是一个社区">附近</a>
		<a href="javascript:alert('暂时还没有开通哦')" title="这里是城市的事情,发生的事情就在身边">城市广场</a>
		<!--<a href="javascript:alert('暂时还没有开通哦')" title="国外怎么啦">国外</a>-->
		<a href="javascript:alert('暂时还没有开通哦')" title="秘密总要有一个地方安放,不会有人知道你是谁">秘密</a>
		<!--<a href="javascript:alert('暂时还没有开通哦')" title="哆啦A梦的口袋：有许多实用的好玩的东西">哆啦A梦的口袋</a>-->
		<a class="Yocms_user_add_share_2_toggle" style="background-color: #84A42B;
	    border: 1px solid #8aab30;
	    color: #FFF;
	    display: inline-block;
	    height: 20px;
	    line-height: 20px;
	    text-align: center;
	    width: 134px;
	    float: right;
	    font-size: 14px;text-decoration: none;padding: 5px;" href="javascrip:;" title="所有人都可以把好文章分享到这里">+ &nbsp;发布</a>
		</div>
		<div id="content">
		 <?php echo W('ListShare',array('template'=>'Yocms_image_list_88','condition'=>array(),'page'=>array('page_size'=>50),'page_template'=>1));?>
		</div>
		<div id="extrabar">
			<!--<a href="#">邂逅游戏</a>
			<a href="#">与我相关</a>
			<a href="#">特别关心</a>
			<a href="#">附近的会员</a>
			<a href="#">喜欢我的</a>
			<a href="#">加我为最爱</a>-->
			<a href="#">访客</a>
			<a target="_blank" href="http://union.click.jd.com/jdc?e=&p=AyIPZRprFDJWWA1FBCVbV0IUEEULRFRBSkAOClBMW0sFa0VSUAAORC8dYFlDIl4EaF5WWF1MGkMOHjdWElIRBhMEVx9rFgYQB1YbWxUGIjc0aWtebBM3ZRteEAYUAVUeXhcKEAJlHA%3D%3D&t=W1dCFBBFC0RUQUpADgpQTFtLBQ%3D%3D">买点提高生活品质的东西</a>
		</div>
	</div>
	<div id="sidebar">
		<div id="message" class="box s1">
			<P>1.总有人在你切一盘水果时秒杀一道数学题，总有人在你调整愤怒的小鸟弹射角度时记住一个单词，总有人在你打一盘dota的时间内看完一章教材，总有人在你打一局2K的时间里完成一套阅读题，总有人在你与他人闲聊时听一段VOA，总有人在你熟睡时回想一天的得失，总有人比你跑得快，你还会虚度光阴么？</P>
		</div>
		<div id="add_message" class="box">
			 <?php echo W('AddGroups_message',array('template'=>'Yocms_user_add_message_2','data'=>array('to_group_id'=>2),'action_url'=>U('Message/add_group_message@share')));?>
			 <style type="text/css">#Yocms_user_add_message_2{border:0}#Yocms_user_add_message_2 .header{display:none}</style>
		</div>
		<div class="box s2">
			<P>2.边学习边完善，有很多的不完善，体验不好，希望良师益友可以告知</P>
		</div>
		<div class="box s3">
			<h1>Yoper的纯属吐槽。</h1>
			<p>最近技术有长进了,但是并没有很好的把这些写出来,持之以恒把美好的东西写出来肯定事没有错的.但是最近确实是有点忙.等我忙完,一股脑写个10篇吧.当然,也不一定是纯技术文章.我应该比较喜欢东拉西扯.</p>
			<p>自己的技术水平一直是一般般,挺希望有一天能变成武侠一般风云的人物.然后低调的蜗居在城市的某个角落，用犀利的眼睛观察这个世界.瞧,又做白日梦的.</p>
			<p>自己尝试了写一个内容管理系统,暂且就叫Ycms吧,技术实在有限,进度也一直缓慢,本来还有两个小苹果程序员大家一起努力,可是他们都找到了自己的幸福,从此不再过问江湖.留下我分钟，封号中，风中凌乱, 擦,这风中这么难打.只能一个人偶尔下班写着玩玩.时间不多.</p>
			<p>想当年文艺的我还只想单纯的拯救世界.</p>
			<p>现在要变成大叔了,却在想着要不要辞职这事.</p>
			<p>2015.09.16 01:19</p>
		</div>
	</div>
	<div id="footer">
		<?php echo W('Footer');?>
	</div>
</div>
<style type="text/css">
#Yocms_image_list_share_88{border:none}
#Yocms_image_list_share_88 .header{display:none;}
</style>
<script type="text/javascript">
//获取评论列表
function get_article_list(obj)
{
	$.ajax(
	    {
	        type:'get',
	        url : share_url+"index.php?s=/Yocms_widget/get_widget&Widget=ListArticle&template=Yocms_image_list_88&condition[type]="+$(obj).attr('article-data-type')+"&t=default_theme&page_template=1",
	        dataType : 'text',
	        //jsonp:"jsoncallback",
	        success  : function(data) {
	            //alert(data);
				if($("#content").length>0)
				{
					//元素存在就移除
					$("#content").empty();;
				}
				$("#content").append(data);
				$(".Yocms_image_list_88 .header").css("display","none");
				$(".Yocms_image_list_88").css("border","none");
				//$("#content").css("width","500px");
				//$("#content").css("position","absolute");
				//$("#content").css("top",$(document).scrollTop()+50);
				//$("#content").css("left",($(window).width())/4);
				//$("#content").toggle();
				
	        },
	        error : function(data) {
	            alert('fail');
	        }
	    }
	);
}
</script>
<script type="text/javascript">
//每隔一秒获取消息
var countdown=0; 
var status=1;
begin_message();
function begin_message(){status=1;get_message()}
function stop_message(){status=0;}
function get_message(val) 
{ 
	if(status==1)
	{
		//此处异步获取消息
		console.log(countdown);
		++countdown;
		$.ajax(
			    {
			        type:'get',
			        url : share_url+"index.php?s=/Yocms_widget/get_widget&Widget=ListGroupsMessage&template=Yocms_list_90&condition[to_group_id]=2&t=default_theme",
			        dataType : 'text',
			        //jsonp:"jsoncallback",
			        success  : function(data) {
			            //alert(data);
						if($("#message").length>0)
						{
							//元素存在就移除
							$("#message").empty();;
						}
						$("#message").html(data);
						//$(".Yocms_list_90 .header").css("display","none");
						$(".Yocms_list_90 .footer").css("display","none");
						$(".Yocms_list_90").css("border","none");
						//$("#content").css("width","500px");
						//$("#content").css("position","absolute");
						//$("#content").css("top",$(document).scrollTop()+50);
						//$("#content").css("left",($(window).width())/4);
						//$("#content").toggle();
						
			        },
			        error : function(data) {
			            alert('get_message_fail');
			        }
			    }
			);
		setTimeout(function() 
		{
			get_message(val) ;
		},1500) //1000就是1秒
	}
	else
	{
		clearInterval();
		return;
	}
} 
</script> 
<?php echo W('AddShare',array('template'=>'Yocms_user_add_share_2','action_url'=>U('Share/add_share@share')));?>
<style type="text/css">#Yocms_user_add_share_2{display:none;}</style>
</body>
</html>