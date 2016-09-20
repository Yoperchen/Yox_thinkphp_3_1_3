<?php
//添加约会
class AddPermissionsWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'AddPermissions';
    	//$condition['share_id'] = $data['condition']['share_id']?$data['condition']['share_id']:'';
    	
    	//$Share_model = D('Share');
    	//$data['add_share_data']=$condition['share_id']?$Share_model->getShareById($condition['share_id'],$isdetail=0):$data['add_share_data'];
    	
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