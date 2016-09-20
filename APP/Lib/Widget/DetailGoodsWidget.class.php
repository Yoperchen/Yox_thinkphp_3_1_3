<?php
//品牌列表
class DetailGoodsWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'DetailGoods';
    	$condition['id'] = $data['condition']['goods_id']?$data['condition']['goods_id']:'';//商品id
    	$Goods_model  =   D('Goods');
    	$get_goods_result = $Goods_model-> getGoodById($data['condition']['goods_id'],$isdetail=0);
    	$data['data']=$get_goods_result['data'];
//     	print_r($data);
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