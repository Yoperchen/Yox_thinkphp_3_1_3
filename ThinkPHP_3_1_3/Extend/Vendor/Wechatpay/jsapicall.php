<?php
include_once("WxPayHelper.php");
//判断是否微信容器(微信浏览器)内
	if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') == false )
	 {
// 		die( "不是微信，请选择在微信中打开");
		echo "不是微信，请选择在微信中打开";
	}
$commonUtil = new CommonUtil();
$wxPayHelper = new WxPayHelper();

$body='零零糖';//128字节以下
//$body.= "影城：".$order_info['cinema_name'];
//$body.= "影片:".$order_info['film_name'];
//$body.= "影片:".$order_info['film_name'];
//$body.= "影厅：".$order_info['hall_name'];
//$body.= "时间：".$order_info['ticket_list'][0]['show_date'] .' '.$order_info['ticket_list'][0]['show_time'].'<br>';
// $body.= "手续费：".$order_info['sale_fee'];
// $body.= "总费用：".$order_info['pay_amount'];

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
?>
<script>
function callpay()//微信支付
{
	WeixinJSBridge.invoke('getBrandWCPayRequest',<?php echo $wxPayHelper->create_biz_package();?>,function(res){
	WeixinJSBridge.log(res.err_msg);
	if(res.err_msg == "get_brand_wcpay_request:ok" ) {//支付成功
		window.location.href="http://www.linglingtang.com/pay/wechat_wap_return.php?out_trade_no=<?php echo $order_info['order_id'];?>&status=1"; 
	}else{
		window.location.href="http://www.linglingtang.com/pay/wechat_wap_return.php?out_trade_no=<?php echo $order_info['order_id'];?>&status=0"; 
	}
	
	});
}
</script>
<a style="height:60px;width:120px;color:#fff;font-size:19px;text-align:center;background:#ed6d00;margin-left:auto;margin-right:auto;margin-top: 50px;width: 100%;
position: relative;width: 50%;display: block;line-height: 60px;" href="javascript:return false;" onclick="callpay()">确认支付</a>
