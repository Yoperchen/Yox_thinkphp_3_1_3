<?php
// 网址导航PC
class AdminAction extends Action {
    public function index(){
    	$result = D('Partner_site')->get_login_site_info();
    	if($result['data']['is_login']!=1){//未登录
    		$this->error($result['message'],U('Yo81009/Admin/site_login'));//跳去登录页
    	}
    	
		$this->display();
    }
	//登陆
	public function site_login(){
		$id = $this->_param('id','htmlspecialchars,strip_tags');
		$password = $this->_param('password','htmlspecialchars,strip_tags');
		if(!empty($id) && !empty($password)){
			
			$result = D('Partner_site')->site_login($id,$password);
			if($result['status']==1){
				$this->success($result['message'],U('Yo81009/Admin/index'));
			}else{
				$this->error($result['message']);
			}
			
		}else{
			$this->display();
		}
    }
	//退出
	public function site_logout(){
		if(D('Partner_site')->logout()){
			$this->success('退出登录成功');
		}else{
			$this->error('退出失败！！');
		}
// 		$this->display();
    }
    public function site_register(){
    	$site_name = $this->_param('site_name','htmlspecialchars,strip_tags');
    	$email = $this->_param('email','htmlspecialchars,strip_tags');
    	$password = $this->_param('password','htmlspecialchars,strip_tags');
    	$signup_confirm_password = $this->_param('signup_confirm_password','htmlspecialchars,strip_tags');
    	if($password!=$signup_confirm_password)$this->error('密码前后不一致',U('Yo81009/Admin/site_register'));
    	if(!empty($password)){
    		$data=array();
    		$data['site_name']=$site_name;
    		$data['email']=$email;
    		$data['password']=$password;
    		$result = D('Partner_site')->register($data);
    		if($result['status']==1){
    			$this->success($result['message'],U('Yo81009/Admin/site_login'));
    		}else{
    			$this->error($result['message'],U('Yo81009/Admin/site_register'));
    		}
    		
    	}
    	
    	
    	$this->display();
    }
	//添加文章
	public function add_article(){
		$title = $this->_param('title','htmlspecialchars,strip_tags');
		if(!empty($title)){
		$data['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');
		$data['site_id']=session('id');
		$data['store_id']=$this->_param('store_id','htmlspecialchars,strip_tags');
		$data['title']=$this->_param('title','htmlspecialchars,strip_tags');
		$data['type']=$this->_param('type','htmlspecialchars,strip_tags');
		$data['category_id']=$this->_param('category_id','htmlspecialchars,strip_tags');//分类id
		$data['desc']=$this->_param('desc','htmlspecialchars,strip_tags');
		$data['content']=$this->_param('content','htmlspecialchars,strip_tags');
		$data['sort']=$this->_param('sort','htmlspecialchars,strip_tags');
		$result=D('Article')->add_article($data);
			if($result['status']!=1){
				$this->error($result['message']);
			}else{
				$this->success($result['message']);
			}
		}else{
			$article_category_result = D('Article_category')->get_article_category_list($category_condition,$page_size=20);
			$this->assign('article_category_result',$article_category_result);
			$this->display();
		}
    }
    //删除文章
	public function del_article(){
		$article_id=$this->_param('article_id','htmlspecialchars,strip_tags');
		$result=D('Article')->del_article($article_id);
		if($result['status']!=1){
			$this->error($result['message']);
		}else{
			$this->success($result['message']);
		}
		//$this->display();
    }
	//获取文章
	public function get_article(){
		$id=$this->_param('id','htmlspecialchars,strip_tags',1);
		$isdetail=$this->_param('isdetail','htmlspecialchars,strip_tags');
		$result=D('Article')->getArticleById($id,$isdetail);
		$this->assign('result',$result);
		if($result['status']!=1){
			$this->error($result['message']);
		}
		$this->display();
    }
    //获取文章列表
	public function get_article_list(){
		$condition['type']=$this->_param('type','htmlspecialchars,strip_tags');
		$condition['store_id']=$this->_param('store_id','htmlspecialchars,strip_tags');
		$condition['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');//用户
		$page_size=$this->_param('page_size','htmlspecialchars,strip_tags',12);//每页几条
		
		$result=D('Article')->get_article_list($condition,$page_size);
		if($result['status']!=1){
			$this->error($result['message']);
		}
		//print_r($result);
		$this->assign('result',$result);
		$this->display();
    }
    //修改文章
	public function update_article(){
		$id=$this->_param('id','htmlspecialchars,strip_tags');
		$data['title']=$this->_param('title','htmlspecialchars,strip_tags');
		$data['content']=$this->_param('content','htmlspecialchars,strip_tags');
		$data['desc']=$this->_param('desc','htmlspecialchars,strip_tags');
		if(!empty($data['title'])&&!empty($data['content'])){
		
		$result=D('Article')->update_articleById($id,$data);
		if($result['status']!=1){
			$this->error($result['message']);
		}else{
			$this->success($result['message']);
		}
		}else{
		$id=$this->_param('id','htmlspecialchars,strip_tags',1);
		$isdetail=$this->_param('isdetail','htmlspecialchars,strip_tags');
		$result=D('Article')->getArticleById($id,$isdetail);
		$this->assign('result',$result);
		if($result['status']!=1){
			$this->error($result['message']);
		}
			$article_category_result = D('Article_category')->get_article_category_list($category_condition,$page_size=20);
			$this->assign('article_category_result',$article_category_result);
		}
		$this->display();
    }
	//站点列表
	//public function get_site_list(){
	//	$this->display();
    //}
	//站点设置
	public function site_setting(){
		$this->display();
    }
	//站点导航
	public function site_nav(){
		$condition['site_id']=$this->_param('site_id','htmlspecialchars,strip_tags',7);//站点id
		$navigation_result = D('Navigation')->get_navigation_list($condition);
		$this->display();
    }
}