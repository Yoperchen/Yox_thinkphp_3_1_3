<?php
//隐私列表
//{:W('ListPrivacy',array('template'=>'Yocms_image_list_88','condition'=>array(),'page_template'=>'0'))}
class ListPrivacyWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'ListPrivacy';
    	
    	$Privacy_model  =   D('Privacy');
    	
    	$condition = '';//条件
    	$condition['belong_user_id']=$data['condition']['belong_user_id']?array('eq',$data['condition']['belong_user_id']):'';//属于哪个用户的隐私策略
		$condition['restriction_type']=$data['condition']['restriction_type']?array('eq',$data['condition']['restriction_type']):'';//限制类型|1白名单，2黑名单,3回答问题可见
    	$condition['content']=$data['condition']['content']?array('eq',$data['condition']['content']):'';//内容类型|all所有内容/article5654指定文章/goods888指定商品/
    	$condition['user']=$data['condition']['user']?array($data['condition']['user']):'';//目标用户|all:所有人可见、friend:好友可见、oneself:自己可见、followers关注着可见、1，2，3指定用户可见
    	$condition['status']=$data['condition']['status']?array('eq',$data['condition']['status']):'';//是否启用|1启用、2不启用(隐私策略无效)
    	
    	$data['page']['page_size'] = $data['page']['page_size']?intval($data['page']['page_size']):12;
    	
    	$list_article_result = $Privacy_model-> get_privacy_list($condition,$data['page']['page_size']);
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