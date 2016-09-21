<?php
/*
 * 通用缴费/价格策略
 */
class TollAction extends ApibaseAction {
	/*
	 * 添加通用缴费
	*/
	public function add_toll(){
		$data['type']=$this->_param('type','htmlspecialchars,strip_tags');
		$data['price_strategy']=$this->_param('price_strategy','htmlspecialchars,strip_tags');
		$data['total_cost']=$this->_param('total_cost','htmlspecialchars,strip_tags');
		$data['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');
		$data['time_period']=$this->_param('time_period','htmlspecialchars,strip_tags');
		$data['user_amount_or_number']=$this->_param('user_amount_or_number','htmlspecialchars,strip_tags');
		$data['responsible_person']=$this->_param('responsible_person','htmlspecialchars,strip_tags');
		$data['add_userid']=$this->_param('add_userid','htmlspecialchars,strip_tags');
		$data['serial_number']=$this->_param('serial_number','htmlspecialchars,strip_tags');//编号|房间号、宿舍等，如：17-507
		$result=D('Toll')->add_toll($data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 获取缴费列表
	 */
	public function get_toll_list(){
		$condition['type']=$this->_param('type','htmlspecialchars,strip_tags');
		$condition['store_id']=$this->_param('store_id','htmlspecialchars,strip_tags');
		$condition['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');//用户
		$page_size=$this->_param('page_size','htmlspecialchars,strip_tags',12);//每页几条
		
		$result=D('Toll')->get_toll_list($condition,$page_size);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 获取指定收费信息
	 * index.php?g=api&m=Article&a=get_article_by_id&id=文章id
	 * 
	 */
	public function get_toll_by_id(){
		$id=$this->_param('id','htmlspecialchars,strip_tags');
		$isdetail=$this->_param('isdetail','htmlspecialchars,strip_tags');
		$result=D('Toll')->getTollById($id,$isdetail);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 修改收费信息
	 * index.php?g=api&m=Article&a=update_article&id=文章id&title=标题&content=内容
	 * 
	 */
	public function update_toll(){
		$id=$this->_param('id','htmlspecialchars,strip_tags');
		$data['type']=$this->_param('type','htmlspecialchars,strip_tags');
		$data['price_strategy']=$this->_param('price_strategy','htmlspecialchars,strip_tags');
		$data['total_cost']=$this->_param('total_cost','htmlspecialchars,strip_tags');
		$data['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');
		$data['time_period']=$this->_param('time_period','htmlspecialchars,strip_tags');
		$data['user_amount_or_number']=$this->_param('user_amount_or_number','htmlspecialchars,strip_tags');
		$data['responsible_person']=$this->_param('responsible_person','htmlspecialchars,strip_tags');
		$data['add_userid']=$this->_param('add_userid','htmlspecialchars,strip_tags');
		$data['serial_number']=$this->_param('serial_number','htmlspecialchars,strip_tags');//编号|房间号、宿舍等，如：17-507
		$result=D('Toll')->update_tollById($id,$data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * index.php?g=api&m=Article&a=del_article&id=文章id
	 * 删除
	 */
	public function del_toll(){
		$id=$this->_param('id','htmlspecialchars,strip_tags');
		$result=D('Toll')->del_toll($id);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	
	/**
	 * 添加价格策略
	 */
	public function add_price_strategy(){
		$data['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');
		$data['name']=$this->_param('name','htmlspecialchars,strip_tags');//水费、电费、蔬菜
		$data['remark']=$this->_param('remark','htmlspecialchars,strip_tags');//备注
		$data['low_price']=$this->_param('low_price','htmlspecialchars,strip_tags');
		$data['standard_price']=$this->_param('standard_price','htmlspecialchars,strip_tags');
		$data['up_settlement_price']=$this->_param('up_settlement_price','htmlspecialchars,strip_tags');
		$data['down_settlement_price']=$this->_param('down_settlement_price','htmlspecialchars,strip_tags');
		$data['discounts']=$this->_param('discounts','htmlspecialchars,strip_tags');
		$data['formula']=$this->_param('formula','htmlspecialchars,strip_tags');
		$data['unit_price']=$this->_param('unit_price','htmlspecialchars,strip_tags');
		$data['time_unit']=$this->_param('time_unit','htmlspecialchars,strip_tags');
		$data['currency_unit']=$this->_param('currency_unit','htmlspecialchars,strip_tags');
		$data['number_unit']=$this->_param('number_unit','htmlspecialchars,strip_tags');
		$data['enable_time_period']=$this->_param('enable_time_period','htmlspecialchars,strip_tags');
		$result=D('Price_strategy')->add_price_strategy($data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	
	/**
	 * 获取价格策略列表
	 */
	public function get_price_strategy_list(){
// 		$condition['type']=$this->_param('type','htmlspecialchars,strip_tags');
// 		$condition['store_id']=$this->_param('store_id','htmlspecialchars,strip_tags');
		$condition['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');//用户id
		$page_size=$this->_param('page_size','htmlspecialchars,strip_tags',12);//每页几条
		
		$result=D('Price_strategy')->get_price_strategy_list($condition,$page_size);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 获取指定价格策略信息
	 */
	public function get_price_strategy_by_id(){
		$id=$this->_param('id','htmlspecialchars,strip_tags');
		$isdetail=$this->_param('isdetail','htmlspecialchars,strip_tags');
		$result=D('Price_strategy')->get_price_strategyById($id);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 修改价格策略
	 */
	public function update_price_strategy(){
		$id=$this->_param('id','htmlspecialchars,strip_tags');
		$data['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');
		$data['name']=$this->_param('name','htmlspecialchars,strip_tags');//水费、电费、蔬菜
		$data['remark']=$this->_param('remark','htmlspecialchars,strip_tags');//备注
		$data['low_price']=$this->_param('low_price','htmlspecialchars,strip_tags');//最低价
		$data['standard_price']=$this->_param('standard_price','htmlspecialchars,strip_tags');//标准价
		$data['up_settlement_price']=$this->_param('up_settlement_price','htmlspecialchars,strip_tags');//对上结算价
		$data['down_settlement_price']=$this->_param('down_settlement_price','htmlspecialchars,strip_tags');//对下结算价
		$data['discounts']=$this->_param('discounts','htmlspecialchars,strip_tags');//折扣|0.7折、0.8折
		$data['formula']=$this->_param('formula','htmlspecialchars,strip_tags');//计算公式
		$data['unit_price']=$this->_param('unit_price','htmlspecialchars,strip_tags');//单价
		$data['time_unit']=$this->_param('time_unit','htmlspecialchars,strip_tags');//时间单位
		$data['currency_unit']=$this->_param('currency_unit','htmlspecialchars,strip_tags');//货币单位
		$data['number_unit']=$this->_param('number_unit','htmlspecialchars,strip_tags');//数量单位
		$data['enable_time_period']=$this->_param('enable_time_period','htmlspecialchars,strip_tags');//时间段
	
		$result=D('Price_strategy')->update_tollById($id,$data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
}