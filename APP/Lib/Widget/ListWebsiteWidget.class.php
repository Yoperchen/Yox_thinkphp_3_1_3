<?php
//网站列表
class ListWebsiteWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'ListWebsite';
    	$Website_model  =  D('Website');
    	$condition=array();
//     	$condition['belong_site_id'] =$data['condition']['belong_site_id']?$data['condition']['belong_site_id']:'';//站点id
//     	$condition['belong_user_id'] =$data['condition']['belong_user_id']?$data['condition']['belong_user_id']:'';//用户
//     	$condition['status']=$data['condition']['status']?$data['condition']['status']:'1';//状态
//     	$condition['store_id'] =$data['condition']['store_id']?$data['condition']['store_id']:'';//商家
    	$condition['id'] =$data['condition']['website_id']?$data['condition']['website_id']:'';//收藏id
    	$condition['is_show'] =$data['condition']['is_show']?$data['condition']['is_show']:'';//是否显示
    	$condition['category_id'] =$data['condition']['category_id']?$data['condition']['category_id']:'';//分类id
    	
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
    	
    	$website_list_result = $Website_model-> get_website_list($condition,$data['page']['page_size']);
    	$data['list']=$website_list_result['data']['list'];
    	$data['page']=$website_list_result['data']['page'];
//     	print_r($data);
        $content = $this->renderFile($Template,$data);
        if($data['format_type']=='json')
		{
			return json_encode(array('status'=>1,'data'=>$content));
		}
		elseif($data['format_type']=='xml')
		{
			
		}
		else
		{
	        return $content;  
		} 
	 } 
 }