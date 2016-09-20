<?php
//商品列表
class ListShowGoodsWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Goods   =   M('Goods');
    	
    	$conditions .=isset($data['goods_category'])?' category='.$data['goods_category']:'';//指定分类
    	
    	$data['goods_list'] = $Goods-> where($conditions)->order('sort')->limit(10)->select();
        $content = $this->renderFile('ListShowGoods',$data);
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