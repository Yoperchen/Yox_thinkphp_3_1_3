<?php
//文章列表
//{:W('ListRental',array('template'=>'Yocms_image_list_88','condition'=>array(),'page_template'=>'0'))}
class ListRentalWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'ListRental';
    	
    	$Rental_model  =   D('Rental');
    	
    	$condition = array();//条件
    	$condition['owner_store_id']=$data['condition']['owner_store_id']?array('eq',$data['condition']['owner_store_id']):'';//商家
    	$condition['owner_user_id']=$data['condition']['owner_user_id']?array('eq',$data['condition']['owner_user_id']):'';//用户
    	$condition['owner_name']=$data['condition']['owner_name']?array('like','%'.$data['condition']['owner_name'].'%'):'';//所有者显示名称
		$condition['category_id']=$data['condition']['category_id']?array('eq',$data['condition']['category_id']):'';//租用分类
		$condition['user_id']=$data['condition']['user_id']?$data['condition']['user_id']:'';//租车的人
    	$condition['next_user_id']=$data['condition']['next_user_id']?array('eq',$data['condition']['next_user_id']):'';//下一个租用者id
    	$condition['third_user_id']=$data['condition']['third_user_id']?array('eq',$data['condition']['third_user_id']):'';//再下个租用者id
    	$condition['time_unit']=$data['condition']['time_unit']?array('eq',$data['condition']['time_unit']):'';//价格时间单位|月、日、年
    	$condition['earnest_money']=$data['condition']['earnest_money']?array('eq',$data['condition']['earnest_money']):'';//定金
    	$condition['is_show']=$data['condition']['is_show']?array('eq',$data['condition']['is_show']):'';//是否开放
    	
    	$condition['rental_price']=$data['condition']['rental_price']?array('eq',$data['condition']['rental_price']):'';//出租价格(单价)
    	$condition['rental_price']=$data['condition']['egt_rental_price']?array('EGT',$data['condition']['egt_rental_price']):'';//大于等于
    	$condition['rental_price']=$data['condition']['gt_rental_price']?array('GT',$data['condition']['gt_rental_price']):'';//大于
    	$condition['rental_price']=$data['condition']['elt_rental_price']?array('ELT',$data['condition']['elt_rental_price']):'';//小于等于
    	$condition['rental_price']=$data['condition']['lt_rental_price']?array('LT',$data['condition']['lt_rental_price']):'';//小于
    	
    	$condition['production_time']=$data['condition']['production_time']?array('eq',$data['condition']['production_time']):'';//出租物生产日期(生日)
    	$condition['production_time']=$data['condition']['egt_production_time']?array('EGT',$data['condition']['egt_production_time']):'';//大于等于
    	$condition['production_time']=$data['condition']['gt_production_time']?array('GT',$data['condition']['gt_production_time']):'';//大于
    	$condition['production_time']=$data['condition']['elt_production_time']?array('ELT',$data['condition']['elt_production_time']):'';//小于等于
    	$condition['production_time']=$data['condition']['lt_production_time']?array('LT',$data['condition']['lt_production_time']):'';//小于
    	
    	$condition['start_use_time']=$data['condition']['start_use_time']?array('eq',$data['condition']['start_use_time']):'';//出租物开始使用日期(汽车开始使用时间)
    	$condition['start_use_time']=$data['condition']['egt_start_use_time']?array('EGT',$data['condition']['egt_start_use_time']):'';//大于等于
    	$condition['start_use_time']=$data['condition']['gt_start_use_time']?array('GT',$data['condition']['gt_start_use_time']):'';//大于
    	$condition['start_use_time']=$data['condition']['elt_start_use_time']?array('ELT',$data['condition']['elt_start_use_time']):'';//小于等于
    	$condition['start_use_time']=$data['condition']['lt_start_use_time']?array('LT',$data['condition']['lt_start_use_time']):'';//小于
    	
//     	$condition['rental_begin_time']=$data['condition']['rental_begin_time']?array('eq',$data['condition']['rental_begin_time']):'';//出租开始时间
//     	$condition['rental_begin_time']=$data['condition']['egt_rental_begin_time']?array('EGT',$data['condition']['egt_rental_begin_time']):'';//大于等于
//     	$condition['rental_begin_time']=$data['condition']['gt_rental_begin_time']?array('GT',$data['condition']['gt_rental_begin_time']):'';//大于
//     	$condition['rental_begin_time']=$data['condition']['elt_rental_begin_time']?array('ELT',$data['condition']['elt_rental_begin_time']):'';//小于等于
//     	$condition['rental_begin_time']=$data['condition']['lt_rental_begin_time']?array('LT',$data['condition']['lt_rental_begin_time']):'';//小于
//     	$condition['rental_end_time']=$data['condition']['rental_end_time']?array('eq',$data['condition']['rental_end_time']):'';//出租结束时间
//     	$condition['rental_end_time']=$data['condition']['egt_rental_end_time']?array('EGT',$data['condition']['egt_rental_end_time']):'';//大于等于
//     	$condition['rental_end_time']=$data['condition']['gt_rental_end_time']?array('GT',$data['condition']['gt_rental_end_time']):'';//大于
//     	$condition['rental_end_time']=$data['condition']['elt_rental_end_time']?array('ELT',$data['condition']['elt_rental_end_time']):'';//小于等于
//     	$condition['rental_end_time']=$data['condition']['lt_rental_end_time']?array('LT',$data['condition']['lt_rental_end_time']):'';//小于
    	
    	
//     	$condition['next_rental_begin_time']=$data['condition']['next_rental_begin_time']?array('eq',$data['condition']['next_rental_begin_time']):'';//下一段租期开始时间
//     	$condition['next_rental_begin_time']=$data['condition']['egt_rental_end_time']?array('EGT',$data['condition']['egt_rental_end_time']):'';//大于等于
//     	$condition['next_rental_begin_time']=$data['condition']['gt_rental_end_time']?array('GT',$data['condition']['gt_rental_end_time']):'';//大于
//     	$condition['next_rental_begin_time']=$data['condition']['elt_rental_end_time']?array('ELT',$data['condition']['elt_rental_end_time']):'';//小于等于
//     	$condition['next_rental_begin_time']=$data['condition']['lt_rental_end_time']?array('LT',$data['condition']['lt_rental_end_time']):'';//小于
//     	$condition['next_rental_end_time']=$data['condition']['next_rental_end_time']?array('eq',$data['condition']['next_rental_end_time']):'';//下一段租期结束时间
//     	$condition['next_rental_end_time']=$data['condition']['egt_next_rental_end_time']?array('EGT',$data['condition']['egt_next_rental_end_time']):'';//大于等于
//     	$condition['next_rental_end_time']=$data['condition']['gt_next_rental_end_time']?array('GT',$data['condition']['gt_next_rental_end_time']):'';//大于
//     	$condition['next_rental_end_time']=$data['condition']['elt_next_rental_end_time']?array('ELT',$data['condition']['elt_next_rental_end_time']):'';//小于等于
//     	$condition['next_rental_end_time']=$data['condition']['lt_next_rental_end_time']?array('LT',$data['condition']['lt_next_rental_end_time']):'';//小于
    	
//     	$condition['third_rental_begin_time']=$data['condition']['third_rental_begin_time']?array('eq',$data['condition']['third_rental_begin_time']):'';//再下一段租期开始时间
//     	$condition['third_rental_begin_time']=$data['condition']['egt_third_rental_begin_time']?array('EGT',$data['condition']['egt_third_rental_begin_time']):'';//大于等于
//     	$condition['third_rental_begin_time']=$data['condition']['gt_third_rental_begin_time']?array('GT',$data['condition']['gt_third_rental_begin_time']):'';//大于
//     	$condition['third_rental_begin_time']=$data['condition']['elt_third_rental_begin_time']?array('ELT',$data['condition']['elt_third_rental_begin_time']):'';//小于等于
//     	$condition['third_rental_begin_time']=$data['condition']['lt_third_rental_begin_time']?array('LT',$data['condition']['lt_third_rental_begin_time']):'';//小于
//     	$condition['third_rental_end_time']=$data['condition']['third_rental_end_time']?array('eq',$data['condition']['third_rental_end_time']):'';//再下一段租期结束时间
//     	$condition['third_rental_end_time']=$data['condition']['egt_third_rental_end_time']?array('EGT',$data['condition']['egt_third_rental_end_time']):'';//大于等于
//     	$condition['third_rental_end_time']=$data['condition']['gt_third_rental_end_time']?array('GT',$data['condition']['gt_third_rental_end_time']):'';//大于
//     	$condition['third_rental_end_time']=$data['condition']['elt_third_rental_end_time']?array('ELT',$data['condition']['elt_third_rental_end_time']):'';//小于等于
//     	$condition['third_rental_end_time']=$data['condition']['lt_third_rental_end_time']?array('LT',$data['condition']['lt_third_rental_end_time']):'';//小于
    	
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
    	
    	$list_rental_result = $Rental_model-> get_rental_list($condition,$data['page']['page_size']);
    	$data['list']=$list_rental_result['data']['list'];
    	$data['page']=$list_rental_result['data']['page'];
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