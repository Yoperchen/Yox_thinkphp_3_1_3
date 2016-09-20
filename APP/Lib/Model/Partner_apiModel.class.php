<?php
/**
 * 第三方合作伙伴
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class Partner_apiModel extends Model {
	

	/**
	 * 添加第三方
	 * @param array $data
	 */
	public function add_partner($data){
		$data=array_filter($data,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致把数据修改为空
		$result=array('status'=>0,'message'=>'data不能为空');
		if(empty($data['password'])){
			return array('status'=>0,'message'=>'密码能为空','data'=>$data);
		}else{
			$data['password'] = $this->password_encryption($data['password']);
		}
		$data['auth']=$this->create_auth(10,$is_number=0);
		if(!empty($data)){
			$img_err='';
			if (!empty($_FILES)){//如果有图片上传
				import('ORG.Net.UploadFile');
				$upload = new UploadFile();// 实例化上传类
// 				$upload->saveRule='';//上传文件的保存规则，必须是一个无需任何参数的函数名，例如可以是 time、 uniqid com_create_guid 等，但必须能保证生成的文件名是唯一的，默认是uniqid
				$upload->maxSize  = 3145728 ;// 设置附件上传大小
// 				$upload->uploadReplace=0;//存在同名文件是否是覆盖
				$upload->thumb = true;//是否生成缩略图
				$upload->thumbMaxWidth = '50,200,1000';//缩略图的最大宽度，多个使用逗号分隔
				$upload->thumbMaxHeight = '50,200,750';//缩略图的最大高度，多个使用逗号分隔
				$upload->thumbRemoveOrigin = 1;//生成缩略图后是否删除原图
				$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 允许上传的文件后缀（留空为不限制），使用数组设置，默认为空数组
				$upload->allowTypes  = array('image/png', 'image/jpeg', 'image/gif');//允许上传的文件类型（留空为不限制），使用数组设置，默认为空数组
				$upload->subType = 'date';//子目录创建方式，默认为hash，可以设置为hash或者date
				$upload->dateFormat = 'Y-m-d';
				$upload->savePath =  './Public/Uploads/Partner/';// 文件保存路径，如果留空会取UPLOAD_PATH常量定义的路径
				if(!$upload->upload()) {// 上传错误提示错误信息
// 					return $upload->getErrorMsg();
					$img_err=','.$upload->getErrorMsg();
				}else{// 上传成功 获取上传文件信息
					$info =  $upload->getUploadFileInfo();
				}
				
				$img1_src=$info[0]['savename']?$upload->savePath.$info[0]['savename']:'';
				$img2_src=$info[1]['savename']?$upload->savePath.$info[1]['savename']:'';
				$img3_src=$info[2]['savename']?$upload->savePath.$info[2]['savename']:'';
				$data['img_50_50']=$img1_src;
				$data['img_200_200']=$img2_src;
				$data['img_1000_750']=$img3_src;
				}
			}
			$id=$this->data($data)->add();
			
			$result=array('status'=>1,'message'=>'成功'.$img_err,
					'data'=>array(
							'id'=>$id,
							'username'=>$data['username'],
							'titlename'=>$data['titlename'],
							'user_id'=>$data['user_id'],
							'auth'=>$data['auth'],
							'start'=>$data['start'],
							'type'=>$data['type'],
							'remark'=>$data['remark'],
							'img_50_50'=>$data['img_50_50'],
							'img_200_200'=>$data['img_200_200'],
							'img_1000_750'=>$data['img_1000_750'],
					));
			return $result;

	}
	/**
	 * 
	 * @param number $id
	 * @param number $isdetail
	 * @return array
	 */
	public function getPartnerById($id=0){
		if(empty($id)){ 
			$data=array('status'=>0,'message'=>'id不能为空');
			return $data;
		}
			$partner_info = $this->where(array('id'=>$id))->find();
			$data=array('status'=>1,'message'=>'成功','data'=>$partner_info);
			return $data;
	}
	/**
	 * 
	 * @param string $username
	 */
	public function getPartnerByUserName($username){
	    $result = array('status'=>0);
	    if(empty($username)){
	        $result['message']='username不能为空';
	        return $result;
	    }
	    $partner_info = $this->where(array('username'=>$username))->find();
	    $result=array('status'=>1,'message'=>'成功','data'=>$partner_info);
	    return $result;
	}
	/**
	 * 文章列表
	 * @param array $condition
	 * @param number $page_size
	 * @return array
	 */
	public function get_partner_list($condition,$page_size=20,$field='*'){
		$condition=array_filter($condition,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致把数据修改为空
		$result=array('status'=>0,'message'=>'错误','data'=>null);
		import('ORG.Util.Page');// 导入分页类
		$count      = $this->where($condition)->count();// 查询满足要求的总记录数
		$Page       = new Page($count,$page_size);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $this->field($field)->where($condition)->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
		if(!empty($list)){
			$result=array(
					'status'=>1,
					'message'=>'成功',
					'data'=>array(
						'page'=>array(
								'count'=>$count,//文章总数
								'page_size'=>$page_size,
								'page'=>$Page->firstRow+1,
							),
						'list'=>$list,
				),
				'condition'=>$condition,
			);
		}else{
			$result=array(
					'status'=>0,
					'message'=>'数据为空',
					'data'=>array(
							'page'=>array(),
							'list'=>$list
					),
					'condition'=>$condition,
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
	public function update_partnerById($id,$data){
		$condition=array_filter($condition);//去掉数组空值，不然条件上会加上 xx='' 导致把数据修改为空
		$result=array('status'=>0,'message'=>'修改错误','data'=>null);
		if(empty($id)||empty($data)){
			$result=array('status'=>0,'message'=>'修改失败，id或数据为空','data'=>null);
			return $result;
		}
		
		if(!empty($data['password'])){
			$data['password']=$this->password_encryption($data['password']);
		}
		if (!empty($_FILES)){//如果有图片上传
				import('ORG.Net.UploadFile');
				$upload = new UploadFile();// 实例化上传类
// 				$upload->saveRule='';//上传文件的保存规则，必须是一个无需任何参数的函数名，例如可以是 time、 uniqid com_create_guid 等，但必须能保证生成的文件名是唯一的，默认是uniqid
				$upload->maxSize  = 3145728 ;// 设置附件上传大小
// 				$upload->uploadReplace=0;//存在同名文件是否是覆盖
				$upload->thumb = true;//是否生成缩略图
				$upload->thumbMaxWidth = '50,200,1000';//缩略图的最大宽度，多个使用逗号分隔
				$upload->thumbMaxHeight = '50,200,750';//缩略图的最大高度，多个使用逗号分隔
				$upload->thumbRemoveOrigin = 1;//生成缩略图后是否删除原图
				$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 允许上传的文件后缀（留空为不限制），使用数组设置，默认为空数组
				$upload->allowTypes  = array('image/png', 'image/jpeg', 'image/gif');//允许上传的文件类型（留空为不限制），使用数组设置，默认为空数组
				$upload->subType = 'date';//子目录创建方式，默认为hash，可以设置为hash或者date
				$upload->dateFormat = 'Y-m-d';
				$upload->savePath =  './Public/Uploads/Partner/';// 文件保存路径，如果留空会取UPLOAD_PATH常量定义的路径
				if(!$upload->upload()) {// 上传错误提示错误信息
// 					return $upload->getErrorMsg();
					$img_err=','.$upload->getErrorMsg();
				}else{// 上传成功 获取上传文件信息
					$info =  $upload->getUploadFileInfo();
				}
				
				$img1_src=$info[0]['savename']?$upload->savePath.$info[0]['savename']:'';
				$img2_src=$info[1]['savename']?$upload->savePath.$info[1]['savename']:'';
				$img3_src=$info[2]['savename']?$upload->savePath.$info[2]['savename']:'';
				$data['img_50_50']=$img1_src;
				$data['img_200_200']=$img2_src;
				$data['img_1000_750']=$img3_src;
			}
		if($this->where(array('id'=>$id))->save($data)){ // 根据条件保存修改的数据
			M('Article_detail')->where(array('article_id'=>$id))->save($detail_data);
			$result=array(
					'status'=>1,
					'message'=>'修改成功',
					'data'=>array(
							'id'=>$id,
							'title'=>$data['title'],
							'content'=>$data['content'],
							'desc'=>$data['desc'],
							'type'=>$data['type'],
							'img_50_50'=>$data['img_50_50'],
							'img_200_200'=>$data['img_200_200'],
							'img_1000_750'=>$data['img_1000_750'],
					));
		}else{
			$result=array(
					'status'=>0,
					'message'=>'修改失败',
					'data'=>array());
		}
		
		return $result;
		
	}
	/**
	 * 删除合作商家
	 * @param unknown $id
	 * @return multitype:number string NULL |Ambigous <multitype:number string NULL , multitype:number string >
	 */
	public function del_partner($id){
		$result=array('status'=>0,'message'=>'删除成功','data'=>null);
		if(empty($id)){
			$result=array('status'=>0,'message'=>'删除成功失败，id或数据为空','data'=>null);
			return $result;
		}
		if($result['data']=$this->where(array('id'=>$id))->delete()){ // 删除所有状态为0的用户数据
			$result=array('status'=>1,'message'=>'删除成功',);
		}
		return $result;
	}
	
	/**
	 * 检查合作伙伴合法性
	 * @param int $username 用户名
	 * @param string $auth 验证码
	 * @param string $password 密码
	 * @param int $required_password 是否需要密码 验证|1：需要，0：不需要
	 * @return string
	 */
	public function check_partner($username,$auth,$password,$required_password=0){
		if($required_password && empty($password)){
			$data['status'] =0;
			$data['message'] = '第三方合作密码为空';
			$data['data']=array(
				'username'=>$username,
				'auth'=>$auth,
				'password'=>$password,
				);
			return $data;
		}
		
		if(empty($username)){
			$data['status'] =0;
			$data['message'] = '第三方合作帐号为空';
			$data['data']=array(
				'username'=>$username,
				'auth'=>$auth,
				'password'=>$password,
				);
			return $data;
		}
		
		$user_info =$this->where(array('username'=>$username))->find();//id登录
		
		if(!empty($user_info)){//如果账户存在，再验证密码
			$condition=array();
			$condition['auth']=$auth;
			$condition['username']=$username;
			$partner_info = $this->where($condition)->find();
			if(!empty($partner_info)){//如果密码也正确//==============================
				$login_code=$this->set_login_code($partner_info['id']);
		
				session('account_type','api_partner');//帐号类型: user->用户,admin->管理员,api_partner->第三方合作伙伴
				session('id',$partner_info['id']);  //设置session
				session('username',$partner_info['username']);  //设置session
				session('auth',$partner_info['auth']);  //设置session
				session('login_code',$login_code);  //登录码，登录成功了会有,每个月都不一样,app有用
				session('start',$partner_info['start']);  //设置session，合作伙伴等级
				session('lat',$partner_info['lat']);  //设置session, 纬度
		
				$data['account_type'] = 'api_partner';
				$data['id'] = $partner_info['id'];
				$data['username'] = $partner_info['username'];
				$data['auth'] = $partner_info['auth'];
				$data['login_code'] = $login_code;
				$data['start'] = $partner_info['start'];
				$data['status'] = 1;
				$data['msg'] = '登录成功';
				return $data;
		
			}else{
				$data['status'] = 0;
				$data['msg'] = '第三方合作auth错误';
				return $data;
			}
		}else{
		
			$data['status'] = 0;
			$data['msg'] = '第三方合作帐号错误';
			return $data;
		}
	}
	
	public function reset_password($old_password='',$new_password='',$username='',$isForced=0){
		if(empty($username)||empty($new_password)){
			return array('status'=>1,'message'=>'第三方合作用户名或密码为空');
		}
		$new_password=$this->password_encryption($new_password);//新密码
		$old_password=$this->password_encryption($old_password);//旧密码
		
		if($isForced==1){//强制更新
			if(!empty($username)){
				$user_info= $this->where('username="'.$username.'"')->field('id')->find();//Array ( [id] => 1 )
				$condition=array('username'=>$username);
			}
		}
		
		if($isForced==0){//账号密码更新(非强制更新)
			if(!empty($username)&&!empty($old_password)&&!empty($new_password)){
				$user_info= $this->where('username="'.$username.'" and password="'.$old_password.'"')->field('id')->find();//Array ( [id] => 1 )
				$condition=array('username'=>$username);
			}
		}
		
		if(!empty($user_info)){
			$data=array('password'=>$new_password);
			if($this->where($condition)->save($data)){
				$data=array('status'=>1,'message'=>'修改成功');
				return $data;
			}else{
				$data=array('status'=>0,'message'=>'修改密码不成功');
				return $data;
			}
				
		}else{
			$data=array('status'=>-1,'message'=>'第三方合作用户不存在');
			return $data;
		}
		
		
		
	}
	/**
	 *密码加密
	 */
	public function password_encryption($passowrd){
		return(md5($passowrd.'linglingtang.com'));
	}
	
	//设置登陆嘛
	public function  set_login_code($id){
		return md5($id.date('Y-m',time()));
	}
	/**
	 * 创建auth
	 * @param unknown_type $n
	 * @param unknown_type $is_number
	 */
	public function create_auth($n=10,$is_number=0){
		if($is_number){
			$str = "123456789";//输出字符集
		}
		else{
			$str = "123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";//输出字符集
		}
		$len = strlen($str)-1;
		for($i=0 ; $i<$n; $i++){
			$s .= $str[rand(0,$len)];
		}
		return $s;
	}
	/**
	 * 验证签名是否正确
	 * @param unknown $parameters|要签名的字符串或数组
	 * @param string $sign|签名
	 * @return array
	 */
	public function check_sign($parameters,$sign)
	{
	    $result = array('status'=>0);
	    if(is_array($parameters)){
	        ksort($parameters);
	        $sign_parameters_array=array();
	        foreach($parameters as $key=>$value)
	        {
	            if($key=='_URL_'||$key=='submit'||$key=='api_sign')
	            {
// 	                echo $key;die();
                    continue;
	            }
	            $sign_parameters_array[$key]=$value;
	        }
	        $sign_parameters_string = http_build_query($sign_parameters_array);
	    }
	    else{
	        $sign_parameters_string=$parameters;
	    }
	    $my_sign=substr(md5($sign_parameters_string),0,8);
	    if($my_sign!=$sign)
	    {
	        $result['message']='验签错误.';
	        $result['data']['sign']=$my_sign;
	        $result['data']['error_sign']=$sign;
	        $result['data']['parameters']=$parameters;
	        $result['data']['sign_parameters_array']=$sign_parameters_array;
	        $result['data']['sign_parameters_string']=$sign_parameters_string;
	        return $result;
// 	        $this->ajaxReturn($result,$result['message'],$result['status']);
	    }
	    $result['status']=1;
	    $result['message']='验证成功';
	    return $result;
	}
}