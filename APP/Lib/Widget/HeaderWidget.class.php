<?php
//通用头部
class HeaderWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'Header';
    	
    	$Partner_site_model  =   D('Partner_site');
    	$condition = '';//条件查询
    	$condition['id']=$data['condition']['site_id']?$data['condition']['site_id']:'';//站点
    	$site_info_result = $Partner_site_model->get_site_by_id( $condition['id'],$isdetail=0);
    	$data['site_info']=$site_info_result['data'];
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