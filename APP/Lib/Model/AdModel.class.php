<?php
/**
 * 广告
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class AdModel extends AdvModel {
	/**
	 * 添加广告
	 * @param array $data
	 */
	public function add_ad($data){
		$data['add_time']=time();
		$result=array('status'=>0,'message'=>'data不能为空');
		if(!empty($data['user_id'])&&!is_numeric($data['user_id'])){
			$result=array('status'=>0,'message'=>'user_id 错误','data'=>$data);
		}
		if(!empty($data['store_id'])&&!is_numeric($data['store_id'])){
			$result=array('status'=>0,'message'=>'store_id 错误','data'=>$data);
		}
		if(!empty($data['site_id'])&&!is_numeric($data['site_id'])){
			$result=array('status'=>0,'message'=>'site_id 错误','data'=>$data);
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
		if(!empty($data)){
			$data['id']=$this->data($data)->add();
			$result=array('status'=>1,'message'=>'成功'.$file_list_result['message'],
					'data'=>$data
			);
			return $result;
		}

	}
	/**
	 * 获取广告
	 * @param number $id
	 * @param number $isdetail
	 * @return array
	 */
	public function getAdById($id=0){
		if(empty($id)){ 
			$result=array('status'=>0,'message'=>'id不能为空');
			return $result;
		}
		$this->where(array('id'=>$id))->setLazyInc('view',1,60);//每60秒统一更新+1
		if(empty($isdetail)){
		    $s_key='ad_getAdById_'.$id;
		    $ad_info = S($s_key);
		    if(empty($ad_info))
		    {
		        $ad_info = $this->where(array('id'=>$id))->find();
		        S($s_key,$ad_info,array('expire'=>'300'));
		    }
		    $result['status']=0;
		    $result['message']='成功';
		    $result['data']=$ad_info;
		}
		return $result;
	} 
	/**
	 * 广告列表
	 * @param array $condition
	 * @param number $page_size
	 * @return array
	 */
	public function get_ad_list($condition,$page_size=20){
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
								'count'=>$count,//文章总数
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
	 * 修改广告
	 * @param int $id
	 * @param array $data
	 */
	public function update_adById($id,$data){
		$data=array_filter($data);//去掉数组空值，不然条件上会加上 xx='' 导致把数据修改为空
		$data['update_time']=time();
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
			$data['id']=$id;
			$result=array(
					'status'=>1,
					'message'=>'修改成功',
					'data'=>$data
			);
		}else{
			$result=array(
					'status'=>0,
					'message'=>'修改失败',
					'data'=>$data);
		}
		
		return $result;
		
	}
	/**
	 * 删除广告
	 * @param int $id
	 */
	public function del_ad($id){
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