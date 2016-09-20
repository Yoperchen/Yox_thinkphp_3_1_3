<?php
//菜式列表
//{:W('ListCuisine',array('template'=>'Yocms_image_list_88','condition'=>array(),'page_template'=>'0'))}
class ListCuisineWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'ListCuisine';
    	
    	$Cuisine_model  =   D('Cuisine');
    	
    	$condition = array();//条件
    	$condition['store_id']=$data['condition']['store_id']?array('eq',$data['condition']['store_id']):'';//商家
    	$condition['user_id']=$data['condition']['user_id']?array('eq',$data['condition']['user_id']):'';//用户
		$condition['category_id']=$data['condition']['category_id']?array('eq',$data['condition']['category_id']):'';//分类
    	$condition['name']=$data['condition']['name']?array('like','%'.$data['condition']['name'].'%'):'';//菜式名称
    	
    	$data['page']['page_size'] = $data['page']['page_size']?intval($data['page']['page_size']):12;
    	
    	$list_cuisine_result = $Cuisine_model-> get_cuisine_list($condition,$data['page']['page_size']);
    	$data['list']=$list_cuisine_result['data']['list'];
    	$data['page']=$list_cuisine_result['data']['page'];
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