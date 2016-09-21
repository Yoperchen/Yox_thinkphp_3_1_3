<?php
/**
 * 站点操作
 * @author Yoper chen.yong.peng@foxmail.com
 * http://www.linglingtang.com
 *
 */
class Partner_siteAction extends Action {
    public function index(){
    	die('common项目');
		$this->display();
    }
    public function site_detail()
    {
    	$site_id=I('param.site_id','','htmlspecialchars');
    	$isdetail=I('param.isdetail','','htmlspecialchars');
    	$this->assign('site_id',$site_id);
    	$this->assign('isdetail',$isdetail);
    	$this->display();
    }
    public function del_site()
    {
    	$site_id=I('param.site_id','','htmlspecialchars');
    	$del_result = D('Partner_site')->del_partner_site($site_id);
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