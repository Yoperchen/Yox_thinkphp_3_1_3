<?php
/**
 * 活动
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 */
class ActivityModel extends Model 
{
	/**
	 * 添加分享
	 * @param array $data
	 */
	public function add_activity($data)
	{
		$data=array_filter($data,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$data['add_time']=time();
		$result=array('status'=>0,'message'=>'data不能为空');

		if(!empty($data))
		{
			$detail_data=array();
			$activity_id=$this->data($data)->add();
			$data['id']=$activity_id;
		}
			
		if($activity_id){
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
	public function get_activityById($id=0,$isdetail=0)
	{
		if(empty($id)){ 
			$data=array('status'=>0,'message'=>'id不能为空');
			return $data;
		}
		$this->where(array('id'=>$id))->setLazyInc('view',1,60);//每60秒统一更新+1
		if($isdetail==0){
			$activity_info = $this->where(array('id'=>$id))->find();
			$data=array('status'=>1,'message'=>'成功','data'=>$activity_info);
			return $data;
		}else{//详细
			$activity_info		 = $this->where(array('id'=>$id))->find();
			$activity_detail_info = M('User')->where(array('user_id'=>$activity_info['user_id']))->find();
			$activity_info		 =array_merge_recursive($activity_info,$activity_detail_info);
			$data=array('status'=>1,'message'=>'获取详细信息成功','data'=>$activity_info);
			return $data;
		}
		
	} 
	/**
	 * 分享列表
	 * @param array $condition
	 * @param number $page_size
	 * @return array
	 */
	public function get_activity_list($condition,$page_size=20)
	{
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
		$list_tmp = $this->where($condition)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$list=array();
		foreach($list_tmp as $detail)
		{
			//提去url站点域名链接
			$parse_result = parse_url($detail['url']);
			$detail['host']=$parse_result['scheme'].'://'.$parse_result['host'];
			$list[] = $detail;
		}
		unset($list_tmp);
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
	public function update_activityById($id,$data)
	{
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
	/**
	 * 删除
	 * @param int $id
	 */
	public function del_activity($id)
	{
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
	/**
	 * 通用优惠函数
	 */
	private function cut_by_setting()
	{
		
	}
	/**
	 * 执行优惠函数
	 */
	public function run_activity($order_id)
	{
		$activity_condition=array();
		$activity_condition['status']=1;
		$get_activity_list_result = $this->get_activity_list($activity_condition,$page_size=100);
		$list_item=array();
		$order_info_result = D('Order')->get_order_info($order_id,$isdetail=0,$field="order_id");
		if(!empty($order_info_result['data']['goods_id']))
		{
			
			$list_item['goods_id_str']=$order_info_result['data']['goods_id'];
		}
		$this->check_activity($list_item);
		
	}
	/**
	 * 检查函数
	 */
	public function check_activity($list_item,$activity_id_str)
	{
		//商品
		if($list_item['goods_id_str'])
		{
			
		}
		//文章
		if($list_item['article_id_str'])
		{
				
		}
		//广告
		if($list_item['ad_id_str'])
		{
		
		}
		return array('status'=>1,'message'=>'在活动条件内');
	}
	
}