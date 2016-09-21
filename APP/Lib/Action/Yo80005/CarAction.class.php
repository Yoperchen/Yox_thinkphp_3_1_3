<?php
// 租赁PC
class CarAction extends Action {
    public function index(){
		$this->display();
    }
    /**
     * 列表
     */
    public function rental_list(){
		$condition['rental_category_id']=$this->_param('rental_category_id','htmlspecialchars,strip_tags');//租用分类
		$condition['name']=$this->_param('name','htmlspecialchars,strip_tags');//出租名称|汽车名称、飞机名称、房号、单车、房子、场地名称
		$condition['owner_user_id']=$this->_param('owner_user_id','htmlspecialchars,strip_tags');//所有者id
		$condition['owner_store_id']=$this->_param('owner_store_id','htmlspecialchars,strip_tags');//所有者商家id
		$condition['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');//租的人，租车的人
		$condition['is_show']=$this->_param('is_show','htmlspecialchars,strip_tags');//是否开放
		$condition['rental_price']=$this->_param('rental_price','htmlspecialchars,strip_tags');//出租价格，单价
		$page_size=$this->_param('page_size','htmlspecialchars,strip_tags',20);//出租价格，单价
			
		$Rental  =   D('Rental');
		$result = $Rental->get_rental_list($condition, $page_size);
		//print_r($result);
		$this->assign('result',$result);
    	$this->display();
    }
    public function car_list(){
		$condition['rental_category_id']=$this->_param('rental_category_id','htmlspecialchars,strip_tags');//租用分类
		$condition['name']=$this->_param('name','htmlspecialchars,strip_tags');//出租名称|汽车名称、飞机名称、房号、单车、房子、场地名称
		$condition['owner_user_id']=$this->_param('owner_user_id','htmlspecialchars,strip_tags');//所有者id
		$condition['owner_store_id']=$this->_param('owner_store_id','htmlspecialchars,strip_tags');//所有者商家id
		$condition['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');//租的人，租车的人
		$condition['is_show']=$this->_param('is_show','htmlspecialchars,strip_tags');//是否开放
		$condition['rental_price']=$this->_param('rental_price','htmlspecialchars,strip_tags');//出租价格，单价
		$page_size=$this->_param('page_size','htmlspecialchars,strip_tags',20);//出租价格，单价
    		$Rental  =   D('Rental');
		$result = $Rental->get_rental_list($condition, $page_size);
		//print_r($result);
		$this->assign('result',$result);
		$this->assign('condition',$condition);
		$this->display();
    }
    /**
     * 添加租车信息
     */
    public function add_rental(){
    	$data['rental_category_id']=$this->_param('rental_category_id','htmlspecialchars,strip_tags');//租用分类
    	$data['name']=$this->_param('name','htmlspecialchars,strip_tags');//出租名称|汽车名称、飞机名称、房号、单车、房子、场地名称
    	$data['owner_user_id']=$this->_param('owner_user_id','htmlspecialchars,strip_tags');//所有者id
    	$data['owner_store_id']=$this->_param('owner_store_id','htmlspecialchars,strip_tags');//所有者商家id
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
    	$result = $Rental->add_rental($data);
    	//print_r($result);
		$this->assign($result);
    	$this->display();
    }
    /**
     * 租用
     */
    public function rental(){
    	$rental_id        =$this->_param('rental_id','htmlspecialchars,strip_tags');//租赁的id
    	$user_id          =$this->_param('user_id','htmlspecialchars,strip_tags');//用户的id
    	$rental_begin_time=$this->_param('rental_begin_time','htmlspecialchars,strip_tags');//租用开始时间
    	$rental_end_time  =$this->_param('rental_end_time','htmlspecialchars,strip_tags');//租用结束时间
    
    	$Rental  =   D('Rental');
    	$result = $Rental->rental($rental_id, $user_id, $rental_begin_time, $rental_end_time);
    	//print_r($result);
		$this->assign($result);
    	$this->display();
    }
}