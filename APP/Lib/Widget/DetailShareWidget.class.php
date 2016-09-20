<?php
//分享详情
class DetailShareWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'DetailCollect';
    	$condition['id'] = $data['condition']['share_id']?$data['condition']['share_id']:30;//分享id
    	
    	$Share_model  =   D('Share');
    	$get_share_result = $Share_model-> getShareById($condition['id']);
    	$data['data']=$get_share_result['data'];
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