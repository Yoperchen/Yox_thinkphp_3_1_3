<?php
/**
 * 商品操作
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class GoodsAction extends Action {
    public function index(){
    	die('common项目');
		$this->display();
    }
    public function goods_detail()
    {
    	$goods_id=I('param.goods_id','','htmlspecialchars');
    	$isdetail=I('param.isdetail','','htmlspecialchars');
    	$this->assign('goods_id',$goods_id);
    	$this->assign('isdetail',$isdetail);
    	$this->display();
    }
    public function del_goods()
    {
    	$goods_id=I('param.goods_id','','htmlspecialchars');
    	$del_result = D('Goods')->del_goods($goods_id);
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