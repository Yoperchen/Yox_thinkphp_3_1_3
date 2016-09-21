<?php
/*
 * 分享|用户分享、文章分享、商品分享、商家分享、小区分享|收藏 用户收藏、文章收藏、商品收藏、校区收藏。。
 */
class ShareAction extends ApibaseAction {
	/*
	 * 添加分享
	 * index.php?g=api&m=Article&a=add_article&type=2&title=标题&desc=描述&content=内容
	*/
	public function add_share(){
		$data['title']=I('param.title','','htmlspecialchars');//标题
		$data['share_say']=$this->_param('share_say','htmlspecialchars,strip_tags');//分享时说
		$data['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');//用户
		$data['cuisine_id']=$this->_param('cuisine_id','htmlspecialchars,strip_tags');//菜式
		$data['article_id']=$this->_param('article_id','htmlspecialchars,strip_tags');//文章
		$data['store_id']=$this->_param('store_id','htmlspecialchars,strip_tags');//商家
		$data['community_id']=$this->_param('community_id','htmlspecialchars,strip_tags');//社区
		$data['good_id']=$this->_param('good_id','htmlspecialchars,strip_tags');//商品id
// 		$data['tag_id']=$this->_param('tag_id','htmlspecialchars,strip_tags');//标签id
		$data['order_id']=$this->_param('order_id','htmlspecialchars,strip_tags');//订单id
		$data['url']=$this->_param('url','htmlspecialchars,strip_tags');//分享的url。站外的url
		$data['img1']=$this->_param('img1','htmlspecialchars,strip_tags');//分享的url。站外的url
		$data['status']=I('param.status','1','htmlspecialchars');//状态
		$result=D('Share')->add_share($data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 获取分享列表
	 * 
	 */
	public function get_share_list(){
		$condition['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');//用户
		$condition['store_id']=$this->_param('store_id','htmlspecialchars,strip_tags');//商家
		$condition['article_id']=$this->_param('article_id','htmlspecialchars,strip_tags');//文章
		$condition['cuisine_id']=$this->_param('cuisine_id','htmlspecialchars,strip_tags');//菜式
		$condition['community_id']=$this->_param('community_id','htmlspecialchars,strip_tags');//社区
		$condition['good_id']=$this->_param('good_id','htmlspecialchars,strip_tags');//商品id
		$page_size=$this->_param('page_size','htmlspecialchars,strip_tags',12);//每页几条
		
		$result=D('Share')->get_share_list($condition,$page_size);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 获取分享详细
	 * 
	 */
	public function get_share_by_share_id(){
		$share_id=$this->_param('share_id','htmlspecialchars,strip_tags');
		$isdetail=$this->_param('isdetail','htmlspecialchars,strip_tags');
		$result=D('Share')->getShareById($share_id,$isdetail);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 修改文章，修改分享
	 * 
	 */
	public function update_share(){
		$share_id=$this->_param('share_id','htmlspecialchars,strip_tags');
		$data['share_say']=$this->_param('share_say','htmlspecialchars,strip_tags');//用户
		$data['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');//用户
		$data['cuisine_id']=$this->_param('cuisine_id','htmlspecialchars,strip_tags');//菜式
		$data['article_id']=$this->_param('article_id','htmlspecialchars,strip_tags');//文章
		$data['store_id']=$this->_param('store_id','htmlspecialchars,strip_tags');//商家
		$data['community_id']=$this->_param('community_id','htmlspecialchars,strip_tags');//社区
		$data['good_id']=$this->_param('good_id','htmlspecialchars,strip_tags');//商品id
		$data['tag_id']=$this->_param('tag_id','htmlspecialchars,strip_tags');//标签id
		$data['order_id']=$this->_param('order_id','htmlspecialchars,strip_tags');//标签id
		$data['url']=$this->_param('url','htmlspecialchars,strip_tags');//标签id
		
		$result=D('Share')->update_shareById($share_id,$data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 删除分享
	 */
	public function del_share(){
		$share_id=$this->_param('share_id','htmlspecialchars,strip_tags');
		$result=D('Share')->del_share($share_id);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 添加收藏
	 */
	public function add_collect(){
		$data['belong_user_id']=$this->_param('belong_user_id','htmlspecialchars,strip_tags');//属于哪个用户
		$data['collect_say']=$this->_param('collect_say','htmlspecialchars,strip_tags');//被收藏的用户
		$data['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');//被收藏的用户
		$data['cuisine_id']=$this->_param('cuisine_id','htmlspecialchars,strip_tags');//菜式
		$data['article_id']=$this->_param('article_id','htmlspecialchars,strip_tags');//文章
		$data['store_id']=$this->_param('store_id','htmlspecialchars,strip_tags');//商家
		$data['community_id']=$this->_param('community_id','htmlspecialchars,strip_tags');//社区
		$data['good_id']=$this->_param('good_id','htmlspecialchars,strip_tags');//商品id
		$data['order_id']=$this->_param('order_id','htmlspecialchars,strip_tags');//订单id
		$data['url']=$this->_param('url','htmlspecialchars,strip_tags');//分享的url。站外的url
		
		$result=D('Collect')->add_collect($data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 获取收藏列表
	 */
	public function get_collect_list(){
		$condition['belong_user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');//用户
		$condition['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');//被收藏的用户
		$condition['store_id']=$this->_param('store_id','htmlspecialchars,strip_tags');//商家
		$condition['article_id']=$this->_param('article_id','htmlspecialchars,strip_tags');//文章
		$condition['cuisine_id']=$this->_param('cuisine_id','htmlspecialchars,strip_tags');//菜式
		$condition['community_id']=$this->_param('community_id','htmlspecialchars,strip_tags');//社区
		$condition['good_id']=$this->_param('good_id','htmlspecialchars,strip_tags');//商品id
		$condition['order_id']=$this->_param('order_id','htmlspecialchars,strip_tags');//订单id
		
		$page_size=$this->_param('page_size','htmlspecialchars,strip_tags',12);//每页几条
	
		$result=D('Collect')->get_collect_list($condition,$page_size);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 获取详细分享信息
	 */
	public function get_collect_by_collect_id(){
		$collect_id = $this->_param('collect_id','htmlspecialchars,strip_tags');
		$isdetail=$this->_param('isdetail','htmlspecialchars,strip_tags',0);
		
		$result=D('Collect')->get_collect_by_id($collect_id,$isdetail);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	public function update_collect(){
		$collect_id=$this->_param('collect_id','htmlspecialchars,strip_tags');
		$data['collect_say']=$this->_param('share_say','htmlspecialchars,strip_tags');//用户
		$data['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');//用户
		$data['cuisine_id']=$this->_param('cuisine_id','htmlspecialchars,strip_tags');//菜式
		$data['article_id']=$this->_param('article_id','htmlspecialchars,strip_tags');//文章
		$data['store_id']=$this->_param('store_id','htmlspecialchars,strip_tags');//商家
		$data['community_id']=$this->_param('community_id','htmlspecialchars,strip_tags');//社区
		$data['good_id']=$this->_param('good_id','htmlspecialchars,strip_tags');//商品id
		$data['tag_id']=$this->_param('tag_id','htmlspecialchars,strip_tags');//标签id
		$data['order_id']=$this->_param('order_id','htmlspecialchars,strip_tags');//标签id
		$data['url']=$this->_param('url','htmlspecialchars,strip_tags');//标签id
	
		$result=D('Collect')->update_collectById($collect_id,$data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 删除收藏
	 */
	public function del_collect(){
		$collect_id=$this->_param('collect_id','htmlspecialchars,strip_tags');
		$result=D('Collect')->del_collect($collect_id);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
}