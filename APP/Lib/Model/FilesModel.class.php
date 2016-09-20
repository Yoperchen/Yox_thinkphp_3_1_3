<?php
/**
 * 文件表
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class FilesModel extends Model {
	/**
	 * 添加文件
	 * @param array $data
	 */
	public function add_file($data){
		$data=array_filter($data,"Yocms_del_empty");
		$data['add_time']=time();
		$result=array('status'=>0,'message'=>'data不能为空');
		if(0 &&(empty($data['user_id'])&&empty($data['store_id'])&&empty($data['site_id']))){
			$result=array('status'=>0,'message'=>'请指定文件所属者','data'=>$data);
			return $result;
		}
		if(!empty($data['user_id'])&&!intval($data['user_id'])){
			$result=array('status'=>0,'message'=>'user_id 错误','data'=>$data);
		}
		if(!empty($data['store_id'])&&!intval($data['store_id'])){
			$result=array('status'=>0,'message'=>'store_id 错误','data'=>$data);
		}
		if(!empty($data['site_id'])&&!intval($data['site_id'])){
			$result=array('status'=>0,'message'=>'site_id 错误','data'=>$data);
		}
		$img_err='没有文件上传';
		if (!empty($_FILES)){//如果有图片上传
			import('ORG.Net.UploadFile');
			$upload = new UploadFile();// 实例化上传类
			// $upload->saveRule='';//上传文件的保存规则，必须是一个无需任何参数的函数名，例如可以是 time、 uniqid com_create_guid 等，但必须能保证生成的文件名是唯一的，默认是uniqid
			$upload->maxSize  = 3145728 ;// 设置附件上传大小
			// $upload->uploadReplace=0;//存在同名文件是否是覆盖
			$upload->thumb = false;//是否生成缩略图
			$upload->thumbMaxWidth = '50,200,1500,1500,1500,1500';//缩略图的最大宽度，多个使用逗号分隔
			$upload->thumbMaxHeight = '50,200,1500,1500,1500,1500';//缩略图的最大高度，多个使用逗号分隔
			$upload->thumbRemoveOrigin = 0;//生成缩略图后是否删除原图
			$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 允许上传的文件后缀（留空为不限制），使用数组设置，默认为空数组
			$upload->allowTypes  = array('image/png', 'image/jpeg', 'image/gif');//允许上传的文件类型（留空为不限制），使用数组设置，默认为空数组
			$upload->autoSub=true;//是否使用子目录保存上传文件
			if(!empty($data['user_id'])){
				$upload->subType = 'custom';//默认为hash，可以设置为hash、date或者custom
				$upload->subDir = 'user_'.$data['user_id'].'/';//子目录名称 subType为custom方式后有效
			}elseif(!empty($data['store_id'])){
				$upload->subType = 'custom';//默认为hash，可以设置为hash、date或者custom
				$upload->subDir = 'store_'.$data['store_id'].'/';//子目录名称 subType为custom方式后有效
			}elseif(!empty($data['site_id'])){
				$upload->subType = 'custom';//默认为hash，可以设置为hash、date或者custom
				$upload->subDir = 'site'.$data['site_id'].'/';//子目录名称 subType为custom方式后有效
			}else{
				$upload->subType = 'date';//默认为hash，可以设置为hash、date或者custom
				$upload->dateFormat = 'Y-m-d';
			}
			$upload->savePath =  './Public/Uploads/';// 文件保存路径，如果留空会取UPLOAD_PATH常量定义的路径
			if(!$upload->upload()) {// 上传错误提示错误信息
				$img_err=','.$upload->getErrorMsg();
			}else{// 上传成功 获取上传文件信息
				$file_info_list =  $upload->getUploadFileInfo();
			}
			$return_data=array();
			foreach($file_info_list as $key=>$file_info)
			{
				/**
	 			[name] => 8023004_153753654000_2.jpg
	            [type] => image/jpeg
	            [size] => 74676
	            [key] => img2
	            [extension] => jpg
	            [savepath] => ./Public/Uploads/
	            [savename] => 2015-07-15/55a681236d321.jpg
	            [hash] => 1ea933fb8ddf42ee3ae54853f4667d81
				 */
				$data['url']=substr($upload->savePath.$file_info['savename'],1);//截取字符串，去掉“.”，./Public/Uploads/5423dbf8e67d1.jpg
				$data[$file_info['key']]=$data['url'];
				$data['add_time']=NOW_TIME;
				$id=$this->data($data)->add();
				$data['id']=$id;
				$return_data[]=$data;
			}
		}
		if(!empty($file_info_list))
		{
			$result=array('status'=>1,'message'=>'上传插入成功','list'=>$return_data);
		}else{
			$result=array('status'=>0,'message'=>$img_err,'list'=>$return_data);
		}
		return $result;
	}
	/**
	 * 获取文件
	 * @param number $id
	 * @param number $isdetail
	 * @return array
	 */
	public function get_file_by_id($id=0,$isdetail=0){
		if(empty($id)){ 
			$result=array('status'=>0,'message'=>'id不能为空');
			return $result;
		}
		if($isdetail==0){
			$file_info = $this->where(array('id'=>$id))->find();
			$result=array('status'=>1,'message'=>'成功','data'=>$file_info);
			if($result['status']>0)
			{
				//隐私权限检查
				$check_privacy_result = D('Privacy')->check_privacy($file_info['user_id'],session('id'),'file'.$id);
				if($check_privacy_result['status']<1)
				{
					$file_info['url']='';
					$result=array('status'=>0,'message'=>$check_privacy_result['message'],'data'=>$file_info);
					return $result;
				}
			}
			return $result;
		}
	} 
	/**
	 * 文件列表
	 * @param array $condition
	 * @param number $page_size
	 * @return array
	 */
	public function get_file_list($condition,$page_size=20){
		$condition=array_filter($condition,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$result=array('status'=>0,'message'=>'错误','data'=>null);
		if(!empty($condition['user_id'])&&!intval($condition['user_id'])){
			$result=array('status'=>0,'message'=>'user_id 错误','data'=>null);
		}
		if(!empty($condition['store_id'])&&!intval($condition['store_id'])){
			$result=array('status'=>0,'message'=>'store_id 错误','data'=>null);
		}
		if(!empty($condition['site_id'])&&!intval($condition['site_id'])){
			$result=array('status'=>0,'message'=>'site_id 错误','data'=>null);
		}
		import('ORG.Util.Page');// 导入分页类
		$count      = $this->where($condition)->count();// 查询满足要求的总记录数
		$Page       = new Page($count,$page_size);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list_tmp = $this->where($condition)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$user_id_arr=array();
		$store_id_arr=array();
		foreach($list_tmp as $file)
		{
			$user_id_arr =array_merge($user_id_arr ,explode(',',$file['user_id']));
			$store_id_arr=array_merge($store_id_arr,explode(',',$file['store_id']));
		}
		$user_condition['id'] =array('in',$user_id_arr);
		$store_condition['id']=array('in',$store_id_arr);
		$get_user_list_result = D('User')->get_user_list($user_condition,$page_size=20,$field="id,site_id,nick_name,name,sex,birthday,lng,lat,geohash,avatar,up,down,like,view,level,community_id,city_id,district_id,is_mobile_verify,is_email_verify,status,login_count,reg_time,last_login_time");
		$get_store_list_result = D('Stores')->get_store_list($store_condition,$page_size=20,$field="id,site_id,store_name,keywords,logo,lng,lat,city_id,up,down,like,status,add_time");
		
		foreach($list_tmp as $file)
		{
			foreach($get_user_list_result['data']['list'] as $user)
			{
				if($file['user_id']==$user['id'])
				{
					$file['user_info']=$user;
				}
			}
			foreach($get_store_list_result['data']['list'] as $store)
			{
				if($file['store_id']==$store['id'])
				{
					$file['store_info']=$store;
				}
			}
			$list[]=$file;
		}
		//隐私设置
		$Privacy_model = D('Privacy');
		$mark_result = $Privacy_model->mark_content_list_privacy($prefix='file',$list);
		$list = $mark_result['data']['list'];
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
	 * 修改文件
	 * @param int $id
	 * @param array $data
	 */
	public function update_file_by_id($id,$data){
		$data=array_filter($data,"Yocms_del_empty");
		$data['update_time']=NOW_TIME;
		$result=array('status'=>0,'message'=>'修改错误','data'=>null);
		if(empty($id)||empty($data)){
			$result=array('status'=>0,'message'=>'修改失败，id或数据为空','data'=>null);
			return $result;
		}
// 		if (!empty($_FILES)){//如果有图片上传
// 				import('ORG.Net.UploadFile');
// 				$upload = new UploadFile();// 实例化上传类
// // 				$upload->saveRule='';//上传文件的保存规则，必须是一个无需任何参数的函数名，例如可以是 time、 uniqid com_create_guid 等，但必须能保证生成的文件名是唯一的，默认是uniqid
// 				$upload->maxSize  = 3145728 ;// 设置附件上传大小
// // 				$upload->uploadReplace=0;//存在同名文件是否是覆盖
// 				$upload->thumb = false;//是否生成缩略图
// 				$upload->thumbMaxWidth = '50,200';//缩略图的最大宽度，多个使用逗号分隔
// 				$upload->thumbMaxHeight = '50,200';//缩略图的最大高度，多个使用逗号分隔
// 				$upload->thumbRemoveOrigin = 1;//生成缩略图后是否删除原图
// 				$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 允许上传的文件后缀（留空为不限制），使用数组设置，默认为空数组
// 				$upload->allowTypes  = array('image/png', 'image/jpeg', 'image/gif');//允许上传的文件类型（留空为不限制），使用数组设置，默认为空数组
// 				$upload->subType = 'date';//子目录创建方式，默认为hash，可以设置为hash或者date
// 				$upload->dateFormat = 'Y-m-d';
// 				$upload->savePath =  './Public/Uploads/';// 文件保存路径，如果留空会取UPLOAD_PATH常量定义的路径
// 				if(!$upload->upload()) {// 上传错误提示错误信息
// 					$img_err=','.$upload->getErrorMsg();
// 				}else{
// 					$info =  $upload->getUploadFileInfo();
// 				}
				
// 				$img1_src=$info[0]['savename']?$upload->savePath.$info[0]['savename']:'';
// 				$img2_src=$info[1]['savename']?$upload->savePath.$info[1]['savename']:'';
// 				$img3_src=$info[2]['savename']?$upload->savePath.$info[2]['savename']:'';
// 				$data['img1']=$img1_src;
// 				$data['img2']=$img2_src;
// 				$data['img3']=$img3_src;
// 			}
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
	 * 删除文件
	 * @param int $id
	 */
	public function del_file($id){
		$result=array('status'=>0,'message'=>'失败','data'=>null);
		if(empty($id)){
			$result=array('status'=>0,'message'=>'删除失败，id或数据为空','data'=>null);
		}else{
			$file_info_result=$this->get_file_by_id($id);
		}
		if($file_info_result['status']<1){
			$result=array('status'=>1,'message'=>$file_info_result['message'],'data'=>$file_info_result);
		}else{
			$message='';
			$tmp1=unlink(getcwd ().$file_info_result['data']['url']);
// 			$tmp1=unlink('D:\xampp\htdocs\ThinkPHP_3_1_3_YO\linglingtangcom\Public\Uploads\user_2\55a22f9741931.jpg');
			if($tmp1){
				$message.='文件已删除';
				$message.='数据可以条目未删除';
				$tmp2=$this->where(array('id'=>$id))->delete();
				if($tmp2)$message.=',数据库对应条目已删除';
			}else{
				$tmp1='0';
				$message.='文件无法删除';
			}
		}
		if($tmp1&&$tmp2){ // 删除所有状态为0的用户数据
			$result=array('status'=>1,'message'=>'删除成功','data'=>$file_info_result['data']);
		}else{
			$file_info_result['data']['test']= getcwd ().$file_info_result['data']['url'];
			$result=array('status'=>0,'message'=>$message,'data'=>$file_info_result['data']);
		}
		return $result;
		
	}
	
	
	
	
}