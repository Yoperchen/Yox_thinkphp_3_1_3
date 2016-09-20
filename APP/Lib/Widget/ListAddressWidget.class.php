<?php
//商家列表
//{:W('ListArticleCategory',array('template'=>'admin_store_ListArticleCategory','store_id'=>1))}
class ListAddressWidget extends Widget{  
 public function render($data){ 
		$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'ListAddress';
    	$page_size=$data['page']['page_size']?$data['page']['page_size']:15;
    	
 		$Address_model = D('Address');
 		$condition = array();//条件
 		$condition['belong_user_id']=$data['condition']['belong_user_id']?$data['condition']['belong_user_id']:'';
 		$condition['belong_store_id']=$data['condition']['belong_store_id']?$data['condition']['belong_store_id']:'';
 		$condition['country_id']=$data['condition']['country_id']?$data['condition']['country_id']:'';//国家
 		$condition['province_id']=$data['condition']['province_id']?$data['condition']['province_id']:'';//省份
 		$condition['city_id']=$data['condition']['city_id']?$data['condition']['city_id']:'';//城市
 		$condition['district_id']=$data['condition']['district_id']?$data['condition']['district_id']:'';//区|天河区
 		$condition['default']=$data['condition']['default']?$data['condition']['default']:'';//1:默认地址
 		
 		$get_address_list_result = $Address_model->get_address_list( $condition, $page_size);
    	$data['list'] = $get_address_list_result['data']['list'];
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