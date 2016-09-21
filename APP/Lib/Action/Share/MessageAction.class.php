<?php
// 消息
class MessageAction extends Action 
{
    public function index()
    {
//     	import('ORG.Yocms_client',LIB_PATH);// 导入Yocms客户端类
//     	$Yocms_client_obj = new Yocms_client();
//     	$list_share_result = $Yocms_client_obj->get_common_info($ma='10001',$data='',$method='get');//分享列表
//     	print_r($list_share_result);
    	
//     	$this->assign('list_share_result',$list_share_result);
		$this->display();
    }
    /**
     * 发送用户消息
     */
	public function add_message()
	{
		$add_message_data['from_site_id']=I('param.from_site_id','','int');//来自哪个站点
		$add_message_data['to_site_id']=I('param.to_site_id','','int');
		$add_message_data['api_partner_id']=I('param.api_partner_id','','int');
		$add_message_data['from_user_id']=I('param.from_user_id','','int');
		$add_message_data['to_user_id']=I('param.to_user_id','','int');
		$add_message_data['title']=I('param.title','','htmlspecialchars');
		$add_message_data['message_content']=I('param.message_content','','htmlspecialchars');
		$add_message_data['is_read']=I('param.is_read','0','int');
		$add_message_data['theme']=I('param.theme','','htmlspecialchars');
// 		print_r($_REQUEST);die();
		if(!empty($add_message_data['message_content']))
		{
			import('ORG.Yocms_client',LIB_PATH);// 导入Yocms客户端类
			$Yocms_client_obj = new Yocms_client();
			$add_message_result = $Yocms_client_obj->get_common_info($ma='20005',$add_message_data,$method='post');//新增分享
			//print_r($add_comment_result);die();
			 if($add_message_result['status']>0)
			 {
// 			 	die(json_encode($add_message_result));
			 	$this->success($add_message_result['message'],U('Share/User/index'));
			 }else
			 {
// 			 	die(json_encode($add_message_result));
			 	$this->error($add_message_result['message'],U('Share/User/index'));
			 }
		}
		else
		{
			//$this->assign('list_share_result',$list_share_result);
			$this->display();
		}
	}
	/**
	 * 获取用户消息列表
	 */
	public function get_message_list()
	{
		$list_message_condition['from_site_id']=I('param.from_site_id','','int');
		$list_message_condition['to_site_id']=I('param.to_site_id','','int');
		$list_message_condition['api_partner_id']=I('param.api_partner_id','','int');
		$list_message_condition['from_user_id']=I('param.from_user_id','','int');
		$list_message_condition['to_user_id']=I('param.to_user_id','','int');
		$list_message_condition['is_read']=I('param.is_read','','int');
		$list_message_condition['theme']=I('param.theme','','htmlspecialchars');
		
		import('ORG.Yocms_client',LIB_PATH);// 导入Yocms客户端类
		$Yocms_client_obj = new Yocms_client();
		$list_message_result = $Yocms_client_obj->get_common_info($ma='20006',$list_message_condition,$method='post');//新增分享
		//print_r($list_share_result);
		if($list_message_result['status']>0)
		{
// 			$this->success($list_message_result['message'],U('Share/Index/index'));
		}else
		{
// 			$this->error($list_message_result['message'],U('Share/Index/index'));
		}
		$this->assign('list_message_result',$list_message_result);
		$this->display();
	}
	
	/**
	 * 发送群消息
	 */
	public function add_group_message()
	{
		$add_message_data['from_site_id']=I('param.from_site_id','','int');//来自哪个站点
		$add_message_data['to_site_id']=I('param.to_site_id','','int');
		$add_message_data['api_partner_id']=I('param.api_partner_id','','int');
		$add_message_data['from_user_id']=I('param.from_user_id','','int');
		$add_message_data['to_user_id']=I('param.to_user_id','','int');
		$add_message_data['to_group_id']=I('param.to_group_id','','int');
		$add_message_data['title']=I('param.title','','htmlspecialchars');
		$add_message_data['message_content']=I('param.message_content','','htmlspecialchars');
		$add_message_data['is_read']=I('param.is_read','0','int');
		$add_message_data['theme']=I('param.theme','','int');
		// 		print_r($_REQUEST);die();
		if(!empty($add_message_data['message_content']))
		{
			import('ORG.Yocms_client',LIB_PATH);// 导入Yocms客户端类
			$Yocms_client_obj = new Yocms_client();
			$add_message_result = $Yocms_client_obj->get_common_info($ma='20024',$add_message_data,$method='post');//新增分享
			//print_r($add_comment_result);die();
			if($add_message_result['status']>0)
			{
				// 			 	die(json_encode($add_message_result));
				$this->success($add_message_result['message'],U('Share/User/index'));
			}else
			{
				// 			 	die(json_encode($add_message_result));
				$this->error($add_message_result['message'],U('Share/User/index'));
			}
		}
		else
		{
			//$this->assign('list_share_result',$list_share_result);
			$this->display();
		}
	}
	/**
	 * 获取群消息列表
	 */
	public function get_group_message_list()
	{
		$list_message_condition['from_site_id']=I('param.from_site_id','','int');
		$list_message_condition['to_site_id']=I('param.to_site_id','','int');
		$list_message_condition['api_partner_id']=I('param.api_partner_id','','int');
		$list_message_condition['from_user_id']=I('param.from_user_id','','int');
		$list_message_condition['to_user_id']=I('param.to_user_id','','int');
		$list_message_condition['to_group_id']=I('param.to_user_id','','int');
		$list_message_condition['is_read']=I('param.is_read','','int');
		$list_message_condition['theme']=I('param.theme','','htmlspecialchars');
	
		import('ORG.Yocms_client',LIB_PATH);// 导入Yocms客户端类
		$Yocms_client_obj = new Yocms_client();
		$list_message_result = $Yocms_client_obj->get_common_info($ma='20025',$list_message_condition,$method='post');//新增分享
		//print_r($list_share_result);
		if($list_message_result['status']>0)
		{
			//$this->success($list_message_result['message'],U('Share/Index/index'));
		}else{
			//$this->error($list_message_result['message'],U('Share/Index/index'));
		}
		$this->assign('list_message_result',$list_message_result);
		$this->display();
	}
}