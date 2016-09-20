<?php
/**
 * 验证码
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class VerifyModel extends Model {
	const VERIFY_REGISTER_CODE='verify_register_code';
	
	/**
	 * 验证注册时的验证码
	 * @param string $verify_type 注册验证verify_register_code|忘记密码verify_forgot_password_code
	 * @param unknown $code
	 * @return boolean
	 */
	public function verify($verify_type='verify_register_code',$code='',$mobile='',$userid='',$email=''){
		if(empty($verify_type)||empty($code)||(empty($mobile)&&empty($userid)&&empty($email))){
			return false;
		}
		$user_condition = array();
		$verify_condition=array();
		if(!empty($userid)){
			$verify= M('Verify')->where('userid='.$userid)->order('id desc')->field('userid,mobile,verify_type,verify_code,email,addTime')->find();
			$user_condition='userid='.$userid;
			$verify_condition = array('userid'=>$userid);
// 			$data['is_mobile_verify']=1;
		}elseif(!empty($email)){
			$verify= M('Verify')-> where('email="'.$email.'"')->order('id desc')->field('userid,mobile,verify_type,verify_code,email,addTime')->find();
			$user_condition='email="'.$email.'"';
			$verify_condition = array('email'=>$email);
			$data['is_email_verify ']=1;
		}elseif(!empty($mobile)){
			$verify= M('Verify')->where('mobile='.$mobile)->order('id desc')->field('userid,mobile,verify_type,verify_code,email,addTime')->find();
			$user_condition='mobile='.$mobile;
			$verify_condition = array('mobile'=>$mobile);
			$data['is_mobile_verify']=1;
		}
		
		if($verify['verify_code']==$code){
			M('User')->where($user_condition)->save($data);
			$this->where($verify_condition)->save(array('status'=>'1'));
			return true;
		}else{
			return false;
		}
	}
	/**
	 * 设置验证码
	 * @param string $verify_type 验证类型，注册验证，邮箱验证
	 * @param string $mobile
	 * @param string $userid
	 * @param string $email
	 * @return $verify_code|false
	 */
	public function set_verify($verify_type,$mobile='',$userid='',$email=''){
		$code= mt_rand(1000,9999);//随机数
		if(empty($verify_type) || (empty($mobile)&&empty($userid)&&empty($email)))
		{
			return false;
		}
		if(!empty($mobile)&&!preg_match('/^[0-9]{11}$/', $mobile)){//验证手机格式
			return -1;
		}
		$Verify=M('Verify');
		$data=array('verify_type'=>$verify_type,'verify_code'=>$code,'mobile'=>$mobile,'email'=>$email,'userid'=>$userid,'addTime'=>time());
		$id=$Verify->data($data)->add();
		if($id){
			return $code;
		}else{
			return false;
		}
	}
	/**
	 * 发送验证码
	 * @param string $email
	 * @param string $verify_type 注册verify_register_code|忘记密码verify_forgot_password_code
	 */
	public function send_email_verify($email='',$verify_type=''){
		if(empty($email)||empty($verify_type)){
			$message = '邮箱或者验证码类型为空';
			$result=array('status'=>0,'message'=>$message,'data'=>'');
		}
		$code=$this->set_verify($verify_type,'','',$email);
		if($code==-2){
			$message='邮箱格式错误';
			
			$result=array('status'=>0,'message'=>$message,'data'=>'');
		}else{
			
			$title='邮箱验证码';
			$content='你好，您的邮箱验证码是：'.$code;
			if(SendMail($email,$title,$content)){//发送验证邮件
				$message= '邮箱验证邮件发送成功！';
			}else{
				$message = '验证码发送失败';
			}
			
			$data = array();
			$data['code'] =$code;
			$data['email']=$email;
			$data['verify_type']=$verify_type;
			$result=array('status'=>1,'message'=>$message,'data'=>$data);
		}
		return $result;
			
	}
	/**
	 * 发送验证码
	 * @param string $mobile
	 * @param string $verify_type 注册verify_register_code|忘记密码verify_forgot_password_code
	 */
	public function send_mobile_verify($mobile='',$verify_type=''){
		if(empty($mobile)||empty($verify_type)){
			$message = '手机或者验证码类型为空';
			$result=array('status'=>0,'message'=>$message,'data'=>'');
		}
		$code=$this->set_verify($verify_type,$mobile);
		if($code==-1){
			$message='邮箱格式错误';
				
			$result=array('status'=>0,'message'=>$message,'data'=>'');
		}else{
			$title='手机验证码';
			$content='你好，您的手机验证码是：'.$code;
			if(SendMail('944975166@qq.com',$title,$content)){//发送验证邮件
				$message= '邮箱验证邮件发送成功！';
			}else{
				$message = '验证码发送失败';
			}
				
			$data = array();
			$data['code'] =$code;
			$data['mobile']=$mobile;
			$data['verify_type']=$verify_type;
			$result=array('status'=>1,'message'=>$message,'data'=>$data);
		}
		return $result;
			
	}
	/**
	 * 列表
	 * @param unknown_type $condition
	 * @param unknown_type $page_size
	 */
	public function get_verify_list($condition,$page_size=20)
	{
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
		$list = $this->where($condition)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		if(!empty($list)){
			$result=array(
					'status'=>1,
					'message'=>'成功',
					'data'=>array(
							'page'=>array(
									'count'=>$count,//总数
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
	}
	
	
}