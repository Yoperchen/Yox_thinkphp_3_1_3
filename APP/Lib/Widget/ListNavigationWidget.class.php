<?php
//文章列表
//{:W('ListArticle',array('template'=>'Yocms_image_list_88','condition'=>array(),'page_template'=>'0'))}
class ListNavigationWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'ListGroups_message';
    	
    	$Navigation_model  =   D('Navigation');
    	
    	$condition = array();//条件
    	$condition['site_id']=$data['condition']['site_id']?$data['condition']['site_id']:'';//站点
    	$condition['store_id']=$data['condition']['store_id']?array('eq',$data['condition']['store_id']):'';//商家
    	$condition['user_id']=$data['condition']['user_id']?array('eq',$data['condition']['user_id']):'';//用户
		$condition['pid']=$data['condition']['pid']?array('eq',$data['condition']['pid']):'';//父级分类|1：顶级分类
		$condition['position']=$data['condition']['position']?array('eq',$data['condition']['position']):'';//1:顶部，2：主要导航，3底部导航
    	$condition['name']=$data['condition']['name']?array('like','%'.$data['condition']['name'].'%'):'';//导航名称
    	$condition['description']=$data['condition']['description']?array('like','%'.$data['condition']['description'].'%'):'';//导航描述
    	$condition['blank']=$data['condition']['blank']?array('eq',$data['condition']['blank']):'';//是否新标签打开|0：否，1：是
    	$condition['is_show']=$data['condition']['is_show']?array('eq',$data['condition']['is_show']):'';//1:显示，2：隐藏
    	
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
    	
    	$list_navigation_result = $Navigation_model-> get_navigation_list($condition,$data['page']['page_size']);
    	$data['list']=$list_navigation_result['data']['list'];
    	$data['page']=$list_navigation_result['data']['page'];
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