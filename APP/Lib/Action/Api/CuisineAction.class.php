<?php
/*
 * 菜式
 */
class CuisineAction extends ApibaseAction {
	/*
	 * 添加菜式
	*/
	public function add_cuisine(){
		$data['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');
		$data['store_id']=$this->_param('store_id','htmlspecialchars,strip_tags');
		$data['category_id']=$this->_param('category_id','htmlspecialchars,strip_tags');
		$data['name']=$this->_param('name','htmlspecialchars,strip_tags');
		$data['keywords']=$this->_param('keywords','htmlspecialchars,strip_tags');
		$data['desc']=$this->_param('desc','htmlspecialchars,strip_tags');
		$data['body']=$this->_param('body','htmlspecialchars,strip_tags');
		$data['ingredients']=$this->_param('ingredients','htmlspecialchars,strip_tags');//主料
		$data['seasoning']=$this->_param('seasoning','htmlspecialchars,strip_tags');//配料
		$data['kitchenware']=$this->_param('kitchenware','htmlspecialchars,strip_tags');//厨具
		$data['up']=$this->_param('up','htmlspecialchars,strip_tags');//顶、推荐
		$data['down']=$this->_param('down','htmlspecialchars,strip_tags');//不推荐
		$data['like']=$this->_param('like','htmlspecialchars,strip_tags');//喜欢人数
		
		$result=D('Cuisine')->add_cuisine($data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 获取菜式列表
	 * index.php?g=api&m=Article&a=get_article_list&type=2&user_id=用户id
	 * 
	 */
	public function get_cuisine_list(){
		$condition['category_id']=$this->_param('category_id','htmlspecialchars,strip_tags');//分类
		$condition['store_id']=$this->_param('store_id','htmlspecialchars,strip_tags');//商家
		$condition['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');//用户
		$page_size=$this->_param('page_size','htmlspecialchars,strip_tags',12);//每页几条
		
		$result=D('Cuisine')->get_cuisine_list($condition,$page_size);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 获取菜式
	 * index.php?g=api&m=Article&a=get_article_by_id&id=文章id
	 * 
	 */
	public function get_cuisine_by_id(){
		$id=$this->_param('id','htmlspecialchars,strip_tags');
		$isdetail=$this->_param('isdetail','htmlspecialchars,strip_tags');
		$result=D('Cuisine')->getCuisineById($id,$isdetail);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 修改文章，修改公告
	 * index.php?g=api&m=Article&a=update_article&id=文章id&title=标题&content=内容
	 * 
	 */
	public function update_cuisine(){
		$id=$this->_param('cuisine_id','htmlspecialchars,strip_tags');
		$data['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');
		$data['store_id']=$this->_param('store_id','htmlspecialchars,strip_tags');
		$data['category_id']=$this->_param('category_id','htmlspecialchars,strip_tags');
		$data['name']=$this->_param('name','htmlspecialchars,strip_tags');
		$data['keywords']=$this->_param('keywords','htmlspecialchars,strip_tags');
		$data['desc']=$this->_param('desc','htmlspecialchars,strip_tags');
		$data['body']=$this->_param('body','htmlspecialchars,strip_tags');
		$data['ingredients']=$this->_param('ingredients','htmlspecialchars,strip_tags');//主料
		$data['seasoning']=$this->_param('seasoning','htmlspecialchars,strip_tags');//配料
		$data['kitchenware']=$this->_param('kitchenware','htmlspecialchars,strip_tags');//厨具
		$data['up']=$this->_param('up','htmlspecialchars,strip_tags');//顶、推荐
		$data['down']=$this->_param('down','htmlspecialchars,strip_tags');//不推荐
		$data['like']=$this->_param('like','htmlspecialchars,strip_tags');//喜欢人数
		
		$result=D('Cuisine')->update_cuisineById($id,$data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * index.php?g=api&m=Article&a=del_article&id=文章id
	 * 删除
	 */
	public function del_cuisine(){
		$id=$this->_param('id','htmlspecialchars,strip_tags');
		$result=D('cuisine')->del_cuisine($id);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}

}