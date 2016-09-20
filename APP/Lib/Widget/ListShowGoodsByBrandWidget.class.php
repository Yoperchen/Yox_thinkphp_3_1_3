<?php
//根据品牌的商品列表
class ListShowGoodsByBrandWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'ListShowStores';
    	
    	$Goods   =   M('Goods');
    	$conditions = '';
    	if(!empty($data['goods_brand'])){
    		$conditions['goods_brand']=array('eq',$data['goods_brand']);
    	}

    	$data['goods_list'] = $Goods-> where($conditions)->order('sort')->limit(10)->select();
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