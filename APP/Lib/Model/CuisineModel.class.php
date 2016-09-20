<?php
/**
 * 菜式
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 */
class CuisineModel extends AdvModel {
	// 定义自动验证
	protected $_validate    =   array(
			array('title','require','标题忘了输入了吧~&nbsp└(^o^)┘'),

	);
	// 定义自动完成
	//protected $_auto    =   array(
			//array('create_time','time',1,'function'),
	//);
	/**
	 * 添加菜式
	 * @param array $data
	 */
	public function add_cuisine($data){
		$result=array('status'=>0,'message'=>'data不能为空');
		if(!empty($data)){
			$file_data=array();
			$file_data['user_id']=$data['user_id']?$data['user_id']:'';
			$file_data['store_id']=$data['store_id']?$data['store_id']:'';
			$file_data['site_id']=$data['site_id']?$data['site_id']:'';
			$file_data=array_filter($file_data,"Yocms_del_empty");
			$Files_model = D('Files');
			$file_list_result = $Files_model->add_file($file_data);
			foreach($file_list_result['list'] as $key=>$file_info){
				$data['img1']=array_key_exists('img1', $file_info)?$file_info['img1']:'';
				$data['img2']=array_key_exists('img2', $file_info)?$file_info['img2']:'';
				$data['img3']=array_key_exists('img3', $file_info)?$file_info['img3']:'';
				$data['img4']=array_key_exists('img4', $file_info)?$file_info['img4']:'';
				$data['img5']=array_key_exists('img5', $file_info)?$file_info['img5']:'';
				$data['img6']=array_key_exists('img6', $file_info)?$file_info['img6']:'';
			}
			$data=array_filter($data,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
			$cuisine_id=$this->data($data)->add();
			if($cuisine_id){
				$data['id']=$cuisine_id;
				$result=array('status'=>1,'message'=>'成功'.$img_err,
						'data'=>$data,
				);
			}else{
				$result=array('status'=>0,'message'=>'添加失败'.$img_err,
						'data'=>$data,
				);
			}
			return $result;
		}else{
			$result=array('status'=>0,'message'=>'但数据为空'.$img_err,
					'data'=>
					$data,
			);
			return $result;
		}
	}
	/**
	 * 获取菜式信息
	 * @param number $id
	 * @param number $isdetail
	 * @return array
	 */
	public function getCuisineById($id=0,$isdetail=0){
		$data=array('status'=>0,'message'=>'出错啦！');
		if(empty($id)){ 
			$data=array('status'=>0,'message'=>'id不能为空');
			return $data;
		}
		$this->where(array('id'=>$id))->setLazyInc('view',1,60);//每60秒统一更新+1
		if($isdetail==0){
			$cuisine_info = $this->where(array('id'=>$id))->find();
			if(empty($cuisine_info)){
				$data=array('status'=>0,'message'=>'获取菜式成功，但没有数据','data'=>$cuisine_info);
			}else{
				$data=array('status'=>1,'message'=>'成功','data'=>$cuisine_info);
			}
		}else{//详细
			$cuisine_info		 = $this->where(array('id'=>$id))>find();
			$cuisine_detail_info = M('User')->where(array('id'=>$cuisine_info['user_id']))->find();
			$cuisine_detail_info = M('User')->where(array('id'=>$cuisine_info['user_id']))->find();
			$cuisine_detail		 =array_merge_recursive($cuisine_info,$cuisine_detail_info);
			if(empty($cuisine_detail)){
				$data=array('status'=>0,'message'=>'获取菜式成功，但没有数据','data'=>$cuisine_detail);
			}else{
				$data=array('status'=>1,'message'=>'成功','data'=>$cuisine_detail);
			}
		}
		return $data;
	} 
	/**
	 * 菜式列表
	 * @param array $condition
	 * @param number $page_size
	 * @return array
	 */
	public function get_cuisine_list($condition,$page_size=20){
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
	public function update_cuisineById($id,$data){
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
			$data['img1']=array_key_exists('img1', $file_info)?$file_info['img1']:'';
			$data['img2']=array_key_exists('img2', $file_info)?$file_info['img2']:'';
			$data['img3']=array_key_exists('img3', $file_info)?$file_info['img3']:'';
			$data['img4']=array_key_exists('img4', $file_info)?$file_info['img4']:'';
			$data['img5']=array_key_exists('img5', $file_info)?$file_info['img5']:'';
			$data['img6']=array_key_exists('img6', $file_info)?$file_info['img6']:'';
		}
		$data=array_filter($data,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		if($this->where(array('id'=>$id))->save($data)){ // 根据条件保存修改的数据
			$result=array(
					'status'=>1,
					'message'=>'修改成功',
					'data'=>$data
			);
		}else{
			$result=array(
					'status'=>0,
					'message'=>'修改失败',
					'data'=>array());
		}
		
		return $result;
	}
	
	public function del_cuisine($id){
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