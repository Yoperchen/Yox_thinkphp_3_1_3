<?php
/**
 * 拼车
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 */
class CarpoolModel extends Model {
	/**
	 * 添加好友
	 * @param array $data
	 */
	public function add_carpool($data){
		$data=array_filter($data,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$data['add_time']=time();
		$result=array('status'=>0,'message'=>'data不能为空');
		if(!empty($data['user_id'])&&!is_numeric($data['user_id'])){
			$result=array('status'=>0,'message'=>'user_id 错误','data'=>null);
		}
		if(!empty($data)){
			$carpool_id=$this->data($data)->add();
		}
			
		if($carpool_id){
			$data['id']=$carpool_id;
			$result=array(
					'status'=>1,
					'message'=>'成功',
					'data'=>$data
					);
		}else{
			$result=array(
					'status'=>0,
					'message'=>'失败',
					'data'=>$data
			);
		}
		return $result;
	}
	/**
	 * 加入拼车
	 * @param int $carpool
	 * @param int $user_id
	 */
	public function join_carpool(int $carpool_id,int $user_id){
		$result=array(
				'status'=>0,
				'message'=>'失败',
				'data'=>''
		);
		if(empty($carpool_id) or empty($user_id)){
			$result=array(
					'status'=>0,
					'message'=>'拼车id或用户id不能为空',
					'data'=>''
			);
			return $result;
		}
		$data=$this->where(array('id'=>$carpool_id))->find();
		if(empty($result)){
			$result=array(
					'status'=>0,
					'message'=>'该拼车不存在',
					'data'=>$data
			);
			return $result;
		}else{
			$update_data['user_join_ids']=$data['user_join_ids'].','.$user_id;
			if($this->update_carpoolById($carpool_id,$update_data)){
				$result=array(
						'status'=>1,
						'message'=>'加入拼车成功',
						'data'=>$data
				);
				return $result;
			}else{
				$result=array(
						'status'=>0,
						'message'=>'加入拼车失败',
						'data'=>$data
				);
				return $result;
			}
		}
		
	}
	/**
	 * 退出拼车
	 * @param int $carpool_id
	 * @param int $user_id
	 */
	public function quit_carpool(int $carpool_id,int $user_id){
		$result=array(
				'status'=>0,
				'message'=>'失败',
				'data'=>''
		);
		if(empty($carpool_id) or empty($user_id)){
			$result=array(
					'status'=>0,
					'message'=>'拼车id或用户id不能为空',
					'data'=>''
			);
			return $result;
		}
		$data=$this->where(array('id'=>$carpool_id))->find();
		if(empty($result)){
			$result=array(
					'status'=>0,
					'message'=>'该拼车不存在',
					'data'=>$data
			);
			return $result;
		}else{
			$user_join_ids_arr = explode(',',$data['user_join_ids']);
			foreach($user_join_ids_arr as $k => $v){
				$value = trim($v);
				if($value==$user_id){
					unset($array[$k]);
				}
			}
			$user_join_ids_str = implode(',',$user_join_ids_arr);
			$update_data['user_join_ids']=$user_join_ids_str;
			if($this->update_carpoolById($carpool_id,$update_data)){
				$result=array(
						'status'=>1,
						'message'=>'修改拼车成功',
						'data'=>$data
				);
				return $result;
			}else{
				$result=array(
						'status'=>0,
						'message'=>'修改拼车失败',
						'data'=>$data
				);
				return $result;
			}
		}
		
	}
	/**
	 * 获取单个好友信息
	 * @param number $id
	 * @param number $isdetail
	 * @return array
	 */
	public function get_carpool_info_by_id($id=0,$isdetail=0){
		if(empty($id)){ 
			$data=array('status'=>0,'message'=>'id不能为空');
			return $data;
		}
		if($isdetail==0){
			$carpool_info = $this->where(array('id'=>$id))->find();
			$data=array('status'=>1,'message'=>'成功','data'=>$carpool_info);
			return $data;
		}else{//详细
			$carpool_info		 = $this->where(array('id'=>$id))->find();
			$carpool_detail_info = M('User')->where(array('id'=>$carpool_info['add_user_id']))->find();
			$friend_info		 =array_merge_recursive($carpool_info,$carpool_detail_info);
			$data=array('status'=>1,'message'=>'获取详细信息成功','data'=>$friend_info);
			return $data;
		}
		
	} 
	/**
	 * 拼车列表
	 * @param array $condition
	 * @param number $page_size
	 * @return array
	 */
	public function get_carpool_list($condition,$page_size=20){
		$condition=array_filter($condition,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$result=array('status'=>0,'message'=>'错误','data'=>null);
		if(!empty($condition['add_user_id'])&&!is_numeric($condition['add_user_id'])){
			$result=array('status'=>0,'message'=>'user_id 错误','data'=>null);
		}
		import('ORG.Util.Page');// 导入分页类
		$count      = $this->where($condition)->count();// 查询满足要求的总记录数
		$Page       = new Page($count,$page_size);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list_tmp = $this->where($condition)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		foreach($list_tmp as $carpool)
		{
			$user_id_arr=array_merge($user_id_arr,explode(',',$carpool['add_user_id']),explode(',', $carpool['user_join_ids']));
		}
		$user_condition['id']=array('in',$user_id_arr);
		$get_user_list_result = D('User')->get_user_list($user_condition,$page_size=20,$field="id,site_id,nick_name,name,sex,birthday,lng,lat,geohash,avatar,up,down,like,view,level,community_id,city_id,district_id,is_mobile_verify,is_email_verify,status,login_count,reg_time,last_login_time");
		foreach($list_tmp as $carpool)
		{
			foreach($get_user_list_result['data']['list'] as $user)
			{
				if($carpool['add_user_id']==$user['id'])
				{
					$carpool['belong_user_info']=$user;
				}
				if(in_array($user['id'], explode(',', $carpool['user_join_ids'])))
				{
					$carpool['user_join_list'][]=$user;
				}
			}
			$list[]=$carpool;
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
	public function update_carpoolById($id,$data){
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
					'data'=>array());
		}
		
		return $result;
		
	}
	
	public function del_carpool($id){
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