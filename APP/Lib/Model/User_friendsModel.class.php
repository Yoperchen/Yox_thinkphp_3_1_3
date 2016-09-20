<?php
/**
 * 好友
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class User_friendsModel extends Model {
	/**
	 * 添加好友
	 * @param array $data
	 */
	public function add_user_friend($data){
		$data=array_filter($data);//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$data['add_time']=time();
		$result=array('status'=>0,'message'=>'data不能为空');
		if(!empty($data['user_id'])&&!is_numeric($data['user_id'])){
			$result=array('status'=>0,'message'=>'user_id 错误','data'=>null);
		}
		if(!empty($data)){
			$friend_id=$this->data($data)->add();
		}
			
		if($friend_id){
			$data['id']=$friend_id;
			$result=array(
					'status'=>1,
					'message'=>'成功',
					'data'=>$data
					);
			return $result;
		}
	}
	/**
	 * 获取单个好友信息
	 * @param number $id
	 * @param number $isdetail
	 * @return array
	 */
	public function get_friend_info_by_id($id=0,$isdetail=0){
		if(empty($id)){ 
			$data=array('status'=>0,'message'=>'id不能为空');
			return $data;
		}
		if($isdetail==0){
			$friend_info = $this->where(array('id'=>$id))->find();
			$data=array('status'=>1,'message'=>'成功','data'=>$friend_info);
			return $data;
		}else{//详细
			$friend_info		 = $this->where(array('id'=>$id))->find();
			$friend_detail_info = M('User')->where(array('id'=>$friend_info['friend_user_id']))->find();
			$friend_info		 =array_merge_recursive($friend_info,$friend_detail_info);
			$data=array('status'=>1,'message'=>'获取详细信息成功','data'=>$friend_info);
			return $data;
		}
		
	} 
	/**
	 * 好友列表
	 * @param array $condition
	 * @param number $page_size
	 * @return array
	 */
	public function get_friend_list($condition,$page_size=20){
		$condition=array_filter($condition,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$result=array('status'=>0,'message'=>'错误','data'=>null);
		if(!empty($condition['user_id'])&&!is_numeric($condition['user_id'])){
			$result=array('status'=>0,'message'=>'user_id 错误','data'=>null);
		}
		import('ORG.Util.Page');// 导入分页类
		$count      = $this->where($condition)->count();// 查询满足要求的总记录数
		$Page       = new Page($count,$page_size);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $this->where($condition)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
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
// 		$this->assign('list',$list);// 赋值数据集
// 		$this->assign('page',$show);// 赋值分页输出
	}
	/**
	 * 修改
	 * @param int $id
	 * @param array $data
	 */
	public function update_friendById($id,$data){
		if(isset($data['friend_user_status']))$friend_user_status_tmp=$data['friend_user_status'];
		$data=array_filter($data);//去掉数组空值，不然条件上会加上 xx='' 导致把数据修改为空
		if(isset($friend_user_status_tmp))$data['friend_user_status']=$friend_user_status_tmp?$friend_user_status_tmp:0;
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
					'data'=>array());
		}
		
		return $result;
		
	}
	
	/**
	 * 删除好友、假删除、可用于找回好友，将friend_user_status字段设置为0
	 */
	public function set_friend_user_status_delete($id){
		$result=array('status'=>0,'message'=>'删除成功','data'=>null);
		$data['friend_user_status']=0;
		if($this->update_friendById($id, $data)){
			$result=array(
					'status'=>1,
					'message'=>'删除成功',
					'data'=>array());
		}else{
			$result=array(
					'status'=>1,
					'message'=>'删除失败',
					'data'=>array());
		}
		
		return $result;
	}
	/**
	 * 删除
	 * @param unknown_type $id
	 */
	public function del_friend($id){
		$result=array('status'=>0,'message'=>'删除成功','data'=>null);
		if(empty($id)){
			$result=array('status'=>0,'message'=>'删除成功失败，id或数据为空','data'=>null);
			return $result;
		}
		if($tmp=$this->where(array('id'=>$id))->delete()){ // 删除所有状态为0的用户数据
			$result=array('status'=>1,'message'=>'删除成功','data'=>$tmp);
		}
		return $result;
		
	}
	
	
}