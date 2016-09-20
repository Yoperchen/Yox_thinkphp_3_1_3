<?php
//商家列表
//{:W('ListShowBrands',array('store_id'=>1,'brand_name'=>'为','brand_desc'=>'为'))}
class ListShowBrandsWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'ListShowBrands';
    	 
    	$Stores  =   M('Brand');
    	 
    	$conditions = '';//条件
    	if(!empty($data['store_id'])){
    		$conditions['store_id']=array('eq',$data['store_id']);
    	}
    	if(!empty($data['brand_id'])){
    		$conditions['id']=array('eq',$data['brand_id']);
    	}
    	if(!empty($data['brand_name'])){
    		$conditions['name']=array('like',array('%'.$data['brand_name'].'%'));
    	}
    	if(!empty($data['brand_desc'])){
    		$conditions['desc']=array('like',array('%'.$data['brand_desc'].'%'));
    	}
    	
    	$data['brand_list'] = $Stores-> where($conditions)->order('sort')->limit(0,15)->select();
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