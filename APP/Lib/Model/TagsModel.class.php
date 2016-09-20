<?php
/**
 * 标签管理
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class TagsModel extends Model {

	// 定义自动验证
// 	protected $_validate    =   array(
// 			array('title','require','标题忘了输入了吧~&nbsp└(^o^)┘'),

// 	);
	// 定义自动完成
	//protected $_auto    =   array(
			//array('create_time','time',1,'function'),
	//);
	/**
	 * 添加文章
	 * @param array $data
	 */
	public function add_tag($data){
		$data=array_filter($data);//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$data['add_time']=time();
		$result=array('status'=>0,'message'=>'data不能为空');
		if(!is_numeric($data['user_id'])&&!is_numeric($data['cuisine_id'])
		&&!is_numeric($data['article_id'])&&!is_numeric($data['community_id'])&&!is_numeric($data['good_id'])){
			$result=array('status'=>0,'message'=>'user_id 或cuisine_id或article_id或community_id或good_id错误','data'=>null);
		}
		$tag_id=M('Tags')->data($data)->add();
		$data['id']=$tag_id;
			if($tag_id){
				$result=array('status'=>1,'message'=>'Tags成功',
						'data'=>$data,
				);
			}else{
				$result=array('status'=>0,'message'=>'添加失败',
						'data'=>$data,
				);
			}
			return $result;
		}

	/**
	 * 获取标签信息
	 * @param number $id
	 * @param number $isdetail
	 * @return array
	 */
	public function getTagById($id=0,$isdetail=0){
		if(empty($id)){ 
			$data=array('status'=>0,'message'=>'id不能为空');
			return $data;
		}
		if($isdetail==0){
			$tag_info = $this->where(array('id'=>$id))->find();
			$data=array('status'=>1,'message'=>'成功','data'=>$tag_info);
		}else{//详细
			$tag_info		 = $this->where(array('id'=>$id))->find();
			if(!empty($tag_info['article_id'])){
				$tag_info['article'] = M('Article')->where(array('id'=>$tag_info['user_id']))->find();
			}
			if(!empty($tag_info['user_id'])){
				$tag_detail_info = M('User')->where(array('id'=>$tag_info['user_id']))->find();
			}
			if(!empty($tag_info['cuisine_id'])){
				$tag_info['cuisine']  = M('Cuisine')->where(array('id'=>$tag_info['cuisine_id']))->find();
			}
			if(!empty($tag_info['store_id'])){
				$tag_info['store'] = M('Stores')->where(array('id'=>$tag_info['store_id']))->find();
			}
			if(!empty($tag_info['good_id'])){
				$tag_info['good'] = M('Goods')->where(array('id'=>$tag_info['good_id']))->find();
			}
			if(!empty($tag_info['community_id'])){
				$tag_info['community']  = M('Community')->where(array('id'=>$tag_info['community_id']))->find();
			}
			$data=array('status'=>1,'message'=>'获取详细信息成功','data'=>$tag_info);
		}
		return $data;
	} 
	/**
	 * 标签列表
	 * @param array $condition
	 * @param number $page_size
	 * @return array
	 */
	public function get_tag_list($condition,$page_size=20){
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
	 * 修改
	 * @param int $id
	 * @param array $data
	 */
	public function update_tagById($id,$data){
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
	
	public function del_tag($id){
		$result=array('status'=>0,'message'=>'删除成功','data'=>null);
		if(empty($id)){
			$result=array('status'=>0,'message'=>'删除失败，id为空','data'=>null);
			return $result;
		}
		if($tmp=$this->where(array('id'=>$id))->delete()){ // 删除所有状态为0的用户数据
			$result=array('status'=>1,'message'=>'删除成功','data'=>$tmp);
		}
		return $result;
		
	}
	
	
	
	
}