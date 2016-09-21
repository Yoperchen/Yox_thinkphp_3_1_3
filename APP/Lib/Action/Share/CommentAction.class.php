<?php
// 评论
class CommentAction extends Action 
{
    public function index()
    {
    	import('ORG.Yocms_client',LIB_PATH);// 导入Yocms客户端类
    	$Yocms_client_obj = new Yocms_client();
    	$list_share_result = $Yocms_client_obj->get_common_info($ma='10001',$data='',$method='get');//分享列表
//     	print_r($list_share_result);
    	
//     	$this->assign('list_share_result',$list_share_result);
		$this->display();
    }
    /**
     * 增加评论
     */
	public function add_comment()
	{
		$add_comment_data['up_id']=I('param.up_id','','int');
		$add_comment_data['belong_user_id']=I('param.belong_user_id','','int');
		$add_comment_data['belong_store_id']=I('param.belong_store_id','','int');
		$add_comment_data['article_id']=I('param.article_id','','int');
		$add_comment_data['goods_id']=I('param.good_id','','int');
		$add_comment_data['share_id']=I('param.share_id','','int');
		$add_comment_data['collect_id']=I('param.collect_id','','int');
		$add_comment_data['file_id']=I('param.file_id','','int');
		$add_comment_data['rental_id']=I('param.rental_id','','int');
		$add_comment_data['cuisine_id']=I('param.cuisine_id','','int');
		$add_comment_data['course_id']=I('param.course_id','','int');
		$add_comment_data['order_id']=I('param.order_id','','int');
		$add_comment_data['store_id']=I('param.store_id','','int');
		$add_comment_data['user_id']=I('param.user_id','','int');
		$add_comment_data['mobile']=I('param.mobile','','htmlspecialchars');
		$add_comment_data['email']=I('param.email','','htmlspecialchars');
		$add_comment_data['nick_name']=I('param.nick_name','','htmlspecialchars');
		$add_comment_data['title']=I('param.title','','htmlspecialchars');
		$add_comment_data['content']=I('param.content','','htmlspecialchars');
		$add_comment_data['reply_admin_id']=I('param.reply_admin_id','','int');
		$add_comment_data['status']=1;
// 		print_r($_REQUEST);die();
		if(!empty($add_comment_data['content']))
		{
			import('ORG.Yocms_client',LIB_PATH);// 导入Yocms客户端类
			$Yocms_client_obj = new Yocms_client();
			$add_comment_result = $Yocms_client_obj->get_common_info($ma='3007',$add_comment_data,$method='post');//新增分享
			//print_r($add_comment_result);die();
			 if($add_comment_result['status']>0)
			 {
			 	$this->success($add_comment_result['message'],U('Share/Index/index'));
			 	$this->redirect();
			 }else{
			 	$this->error($add_comment_result['message'],U('Share/Index/index'));
			 }
		}
		else
		{
			//$this->assign('list_share_result',$list_share_result);
			$this->display();
		}
	}
	public function get_comment_list()
	{
		$list_comment_condition['up_id']=I('param.up_id','','int');
		$list_comment_condition['belong_user_id']=I('param.belong_user_id','','int');
		$list_comment_condition['belong_store_id']=I('param.belong_store_id','','int');
		$list_comment_condition['article_id']=I('param.article_id','','int');
		$list_comment_condition['goods_id']=I('param.good_id','','int');
		$list_comment_condition['share_id']=I('param.share_id','','int');
		$list_comment_condition['collect_id']=I('param.collect_id','','int');
		$list_comment_condition['file_id']=I('param.file_id','','int');
		$list_comment_condition['rental_id']=I('param.rental_id','','int');
		$list_comment_condition['cuisine_id']=I('param.cuisine_id','','int');
		$list_comment_condition['course_id']=I('param.course_id','','int');
		$list_comment_condition['order_id']=I('param.order_id','','int');
		$list_comment_condition['store_id']=I('param.store_id','','int');
		$list_comment_condition['user_id']=I('param.user_id','','int');
		$list_comment_condition['mobile']=I('param.mobile','','htmlspecialchars');
		$list_comment_condition['email']=I('param.email','','htmlspecialchars');
		$list_comment_condition['nick_name']=I('param.nick_name','','htmlspecialchars');
		$list_comment_condition['title']=I('param.title','','htmlspecialchars');
		$list_comment_condition['content']=I('param.content','','htmlspecialchars');
		$list_comment_condition['reply_admin_id']=I('param.reply_admin_id','','int');
		$list_comment_condition['status']=1;
		
		import('ORG.Yocms_client',LIB_PATH);// 导入Yocms客户端类
		$Yocms_client_obj = new Yocms_client();
		$list_comment_result = $Yocms_client_obj->get_common_info($ma='3006',$list_comment_condition,$method='post');//新增分享
		//print_r($list_share_result);
		if($list_comment_result['status']>0)
		{
			$this->success($list_comment_result['message'],U('Share/Index/index'));
		}else{
			$this->error($list_comment_result['message'],U('Share/Index/index'));
		}
	}
	/**
	 * 获取小部件
	 */
	public function get_comment_list_by_widget()
	{
		$data['Widget'] = I('param.Widget','','htmlspecialchars');//对应的小部件
		$data['template'] = I('param.template','','htmlspecialchars');//小部件模版
		$data['condition']=I('param.condition','','htmlspecialchars');//传入条件
		
		import('ORG.Yocms_client',LIB_PATH);// 导入Yocms客户端类
		$Yocms_client_obj = new Yocms_client();
		$get_widget_result = $Yocms_client_obj->get_common_info($ma='21001',$data,$method='post');//获取小部件
	}
	public function test()
	{

	}
}