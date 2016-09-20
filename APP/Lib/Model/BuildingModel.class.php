<?php
/**
 * 建筑物管理
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class BuildingModel extends Model {
	/**
	 * 添加建筑物
	 * @param array $data
	 */
	public function add_building($data){
		$result=array('status'=>0,'message'=>'data不能为空');

		$file_data=array();
		$file_data['user_id']=$data['user_id']?$data['user_id']:'';
		$file_data['store_id']=$data['store_id']?$data['store_id']:'';
		$file_data['site_id']=$data['site_id']?$data['site_id']:'';
		$file_data=array_filter($file_data,"Yocms_del_empty");
		$Files_model = D('Files');
		$file_list_result = $Files_model->add_file($file_data);
		foreach($file_list_result['list'] as $key=>$file_info){
			$data['img_50_50']=array_key_exists('img_50_50', $file_info)?$file_info['img_50_50']:'';
			$data['img_200_200']=array_key_exists('img_200_200', $file_info)?$file_info['img_200_200']:'';
			$data['img3']=array_key_exists('img3', $file_info)?$file_info['img3']:'';
		}
		$data=array_filter($data,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		if(!empty($data)){
			$building_id=$this->data($data)->add();
			$data['id']=$building_id;
			$result=array('status'=>1,'message'=>'成功，'.$file_list_result['message'],'data'=>$data);
		}else{
			$result=array('status'=>0,'message'=>'失败，'.$file_list_result['message'],'data'=>$data);
		}
			
			return $result;

	}
	/**
	 * 建筑物详细
	 * @param number $id
	 * @param number $isdetail
	 * @return array
	 */
	public function getBuildingById($id=0){
		if(empty($id)){ 
			$data=array('status'=>0,'message'=>'id不能为空');
			return $data;
		}
		$building_info		 = $this->where(array('id'=>$id))->find();
		$data=array('status'=>1,'message'=>'成功','data'=>$building_info);
		return $data;
		
	} 
	/**
	 * 建筑物列表
	 * @param array $condition
	 * @param number $page_size
	 * @return array
	 */
	public function get_building_list($condition,$page_size=20){
		$condition=array_filter($condition);//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$result=array('status'=>0,'message'=>'错误','data'=>null);
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
								'count'=>$count,//文章总数
								'page_size'=>$page_size,
								'page'=>$Page->firstRow+1,
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
	public function update_buildingById($id,$data){
		$condition=array_filter($condition);//去掉数组空值，不然条件上会加上 xx='' 导致把数据修改为空
		$result=array('status'=>0,'message'=>'修改错误','data'=>null);
		if(empty($id)||empty($data)){
			$result=array('status'=>0,'message'=>'修改失败，id或数据为空','data'=>null);
			return $result;
		}
		$file_data=array();
		$file_data['user_id']=$data['user_id']?$data['user_id']:'';
		$file_data['store_id']=$data['store_id']?$data['store_id']:'';
		$file_data['site_id']=$data['site_id']?$data['site_id']:'';
		$file_data=array_filter($file_data,"Yocms_del_empty");
		$Files_model = D('Files');
		$file_list_result = $Files_model->add_file($file_data);
		foreach($file_list_result['list'] as $key=>$file_info){
			$data['img_50_50']=array_key_exists('img_50_50', $file_info)?$file_info['img_50_50']:'';
			$data['img_200_200']=array_key_exists('img_200_200', $file_info)?$file_info['img_200_200']:'';
			$data['img3']=array_key_exists('img3', $file_info)?$file_info['img3']:'';
		}
		$data=array_filter($data,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		if($this->where(array('id'=>$id))->save($data)){ // 根据条件保存修改的数据
			$data['id']=$id;
			$result=array(
					'status'=>1,
					'message'=>'修改成功,'.$file_list_result['message'],
					'data'=>$data);
		}else{
			$result=array(
					'status'=>0,
					'message'=>'修改失败,'.$file_list_result['message'],
					'data'=>$data);
		}
		
		return $result;
		
	}
	/**
	 * 删除建筑物
	 * @param array $condition
	 */
	public function del_building($condition)
	{
		$result=array('status'=>0,'message'=>'删除成功','data'=>null);
		if(is_array($condition) && empty($condition['id']))
		{
			$result=array('status'=>0,'message'=>'删除成功失败，id或数据为空','data'=>null);
			return $result;
		}
		if(!is_array($condition)&&!empty($condition))
		{
			$condition['id']=$condition;
		}
		
		$tmp=$this->where($condition)->delete();
		if($tmp){ // 删除所有状态为0的用户数据
			$result=array('status'=>1,'message'=>'删除成功','data'=>$tmp);
		}else{
			$result=array('status'=>1,'message'=>'删除失败','data'=>$tmp);
		}
		return $result;
		
	}
	
	
	
	
}