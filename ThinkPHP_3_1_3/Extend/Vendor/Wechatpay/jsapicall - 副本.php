<?php
include_once("WxPayHelper.php");
include_once("../../common.inc.php");
//判断是否微信容器(微信浏览器)内
	if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') == false )
	 {
// 		die( "不是微信，请选择在微信中打开");
		echo "不是微信，请选择在微信中打开";
	}
	
$out_trade_no = htmlspecialchars($_REQUEST['out_trade_no']);
$order_no = substr($out_trade_no,0, -1);
$order_obj = new OrderCls();
$order_info = $order_obj->getOrderByOrderNo($order_no, $is_details = true);

if(empty($order_info)){
	die( "查无该订单，或订单号错误-$order_no");
}
//print_r($order_info);
$commonUtil = new CommonUtil();
$wxPayHelper = new WxPayHelper();

$body='';
//$body.= "影城：".$order_info['cinema_name'];
$body.= "影片:".$order_info['film_name'];
//$body.= "影片:".$order_info['film_name'];
//$body.= "座位：";
foreach($order_info['ticket_list'] as $ticket){
	$body.= $ticket['seat_name'].' ';
}
//$body.= "影厅：".$order_info['hall_name'];
//$body.= "时间：".$order_info['ticket_list'][0]['show_date'] .' '.$order_info['ticket_list'][0]['show_time'].'<br>';
// $body.= "手续费：".$order_info['sale_fee'];
//$body.= "总费用：".$order_info['pay_amount'];

$wxPayHelper->setParameter("bank_type", "WX");//银行
$wxPayHelper->setParameter("body",$body);//商品描述
$wxPayHelper->setParameter("partner", "1220177101");//PartnerID
$wxPayHelper->setParameter("out_trade_no", $order_info['order_no']);//订单号
$wxPayHelper->setParameter("total_fee", $order_info['pay_amount']*100);//订单总金额，单位为分
$wxPayHelper->setParameter("fee_type", "1");//支付币种;1:人民币
$wxPayHelper->setParameter("notify_url", "http://www.linglingtang.com/pay/wechat_wap_notify.php");//通知页面
$wxPayHelper->setParameter("spbill_create_ip", $_SERVER["REMOTE_ADDR"]);//用户浏览器端 IP，
$wxPayHelper->setParameter("attach", "附加数据");//附加数据，原样返回
$wxPayHelper->setParameter("input_charset", "UTF-8");//编码





?>
<html>
<script language="javascript">

function callpay()
 {
	WeixinJSBridge.invoke('getBrandWCPayRequest',<?php echo $wxPayHelper->create_biz_package(); ?>,function(res){
	WeixinJSBridge.log(res.err_msg);
	if(res.err_msg == "get_brand_wcpay_request:ok" ) {
		window.location.href="http://www.linglingtang.com/pay/wechat_wap_return.php"; 
	}
	//alert(res.err_code+res.err_desc+res.err_msg);
	});
}
</script>
<body>
请在微信中完成支付
<!--<button type="button" onclick="callpay()">wx pay test</button>-->
</body>
</html>
