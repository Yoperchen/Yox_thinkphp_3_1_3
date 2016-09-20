<?php
/**
 * 文章模型
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class ArticleModel extends AdvModel {
	
	const ANNOUNCEMENT        =1;//公告
	const ARTICLE		  =2;//普通文章
	const POSTS		  =3;//帖子
	const DIARY		  =4;//日志
	const SAYSAY	  =5;//说说

	
	// 定义自动验证
	protected $_validate    =   array(
			array('title','require','标题忘了输入了吧~&nbsp└(^o^)┘'),

	);
	// 定义自动完成
	//protected $_auto    =   array(
			//array('create_time','time',1,'function'),
	//);
	/**
	 * 添加文章
	 * @param array $data
	 */
	public function add_article($data){
		$data['add_time']=time();
		$result=array('status'=>0,'message'=>'data不能为空');
		if(!empty($data['user_id'])&&!is_numeric($data['user_id'])){
			$result=array('status'=>0,'message'=>'user_id 错误','data'=>null);
		}
		//浏览量
		if(empty($data['view']))
		{
			$data['view']=rand(0, 15);
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
			$article_id=$this->data($data)->add();
		}
		$result=array('status'=>1,'message'=>'成功'.$file_list_result['message'],
				'data'=>$data);
			return $result;

	}
	/**
	 * 
	 * @param number $id
	 * @param number $isdetail
	 * @return array
	 */
	public function getArticleById($id=0,$isdetail=0){
		if(empty($id)){ 
			$data=array('status'=>0,'message'=>'id不能为空');
			return $data;
		}
// 		$this->where(array('id'=>$id))->setLazyInc('view',1,60);//每60秒统一更新+1
		if($isdetail==0){
			$article_info = $this->where(array('id'=>$id))->find();
			$result=array('status'=>1,'message'=>'成功','data'=>$article_info);
		}else{//详细
			$article_info		 = $this->where(array('id'=>$id))->find();
			$result=array('status'=>1,'message'=>'获取详细信息成功','data'=>$article_info);
		}
		if($result['status']>0)
		{
			//隐私权限检查
			$check_privacy_result = D('Privacy')->check_privacy($article_info['user_id'],session('id'),'article'.$id);
			if($check_privacy_result['status']<1)
			{
				$article_info['content']=$check_privacy_result['message'];
				$result=array('status'=>0,'message'=>$check_privacy_result['message'],'data'=>$article_info);
				return $result;
			}
		}
		
		$update_data = array('view'=>$article_info['view']+1);
		$this->update_articleById($id, $update_data);
		//访问日志
		if(session('?account_type')&&session('?id')&&session('?name'))
		{
			$visit_data=array();
			$visit_data['visit_user_id']=session('id');;//访问者
			$visit_data['interviewees_user_id']=$article_info['user_id'];//被访问者
			$visit_data['interviewees_store_id']=$article_info['store_id'];//被访问者
			$visit_data['visit_content']='文章';//访问内容
			D('Visit_log')->add_visit_log($data);
		}
		return $result;
		
	} 
	/**
	 * 文章列表
	 * @param array $condition
	 * @param number $page_size
	 * @return array
	 */
	public function get_article_list($condition,$page_size=20){
		$condition=array_filter($condition,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$result=array('status'=>0,'message'=>'错误','data'=>null);
		if(!empty($condition['user_id'])&&!is_numeric($condition['user_id'])){
			$result=array('status'=>0,'message'=>'user_id 错误','data'=>null);
		}
		import('ORG.Util.Page');// 导入分页类
		$count      = $this->where($condition)->count();// 查询满足要求的总记录数
		$Page       = new Page($count,$page_size);// 实例化分页类 传入总记录数和每页显示的记录数
// 		$Page->setConfig('theme',' %totalRow% %header% %nowPage%/%totalPage% 页 %downPage%');//自定义分页输出
		$show       = $Page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list_tmp = $this->where($condition)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		//隐私设置
		$Privacy_model = D('Privacy');
		$mark_result = $Privacy_model->mark_content_list_privacy($prefix='article',$list_tmp);
		$list = $mark_result['data']['list'];
// 		print_r($list);
		if(!empty($list)){
			$result=array(
					'status'=>1,
					'message'=>'成功',
					'data'=>array(
						'page'=>array(
								'count'=>$count,//文章总数
								'page_size'=>$page_size,
								'page'=>$_REQUEST['p']?"".$_REQUEST['p']."":"1",
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
	public function update_articleById($id,$data){
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
// 		print_r($file_list_result);
// 		print_r($data);die();
		$data=array_filter($data,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		if($this->where(array('id'=>$id))->save($data)){ // 根据条件保存修改的数据
			$result=array(
					'status'=>1,
					'message'=>'修改成功,'.$file_list_result['message'],
					'data'=>$data);
		}else{
			$result=array(
					'status'=>0,
					'message'=>'修改失败,'.$file_list_result['message'],
					'data'=>$data);
		}
		
		return $result;
		
	}
	
	public function del_article($id)
	{
		$result=array('status'=>0,'message'=>'删除成功','data'=>null);
		if(empty($id))
		{
			$result=array('status'=>0,'message'=>'删除成功失败，id或数据为空','data'=>null);
			return $result;
		}
		if($tmp=$this->where(array('id'=>$id))->delete()){ // 删除所有状态为0的用户数据
			$result=array('status'=>1,'message'=>'删除成功','data'=>$tmp);
		}
		return $result;
		
	}
	
	
	
	
}