<?php
//商品分类列表
//{:W('ListGoodsCategory',array('select_store_id'=>2,'is_show'=>1))}  商家为2，不隐藏的商品分类
class ListGoodsCategoryWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'ListShowGoodsCategory';
    	
 		$category_model = D('Goods_category');
 		$condition = array();//条件
 		if(!empty($data['condition']['is_show'])){//是否显示
 			$condition['is_show']=array('eq',$data['condition']['is_show']);
 		}
 		if(!empty($data['condition']['select_store_id'])){//根据商家选分类
 			$condition['store_id']=array('eq',$data['condition']['select_store_id']);
 		}
 		if(!empty($data['condition']['hide_id'])){//不显示的分类，包括其子分类也会不显示
 			$condition['path']=array('notlike','%'.$data['condition']['hide_id'].'%');//不显示子分类
 			$condition['id']=array('neq',$data['hide_id']);//不显示自己
 		}
 		$get_list_result = $category_model->get_good_category_list($condition,$page_size=100);
		//print_r($get_list_result);
    	$data['list'] = $get_list_result['data']['list'];
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