<?php
/**
 * 拼车
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 */
class CarpoolAction extends Action {
    public function index(){
    	die('common项目');
		$this->display();
    }
    public function carpool_detail()
    {
    	$carpool_id=I('param.carpool_id','','htmlspecialchars');
    	$isdetail=I('param.isdetail','','htmlspecialchars');
    	$this->assign('carpool_id',$carpool_id);
    	$this->assign('isdetail',$isdetail);
    	$this->display ();
    }
    
    public function del_carpool()
    {
    	$carpool_id=I('param.carpool_id','','htmlspecialchars');
    	$del_result = D('Carpool')->del_carpool($carpool_id);
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