<?php
/**
 * 评论
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 */
class CommentModel extends Model {
	// 定义自动验证
	protected $_validate    =   array(
			array('title','require','标题忘了输入了吧~&nbsp└(^o^)┘'),
			array('content','require','评论内容忘了输入了吧~&nbsp└(^o^)┘'),

	);
	// 定义自动完成
	//protected $_auto    =   array(
			//array('create_time','time',1,'function'),
	//);
	/**
	 * 添加评论
	 * @param array $data
	 */
	public function add_comment($data){
		$data=array_filter($data,"Yocms_del_empty");;//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$result=array('status'=>0,'message'=>'data不能为空');
		if(!empty($data)){
				if (!empty($_FILES)){//如果有图片上传
				import('ORG.Net.UploadFile');
				$upload = new UploadFile();// 实例化上传类
// 				$upload->saveRule='';//上传文件的保存规则，必须是一个无需任何参数的函数名，例如可以是 time、 uniqid com_create_guid 等，但必须能保证生成的文件名是唯一的，默认是uniqid
				$upload->maxSize  = 3145728 ;// 设置附件上传大小
// 				$upload->uploadReplace=0;//存在同名文件是否是覆盖
				$upload->thumb = true;//是否生成缩略图
				$upload->thumbMaxWidth = '1500,1500,1500';//缩略图的最大宽度，多个使用逗号分隔
				$upload->thumbMaxHeight = '1500,1500,1500';//缩略图的最大高度，多个使用逗号分隔
				$upload->thumbRemoveOrigin = 1;//生成缩略图后是否删除原图
				$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 允许上传的文件后缀（留空为不限制），使用数组设置，默认为空数组
				$upload->allowTypes  = array('image/png', 'image/jpeg', 'image/gif');//允许上传的文件类型（留空为不限制），使用数组设置，默认为空数组
				$upload->subType = 'date';//子目录创建方式，默认为hash，可以设置为hash或者date
				$upload->dateFormat = 'Y-m-d';
				$upload->savePath =  './Public/Uploads/Comment/';// 文件保存路径，如果留空会取UPLOAD_PATH常量定义的路径
				if(!$upload->upload()) {// 上传错误提示错误信息
// 					return $upload->getErrorMsg();
					$img_err=','.$upload->getErrorMsg();
				}else{// 上传成功 获取上传文件信息
					$info =  $upload->getUploadFileInfo();
				}
				
				$img1_src=$info[0]['savename']?$upload->savePath.$info[0]['savename']:'';
				$img2_src=$info[1]['savename']?$upload->savePath.$info[1]['savename']:'';
				$img3_src=$info[2]['savename']?$upload->savePath.$info[2]['savename']:'';
				$data['img1']=$img1_src;
				$data['img2']=$img2_src;
				$data['img3']=$img3_src;
			}
			$data['add_time']=time();
			 if($comment_id=$this->data($data)->add())
			 {
				$result=array('status'=>1,'message'=>'成功','data'=>$comment_id);
			 }else
			 {
			 	$result=array('status'=>0,'message'=>'添加评论失败','data'=>$comment_id);
			 }
			return $result;
		}

	}
	/**
	 * 
	 * @param number $id
	 * @param number $isdetail 是否详细，详细就获取用户信息
	 * @return array
	 */
	public function get_comment_by_id($id=0,$isdetail=0){
		if(empty($id))
		{ 
			$data=array('status'=>0,'message'=>'id不能为空');
			return $data;
		}
		$comment_info = $this->where(array('id'=>$id))->find();
		if($isdetail==0)
		{
			$data=array('status'=>1,'message'=>'成功','data'=>$comment_info);
			return $data;
		}
		else
		{
			//所属用户
			if($comment_info['belong_user_id'])
			{
				$user_condition=array();
				$user_condition['id'] = $comment_info['belong_user_id'];
				$user_info_result = D('User')->get_user_info($user_condition,0);//;where(array('id'=>$comment_info['user_id']))->find();
				$comment_info['user'] = $user_info_result['data'];
			}
			//所属商家
			if($comment_info['belong_store_id'])
			{
				$store_condition=array();
				$store_condition['id'] = $comment_info['belong_user_id'];
				$store_info_result = D('Stores')->getStoreById($store_condition['id'],0);
				$comment_info['store'] = $store_info_result['data'];
			}
			$data=array('status'=>1,'message'=>'成功','data'=>$comment_info);
			return $data;
		}
		
	} 
	/**
	 * 获取评论,评论只有两级
	 * @param array $condition
	 * @param int $page_size
	 */
	public function get_comment_list($condition,$page_size=15)
	{
		$condition=array_filter($condition);//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$result=array('status'=>0,'message'=>'错误','data'=>null);
		import('ORG.Util.Page');// 导入分页类
		$count      = $this->where($condition)->count();// 查询满足要求的总记录数
		$Page       = new Page($count,$page_size);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		//必须pid排序
		$list_tmp = $this->where($condition)->order('pid,id')->limit($Page->firstRow.','.$Page->listRows)->select();
		
		//取出用户或者商家信息
		$top_list=array();
		foreach($list_tmp as $comment)
		{
			$user_ids_arr[]=$comment['belong_user_id'];
			$store_ids_arr[]=$comment['belong_store_id'];
			//顶级评论
			if(empty($comment['pid']))
			{
				$top_list[] = $comment;
			}
		}
// 		print_r($user_ids_arr);
// 		$user_ids_str = implode(',', $user_ids_arr);//转成字符串
// 		$store_ids_str = implode(',', $store_ids_arr);//转成字符串
		$user_condition = array();$user_condition['id']=array('in',$user_ids_arr);
		$store_condition = array();$store_condition['id']=array('in',$store_ids_arr);
		$user_list_result = D('User')->get_user_list($user_condition,$page_size=20);
// 		print_r($user_list_result);
		$store_list_result = D('Stores')->get_store_list($store_condition,$page_size=20);
		$list = array();
		
		foreach($top_list as $top_comment)
		{
			foreach($list_tmp as $comment)
			{
				foreach($user_list_result['data']['list'] as $user)
				{
					if($comment['belong_user_id']==$user['id'])$comment['user'] = $user;
					if($top_comment['belong_user_id']==$user['id'])$top_comment['user'] = $user;
				}
				foreach($store_list_result['data']['list'] as $store)
				{
					if($comment['belong_store_id']==$store['id'])$comment['store'] = $store;
					if($top_comment['belong_store_id']==$store['id'])$top_comment['store'] = $store;
				}
				if($comment['pid']==$top_comment['id'])
				{
					$top_comment['children'][] = $comment;
				}
				else
				{
					//评论找不到 pid,出错了
					//写日志
					Log::write('此评论找不到 pid:'.var_export($comment,true).' top_comment:'.var_export($top_comment,true),'ERR');
			
				}
			}
			$list[] = $top_comment;
		}
		unset($list_tmp);
// 		print_r($list);
		if(!empty($list))
		{
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
		}
		else 
		{
			$result=array(
					'status'=>1,
					'message'=>'没有数据',
					'data'=>array(
						'page'=>array(
							'count'=>$count,//文章总数
							'page_size'=>$page_size,
							'page'=>$Page->firstRow+1,
						),
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
	public function update_commentById($id,$data){
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
	
	public function del_comment($condition){
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
	
	
	
	
}