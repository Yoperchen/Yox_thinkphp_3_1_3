<?php
/*
 * 标签|用户标签、文章标签、商品标签、商家标签、小区标签
 */
class TagAction extends ApibaseAction {
	/*
	 * 添加文章
	 * index.php?g=api&m=Article&a=add_article&type=2&title=标题&desc=描述&content=内容
	 * 
	 * 添加公告
	 * index.php?g=api&m=Article&a=add_article&type=1&title=标题&desc=描述&content=内容
	*/
	public function add_tag(){
		$data['tag']=$this->_param('tag','htmlspecialchars,strip_tags');//用户
		$data['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');//用户
		$data['store_id']=$this->_param('store_id','htmlspecialchars,strip_tags');//商家
		$data['article_id']=$this->_param('article_id','htmlspecialchars,strip_tags');//文章
		$data['cuisine_id']=$this->_param('cuisine_id','htmlspecialchars,strip_tags');//菜式
		$data['community_id']=$this->_param('community_id','htmlspecialchars,strip_tags');//社区
		$data['good_id']=$this->_param('good_id','htmlspecialchars,strip_tags');//商品id
		$result=D('Tags')->add_tag($data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 获取标签列表
	 * index.php?g=api&m=Article&a=get_article_list&type=2&user_id=用户id
	 * 
	 */
	public function get_tag_list(){
		$condition['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');//用户
		$condition['store_id']=$this->_param('store_id','htmlspecialchars,strip_tags');//商家
		$condition['article_id']=$this->_param('article_id','htmlspecialchars,strip_tags');//文章
		$condition['cuisine_id']=$this->_param('cuisine_id','htmlspecialchars,strip_tags');//菜式
		$condition['community_id']=$this->_param('community_id','htmlspecialchars,strip_tags');//社区
		$condition['good_id']=$this->_param('good_id','htmlspecialchars,strip_tags');//商品id
		$page_size=$this->_param('page_size','htmlspecialchars,strip_tags',12);//每页几条
		
		$result=D('Tags')->get_tag_list($condition,$page_size);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 获取标签
	 * 
	 */
	public function get_tag_by_tag_id(){
		$tag_id=$this->_param('tag_id','htmlspecialchars,strip_tags');
		$isdetail=$this->_param('isdetail','htmlspecialchars,strip_tags');
		$result=D('Tags')->getTagById($tag_id,$isdetail);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 修改文章，修改公告
	 * index.php?g=api&m=Article&a=update_article&id=文章id&title=标题&content=内容
	 * 
	 */
	public function update_tag(){
		$tag_id=$this->_param('tag_id','htmlspecialchars,strip_tags');
		$data['tag']=$this->_param('tag','htmlspecialchars,strip_tags');//用户
		$data['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');//用户
		$data['store_id']=$this->_param('store_id','htmlspecialchars,strip_tags');//商家
		$data['article_id']=$this->_param('article_id','htmlspecialchars,strip_tags');//文章
		$data['cuisine_id']=$this->_param('cuisine_id','htmlspecialchars,strip_tags');//菜式
		$data['community_id']=$this->_param('community_id','htmlspecialchars,strip_tags');//社区
		$data['good_id']=$this->_param('good_id','htmlspecialchars,strip_tags');//商品id
		
		$result=D('Tags')->update_tagById($tag_id,$data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * index.php?g=api&m=Article&a=del_article&id=文章id
	 * 删除
	 */
	public function del_tag(){
		$tag_id=$this->_param('tag_id','htmlspecialchars,strip_tags');
		$result=D('Article')->del_article($tag_id);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}

}