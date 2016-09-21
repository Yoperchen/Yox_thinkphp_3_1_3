<?php
// 文章
class ArticleAction extends Action 
{
    public function index()
    {
    	$condition['site_id'] = I ( 'param.site_id', '', 'htmlspecialchars' ); // 站点id
    	$condition['type'] = I ( 'param.type', '', 'htmlspecialchars' ); // 类型|1:公告;2:普通文章;3:论坛贴;4日志;5说说
    	$condition['category_id'] = I ( 'param.category_id', '', 'htmlspecialchars' ); // 分类id
    	$condition['user_id'] = I ( 'param.user_id', '', 'htmlspecialchars' ); // 用户id
    	$condition['store_id'] = I ( 'param.store_id', '', 'htmlspecialchars' ); // 商家id
//     	import('ORG.Yocms_client',LIB_PATH);// 导入Yocms客户端类
//     	$Yocms_client_obj = new Yocms_client();
//     	$list_share_result = $Yocms_client_obj->get_common_info($ma='10001',$data='',$method='get');//分享列表
     	//print_r($condition);
    	
     	$this->assign('condition',$condition);
		$this->display();
    }
    /**
     * 增加文章
     */
	public function add_article()
	{

		$op = I('param.op','','htmlspecialchars');
		$add_article_data['site_id']=I('param.site_id','','htmlspecialchars');
		$add_article_data['type']=I('param.type','','htmlspecialchars');
		$add_article_data['category_id']=I('param.category_id','','htmlspecialchars');
		$add_article_data['title']=I('param.title','','htmlspecialchars');
		$add_article_data['desc']=I('param.url','','htmlspecialchars');
		$add_article_data['content']=I('param.content','','htmlspecialchars');
		$add_article_data['user_id']=I('param.user_id','','htmlspecialchars');
		$add_article_data['store_id']=I('param.store_id','','htmlspecialchars');
		$add_article_data['from_url']=I('param.from_url','','htmlspecialchars');
		$add_article_data['sort']=I('param.sort','','htmlspecialchars');
		$add_article_data['img1']=I('param.img1','','htmlspecialchars');
		$add_article_data['community_id']=I('param.community_id','','htmlspecialchars');
		$add_article_data['up']=I('param.up','','htmlspecialchars');
		$add_article_data['down']=I('param.down','','htmlspecialchars');
		$add_article_data['like']=I('param.like','','htmlspecialchars');
		$add_article_data['status']=1;
		// 		print_r($_REQUEST);die();
		if($op == 'add')
		{
			import('ORG.Yocms_client',LIB_PATH);// 导入Yocms客户端类
			$Yocms_client_obj = new Yocms_client();
			$add_article_result = $Yocms_client_obj->get_common_info($ma='3001',$add_article_data,$method='post');//新增分享
			//print_r($list_share_result);
			if($add_article_result['status']>0)
			{
				$this->success($add_article_result['message'],U('Share/Index/index'));
			}
			else
			{
				$this->error($add_article_result['message'],U('Share/Index/index'));
			}
			die();
		}
		$this->assign('add_article_data',$add_article_data);
		//$this->assign('list_share_result',$list_share_result);
		$this->display();
	}
	/**
	 * 增加文章，通过url采集
	 */
	public function add_article_by_url()
	{}
	public function article_detail()
	{
		$article_id = I ( 'param.article_id', '26', 'htmlspecialchars' ); // 传入条件
	/*
		$get_widget_data['Widget'] = I ( 'param.Widget', 'DetailShare', 'htmlspecialchars' ); // 对应的小部件
		$get_widget_data['template'] = I ( 'param.template', 'Yocms_detail_1', 'htmlspecialchars' ); // 小部件模版
		$get_widget_data['condition']['share_id'] = I ( 'param.share_id', '50', 'htmlspecialchars' ); // 传入条件
		import('ORG.Yocms_client',LIB_PATH);// 导入Yocms客户端类
		$Yocms_client_obj = new Yocms_client();
		$get_widget_result = $Yocms_client_obj->get_common_info($ma='22001',$get_widget_data,$method='post');
		print_r($get_widget_result);
		$this->assign('get_widget_result',$get_widget_result);*/
		$this->assign('article_id',$article_id);
		$this->display();
	}
	

	/*
	 * 分享工具
	 * <a href="javascript:;" style="cursor:pointer" onclick="var url=location.href;var title=document.title;var img1=document.getElementsByTagName('img')[0].src;var img2=document.getElementsByTagName('img')[1].src;hr='http://share.linglingtang.com/index.php?s=/Share/add_share&url='+url+'&title='+title+'&img1='+img1;window.open(hr);" onmouseover="document.getElementById('tool_digg_tb_f01').style.textDecoration='underline';" onmouseout="document.getElementById('tool_digg_tb_f01').style.textDecoration='none';"><img style="vertical-align: middle;" src="http://dig.chouti.com/images/chouti-16_16_0.gif">
<span id="tool_digg_tb_f01" style="vertical-align: middle; margin-left: 5px;color:#336699;font-weight:bold;font-size:12px;">推荐到零零糖新热榜</span></a>
	 */
}