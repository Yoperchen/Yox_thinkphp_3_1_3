<?php
// 分享
class ShareAction extends Action 
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
     * 增加分享
     */
	public function add_share()
	{
		$op = I('param.op','','htmlspecialchars');
		$add_share_data['title']=I('param.title','','htmlspecialchars');
		$add_share_data['url']=I('param.url','','htmlspecialchars');
		$add_share_data['img1']=I('param.img1','','htmlspecialchars');
		$add_share_data['share_say']=I('param.share_say','','htmlspecialchars');
		$add_share_data['status']=1;
// 		print_r($_REQUEST);die();
		if($op == 'add')
		{
			//import('ORG.Yocms_client',LIB_PATH);// 导入Yocms客户端类
			//$Yocms_client_obj = new Yocms_client();
			//$add_share_result = $Yocms_client_obj->get_common_info($ma='10000',$add_share_data,$method='post');//新增分享
			//print_r($list_share_result);
			$Share_model = D('Share');
			$add_share_result=$Share_model->add_share($add_share_data);
			 if($add_share_result['status']>0)
			 {
			 	$this->success($add_share_result['message'],U('Share/Index/index'));
			 }
			 else
			 {
			 	$this->error($add_share_result['message'],U('Share/Index/index'));
			 }
			die();
		 }
		 $this->assign('add_share_data',$add_share_data);
		//$this->assign('list_share_result',$list_share_result);
		$this->display();
	}
	/**
	 * 增加分享，通过url采集
	 */
	public function add_share_by_url()
	{
		$add_share_data['url'] = I('param.url','','htmlspecialchars');
		$add_share_data['share_say']=I('param.share_say','','htmlspecialchars');
		//$Yocms_client_obj = new Yocms_client();
		//$add_share_result = $Yocms_client_obj->get_common_info($ma='10000',$add_share_data,$method='post');//新增分享
		//print_r($list_share_result);
		$Share_model = D('Share');
		$add_share_result=$Share_model->add_share($add_share_data);
		if($add_share_result['status']>0)
		{
			$this->success($add_share_result['message'],U('Share/Index/index'));
		}else{
			$this->error($add_share_result['message'],U('Share/Index/index'));
		}
		die();
		//$this->assign('list_share_result',$list_share_result);
		$this->display();
	}
	public function share_detail()
	{
	$share_id = I ( 'param.share_id', '26', 'htmlspecialchars' ); // 传入条件
	/*
		$get_widget_data['Widget'] = I ( 'param.Widget', 'DetailShare', 'htmlspecialchars' ); // 对应的小部件
		$get_widget_data['template'] = I ( 'param.template', 'Yocms_detail_1', 'htmlspecialchars' ); // 小部件模版
		$get_widget_data['condition']['share_id'] = I ( 'param.share_id', '50', 'htmlspecialchars' ); // 传入条件
		import('ORG.Yocms_client',LIB_PATH);// 导入Yocms客户端类
		$Yocms_client_obj = new Yocms_client();
		$get_widget_result = $Yocms_client_obj->get_common_info($ma='22001',$get_widget_data,$method='post');
		print_r($get_widget_result);
		$this->assign('get_widget_result',$get_widget_result);*/
		$this->assign('share_id',$share_id);
		$this->display();
	}
	

	/*
	 * 分享工具
	 * <a href="javascript:;" style="cursor:pointer" onclick="var url=location.href;var title=document.title;var img1=document.getElementsByTagName('img')[1].src;var img2=document.getElementsByTagName('img')[1].src;hr='http://share.linglingtang.com/index.php?s=/Share/add_share&url='+url+'&title='+title+'&img1='+img1;window.open(hr);" onmouseover="document.getElementById('tool_digg_tb_f01').style.textDecoration='underline';" onmouseout="document.getElementById('tool_digg_tb_f01').style.textDecoration='none';"><img style="vertical-align: middle;" src="http://dig.chouti.com/images/chouti-16_16_0.gif">
<span id="tool_digg_tb_f01" style="vertical-align: middle; margin-left: 5px;color:#336699;font-weight:bold;font-size:12px;">推荐到零零糖新热榜</span></a>
	 */
}