<?php
/**
 * 群组消息
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 */
class Groups_messageModel extends Model {
	/**
	 * 添加分组
	 * @param array $data
	 */
	public function add_message($data){
		$data=array_filter($data);//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$data['add_time']=time();
		$result=array('status'=>0,'message'=>'data不能为空');
		if(!empty($data['from_user_id'])&&!is_numeric($data['from_user_id'])){
			$result=array('status'=>0,'message'=>'user_id 错误','data'=>$data);
			return $result;
		}
		if(empty($data['message_content'])){
			$result=array('status'=>0,'message'=>'消息内容不能为空','data'=>$data);
			return $result;
		}
		if(!empty($data['to_group_id'])&&!is_numeric($data['to_group_id'])){
			$result=array('status'=>0,'message'=>'发送者id必须事数字','data'=>$data);
			return $result;
		}
		$condition_tmp['id']=$data['to_group_id'];
		$group_info = M('Groups')->where($condition_tmp)->find();
		if(empty($group_info)){
			$result=array('status'=>0,'message'=>'该群不存在，请确认群id正确','data'=>$data);
			return $result;
		}
		if(!empty($data)){
			$message_id=$this->data($data)->add();
		}
			
		if($message_id)
		{
			$data['id']=$message_id;
			$result=array(
					'status'=>1,
					'message'=>'成功',
					'data'=>$data
					);
		}
		else{
			$result=array(
					'status'=>0,
					'message'=>'失败',
					'data'=>$data
			);
		}
		return $result;
	}
	/**
	 * 获取单个消息
	 * @param number $id
	 * @return array
	 */
	public function get_message($id=0){
		if(empty($id)){ 
			$data=array('status'=>0,'message'=>'id不能为空');
			return $data;
		}
		$message_info = $this->where(array('id'=>$id))->find();
		$data=array('status'=>1,'message'=>'成功','data'=>$message_info);
		return $data;
		
	} 
	/**
	 * 消息列表
	 * @param array $condition
	 * @param number $page_size
	 * @return array
	 */
	public function get_message_list($condition,$page_size=20){
		$condition=array_filter($condition);//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$result=array('status'=>0,'message'=>'错误','data'=>null);
		if(!empty($condition['from_user_id'])&&!is_numeric($condition['from_user_id'])){
			$result=array('status'=>0,'message'=>'user_id 错误','data'=>null);
		}
		import('ORG.Util.Page');// 导入分页类
		$count      = $this->where($condition)->count();// 查询满足要求的总记录数
		$Page       = new Page($count,$page_size);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list_tmp = $this->where($condition)->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
		foreach($list_tmp as $message)
		{
			if(!empty($message['from_user_id']))
			{
				$user_id_arr[]=$message['from_user_id'];//发送者id
			}
			if(!empty($message['to_user_id']))
			{
				$user_id_arr[]=$message['to_user_id'];//被@用户id
			}
			if(!empty($message['to_group_id']))
			{
				$to_group_id_arr[]=$message['to_group_id'];//所属群id
			}
			if(!empty($message['from_site_id']))
			{
				$site_id_arr[]=$message['from_site_id'];//来自站点id
			}
			if(!empty($message['to_site_id']))
			{
				$site_id_arr[]=$message['to_site_id'];//去向站点id
			}
		}
		$user_condition=array();
		$group_condition=array();
		$site_condition=array();
		$user_condition['id']=array('in',$user_id_arr);
		$group_condition['id']=array('in',$to_group_id_arr);
		$site_condition['id']=array('in',$site_id_arr);
		$list_user_result = D('User')->get_user_list($user_condition,$page_size=100,'id,nick_name,sex,avatar,like,level,city_id,geohash');//用户
		$list_site_result = D('Partner_site')->get_site_list($site_condition,$page_size=100,'id,site_name');//站点
		$list_group_result = D('Groups')->get_group_list($group_condition,$page_size=100,'id,name');//群
		
		foreach($list_tmp as $message)
		{
			foreach($list_user_result['data']['list'] as $user)
			{
				if($user['id']==$message['from_user_id'])
				{
					$message['from_user_info']=$user;//谁发的信息
				}
				if($user['id']==$message['to_user_id'])
				{
					$message['to_user_info']=$user;//@谁的信息
				}
			}
			foreach($list_site_result['data']['list'] as $site)
			{
				if($site['id']==$message['from_site_id'])
				{
					$message['from_site_info']=$site;
				}
				if($site['id']==$message['to_site_id'])
				{
					$message['to_site_info']=$site;
				}
			}
			foreach($list_group_result['data']['list'] as $group)
			{
				if($group['id']==$message['to_group_id'])
				{
					$message['to_group_info']=$group;//属于哪个群的信息
				}
			}
			$list[] = $message;
		}
		
		if(!empty($list)){
			$result=array(
					'status'=>1,
					'message'=>'成功',
					'data'=>array(
						'page'=>array(
								'count'=>$count,//好友总数
								'page_size'=>$page_size,
								'page'=>$_REQUEST['p']?$_REQUEST['p']:1,
							),
						'list'=>$list
				),
			);
		}else{
			$result=array(
					'status'=>0,
					'message'=>'数据为空',
					'data'=>array(
							'page'=>array(),
							'list'=>$list
					),
			);
		}
		return $result;
	}
	/**
	 * 修改
	 * @param int $id
	 * @param array $data
	 */
	public function update_messageById($id,$data){
		$data=array_filter($data);//去掉数组空值，不然条件上会加上 xx='' 导致把数据修改为空
		$data['update_time']=time();
		$result=array('status'=>0,'message'=>'修改错误','data'=>null);
		if(empty($id)||empty($data)){
			$result=array('status'=>0,'message'=>'修改失败，id或数据为空','data'=>null);
			return $result;
		}
		if($this->where(array('id'=>$id))->save($data)){ // 根据条件保存修改的数据
			$data['id']=$id;
			$result=array(
					'status'=>1,
					'message'=>'修改成功',
					'data'=>
					$data
			);
		}else{
			$result=array(
					'status'=>0,
					'message'=>'修改失败',
					'data'=>$data);
		}
		
		return $result;
		
	}
	//删除消息
	public function del_groups_message($id)
	{
		$result=array('status'=>0,'message'=>'删除成功','data'=>null);
		if(empty($id)){
			$result=array('status'=>0,'message'=>'删除成功失败，id或数据为空','data'=>null);
			return $result;
		}
		$category_info=$this->get_category_info_by_id($id);
		if(empty($category_info['user_id'])){
			$result=array('status'=>1,'message'=>'消息已经删除','data'=>'');
			return $result;
		}
		if($tmp=$this->where(array('id'=>$id))->delete()){ // 删除所有状态为0的用户数据
			$result=array('status'=>1,'message'=>'删除成功','data'=>$tmp);
		}
		return $result;
	}
	
	
}