<?php
/**
 * 系统用户
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class UserAction extends AdminbaseAction {
    public function index()
    {
		$this->display();
    }
    /**
     * 添加用户
     */
    public function add_user()
    {
    	$data['api_partner_id'] = I('param.api_partner_id','','htmlspecialchars');//所属第三方ID
    	$data['email'] = I('param.email','','htmlspecialchars');//邮箱
    	$data['nick_name'] = I('param.nick_name','','htmlspecialchars');//昵称
    	$data['name'] = I('param.name','','htmlspecialchars');//名称
    	$data['password'] = I('param.password','','htmlspecialchars');//密码
    	$data['sex'] = I('param.sex','','htmlspecialchars');//性别|1男、2女
    	$data['birthday'] = I('param.birthday','','htmlspecialchars');//生日
    	$data['mobile'] = I('param.mobile','','htmlspecialchars');//手机号
    	$data['up'] = I('param.up','','htmlspecialchars');//顶
    	$data['down'] = I('param.down','','htmlspecialchars');//差
    	$data['like'] = I('param.like','','htmlspecialchars');//喜欢
    	$data['funds'] = I('param.funds','','htmlspecialchars');//积分
    	$data['integral'] = I('param.integral','','htmlspecialchars');//积分
    	$data['community_id'] = I('param.community_id','','htmlspecialchars');//社区id|学校，医院，小区
    	$data['city_id'] = I('param.city_id','','htmlspecialchars');//常在城市id
    	$data['district_id'] = I('param.district_id','','htmlspecialchars');//地区，对应district表
    	$data['is_mobile_verify'] = I('param.is_mobile_verify','','htmlspecialchars');//是否手机验证过
    	$data['is_email_verify'] = I('param.is_email_verify','','htmlspecialchars');//是否邮箱验证过
    	$data['tag_id'] = I('param.tag_id','','htmlspecialchars');//标签id|对应tags表
    	$data['qq'] = I('param.qq','','htmlspecialchars');//QQ
    	$data['up_user_id'] = I('param.up_user_id','','htmlspecialchars');//上级用户，通过谁的推广过来的用户
    	$data['status'] = I('param.status','','htmlspecialchars');//状态|1正常,2禁止,3黑名单,4删除
    	
    	if(!empty($data['name']))
    	{
	    	$user_model = D("User");
	    	$user_add_result = $user_model->register($data);
	    	if($user_add_result['status']<1){
	    		$this->error($user_add_result['message']);
	    	}else{
	    		$this->success($user_add_result['message']);
	    	}
	    }else{
	    	$this->display();
	    }
    }
    /**
     * 获取用户列表
     */
    public function list_user()
    {
    	$user_model = D("User");
    	$condition = array();
    	$condition['site_id'] = I('param.site_id','','htmlspecialchars');//站点ID
    	$condition['name'] = array('like','%'.I('param.name','','htmlspecialchars').'%');//站点ID
    	$user_list_result = $user_model->get_user_list($condition,$page_size=20);
    	if($user_list_result['status']<1)
    	{
    		$this->error($user_list_result['message']);
    	}
    	$this->assign('user_list_result',$user_list_result);
    	$this->display();
    }
    /**
     * 修改用户
     */
    public function update_user()
    {
    	$id = I('param.id','','htmlspecialchars');//站点ID
    	$data['api_partner_id'] = I('param.api_partner_id','','htmlspecialchars');//所属第三方ID
    	$data['email'] = I('param.email','','htmlspecialchars');//邮箱
    	$data['nick_name'] = I('param.nick_name','','htmlspecialchars');//昵称
    	$data['name'] = I('param.name','','htmlspecialchars');//名称
    	$data['password'] = I('param.password','','htmlspecialchars');//密码
    	$data['sex'] = I('param.sex','','htmlspecialchars');//性别|1男、2女
    	$data['birthday'] = I('param.birthday','','htmlspecialchars');//生日
    	$data['mobile'] = I('param.mobile','','htmlspecialchars');//手机号
    	$data['up'] = I('param.up','','htmlspecialchars');//顶
    	$data['down'] = I('param.down','','htmlspecialchars');//差
    	$data['like'] = I('param.like','','htmlspecialchars');//喜欢
    	$data['funds'] = I('param.funds','','htmlspecialchars');//积分
    	$data['integral'] = I('param.integral','','htmlspecialchars');//积分
    	$data['community_id'] = I('param.community_id','','htmlspecialchars');//社区id|学校，医院，小区
    	$data['city_id'] = I('param.city_id','','htmlspecialchars');//常在城市id
    	$data['district_id'] = I('param.district_id','','htmlspecialchars');//地区，对应district表
    	$data['is_mobile_verify'] = I('param.is_mobile_verify','','htmlspecialchars');//是否手机验证过
    	$data['is_email_verify'] = I('param.is_email_verify','','htmlspecialchars');//是否邮箱验证过
    	$data['tag_id'] = I('param.tag_id','','htmlspecialchars');//标签id|对应tags表
    	$data['qq'] = I('param.qq','','htmlspecialchars');//QQ
    	$data['up_user_id'] = I('param.up_user_id','','htmlspecialchars');//上级用户，通过谁的推广过来的用户
    	$data['status'] = I('param.status','','htmlspecialchars');//状态|1正常,2禁止,3黑名单,4删除
    	$user_model = D("User");
    	if(!empty($data['name'])){
    		$user_update_result = $user_model->update_user_info_by_userid($id,$data);
    		if($user_update_result['status']<1){
    			$this->error($user_update_result['message']);
    		}else{
    			$this->success($user_update_result['message']);
    		}
    	}else{
    		$condition=array();
    		$condition['id']=$id;
    		$user_info_result = $user_model->get_user_info($condition,$isdetail=1);
    		$this->assign('user_info_result',$user_info_result);
//     		print_r($user_info_result);
    		$this->display();
    	}
    	
    }
    /**
     * 删除用户
     */
    Public function del_user()
    {
    	$id = I('param.user_id','','htmlspecialchars');
    	$data['status']=4;//状态|1正常,2禁止,3黑名单,4删除
    	$user_model = D("User");
    	$user_del_info = $user_model->update_user_info_by_userid($id,$data);
    	if($user_del_info['status']<1){
    		$this->error($user_del_info['message']);
    	}else{
    		$this->success($user_del_info['message']);
    	}
    }

}