<?php
/**
 * 信息操作
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class MessageAction extends Action {
    public function index(){
    	die('common项目');
		$this->display();
    }
    public function message_detail()
    {
    	$message_id=I('param.message_id','','htmlspecialchars');
    	$isdetail=I('param.isdetail','','htmlspecialchars');
    	$this->assign('message_id',$message_id);
    	$this->assign('isdetail',$isdetail);
    	$this->display();
    }
    public function del_message()
    {
    	$message_id=I('param.message_id','','htmlspecialchars');
    	$del_result = D('Message')->del_message($message_id);
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