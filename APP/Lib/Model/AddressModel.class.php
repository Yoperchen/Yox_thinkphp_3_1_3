<?php
/**
 * 收藏
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 */
class AddressModel extends Model {
	/**
	 * 添加收藏
	 * @param array $data
	 */
	public function add_address( $data){
		$data=array_filter($data,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$result=array('status'=>0,'message'=>'data不能为空');
		if(!empty($data)){
			$data['add_time']=time();
			 if($address_id=$this->data($data)->add()){
			 	$data['id']=$address_id;
				$result=array('status'=>1,'message'=>'成功','data'=>$data);
			 }
			return $result;
		}
	}
	/**
	 * 
	 * @param number $id
	 * @param number $isdetail 是否详细，详细就获取用户信息
	 * @return array
	 */
	public function get_address_by_id( $id=0,$isdetail=0){
		if(empty($id)){ 
			$data=array('status'=>0,'message'=>'id不能为空');
			return $data;
		}
		if($isdetail==0){
			$address_info = $this->where(array('id'=>$id))->find();
			$data=array('status'=>1,'message'=>'成功','data'=>$address_info);
			return $data;
		}else{//详细
			$address_info		 = $this->where(array('id'=>$id))->find();
			$address_detail_info = M('User')->where(array('id'=>$address_info['belong_user_id']))->find();
			$address_info		 =array_merge_recursive($address_info,$address_detail_info);
			$data=array('status'=>1,'message'=>'成功','data'=>$address_info);
			return $data;
		}
		
	} 
	/**
	 * 获取收藏列表
	 * @param array $condition
	 * @param int $page_size
	 */
	public function get_address_list( $condition, $page_size=15){
		$condition=array_filter($condition,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$result=array('status'=>0,'message'=>'错误','data'=>null);
		import('ORG.Util.Page');// 导入分页类
		$count      = $this->where($condition)->count();// 查询满足要求的总记录数
		$Page       = new Page($count,$page_size);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list_tmp = $this->where($condition)->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
		
		$country_id_arr=array();//国家
		$province_id_arr=array();//省份
		$city_id_arr=array();//城市
		$district_id_arr=array();//区|天河区
		foreach($list_tmp as $address)
		{
// 			$country_id_arr[]  = $address['country_id'];
// 			$province_id_arr[] = $address['province_id'];
// 			$city_id_arr[]     = $address['city_id'];
// 			$district_id_arr[] = $address['district_id'];
			$district_id_arr[]=$address['province_id']?$address['province_id']:'';
			$district_id_arr[]=$address['city_id']?$address['city_id']:'';
			$district_id_arr[]=$address['district_id']?$address['district_id']:'';//区|天河区
		}
		$district_id_arr=array_filter($district_id_arr,"Yocms_del_empty");
// 		$country_id_str  = implode(',', $country_id_arr);
// 		$province_id_str = implode(',', $province_id_arr);
// 		$city_id_str     = implode(',', $city_id_arr);
// 		$district_id_str = implode(',', $district_id_arr);
		$district_condition['id']=array('in',$district_id_arr);
		$district_list_result = D('District')->get_district_list($district_condition,'*',100);
		foreach($list_tmp as $address)
		{
			foreach($district_list_result['data']['list'] as $district)
			{
				if($address['province_id']==$district['id'])
				{
					$address['province_name']=$district['name'];
				}
				if($address['city_id']==$district['id'])
				{
					$address['city_name']=$district['name'];
				}
				if($address['district_id']==$district['id'])
				{
					$address['district_name']=$district['name'];
				}
			}
			$list[]=$address;
		}
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
	 * 修改
	 * @param int $id
	 * @param array $data
	 */
	public function update_addressById($id, $data){
		$data=array_filter($data,"Yocms_del_empty");
		$result=array('status'=>0,'message'=>'修改错误','data'=>null);
		if(empty($id)||empty($data)){
			$result=array('status'=>0,'message'=>'修改失败，id或数据为空','data'=>null);
			return $result;
		}
		
		$data['update_time']=time();
		if($result['data']=$this->where(array('id'=>$id))->save($data))
		{ 
			// 根据条件保存修改的数据
			$result['status']=1;
			$result['message']='修改成功';
		}
		
		return $result;
		
	}
	/**
	 * 删除收藏
	 * @param array $condition
	 */
	public function del_address(array $condition){
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
	
	
	
	
}