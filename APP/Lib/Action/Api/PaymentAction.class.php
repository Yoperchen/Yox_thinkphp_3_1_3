<?php
/*
 * 通用支付
 */
class PaymentAction extends ApibaseAction {
	/**
	*添加订单
	*/
	public function set_order(){
		$data['pay_money_user_id']=$this->_param('pay_money_user_id','htmlspecialchars,strip_tags');//支付用户id
// 		$data['get_money_user_id']=$this->_param('get_money_user_id','htmlspecialchars,strip_tags');//支付用户id
		$data['goods_id']=$this->_param('goods_id','htmlspecialchars,strip_tags');//商品id
		$data['buy_quantity']=$this->_param('buy_quantity','htmlspecialchars,strip_tags');//购买数量
		$data['pay_money_store_id']=$this->_param('pay_money_store_id','htmlspecialchars,strip_tags');//支付者商家id
// 		$data['get_money_store_id']=$this->_param('get_money_store_id','htmlspecialchars,strip_tags');//商家id
		$data['name']=$this->_param('goods_name','htmlspecialchars,strip_tags');//商品名称
		$data['attribute_type']=$this->_param('attribute_type','htmlspecialchars,strip_tags');//属性类型
// 		$data['order_price']=$this->_param('order_price','htmlspecialchars,strip_tags');//订单价格
		$data['payment_method']=$this->_param('payment_method','htmlspecialchars,strip_tags');//付款方式|0：余额支付，1:积分支付，2:优惠券(现金券/兑换券/折扣券/)支付,3:以物易物支付,4:支付宝，5：财付通支付，6：货到付款，7信用卡支付，
		$data['status']=$this->_param('status','htmlspecialchars,strip_tags');//0:等待买家付款，1支付成功，2支付失败，3取消	
		$data['mobile']=$this->_param('mobile','htmlspecialchars,strip_tags');//电话手机
		$data['address']=$this->_param('address','htmlspecialchars,strip_tags');//送货地址
		$data['zip_code']=$this->_param('zip_code','htmlspecialchars,strip_tags');//邮编
		$data['add_time']=$this->_param('add_time','htmlspecialchars,strip_tags');//添加时间
		$data['update_time']=$this->_param('last_update','htmlspecialchars,strip_tags');//更新时间
		$data['serialize']=$this->_param('serialize','htmlspecialchars,strip_tags');//要序列化的数据|一般是额外的数据
		
		$result=D('Order')->set_order($data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
		
	}
	/**
	*设置订单状态
	*/
	public function set_order_success(){
		$order_id=I('param.order_id', '', 'intval');//订单id
// 		$result=D('Order')->set_order_success($order_id);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	public function update_order(){
		$order_id = I('param.order_id', '', 'intval');//订单ID
		$data['mobile']=I('param.mobile', '', 'number_int');//联系手机
		$data['address']=I('param.address', '', 'number_int');//地址
		$result=D('Order')->update_order($order_id,$order_num=0,$data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 获取定订单列表
	 */
	public function get_order_list(){
		$condition['pay_money_user_id']=I('param.pay_money_user_id', 0, 'intval');//付款用户id
		$condition['get_money_user_id']=I('param.get_money_user_id', 0, 'intval');//收款用户id
		$condition['store_id']=I('param.store_id', 0, 'intval');//商家id
		$condition['payment_method']=$this->_param('payment_method','htmlspecialchars,strip_tags');//付款方式|0：余额支付，1:积分支付，2:优惠券(现金券/兑换券/折扣券/)支付,3:以物易物支付,4:支付宝，5：财付通支付，6：货到付款，7信用卡支付，
		$condition['status']=$this->_param('status','htmlspecialchars,strip_tags');//订单状态
		$condition['mobile']=$this->_param('mobile','htmlspecialchars,strip_tags');//手机
		$page_size=$this->_param('page_size','htmlspecialchars,strip_tags',10);//每页几条
		
		$result=D('Order')->get_order_list($condition,$page_size=10);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	//站点余额支付
	//付款方式|0：余额支付，1:积分支付，2:优惠券(现金券/兑换券/折扣券/)支付,3:以物易物支付,4:支付宝，5：财付通支付，6：货到付款，7信用卡支付，
	public function pay_by_funds(){
		$order_id = I('param.order_id', 0, 'intval');//订单ID
		$user_id = I('param.user_id', 0, 'intval');//支付者USER_ID
		
		$Order = D('Order');
		$result = $Order->pay_by_funds($order_id,$user_id,$field='order_id');
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	//站点积分支付
	//付款方式|0：余额支付，1:积分支付，2:优惠券(现金券/兑换券/折扣券/)支付,3:以物易物支付,4:支付宝，5：财付通支付，6：货到付款，7信用卡支付，
	public function pay_by_integral(){
		$order_id = I('param.order_id', '', 'intval');//订单ID
		$pay_user_id = I('param.user_id', '', 'intval');//支付者USER_ID
		$pay_store_id=I('param.store_id', '', 'intval');//支付者USER_ID
		
		$Order = D('Order');
		$result = $Order->pay_by_integral($order_id,$pay_user_id,$pay_store_id,$field='order_id');
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 以物换物(技能交换)
	 */
	public function pay_by_barter(){
		$order_id = I('param.order_id', 0, 'intval');//订单ID
		$pay_user_id = I('param.pay_user_id', 0, 'intval');//支付的用户
		$pay_store_id = I('param.pay_store_id', 0, 'intval');//支付的商家
		$pay_goods_id = I('param.pay_goods_id', 0, 'intval');//支付的商品
		$get_goods_id = I('param.get_goods_id', 0, 'intval');//要购买的商品
		
		$Order = D('Order');
		$result = $Order->pay_by_integral($order_id,$pay_user_id,$pay_store_id,$pay_goods_id,$get_goods_id,$field='order_id');
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	
}