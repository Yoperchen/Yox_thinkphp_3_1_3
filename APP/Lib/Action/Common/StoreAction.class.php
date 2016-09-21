<?php
/**
 * 商家操作
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class StoreAction extends Action {
    public function index(){
    	die('common项目');
		$this->display();
    }
    public function store_detail()
    {
    	$store_id=I('param.store_id','','htmlspecialchars');
    	$isdetail=I('param.isdetail','','htmlspecialchars');
    	$this->assign('store_id',$store_id);
    	$this->assign('isdetail',$isdetail);
    	$this->display();
    }
    public function del_store()
    {
    	$store_id=I('param.store_id','','htmlspecialchars');
    	$del_result = D('Store')->del_store($store_id);
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