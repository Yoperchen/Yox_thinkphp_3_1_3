<?php
//文章详情
class DetailArticleWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'DetailArticle';
    	$condition['id'] = $data['condition']['article_id']?$data['condition']['article_id']:30;//文章id
    	
    	$Article_model  =   D('Article');
    	$get_article_result = $Article_model-> getArticleById($condition['id']);
    	$data['data']=$get_article_result['data'];
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