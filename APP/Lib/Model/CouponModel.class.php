<?php
/**
 * 优惠券
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 */
class CouponModel extends Model 
{
    const IS_LOG=1;
	/**
	 * 添加优惠券(一条记录)
	 * @param array $data
	 */
	public function add_coupon( $data){
		$data=array_filter($data,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$result=array('status'=>0,'message'=>'data不能为空');
		if(!empty($data))
		{
			$random_serial_number_result = $this->random_serial_number(11);//随机生成优惠券字符串
			$data['serial_number']=$random_serial_number_result['data']['serial_number'];
			$data['add_time']=time();
			 if($coupon_id=$this->data($data)->add()){
			 	$data['id']=$coupon_id;
				$result=array('status'=>1,'message'=>'成功','data'=>$data);
			 }
			return $result;
		}
	}
	/**
	 * 添加优惠券(多条记录)
	 * @param array $data_tmp 优惠券信息
	 * @param int $num 生成数量
	 */
	public function add_multi_coupon($data_tmp,$num){
		$data_tmp=array_filter($data_tmp,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$result=array('status'=>0,'message'=>'data不能为空');
		//print_r($data_tmp);
		//echo $num.'  ';die();
		if(!empty($data_tmp))
		{
			for($i=0;$i<$num;$i++)
			{
				$data[$i]['add_time']=NOW_TIME;
				$random_serial_number_result = $this->random_serial_number(11);//随机生成优惠券字符串
				$data[$i]['serial_number']=$random_serial_number_result['data']['serial_number'];//券码
				$data[$i]['password']=$data_tmp['password'];//使用券的密码
				$data[$i]['type_id']=$data_tmp['type_id'];//类型|1:现金券，2兑换券，3折扣券
				$data[$i]['batch_id']=$data_tmp['batch_id'];//批次id
				$data[$i]['total_value']=$data_tmp['total_value'];//总价值
				$data[$i]['remain_value']=$data_tmp['remain_value'];//剩余价值
				$data[$i]['sale_price']=$data_tmp['sale_price'];//销售价
				$data[$i]['unit']=$data_tmp['unit'];//价值单位|元、张
				$data[$i]['start_time']=$data_tmp['start_time'];//券的有效期
				$data[$i]['end_time']=$data_tmp['end_time'];//券的有效期
				$data[$i]['belong_user_id']=$data_tmp['belong_user_id'];//所属用户
				$data[$i]['mobile']=$data_tmp['mobile'];//所属手机号
				$data[$i]['order_id']=$data_tmp['order_id'];//订单号
				$data[$i]['validation_count']=$data_tmp['validation_count'];//验证过几次
				$data[$i]['validation_time']=$data_tmp['validation_time'];//验证时间
				$data[$i]['status']=$data_tmp['status'];//状态|1正常,2禁止,3黑名单,4删除
				$data[$i]['is_sendmsg']=$data_tmp['is_sendmsg'];
			}
			$tmp=$this->addAll($data);
			if($tmp){
				$result=array('status'=>1,'message'=>'成功','data'=>$tmp);
			}
			return $result;
		}
	}
	/**
	 * 获取优惠券信息
	 * @param number $id
	 * @param number $isdetail 是否详细，详细就获取用户信息
	 * @return array
	 */
	public function get_coupon_by_id( $coupon_id=0,$isdetail=0){
		if(empty($coupon_id)){ 
			$data=array('status'=>0,'message'=>'id不能为空');
			return $data;
		}
		if($isdetail==0){
			$coupon_info = $this->where(array('coupon_id'=>$coupon_id))->find();
			$data=array('status'=>1,'message'=>'成功','data'=>$coupon_info);
			return $data;
		}else{//详细
			$coupon_info		 = $this->where(array('coupon_id'=>$coupon_id))->find();
			$coupon_detail_info = M('User')->where(array('id'=>$coupon_info['belong_user_id']))->find();
			$coupon_info		 =array_merge_recursive($coupon_info,$coupon_detail_info);
			$data=array('status'=>1,'message'=>'成功','data'=>$coupon_info);
			return $data;
		}
	} 
	/**
	 * 获取优惠券信息
	 * @param string $serial_number
	 * @return array
	 */
	public function get_coupun_by_serial_number($serial_number){
		$result = array('status'=>0,'message'=>'id不能为空');
		$data = $this->where(array('serial_number'=>$serial_number))->find();
		if($data)
		{
			$result = array('status'=>1,'message'=>'成功','data'=>$data);
		}else{
			$result = array('status'=>0,'message'=>'查询失败','data'=>$data);
		}
		return $result;
	}
	/**
	 * 获取优惠券列表
	 * @param array $condition
	 * @param int $page_size
	 */
	public function get_coupon_list( $condition, $page_size=15){
		$condition=array_filter($condition,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$result=array('status'=>0,'message'=>'错误','data'=>null);
		import('ORG.Util.Page');// 导入分页类
		$count      = $this->where($condition)->count();// 查询满足要求的总记录数
		$Page       = new Page($count,$page_size);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $this->where($condition)->order('coupon_id')->limit($Page->firstRow.','.$Page->listRows)->select();
		$result=array(
				'status'=>1,
				'message'=>'成功',
				'condition'=>$condition,
				'data'=>array(
					'page'=>array(
								'count'=>$count,//文章总数
								'page_size'=>$page_size,
								'page'=>$Page->firstRow+1,
							),
					'list'=>$list
			),
		);
		return $result;
// 		$this->assign('list',$list);// 赋值数据集
// 		$this->assign('page',$show);// 赋值分页输出
	}
	/**
	 * 修改优惠券
	 * @param int $id
	 * @param array $data
	 */
	public function update_couponById($coupon_id, $data){
		$data=array_filter($data,"Yocms_del_empty");
		$result=array('status'=>0,'message'=>'修改错误','data'=>null);
		if(empty($coupon_id)||empty($data)){
			$result=array('status'=>0,'message'=>'修改失败，id或数据为空','data'=>null);
			return $result;
		}
		
		$data['update_time']=time();
		$is_save = $this->where(array('coupon_id'=>$coupon_id))->save($data);
		if(!$is_save)
		{
		    // 根据条件保存修改的数
		    $result['message']='修改失败';
		    return $result;
		}
		// 根据条件保存修改的数
		$result['status']=1;
		$result['message']='修改成功';
		return $result;
		
	}
	/**
	 * 删除优惠券
	 * @param array $condition
	 */
	public function del_coupon(array $condition){
		$condition=array_filter($condition,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$result=array('status'=>0,'message'=>'删除成功','data'=>null);
		if(empty($condition)){
			$result=array('status'=>0,'message'=>'删除成功失败，id或数据为空','data'=>null);
			return $result;
		}
		
		if($result['data']=$this->where($condition)->delete()){ // 删除所有状态为0的用户数据
			$result=array('status'=>1,'message'=>'删除成功','data'=>$result['data']);
		}
		return $result;
		
	}
	/**
	 * 生成字符串
	 * @param int $len 位数
	 */
	private function random_serial_number($len=11)
	{
		$random_string_result = random_string($len);
		$coupon_list_result = $this->get_coupon_list(array('serial_number'=>$random_string_result['data']['random_string']));
		if(!empty($coupon_list_result['data']['list']))
		{//如果存在，重新生成
			$random_string_result = random_string($len);
			$coupon_list_result = $this->get_coupon_list(array('serial_number'=>$random_string_result['data']['random_string']));
			if(!empty($coupon_list_result['data']['list']))
			{//如果再存在，再重新生成
				$random_string_result = random_string($len);
			}
		}
		$result=array('status'=>1,'message'=>'成功','data'=>
				array('serial_number'=>$random_string_result['data']['random_string'])
		);
		return $result;
	}
	/**
	 * 添加批次
	 * @param array $data
	 */
	public function add_batch($data)
	{
		$data=array_filter($data,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$result=array('status'=>0,'message'=>'data不能为空');
		if(!empty($data))
		{
			$Coupon_batch=M('Coupon_batch');
			$data['add_time']=time();
			$batch_id=$Coupon_batch->data($data)->add();
			if($batch_id)
			{
				$data['id']=$batch_id;
				$result=array('status'=>1,'message'=>'成功','data'=>$data);
			}
			return $result;
		}
	}
	/**
	 * 批次信息
	 * @param int $id
	 */
	public function get_batch_by_id($id)
	{
		$result=array('status'=>0,'message'=>'data不能为空');
		if(!empty($id))
		{
			$Coupon_batch=M('Coupon_batch');
			$data=$Coupon_batch->where(array('id'=>$id))->find();;
			if(!empty($data))
			{
				$result=array('status'=>1,'message'=>'成功','data'=>$data);
			}
			return $result;
		}
	}
/**
	 * 获取批次列表
	 * @param array $condition
	 * @param int $page_size
	 */
	public function get_batch_list( $condition, $page_size=15){
		$condition=array_filter($condition,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$result=array('status'=>0,'message'=>'错误','data'=>null);
		import('ORG.Util.Page');// 导入分页类
		$Coupon_batch=M('Coupon_batch');
		$count      = $Coupon_batch->where($condition)->count();// 查询满足要求的总记录数
		$Page       = new Page($count,$page_size);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $Coupon_batch->where($condition)->order('batch_id')->limit($Page->firstRow.','.$Page->listRows)->select();
		$result=array(
				'status'=>1,
				'message'=>'成功',
				'data'=>array(
					'page'=>array(
								'count'=>$count,//文章总数
								'page_size'=>$page_size,
								'page'=>$Page->firstRow+1,
							),
					'list'=>$list
			),
		);
		return $result;
// 		$this->assign('list',$list);// 赋值数据集
// 		$this->assign('page',$show);// 赋值分页输出
	}
	/**
	 * 修改批次
	 * @param int $id
	 * @param array $data
	 */
	public function update_batchById($id,array $data){
		$data=array_filter($data,"Yocms_del_empty");
		$result=array('status'=>0,'message'=>'修改错误','data'=>null);
		if(empty($id)||empty($data)){
			$result=array('status'=>0,'message'=>'修改失败，id或数据为空','data'=>null);
			return $result;
		}
		$Coupon_batch=M('Coupon_batch'); 
		$data['update_time']=time();
		if($Coupon_batch->where(array('id'=>$id))->save($data))
		{ // 根据条件保存修改的数据
			$data['id']=$id;
			$result['status']=1;
			$result['message']='修改成功';
			$result['data']=$data;
		}
	
		return $result;
	}
	/**
	 * 删除批次
	 * @param array $condition
	 */
	public function del_batch( $condition)
	{
		$condition=array_filter($condition,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$result=array('status'=>0);
		if(empty($condition))
		{
			$result['message']='删除失败，id或数据为空';
			return $result;
		}
		$Coupon_batch=M('Coupon_batch');
		$is_delete = $Coupon_batch->where($condition)->delete();
		if(!$is_delete)
		{ // 删除所有状态为0的用户数据
		    $result['message']='删除失败';
		    return $result;
		}
		$result['status']=1;
		$result['message']='删除成功';
		return $result;
	}
	/**
	 * 写日志
	 * @param unknown $log_data
	 * @param string $level
	 */
	private function write_log($method,$log_data,$level=Log::INFO)
	{
	    self::IS_LOG ? write_log($method,$log_data,$level=Log::INFO):'';
	}
}