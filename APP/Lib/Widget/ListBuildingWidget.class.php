<?php
//文章列表
//{:W('ListArticle',array('template'=>'Yocms_image_list_88','condition'=>array(),'page_template'=>'0'))}
class ListBuildingWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'ListBuilding';
    	
    	$Building_model  =   D('Building');
    	
    	$condition = array();//条件
    	$condition['city_id']=$data['condition']['city_id']?$data['condition']['city_id']:'';//城市id
    	$condition['community_id']=$data['condition']['community_id']?array('eq',$data['condition']['community_id']):'';//社区
//     	$condition['user_id']=$data['condition']['user_id']?array('eq',$data['condition']['user_id']):'';//用户
// 	$condition['type']=$data['condition']['type']?array('eq',$data['condition']['type']):'';//1:公告;2:普通文章;3:论坛贴;4日志;5说说
//     	$condition['community']=$data['condition']['community']?array('eq',$data['condition']['community']):'';//社区
//     	$condition['title']=$data['condition']['title']?array('like','%'.$data['condition']['title'].'%'):'';//标题
//     	$condition['author']=$data['condition']['author']?array('like','%'.$data['condition']['author'].'%'):'';//作者

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
    	
    	$list_article_result = $Building_model-> get_building_list($condition,$data['page']['page_size']);
    	$data['list']=$list_article_result['data']['list'];
    	$data['page']=$list_article_result['data']['page'];
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