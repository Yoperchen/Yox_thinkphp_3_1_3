<?php
/**
 * 访问日志操作
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class Visit_logAction extends Action {
    public function index(){
    	die('common项目');
		$this->display();
    }
    public function visit_log_detail()
    {
    	$visit_log_id=I('param.visit_log_id','','htmlspecialchars');
    	$isdetail=I('param.isdetail','','htmlspecialchars');
    	$this->assign('visit_log_id',$visit_log_id);
    	$this->assign('isdetail',$isdetail);
    	$this->display();
    }
    public function del_visit_log()
    {
    	$visit_log_id=I('param.visit_log_id','','htmlspecialchars');
    	$del_result = D('Visit_log')->del_visit_log($visit_log_id);
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