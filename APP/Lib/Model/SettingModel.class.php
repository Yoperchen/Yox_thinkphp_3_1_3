<?php
/**
 * 系统设置
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class SettingModel extends Model {
	
	// 定义自动验证
// 	protected $_validate    =   array(
// 			array('title','require','标题忘了输入了吧~&nbsp└(^o^)┘'),

// 	);
	// 定义自动完成
	//protected $_auto    =   array(
			//array('create_time','time',1,'function'),
	//);
	/**
	 * 添加系统设置
	 * @param array $data
	 */
	public function add_setting($data){
		$condition=array_filter($condition);//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$result=array('status'=>0,'message'=>'data不能为空');
		if(empty($data['site_id'])||empty($data['name']))
		{
			$result=array('status'=>0,'message'=>'站点ID或name不能为空','data'=>$data);
		}
		$tmp = $this->data($data)->add();
		if($tmp)
		{
			$result=array('status'=>1,'message'=>'成功','data'=>$data);
		}else{
			$result=array('status'=>0,'message'=>'失败','data'=>$data);
		}
		
		return $result;

	}
	/**
	 * 获取指定设置信息
	 * @param number $id
	 * @param number $isdetail
	 * @return array
	 */
	public function get_settingById($id=0,$isdetail=0){
		if(empty($id)){ 
			$data=array('status'=>0,'message'=>'id不能为空');
			return $data;
		}
		if($isdetail==0){
			$setting_info = $this->where(array('id'=>$id))->find();
			$result=array('status'=>1,'message'=>'成功','data'=>$setting_info);
		}else{//详细
			$setting_info		 = $this->where(array('id'=>$id))->find();
			$partner_site_info = M('Partner_site')->where(array('id'=>$setting_info['site_id']))->find();
// 			$setting_info		 =array_merge($setting_info,$partner_site_info);
			$setting_info['site_info']=$partner_site_info;
			$result=array('status'=>1,'message'=>'成功','data'=>$setting_info);
		}
		return $result;
		
	} 
	/**
	 * 设置列表
	 * @param array $condition
	 * @param number $page_size
	 * @return array
	 */
	public function get_setting_list($condition,$page_size=20){
		$condition=array_filter($condition,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
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
								'count'=>$count,//设置总数
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
	 * 修改设置
	 * @param int $id
	 * @param array $data
	 */
	public function update_settingById($id,$data){
		$condition=array_filter($condition);//去掉数组空值，不然条件上会加上 xx='' 导致把数据修改为空
		$result=array('status'=>0,'message'=>'修改错误','data'=>null);
		if(empty($id)||empty($data)){
			$result=array('status'=>0,'message'=>'修改失败，id或数据为空','data'=>null);
			return $result;
		}
		if($this->where(array('id'=>$id))->save($data)){
			// 根据条件保存修改的数据
			$result=array('status'=>1,'message'=>'修改成功','data'=>$data);
		}else{
			$result=array('status'=>0,'message'=>'修改失败','data'=>array());
		}
		
		return $result;
		
	}
	/**
	 * 删除设置
	 * @param int $id
	 * @return array
	 */
	public function del_setting($condition){
		$result=array('status'=>0,'message'=>'删除成功','data'=>null);
		if(empty($condition)){
			$result=array('status'=>0,'message'=>'删除成功失败，id或数据为空','data'=>null);
			return $result;
		}
		if($tmp=$this->where($condition)->delete()){ // 删除所有状态为0的用户数据
			$result=array('status'=>1,'message'=>'删除成功','data'=>$tmp);
		}else{
			$result=array('status'=>0,'message'=>'删除失败','data'=>$tmp);
		}
		return $result;
		
	}
	
	
	
	
}