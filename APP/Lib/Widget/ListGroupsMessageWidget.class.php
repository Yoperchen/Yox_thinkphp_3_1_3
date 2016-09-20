<?php
//文章列表
//{:W('ListArticle',array('template'=>'Yocms_image_list_88','condition'=>array(),'page_template'=>'0'))}
class ListGroupsMessageWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'ListMessage';
    	
    	$Groups_message_model  =   D('Groups_message');
    	
    	$condition = '';//条件
    	$condition['from_site_id']=$data['condition']['from_site_id']?$data['condition']['from_site_id']:'';//来自哪个网站
    	$condition['to_site_id']=$data['condition']['to_site_id']?array('eq',$data['condition']['to_site_id']):'';//发去哪个网站
    	$condition['api_partner_id']=$data['condition']['api_partner_id']?array('eq',$data['condition']['api_partner_id']):'';//第三方合作伙伴id
	$condition['from_user_id']=$data['condition']['from_user_id']?array('eq',$data['condition']['from_user_id']):'';//发送用户id
	$condition['to_group_id']=$data['condition']['to_group_id']?array('eq',$data['condition']['to_group_id']):'';//群id
    	$condition['to_user_id']=$data['condition']['to_user_id']?array('eq',$data['condition']['to_user_id']):'';//接受用户id
    	$condition['title']=$data['condition']['title']?array('like','%'.$data['condition']['title'].'%'):'';//标题
    	$condition['is_read']=$data['condition']['is_read']?array('eq',$data['condition']['is_read']):'';//是否已读|0：未读，1：已读
    	$condition['theme']=$data['condition']['theme']?array('eq',$data['condition']['theme']):'';//消息模版、消息主题、气泡、外框
    	
    	$data['page']['page_size'] = $data['page']['page_size']?intval($data['page']['page_size']):12;
    	
    	$list_message_result = $Groups_message_model-> get_message_list($condition,$page_size=20);
    	$data['list']=$list_message_result['data']['list'];
    	$data['page']=$list_message_result['data']['page'];
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