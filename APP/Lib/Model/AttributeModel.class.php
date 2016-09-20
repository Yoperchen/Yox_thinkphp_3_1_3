<?php
/**
 * 商品属性
 * 自定义属性分类|同一个商品根据不同的属性(如颜色、大小)有不同的价格
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 */
class AttributeModel extends Model {
	/**
	 * 添加属性
	 * @param array $data
	 */
	public function add_attribute( $data){
		$data=array_filter($data);//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$result=array('status'=>0,'message'=>'data不能为空');
		if(!empty($data)){
			$data['add_time']=time();
			 if($attribute_id=$this->data($data)->add()){
			 	$data['id']=$attribute_id;
				$result=array('status'=>1,'message'=>'成功','data'=>$data);
			 }
			return $result;
		}
	}
	/**
	 * 取单个属性
	 * @param number $id
	 * @param number $isdetail 是否详细，详细就获取用户信息
	 * @return array
	 */
	public function get_attribute_by_id( $id=0){
		if(empty($id)){ 
			$data=array('status'=>0,'message'=>'id不能为空');
			return $data;
		}
		$attribute_info = $this->where(array('id'=>$id))->find();
		$data=array('status'=>1,'message'=>'成功','data'=>$attribute_info);
		return $data;

		
	}
	/**
	 * 根据属性类型取所有属性
	 * @param int $type_id
	 * @return array
	 */
	public function get_attribute_by_type_id($type_id){
		if(empty($type_id)){
			$data=array('status'=>0,'message'=>'id不能为空');
			return $data;
		}
		$attribute_info = $this->where(array('type_id'=>$type_id))->select();
		$data=array('status'=>1,'message'=>'成功','data'=>$attribute_info);
		return $data;
	}
	/**
	 * 根据商品ID获取自定义字段、价格
	 * @param int $good_id
	 * @return array $attribute_info
	 */
	public function get_attribute_by_good_id($good_id)
	{
		if(empty($good_id)){
			$data=array('status'=>0,'message'=>'id不能为空');
			return $data;
		}
		$type_list = M('attribute_type')->where(array('good_id'=>$good_id))->select();
		foreach ($type_list as $type)
		{
			$type_id_arr[]=$type['id'];
		}
		$where['attribute_type_id']  = array('in',$type_id_arr);
		$attribute_list = $this->where($where)->select();
		
		$new_attribute_list=array();
		$tmp=0;
		//让 attribute_type_id 一样的属性在一个数组里面
		foreach ($attribute_list as $key=>$attribute)
		{
			if($attribute_type_id!=$attribute['attribute_type_id'])
			{
				$tmp++;
				$attribute_type_id=$attribute['attribute_type_id'];
				$new_attribute_list[$tmp]['attribute'][]=$attribute;
			}else{
				$new_attribute_list[$tmp]['attribute'][]=$attribute;
			}
			if(empty($new_attribute_list[$tmp]['type']))
			{
				foreach($type_list as $type){
					if($type['id']==$attribute['attribute_type_id'])
					{
					$new_attribute_list[$tmp]['type']=$type;
					}
				}
			}
			
		}
		$data=array('status'=>1,'message'=>'成功','data'=>$new_attribute_list);
		return $data;
	}
	/**
	 * 获取收藏列表
	 * @param array $condition
	 * @param int $page_size
	 */
	public function get_attribute_list( $condition, $page_size=15){
		$condition=array_filter($condition);//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
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
	public function update_attributeById($id,array $data){
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
	public function del_attribute(array $condition){
		$result=array('status'=>0,'message'=>'删除成功','data'=>null);
		if(empty($condition)){
			$result=array('status'=>0,'message'=>'删除成功失败，id或数据为空','data'=>null);
			return $result;
		}
		
		if($result['data']=$this->where($condition)->delete()){ // 删除所有状态为0的用户数据
			$result=array('status'=>1,'message'=>'删除成功','data'=>$result['data']);
		}
		return $result;
		
	}
	
	
	/**
	 * 添加属性类型
	 * @param array $data
	 */
public function add_type( $data){
		$data=array_filter($data);//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$result=array('status'=>0,'message'=>'data不能为空');
		if(!empty($data)){
			$data['add_time']=time();
			 if($type_id=M('Attribute_type')->data($data)->add())
			 {
			 	$data['id']=$type_id;
				$result=array('status'=>1,'message'=>'成功','data'=>$data);
			 }else{
			 	$result=array('status'=>0,'message'=>'添加失败','data'=>$data);
			 }
			return $result;
		}
	}
	/**
	 * 获取单个属性类型
	 * @param int $type_id
	 */
	public function get_type_by_typeid( $type_id=0){
		if(empty($type_id)){
			$data=array('status'=>0,'message'=>'id不能为空');
			return $data;
		}
		$type_info = M('Attribute_type')->where(array('id'=>$type_id))->find();
		$data=array('status'=>1,'message'=>'成功','data'=>$type_info);
		return $data;
	
	
	}
	/**
	 * 获取属性类型列表
	 * @param array $condition
	 * @param int $page_size
	 */
	public function get_type_list( $condition, $page_size=15)
	{
		$condition=array_filter($condition);//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$result=array('status'=>0,'message'=>'错误','data'=>null);
		import('ORG.Util.Page');// 导入分页类
		$count      = M('Attribute_type')->where($condition)->count();// 查询满足要求的总记录数
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
						),
						'list'=>$list
				),
		);
		return $result;
		// 		$this->assign('list',$list);// 赋值数据集
		// 		$this->assign('page',$show);// 赋值分页输出
	}
	/**
	 * 修改属性类型
	 * @param int $id
	 * @param array $data
	 */
	public function update_typeById($id, $data){
		$result=array('status'=>0,'message'=>'修改错误','data'=>null);
		if(empty($id)||empty($data)){
			$result=array('status'=>0,'message'=>'修改失败，id或数据为空','data'=>null);
			return $result;
		}
	
		$data['update_time']=time();
		if($result['data']=M('Attribute_type')->where(array('id'=>$id))->save($data))
		{ // 根据条件保存修改的数据
			$result['status']=1;
			$result['message']='修改成功';
		}else{
			$result['status']=0;
			$result['message']='修改失败';
		}
	
		return $result;
	
	}
	/**
	 * 删除属性类型
	 * @param array $condition
	 */
	public function del_type(array $condition){
		$result=array('status'=>0,'message'=>'删除成功','data'=>null);
		if(empty($condition)){
			$result=array('status'=>0,'message'=>'删除成功失败，id或数据为空','data'=>null);
			return $result;
		}
	
		if($result['data']=M('Attribute_type')->where($condition)->delete())
		{ 
			$result=array('status'=>1,'message'=>'删除成功','data'=>$result['data']);
		}else{
			$result=array('status'=>0,'message'=>'删除失败','data'=>$result['data']);
		}
		return $result;
	
	}
}