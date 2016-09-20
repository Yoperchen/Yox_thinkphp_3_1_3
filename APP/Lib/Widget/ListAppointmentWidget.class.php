<?php
//文章列表
//{:W('ListArticle',array('template'=>'Yocms_image_list_88','condition'=>array(),'page_template'=>'0'))}
class ListAppointmentWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'ListAppointment';
    	
    	$Appointment_model  =   D('Appointment');
    	
    	$condition = array();//条件
//     	$condition['site_id']=$data['condition']['site_id']?$data['condition']['site_id']:'';//站点
//     	$condition['apply_user_ids']=$data['condition']['apply_user_ids']?array('like',
//     																			array(
//     																				'%'.$data['condition']['apply_user_id'].',',
//     																				','.$data['condition']['apply_user_id'].'%',
//     																				$data['condition']['apply_user_id']
//     																				),'OR'):'';//申请人
    	$condition['belong_user_id']=$data['condition']['belong_user_id']?array('eq',$data['condition']['belong_user_id']):'';//用户
		$condition['appointment_type']=$data['condition']['appointment_type']?array('eq',$data['condition']['appointment_type']):'';//约会类型|1约人看电影、2约人吃饭、3约人唱K、4约人锻炼、5约人晚修、6选修预约、7约人同行(旅游、回家)
    	$condition['city_id']=$data['condition']['city_id']?array('eq',$data['condition']['city_id']):'';//城市id
    	$condition['title']=$data['condition']['title']?array('like','%'.$data['condition']['title'].'%'):'';//标题
    	$condition['require_sex']=$data['condition']['require_sex']?array('eq',$data['condition']['require_sex']):'';//性别要求|1男，2女，3不限
    	
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
    	
    	$data['page']['page_size'] = $data['page']['page_size']?intval($data['page']['page_size']):15;
    	
    	$list_appointment_result = $Appointment_model-> get_appointment_list($condition,$data['page']['page_size']);
    	$data['list']=$list_appointment_result['data']['list'];
    	$data['page']=$list_appointment_result['data']['page'];
//      	print_r($data);
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