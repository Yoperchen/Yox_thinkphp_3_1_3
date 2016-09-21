<?php
/**
 * 验证操作
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class VerifyAction extends Action {
    public function index(){
    	die('common项目');
		$this->display();
    }
    public function verify_detail()
    {
    	$verify_id=I('param.verify_id','','htmlspecialchars');
    	$isdetail=I('param.isdetail','','htmlspecialchars');
    	$this->assign('verify_id',$verify_id);
    	$this->assign('isdetail',$isdetail);
    	$this->display();
    }
    public function del_verify()
    {
    	$verify_id=I('param.verify_id','','htmlspecialchars');
    	$del_result = D('Verify')->del_verify($verify_id);
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