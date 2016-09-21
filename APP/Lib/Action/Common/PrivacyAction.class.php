<?php
/**
 * 隐私操作
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class PrivacyAction extends Action {
    public function index(){
    	die('common项目');
		$this->display();
    }
    public function privacy_detail()
    {
    	$privacy_id=I('param.privacy_id','','htmlspecialchars');
    	$isdetail=I('param.isdetail','','htmlspecialchars');
    	$this->assign('privacy_id',$privacy_id);
    	$this->assign('isdetail',$isdetail);
    	$this->display();
    }
    public function del_privacy()
    {
    	$privacy_id=I('param.privacy_id','','htmlspecialchars');
    	$del_result = D('Privacy')->del_privacy($privacy_id);
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