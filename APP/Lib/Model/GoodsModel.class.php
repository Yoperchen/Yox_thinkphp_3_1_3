<?php
/**
 * 商品
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 */
class GoodsModel extends AdvModel {
	public function add_good($data){
		$result=array('status'=>0,'message'=>'data不能为空');
		if(!empty($data['community_id'])&&!is_numeric($data['community_id'])){
			$result=array('status'=>0,'message'=>'社区id格式有误');
			return $result;
		}
		if(!empty($data['category'])&&!is_numeric($data['category'])){
			$result=array('status'=>0,'message'=>'商品分类id格式有误');
			return $result;
		}
		if(!empty($data['brand'])&&!is_numeric($data['brand'])){
			$result=array('status'=>0,'message'=>'品牌id格式有误');
			return $result;
		}
		if(!empty($data['user_id'])&&!is_numeric($data['user_id'])){
			$result=array('status'=>0,'message'=>'用户id格式有误');
			return $result;
		}
		if(!empty($data['store_id'])&&!is_numeric($data['store_id'])){
			$result=array('status'=>0,'message'=>'商家id格式有误');
			return $result;
		}
		if(!empty($data['quantity'])&&!is_numeric($data['quantity'])){
			$result=array('status'=>0,'message'=>'数量格式格式有误');
			return $result;
		}
		if(!empty($data['city_id'])&&!is_numeric($data['city_id'])){
			$result=array('status'=>0,'message'=>'城市id格式有误');
			return $result;
		}
		if(!empty($data['district_id'])&&!is_numeric($data['district_id'])){
			$result=array('status'=>0,'message'=>'district_id格式有误');
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
		if(!empty($data)){
			if($good_id=$this->data($data)->add()){
				$Attribute_data_arr=array();
				if(!empty($data['attribute_type'])){
					foreach($data['attribute_type'] as $key=>$attribute_type)//$data['attribute_type'] 只能用原生的$_POST采恩那个取到， tp的是取不到的	
					{
						$type=$attribute_type['type'];
						$type['good_id']=$good_id;
						if(empty($attribute_type['type']['type_name']))
							$type['type_name']=$data['name'];
						if(empty($attribute_type['type']['price']))
							$type['price']=$data['price'];
						
						$attribute_type_id = M('Attribute_type')->data($type)->add();
						foreach($attribute_type['attribute'] as $key=>$attribute)
						{
							$attribute['attribute_type_id']=$attribute_type_id;
							$Attribute_data_arr[]=$attribute;
						}
					}
					$attribute_result = M('Attribute')->addAll($Attribute_data_arr,array(),true);//只返回第一个ID
					print_r($Attribute_data_arr);die();
// 					$type_result = M('Attribute_type')->addAll($type_arr,array(),true);//只返回第一个ID
// 					$attribute_result = M('Attribute')->addAll($Attribute_arr,array(),true);//只返回第一个ID
				}
// 				$detail_data['article_id']=$article_id;
// 				M('Article_detail')->data($detail_data)->add();
				$data['goods_id']=$good_id;
				$result=array('status'=>1,'message'=>'成功',
						'data'=>$data);
			}else
			{
				$result=array('status'=>0,'message'=>'新增失败',
						'data'=>$data);
			}
				
		}
		return $result;
	}
	
	public function update_goodById($id,$data){
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
		if($this->where(array('goods_id'=>$id))->save($data)){ // 根据条件保存修改的数据
// 			M('Article_detail')->data($detail_data)->add();
			$result['status']=1;
			$result['message']='修改成功';
			$result['data']=$data;
		}
	
		return $result;
	
	}
	/**
	 * 点赞
	 * @param int $good_id
	 * @return array $result
	 */
	public function set_good_up(int $good_id){
		$good_info = $this->getGoodById($good_id);
		$data['up']=$good_info['up']+1;
		if($this->update_goodById($good_id,$data)){
			$result=array('status'=>1,'message'=>'已顶','data'=>$good_id);
		}else{
			$result=array('status'=>0,'message'=>'点赞失败','data'=>$good_id);
		}
		return $result;
	}
	/**
	 * 差评
	 * @param int $good_id
	 * @return array $result
	 */
	public function set_good_down(int $good_id){
		$good_info = $this->getGoodById($good_id);
		$data['down']=$good_info['down']+1;
		if($this->update_goodById($good_id,$data)){
			$result=array('status'=>1,'message'=>'已差评','data'=>$good_id);
		}else{
			$result=array('status'=>0,'message'=>'操作失败','data'=>$good_id);
		}
		return $result;
	}
	/**
	 * 喜欢
	 * @param int $good_id
	 * @return array $result
	 */
	public function set_good_like(int $good_id){
		$good_info = $this->getGoodById($good_id);
		$data['like']=$good_info['like']+1;
		if($this->update_goodById($good_id,$data)){
			$result=array('status'=>1,'message'=>'操作成功','data'=>$good_id);
		}else{
			$result=array('status'=>0,'message'=>'操作失败','data'=>$good_id);
		}
		return $result;
	}
	/**
	 *
	 * @param number $id
	 * @param number $isdetail
	 * @return array
	 */
	public function getGoodById($id=0,$isdetail=0){
		if(empty($id)){
			$data=array('status'=>0,'message'=>'id不能为空');
			return $data;
		}
		$this->where(array('id'=>$id))->setLazyInc('view',1,60);//每60秒统一更新+1
		if($isdetail==0){
			$good_info = $this->where(array('id'=>$id))->find();
			$attribute_info = D('Attribute')->get_attribute_by_good_id($id);//属性类型数据、一个商品根据不同的属性有多个价格
			$good_info['attribute_type']=$attribute_info['data'];
			$data=array('status'=>1,'message'=>'成功','data'=>$good_info);
			return $data;
		}else{//详细
			$good_info		 = $this->where(array('id'=>$id))->find();
			$attribute_info = D('Attribute')->get_attribute_by_good_id($id);//属性类型数据、一个商品根据不同的属性有多个价格
			$good_info['attribute_type']=$attribute_info['data'];
// 			$article_detail_info = M('Article_detail')->where(array('goods_id'=>$id))->find();
// 			$article_detail		 =array_merge_recursive($article_info,$article_detail_info);
			$data=array('status'=>1,'message'=>'成功','data'=>$good_info);
			return $data;
		}
	
	}
	public function get_goods_list($condition,$page_size=12){
		$condition=array_filter($condition,"Yocms_del_empty");//去掉数组空值，
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
								'page'=>$Page->firstRow+1,//当前第几页
								'page_str'=>$Page->show(),
							),
						'list'=>$list
				),
				'condition'=>$condition,
		);
// 		print_r($result);
		return $result;
	}
	
	public function del_good($id){
		$result=array('status'=>0,'message'=>'删除失败','data'=>$id);
		if(empty($id)){
			$result=array('status'=>0,'message'=>'删除成功失败，id或数据为空','data'=>$id);
			return $result;
		}
	
		if($this->where(array('goods_id'=>$id))->delete()){ // 删除所有状态为0的用户数据
			$result=array('status'=>1,'message'=>'删除成功','data'=>$id);
		}
		return $result;
	
	}
	
}
