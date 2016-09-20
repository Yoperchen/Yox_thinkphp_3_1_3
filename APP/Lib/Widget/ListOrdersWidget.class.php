<?php
//最新商品订单
// {:W('ListOrders',array('select_store_id'=>2,'select_user_id'=>1))}   调用商家id=2 and 用户id=1的订单
class ListOrdersWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'ListOrders';
    	
    	$conditions = '';//条件
    	if(!empty($data['store_id'])){//根据用户id参照订单
    		$conditions['store_id']=array('eq',$data['store_id']);
    	}
    	if(!empty($data['select_user_id'])){//根据用户id参照订单
    		$conditions['user_id']=array('eq',$data['select_user_id']);
    	}
    	$Stores  =   M('Goods_order');
    	$data['orders_list'] = $Stores-> where($conditions)->order('addTime desc')->limit(0,15)->select();
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