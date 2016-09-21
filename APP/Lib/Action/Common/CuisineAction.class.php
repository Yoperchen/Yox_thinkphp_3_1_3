<?php
/**
 * 菜式
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class CuisineAction extends Action {
    public function index(){
    	die('common项目');
		$this->display();
    }
    public function cuisine_detail()
    {
    	$cuisine_id=I('param.cuisine_id','','htmlspecialchars');
    	$isdetail=I('param.isdetail','','htmlspecialchars');
    	$this->assign('cuisine_id',$cuisine_id);
    	$this->assign('isdetail',$isdetail);
    	$this->display();
    }
    public function del_cuisine()
    {
    	$cuisine_id=I('param.cuisine_id','','htmlspecialchars');
    	$del_result = D('Cuisine')->del_cuisine(cuisine_id);
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