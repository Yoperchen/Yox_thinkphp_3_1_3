<?php
/**
 * 分享操作
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class ShareAction extends Action {
    public function index(){
    	die('common项目');
		$this->display();
    }
    public function share_detail()
    {
    	$share_id=I('param.share_id','','htmlspecialchars');
    	$isdetail=I('param.isdetail','','htmlspecialchars');
    	$this->assign('share_id',$share_id);
    	$this->assign('isdetail',$isdetail);
    	$this->display();
    }
    public function del_share()
    {
    	$share_id=I('param.share_id','','htmlspecialchars');
    	$del_result = D('Share')->del_share($share_id);
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