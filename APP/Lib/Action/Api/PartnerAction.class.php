<?php
/*
 * 商家api
 */
class PartnerAction extends ApibaseAction {
	/**
	 * 添加第三方
	 */
	public function add_partner(){
		$data['auth']=$this->_param('auth','htmlspecialchars,strip_tags');
		$data['titlename']=$this->_param('titlename','htmlspecialchars,strip_tags');
		$data['password']=$this->_param('password','htmlspecialchars,strip_tags');
		$data['remark']=$this->_param('remark','htmlspecialchars,strip_tags');
		$data['start']=$this->_param('start','htmlspecialchars,strip_tags');
		$data['type']=$this->_param('type','htmlspecialchars,strip_tags');
		
		$result= D('Api_partner')-> add_partner($data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));//json格式数据
	}
		/*
		 * 验证第三方
		 */
	public function check_partner(){
		$username=$this->_param('username','htmlspecialchars,strip_tags');
		$auth=$this->_param('auth','htmlspecialchars,strip_tags');
		$password=$this->_param('password','htmlspecialchars,strip_tags');
		$required_password=0;
// 		if(!empty($id)&&!empty($password)){
			$Api_partner=D('Api_partner');
			$result= $Api_partner-> check_partner($username,$auth,$password,$required_password);
			header("Content-type: text/html; charset=utf-8");
			exit(json_encode($result));//json格式数据
// 		}
	}
	/**
	 * 密码重置
	 *http://192.168.1.1/ThinkPHP_3_1_3_YO/index.php?g=api&m=User&a=reset_password&mobile=18028571566&new_password=123456
	 */
	public function reset_password(){
		$username	=$this->_param('username','htmlspecialchars,strip_tags');
		$mobile		=$this->_param('mobile','htmlspecialchars,strip_tags');
		$old_password=$this->_param('old_password','htmlspecialchars,strip_tags');
		$new_password=$this->_param('new_password','htmlspecialchars,strip_tags');
		$isForced	=$this->_param('isForced','htmlspecialchars,strip_tags');
		$isForced	=1;
		
		if(!empty($new_password)&&(!empty($username)||!empty($mobile))){
			$result=D('Api_partner')->reset_password($old_password,$new_password,$username,$isForced);
		}
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
		//exit(json_encode($data,JSON_UNESCAPED_UNICODE));//json格式数据
		
	}
	/**
	 * 获取合作伙伴列表
	 */
	public function get_partner_list(){
		$condition['start']=$this->_param('start','htmlspecialchars,strip_tags');//第三方等级
		$condition['type']=$this->_param('type','htmlspecialchars,strip_tags');//第三方类型
		$condition['city_id']=$this->_param('city_id','htmlspecialchars,strip_tags');//第三方类型
		$page_size=$this->_param('city_id','htmlspecialchars,strip_tags');//第三方类型
		$result=D('Api_partner')->get_partner_list($condition,$page_size);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
}