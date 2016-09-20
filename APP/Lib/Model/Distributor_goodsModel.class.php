<?php
/**
 *
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 */
class Distributor_goodsModel extends Model {
	public function add_good($data){
		$data=array_filter($data);//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$result=array('status'=>0,'message'=>'data不能为空');
		
		if(!empty($data['category_id'])&&!is_numeric($data['category_id'])){
			$result=array('status'=>0,'message'=>'商品分类id格式有误');
			return $result;
		}
		if(!empty($data['distrbutor_user_id'])&&!is_numeric($data['distrbutor_user_id'])){
			$result=array('status'=>0,'message'=>'用户id格式有误');
			return $result;
		}
		if(!empty($data['distrbutor_store_id'])&&!is_numeric($data['distrbutor_store_id'])){
			$result=array('status'=>0,'message'=>'商家id格式有误');
			return $result;
		}
		
		if(!empty($data)){
			if($good_id=$this->data($data)->add()){
// 				$detail_data['article_id']=$article_id;
// 				M('Article_detail')->data($detail_data)->add();
				$data['good_id']=$good_id;
				$result=array('status'=>1,'message'=>'成功',
						'data'=>$data);
			}
				
		}
		return $result;
	}
	
	public function update_goodById($id,$data){
		$condition=array_filter($condition);//去掉数组空值，不然条件上会加上 xx='' 导致把数据修改为空
		$result=array('status'=>0,'message'=>'修改错误','data'=>null);
		if(empty($id)||empty($data)){
			$result=array('status'=>0,'message'=>'修改失败，id或数据为空','data'=>null);
			return $result;
		}

		if($this->where(array('id'=>$id))->save($data)){ // 根据条件保存修改的数据
// 			M('Article_detail')->data($detail_data)->add();
			$result['status']=1;
			$result['message']='修改成功';
			$data['goods_id']=$id;
			$result['data']=$data;
			return $result;
		}else{
			$result=array('status'=>0,'message'=>'保存失败','data'=>$data);
			return $result;
		}
	
		
	
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
			$result=array('status'=>1,'message'=>'已点赞','data'=>$good_id);
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
			$result=array('status'=>1,'message'=>'已喜欢','data'=>$good_id);
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
		if($isdetail==0){
			$good_info = $this->where(array('id'=>$id))->find();
			$data=array('status'=>1,'message'=>'成功','data'=>$good_info);
			return $data;
		}else{//详细
			$article_info		 = $this->where(array('goods_id'=>$id))->find();
// 			$article_detail_info = M('Article_detail')->where(array('goods_id'=>$id))->find();
// 			$article_detail		 =array_merge_recursive($article_info,$article_detail_info);
			$data=array('status'=>1,'message'=>'成功','data'=>$article_info);
			return $data;
		}
	
	}
	public function get_good_list($condition,$page_size=12){
		$condition=array_filter($condition);//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$result=array('status'=>0,'message'=>'错误','data'=>null);
		import('ORG.Util.Page');// 导入分页类
		$count      = $this->where($condition)->count();// 查询满足要求的总记录数
		$Page       = new Page($count,$page_size);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $this->where($condition)->order('goods_id')->limit($Page->firstRow.','.$Page->listRows)->select();
		$result=array(
				'status'=>1,
				'message'=>'成功',
				'data'=>array(
								'page'=>array(
								'count'=>$count,//文章总数
								'page_size'=>$page_size,
								'page'=>$Page->firstRow+1,//当前第几页
							),
						'list'=>$list
				),
		);
		return $result;
		// 		$this->assign('list',$list);// 赋值数据集
		// 		$this->assign('page',$show);// 赋值分页输出
	}
	
	public function del_good($id){
		$result=array('status'=>0,'message'=>'删除失败','data'=>$id);
		if(empty($id)){
			$result=array('status'=>0,'message'=>'删除成功失败，id或数据为空','data'=>$id);
			return $result;
		}
	
		if($this->where(array('id'=>$id))->delete()){ // 删除所有状态为0的用户数据
			$result=array('status'=>1,'message'=>'删除成功','data'=>$id);
		}
		return $result;
	
	}
	
}