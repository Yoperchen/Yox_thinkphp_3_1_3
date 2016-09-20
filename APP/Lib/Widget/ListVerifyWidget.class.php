<?php
//文章列表
//{:W('ListVerify',array('template'=>'Yocms_image_list_88','condition'=>array(),'page_template'=>'0'))}
class ListVerifyWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'ListVerify';
    	
    	$Verify_model  =   D('Verify');
    	
    	$condition = '';//条件
    	$condition['site_id']=$data['condition']['site_id']?$data['condition']['site_id']:'';//站点
    	$condition['userid']=$data['condition']['userid']?array('eq',$data['condition']['userid']):'';//用户
    	$condition['user_id']=$data['condition']['user_id']?array('eq',$data['condition']['user_id']):'';//用户
		$condition['mobile']=$data['condition']['mobile']?array('eq',$data['condition']['mobile']):'';//手机
    	$condition['email']=$data['condition']['email']?array('eq',$data['condition']['email']):'';//邮箱
    	$condition['verify_type']=$data['condition']['verify_type']?array('eq',$data['condition']['verify_type']):'';//验证类型
    	$condition['verify_code']=$data['condition']['verify_code']?array('eq',$data['condition']['verify_code']):'';//验证码
    	$condition['status']=$data['condition']['status']?array('eq',$data['condition']['status']):'';//0:未验证，1：已验证，2：未定
    	
    	$condition['add_time']=$data['condition']['add_time']?array('eq',$data['condition']['add_time']):'';//添加时间
    	$condition['add_time']=$data['condition']['egt_add_time']?array('EGT',$data['condition']['egt_add_time']):'';//大于等于
    	$condition['add_time']=$data['condition']['gt_add_time']?array('GT',$data['condition']['gt_add_time']):'';//大于
    	$condition['add_time']=$data['condition']['elt_add_time']?array('ELT',$data['condition']['elt_add_time']):'';//小于等于
    	$condition['add_time']=$data['condition']['lt_add_time']?array('LT',$data['condition']['lt_add_time']):'';//小于
    	
    	$condition['update_time']=$data['condition']['update_time']?array('eq',$data['condition']['update_time']):'';//修改时间
    	$condition['update_time']=$data['condition']['egt_update_time']?array('EGT',$data['condition']['egt_update_time']):'';//大于等于
    	$condition['update_time']=$data['condition']['gt_update_time']?array('GT',$data['condition']['gt_update_time']):'';//大于
    	$condition['update_time']=$data['condition']['elt_update_time']?array('ELT',$data['condition']['elt_update_time']):'';//小于等于
    	$condition['update_time']=$data['condition']['lt_update_time']?array('LT',$data['condition']['lt_update_time']):'';//小于
    	   
    	$data['page']['page_size'] = $data['page']['page_size']?intval($data['page']['page_size']):12;
    	
    	$list_verify_result = $Verify_model-> get_verify_list($condition,$data['page']['page_size']);
    	$data['list']=$list_verify_result['data']['list'];
    	$data['page']=$list_verify_result['data']['page'];
     	//print_r($data);
	//print_r($condition);
    	 
        $content = $this->renderFile($Template,$data);
		if($data['format_type']=='json')
		{
			return json_encode(array('status'=>1,'data'=>$content));
		}
		elseif($data['format_type']=='xml')
		{
			
		}
		else{
	        return $content;  
		}
	} 
 }