<?php
/*
 * 标签|用户标签、文章标签、商品标签、商家标签、小区标签
 */
class Visit_logAction extends ApibaseAction {
	/*
	 * 添加访问记录
	 * 
	*/
	public function add_visit_log(){
		$data['visit_user_id']=$this->_param('visit_user_id','htmlspecialchars,strip_tags');//访问者
		$data['interviewees_user_id']=$this->_param('interviewees_user_id','htmlspecialchars,strip_tags');//被访问者
		$data['interviewees_store_id']=$this->_param('interviewees_store_id','htmlspecialchars,strip_tags');//被访问者
		$data['visit_content']=$this->_param('visit_content','htmlspecialchars,strip_tags');//
		$data['visit_url']=$this->_param('visit_url','htmlspecialchars,strip_tags');//访问的内容url
		$data['is_show']=$this->_param('is_show','htmlspecialchars,strip_tags');//是否显示|1：显示，2不显示
		$data['is_anonymous']=$this->_param('is_anonymous','htmlspecialchars,strip_tags');//是否匿名|1：匿名、2不匿名
		$data['is_delete']=$this->_param('is_delete','htmlspecialchars,strip_tags');//是否删除|
		$result=D('Visit_log')->add_visit_log($data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 获取访问列表
	 * index.php?g=api&m=Article&a=get_article_list&type=2&user_id=用户id
	 * 
	 */
	public function get_visit_list(){
		$condition['visit_user_id']=$this->_param('visit_user_id','htmlspecialchars,strip_tags');//访问者
		$condition['interviewees_user_id']=$this->_param('interviewees_user_id','htmlspecialchars,strip_tags');//被访问者
		$condition['interviewees_store_id']=$this->_param('interviewees_store_id','htmlspecialchars,strip_tags');//被访问者
		$condition['is_show']=$this->_param('is_show','htmlspecialchars,strip_tags');//是否显示|1：显示，2不显示
		$condition['is_anonymous']=$this->_param('is_anonymous','htmlspecialchars,strip_tags');//是否匿名|1：匿名、2不匿名
		$condition['is_delete']=$this->_param('is_delete','htmlspecialchars,strip_tags');//是否删除|
		$page_size=$this->_param('page_size','htmlspecialchars,strip_tags',12);//每页几条
		
		$result=D('Visit_log')->get_visit_log_list($condition,$page_size);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 获取访问记录
	 * 
	 */
	public function get_visit_by_id(){
		$log_id=$this->_param('log_id','htmlspecialchars,strip_tags');
		$isdetail=$this->_param('isdetail','htmlspecialchars,strip_tags');
		$result=D('Visit_log')->get_visit_log($log_id,$isdetail);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 修改访问记录
	 * 
	 */
	public function update_visit_log(){
		$log_id=$this->_param('log_id','htmlspecialchars,strip_tags');
		$data['visit_user_id']=$this->_param('visit_user_id','htmlspecialchars,strip_tags');//访问者
		$data['interviewees_user_id']=$this->_param('interviewees_user_id','htmlspecialchars,strip_tags');//被访问者
		$data['interviewees_store_id']=$this->_param('interviewees_store_id','htmlspecialchars,strip_tags');//被访问者
		$data['visit_content']=$this->_param('visit_content','htmlspecialchars,strip_tags');//
		$data['visit_url']=$this->_param('visit_url','htmlspecialchars,strip_tags');//访问的内容url
		$data['is_show']=$this->_param('is_show','htmlspecialchars,strip_tags');//是否显示|1：显示，2不显示
		$data['is_anonymous']=$this->_param('is_anonymous','htmlspecialchars,strip_tags');//是否匿名|1：匿名、2不匿名
		$data['is_delete']=$this->_param('is_delete','htmlspecialchars,strip_tags');//是否删除|
		
		$result=D('Visit_log')->update_visit_logById($tag_id,$data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 删除
	 */
	public function del_visit_log(){
		$log_id=$this->_param('log_id','htmlspecialchars,strip_tags');
		$result=D('Visit_log')->del_visit_log($log_id);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}

}