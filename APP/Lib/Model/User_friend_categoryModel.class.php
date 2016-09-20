<?php
/**
 * 好友分组
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class User_friend_categoryModel extends Model {
	/**
	 * 添加分组
	 * @param array $data
	 */
	public function add_category($data){
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
	 * 获取单个分组信息
	 * @param number $id
	 * @param number $isdetail
	 * @return array
	 */
	public function get_category_info_by_id($id=0){
		if(empty($id)){ 
			$data=array('status'=>0,'message'=>'id不能为空');
			return $data;
		}
		$category_info = $this->where(array('id'=>$id))->find();
		$data=array('status'=>1,'message'=>'成功','data'=>$category_info);
		return $data;
		
	} 
	/**
	 * 分组列表
	 * @param array $condition
	 * @param number $page_size
	 * @return array
	 */
	public function get_category_list($condition,$page_size=20){
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
	public function update_categoryById($id,$data){
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
	//删除分组
	public function del_category($id){
		$result=array('status'=>0,'message'=>'删除成功','data'=>null);
		if(empty($id)){
			$result=array('status'=>0,'message'=>'删除成功失败，id或数据为空','data'=>null);
			return $result;
		}
		$category_info=$this->get_category_info_by_id($id);
		if(empty($category_info['user_id'])){
			$result=array('status'=>0,'message'=>'系统分组，不能删除！','data'=>'');
			return $result;
		}
		if($tmp=$this->where(array('id'=>$id))->delete()){ // 删除所有状态为0的用户数据
			$result=array('status'=>1,'message'=>'删除成功','data'=>$tmp);
		}
		return $result;
		
	}
	
	
}