<?php
//地址详情
class DetailGroups_messageWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'DetailGroups_message';
    	$condition['id'] = $data['condition']['groups_message_id']?$data['condition']['groups_message_id']:30;//文章id
    	
//     	$Article_model  =   D('Article');
//     	$get_article_result = $Article_model-> getArticleById($condition['article_id']);
//     	$data['data']=$get_article_result['data'];
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