<?php
//用户详情
class DetailUserWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'DetailUser';
    	$condition['id'] = $data['condition']['user_id']?$data['condition']['user_id']:'';//商品id
    	$User_model  =   D('User');
    	$get_user_result = $User_model-> get_user_info($condition,$isdetail=0);
    	$data['data']=$get_user_result['data'];
     	//print_r($get_user_result);
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