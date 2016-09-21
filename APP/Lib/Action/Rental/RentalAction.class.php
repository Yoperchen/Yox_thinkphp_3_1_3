<?php
/**
 * 租赁、租飞机、租车、租房、拼车
 * @author Yoper
 *
 */
class RentalAction extends ApibaseAction {
	
	/**
	 * 获取租车列表
	 */
	public function rental_list()
	{
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
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));//json格式数据
	}
	/**
	 * 获取租车信息
	 */
	public function get_rental_info()
	{
		$id=$this->_param('id','htmlspecialchars,strip_tags');//租赁的id
		$isdetail=$this->_param('isdetail','htmlspecialchars,strip_tags',0);//租赁的id
		
		$Rental  =   D('Rental');
		$result = $Rental->get_rental_info_by_id($id,$isdetail);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));//json格式数据
	}
	/**
	 * 添加租车信息
	 */
	public function add_rental()
	{
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
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));//json格式数据
		
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
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));//json格式数据
	}
	/**
	 * 租用下一段时间 或 第三端时间
	 */
	public function rental_next(){
		$rental_id       	   =$this->_param('rental_id','htmlspecialchars,strip_tags');//租赁的id
		$next_user_id          =$this->_param('user_id','htmlspecialchars,strip_tags');//用户的id
		$next_rental_start_time=$this->_param('rental_begin_time','htmlspecialchars,strip_tags');//租用开始时间
		$next_rental_end_time  =$this->_param('rental_end_time','htmlspecialchars,strip_tags');//租用结束时间
		
		$Rental  =   D('Rental');
		$result = $Rental->rental($rental_id, $next_user_id, $next_rental_start_time, $next_rental_end_time);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));//json格式数据
	}
	/**
	 * 删除租赁
	 */
	public function del_rental(){
		$rental_id = $this->_param('rental_id','htmlspecialchars,strip_tags');//租赁的id
		
		$Rental  =   D('Rental');
		$result = $Rental->del_rental($rental_id);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));//json格式数据
	}
	/**
	 * 添加出租分类
	 */
	public function add_rental_category()
	{
		$data['user_id']      =$this->_param('user_id','htmlspecialchars,strip_tags');//用户的id
		$data['store_id ']    =$this->_param('store_id','htmlspecialchars,strip_tags');//商家的id
		$data['pid']          =$this->_param('pid','htmlspecialchars,strip_tags');//父级
		$data['name']         =$this->_param('name','htmlspecialchars,strip_tags');//分类名称
		$data['sort']         =$this->_param('sort','htmlspecialchars,strip_tags');//排序
		$data['is_show']      =$this->_param('is_show','htmlspecialchars,strip_tags');//是否显示
		
		$Rental  =   D('Rental_category');
		$result = $Rental->add_rental_category($data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));//json格式数据
	}
	/**
	 * 修改出租分类
	 */
	public function update_rental_category()
	{
		$id			         =$this->_param('id','htmlspecialchars,strip_tags');//用户的id
		$data['user_id']     =$this->_param('user_id','htmlspecialchars,strip_tags');//用户的id
		$data['store_id ']   =$this->_param('store_id','htmlspecialchars,strip_tags');//商家的id
		$data['pid']         =$this->_param('pid','htmlspecialchars,strip_tags');//父级
		$data['name']        =$this->_param('name','htmlspecialchars,strip_tags');//分类名称
		$data['sort']        =$this->_param('sort','htmlspecialchars,strip_tags');//排序
		$data['is_show']     =$this->_param('is_show','htmlspecialchars,strip_tags');//是否显示
		
		$Rental  =   D('Rental_category');
		$result = $Rental->update_rental_categoryById($id,$data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));//json格式数据
	}
	/**
	 * 获取出租分类列表
	 */
	public function get_rental_category_list(){
		$condition['user_id']     =$this->_param('user_id','htmlspecialchars,strip_tags');//用户的id
		$condition['store_id ']   =$this->_param('store_id','htmlspecialchars,strip_tags');//商家的id
		$condition['pid']         =$this->_param('pid','htmlspecialchars,strip_tags');//父级
		$condition['name']        =$this->_param('name','htmlspecialchars,strip_tags');//分类名称
		$condition['is_show']     =$this->_param('is_show','htmlspecialchars,strip_tags');//是否显示
		$page_size				  =$this->_param('page_size','htmlspecialchars,strip_tags');//是否显示
		
		$Rental  =   D('Rental_category');
		$result = $Rental->get_rental_category_list($condition,$page_size);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));//json格式数据
	}
	/**
	 * 获取分类详细信息
	 */
	public function get_rental_category_info(){
		$id = $this->_param('id','htmlspecialchars,strip_tags',0);//分类id
		
		$Rental  =   D('Rental_category');
		$result = $Rental->get_rental_categoryById($id);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));//json格式数据
	}
	/**
	 * 删除出租分类
	 */
	public function del_rental_category(){
		$id = $this->_param('id','htmlspecialchars,strip_tags');//用户的id
		
		$Rental  =   D('Rental_category');
		$result = $Rental->del_rental_category($id);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));//json格式数据
	}
}