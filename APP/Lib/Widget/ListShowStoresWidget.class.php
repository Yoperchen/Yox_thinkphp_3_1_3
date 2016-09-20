<?php
 //商家列表
 //{:W('ListShowStores',array('template'=>'admin_store_ListArticle','store_id'=>1))}
 class ListShowStoresWidget extends Widget{
 	public function render($data){
 		$data['application'] = isset($data['application'])?$data['application']:'Common';
 		$Template = '';//模版
 		$Template = isset($data['template'])?$data['template']:'ListShowStores';
 		 
 		$Stores  =   M('Stores');
 		 
 		$conditions = '';//条件
 		if(!empty($data['store_id'])){
 			$conditions['store_id']=array('eq',$data['store_id']);
 		}
 		if(!empty($data['store_name'])){
 			$conditions['store_name']=array('like','%'.$data['store_name'].'%');
 		}
 		$data['stores_list'] = $Stores-> where($conditions)->order('sort')->limit(0,15)->select();
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