<?php
//地址详情
class DetailFileWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'DetailFile';
    	$condition['id'] = $data['condition']['file_id']?$data['condition']['file_id']:30;//文章id
    	
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