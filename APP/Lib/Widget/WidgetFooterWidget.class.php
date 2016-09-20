<?php
//小部件底部
class WidgetFooterWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'WidgetFooter';
    	//$condition['address_id'] = $data['condition']['address_id']?$data['condition']['address_id']:'';
    	
    	//$Address_model = D('Address');
    	//$data['add_share_data']=$condition['share_id']?$Article_model->getShareById($condition['share_id'],$isdetail=0):$data['add_share_data'];
    	
     	//print_r($data);
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