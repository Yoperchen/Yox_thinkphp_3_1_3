<?php
/**
 * Store项目使用
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class StorebaseAction extends Action{

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
	   $this->chect_login();
	}
	/**
	 * 检查登录
	 *
	 * @return boolean
	 */
	protected function chect_login()
	{
	    if(session('account_type')!='store' && session('id')<1)
	    {
	        $message='没有登录，请先登录哦。';
	        $this->error($message,U('Login/login@Store'),$this->isAjax());
	    }
	}

}