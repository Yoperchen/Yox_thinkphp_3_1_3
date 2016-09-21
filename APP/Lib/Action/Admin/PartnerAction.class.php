<?php
/**
 * 合作伙伴管理
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class PartnerAction extends AdminbaseAction {
    public function index()
    {
		$this->display();
    }
    /**
     * 添加第三方
     */
    public function add_partner(){
    	$data['username'] = I('param.username','', 'htmlspecialchars');//注册者名称
    	$data['password'] = I('param.password','', 'htmlspecialchars');//登录密码
    	$data['name'] = I('param.name','', 'htmlspecialchars');//第三方名称
    	$data['user_id'] = I('param.user_id','', 'htmlspecialchars');//所属用户
    	$data['start'] = I('param.start','', 'htmlspecialchars');//等级
    	$data['type'] = I('param.type','', 'htmlspecialchars');//类型
    	$data['mobile'] = I('param.mobile','', 'htmlspecialchars');//所属这手机
    	$data['remark'] = I('param.remark','', 'htmlspecialchars');//备注
    	$data['city_id'] = I('param.city_id','', 'htmlspecialchars');//所在城市
    	if(!empty($data['name'])){
    		$Partner_api_model   =   D('Partner_api');
    		$partner_add_result = $Partner_api_model->add_partner($data);
    		if($partner_add_result['status']<1){
    			$this->error($partner_add_result['message']);
    		}else{
    			$this->success($partner_add_result['message']);
    		}
    	}else{
    		$this->display();
    	}
    }
    public function update_partner(){
    	$id = I('param.id','', 'htmlspecialchars');//id
    	$data['username'] = I('param.username','', 'htmlspecialchars');//注册者名称
    	$data['password'] = I('param.password','', 'htmlspecialchars');//登录密码
    	$data['name'] = I('param.name','', 'htmlspecialchars');//第三方名称
    	$data['user_id'] = I('param.user_id','', 'htmlspecialchars');//所属用户
    	$data['start'] = I('param.start','', 'htmlspecialchars');//等级
    	$data['type'] = I('param.type','', 'htmlspecialchars');//类型
    	$data['mobile'] = I('param.mobile','', 'htmlspecialchars');//所属这手机
    	$data['remark'] = I('param.remark','', 'htmlspecialchars');//备注
    	$data['city_id'] = I('param.city_id','', 'htmlspecialchars');//所在城市
    	$Partner_api_model   =   D('Partner_api');
    	if(!empty($data['name'])){
    		$partner_update_result = $Partner_api_model->update_partnerById($id,$data);
    		if($partner_update_result['status']<1){
    			$this->error($partner_update_result['message']);
    		}else{
    			$this->success($partner_update_result['message']);
    		}
    	}else{
    		$partner_info_result = $Partner_api_model->getPartnerById($id);
    		$this->assign('partner_info_result',$partner_info_result);
    		$this->display();
    	}
    	
    }
    public function list_partner(){
    	$condition = array();
    	$title = I('param.title','', 'htmlspecialchars');
    	if(!empty($title))$condition['title']=$title;
    	$mobile=I('param.mobile','', 'htmlspecialchars');
    	if(!empty($mobile))$condition['mobile']=$mobile;
    	
    	$add_time1=I('param.add_time1','', 'htmlspecialchars');
    	$add_time2=I('param.add_time2','', 'htmlspecialchars');
    	if(!empty($add_time1)&&!empty($add_time2))
    	{
    		$condition['add_time'] = array(
    				array('gt',strtotime($add_time1)),
    				array('lt',strtotime($add_time2))
    		);
    	}
    	$Partner_api_model   =   D('Partner_api');
    	$partner_list_result = $Partner_api_model->get_partner_list($condition,$page_size=20);
//     	print_r($partner_list_result);
    	if($partner_list_result['status']<1){
    		$this->error($partner_list_result['message']);
    	}
    	$this->assign('partner_list_result',$partner_list_result);
    	$this->display();
    }
    public function del_partner(){
    	$id = I('param.id','', 'htmlspecialchars');//id
    	$data['status']=4;
    	$Partner_api_model   =   D('Partner_api');
    	$partner_del_result = $Partner_api_model->update_partnerById($id,$data);
    	if($partner_del_result['status']<1){
    		$this->error($partner_del_result['message']);
    	}else{
    		$this->success($partner_del_result['message']);
    	}
    } 
}