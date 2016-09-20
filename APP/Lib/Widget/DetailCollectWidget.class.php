<?php
//收藏详情
class DetailCollectWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'DetailCollect';
    	$condition['id'] = $data['condition']['collect_id']?$data['condition']['collect_id']:30;//收藏id
    	
    	$Collect_model  =   D('Collect');
    	$get_article_result = $Collect_model-> get_collect_by_id($condition['id']);
    	$data['data']=$get_article_result['data'];
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