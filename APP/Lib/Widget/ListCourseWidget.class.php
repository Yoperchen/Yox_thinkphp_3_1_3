<?php
//课程列表
//{:W('ListCourse',array('template'=>'Yocms_image_list_88','condition'=>array(),'page_template'=>'0'))}
class ListCourseWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'ListCourse';
    	
    	$Course_model  =   D('Course');
    	
    	$condition = array();//条件
    	$condition['site_id']=$data['condition']['site_id']?$data['condition']['site_id']:'';//站点
    	$condition['belong_user_id']=$data['condition']['belong_user_id']?array('eq',$data['condition']['belong_user_id']):'';//用户
		$condition['group_id']=$data['condition']['group_id']?array('eq',$data['condition']['group_id']):'';//所属班级(群)
    	$condition['week']=$data['condition']['week']?array('eq',$data['condition']['week']):'';//星期几|1、2、3、4、5、6、7
    	$condition['first_class']=$data['condition']['first_class']?array('eq',$data['condition']['first_class']):'';//第一节课
    	$condition['second_class']=$data['condition']['second_class']?array('eq',$data['condition']['second_class']):'';
    	$condition['third_class']=$data['condition']['third_class']?array('eq',$data['condition']['third_class']):'';
    	$condition['fourth_class']=$data['condition']['fourth_class']?array('eq',$data['condition']['fourth_class']):'';
    	$condition['fifth_class']=$data['condition']['fifth_class']?array('eq',$data['condition']['fifth_class']):'';
    	$condition['sixth_class']=$data['condition']['sixth_class']?array('eq',$data['condition']['sixth_class']):'';
    	$condition['seventh_class']=$data['condition']['seventh_class']?array('eq',$data['condition']['seventh_class']):'';
    	$condition['eighth_class']=$data['condition']['eighth_class']?array('eq',$data['condition']['eighth_class']):'';
    	$condition['ninth_class']=$data['condition']['ninth_class']?array('eq',$data['condition']['ninth_class']):'';
    	$condition['tenth_class']=$data['condition']['tenth_class']?array('eq',$data['condition']['tenth_class']):'';//第十节课
    	$condition['class']=$data['condition']['class']?array('eq',$data['condition']['class']):'';//班级
    	$condition['community_id']=$data['condition']['community_id']?array('eq',$data['condition']['community_id']):'';//所属社区(学校)
    	$condition['class']=$data['condition']['class']?array('eq',$data['condition']['class']):'';
    	
    	$condition['add_time']=$data['condition']['add_time']?array('eq',$data['condition']['add_time']):'';//添加时间
    	$condition['add_time']=$data['condition']['egt_add_time']?array('EGT',$data['condition']['egt_add_time']):'';//大于等于
    	$condition['add_time']=$data['condition']['gt_add_time']?array('GT',$data['condition']['gt_add_time']):'';//大于
    	$condition['add_time']=$data['condition']['elt_add_time']?array('ELT',$data['condition']['elt_add_time']):'';//小于等于
    	$condition['add_time']=$data['condition']['lt_add_time']?array('LT',$data['condition']['lt_add_time']):'';//小于
    	
    	$condition['update_time']=$data['condition']['update_time']?array('eq',$data['condition']['update_time']):'';//修改时间
    	$condition['update_time']=$data['condition']['egt_update_time']?array('EGT',$data['condition']['egt_update_time']):'';//大于等于
    	$condition['update_time']=$data['condition']['gt_update_time']?array('GT',$data['condition']['gt_update_time']):'';//大于
    	$condition['update_time']=$data['condition']['elt_update_time']?array('ELT',$data['condition']['elt_update_time']):'';//小于等于
    	$condition['update_time']=$data['condition']['lt_update_time']?array('LT',$data['condition']['lt_update_time']):'';//小于
    	   
    	$data['page']['page_size'] = $data['page']['page_size']?intval($data['page']['page_size']):12;
    	
    	$list_course_result = $Course_model-> get_course_list($condition,$data['page']['page_size']);
    	$data['list']=$list_course_result['data']['list'];
    	$data['page']=$list_course_result['data']['page'];
     	//print_r($data);
	//print_r($condition);
    	 
        $content = $this->renderFile($Template,$data);
		if($data['format_type']=='json')
		{
			return json_encode(array('status'=>1,'data'=>$content));
		}
		elseif($data['format_type']=='xml')
		{
			
		}
		else{
	        return $content;  
		}
	} 
 }