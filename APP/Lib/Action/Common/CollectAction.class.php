<?php
/**
 * 收藏
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class CollectAction extends Action {
    public function index(){
    	die('common项目');
		$this->display();
    }
    public function collect_detail()
    {
    	$collect_id=I('param.collect_id','','htmlspecialchars');
    	$isdetail=I('param.isdetail','','htmlspecialchars');
    	$this->assign('collect_id',$collect_id);
    	$this->assign('isdetail',$isdetail);
    	$this->display ();
    }
    
    public function del_collect()
    {
    	$collect_id=I('param.collect_id','','htmlspecialchars');
    	$del_result = D('Collect')->del_collect($collect_id);
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