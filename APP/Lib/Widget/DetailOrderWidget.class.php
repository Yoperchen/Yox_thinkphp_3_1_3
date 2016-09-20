<?php
//文章详情
class DetailOrderWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'DetailOrder';
    	$order_id = $data['condition']['order_id']?$data['condition']['order_id']:30;//文章id
    	
    	$Order_model  =   D('Order');
    	$get_order_result = $Order_model-> get_order_info($order_id,$isdetail=0,$field="order_id");

    	$data['data']=$get_order_result['data'];
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