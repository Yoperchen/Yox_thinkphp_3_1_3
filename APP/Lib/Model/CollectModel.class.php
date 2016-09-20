<?php
/**
 * 收藏
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 */
class CollectModel extends Model {
	/**
	 * 添加收藏
	 * @param array $data
	 */
	public function add_collect( $data){
		$data=array_filter($data);//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$result=array('status'=>0,'message'=>'data不能为空');
		if(!empty($data)){
			$data['add_time']=time();
			 if($collect_id=$this->data($data)->add()){
			 	$data['id']=$collect_id;
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
	public function get_collect_by_id( $id=0,$isdetail=0){
		if(empty($id)){ 
			$data=array('status'=>0,'message'=>'id不能为空');
			return $data;
		}
		if($isdetail==0){
			$collect_info = $this->where(array('id'=>$id))->find();
			$data=array('status'=>1,'message'=>'成功','data'=>$collect_info);
			return $data;
		}else{//详细
			$collect_info		 = $this->where(array('id'=>$id))->find();
			$collect_detail_info = M('User')->where(array('id'=>$collect_info['belong_user_id']))->find();
			$collect_info		 =array_merge_recursive($collect_info,$collect_detail_info);
			$data=array('status'=>1,'message'=>'成功','data'=>$collect_info);
			return $data;
		}
		
	} 
	/**
	 * 获取收藏列表
	 * @param array $condition
	 * @param int $page_size
	 */
	public function get_collect_list( $condition, $page_size=15){
		$condition=array_filter($condition,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$result=array('status'=>0,'message'=>'错误','data'=>null);
		import('ORG.Util.Page');// 导入分页类
		$count      = $this->where($condition)->count();// 查询满足要求的总记录数
		$Page       = new Page($count,$page_size);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $this->where($condition)->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
		$result=array(
				'status'=>1,
				'message'=>'成功',
				'data'=>array(
					'page'=>array(
							'count'=>$count,//文章总数
							'page_size'=>$page_size,
							'page'=>$Page->firstRow+1,
							'page_str'=>$Page->show(),
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
	public function update_collectById($id,array $data){
		$result=array('status'=>0,'message'=>'修改错误','data'=>null);
		if(empty($id)||empty($data)){
			$result=array('status'=>0,'message'=>'修改失败，id或数据为空','data'=>null);
			return $result;
		}
		
		$data['update_time']=time();
		if($result['data']=$this->where(array('id'=>$id))->save($data)){ // 根据条件保存修改的数据
			$result['status']=1;
			$result['message']='修改成功';
		}
		
		return $result;
		
	}
	/**
	 * 删除收藏
	 * @param array $condition
	 */
	public function del_collect($condition)
	{
		$result=array('status'=>0,'message'=>'删除成功','data'=>null);
		if(is_array($condition) && empty($condition)){
			$result=array('status'=>0,'message'=>'删除成功失败，id或数据为空','data'=>$condition);
			return $result;
		}
		if(!is_array($condition)&&!empty($condition))
		{
			$condition['id']=$condition;
		}
		if($result['data']=$this->where($condition)->delete())
		{ 
			// 删除所有状态为0的用户数据
			$result=array('status'=>1,'message'=>'删除成功','data'=>$result['data']);
		}
		return $result;
		
	}
	
	
	
	
}