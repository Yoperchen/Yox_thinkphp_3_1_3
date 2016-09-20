<?php
//商品列表
class ListShareWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'ListShare';
    	$Share_model  =  D('Share');
    	$condition=array();
    	$condition['status']=$data['condition']['status']?$data['condition']['status']:'1';//状态
    	$condition['user_id'] =$data['condition']['user_id']?$data['condition']['user_id']:'';//用户
    	$condition['store_id'] =$data['condition']['store_id']?$data['condition']['store_id']:'';//商家
    	$condition['community_id'] =$data['condition']['community_id']?$data['condition']['community_id']:'';//社区
    	$condition['cuisine_id'] =$data['condition']['cuisine_id']?$data['condition']['cuisine_id']:'';//菜式
    	$condition['article_id'] =$data['condition']['article_id']?$data['condition']['article_id']:'';//文章
    	$condition['good_id'] =$data['condition']['good_id']?$data['condition']['good_id']:'';//商品
    	$condition['order_id'] =$data['condition']['order_id']?$data['condition']['order_id']:'';//订单
    	
    	$condition['add_time']=$data['condition']['add_time']?array('eq',$data['condition']['add_time']):'';//添加时间
    	$condition['add_time']=$data['condition']['egt_add_time']?array('EGT',$data['condition']['egt_add_time']):'';//大于等于
    	$condition['add_time']=$data['condition']['gt_add_time']?array('GT',$data['condition']['gt_add_time']):'';//大于
    	$condition['add_time']=$data['condition']['elt_add_time']?array('ELT',$data['condition']['elt_add_time']):'';//小于等于
    	$condition['add_time']=$data['condition']['lt_add_time']?array('LT',$data['condition']['lt_add_time']):'';//小于
    	 
    	$condition['update_time']=$data['condition']['update_time']?array('eq',$data['condition']['update_time']):'';//修改时间
    	$condition['update_time']=$data['condition']['egt_update_time']?array('EGT',$data['condition']['egt_update_time']):'';//大于等于
    	$condition['update_time']=$data['condition']['gt_update_time']?array('GT',$data['condition']['gt_update_time']):'';//大于
    	$condition['update_time']=$data['condition']['elt_update_time']?array('ELT',$data['condition']['elt_update_time']):'';//小于等于
    	$condition['update_time']=$data['condition']['lt_update_time']?array('LT',$data['condition']['lt_update_time']):'';//小于
    	$data['page']['page_size'] = $data['page']['page_size']?intval($data['page']['page_size']):12;
    	
    	$share_list_result = $Share_model-> get_share_list($condition,$data['page']['page_size']);
		//print_r($share_list_result);
    	$data['list']=$share_list_result['data']['list'];
		$data['page']=$share_list_result['data']['page'];
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