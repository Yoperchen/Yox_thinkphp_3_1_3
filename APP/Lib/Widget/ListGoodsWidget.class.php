<?php
//商品列表
class ListGoodsWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'ListGoods';
    	$Goods   =   D('Goods');
    	$condition=array();
    	$condition['status']=$data['condition']['status']?$data['condition']['status']:'';//
    	$condition['category_id'] =$data['condition']['category_id']?$data['condition']['category_id']:'';//指定分类
    	$condition['brand_id'] =$data['condition']['brand_id']?$data['condition']['brand_id']:'';//指定品牌
    	$condition['user_id'] =$data['condition']['user_id']?$data['condition']['user_id']:'';//所属用户
    	$condition['store_id'] =$data['condition']['store_id']?$data['condition']['store_id']:'';//所属商家
    	
    	$condition['quantity']=$data['condition']['quantity']?array('eq',$data['condition']['quantity']):'';//商品数量
    	$condition['quantity']=$data['condition']['egt_quantity']?array('EGT',$data['condition']['egt_quantity']):'';//大于等于
    	$condition['quantity']=$data['condition']['gt_quantity']?array('GT',$data['condition']['gt_quantity']):'';//大于
    	$condition['quantity']=$data['condition']['elt_quantity']?array('ELT',$data['condition']['elt_quantity']):'';//小于等于
    	$condition['quantity']=$data['condition']['lt_quantity']?array('LT',$data['condition']['lt_quantity']):'';//小于
    	
    	$condition['price']=$data['condition']['price']?array('eq',$data['condition']['price']):'';//价格
    	$condition['price']=$data['condition']['egt_price']?array('EGT',$data['condition']['egt_price']):'';//大于等于
    	$condition['price']=$data['condition']['gt_price']?array('GT',$data['condition']['gt_price']):'';//大于
    	$condition['price']=$data['condition']['elt_price']?array('ELT',$data['condition']['elt_price']):'';//小于等于
    	$condition['price']=$data['condition']['lt_price']?array('LT',$data['condition']['lt_price']):'';//小于
    	
    	$condition['begin_sales_time']=$data['condition']['begin_sales_time']?array('eq',$data['condition']['begin_sales_time']):'';//销售时间段开始|有些人暑假不开放技能|0为不限制
    	$condition['begin_sales_time']=$data['condition']['egt_begin_sales_time']?array('EGT',$data['condition']['egt_begin_sales_time']):'';//大于等于
    	$condition['begin_sales_time']=$data['condition']['gt_begin_sales_time']?array('GT',$data['condition']['gt_begin_sales_time']):'';//大于
    	$condition['begin_sales_time']=$data['condition']['elt_begin_sales_time']?array('ELT',$data['condition']['elt_begin_sales_time']):'';//小于等于
    	$condition['begin_sales_time']=$data['condition']['lt_begin_sales_time']?array('LT',$data['condition']['lt_begin_sales_time']):'';//小于
    	
    	$condition['end_sales_time']=$data['condition']['end_sales_time']?array('eq',$data['condition']['end_sales_time']):'';//每天可以销售时间结束|0为不限时间，24小时销售
    	$condition['end_sales_time']=$data['condition']['egt_end_sales_time']?array('EGT',$data['condition']['egt_end_sales_time']):'';//大于等于
    	$condition['end_sales_time']=$data['condition']['gt_end_sales_time']?array('GT',$data['condition']['gt_end_sales_time']):'';//大于
    	$condition['end_sales_time']=$data['condition']['elt_end_sales_time']?array('ELT',$data['condition']['elt_end_sales_time']):'';//小于等于
    	$condition['end_sales_time']=$data['condition']['lt_end_sales_time']?array('LT',$data['condition']['lt_end_sales_time']):'';//小于
    	
    	$condition['community_id'] =$data['condition']['community_id']?$data['condition']['community_id']:'';//社区id
    	$condition['city_id'] =$data['condition']['city_id']?$data['condition']['city_id']:'';//城市id
    	$condition['district_id'] =$data['condition']['district_id']?$data['condition']['district_id']:'';//对应district_id表
    	$condition['mobile'] =$data['condition']['mobile']?$data['condition']['mobile']:'';//联系电话|可能是帮别人上传的商品，故有电话
    	
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
    	
    	 $goods_list_result = $Goods-> get_goods_list($condition,$data['page']['page_size']);
    	 $data['list']=$goods_list_result['data']['list'];
    	 $data['page']=$goods_list_result['data']['page'];
//     	 print_r($data);
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