<?php
/**
 * 网站网址
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 */
class WebsiteModel extends Model {
	// 定义自动验证
// 	protected $_validate    =   array(
// 			array('title','require','标题忘了输入了吧~&nbsp└(^o^)┘'),

// 	);
	// 定义自动完成
	//protected $_auto    =   array(
			//array('create_time','time',1,'function'),
	//);
	/**
	 * 添加网站网址
	 * @param array $data
	 */
	public function add_website($data){
		$data=array_filter($data,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$data['add_time']=time();
		$result=array('status'=>0,'message'=>'data不能为空');
		if(empty($data['name']))
		{
			$result=array('status'=>0,'message'=>'名称为空','data'=>$data);
			return $result;
		}
		if(empty($data['url']))
		{
			$result=array('status'=>0,'message'=>'url为空','data'=>$data);
			return $result;
		}
		
		if(!empty($data))
		{
		    $data['add_time']=time();
			$detail_data=array();
			$website_id=$this->data($data)->add();
			$data['id']=$website_id;
		}
			
		if($website_id){
			$result=array('status'=>1,'message'=>'成功','data'=>$data);
			
		}else{
			$result=array('status'=>0,'message'=>'失败','data'=>$data);
		}
		return $result;
	}
	/**
	 * 
	 * @param number $id
	 * @param number $isdetail
	 * @return array
	 */
	public function getWebsiteById($id=0,$isdetail=0){
		if(empty($id)){ 
			$data=array('status'=>0,'message'=>'id不能为空');
			return $data;
		}
// 		$this->where(array('id'=>$id))->setLazyInc('view',1,60);//每60秒统一更新+1
		if($isdetail==0){
			$website_info = $this->where(array('id'=>$id))->find();
			$data=array('status'=>1,'message'=>'成功','data'=>$website_info);
			
		}else{//详细
			$website_info		 = $this->where(array('id'=>$id))->find();
// 			$website_detail_info = M('User')->where(array('user_id'=>$website_info['user_id']))->find();
// 			$website_info		 =array_merge_recursive($website_info,$website_detail_info);
// 			$website_info['user_info']=$website_detail_info;
			$data=array('status'=>1,'message'=>'获取详细信息成功','data'=>$website_info);
		}
		return $data;
	} 
	/**
	 * 网站网址列表
	 * @param array $condition
	 * @param number $page_size
	 * @return array
	 */
	public function get_website_list($condition,$page_size=20){
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
		$list = $this->where($condition)->order('sort asc,id desc')->limit($Page->firstRow.','.$Page->listRows)->select();

		if(!empty($list)){
			$result=array(
					'status'=>1,
					'message'=>'成功',
					'data'=>array(
						'page'=>array(
								'count'=>$count,//总数
								'page_size'=>$page_size,
								'page'=>$_REQUEST['p']?$_REQUEST['p']:1,
								'page_str'=>$Page->show(),
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
					'condition'=>$condition
			);
		}
		return $result;
	}
	/**
	 * 修改
	 * @param int $id
	 * @param array $data
	 */
	public function update_websiteById($id,$data){
		$data=array_filter($data);//去掉数组空值，不然条件上会加上 xx='' 导致把数据修改为空
		$data['update_time']=time();
		$result=array('status'=>0,'message'=>'修改错误','data'=>null);
		if(empty($id)||empty($data)){
			$result=array('status'=>0,'message'=>'修改失败，id或数据为空','data'=>null);
			return $result;
		}
		if($this->where(array('id'=>$id))->save($data)){ // 根据条件保存修改的数据
			$result=array(
					'status'=>1,
					'message'=>'修改成功',
					'data'=>$data);
		}else{
			$result=array(
					'status'=>0,
					'message'=>'修改失败',
					'data'=>array());
		}
		return $result;
	}
	
	public function del_website($id){
		$result=array('status'=>0,'message'=>'删除成功','data'=>null);
		if(empty($id)){
			$result=array('status'=>0,'message'=>'删除成功失败，id或数据为空','data'=>null);
			return $result;
		}
		$tmp=$this->where(array('id'=>$id))->delete();
		if($tmp){ // 删除所有状态为0的用户数据
			$result=array('status'=>1,'message'=>'删除成功','data'=>$tmp);
		}
		return $result;
		
	}
	
	
	
	
}