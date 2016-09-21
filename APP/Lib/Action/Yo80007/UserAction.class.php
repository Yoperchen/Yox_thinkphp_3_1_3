<?php
// 门户网站PC
class UserAction extends Action {
    public function index(){
		$this->display();
    }
	//登录
    public function login(){
    	$id=$this->_param('id','htmlspecialchars,strip_tags');
	$password=$this->_param('password','htmlspecialchars,strip_tags');

 	if(!empty($id)&&!empty($password)){
		$User=D('User');
		$result= $User->user_login($id , $password);
		if($result['status']==1){
			$this->success('登录成功', U('Yo80007/User/index'));
		}else{
			$this->error($result['message']);
		}
	}else{
		$this->display();
		}
    }
	//个人信息
	public function profile(){
		$condition['id']=session('?id')?session('id'):1;//默认id为1,测试用
		$condition['mobile_phone']=$this->_param('mobile','htmlspecialchars,strip_tags');
		$condition['email']=$this->_param('email','htmlspecialchars,strip_tags');
		$isdetail=$this->_param('isdetail','htmlspecialchars,strip_tags',0);
		$User=D('User');
		$result=$User->get_user_info($condition,$isdetail);
		if($result['status']!=1){
			$this->error($result['message']);
		}
		$this->display();
		
    }
    //头像
    public function avatar(){
    	 
    	$this->display();
    }
    /**
     * 文章列表
     */
    public function article_list(){
    	$condition['user_id']=session('?id')?session('id'):1;//默认id为1,测试用
    	$condition['type']=$this->_param('type','htmlspecialchars,strip_tags');
    	$condition['store_id']=$this->_param('store_id','htmlspecialchars,strip_tags');
    	$condition['tag_id']=$this->_param('tag_id','htmlspecialchars,strip_tags');
    	$page_size=$this->_param('page_size','htmlspecialchars,strip_tags');
    	$Article=D('Article');
    	$result = $Article->get_article_list($condition,$page_size=20);
    	
    	$this->assign('result',$result);
    	$this->display();
    }
    /**
     * 分享/收藏
     */
    public function collect_list(){
    	$condition['belong_user_id']=session('?id')?session('id'):1;//默认id为1,测试用
    	$condition['article_id']=$this->_param('article_id','htmlspecialchars,strip_tags');
    	$condition['store_id']=$this->_param('store_id','htmlspecialchars,strip_tags');
    	$condition['good_id']=$this->_param('good_id','htmlspecialchars,strip_tags');
    	$condition['cuisine_id']=$this->_param('cuisine_id','htmlspecialchars,strip_tags');
    	$condition['rental_id']=$this->_param('rental_id','htmlspecialchars,strip_tags');
    	$condition['order_id']=$this->_param('order_id','htmlspecialchars,strip_tags');
    	$condition['community_id']=$this->_param('community_id','htmlspecialchars,strip_tags');
    	
    	$page_size=$this->_param('page_size','htmlspecialchars,strip_tags');
    	$Collect=D('Collect');
    	$result = $Collect->get_collect_list( $condition, $page_size=15);
    	
    	$this->assign('result',$result);
    	$this->display();
    }
    /**
     * 添加收藏
     */
    public function add_collect(){
    	$data['belong_user_id']=session('?id')?session('id'):1;//默认id为1,测试用
    	$data['article_id']=$this->_param('article_id','htmlspecialchars,strip_tags');
    	$data['store_id']=$this->_param('store_id','htmlspecialchars,strip_tags');
    	$data['url']=$this->_param('url','htmlspecialchars,strip_tags');
    	$data['collect_say']=$this->_param('collect_say','htmlspecialchars,strip_tags');
    	if(!empty($data['url']) || !empty($data['collect_say'])){
    	$Collect=D('Collect');
    	$result = $Collect->add_collect($data);
   		 if($result['status']==1){
			$this->success('登录成功', U('Yo80007/User/index'));
		}else{
			$this->error($result['message']);
		}
    	}else{
    		$this->display();
    	}
    }
    
    public function logout(){
    	$User=D('User');
	if($User->logout()){
		$this->success('退出成功', U('Yo80007/Index/index'));
	}else{
		$this->error('退出失败', U('Yo80007/User/index'));
	}
    }
    
}