<?php
/**
 * 租车、租房、租衣服、租飞机、租男朋友、租女朋友、租时间
 * @author Yoper 2014.12
 *
 */
class RentalModel extends Model {
	/**
	 * 添加出租
	 * @param array $data
	 */
	public function add_rental(array $data){
		$data=array_filter($data);//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$data['add_time']=time();
		$result=array('status'=>0,'message'=>'data不能为空');
		if(!empty($data['user_id'])&&!is_numeric($data['user_id'])){
			$result=array('status'=>0,'message'=>'user_id 错误','data'=>null);
		}
		if(!empty($data)){
			$car_rental_id=$this->data($data)->add();
		}
			
		if($car_rental_id){
			$data['id']=$car_rental_id;
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
	 * 租车、房、单车、场地
	 * @param int $carpool
	 * @param int $user_id
	 */
	public function rental( $rental_id, $user_id, $rental_begin_time, $rental_end_time){
		$result=array(
				'status'=>0,
				'message'=>'失败',
				'data'=>''
		);
		if(empty($rental_id) or empty($user_id) or empty($rental_begin_time) or empty($rental_end_time)){
			$result=array(
					'status'=>0,
					'message'=>'拼车id或用户id不能为空',
					'data'=>''
			);
			return $result;
		}
		if($rental_begin_time > $rental_end_time){
			$result=array(
					'status'=>0,
					'message'=>'亲，开始时间不能大于结束时间，请重新选择',
					'data'=>''
			);
			return $result;
		}
		$data=$this->where(array('id'=>$rental_id))->find();
		if(empty($result)){
			$result=array(
					'status'=>0,
					'message'=>'该出租不存在',
					'data'=>$data
			);
			return $result;
		}else{
			if($data['rental_end_time']>time()){//租期还没结束
				$result=array(
						'status'=>0,
						'message'=>'对不起，上一段租期还没结束，不能出租',
						'data'=>$data
				);
				return $result;
			}
			
			if($data['rental_begin_time']!=time()){//租用开始时间不对
				$result=array(
						'status'=>0,
						'message'=>'对不起，租用开始时间不对，请重新选择',
						'data'=>$data
				);
				return $result;
			}
			if((!empty($data['next_rental_start_time']) && $data['next_rental_start_time']<$data['rental_end_time'])
					||(!empty($data['third_rental_begin_time']) && $data['third_rental_begin_time']<$data['rental_end_time'])){//下段时间和第三段时间已经被租了
				$result=array(
						'status'=>0,
						'message'=>'对不起，您租用的时间段已经被其他用户租用了，请选择其他时间段',
						'data'=>$data
				);
				return $result;
			}
			if((!empty($data['disable_start_time']) || !empty($data['disable_end_time']))
					&& (($rental_begin_time>$data['disable_start_time'] && $rental_begin_time<$data['disable_end_time']) 
					     ||($rental_end_time>$data['disable_start_time'] && $rental_begin_time<$data['disable_end_time']))){
				$result=array(
						'status'=>0,
						'message'=>'对不起，您租用的时间段已经被禁用，不能租用，请选择其他时间段',
						'data'=>$data
				);
				return $result;
			}
			
			$update_data['rental_begin_time']=$rental_begin_time;//开始时间
			$update_data['rental_end_time']=$rental_end_time;//结束时间
			$update_data['user_id']=$user_id;//租用者
			if($this->update_rentalById($rental_id,$update_data)){
				$result=array(
						'status'=>1,
						'message'=>'租用成功',
						'data'=>$data
				);
				return $result;
			}else{
				$result=array(
						'status'=>0,
						'message'=>'租用失败',
						'data'=>$data
				);
				return $result;
			}
		}
		
	}
	/**
	 * 提前租用下一段时间 或 第三端时间
	 * @param int $rental_id
	 * @param int $next_user_id
	 */
	public function rental_next(int $rental_id,int $next_user_id,int $next_rental_start_time,int $next_rental_end_time){
		$result=array(
				'status'=>0,
				'message'=>'失败',
				'data'=>''
		);
		if(empty($rental_id) or empty($next_user_id) or empty($next_rental_start_time) or empty($next_rental_end_time) ){
			$result=array(
					'status'=>0,
					'message'=>'租赁id或用户id或时间不能为空',
					'data'=>''
			);
			return $result;
		}
		$data=$this->where(array('id'=>$rental_id))->find();
		if(empty($data)){
			$result=array(
					'status'=>0,
					'message'=>'该出租不存在',
					'data'=>$data
			);
			return $result;
		}else{
			if(empty($data['next_user_id']) && empty($data['next_rental_begin_time']) && empty($data['next_rental_end_time'])){//第二端时间没人租
				$update_data['next_rental_start_time']=$next_rental_start_time;//开始时间
				$update_data['next_rental_end_time']=$next_rental_end_time;//结束时间
				$update_data['next_user_id']=$next_user_id;//租用者
			}elseif(empty($data['third_user_id']) && empty($data['third_rental_begin_time']) && empty($data['third_rental_end_time'])){//第三端时间没人租
				$update_data['third_rental_begin_time']=$next_rental_start_time;//开始时间
				$update_data['third_rental_end_time']=$next_rental_end_time;//结束时间
				$update_data['third_user_id']=$next_user_id;//租用者
			}elseif(!empty($data['third_rental_end_time'])){
				$result=array(
						'status'=>0,
						'message'=>'本租赁已经租到了'.date('Y-m-d'.$data['third_rental_end_time']).'请下次再来',
						'data'=>$data
				);
				return $result;
			}else{
				$result=array(
						'status'=>0,
						'message'=>'租赁信息出错，请联系客服',
						'data'=>$data
				);
				return $result;
			}
			
			if($this->update_rentalById($rental_id,$update_data)){
				$result=array(
						'status'=>1,
						'message'=>'租用成功',
						'data'=>$data
				);
				return $result;
			}else{
				$result=array(
						'status'=>0,
						'message'=>'租用失败',
						'data'=>$data
				);
				return $result;
			}
		}
	
	}
	/**
	 * 获取租用信息
	 * @param number $id
	 * @param number $isdetail
	 * @return array
	 */
	public function get_rental_info_by_id($id=0,$isdetail=0){
		if(empty($id)){ 
			$data=array('status'=>0,'message'=>'id不能为空');
			return $data;
		}
		if($isdetail==0){
			$rental_info = $this->where(array('id'=>$id))->find();
			$data=array('status'=>1,'message'=>'成功','data'=>$rental_info);
			return $data;
		}
		
	} 
	/**
	 * 出租列表
	 * @param array $condition
	 * @param number $page_size
	 * @return array
	 */
	public function get_rental_list($condition,$page_size=20){
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
	public function update_rentalById($id,array $data){
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
	
	public function del_rental($id){
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