<?php
/**
 * 普通项目使用(除admin项目和Store项目和Api项目)
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class CommonAction extends Action{

	/**
	 * 返回数据格式: xml
	 */
	const RETURN_DATA_FORMAT_XML = 'xml';

	/**
	 * 返回数据格式: json
	 */
	const RETURN_DATA_FORMAT_JSON = 'json';
	/**
	 * 初始化，父类调用
	 *
	 * @return boolean
	 */
	protected function _initialize() 
	{
	    //检查是否手机访问,手机访问则设置为手机主题
	    if($this->is_mobile())
	    {
	        C('DEFAULT_THEME','default_theme_mobile');
	    }
	    //检查是否请求了主题颜色，有则设置颜色
	    //已添加到行为,所有项目有效
// 	    if(I('theme_color'))
// 	    {
// 	        cookie('theme_color',I('theme_color'));
// 	    }
	   $this->chect_login();
	}
	/**
	 * 检查登录
	 *
	 * @return boolean
	 */
	protected function chect_login()
	{
// 	    $jump_url=$jump_url?$jump_url:U('Login/login@admin');
	    if(session('account_type')!='user' && session('id')<1)
	    {
	        $message='没有登录，请先登录哦。';
	        $this->error($message,U('Login/login'),$this->isAjax());
	    }
	}
	/**
	 * 检查客户端
	 *
	 * @return boolean
	 */
	protected function is_mobile()
	{
		return 	Yocms_is_mobile();
	}  
	/**
	 * 获取手机模版
	 *
	 * @return boolean
	 */
	protected function get_mobile_template()
	{
		//$is_mobile = $this->is_mobile();
		return 'default_theme_mobile';
	}  
}