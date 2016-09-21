<?php
/**
 * 导航操作
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class NavigationAction extends Action {
    public function index(){
    	die('common项目');
		$this->display();
    }
    public function navigation_detail()
    {
    	$navigation_id=I('param.navigation_id','','htmlspecialchars');
    	$isdetail=I('param.isdetail','','htmlspecialchars');
    	$this->assign('navigation_id',$navigation_id);
    	$this->assign('isdetail',$isdetail);
    	$this->display();
    }
    public function del_navigation()
    {
    	$navigation_id=I('param.navigation_id','','htmlspecialchars');
    	$del_result = D('Navigation')->del_navigation($navigation_id);
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