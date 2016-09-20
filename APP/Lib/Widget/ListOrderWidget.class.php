<?php
//订单列表
//{:W('ListArticle',array('template'=>'Yocms_image_list_88','condition'=>array(),'page_template'=>'0'))}
class ListOrderWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'ListOrder';
    	
    	$Order_model  =   D('Order');
    	
    	$condition = '';//条件
    	$condition['id']=$data['condition']['id']?$data['condition']['id']:'';
    	$condition['site_id']=$data['condition']['site_id']?$data['condition']['site_id']:'';//站点
    	$condition['pay_money_store_id']=$data['condition']['pay_money_store_id']?array('eq',$data['condition']['pay_money_store_id']):'';//付款商家
    	$condition['pay_money_user_id']=$data['condition']['pay_money_user_id']?array('eq',$data['condition']['pay_money_user_id']):'';//付款用户
    	$condition['get_money_user_id']=$data['condition']['get_money_user_id']?array('eq',$data['condition']['get_money_user_id']):'';//收款用户
    	$condition['get_money_store_id']=$data['condition']['get_money_store_id']?array('eq',$data['condition']['get_money_store_id']):'';//收款商家
    	$condition['order_num']=$data['condition']['order_num']?array('eq',$data['condition']['order_num']):'';//订单号
    	
    	$condition['name']=$data['condition']['name']?array('like','%'.$data['condition']['name'].'%'):'';//订单名称
    	
    	$condition['buy_quantity']=$data['condition']['buy_quantity']?array('eq',$data['condition']['buy_quantity']):'';//购买数量
    	$condition['buy_quantity']=$data['condition']['egt_buy_quantity']?array('EGT',$data['condition']['egt_buy_quantity']):'';//大于等于
    	$condition['buy_quantity']=$data['condition']['gt_buy_quantity']?array('GT',$data['condition']['gt_buy_quantity']):'';//大于
    	$condition['buy_quantity']=$data['condition']['elt_buy_quantity']?array('ELT',$data['condition']['elt_buy_quantity']):'';//小于等于
    	$condition['buy_quantity']=$data['condition']['lt_buy_quantity']?array('LT',$data['condition']['lt_buy_quantity']):'';//小于
    	
    	$condition['total_price']=$data['condition']['total_price']?array('eq',$data['condition']['total_price']):'';//订单价格
    	$condition['total_price']=$data['condition']['egt_total_price']?array('EGT',$data['condition']['egt_total_price']):'';//大于等于
    	$condition['total_price']=$data['condition']['gt_total_price']?array('GT',$data['condition']['gt_total_price']):'';//大于
    	$condition['total_price']=$data['condition']['elt_total_price']?array('ELT',$data['condition']['elt_total_price']):'';//小于等于
    	$condition['total_price']=$data['condition']['lt_total_price']?array('LT',$data['condition']['lt_total_price']):'';//小于
    	
    	$condition['pay_price']=$data['condition']['pay_price']?array('eq',$data['condition']['pay_price']):'';//支付金额
    	$condition['pay_price']=$data['condition']['egt_pay_price']?array('EGT',$data['condition']['egt_pay_price']):'';//大于等于
    	$condition['pay_price']=$data['condition']['gt_pay_price']?array('GT',$data['condition']['gt_pay_price']):'';//大于
    	$condition['pay_price']=$data['condition']['elt_pay_price']?array('ELT',$data['condition']['elt_pay_price']):'';//小于等于
    	$condition['pay_price']=$data['condition']['lt_pay_price']?array('LT',$data['condition']['lt_pay_price']):'';//小于
    	
    	$condition['payment_method']=$data['condition']['payment_method']?array('eq',$data['condition']['payment_method']):'';//付款方式|0：余额支付，1:积分支付，2:优惠券(现金券/兑换券/折扣券/)支付,3:以物易物支付,4:支付宝，5：财付通支付，6：货到付款，7信用卡支付，
    	$condition['status']=$data['condition']['status']?array('eq',$data['condition']['status']):'';//0:等待买家付款，1支付成功，2支付失败，3取消,9已完成
    	$condition['receive_name']=$data['condition']['receive_name']?array('like','%'.$data['condition']['receive_name'].'%'):'';//收货人
    	$condition['mobile']=$data['condition']['mobile']?array('eq',$data['condition']['mobile']):'';//手机号
    	
    	$condition['send_time']=$data['condition']['send_time']?array('eq',$data['condition']['send_time']):'';//发货时间
    	$condition['send_time']=$data['condition']['egt_send_time']?array('EGT',$data['condition']['egt_send_time']):'';//大于等于
    	$condition['send_time']=$data['condition']['gt_send_time']?array('GT',$data['condition']['gt_send_time']):'';//大于
    	$condition['send_time']=$data['condition']['elt_send_time']?array('ELT',$data['condition']['elt_send_time']):'';//小于等于
    	$condition['send_time']=$data['condition']['lt_send_time']?array('LT',$data['condition']['lt_send_time']):'';//小于
    	
    	$condition['add_time']=$data['condition']['add_time']?array('eq',$data['condition']['add_time']):'';//添加时间
    	$condition['add_time']=$data['condition']['egt_add_time']?array('EGT',$data['condition']['egt_add_time']):'';//大于等于
    	$condition['add_time']=$data['condition']['gt_add_time']?array('GT',$data['condition']['gt_add_time']):'';//大于
    	$condition['add_time']=$data['condition']['elt_add_time']?array('ELT',$data['condition']['elt_add_time']):'';//小于等于
    	$condition['add_time']=$data['condition']['lt_add_time']?array('LT',$data['condition']['lt_add_time']):'';//小于
    	
    	$condition['update_time']=$data['condition']['update_time']?array('eq',$data['condition']['update_time']):'';//修改时间
    	$condition['update_time']=$data['condition']['egt_update_time']?array('EGT',$data['condition']['egt_update_time']):'';//大于等于
    	$condition['update_time']=$data['condition']['gt_update_time']?array('GT',$data['condition']['gt_update_time']):'';//大于
    	$condition['update_time']=$data['condition']['elt_update_time']?array('ELT',$data['condition']['elt_update_time']):'';//小于等于
    	$condition['update_time']=$data['condition']['lt_update_time']?array('LT',$data['condition']['lt_update_time']):'';//小于
    	
    	
    	$data['page']['page_size'] = $data['page']['page_size']?intval($data['page']['page_size']):12;
    	
    	$list_order_result = $Order_model-> get_order_list($condition,$data['page']['page_size']);
    	$data['list']=$list_order_result['data']['list'];
    	$data['page']=$list_order_result['data']['page'];
//      	print_r($data);
// 	print_r($condition);
    	 
        $content = $this->renderFile($Template,$data);
		if($data['format_type']=='json')
		{
			return json_encode(array('status'=>1,'data'=>$content));
		}
		elseif($data['format_type']=='xml')
		{
			
		}
		else{
	        return $content;  
		}
	} 
 }