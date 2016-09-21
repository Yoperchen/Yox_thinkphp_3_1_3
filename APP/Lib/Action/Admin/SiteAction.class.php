<?php
/**
 * 站点管理
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class SiteAction extends AdminbaseAction {
    public function index()
    {
		$this->display();
    }
   	public function add_site(){
   		$data['partner_api_id'] =I('param.partner_api_id','', 'htmlspecialchars');
   		$data['site_name'] =I('param.site_name','', 'htmlspecialchars');
   		$data['password'] =I('param.password','', 'htmlspecialchars');
   		$data['description'] =I('param.description','', 'htmlspecialchars');
   		$data['site_url'] =I('param.site_url','', 'htmlspecialchars');
   		$data['site_type'] =I('param.site_type','', 'htmlspecialchars');
   		$data['mobile'] =I('param.mobile','', 'htmlspecialchars');
   		$data['qq'] =I('param.qq','', 'htmlspecialchars');
   		$data['email'] =I('param.email','', 'htmlspecialchars');
   		$data['template'] =I('param.template','', 'htmlspecialchars');
   		$data['is_mobile_verify'] =I('param.is_mobile_verify','', 'htmlspecialchars');
   		$data['is_email_verify'] =I('param.is_email_verify','', 'htmlspecialchars');
   		$data['status'] =I('param.status','', 'htmlspecialchars');
   		if(!empty($data['site_name']))
   		{
   			$Partner_site_model   =   D('Partner_site');
   			$partner_register_result = $Partner_site_model->register($data);
   			if($partner_register_result['status']<1){
   				$this->error($partner_register_result['message']);
   			}else{
   				$this->success($partner_register_result['message']);
   			}
   		}else{
   			$this->display();
   		}
   	}
   	public function update_site(){
   		$id = I('param.id','', 'htmlspecialchars');
   		$data['partner_api_id'] =I('param.partner_api_id','', 'htmlspecialchars');
   		$data['site_name'] =I('param.site_name','', 'htmlspecialchars');
   		$data['password'] =I('param.password','', 'htmlspecialchars');
   		$data['description'] =I('param.description','', 'htmlspecialchars');
   		$data['site_url'] =I('param.site_url','', 'htmlspecialchars');
   		$data['site_type'] =I('param.site_type','', 'htmlspecialchars');
   		$data['mobile'] =I('param.mobile','', 'htmlspecialchars');
   		$data['qq'] =I('param.qq','', 'htmlspecialchars');
   		$data['email'] =I('param.email','', 'htmlspecialchars');
   		$data['template'] =I('param.template','', 'htmlspecialchars');
   		$data['is_mobile_verify'] =I('param.is_mobile_verify','', 'htmlspecialchars');
   		$data['is_email_verify'] =I('param.is_email_verify','', 'htmlspecialchars');
   		$data['status'] =I('param.status','', 'htmlspecialchars');
   		$Partner_site_model   =   D('Partner_site');
   		if(!empty($data['site_name'])){
   			$partner_update_result = $Partner_site_model->update_siteById($id, $data);
   			if($partner_update_result['status']<1){
   				$this->error($partner_update_result['message']);
   			}else{
   				$this->success($partner_update_result['message']);
   			}
   		}else{
   			$partner_info_result = $Partner_site_model->get_site_by_id( $id=0,$isdetail=0);
   			$this->assign('partner_info_result',$partner_info_result);
   			$this->display();
   		}
   		
   	}
    public function list_site(){
    	$condition = array();
    	$mobile=I('param.partner_api_id','', 'htmlspecialchars');
    	$title = I('param.title','', 'htmlspecialchars');
    	$site_type = I('param.site_type','', 'htmlspecialchars');
    	$add_time1=I('param.add_time1','', 'htmlspecialchars');
    	$add_time2=I('param.add_time2','', 'htmlspecialchars');
    	
    	if(!empty($title))$condition['title']=array('like','%'.$title.'%');
    	if(!empty($mobile))$condition['mobile']=$mobile;
    	if(!empty($site_type))$condition['site_type']=$site_type;
    	if(!empty($add_time1)&&!empty($add_time2))
    	{
    		$condition['add_time'] = array(
    				array('gt',strtotime($add_time1)),
    				array('lt',strtotime($add_time2))
    		);
    	}
    	$condition=array_filter($condition);//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
    	$Partner_site_model   =   D('Partner_site');
    	$site_list_result = $Partner_site_model->get_site_list($condition,$page_size=20);
//     	print_r($site_list_result);
    	if($site_list_result['status']<1){
    		$this->error($site_list_result['message']);
    	}
    	$this->assign('site_list_result',$site_list_result);
    	$this->display();
    }
    public function del_site(){
    	
    }
}