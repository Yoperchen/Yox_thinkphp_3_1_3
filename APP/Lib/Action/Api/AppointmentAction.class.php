<?php
/**
 * 约会管理
 * @author Yoper
 *
 */
class AppointmentAction extends ApibaseAction {
	/*
	 * 添加约会
	*/
	public function add_appointment(){
		$data['api_partner_id']=$this->_param('api_partner_id','htmlspecialchars,strip_tags');//第三方合作伙伴id
		$data['partner_site_id']=$this->_param('partner_site_id','htmlspecialchars,strip_tags');//第三方站点id
		$data['belong_user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');//用户id|谁发布的约会
		$data['appointment_type']=$this->_param('appointment_type','htmlspecialchars,strip_tags');//约会类型|1约人看电影、2约人吃饭、3约人唱K、4约人锻炼
		$data['title']=$this->_param('title','htmlspecialchars,strip_tags');//标题
		$data['desc']=$this->_param('desc','htmlspecialchars,strip_tags');//约会、预约描述
		$data['appointment_time']=$this->_param('appointment_time','htmlspecialchars,strip_tags');//时间
		$data['appointment_address']=$this->_param('appointment_address','htmlspecialchars,strip_tags');//约会地点
		$data['require_sex']=$this->_param('require_sex','htmlspecialchars,strip_tags');//性别要求|1男，2女，3不限
		$data['apply_user_ids']=$this->_param('apply_user_ids','htmlspecialchars,strip_tags');//报名的人、申请的人|多人以逗号分割
		$data['appointment_pay_type']=$this->_param('appointment_pay_type','htmlspecialchars,strip_tags',time());//1:我埋单、2:求请客、3:AA
		$data['city_id']=$this->_param('city_id','htmlspecialchars,strip_tags');//沉思id
		$data['click']=$this->_param('click','htmlspecialchars,strip_tags');//点击量、浏览量
		
		$result=D('Appointment_index')->add_appointment($data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 获取约会列表
	 */
	public function get_appointment_list(){
		$condition['api_partner_id']=$this->_param('api_partner_id','htmlspecialchars,strip_tags');//第三方合作伙伴id
		$condition['partner_site_id']=$this->_param('partner_site_id','htmlspecialchars,strip_tags');//第三方站点id
		$condition['appointment_type']=$this->_param('appointment_type','htmlspecialchars,strip_tags');//约会类型|1约人看电影、2约人吃饭、3约人唱K、4约人锻炼
		$condition['require_sex']=$this->_param('require_sex','htmlspecialchars,strip_tags');//性别要求|1男，2女，3不限
		$condition['apply_user_ids']=$this->_param('apply_user_id','htmlspecialchars,strip_tags');//报名的人,模糊查询apply_user_ids字符串
		$condition['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');//用户
		$condition['appointment_time']=array('gt',$this->_param('appointment_time','htmlspecialchars,strip_tags'));//时间
		$condition['appointment_pay_type']=$this->_param('appointment_pay_type','htmlspecialchars,strip_tags');//1:我埋单、2:求请客、3:AA
		$condition['city_id']=$this->_param('city_id','htmlspecialchars,strip_tags');//沉思id
		if(!empty($condition['apply_user_ids'])){
			$condition['apply_user_ids']=array('like',
					array('%,'.$this->_param('apply_user_id','htmlspecialchars,strip_tags').',%',
							'%,'.$this->_param('apply_user_id','htmlspecialchars,strip_tags'),
							$this->_param('apply_user_id','htmlspecialchars,strip_tags').'%',
					),'OR');//报名的人,模糊查询apply_user_ids字符串
		}
		$result=D('Appointment_index')->get_appointment_list($condition);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 获取约会内容
	 * 
	 */
	public function getAppointmentById(){
		$id=$this->_param('id','htmlspecialchars,strip_tags');
		$isdetail=$this->_param('isdetail','htmlspecialchars,strip_tags');
		$result=D('Appointment_index')->getAppointmentById($id,$isdetail);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 修改约会
	 * 
	 */
	public function update_appointment(){
		$id=$this->_param('id','htmlspecialchars,strip_tags');
		$data['api_partner_id']=$this->_param('api_partner_id','htmlspecialchars,strip_tags');//第三方合作伙伴id
		$data['partner_site_id']=$this->_param('partner_site_id','htmlspecialchars,strip_tags');//第三方站点id
		$data['belong_user_id']=$this->_param('belong_user_id','htmlspecialchars,strip_tags');//用户id|谁发布的约会
		$data['appointment_type']=$this->_param('appointment_type','htmlspecialchars,strip_tags');//约会类型|1约人看电影、2约人吃饭、3约人唱K、4约人锻炼
		$data['title']=$this->_param('title','htmlspecialchars,strip_tags');//标题
		$data['desc']=$this->_param('desc','htmlspecialchars,strip_tags');//约会、预约描述
		$data['appointment_time']=$this->_param('appointment_time','htmlspecialchars,strip_tags');//时间
		$data['appointment_address']=$this->_param('appointment_address','htmlspecialchars,strip_tags');//约会地点
		$data['require_sex']=$this->_param('require_sex','htmlspecialchars,strip_tags');//性别要求|1男，2女，3不限
		$data['apply_user_ids']=$this->_param('apply_user_ids','htmlspecialchars,strip_tags');//报名的人、申请的人|多人以逗号分割
		$data['appointment_pay_type']=$this->_param('appointment_pay_type','htmlspecialchars,strip_tags',time());//1:我埋单、2:求请客、3:AA
		$data['city_id']=$this->_param('city_id','htmlspecialchars,strip_tags');//沉思id
		$data['click']=$this->_param('click','htmlspecialchars,strip_tags');//点击量、浏览量
		
		$result=D('Appointment_index')->update_appointmentById($id,$data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 删除约会
	 */
	public function del_appointment(){
		$id=$this->_param('id','htmlspecialchars,strip_tags');
		$result=D('Appointment_index')->del_appointment($id);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 报名约会
	 */
	public function apply_appointment(){
		$id=$this->_param('id','htmlspecialchars,strip_tags',0);//约会、预约的id
		$apply_user_id=$this->_param('apply_user_id','htmlspecialchars,strip_tags');//报名的用户id,后面没有s
		
		$result=D('Appointment_index')->apply_appointment($id,$apply_user_id);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 找师妹、找师兄、找校友|Junior sister apprentice/Brother/Alumnus
	 */
	public function find_jba(){
		$user_id = $this->_param('user_id','htmlspecialchars,strip_tags',0);//当前用户id
		$find    = $this->_param('find','htmlspecialchars,strip_tags',0);//找什么人|小师妹、大师兄、
		$User = D('User');
		$user_info = $User->get_user_info(array('id'=>$user_id),0);
		if(!empty($user_info['data'])){
			$condition['community_id']=$this->_param('community_id','htmlspecialchars,strip_tags',0);//社区id
			$condition['city_id']=$this->_param('city_id','htmlspecialchars,strip_tags');//城市id
			if($find==1){//小师妹
				$condition['birthday']=array('elt',$user_info['data']['birthday']);
				$condition['sex']=2;//性别女
			}elseif($find==2){//大师兄
				$condition['birthday']=array('egt',$user_info['data']['birthday']);
				$condition['sex']=1;//性别男
			}elseif($find==3){//师姐
				$condition['birthday']=array('egt',$user_info['data']['birthday']);
				$condition['sex']=2;//性别女
			}elseif($find==4){//师弟
				$condition['birthday']=array('elt',$user_info['data']['birthday']);
				$condition['sex']=1;//性别男
			}else{//小师妹
				$condition['birthday']=array('elt',$user_info['data']['birthday']);
				$condition['sex']=2;//性别女
			}
		
		$page_size=$this->_param('page_size','htmlspecialchars,strip_tags',20);//每页几条
		$result=$User->get_user_list($condition,$page_size=20);
		}else{
			$result=array('status'=>0,'message'=>'用户信息不存在','data'=>$user_info);
		}
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
}