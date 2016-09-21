<?php
/**
 * 约会、预约
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class AppointmentAction extends Action {
    public function index(){
    	die('common项目');
		$this->display();
    }
    
    public function appointment_detail()
    {
    	$appointment_id=I('param.appointment_id','','htmlspecialchars');
    	$isdetail=I('param.isdetail','','htmlspecialchars');
    	$this->assign('appointment_id',$appointment_id);
    	$this->assign('isdetail',$isdetail);
    	$this->display ();
    }
    
    public function del_appointment()
    {
    	$appointment_id=I('param.appointment_id','','htmlspecialchars');
    	$del_result = D('Appointment')->del_appointment($appointment_id);
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