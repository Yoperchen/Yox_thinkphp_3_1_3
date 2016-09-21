<?php
/*
 * 小部件
 */
class Yocms_widgetAction extends ApibaseAction 
{
	/**
	 * 获取小部件内容
	 */
	public function get_widget() 
	{
		$Widget = I ( 'param.Widget', '', 'htmlspecialchars' ); // 对应的小部件
		$template = I ( 'param.template', '', 'htmlspecialchars' ); // 小部件模版
		$condition = I ( 'param.condition', '', 'htmlspecialchars' ); // 传入条件
		//print_r($Widget);
		//print_r($template);
		//print_r($condition);
		//$widget_content = W($Widget,array('template'=>$template,'condition'=>$condition),true);
		// exit(json_encode($result));
		//die($widget_content);
		$this->assign ('Widget', $Widget);
		$this->assign ('template', $template);
		$this->assign ('condition', $condition);
		$this->display ('Tool/get_widget');
	}

}