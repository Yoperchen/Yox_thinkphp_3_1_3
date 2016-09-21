<?php
/**
 * 活动
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class ActivityAction extends Action {
    public function index(){
    	die('common项目');
		$this->display();
    }
    
    public function activity_detail()
    {
    	$activity_id=I('param.activity_id','','htmlspecialchars');
    	$isdetail=I('param.isdetail','','htmlspecialchars');
    	$this->assign('activity_id',$activity_id);
    	$this->assign('isdetail',$isdetail);
    	$this->display ();
    }
    
    public function del_activity()
    {
    	$activity_id=I('param.activity_id','','htmlspecialchars');
    	$del_result = D('Activity')->del_activity($activity_id);
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