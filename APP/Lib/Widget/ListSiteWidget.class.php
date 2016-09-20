<?php
//商家列表
class ListSiteWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'ListSite';
    	$condition = '';
    	$Partner_site_model  =   D('Partner_site');
    	$result = $Partner_site_model-> get_site_list( $condition, $page_size=50);
    	$data['list']=$result['data']['list'];
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