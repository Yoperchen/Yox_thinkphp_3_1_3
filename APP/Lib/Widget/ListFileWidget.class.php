<?php
//文件列表
//{:W('ListFile',array('template'=>'Yocms_image_list_88','condition'=>array(),'page_template'=>'0'))}
class ListFileWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'ListFile';
    	
    	$Files_model  =   D('Files');
    	
    	$condition = array();//条件
    	$condition['site_id']=$data['condition']['site_id']?$data['condition']['site_id']:'';//站点
    	$condition['store_id']=$data['condition']['store_id']?array('eq',$data['condition']['store_id']):'';//上传的商家
    	$condition['user_id']=$data['condition']['user_id']?array('eq',$data['condition']['user_id']):'';//上传者
		$condition['type']=$data['condition']['type']?array('eq',$data['condition']['type']):'';//文件类型|图片、其他
    	$condition['community_id']=$data['condition']['community']?array('eq',$data['condition']['community']):'';//社区
    	$condition['description']=$data['condition']['description']?array('like','%'.$data['condition']['description'].'%'):'';//标题
    	
    	$condition['like']=$data['condition']['like']?array('eq',$data['condition']['like']):'';//喜欢
    	$condition['like']=$data['condition']['egt_like']?array('EGT',$data['condition']['egt_like']):'';//大于等于
    	$condition['like']=$data['condition']['gt_like']?array('GT',$data['condition']['gt_like']):'';//大于
    	$condition['like']=$data['condition']['elt_like']?array('ELT',$data['condition']['elt_like']):'';//小于等于
    	$condition['like']=$data['condition']['lt_like']?array('LT',$data['condition']['lt_like']):'';//小于
    	
    	$condition['up']=$data['condition']['up']?array('eq',$data['condition']['up']):'';//赞
    	$condition['up']=$data['condition']['egt_up']?array('EGT',$data['condition']['egt_up']):'';//大于等于
    	$condition['up']=$data['condition']['gt_up']?array('GT',$data['condition']['gt_up']):'';//大于
    	$condition['up']=$data['condition']['elt_up']?array('ELT',$data['condition']['elt_up']):'';//小于等于
    	$condition['up']=$data['condition']['lt_up']?array('LT',$data['condition']['lt_up']):'';//小于
    	
    	$condition['down']=$data['condition']['down']?array('eq',$data['condition']['down']):'';//差
    	$condition['down']=$data['condition']['egt_down']?array('EGT',$data['condition']['egt_down']):'';//大于等于
    	$condition['down']=$data['condition']['gt_down']?array('GT',$data['condition']['gt_down']):'';//大于
    	$condition['down']=$data['condition']['elt_down']?array('ELT',$data['condition']['elt_down']):'';//小于等于
    	$condition['down']=$data['condition']['lt_down']?array('LT',$data['condition']['lt_down']):'';//小于
    	
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
    	
    	$list_file_result = $Files_model-> get_file_list($condition,$data['page']['page_size']);
    	$data['list']=$list_file_result['data']['list'];
    	$data['page']=$list_file_result['data']['page'];
//      print_r($data);
//		print_r($condition);
    	 
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