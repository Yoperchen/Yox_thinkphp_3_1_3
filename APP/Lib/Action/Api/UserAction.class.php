<?php
/*
 * 用户管理
 */
class UserAction extends ApibaseAction {
		/*
		 * 用户登录
		 * http://192.168.1.1/ThinkPHP_3_1_3_YO/index.php?g=api&m=User&a=login&id=1&password=123456
		 */
	public function login(){
		$id=$this->_param('id','htmlspecialchars,strip_tags');
		$password=$this->_param('password','htmlspecialchars,strip_tags');

// 		if(!empty($id)&&!empty($password)){
			$User=D('User');
			$result= $User->user_login($id , $password);
			header("Content-type: text/html; charset=utf-8");
			exit(json_encode($result));//json格式数据
// 		}
	}
	/**
	 * http://192.168.1.1/ThinkPHP_3_1_3_YO/index.php?g=api&m=User&a=send_verify_to_mobile&mobile=18028571566
	 * 手机注册前发送短信验证码
	 */
	public function send_verify_to_mobile(){
		$mobile=$this->_param('mobile','htmlspecialchars,strip_tags');
		$verify_type=$this->_param('verify_type','htmlspecialchars,strip_tags');//注册verify_register_code|忘记密码verify_forgot_password_code
		if(!empty($mobile)&&!empty($verify_type)){//如果是手机注册，就发送验证码------//1是测试用
			$result = D('Verify')->send_mobile_verify($mobile,$verify_type);
			header("Content-type: text/html; charset=utf-8");
			exit(json_encode($result));
			// exit(json_encode($data,JSON_UNESCAPED_UNICODE));//json格式数据
			}
			
	}
	/**
	 * 发送邮箱验证码
	 */
	public function send_verify_to_email(){
		$email=$this->_param('email','htmlspecialchars,strip_tags');
		$verify_type=$this->_param('verify_type','htmlspecialchars,strip_tags');//注册verify_register_code|忘记密码verify_forgot_password_code
		if(!empty($email)&&!empty($verify_type)){//如果是手机注册，就发送验证码------//1是测试用
			$result = D('Verify')->send_email_verify($email,$verify_type);
			header("Content-type: text/html; charset=utf-8");
			exit(json_encode($result));
			// exit(json_encode($data,JSON_UNESCAPED_UNICODE));//json格式数据
		}
			
		
	}
	/**
	 * 用户注册
	 * http://192.168.1.1/ThinkPHP_3_1_3_YO/index.php?g=api&m=User&a=register&mobile_phone=18028571566&password=123456
	 */
	public function register(){
// 		$data['name']=$this->_param('name','htmlspecialchars,strip_tags');
		$data['email']=I('param.email','', 'htmlspecialchars');
 		$data['community_id']=I('param.community_id','', 'htmlspecialchars');//社区id
		$data['sex']=I('param.sex','', 'htmlspecialchars');//性别
		$data['mobile']=I('param.mobile','', 'htmlspecialchars');
		$data['password']=I('param.password','', 'htmlspecialchars');
		$User=D('User');
		$data=$User->register($data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($data));
// 		exit(json_encode($data,JSON_UNESCAPED_UNICODE));//json格式数据
	}
	/**
	*获取指定用户信息
	*/
	public function get_user_info(){
// 		$user_id=$this->_param('user_id','htmlspecialchars,strip_tags');
		$condition['id']= I('param.user_id','', 'htmlspecialchars');
		$condition['mobile']=I('param.mobile','', 'htmlspecialchars');
		$condition['email']=I('param.email','', 'htmlspecialchars');
		$isdetail=I('param.user_id',0, 'htmlspecialchars');
		$User=D('User');
		$data=$User->get_user_info($condition,$isdetail);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($data));
	}
	/**
	 * 获取用户列表
	 */
	public function get_user_list(){
		$condition['api_partner_id']= I('param.api_partner_id','', 'htmlspecialchars');//所属第三方
		$condition['site_id']= I('param.site_id','', 'htmlspecialchars');//站点id
		$condition['birthday']=I('param.birthday','', 'htmlspecialchars');//生日
		$condition['lng']=I('param.lng','', 'htmlspecialchars');//经度
		$condition['lat']=I('param.lat','', 'htmlspecialchars');//纬度
// 		$condition['geohash']=array('like',array(I('param.geohash','', 'htmlspecialchars').'%',I('param.geohash','', 'htmlspecialchars').'%'),'OR');//经纬度转字符串
		$condition['sex']=I('param.email','', 'htmlspecialchars');//性别|1男、2女
		$condition['community_id']=I('param.community_id','', 'htmlspecialchars');//社区id|学校，医院，小区
		$condition['city_id']=I('param.city_id','', 'htmlspecialchars');//城市
		$condition['district_id']=I('param.district_id','', 'htmlspecialchars');//区
		$condition['is_mobile_verify']=I('param.is_mobile_verify','', 'htmlspecialchars');//是否手机验证过
		$condition['is_email_verify']=I('param.is_email_verify','', 'htmlspecialchars');//是否邮箱验证过
		$condition['status']=I('param.status','1', 'htmlspecialchars');//状态|1正常,2禁止,3黑名单,4删除
		$condition['up_user_id']=I('param.up_user_id','', 'htmlspecialchars');//上级用户，通过谁的推广过来的用户
	}
	/**
	 * 密码重置
	 *http://192.168.1.1/ThinkPHP_3_1_3_YO/index.php?g=api&m=User&a=reset_password&mobile=18028571566&new_password=123456
	 */
	public function reset_password(){
		$email		=$this->_param('email','htmlspecialchars,strip_tags');
		$mobile		=$this->_param('mobile','htmlspecialchars,strip_tags');
		$userid		=$this->_param('userid','htmlspecialchars,strip_tags');
		$old_password=$this->_param('old_password','htmlspecialchars,strip_tags');
		$new_password=$this->_param('new_password','htmlspecialchars,strip_tags');
		$isForced	=$this->_param('isForced','htmlspecialchars,strip_tags',0);
		
		if(!empty($new_password)&&(!empty($email)||!empty($mobile)||!empty($userid))){
			$result=D('User')->reset_password($old_password,$new_password,$userid,$mobile,$email,$isForced);
		}
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
		//exit(json_encode($data,JSON_UNESCAPED_UNICODE));//json格式数据
		
	}
	/**
	 * 手机是否注册过
	 * http://192.168.1.1/ThinkPHP_3_1_3_YO/index.php?g=api&m=User&a=check_mobile_exist&mobile=18028571888
	 */
	public function check_mobile_exist(){
		$User=D('User');
		$data['mobile']=$this->_param('mobile','htmlspecialchars,strip_tags');
// 		print_r($data);
		$result=$User->check_mobile_exist($data['mobile']);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
		//exit(json_encode($result,JSON_UNESCAPED_UNICODE));//json格式数据
		
	}
	/**
	 * email是否注册过
	 */
	public function check_email_exist(){
		$User=D('User');
		$data['email']=$this->_param('email','htmlspecialchars,strip_tags');
		//print_r($data);
		$data=$User->check_email_exist($data['email']);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($data));//json格式数据
	}
	/**
	 * 验证验证码
	 */
	public function verify_code(){
		$verify_type=$this->_param('verify_type','htmlspecialchars,strip_tags');//verify_register_code|verify_forgot_password_code
		$code=$this->_param('Verify_code','htmlspecialchars,strip_tags');
		$mobile=$this->_param('mobile','htmlspecialchars,strip_tags');
		$email=$this->_param('email','htmlspecialchars,strip_tags');
		$userid=$this->_param('userid','htmlspecialchars,strip_tags');
		if(empty($code)&&(empty($mobile)||empty($userid)||empty($email))){
			$data=array('status'=>0,'message'=>'参数错误');
			header("Content-type: text/html; charset=utf-8");
			exit(json_encode($data));
// 			exit(json_encode($data,JSON_UNESCAPED_UNICODE));//json格式数据
		}
		$Verify=D('Verify');
		if($Verify->verify($verify_type,$code,$mobile,$userid,$email)){
			$data=array('status'=>1,'message'=>'验证通过');
			header("Content-type: text/html; charset=utf-8");
			exit(json_encode($data));
// 			exit(json_encode($data,JSON_UNESCAPED_UNICODE));//json格式数据
		}else{
			$data=array('status'=>0,'message'=>'验证不通过');
			header("Content-type: text/html; charset=utf-8");
			exit(json_encode($data));
// 			exit(json_encode($data,JSON_UNESCAPED_UNICODE));//json格式数据
		}
	}
	/**
	 * 会员信息修改
	 */
	public function update_user_info_by_user_id(){
		$user_id=$this->_param('user_id','htmlspecialchars,strip_tags');
		$data['email']=$this->_param('email','htmlspecialchars,strip_tags');
		$data['name']=$this->_param('name','htmlspecialchars,strip_tags');
		$data['nick_name']=$this->_param('nick_name','htmlspecialchars,strip_tags');
		$data['sex']=$this->_param('sex','htmlspecialchars,strip_tags');
		$data['birthday']=$this->_param('birthday','htmlspecialchars,strip_tags');
		$data['mobile']=$this->_param('mobile','htmlspecialchars,strip_tags');
		$data['lng']=$this->_param('lng','htmlspecialchars,strip_tags');//经度
		$data['lat']=$this->_param('lat','htmlspecialchars,strip_tags');//纬度
		$data['district_id']=$this->_param('district_id','htmlspecialchars,strip_tags');//地区id
		$data['community_id']=$this->_param('community_id','htmlspecialchars,strip_tags');//社区id
		$data['city_id']=$this->_param('city_id','htmlspecialchars,strip_tags');//城市id
		
		$User=D('User');
		$result=$User->update_user_info_by_userid($user_id,$data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
		
	}
	/**
	 * 我的推广url
	 */
	public function my_promotion(){
		$user_id=$this->_param('user_id','htmlspecialchars,strip_tags');
		$op=$this->_param('op','htmlspecialchars,strip_tags');
		if(!empty($op)&&$op=='get_promotion_url'&&!empty($user_id)){
			$promotion_web_url=U('Home/Index/Index',array('param'=>$user_id));
			$promotion_app_url=U('Home/Index/download_app',array('param'=>$user_id));
			$promotion_html5_url=U('Wap/Index/Index',array('param'=>$user_id));
			$url_array=array(
					'promotion_web'=>array(
							'url'=>$promotion_web_url,
							'integral'=>5,//能获得的推广积分
					),
					'promotion_app'=>array(
							'url'=>$promotion_app_url,
							'integral'=>10,//能获得的推广积分
					),
					'promotion_html5'=>array(
							'url'=>$promotion_html5_url,
							'integral'=>5,//能获得的推广积分
					)
			);
			$result=array('status'=>1,'message'=>'成功','data'=>$url_array);
			header("Content-type: text/html; charset=utf-8");
			exit(json_encode($result));
		}
		
	}
	
	
}