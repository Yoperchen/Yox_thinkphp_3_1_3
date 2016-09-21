<?php
// 租赁
//个人中心
class UserAction extends Action {
    public function index(){
//     	print_r($_SESSION);
        //检查登录
        if(session('account_type')!='user' && session('id')<1)
        {
            $message='没有登录，请先登录哦。';
            $this->error($message,'',$this->isAjax());
        }
		$this->display();
    }
	//个人信息
	public function profile()
	{
	    //检查登录
		if(session('account_type')!='user' && session('id')<1)
		{
		    $message='没有登录，请先登录哦。';
		    $this->error($message,'',$this->isAjax());
		}
		$condition['id']=session('?id')?session('id'):0;//默认id为1,测试用
		$condition['mobile_phone']=$this->_param('mobile','htmlspecialchars,strip_tags');
		$condition['email']=$this->_param('email','htmlspecialchars,strip_tags');
		$isdetail=$this->_param('isdetail','htmlspecialchars,strip_tags',0);
		$User=D('User');
		$result=$User->get_user_info($condition,$isdetail);
		
		if($this->isAjax())
		{
		    $this->ajaxReturn($result,$result['message'],$result['status']);
		}
		$this->assign('result',$result);
		$this->display();
		
    }
    //我的头像
    public function avatar(){
    	 
    	$this->display();
    }
    /**
     * 我的出租列表
     */
	public function rental_list()
	{
		$condition['rental_category_id']=$this->_param('rental_category_id','htmlspecialchars,strip_tags');//租用分类
		$condition['name']=$this->_param('name','htmlspecialchars,strip_tags');//出租名称|汽车名称、飞机名称、房号、单车、房子、场地名称
		$condition['owner_user_id']=session('id');//所有者id
// 		$condition['owner_store_id']=$this->_param('owner_store_id','htmlspecialchars,strip_tags');//所有者商家id
		$condition['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');//租的人，租车的人
		$condition['is_show']=$this->_param('is_show','htmlspecialchars,strip_tags');//是否开放
		$condition['rental_price']=$this->_param('rental_price','htmlspecialchars,strip_tags');//出租价格，单价
		$page_size=$this->_param('page_size','htmlspecialchars,strip_tags',20);//出租价格，单价
		
		$Rental  =   D('Rental');
		$result = $Rental->get_rental_list($condition, $page_size);
		
		if($this->isAjax())
		{
		    $this->ajaxReturn($result,$result['message'],$result['status']);
		}
		$this->assign('result',$result);
    	$this->display();
	}
	/**
	 * 修改租车信息
	 */
	public function update_rental()
	{
	    $id=$this->_param('id','htmlspecialchars,strip_tags');//租赁的id
	    $data['rental_category_id']=$this->_param('rental_category_id','htmlspecialchars,strip_tags');//租用分类
	    $data['name']=$this->_param('name','htmlspecialchars,strip_tags');//出租名称|汽车名称、飞机名称、房号、单车、房子、场地名称
	    $data['owner_user_id']=session('id');//所有者id
// 	    $data['owner_store_id']=$this->_param('owner_store_id','htmlspecialchars,strip_tags');//所有者商家id
	    $data['owner_name']=$this->_param('owner_name','htmlspecialchars,strip_tags');//所有者显示名称
	    $data['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');//租的人，租车的人
	    $data['next_user_id']=$this->_param('next_user_id','htmlspecialchars,strip_tags');//下一个租用者id
	    $data['total_price']=$this->_param('total_price','htmlspecialchars,strip_tags');//出租价格，总价
	    $data['rental_price']=$this->_param('rental_price','htmlspecialchars,strip_tags');//出租价格，单价
	    $data['time_unit']=$this->_param('time_unit','htmlspecialchars,strip_tags');//价格时间单位|月、日、年
	    $data['earnest_money']=$this->_param('earnest_money','htmlspecialchars,strip_tags');//定金
	    $data['rental_begin_time']=$this->_param('rental_begin_time','htmlspecialchars,strip_tags');//出租开始时间
	    $data['rental_end_time']=$this->_param('rental_end_time','htmlspecialchars,strip_tags');//定金
	    $data['next_rental_begin_time']=$this->_param('next_rental_begin_time','htmlspecialchars,strip_tags');//下一段租期开始时间
	    $data['next_rental_end_time']=$this->_param('next_rental_end_time','htmlspecialchars,strip_tags');//下段租期结束时间
	    $data['third_rental_begin_time']=$this->_param('third_rental_begin_time','htmlspecialchars,strip_tags');//第三段租期开始时间
	    $data['third_rental_end_time']=$this->_param('third_rental_end_time','htmlspecialchars,strip_tags');//第三段租期结束时间
	    $data['disable_start_time']=$this->_param('disable_start_time','htmlspecialchars,strip_tags');//禁用开始时间
	    $data['disable_end_time']=$this->_param('disable_end_time','htmlspecialchars,strip_tags');//禁用结束时间
	    $data['is_show']=$this->_param('is_show','htmlspecialchars,strip_tags');//是否开放
	    $data['production_time']=$this->_param('production_time','htmlspecialchars,strip_tags');//生产日期
	    $data['start_use_time']=$this->_param('start_use_time','htmlspecialchars,strip_tags');//汽车/房子、飞机、场地开始使用时间
	
	    $Rental  =   D('Rental');
	    $result = $Rental->update_rentalById($id,$data);
	    if($this->isAjax())
		{
		    $this->ajaxReturn($result,$result['message'],$result['status']);
		}
		$this->assign('result',$result);
    	$this->display();
	}
    /**
     * 我的文章列表
     */
    public function article_list()
    {
        //检查登录
        if(session('account_type')!='user' && session('id')<1)
        {
            $message='没有登录，请先登录哦。';
            $this->error($message,'',$this->isAjax());
        }
    	$condition['user_id']=session('?id')?session('id'):0;//默认id为1,测试用
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
     * 我的分享/收藏
     */
    public function collect_list()
    {
    	$condition['belong_user_id']=session('?id')?session('id'):-1;//默认id为1,测试用
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
    	if($this->isAjax())
    	{
    	    $this->success($result['message'],'',$this->isAjax());
    	}
    	$this->assign('result',$result);
    	$this->display();
    }
    /**
     * 添加我的收藏
     */
    public function add_collect()
    {
    	$data['belong_user_id']=session('?id')?session('id'):0;//默认id为1,测试用
    	$data['article_id']=$this->_param('article_id','htmlspecialchars,strip_tags');
    	$data['store_id']=$this->_param('store_id','htmlspecialchars,strip_tags');
    	$data['url']=$this->_param('url','htmlspecialchars,strip_tags');
    	$data['collect_say']=$this->_param('collect_say','htmlspecialchars,strip_tags');
    	if(!empty($data['url']) || !empty($data['collect_say'])){
    	$Collect=D('Collect');
    	$result = $Collect->add_collect($data);
   		 if($result['status']==1){
			$this->success('收藏成功', U('Yo81008/User/index'));
		}else{
			$this->error($result['message']);
		}
    	}else{
    		$this->display();
    	}
    }
    /**
     * 退出登录
     */
    public function logout()
    {
    	$User=D('User');
	if($User->logout()){
		$this->success('退出成功', U('Yo81008/Index/index'));
	}else{
		$this->error('退出失败', U('Yo81008/User/index'));
	}
    }
    
}