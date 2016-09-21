<?php
/**
 * 租东西操作
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class RentalAction extends Action {
    public function index(){
    	die('common项目');
		$this->display();
    }
    public function rental_detail()
    {
    	$rental_id=I('param.rental_id','','htmlspecialchars');
    	$isdetail=I('param.isdetail','','htmlspecialchars');
    	$this->assign('rental_id',$rental_id);
    	$this->assign('isdetail',$isdetail);
    	$this->display();
    }
    public function del_rental()
    {
    	$rental_id=I('param.rental_id','','htmlspecialchars');
    	$del_result = D('Rental')->del_rental($rental_id);
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