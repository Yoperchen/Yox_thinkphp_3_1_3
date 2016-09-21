<?php
/**
 * 建筑物
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class BuildingAction extends Action {
    public function index(){
    	die('common项目');
		$this->display();
    }
    public function building_detail()
    {
    	$building_id=I('param.building_id','','htmlspecialchars');
    	$isdetail=I('param.isdetail','','htmlspecialchars');
    	$this->assign('building_id',$building_id);
    	$this->assign('isdetail',$isdetail);
    	$this->display ();
    }
    
    public function del_building()
    {
    	$building_id=I('param.building_id','','htmlspecialchars');
    	$del_result = D('Building')->del_building($building_id);
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