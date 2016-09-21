<?php
/**
 * 地址
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class AddressAction extends Action {
    public function index(){
    	die('common项目');
		$this->display();
    }
    public function address_detail()
    {
    	$address_id=I('param.address_id','','htmlspecialchars');
    	$isdetail=I('param.isdetail','','htmlspecialchars');
    	$this->assign('address_id',$address_id);
    	$this->assign('isdetail',$isdetail);
    	$this->display ();
    }
    
    public function del_address()
    {
    	$address_id=I('param.address_id','','htmlspecialchars');
    	$del_result = D('Address')->del_address($address_id);
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