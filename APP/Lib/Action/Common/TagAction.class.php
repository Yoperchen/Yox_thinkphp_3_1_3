<?php
/**
 * 标签操作
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class TagAction extends Action {
    public function index(){
    	die('common项目');
		$this->display();
    }
    public function tag_detail()
    {
    	$tag_id=I('param.tag_id','','htmlspecialchars');
    	$isdetail=I('param.isdetail','','htmlspecialchars');
    	$this->assign('tag_id',$tag_id);
    	$this->assign('isdetail',$isdetail);
    	$this->display();
    }
    public function del_tag()
    {
    	$tag_id=I('param.tag_id','','htmlspecialchars');
    	$del_result = D('Tag')->del_tag($tag_id);
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