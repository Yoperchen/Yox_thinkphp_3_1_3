<?php
//客服
class CustomerServiceWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'CustomerService';
    	$condition['goods_id'] = $data['condition']['article_id']?$data['condition']['article_id']:'';//商品id
    	$Article_model  =   D('Article');
    	$get_article_result = $Article_model-> getArticleById($data['condition']['article_id']);
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