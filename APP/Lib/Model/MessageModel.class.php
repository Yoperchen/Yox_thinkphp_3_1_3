<?php
/**
 * 个人消息、聊天记录
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 */
class MessageModel extends Model {
	/**
	 * 添加消息
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
		if(!empty($data['to_user_id'])&&!is_numeric($data['to_user_id'])){
			$result=array('status'=>0,'message'=>'发送者id必须事数字','data'=>$data);
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
		$list = $this->where($condition)->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
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
	public function del_message($id)
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