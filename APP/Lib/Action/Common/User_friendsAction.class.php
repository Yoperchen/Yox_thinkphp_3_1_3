<?php
/**
 * 好友操作
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class User_friendsAction extends Action {
    public function index(){
    	die('common项目');
		$this->display();
    }
    public function user_frient_detail()
    {
    	$user_frient_id=I('param.user_frient_id','','htmlspecialchars');
    	$isdetail=I('param.isdetail','','htmlspecialchars');
    	$this->assign('user_frient_id',$user_frient_id);
    	$this->assign('isdetail',$isdetail);
    	$this->display();
    }
    public function del_user_frient()
    {
    	$user_frient_id=I('param.user_frient_id','','htmlspecialchars');
    	$del_result = D('User_friends')->del_user_frient($user_frient_id);
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