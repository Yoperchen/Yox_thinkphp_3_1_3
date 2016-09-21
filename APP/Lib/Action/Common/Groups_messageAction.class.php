<?php
/**
 * 群信息操作
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class Groups_messageAction extends Action {
    public function index(){
    	die('common项目');
		$this->display();
    }
    public function groups_message_detail()
    {
    	$groups_message_id=I('param.groups_message_id','','htmlspecialchars');
    	$isdetail=I('param.isdetail','','htmlspecialchars');
    	$this->assign('groups_message_id',$groups_message_id);
    	$this->assign('isdetail',$isdetail);
    	$this->display();
    }
    public function del_groups_message()
    {
    	$groups_message_id=I('param.groups_message_id','','htmlspecialchars');
    	$del_result = D('Groups_message')->del_groups_message($groups_message_id);
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