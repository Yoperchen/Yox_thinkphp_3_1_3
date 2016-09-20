<?php
//访问日志列表
//{:W('ListVisit_log',array('template'=>'Yocms_image_list_88','condition'=>array(),'page_template'=>'0'))}
class ListVisit_logWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'ListVisit_log';
    	
    	$Visit_log_model  =   D('Visit_log');
    	
    	$condition = '';//条件
    	$condition['visit_user_id']=$data['condition']['visit_user_id']?$data['condition']['visit_user_id']:'';//访问者
    	$condition['interviewees_user_id']=$data['condition']['interviewees_user_id']?array('eq',$data['condition']['interviewees_user_id']):'';//被访问者
    	$condition['interviewees_store_id']=$data['condition']['interviewees_store_id']?array('eq',$data['condition']['interviewees_store_id']):'';//被访问商家
    	$condition['community_id']=$data['condition']['community_id']?array('eq',$data['condition']['community_id']):'';//社区
    	$condition['visit_content']=$data['condition']['visit_content']?array('like','%'.$data['condition']['visit_content'].'%'):'';//访问内容
    	$condition['visit_url']=$data['condition']['visit_url']?array('like','%'.$data['condition']['visit_url'].'%'):'';//访问url
    	$condition['is_show']=$data['condition']['is_show']?array('eq',$data['condition']['is_show']):'';//是否显示
    	$condition['is_anonymous']=$data['condition']['is_anonymous']?array('eq',$data['condition']['is_anonymous']):'';//隐身访问
    	$condition['is_delete']=$data['condition']['is_delete']?array('eq',$data['condition']['is_delete']):'';//是否删除|
    	
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
    	 
    	$data['page']['page_size'] = $data['page']['page_size']?intval($data['page']['page_size']):12;
    	
    	$list_article_result = $Visit_log_model-> get_visit_log_list($condition,$data['page']['page_size']);
    	$data['list']=$list_article_result['data']['list'];
    	$data['page']=$list_article_result['data']['page'];
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