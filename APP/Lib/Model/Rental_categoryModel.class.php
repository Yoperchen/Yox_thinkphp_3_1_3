<?php
/**
 * 出租分类
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 */
class Rental_categoryModel extends Model {
	/**
	 * 添加租用分类
	 * @param array $data
	 */
	public function add_rental_category($data){
		$data=array_filter($data);//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$data['add_time']=time();
		$result=array('status'=>0,'message'=>'data不能为空');
		if(!empty($data['user_id'])&&!is_numeric($data['user_id'])){
			$result=array('status'=>0,'message'=>'user_id 错误','data'=>null);
		}
		if(!empty($data)){
			$detail_data=array();
			$rental_category_id=$this->data($data)->add();
		}
			
		if($rental_category_id){
			$data['id']=$rental_category_id;
			$result=array('status'=>1,'message'=>'成功',
					'data'=>$data);
		}else{
			$result=array('status'=>0,'message'=>'添加失败',
					'data'=>$data);
			}
			return $result;
	}
	/**
	 * 获取详细信息
	 * @param number $id
	 * @param number $isdetail
	 * @return array
	 */
	public function get_rental_categoryById($id=0,$isdetail=0){
		if(empty($id)){ 
			$data=array('status'=>0,'message'=>'id不能为空');
			return $data;
		}
		if($isdetail==0){
			$rental_category_info = $this->where(array('id'=>$id))->find();
			if(!empty($rental_category_info)){
				$data=array('status'=>1,'message'=>'成功','data'=>$rental_category_info);
			}else{
				$data=array('status'=>0,'message'=>'查无此记录','data'=>$rental_category_info);
			}
			return $data;
		}else{//详细
			$rental_category_info		 = $this->where(array('id'=>$id))->find();
			if(!empty($rental_category_info['user_id'])){//用户
				$rental_category_detail_info = M('User')->where(array('user_id'=>$rental_category_info['user_id']))->find();
			}elseif(!empty($rental_category_info['store_id'])){//商家
				$rental_category_detail_info = M('User')->where(array('store_id'=>$rental_category_info['store_id']))->find();
			}
			
			$rental_category_info		 =array_merge_recursive($rental_category_info,$rental_category_detail_info);
			$data=array('status'=>1,'message'=>'获取详细信息成功','data'=>$rental_category_info);
			return $data;
		}
		
	} 
	/**
	 * 分类列表
	 * @param array $condition
	 * @param number $page_size
	 * @return array
	 */
	public function get_rental_category_list($condition,$page_size=20){
		$condition=array_filter($condition);//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
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
								'count'=>$count,//总数
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
	 * 修改分类
	 * @param int $id
	 * @param array $data
	 */
	public function update_rental_categoryById($id,$data){
		$data=array_filter($data);//去掉数组空值，不然条件上会加上 xx='' 导致把数据修改为空
		$data['update_time']=time();
		$result=array('status'=>0,'message'=>'修改错误','data'=>null);
		if(empty($id)||empty($data)){
			$result=array('status'=>0,'message'=>'修改失败，id或数据为空','data'=>null);
			return $result;
		}
		if($this->where(array('id'=>$id))->save($data)){ // 根据条件保存修改的数据
			$result=array(
					'status'=>1,
					'message'=>'修改成功',
					'data'=>$data);
		}else{
			$result=array(
					'status'=>0,
					'message'=>'修改失败',
					'data'=>array());
		}
		return $result;
	}
	/**
	 * 删除分类
	 * @param int $id
	 */
	public function del_rental_category($id){
		$result=array('status'=>0,'message'=>'删除成功','data'=>null);
		if(empty($id)){
			$result=array('status'=>0,'message'=>'删除成功失败，id为空','data'=>null);
			return $result;
		}
		if($tmp=$this->where(array('id'=>$id))->delete()){ // 删除所有状态为0的用户数据
			$result=array('status'=>1,'message'=>'删除成功','data'=>$tmp);
		}else{
			$result=array('status'=>0,'message'=>'删除失败','data'=>$tmp);
		}
		return $result;
	}
	
}