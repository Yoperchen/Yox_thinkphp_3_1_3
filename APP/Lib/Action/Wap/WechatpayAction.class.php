<?php
// 微信支付必须通过icp备案
class WechatpayAction extends Action {
    public function index(){
	$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>零零糖</b>！</p></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
	$this->display();
    }
    /**
     * 微信支付
     */
    public function pay(){
    	$order_id = I('param.order_id','','htmlspecialchars');
    	

    	$Order = D('Order');
    	$order_info = $Order->get_order_info($order_id, $is_details = false);
    	if($order_info['status']==0){
    		die( "查无该订单，或订单号错误-$order_id");
    	}
    	$order_info=$order_info['data'];
    	//print_r($order_info);
    	require_once(VENDOR_PATH."Wechatpay/WxPayHelper.php");
    	//判断是否微信容器(微信浏览器)内
    	if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') == false )
    	{
    		// 		die( "不是微信，请选择在微信中打开");
    		echo "不是微信，请选择在微信中打开";
    	}
    	print_r($order_info);
    	$commonUtil = new CommonUtil();
    	$wxPayHelper = new WxPayHelper();
    	
    	$body='零零糖';//128字节以下
    	
    	$wxPayHelper->setParameter("bank_type", "WX");//银行
    	$wxPayHelper->setParameter("body",$body);//商品描述|
    	$wxPayHelper->setParameter("partner", "1220177101");//PartnerID
    	$wxPayHelper->setParameter("out_trade_no", $order_info['order_id']);//订单号
    	$wxPayHelper->setParameter("total_fee", $order_info['pay_price']*100);//订单总金额，单位为分
    	$wxPayHelper->setParameter("fee_type", "1");//支付币种;1:人民币
    	$wxPayHelper->setParameter("notify_url", "http://www.xdsjsd.com/index.php/Wap/Wechatpay/notify_url");//通知页面
    	$wxPayHelper->setParameter("spbill_create_ip", $_SERVER["REMOTE_ADDR"]);//用户浏览器端 IP，
    	$wxPayHelper->setParameter("attach", "附加数据");//附加数据，原样返回
    	$wxPayHelper->setParameter("input_charset", "UTF-8");//编码
    	$biz_package = $wxPayHelper->create_biz_package();
    	
    	$this->assign('biz_package',$biz_package);
    	$this->assign('order_id',$order_info['order_id']);
    	$this->display();
    }
    /**
     * 异步通知
     */
    public function notify_url(){
    	unset($_GET['_URL_']);
    	require_once(VENDOR_PATH."Wechatpay/WxPayHelper.php");
    	$WxPayHelper = new WxPayHelper();
    	
    	echo 'notify_url';
		exit();
    }
    /**
     * 同步通知
     */
    public function return_url(){
    	unset($_GET['_URL_']);
    	$order_id = I('param.out_trade_no','','htmlspecialchars');
    	$status = I('param.status','','htmlspecialchars');
    	require_once(VENDOR_PATH."Wechatpay/WxPayHelper.php");
    	if($status==1){
    		echo 'return_url';
    	}else{
    		echo 'false';
    	}
    }
    private function wechatpay_return_wap(){
    
    }
    
    
}