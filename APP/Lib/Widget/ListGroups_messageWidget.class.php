<?php
//文章列表
//{:W('Groups_message',array('template'=>'Yocms_image_list_88','condition'=>array(),'page_template'=>'0'))}
class ListGroups_messageWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'ListGroups_message';
    	
    	$Groups_message_model  =   D('Groups_message');
    	
    	$condition = array();//条件
    	$condition['from_site_id']=$data['condition']['from_site_id']?$data['condition']['from_site_id']:'';//站点
    	$condition['to_site_id']=$data['condition']['to_site_id']?$data['condition']['to_site_id']:'';//接受站点
    	$condition['from_store_id']=$data['condition']['from_store_id']?array('eq',$data['condition']['from_store_id']):'';//商家
    	$condition['to_store_id']=$data['condition']['to_store_id']?array('eq',$data['condition']['to_store_id']):'';//接受商家
    	$condition['from_user_id']=$data['condition']['from_user_id']?array('eq',$data['condition']['from_user_id']):'';//用户
    	$condition['to_user_id']=$data['condition']['to_user_id']?array('eq',$data['condition']['to_user_id']):'';//接受用户
		$condition['to_group_id']=$data['condition']['to_group_id']?array('eq',$data['condition']['to_group_id']):'';//接受群id
    	$condition['community_id']=$data['condition']['community_id']?array('eq',$data['condition']['community_id']):'';//社区
    	$condition['is_read']=$data['condition']['is_read']?array('eq',$data['condition']['is_read']):'';//是否已读|0：未读，1：已读
    	$condition['theme']=$data['condition']['theme']?array('eq',$data['condition']['theme']):'';//消息模版、消息主题、气泡、外框
    	
    	$condition['read_time']=$data['condition']['read_time']?array('eq',$data['condition']['read_time']):'';//添加时间
    	$condition['read_time']=$data['condition']['egt_read_time']?array('EGT',$data['condition']['egt_read_time']):'';//大于等于
    	$condition['read_time']=$data['condition']['gt_read_time']?array('GT',$data['condition']['gt_read_time']):'';//大于
    	$condition['read_time']=$data['condition']['elt_read_time']?array('ELT',$data['condition']['elt_read_time']):'';//小于等于
    	$condition['read_time']=$data['condition']['lt_read_time']?array('LT',$data['condition']['lt_read_time']):'';//小于
    	
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
    	
    	$list_groups_message_result = $Groups_message_model-> get_message_list($condition,$data['page']['page_size']);
    	$data['list']=$list_groups_message_result['data']['list'];
    	$data['page']=$list_groups_message_result['data']['page'];
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