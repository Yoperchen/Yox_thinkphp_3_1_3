<?php
/**
 * 权限操作
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class PermissionsAction extends Action {
    public function index(){
    	die('common项目');
		$this->display();
    }
    public function permissions_detail()
    {
    	$permissions_id=I('param.permissions_id','','htmlspecialchars');
    	$isdetail=I('param.isdetail','','htmlspecialchars');
    	$this->assign('permissions_id',$permissions_id);
    	$this->assign('isdetail',$isdetail);
    	$this->display();
    }
    public function del_permissions()
    {
    	$permissions_id=I('param.permissions_id','','htmlspecialchars');
    	$del_result = D('Permissions')->del_permissions($permissions_id);
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