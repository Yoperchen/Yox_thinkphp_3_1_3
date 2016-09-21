<?php
// 分享
class IndexAction extends Action 
{
    public function index()
    {
    	import('ORG.Yocms_client',LIB_PATH);// 导入Yocms客户端类
    	$Yocms_client_obj = new Yocms_client();
    	$list_share_result = $Yocms_client_obj->get_common_info($ma='10001',$data='',$method='get');//分享列表
//     	print_r($list_share_result);
    	
//     	$this->assign('list_share_result',$list_share_result);
		$this->display();
    }
    //登录
    public function login()
    {
    	$id=$this->_param('id','htmlspecialchars,strip_tags');
		$password=$this->_param('password','htmlspecialchars,strip_tags');

 	if(!empty($id)&&!empty($password)){
		$User=D('User');
		$result= $User->user_login($id , $password);
		if($result['status']==1){
			$this->success('登录成功', U('Yo81008/Index/index'));
		}else{
			$this->error($result['message']);
		}
	}else{
		$this->display();
		}
    }
    //注册
    public function register(){
    	$email = $this->_param('email','htmlspecialchars,strip_tags');
	$name = $this->_param('name','htmlspecialchars,strip_tags');
	$mobile = $this->_param('mobile','htmlspecialchars,strip_tags');
    	$password = $this->_param('password','htmlspecialchars,strip_tags');
    	$signup_confirm_password = $this->_param('signup_confirm_password','htmlspecialchars,strip_tags');
    	if($password!=$signup_confirm_password)$this->error('密码前后不一致',U('Yo81009/Admin/site_register'));
    	if(!empty($password)){
    		$data=array();
//    		$data['site_name']=;
    		$data['email']=$email;
		$data['name']=$name;
		$data['mobile']=$mobile;
    		$data['password']=$password;
    		$result = D('User')->register($data);
    		if($result['status']==1){
    			$this->success($result['message'],U('Yo81008/Index/index'));
    		}else{
    			$this->error($result['message'],U('Yo81008/Index/index'));
    		}
    		
    	}
    	$this->display();
    }
    public function find_password()
    {
    	$verify = $this->_param('verify','htmlspecialchars,strip_tags');
    	$email=$this->_param('email','htmlspecialchars,strip_tags');
    	$verify_type='verify_forgot_password_code';//注册verify_register_code|忘记密码verify_forgot_password_code
    	if(!empty($email)&&!empty($verify_type)&&empty($verify))
    	{//发送邮件
    		$result = D('Verify')->send_email_verify($email,$verify_type);
    		if($result['status']!=0)
    		{
    			//$this->success($result['message'],U('Yo81008/Index/find_password',array('is_send'=>1)));
			header("Content-type: text/html; charset=utf-8");
			exit(json_encode($result));
    		}
    	}
    	elseif($verify=='verify')
    	{//验证
    		$code = $this->_param('code','htmlspecialchars,strip_tags');
    		$new_password = $this->_param('new_password','htmlspecialchars,strip_tags');
    		$result = D('Verify')->verify($verify_type='verify_forgot_password_code',$code,$mobile='',$userid='',$email);
    		if($result)
    		{
    			$result = D('User')->reset_password($old_password='',$new_password,$userid='',$mobile='',$email,$isForced=1);
    			if($result['status']){
    				$this->success('修改成功',U('Yo81008/Index/index'));
    			}else{
    				$this->error('修改失败',U('Yo81008/Index/find_password',array('is_send'=>1)));
    			}
    		}else{
    			$this->error('验证失败',U('Yo81008/Index/find_password',array('is_send'=>1)));
    		}
    	}
    	else{
    		
    		$this->display();
    	}
    	
    }
    public function get_weather_info(){
    	$areaid = I('param.areaid','', 'htmlspecialchars');
    	import('ORG.Weather',LIB_PATH);// 导入天气类
    	$Weather_obj = new Weather();
    	$weather_info_result = $Weather_obj->get_weather_info($areaid);
    	if(is_array($weather_info_result)){
    		header("Content-type: text/html; charset=utf-8");
    		exit(json_encode($weather_info_result));
    	}
    	
    }
    
}