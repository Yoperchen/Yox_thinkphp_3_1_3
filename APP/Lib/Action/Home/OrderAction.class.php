<?php
class OrderAction extends Action {
	/**
	 * 把要购买的商品的good_id发到这里
	 */
	public function index() {
		$goods_id = I( 'param.goods_id', '', 'htmlspecialchars' );
		$buy_quantity = I( 'param.buy_quantity', '', 'htmlspecialchars' );
		$Goods   =   D('Goods');
		$goods_result =   $Goods->getGoodById($goods_id,$isdetail=0);							//商品信息
		if($goods_result['status']>=1) {																			//存在商品
			$order_data['goods_id']  =   $goods_result['data']['id'];//商品id
			$order_data['store_id']  =   $goods_result['data']['store_id'];//商家id
			$order_data['name']  =   $goods_result['data']['goods_name'];//商品名称
			$order_data['pay_price']  =   $goods_result['data']['price'];//订单价格
			$order_data['total_price']  =   $goods_result['data']['price'];//订单价格
			$order_data['buy_quantity']  =   $buy_quantity;//购买数量
// 			$order_data['desc']  =   $goods_data['desc'];//订单描述
			$order_data['payment']  =   1; //付款方式|0：余额支付，1:网上支付，2：银行支付，3：货到付款，4信用卡支付
			$order_data['status']    =   0;		//状态|0:等待买家付款，1支付成功，2支付失败，3取消
			$order_data['order_num'] =  'YO'.date('Ymd-His').'-'.(int)microtime(true).'-'.rand(1,100);//订单编号
			$Order   =   D('Order');
			$Order->set_order($order_data);
			$this->goods_data =   $goods_result;// 模板变量赋值
			
			$Store   =   M('Stores');
			$store_data   =   $Store->find($goods_result['data']['store_id']);//该商品对应的商家信息
			//$this->store_data = $store_data;//为Alipay/alipayapi.php提供配置信息
			//print_r($store_data);
		}else{
			$this->error('数据错误');
		}
		unset($_REQUEST['_URL_']);
		require_once(VENDOR_PATH."Alipay/alipayapi.php");
		//echo '到了 index<br/><br/>';
		$this->display();
	}
	
	public function order() {
		echo '到了function order<br/><br/>';
		$id = $_REQUEST['goods_id'];
		
		$Form   =   M('Goods');
		$data =   $Form->find($id);
		if($data) {
			$this->data =   $data;// 模板变量赋值
		}else{
			$this->error('数据错误');
		}
		$this->display();
	}
	
	//页面跳转同步通知页面路径
	public function return_url() {
		//处理一些逻辑就unset掉
		unset($_GET['_URL_']);
		//unset掉之后就可以request return_url了
		require_once(VENDOR_PATH."Alipay/return_url.php");
		echo '<br/>到了function return_url<br/><br/>';
		echo C("HOST").U('Home/Order/return_url');
		print_r($_GET);
		print_r($_POST);
		$out_trade_no = $this->_param('out_trade_no','htmlspecialchars,strip_tags');//YO20150524-192013-1432466413-22
		$order_info = D('Order')->get_order_info($out_trade_no,$isdetail=1,$field="order_num");
		print_r($order_info);
		$this->assign('order_info',$order_info);
		$this->display();
	}
	//服务器异步通知页面路径
	public function notify_url() {
		//处理一些逻辑就unset掉
		unset($_GET['_URL_']);
		$out_trade_no = I( 'param.out_trade_no', '', 'htmlspecialchars' );//order_num
		
		D('Visit_log')->add_visit_log(array('visit_content'=>$out_trade_no.':begin'));
		require_once(VENDOR_PATH."Alipay/notify_url.php");
		D('Visit_log')->add_visit_log(array('visit_content'=>$out_trade_no.':end'));
		//echo '<br/>到了function notify_url<br/><br/>';
		exit;
		//$this->display();
	}
}