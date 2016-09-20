<?php
/**
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *文章分类
 */
class Article_categoryModel extends Model {
	

	/**
	 * 添加文章
	 * @param array $data
	 */
	public function add_category($data){
		$data=array_filter($data,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$data['add_time']=time();
		$result=array('status'=>0,'message'=>'data不能为空');
		if(!empty($data['user_id'])&&!is_numeric($data['user_id'])){
			$result=array('status'=>0,'message'=>'user_id 错误','data'=>null);
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

			$category_id= $this->data(data)->add();
			$result=array('status'=>1,'message'=>'成功'.$img_err,
					'data'=>array(
							'id'=>$category_id,
							'title'=>$data['title'],
							'content'=>$data['content'],
							'desc'=>$data['desc'],
							'type'=>$data['type'],
					));
			return $result;

	}
	/**
	 * 
	 * @param number $id
	 * @param number $isdetail
	 * @return array
	 */
	public function getCategoryById($id=0,$isdetail=0){
		if(empty($id)){ 
			$data=array('status'=>0,'message'=>'id不能为空');
			return $data;
		}
		if($isdetail==0){
			$article_info = $this->where(array('id'=>$id))->find();
			$result=array('status'=>1,'message'=>'成功','data'=>$article_info);
		}else{//详细
			$article_info		 = $this->where(array('id'=>$id))->find();
			$article_detail_info = M('Article_detail')->where(array('article_id'=>$id))->find();
			$article_info		 =array_merge_recursive($article_info,$article_detail_info);
			$result=array('status'=>1,'message'=>'获取详细信息成功','data'=>$article_info);
		}
		//访问日志
		if(session('?account_type')&&session('?id')&&session('?name')){
			$visit_data=array();
			$visit_data['visit_user_id']=session('id');;//访问者
			$visit_data['interviewees_user_id']=$article_info['user_id'];//被访问者
			$visit_data['interviewees_store_id']=$article_info['store_id'];//被访问者
			$visit_data['visit_content']='文章';//访问内容
			D('Visit_logModel')->add_visit_log($data);
		}
		return $result;
		
	} 
	/**
	 * 文章列表
	 * @param array $condition
	 * @param number $page_size
	 * @return array
	 */
	public function get_article_category_list($condition,$page_size=50){
		$condition=array_filter($condition,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$result=array('status'=>0,'message'=>'错误','data'=>null);
		import('ORG.Util.Page');// 导入分页类
		$count      = $this->where($condition)->count();// 查询满足要求的总记录数
		$Page       = new Page($count,$page_size);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $this->where($condition)->order('path,sort,id')->limit($Page->firstRow.','.$Page->listRows)->select();
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
				if($level==6){//第六及，还不够吗
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
			);
		}else{
			$result=array(
					'status'=>0,
					'message'=>'数据为空',
					'data'=>array(
							'page'=>array(),
							'list'=>$list_new
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
	public function update_CategoryById($id,$data){
		$data=array_filter($data,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致把数据修改为空
		$data['update_time']=time();
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
		if($this->where(array('id'=>$id))->save($data)){ // 根据条件保存修改的数据
			$result=array('status'=>1,'message'=>'修改成功','data'=>$data);
		}else{
			$result=array('status'=>0,'message'=>'修改失败','data'=>$data);
		}
		
		return $result;
		
	}
	
	public function del_category($condition){
		$result=array('status'=>0,'message'=>'删除成功','data'=>null);
		if(empty($condition)){
			$result=array('status'=>0,'message'=>'删除成功失败，id或数据为空','data'=>null);
			return $result;
		}
		if(!empty($condition['id'])){
			$category_info_result = $this->getCategoryById($condition['id']);
			if($category_info_result['status']<1)
			{
				$result=array('status'=>0,'message'=>'查询出错1','data'=>$category_info_result['message']);
				return $result;
			}
			//查询是否有子类
			$tmp_condition['path']=array(
					array('like','%-'.$category_info_result['data']['id'].'%'),
					array('like','%-'.$category_info_result['data']['id'].'-%'),
					array('like','%'.$category_info_result['data']['id'].'-%'),
					'or');
			$category_list = $this->where($tmp_condition)->select();
			if(!empty($category_list))
			{//存在子类，不能删除
			$result=array('status'=>0,'message'=>'此分类下存在子类，不能删除，请先删除子分类','data'=>$category_list);
			return $result;
			}
		}
		$tmp=$this->where($condition)->delete();
		if($tmp){ // 删除所有状态为0的用户数据
			$result=array('status'=>1,'message'=>'删除成功','data'=>$tmp);
		}else{
			$result=array('status'=>0,'message'=>'删除失败','data'=>$tmp);
		}
		return $result;
		
	}
	
	
	
	
}