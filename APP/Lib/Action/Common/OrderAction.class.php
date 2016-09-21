<?php
/**
 * 订单操作
 * @author Yoper chen.yong.peng@foxmail.com
 * http://www.linglingtang.com
 *
 */
class OrderAction extends Action {
    public function index(){
    	die('common项目');
		$this->display();
    }
    public function order_detail()
    {
    	$order_id=I('param.order_id','','htmlspecialchars');
    	$isdetail=I('param.isdetail','','htmlspecialchars');
    	$this->assign('order_id',$order_id);
    	$this->assign('isdetail',$isdetail);
    	$this->display();
    }
    public function del_order()
    {
    	$order_id=I('param.order_id','','htmlspecialchars');
    	$del_result = D('Order')->del_order($order_id);
    	if(!$this->isAjax())
    	{
    		if($del_result['status']==1)
    		{
    			$this->success($del_result['message']);
    		}
    		else
    		{
    			$this->error($del_result['message']);
    		}
    	}
    	else
    	{
    		$this->ajaxReturn($del_result['data'],$del_result['message'],$del_result['status']);
    	}
    }
}