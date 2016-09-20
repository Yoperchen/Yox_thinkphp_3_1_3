<?php
//文章列表
//{:W('ListArticle',array('template'=>'Yocms_image_list_88','condition'=>array(),'page_template'=>'0'))}
class ListStoreWidget extends Widget{  
    public function render($data){ 
		$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'ListStore';
    	
    	$Store_model  =   D('Stores');
    	
    	$condition = '';//条件
    	$condition['site_id']=$data['condition']['site_id']?$data['condition']['site_id']:'';//站点
    	$condition['city_id']=$data['condition']['city_id']?array('eq',$data['condition']['city_id']):'';//城市id
    	$condition['status']=$data['condition']['status']?array('eq',$data['condition']['status']):'';//状态|1正常,2禁止,3黑名单,4删除
    	$condition['community_id']=$data['condition']['community_id']?array('eq',$data['condition']['community_id']):'';//社区
    	$condition['store_name']=$data['condition']['store_name']?array('like','%'.$data['condition']['store_name'].'%'):'';//商家名称
    	$condition['lng']=$data['condition']['lng']?array('eq',$data['condition']['lng']):'';//经度
    	$condition['lat']=$data['condition']['lat']?array('eq',$data['condition']['lat']):'';//纬度
    	
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
    	
    	$list_store_result = $Store_model-> get_store_list($condition,$data['page']['page_size']);
    	$data['list']=$list_store_result['data']['list'];
    	$data['page']=$list_store_result['data']['page'];
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