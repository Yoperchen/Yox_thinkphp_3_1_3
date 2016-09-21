<?php
class ToolAction extends ApibaseAction {

	public function index()
	{
		//print_r($_REQUEST);die();
		$this->assign('api_array',$this->api_array);
		$this->display();
	}

	public function get_form()
	{
		$api_key = trim($_POST['api_key']);
		$api_category= trim($_POST['api_category']);
		if(in_array($api_key, array_keys($this->api_array['analog_applications'])))
		{
			//此处限制是否显示模拟应用详情
			echo 'linglingtang:无权限浏览应用详情';die();
		}
		$api_info = $this->api_array[$api_category][$api_key];
// 		print_r($api_info);
		$this->assign('api_info',$api_info);
		$this->display();
	}

	public function get_apilist()
	{
		$api_category = trim($_POST['api_category']);
		$this->ajaxReturn($this->api_array[$api_category],'success',1);
	}

}