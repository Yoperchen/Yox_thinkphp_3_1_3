<?php
//好友列表
//{:W('ListUser_friends',array('template'=>'Yocms_image_list_88','condition'=>array(),'page_template'=>'0'))}
class ListUser_friendsWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'ListUser_friends';
    	
    	$User_frients_model  =   D('User_friends');
    	
    	$condition = '';//条件
    	$condition['site_id']=$data['condition']['site_id']?$data['condition']['site_id']:'';//站点
    	$condition['store_id']=$data['condition']['store_id']?array('eq',$data['condition']['store_id']):'';//商家
    	$condition['user_id']=$data['condition']['user_id']?array('eq',$data['condition']['user_id']):'';//用户
		$condition['friend_user_id']=$data['condition']['friend_user_id']?array('eq',$data['condition']['friend_user_id']):'';//好友id
		$condition['friend_category_id']=$data['condition']['friend_category_id']?array('eq',$data['condition']['friend_category_id']):'';//好友分类
    	$condition['community_id']=$data['condition']['community_id']?array('eq',$data['condition']['community_id']):'';//社区
    	$condition['friend_remark_name']=$data['condition']['friend_remark_name']?array('like','%'.$data['condition']['friend_remark_name'].'%'):'';//好友备注
    	$condition['remark']=$data['condition']['remark']?array('like','%'.$data['condition']['remark'].'%'):'';//更多备注信息
    	$condition['friend_user_sort']=$data['condition']['friend_user_sort']?array('eq',$data['condition']['friend_user_sort']):'';//好友排序
    	$condition['friend_user_status']=$data['condition']['friend_user_status']?array('eq',$data['condition']['friend_user_status']):'';//好友状态|1正常 0黑名单、禁止活动/删除
    	
    	$data['page']['page_size'] = $data['page']['page_size']?intval($data['page']['page_size']):12;
    	
    	$list_frient_result = $User_frients_model-> get_friend_list($condition,$data['page']['page_size']);
    	$data['list']=$list_frient_result['data']['list'];
    	$data['page']=$list_frient_result['data']['page'];
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