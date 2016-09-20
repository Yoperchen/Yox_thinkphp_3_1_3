<?php
//地址详情
class DetailUser_frientsWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'DetailUser_frients';
    	$condition['id'] = $data['condition']['user_frients_id']?$data['condition']['user_frients_id']:30;//文章id
    	
    	$User_frients_model  =   D('User_frients');
    	
    	$condition['id']=$data['condition']['user_frient_id']?$data['condition']['user_frient_id']:'';//id
    	
    	$data['page']['page_size'] = $data['page']['page_size']?intval($data['page']['page_size']):12;
    	
    	$get_user_frients_result = $User_frients_model-> get_friend_info_by_id($condition['id']);
    	$data['data']=$get_user_frients_result['data'];
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