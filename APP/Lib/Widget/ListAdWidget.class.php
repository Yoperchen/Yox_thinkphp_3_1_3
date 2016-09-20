<?php
//商家列表
//{:W('ListArticleCategory',array('template'=>'admin_store_ListArticleCategory','store_id'=>1))}
class ListAdWidget extends Widget{  
 public function render($data){ 
 		$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'ListAd';
    	$Ad_model = D('Ad');
    	
    	$condition['belong_user_id']=$data['condition']['belong_user_id']?array('eq',$data['condition']['belong_user_id']):'';//用户
    	$condition['user_id']=$data['condition']['user_id']?array('eq',$data['condition']['user_id']):'';//用户
    	$condition['store_id']=$data['condition']['store_id']?array('eq',$data['condition']['store_id']):'';//商家id
    	$condition['api_partner_id']=$data['condition']['api_partner_id']?array('eq',$data['condition']['api_partner_id']):'';//
    	$condition['partner_site_id']=$data['condition']['partner_site_id']?array('eq',$data['condition']['partner_site_id']):'';//
    	$condition['type']=$data['condition']['type']?array('eq',$data['condition']['type']):'';//广告类型|link(链接)、text(文字)、picture(图片)
    	$condition['platform']=$data['condition']['platform']?array('eq',$data['condition']['platform']):'';//设备|AN/IP/H5/WB/MAC/KI
    	
    	$condition['begin_time']=$data['condition']['begin_time']?array('eq',$data['condition']['begin_time']):'';//添加时间
    	$condition['begin_time']=$data['condition']['egt_begin_time']?array('EGT',$data['condition']['egt_begin_time']):'';//大于等于
    	$condition['begin_time']=$data['condition']['gt_begin_time']?array('GT',$data['condition']['gt_begin_time']):'';//大于
    	$condition['begin_time']=$data['condition']['elt_begin_time']?array('ELT',$data['condition']['elt_begin_time']):'';//小于等于
    	$condition['begin_time']=$data['condition']['lt_begin_time']?array('LT',$data['condition']['lt_begin_time']):'';//小于
    	 
    	$condition['end_time']=$data['condition']['end_time']?array('eq',$data['condition']['end_time']):'';//修改时间
    	$condition['end_time']=$data['condition']['egt_end_time']?array('EGT',$data['condition']['egt_end_time']):'';//大于等于
    	$condition['end_time']=$data['condition']['gt_end_time']?array('GT',$data['condition']['gt_end_time']):'';//大于
    	$condition['end_time']=$data['condition']['elt_end_time']?array('ELT',$data['condition']['elt_end_time']):'';//小于等于
    	$condition['end_time']=$data['condition']['lt_end_time']?array('LT',$data['condition']['lt_end_time']):'';//小于
    	
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
    	
    	$list_adt_result = $Ad_model-> get_ad_list($condition,$data['page']['page_size']);
    	$data['list']=$list_adt_result['data']['list'];
    	$data['page']=$list_adt_result['data']['page'];
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