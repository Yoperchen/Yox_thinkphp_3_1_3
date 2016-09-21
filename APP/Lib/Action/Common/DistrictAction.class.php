<?php
/**
 * 地区
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class DistrictAction extends Action {
    public function index(){
    	die('common项目');
		$this->display();
    }
    public function district_detail()
    {
    	$district_id=I('param.district_id','','htmlspecialchars');
    	$isdetail=I('param.isdetail','','htmlspecialchars');
    	$this->assign('district_id',$district_id);
    	$this->assign('isdetail',$isdetail);
    	$this->display();
    }
    public function district_list()
    {
        $condition['name']=I('name','','htmlspecialchars');//地区名称
        $condition['level']=I('level','','int');//级别
        $condition['upid']=I('upid','','int');//上级id
        $condition['rank']=I('rank','','int');//排序
        $condition['hot']=I('hot','','int');//是否热门
        $condition['alphabet']=I('alphabet','','htmlspecialchars,strip_tags');//字母
        $condition['page']=$this->_param('page','htmlspecialchars,strip_tags');
        
        $list_result=D('District')->get_district_list($condition,'*');
        if(!$this->isAjax()){
            $this->display();
        }else
        {
            $this->ajaxReturn($list_result['data'],$list_result['message'],$list_result['status']);
        }
    }
    public function del_district()
    {
    	$district_id=I('param.district_id','','htmlspecialchars');
    	$del_result = D('District')->del_district($district_id);
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