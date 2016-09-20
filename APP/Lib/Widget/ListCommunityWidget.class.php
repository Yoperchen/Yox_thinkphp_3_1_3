<?php
//社区列表
//{:W('ListCommunity',array('template'=>'Yocms_image_list_88','condition'=>array(),'page_template'=>'0'))}
class ListCommunityWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'ListCommunity';
    	
    	$Community_model  =   D('Community');
    	
    	$condition = '';//条件
	$condition['group']=$data['condition']['group']?$data['condition']['group']:'';//分组
	
    	$condition['name']=$data['condition']['name']?array('like','%'.$data['condition']['name'].'%'):'';//社区名称
    	$condition['desc']=$data['condition']['desc']?array('like','%'.$data['condition']['desc'].'%'):'';//社区描述
    	$condition['official']=$data['condition']['official']?array('like','%'.$data['condition']['official'].'%'):'';//官方|私立华联学院，合生创展，国美等
    	$condition['city_id']=$data['condition']['city_id']?$data['condition']['city_id']:'';//城市id
    	$condition['district_id']=$data['condition']['district_id']?array('eq',$data['condition']['district_id']):'';//对应district表的id
    	$condition['is_school']=$data['condition']['is_school']?array('eq',$data['condition']['is_school']):'';//用户
    	$condition['latitude']=$data['condition']['latitude']?array('eq',$data['condition']['latitude']):'';//纬度
    	$condition['longitude']=$data['condition']['longitude']?array('eq',$data['condition']['longitude']):'';//经度
    	
    	$condition['geohash']=$data['condition']['geohash']?array('eq',$data['condition']['geohash']):'';//geohash
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
    	
    	$data['page']['page_size'] = $data['page']['page_size']?intval($data['page']['page_size']):10000;
    	
    	$list_community_result = $Community_model-> get_community_list($condition,$data['page']['page_size']);
    	$data['list']=$list_community_result['data']['list'];
    	$data['page']=$list_community_result['data']['page'];
     	//print_r($data);
	//print_r($condition);
	//print_r($list_community_result);
    	 
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