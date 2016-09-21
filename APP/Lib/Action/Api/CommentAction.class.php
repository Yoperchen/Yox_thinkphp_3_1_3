<?php
/*
 * 通用评论
 */
class CommentAction extends ApibaseAction {
	/**
	 * 添加评论
	 * index.php?g=api&m=Comment&a=add_comment&article_id=公告idid&title=标题&desc=描述&content=内容&user_id=用户id
	*/
	public function add_comment(){
		$data['title']=$this->_param('title','htmlspecialchars,strip_tags');
		$data['content']=$this->_param('content','htmlspecialchars,strip_tags');
		$data['up_id']=$this->_param('up_id','htmlspecialchars,strip_tags',0);//上级评论id
		$data['belong_user_id']=$this->_param('belong_user_id','htmlspecialchars,strip_tags');//谁评论的
		$data['belong_store_id']=$this->_param('belong_store_id','htmlspecialchars,strip_tags');//谁评论的
		$data['article_id']=$this->_param('article_id','htmlspecialchars,strip_tags');//被评论的文章
		$data['goods_id']=$this->_param('good_id','htmlspecialchars,strip_tags');//被评论的商品
		$data['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');//被评论的用户
		$data['mobile']=$this->_param('mobile','htmlspecialchars,strip_tags');//手机号
		$data['email']=$this->_param('email','htmlspecialchars,strip_tags');//被评论的商品
		$data['nick_name']=$this->_param('nick_name','htmlspecialchars,strip_tags');
		$data['reply_content']=$this->_param('reply_content','htmlspecialchars,strip_tags');//管理员回复内容
		$data['reply_admin_id']=$this->_param('reply_content','htmlspecialchars,strip_tags');
		$data['status']=$this->_param('status','htmlspecialchars,strip_tags',1);
		$data['ip']=$this->_param('ip','htmlspecialchars,strip_tags');
		
		$result=D('Comment')->add_comment($data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 获取公告评论列表
	 * index.php?g=api&m=Comment&a=get_comment_list&article_id=文章id
	 */
	public function get_comment_list(){
		$condition['type']=$this->_param('type','htmlspecialchars,strip_tags');
		$condition['store_id']=$this->_param('store_id','htmlspecialchars,strip_tags');
		$condition['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');//用户
		$condition['goods_id']=$this->_param('goods_id','htmlspecialchars,strip_tags');//文章id
		$condition['article_id']=$this->_param('user_id','htmlspecialchars,strip_tags');//文章id
		$condition['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');//文章id
		$result=D('Comment')->get_comment_list($condition);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 获取评论内容
	 * index.php?g=api&m=Comment&a=get_comment_by_id&id=评论id
	 * 
	 */
	public function get_comment_by_id(){
		$id=$this->_param('id','htmlspecialchars,strip_tags');
		$isdetail=$this->_param('isdetail','htmlspecialchars,strip_tags');
		$result=D('Comment')->get_comment_by_id($id,$isdetail);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 修改评论
	 * index.php?g=api&m=Comment&a=update_comment&id=文章id&title=标题&content=内容
	 * 
	 */
	public function update_comment(){
		$id=$this->_param('id','htmlspecialchars,strip_tags');
		$data['title']=$this->_param('title','htmlspecialchars,strip_tags');
		$data['content']=$this->_param('content','htmlspecialchars,strip_tags');
		
		$result=D('Comment')->update_commentById($id,$data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * index.php?g=api&m=Comment&a=del_comment&id=文章id
	 * 删除
	 */
	public function del_comment(){
		$id=$this->_param('id','htmlspecialchars,strip_tags');
		$result=D('Comment')->del_comment($id);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}

}