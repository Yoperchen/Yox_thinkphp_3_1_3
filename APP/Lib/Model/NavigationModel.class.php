<?php
/**
 * 导航条
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class NavigationModel extends Model {
	/**
	 * 添加导航
	 * @param array $data
	 */
	public function add_navigation( $data){
		$data=array_filter($data);//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$result=array('status'=>0,'message'=>'data不能为空');
		//path字段
		if(!empty($data['pid'])){
			$category_info_result = $this->get_info_by_category_id($data['pid']);
			if($category_info_result['status']<1)
			{
				$result=array('status'=>0,'message'=>$category_info_result['message']);
			}
			//子分类与上级分类要在同一个商家
			if($category_info_result['data']['store_id']!=$data['store_id'])
			{
				$result=array('status'=>0,'message'=>'子分类与上级分类必须在同一个商家');
			}
			//子分类与上级分类要在同一个站点
			if($category_info_result['data']['site_id']!=$data['site_id'])
			{
				$result=array('status'=>0,'message'=>'子分类与上级分类必须在同一个站点');
			}
			$data['path']=$category_info_result['data']['path'].'-'.$data['pid'];
		}else{
			$data['pid']=0;
			$data['path']=0;
		}
		
		if(!empty($data)){
			$data['add_time']=time();
			$navigation_id=$this->data($data)->add();
			 if($navigation_id){
			 	$data['id']=$navigation_id;
				$result=array('status'=>1,'message'=>'成功','data'=>$data);
			 }else{
			 	$result=array('status'=>0,'message'=>'新增导航失败','data'=>$data);
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
	public function get_navigation_by_id( $id=0,$isdetail=0){
		if(empty($id)){ 
			$data=array('status'=>0,'message'=>'id不能为空');
			return $data;
		}
		if($isdetail==0){
			$navigation_info = $this->where(array('id'=>$id))->find();
			$data=array('status'=>1,'message'=>'成功','data'=>$navigation_info);
			return $data;
		}else{//详细
			$navigation_info		 = $this->where(array('id'=>$id))->find();
			$navigation_detail_info = M('User')->where(array('id'=>$navigation_info['belong_user_id']))->find();
			$navigation_info		 =array_merge_recursive($navigation_info,$navigation_detail_info);
			$data=array('status'=>1,'message'=>'成功','data'=>$navigation_info);
			return $data;
		}
		
	} 
	/**
	 * 获取导航列表
	 * @param array $condition
	 * @param int $page_size
	 */
	public function get_navigation_list( $condition, $page_size=50){
		$condition=array_filter($condition,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$result=array('status'=>0,'message'=>'错误','data'=>null);
		import('ORG.Util.Page');// 导入分页类
		$count      = $this->where($condition)->count();// 查询满足要求的总记录数
		$Page       = new Page($count,$page_size);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $this->where($condition)->order('path,sort desc,id')->limit($Page->firstRow.','.$Page->listRows)->select();
// 		print_r($list);
		//组转数据
		//必须保证pid/path字段正确
		$list_new = array();
		foreach ($list as $key=>$category){
			if(empty($category['pid'])){//顶级分类
				$list_new[$category['id']]=$category;
			}else{
				$pid_arr = explode('-', $category['path']);
				$level = count($pid_arr);
				if($level==2){//第二级
					$list_new[$pid_arr[1]]['children'][$category['id']]=$category;
				}
				if($level==3){//第三级
					$list_new[$pid_arr[1]]['children'][$pid_arr[2]]['children'][$category['id']]=$category;
				}
				if($level==4){//第四级
					$list_new[$pid_arr[1]]['children'][$pid_arr[2]]['children'][$pid_arr[3]]['children'][$category['id']]=$category;
				}
				if($level==5){//第五级
					$list_new[$pid_arr[1]]['children'][$pid_arr[2]]['children'][$pid_arr[3]]['children'][$pid_arr[4]]['children'][$category['id']]=$category;
				}
				if($level==6){//第六及
					$list_new[$pid_arr[1]]['children'][$pid_arr[2]]['children'][$pid_arr[3]]['children'][$pid_arr[4]]['children'][$pid_arr[5]]['children'][$category['id']]=$category;
				}
				if($level==7){//第七级，够了把
					$list_new[$pid_arr[1]]['children'][$pid_arr[2]]['children'][$pid_arr[3]]['children'][$pid_arr[4]]['children'][$pid_arr[5]]['children'][$pid_arr[6]]['children'][$category['id']]=$category;
				}
			}
		}
		if(!empty($list_new)){
			$result=array(
					'status'=>1,
					'message'=>'成功',
					'data'=>array(
						'page'=>array(
								'count'=>$count,//文章总数
								'page_size'=>$page_size,
								'page'=>$Page->firstRow+1,
							),
						'list'=>$list_new
					),
					'condition'=>$condition,
			);
		}else{
			$result=array(
					'status'=>0,
					'message'=>'数据为空',
					'data'=>array(
							'page'=>array(),
							'list'=>$list_new
					),
					'condition'=>$condition,
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
	public function update_navigationById($id, $data){
		$result=array('status'=>0,'message'=>'修改错误','data'=>null);
		if(empty($id)||empty($data)){
			$result=array('status'=>0,'message'=>'修改失败，id或数据为空','data'=>null);
			return $result;
		}
		//path字段
		if(!empty($data['pid'])){
			$category_info_result = $this->get_info_by_category_id($data['pid']);
			if($category_info_result['status']<1)
			{
				$result=array('status'=>0,'message'=>$category_info_result['message']);
			}
			//子分类与上级分类要在同一个商家
			if($category_info_result['data']['store_id']!=$data['store_id'])
			{
				$result=array('status'=>0,'message'=>'子分类与上级分类必须在同一个商家');
			}
			//子分类与上级分类要在同一个站点
			if($category_info_result['data']['site_id']!=$data['site_id'])
			{
				$result=array('status'=>0,'message'=>'子分类与上级分类必须在同一个站点');
			}
			$data['path']=$category_info_result['data']['path'].'-'.$data['pid'];
		}else{
			$data['pid']=0;
			$data['path']=0;
		}
		$data['update_time']=time();
		$tmp=$this->where(array('id'=>$id))->save($data);
		if($tmp){ // 根据条件保存修改的数据
			$result['data']=$tmp;
			$result['status']=1;
			$result['message']='修改成功';
		}else{
			$result=array('status'=>0,'message'=>'修改导航失败','data'=>$tmp);
		}
		
		return $result;
		
	}
	/**
	 * 删除导航
	 * @param array $condition
	 */
	public function del_navigation( $condition){
		$result=array('status'=>0,'message'=>'删除成功','data'=>null);
		if(empty($condition)){
			$result=array('status'=>0,'message'=>'删除成功失败，id或数据为空','data'=>null);
			return $result;
		}
		if(!empty($condition['id']))
		{
			$navigation_info_result = $this->get_navigation_by_id($condition['id']);
			if($navigation_info_result['status']<1)
			{
				$result=array('status'=>0,'message'=>'查询出错1','data'=>$navigation_info_result['message']);
				return $result;
			}
			//查询是否有子类
			$tmp_condition['path']=array(
					array('like','%-'.$navigation_info_result['data']['id'].'%'),
					array('like','%-'.$navigation_info_result['data']['id'].'-%'),
					array('like','%'.$navigation_info_result['data']['id'].'-%'),
					'or');
			$category_list = $this->where($tmp_condition)->select();
			if(!empty($category_list))
			{//存在子类，不能删除
			$result=array('status'=>0,'message'=>'此分类下存在子类，不能删除，请先删除子分类','data'=>$category_list);
			return $result;
			}
		}
		
		if($result['data']=$this->where($condition)->delete()){ // 删除所有状态为0的用户数据
			$result=array('status'=>1,'message'=>'删除成功','data'=>$result['data']);
		}else{
			$result=array('status'=>0,'message'=>'删除失败','data'=>$result['data']);
		}
		return $result;
		
	}
	
	
	
	
}