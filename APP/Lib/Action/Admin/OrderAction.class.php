<?php
/**
 * 订单管理
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class OrderAction extends AdminbaseAction {
    public function index()
    {
		$this->display();
    }
    public function list_order(){
    	$order=D('Order');
    	$add_time1=I('param.add_time1','', 'htmlspecialchars');
    	$add_time2=I('param.add_time2','', 'htmlspecialchars');
    	if(!empty($add_time1)&&$add_time2)
    	{
    	$condition['add_time'] = array(
    			array('gt',strtotime($add_time1)),
    			array('lt',strtotime($add_time2))
    			);
    	}
    	$condition['order_num']= I('param.order_num','', 'htmlspecialchars');//分类
    	$condition['category']= I('param.category','', 'htmlspecialchars');//分类
    	$condition['status']  = I('param.status', '','htmlspecialchars');//0:等待买家付款，1支付成功，2支付失败，3取消,9已完成
    	$page_size=10;
    	$order_list_result =$order->get_order_list($condition,$page_size);

    	$this->assign('order_list_result',$order_list_result);
    	$this->display();
    }
    public function detail_order(){
    	$order_id =I('param.order_id','','htmlspecialchars');
    	$is_export =I('param.is_export','','htmlspecialchars');
    	$order=D('Order');
    	$order_info_result = $order->get_order_info($order_id,$isdetail=0,$field="order_id");
    	if($order_info_result['status']!=1){
    		$this->error($order_info_result['message']);
    	}
    	if($is_export)
    	{
    		
    		$film_name='order'.$order_info_result['data']['order_num'].'.xls';
    		header("Content-Type: application/vnd.ms-excel");
    		header("Content-Disposition: attachment;filename=" . $film_name);
    		echo iconv('utf-8','gbk',"订单号\t名称\t1\t2\t3\t4\t5\t6\t7\r\n");
//     		$str.="Straight (Cut)\t短管\tA\tB\tL\t\t\t\t\r\n";
    		$str.=$order_info_result['data']['order_num']."\t";
    		$str.=$order_info_result['data']['name']."\t";
    		$str.=$order_info_result['data']['name']."\t";
    		$str.=$order_info_result['data']['name']."\t";
    		$str.=$order_info_result['data']['name']."\t";
    		$str.=$order_info_result['data']['name']."\t";
    		$str.=$order_info_result['data']['name']."\t";
    		$str.=$order_info_result['data']['name']."\t";
    		$str.=$order_info_result['data']['name']."\t";
    		$str.="\r\n";
    		echo iconv('utf-8','gbk',$str);die();
    	}
    	print_r($order_info_result);
    	$this->assign('order_info_result',$order_info_result);
    	$this->display();
    }
}