<?php
/**
 * 约会、预约模型
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
*/
class AppointmentModel extends Model {
	/**
	 * 添加约会
	 * @param array $data
	 */
	public function add_appointment($data){
		$data=array_filter($data);//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$data['add_time']=time();
		$result=array('status'=>0,'message'=>'data不能为空');
		if(!empty($data['user_id'])&&!is_numeric($data['user_id'])){
			$result=array('status'=>0,'message'=>'user_id 错误','data'=>$data);
		}
		$img_err='';
		if (!empty($_FILES)){//如果有图片上传
			import('ORG.Net.UploadFile');
			$upload = new UploadFile();// 实例化上传类
			// 				$upload->saveRule='';//上传文件的保存规则，必须是一个无需任何参数的函数名，例如可以是 time、 uniqid com_create_guid 等，但必须能保证生成的文件名是唯一的，默认是uniqid
			$upload->maxSize  = 3145728 ;// 设置附件上传大小
			// 				$upload->uploadReplace=0;//存在同名文件是否是覆盖
			$upload->thumb = false;//是否生成缩略图
			$upload->thumbMaxWidth = '50,200,1500,1500,1500,1500';//缩略图的最大宽度，多个使用逗号分隔
			$upload->thumbMaxHeight = '50,200,1500,1500,1500,1500';//缩略图的最大高度，多个使用逗号分隔
			$upload->thumbRemoveOrigin = 0;//生成缩略图后是否删除原图
			$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 允许上传的文件后缀（留空为不限制），使用数组设置，默认为空数组
			$upload->allowTypes  = array('image/png', 'image/jpeg', 'image/gif');//允许上传的文件类型（留空为不限制），使用数组设置，默认为空数组
			$upload->subType = 'date';//子目录创建方式，默认为hash，可以设置为hash或者date
			$upload->dateFormat = 'Y-m-d';
			$upload->savePath =  './Public/Uploads/Article/';// 文件保存路径，如果留空会取UPLOAD_PATH常量定义的路径
			if(!$upload->upload()) {// 上传错误提示错误信息
				// 					return $upload->getErrorMsg();
				$img_err=','.$upload->getErrorMsg();
			}else{// 上传成功 获取上传文件信息
				$info =  $upload->getUploadFileInfo();
			}
		
			$img1_src=$info[0]['savename']?$upload->savePath.$info[0]['savename']:'';
			$img2_src=$info[1]['savename']?$upload->savePath.$info[1]['savename']:'';
			$img3_src=$info[2]['savename']?$upload->savePath.$info[2]['savename']:'';
			$img4_src=$info[3]['savename']?$upload->savePath.$info[3]['savename']:'';
			$img5_src=$info[4]['savename']?$upload->savePath.$info[4]['savename']:'';
			$img6_src=$info[5]['savename']?$upload->savePath.$info[5]['savename']:'';
			$data['img1']=substr($img1_src,1);//截取字符串，去掉“.”，./Public/Uploads/5423dbf8e67d1.jpg
			$data['img2']=substr($img2_src,1);
			$data['img3']=substr($img3_src,1);
			$data['img4']=substr($img4_src,1);
			$data['img5']=substr($img5_src,1);
		}
		if(!empty($data)){
			$data['id']=$this->data($data)->add();
			$result=array('status'=>1,'message'=>'成功'.$img_err,
					'data'=>$data
			);
			return $result;
		}

	}
	/**
	 * 获取约会
	 * @param number $id
	 * @param number $isdetail
	 * @return array
	 */
	public function getAppointmentById($id=0,$isdetail=0)
	{
	    $result=array('status'=>0,'message'=>'');
		if(empty($id))
		{ 
			$result=array('status'=>0,'message'=>'id不能为空');
			return $result;
		}
		if($isdetail==0)
		{
		    $s_key='appointment_getAppointmentById_'.$id;
		    $appointment_info = S($s_key);
		    if(empty($appointment_info))
		    {
		        $appointment_info = $this->where(array('id'=>$id))->find();
		    }
		    S($s_key,$appointment_info,array('expire'=>'300'));
		    $result['status']=0;
		    $result['message']='成功';
		    $result['data']=$appointment_info;
		}
		return $result;
	} 
	/**
	 * 约会列表
	 * @param array $condition
	 * @param number $page_size
	 * @return array
	 */
	public function get_appointment_list($condition,$page_size=20){
		$condition=array_filter($condition);//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
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
		
		$user_id_arr=array();
		foreach($list_tmp as $appointment)
		{
			$user_id_arr=array_merge($user_id_arr,explode(',',$appointment['belong_user_id']),explode(',', $appointment['apply_user_ids']));
		}
		$user_condition['id']=array('in',$user_id_arr);
		$get_user_list_result = D('User')->get_user_list($user_condition,$page_size=20,$field="id,site_id,nick_name,name,sex,birthday,lng,lat,geohash,avatar,up,down,like,view,level,community_id,city_id,district_id,is_mobile_verify,is_email_verify,status,login_count,reg_time,last_login_time");
		
		foreach($list_tmp as $appointment)
		{
			foreach($get_user_list_result['data']['list'] as $user)
			{
				if($appointment['belong_user_id']==$user['id'])
				{
					$appointment['belong_user_info']=$user;
				}
				if(in_array($user['id'], explode(',', $appointment['apply_user_ids'])))
				{
					$appointment['apply_user_list'][]=$user;
				}
			}
			$list[]=$appointment;
		}
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
	 * 修改约会
	 * @param int $id
	 * @param array $data
	 */
	public function update_appointmentById($id,$data){
		$data=array_filter($data);//去掉数组空值，不然条件上会加上 xx='' 导致把数据修改为空
		$data['update_time']=time();
		$result=array('status'=>0,'message'=>'修改错误','data'=>null);
		if(empty($id)||empty($data)){
			$result=array('status'=>0,'message'=>'修改失败，id或数据为空','data'=>null);
			return $result;
		}
		if (!empty($_FILES)){//如果有图片上传
				import('ORG.Net.UploadFile');
				$upload = new UploadFile();// 实例化上传类
// 				$upload->saveRule='';//上传文件的保存规则，必须是一个无需任何参数的函数名，例如可以是 time、 uniqid com_create_guid 等，但必须能保证生成的文件名是唯一的，默认是uniqid
				$upload->maxSize  = 3145728 ;// 设置附件上传大小
// 				$upload->uploadReplace=0;//存在同名文件是否是覆盖
				$upload->thumb = false;//是否生成缩略图
				$upload->thumbMaxWidth = '50,200';//缩略图的最大宽度，多个使用逗号分隔
				$upload->thumbMaxHeight = '50,200';//缩略图的最大高度，多个使用逗号分隔
				$upload->thumbRemoveOrigin = 1;//生成缩略图后是否删除原图
				$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 允许上传的文件后缀（留空为不限制），使用数组设置，默认为空数组
				$upload->allowTypes  = array('image/png', 'image/jpeg', 'image/gif');//允许上传的文件类型（留空为不限制），使用数组设置，默认为空数组
				$upload->subType = 'date';//子目录创建方式，默认为hash，可以设置为hash或者date
				$upload->dateFormat = 'Y-m-d';
				$upload->savePath =  './Public/Uploads/';// 文件保存路径，如果留空会取UPLOAD_PATH常量定义的路径
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
	 * 约会(预约)报名
	 * @param int $id
	 * @param int $apply_user_id
	 */
	public function apply_appointment($id,$apply_user_id){
		if(!empty($apply_user_id)&&!is_numeric($apply_user_id)){//user_id格式
			$result=array('status'=>0,'message'=>'user_id 错误','data'=>$apply_user_id);
			return $result;
		}
		if(!empty($id)&&!is_numeric($id)){//约会id格式
			$result=array('status'=>0,'message'=>'约会id 错误','data'=>$id);
			return $result;
		}
		$appointment_info = $this->where(array('id'=>$id))->find();//约会、预约信息
		if(empty($appointment_info)){//约会不存在
			$result=array('status'=>0,'message'=>'出错了，该约会不存在，请重新挑选','data'=>$id);
			return $result;
		}
		if($appointment_info['appointment_time']<time()){//约会时间已过
			$result=array('status'=>0,'message'=>'对不起，该约会时间已经过了','data'=>$id);
			return $result;
		}
		$apply_user_ids_str  = $appointment_info['apply_user_ids'];//报名者字符串user_id|154,565,455
		if(!empty($apply_user_ids_str)){//加一个判断，不然空的会出现','号
			$apply_user_ids_arr  = explode(",",$apply_user_ids_str);//字符串转数组|array(154,565,455)
		}else{
			$apply_user_ids_arr=array();
		}
		if(in_array($apply_user_id,$apply_user_ids_arr)){
			$result=array('status'=>0,'message'=>'您已经报过名了，请勿重复报名','data'=>$apply_user_id);
			return $result;
		}
		$apply_user_ids_arr[]=$apply_user_id;//增加一个报名的
		$apply_user_ids_str  = implode(',',$apply_user_ids_arr);//数组转字符串
		$data['apply_user_ids']=$apply_user_ids_str;
		if($this->update_appointmentById($id,$data)){//更新报名者
			$result=array(
					'status'=>1,
					'message'=>'报名成功',
					'data'=>$data);
		}else{
			$result=array(
					'status'=>0,
					'message'=>'更新失败',
					'data'=>$data);
		}
		return $result;
	}
	/**
	*退出
	*/
	public function exit_appointment($id,$apply_user_id){
	//没必要写，不给退出
	}
	/**
	 * 删除约会
	 * @param int $id
	 */
	public function del_appointment($id){
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
	
	
	
	
}