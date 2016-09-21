<?php
/**
 * 课程
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class CourseAction extends Action {
    public function index(){
    	die('common项目');
		$this->display();
    }
    public function course_detail()
    {
    	$course_id=I('param.course_id','','htmlspecialchars');
    	$isdetail=I('param.isdetail','','htmlspecialchars');
    	$this->assign('course_id',$course_id);
    	$this->assign('isdetail',$isdetail);
    	$this->display();
    }
    public function del_course()
    {
    	$course_id=I('param.course_id','','htmlspecialchars');
    	$del_result = D('Article')->del_course($course_id);
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