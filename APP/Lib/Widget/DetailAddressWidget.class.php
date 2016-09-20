<?php
//地址详情
class DetailAddressWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'DetailAddress';
    	$condition['id'] = $data['condition']['addresss_id']?$data['condition']['address_id']:30;//文章id
    	
    	$Address_model  =   D('Address');
    	$get_address_result = $Address_model->get_address_by_id($condition['address_id']);
    	$data['data']=$get_address_result['data'];
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