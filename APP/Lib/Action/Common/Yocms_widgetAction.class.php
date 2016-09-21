<?php
/**
 * 小部件操作
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class Yocms_widgetAction extends ApibaseAction 
{
	public function index()
	{
		die('Yocms_widget');
	}
	/**
	 * 获取小部件内容
	 * http://www.linglingtang.com/index.php?s=/Common/Yocms_widget/get_widget&Widget=ListComment&template=Yocms_image_list_94&condition['share_id']=1
	 */
	public function get_widget() 
	{
		$Widget = I ( 'param.Widget', '', 'htmlspecialchars' ); // 对应的小部件
		$template = I ( 'param.template', '', 'htmlspecialchars' ); // 小部件模版
		$condition = I ( 'param.condition', '', 'htmlspecialchars' ); // 传入条件
		//print_r($Widget);
		//print_r($template);
		//print_r($condition);
		$widget_content = W($Widget,array('template'=>$template,'condition'=>$condition,'format_type'=>'jsonp'));
		exit(json_encode($widget_content));
		//die($widget_content);
		$this->assign ('Widget', $Widget);
		$this->assign ('template', $template);
		$this->assign ('condition', $condition);
		$this->display ();
	}

}