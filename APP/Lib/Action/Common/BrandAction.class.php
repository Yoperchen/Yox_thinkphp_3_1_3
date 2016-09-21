<?php
/**
 * 品牌
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class BrandAction extends Action {
    public function index(){
    	die('common项目');
		$this->display();
    }
    public function brand_detail()
    {
    	$brand_id=I('param.brand_id','','htmlspecialchars');
    	$isdetail=I('param.isdetail','','htmlspecialchars');
    	$this->assign('brand_id',$brand_id);
    	$this->assign('isdetail',$isdetail);
    	$this->display ();
    }
    
    public function del_brand()
    {
    	$brand_id=I('param.brand_id','','htmlspecialchars');
    	$del_result = D('Brand')->del_brand($brand_id);
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