<?php
/**
 * 群组
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 */
class GroupsModel extends Model {
	/**
	 * 创建群、添加分组
	 * @param array $data
	 */
	public function add_group($data){
		$data=array_filter($data);//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$data['add_time']=time();
		$result=array('status'=>0,'message'=>'data不能为空');
		if(!empty($data['belong_user_id'])&&!is_numeric($data['belong_user_id'])){
			$result=array('status'=>0,'message'=>'belong_user_id 错误','data'=>$data);
			return $result;
		}
		if(empty($data['name'])){
			$result=array('status'=>0,'message'=>'群名称不能为空','data'=>$data);
			return $result;
		}
		if(!empty($data['city_id'])&&!is_numeric($data['city_id'])){
			$result=array('status'=>0,'message'=>'城市id错误','data'=>$data);
			return $result;
		}
		if(!empty($data)){
			$message_id=$this->data($data)->add();
		}
			
		if($message_id){
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
	 * 入群、加入班级、加入系
	 * @param int $group_id
	 * @param int $apply_user_id
	 * @return array
	 */
	public function join_group($group_id,$apply_user_id){
		if(!empty($apply_user_id)&&!is_numeric($apply_user_id)){//user_id格式
			$result=array('status'=>0,'message'=>'user_id 错误','data'=>$apply_user_id);
			return $result;
		}
		if(!empty($group_id)&&!is_numeric($group_id)){//约会id格式
			$result=array('status'=>0,'message'=>'群id 错误','data'=>$group_id);
			return $result;
		}
		$group_info = $this->where(array('id'=>$group_id))->find();//约会、预约信息
		if(empty($group_info)){//约会不存在
			$result=array('status'=>0,'message'=>'出错了，该群不存在，请重新挑选','data'=>$group_id);
			return $result;
		}
		$user_ids_str  = $group_info['user_ids'];//报名者字符串user_id|154,565,455
		if(!empty($user_ids_str)){//加一个判断，不然空的会出现','号
			$user_ids_arr  = explode(",",$user_ids_str);//字符串转数组|array(154,565,455)
		}else{
			$user_ids_arr=array();
		}
		if(in_array($apply_user_id,$user_ids_arr)){
			$result=array('status'=>0,'message'=>'您已经报过名了，请勿重复入群','data'=>$apply_user_id);
			return $result;
		}
		
		$user_ids_arr[]=$apply_user_id;//增加一个报名的
		$user_ids_str  = implode(',',$user_ids_arr);//数组转字符串
		$data['user_ids']=$user_ids_str;
		if($this->update_groupById($group_id,$data)){//更新报名者
			$result=array(
					'status'=>1,
					'message'=>'报名成功',
					'data'=>$data);
		}else{
			$result=array(
					'status'=>0,
					'message'=>'更新失败',
					'data'=>$data);
		}
		return $result;
	}
	/**
	 * 退群
	 * @param int $group_id
	 * @param int $apply_user_id
	 * @return array
	 */
	public function exit_group($group_id,$apply_user_id){
		if(!empty($apply_user_id)&&!is_numeric($apply_user_id)){//user_id格式
			$result=array('status'=>0,'message'=>'user_id 错误','data'=>$apply_user_id);
			return $result;
		}
		if(!empty($group_id)&&!is_numeric($group_id)){//约会id格式
			$result=array('status'=>0,'message'=>'群id 错误','data'=>$group_id);
			return $result;
		}
		$group_info = $this->where(array('id'=>$group_id))->find();//约会、预约信息
		if(empty($group_info)){//约会不存在
			$result=array('status'=>0,'message'=>'出错了，该群不存在，请重新挑选','data'=>$group_id);
			return $result;
		}
		$user_ids_str  = $group_info['user_ids'];//报名者字符串user_id|154,565,455
		if(!empty($user_ids_str)){//加一个判断，不然空的会出现','号
			$user_ids_arr  = explode(",",$user_ids_str);//字符串转数组|array(154,565,455)
			$data=array();
			foreach($user_ids_arr as $key=>$user_id){
					if($user_id==$apply_user_id){
						unset($user_ids_arr[$key]);
						$user_ids_str  = implode(',',$user_ids_arr);//数组转字符串
						$data['user_ids']=$user_ids_str;
						break;//退出foreach循环
					}
			}
			if(!empty($data) && $this->update_groupById($group_id,$data)){//更新报名者
				$result=array(
						'status'=>1,
						'message'=>'退出成功',
						'data'=>$data);
			}else{
				$result=array(
						'status'=>0,
						'message'=>'没有加入该群，退出失败',
						'data'=>$data);
			}
		}else{
			$result=array(
						'status'=>0,
						'message'=>'该群没有人加入，退群失败',
						'data'=>$data);
		}
		return $result;
	}
	/**
	 * 获取单个消息
	 * @param number $id
	 * @return array
	 */
	public function get_group($id=0){
		if(empty($id)){ 
			$data=array('status'=>0,'message'=>'id不能为空');
			return $data;
		}
		$group_info = $this->where(array('id'=>$id))->find();
		$data=array('status'=>1,'message'=>'成功','data'=>$group_info);
		return $data;
		
	} 
	/**
	 * 群成员
	 */
	public function get_group_user($group_id){
		$group_info = $this->where(array('id'=>$group_id))->find();
		if(!empty($group_info['user_ids'])){
			$user_ids_str  = $group_info['user_ids'];
			$condition['user_ids']= array('in',$user_ids_str);
			$list = M('User')->where()->select();
			$list['group_id']=$group_id;
			$result = array('status'=>1,'message'=>'成功','data'=>$list);
		}else{
			$list['group_id']=$group_id;
			$result = array('status'=>0,'message'=>'群成员为空','data'=>$list);
		}
		return $result;
	}
	/**
	 * 群、组、班级、系、部门列表
	 * @param array $condition
	 * @param number $page_size
	 * @return array
	 */
	public function get_group_list($condition,$page_size=20,$field='*'){
		$condition=array_filter($condition);//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$result=array('status'=>0,'message'=>'错误','data'=>null);
		if(!empty($condition['belong_user_id'])&&!is_numeric($condition['belong_user_id'])){
			$result=array('status'=>0,'message'=>'user_id 错误','data'=>null);
		}
		import('ORG.Util.Page');// 导入分页类
		$count      = $this->where($condition)->count();// 查询满足要求的总记录数
		$Page       = new Page($count,$page_size);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $this->field($field)->where($condition)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
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
					'condition'=>$condition
			);
		}
		return $result;
	}
	/**
	 * 修改
	 * @param int $id
	 * @param array $data
	 */
	public function update_groupById($id,$data){
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
	//删除群
	public function del_group($id){
		$result=array('status'=>0,'message'=>'删除成功','data'=>null);
		if(empty($id)){
			$result=array('status'=>0,'message'=>'删除成功失败，id或数据为空','data'=>null);
			return $result;
		}
		$group_info=$this->get_group($id);
		if(empty($group_info)){
			$result=array('status'=>1,'message'=>'群、或班级已经删除','data'=>'');
			return $result;
		}
		if($tmp=$this->where(array('id'=>$id))->delete()){ // 删除所有状态为0的用户数据
			$result=array('status'=>1,'message'=>'删除成功','data'=>$tmp);
		}
		return $result;
	}
	
	
}