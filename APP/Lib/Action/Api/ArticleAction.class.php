<?php
/*
 * 通用文章
 */
class ArticleAction extends ApibaseAction {
	/*
	 * 添加文章
	 * index.php?g=api&m=Article&a=add_article&type=2&title=标题&desc=描述&content=内容
	 * 
	 * 添加公告
	 * index.php?g=api&m=Article&a=add_article&type=1&title=标题&desc=描述&content=内容
	*/
	public function add_article(){
		$data['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');
		$data['store_id']=$this->_param('store_id','htmlspecialchars,strip_tags');
		$data['title']=$this->_param('title','htmlspecialchars,strip_tags');
		$data['type']=$this->_param('type','htmlspecialchars,strip_tags');
		$data['category_id']=$this->_param('category_id','htmlspecialchars,strip_tags');//分类id
		$data['desc']=$this->_param('desc','htmlspecialchars,strip_tags');
		$data['content']=$this->_param('content','htmlspecialchars,strip_tags');
		$data['sort']=$this->_param('sort','htmlspecialchars,strip_tags');
		$data['from_url']=$this->_param('from_url','htmlspecialchars,strip_tags');
		$data['author']=$this->_param('author','htmlspecialchars,strip_tags');
		$data['community_id']=$this->_param('community_id','htmlspecialchars,strip_tags');
		$data['up']=$this->_param('up','htmlspecialchars,strip_tags');
		$data['down']=$this->_param('down','htmlspecialchars,strip_tags');
		$data['like']=$this->_param('like','htmlspecialchars,strip_tags');
		$data['status']=$this->_param('status','htmlspecialchars,strip_tags');
		$data['view']=$this->_param('view','htmlspecialchars,strip_tags');
		$data['img1']=$this->_param('img1','htmlspecialchars,strip_tags');
		$data['img2']=$this->_param('img2','htmlspecialchars,strip_tags');
		$data['img3']=$this->_param('img3','htmlspecialchars,strip_tags');
		$result=D('Article')->add_article($data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 获取公告列表
	 * index.php?g=api&m=Article&a=get_article_list&type=1
	 * 
	 * 获取文章列表
	 * index.php?g=api&m=Article&a=get_article_list&type=2
	 * 
	 * 获取商家公告列表
	 * index.php?g=api&m=Article&a=get_article_list&type=1&store_id=商家id
	 * 
	 * 获取商家文章列表
	 * index.php?g=api&m=Article&a=get_article_list&type=2&store_id=商家id
	 * 
	 * 获取用户公告列表
	 * index.php?g=api&m=Article&a=get_article_list&type=1&user_id=用户id
	 * 
	 * 获取用户文章列表
	 * index.php?g=api&m=Article&a=get_article_list&type=2&user_id=用户id
	 * 
	 */
	public function get_article_list(){
		$condition['type']=$this->_param('type','htmlspecialchars,strip_tags');
		$condition['store_id']=$this->_param('store_id','htmlspecialchars,strip_tags');
		$condition['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');//用户
		$page_size=$this->_param('page_size','htmlspecialchars,strip_tags',12);//每页几条
		
		$result=D('Article')->get_article_list($condition,$page_size);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 获取文章、获取公告
	 * index.php?g=api&m=Article&a=get_article_by_id&id=文章id
	 * 
	 */
	public function get_article_by_id(){
		$id=I('param.id','','htmlspecialchars');
		$isdetail=I('param.isdetail','','htmlspecialchars');
		$result=D('Article')->getArticleById($id,$isdetail);
		
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 修改文章，修改公告
	 * index.php?g=api&m=Article&a=update_article&id=文章id&title=标题&content=内容
	 * 
	 */
	public function update_article(){
		$id=$this->_param('id','htmlspecialchars,strip_tags');
		$data['title']=$this->_param('title','htmlspecialchars,strip_tags');
		$data['content']=$this->_param('content','htmlspecialchars,strip_tags');
		$data['desc']=$this->_param('desc','htmlspecialchars,strip_tags');
		$data['type']=$this->_param('type','htmlspecialchars,strip_tags');//1:公告;2:普通文章;3:论坛贴;4日志;5说说
		$data['category_id']=$this->_param('category_id','htmlspecialchars,strip_tags');//分类id
		$data['sort']=$this->_param('sort','htmlspecialchars,strip_tags');
		$data['from_url']=$this->_param('from_url','htmlspecialchars,strip_tags');
		$data['author']=$this->_param('author','htmlspecialchars,strip_tags');
		$data['community_id']=$this->_param('community_id','htmlspecialchars,strip_tags');
		$data['up']=$this->_param('up','htmlspecialchars,strip_tags');
		$data['down']=$this->_param('down','htmlspecialchars,strip_tags');
		$data['like']=$this->_param('like','htmlspecialchars,strip_tags');
		$data['status']=$this->_param('status','htmlspecialchars,strip_tags');
		$data['view']=$this->_param('view','htmlspecialchars,strip_tags');
		$data['img1']=$this->_param('img1','htmlspecialchars,strip_tags');
		$data['img2']=$this->_param('img2','htmlspecialchars,strip_tags');
		$data['img3']=$this->_param('img3','htmlspecialchars,strip_tags');
		
		$result=D('Article')->update_articleById($id,$data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * index.php?g=api&m=Article&a=del_article&id=文章id
	 * 删除
	 */
	public function del_article(){
		$article_id=$this->_param('article_id','htmlspecialchars,strip_tags');
		$result=D('Article')->del_article($article_id);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	//添加评论
	public function add_comment(){
		$data['up_id']=$this->_param('up_id','htmlspecialchars,strip_tags');
		$data['belong_user_id']=$this->_param('belong_user_id','htmlspecialchars,strip_tags');//谁评论的
		$data['belong_store_id']=$this->_param('belong_store_id','htmlspecialchars,strip_tags');//谁评论的
		$data['article_id']=$this->_param('article_id','htmlspecialchars,strip_tags');//被评论的文章
		$data['goods_id']=$this->_param('good_id','htmlspecialchars,strip_tags');//被评论的商品
		$data['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');//被评论的用户
		$data['store_id']=$this->_param('store_id','htmlspecialchars,strip_tags');//被评论的商家
		$data['share_id']=$this->_param('share_id','htmlspecialchars,strip_tags');//被评论的分享
		$data['mobile']=$this->_param('mobile','htmlspecialchars,strip_tags');
		$data['nick_name']=$this->_param('nick_name','htmlspecialchars,strip_tags');
		$data['title']=$this->_param('title','htmlspecialchars,strip_tags');//评论的标题
		$data['content']=$this->_param('content','htmlspecialchars,strip_tags');//评论的内容
		$data['reply_content']=$this->_param('reply_content','htmlspecialchars,strip_tags');//管理员回复的内容
		$data['reply_admin_id']=$this->_param('reply_admin_id','htmlspecialchars,strip_tags');
		$data['status']=$this->_param('status','htmlspecialchars,strip_tags');
		$data['ip']=$this->_param('ip','htmlspecialchars,strip_tags');
		$data['email']=$this->_param('email','htmlspecialchars,strip_tags');
		$data['district_id']=$this->_param('district_id','htmlspecialchars,strip_tags');//地区id,对应district表
		$data['community_id']=$this->_param('community_id','htmlspecialchars,strip_tags');//社区id,对应community表|医院、学校、小区
		$Comment=D('Comment');
		$result=$Comment->add_comment($data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	//评论列表
	public function get_article_comment_list(){
		$condition['share_id']=$this->_param('share_id','htmlspecialchars,strip_tags');
		$condition['article_id']=$this->_param('article_id','htmlspecialchars,strip_tags');
		$condition['mobile']=$this->_param('mobile','htmlspecialchars,strip_tags');
		$condition['goods_id']=$this->_param('good_id','htmlspecialchars,strip_tags');
		$condition['email']=$this->_param('email','htmlspecialchars,strip_tags');
		$condition['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');
		$condition['store_id']=$this->_param('store_id','htmlspecialchars,strip_tags');
		$condition['district_id']=$this->_param('district_id','htmlspecialchars,strip_tags');//地区id,对应district表
		$condition['community_id']=$this->_param('community_id','htmlspecialchars,strip_tags');//社区id,对应community表|医院、学校、小区
		$page_size=$this->_param('page_size','htmlspecialchars,strip_tags',12);//每页几条
		$Comment=D('Comment');
		$result=$Comment->get_comment_list($condition,$page_size);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	//删除
	public function del_comment(){
		$condition['id']=$this->_param('id','htmlspecialchars,strip_tags');
		$Comment=D('Comment');
		$result=$Comment->del_comment($condition);
		header("Content-type: text/html; charset=utf-8");
	}
	//获取单条评论信息
	 public function get_comment_by_commentid(){
	 	$id=$this->_param('id','htmlspecialchars,strip_tags');
	 	$isdetail=$this->_param('id','htmlspecialchars,strip_tags',0);
	 	$Comment=D('Comment');
	 	$result=$Comment->get_comment_by_id($id,$isdetail);
	 	header("Content-type: text/html; charset=utf-8");
	 	exit(json_encode($result));
	 }

}