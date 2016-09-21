<?php
/**
 * 用户
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class UserAction extends Action {
    public function index(){
    	die('common项目');
		$this->display();
    }
    public function user_detail()
    {
    	$user_id=I('param.user_id','','htmlspecialchars');
    	$isdetail=I('param.isdetail','','htmlspecialchars');
    	$this->assign('user_id',$user_id);
    	$this->assign('isdetail',$isdetail);
    	$this->display ();
    }
    public function del_user()
    {
    	die('err');
    	$user_id=I('param.user_id','','htmlspecialchars');
    	$del_result = D('User')->del_user($$user_id);
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