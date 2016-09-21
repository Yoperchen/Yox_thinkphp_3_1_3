<?php
/**
 * 优惠券|现金券、兑换券、折扣券、定额券
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class CouponAction extends Action {
    public function index(){
    	die('common项目');
		$this->display();
    }
    
    public function ad_coupon()
    {
    	$coupon_id=I('param.coupon_id','','htmlspecialchars');
    	$isdetail=I('param.isdetail','','htmlspecialchars');
    	$this->assign('ad_id',$coupon_id);
    	$this->assign('isdetail',$isdetail);
    	$this->display ();
    }
    
    public function del_coupon()
    {
    	$coupon_id=I('param.coupon_id','','htmlspecialchars');
    	$del_result = D('Coupon')->del_coupon($coupon_id);
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