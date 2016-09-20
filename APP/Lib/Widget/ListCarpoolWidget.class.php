<?php
//拼车列表
//{:W('ListArticle',array('template'=>'Yocms_image_list_88','condition'=>array(),'page_template'=>'0'))}
class ListCarpoolWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'ListCarpool';
    	
    	$Carpool_model  =   D('Carpool');
    	
    	$condition = array();//条件
    	$condition['add_user_id']=$data['condition']['add_user_id']?array('eq',$data['condition']['add_user_id']):'';//用户
    	$condition['mobile']=$data['condition']['mobile']?array('eq',$data['condition']['mobile']):'';//手机
    	
    	$condition['seats']=$data['condition']['seats']?array('eq',$data['condition']['seats']):'';//座位数
    	$condition['seats']=$data['condition']['egt_seats']?array('EGT',$data['condition']['egt_seats']):'';//大于等于
    	$condition['seats']=$data['condition']['gt_seats']?array('GT',$data['condition']['gt_seats']):'';//大于
    	$condition['seats']=$data['condition']['elt_seats']?array('ELT',$data['condition']['elt_seats']):'';//小于等于
    	$condition['seats']=$data['condition']['lt_seats']?array('LT',$data['condition']['lt_seats']):'';//小于
    	
    	$condition['price']=$data['condition']['price']?array('eq',$data['condition']['price']):'';//价格
    	$condition['price']=$data['condition']['egt_price']?array('EGT',$data['condition']['egt_price']):'';//大于等于
    	$condition['price']=$data['condition']['gt_price']?array('GT',$data['condition']['gt_price']):'';//大于
    	$condition['price']=$data['condition']['elt_price']?array('ELT',$data['condition']['elt_price']):'';//小于等于
    	$condition['price']=$data['condition']['lt_price']?array('LT',$data['condition']['lt_price']):'';//小于
    	
    	$condition['go_time']=$data['condition']['go_time']?array('eq',$data['condition']['go_time']):'';//出发时间
    	$condition['go_time']=$data['condition']['egt_go_time']?array('EGT',$data['condition']['egt_go_time']):'';//大于等于
    	$condition['go_time']=$data['condition']['gt_go_time']?array('GT',$data['condition']['gt_go_time']):'';//大于
    	$condition['go_time']=$data['condition']['elt_go_time']?array('ELT',$data['condition']['elt_go_time']):'';//小于等于
    	$condition['go_time']=$data['condition']['lt_go_time']?array('LT',$data['condition']['lt_go_time']):'';//小于
    	
    	$condition['origin_address']=$data['condition']['origin_address']?array('like','%'.$data['condition']['origin_address'].'%'):'';//起始地
    	$condition['middle_address']=$data['condition']['middle_address']?array('like','%'.$data['condition']['middle_address'].'%'):'';//经过地
    	$condition['destination_address']=$data['condition']['destination_address']?array('like','%'.$data['condition']['destination_address'].'%'):'';//目的地
    	
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
    	
    	$list_carpool_result = $Carpool_model-> get_carpool_list($condition,$data['page']['page_size']);
    	$data['list']=$list_carpool_result['data']['list'];
    	$data['page']=$list_carpool_result['data']['page'];
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