<?php
//文章列表
//{:W('ListArticle',array('template'=>'Yocms_image_list_88','condition'=>array(),'page_template'=>'0'))}
class ListUserWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'ListUser';
    	
//     	$Article  =   D('Article');
    	
//     	$condition = '';//条件
//     	$condition['site_id']=$data['condition']['site_id']?$data['condition']['site_id']:'';//站点
//     	$condition['store_id']=$data['condition']['store_id']?array('eq',$data['condition']['store_id']):'';//商家
//     	$condition['user_id']=$data['condition']['user_id']?array('eq',$data['condition']['user_id']):'';//用户
// 	$condition['type']=$data['condition']['type']?array('eq',$data['condition']['type']):'';//1:公告;2:普通文章;3:论坛贴;4日志;5说说
//     	$condition['community']=$data['condition']['community']?array('eq',$data['condition']['community']):'';//社区
//     	$condition['title']=$data['condition']['title']?array('like','%'.$data['condition']['title'].'%'):'';//标题
//     	$condition['author']=$data['condition']['author']?array('like','%'.$data['condition']['author'].'%'):'';//作者
    	
//     	$data['page']['page_size'] = $data['page']['page_size']?intval($data['page']['page_size']):12;
    	
//     	$list_article_result = $Article-> get_article_list($condition,$data['page']['page_size']);
//     	$data['list']=$list_article_result['data']['list'];
//     	$data['page']=$list_article_result['data']['page'];
     	//print_r($data);
	//print_r($condition);
    	 
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