<?php
/**
 * 优惠券(兑换券、代金券、折扣券)操作
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class CouponAction extends AdminbaseAction {
    public function index()
    {
        //检查登录
        if(session('account_type')!='admin' && session('id')<1)
        {
            $message='没有登录，请先登录哦。';
            $this->error($message,U('Login/login@admin'),$this->isAjax());
        }
		$this->display();
    }
    
    public function add_multi_coupon(){
    	$data['site_id'] = I('param.site_id','0', 'int');//站点id
    	$data['password'] = I('param.password','', 'htmlspecialchars');//密码
    	$data['type_id'] = I('param.type_id','', 'int');//类型|1:现金券，2兑换券，3折扣券
    	$data['batch_id'] = I('param.batch_id','', 'int');//批次id
    	$data['total_value'] = I('param.total_value','', 'htmlspecialchars');//总价值
    	$data['remain_value'] = I('param.remain_value','', 'htmlspecialchars');//剩余价值
    	$data['sale_price'] = I('param.sale_price','', 'htmlspecialchars');//销售价
    	$data['unit'] = I('param.unit','', 'htmlspecialchars');//价值单位|元、张
    	$data['start_time'] = I('param.start_time','', 'htmlspecialchars');//券的有效期
    	$data['end_time'] = I('param.end_time','', 'htmlspecialchars');//券的有效期
    	$data['belong_user_id'] = I('param.belong_user_id','', 'int');//所属用户
    	$data['mobile'] = I('param.mobile','', 'htmlspecialchars');//所属手机
    	$data['order_id'] = I('param.order_id','', 'htmlspecialchars');//订单id
    	$data['validation_count'] = I('param.validation_count','', 'int');//验证次数
    	$data['validation_time'] = I('param.validation_time','', 'int');//验证时间
    	$data['status'] = I('param.status','', 'htmlspecialchars');//状态|1正常,2禁止,3黑名单,4删除
    	$num =  I('param.num','1', 'int');//生成多少张
    	if(!empty($data['batch_id']))
    	{
	    	$Coupon_model   =   D('Coupon');
	    	$result = $Coupon_model->add_multi_coupon($data,$num);
	    	if($result['status']<1)
	    	{
	    		$this->error($result['message']);
	    	}else{
	    		$this->success($result['message']);
	    	}
    	}else{
    		$this->display();
    	}
    }
    /**
     * 优惠券列表
     */
    public function list_coupon()
    {
    	$condition = array();
    	$condition['site_id'] = I('param.site_id','', 'int');
    	$condition['type_id'] = I('param.type_id','', 'int');//类型|1:现金券，2兑换券，3折扣券
    	$condition['batch_id'] = I('param.batch_id','', 'int');//批次id
        $condition['serial_number'] = I('param.serial_number','', 'htmlspecialchars');//券码
    	$condition['total_value'] = I('param.total_value','', 'int');//总价值
    	$condition['belong_user_id'] = I('param.belong_user_id','', 'int');
    	$condition['mobile'] = I('param.mobile','', 'htmlspecialchars');
    	$condition['status'] = I('param.status','', 'int');
    	
//     	$start_time = I('param.start_time','', 'htmlspecialchars');
     	$end_time1 = I('param.end_time1','', 'int');
        $end_time2 = I('param.end_time2','', 'int');
     	if(!empty($end_time1)&&!empty($end_time2))
     	{
     		$condition['end_time'] = array(
     				array('gt',strtotime($end_time1)),
     				array('lt',strtotime($end_time2))
     		);
     	}
    	$Coupon_model   =   D('Coupon');
    	$coupon_list_result = $Coupon_model->get_coupon_list($condition,$page_size=20);
	//print_r($coupon_list_result);
    	if($coupon_list_result['status']<1)
    	{
    		$this->error($coupon_list_result['message']);
    	}
//     	print_r($article_list_result);
    	$this->assign('coupon_list_result',$coupon_list_result);
    	$this->display();
    }
    /**
     * 修改优惠券
     */
    public function update_coupon()
    {
    	$coupon_id = I('param.coupon_id','', 'int');
    	$data['site_id'] = I('param.site_id','', 'int');//站点id
    	$data['password'] = I('param.password','', 'htmlspecialchars');//密码
    	$data['type_id'] = I('param.type_id','', 'int');//类型|1:现金券，2兑换券，3折扣券
    	$data['batch_id'] = I('param.batch_id','', 'int');//批次id
    	$data['total_value'] = I('param.total_value','', 'htmlspecialchars');//总价值
    	$data['remain_value'] = I('param.remain_value','', 'htmlspecialchars');//剩余价值
    	$data['sale_price'] = I('param.sale_price','', 'htmlspecialchars');//销售价
    	$data['unit'] = I('param.unit','', 'htmlspecialchars');//价值单位|元、张
    	$data['start_time'] = I('param.start_time','', 'htmlspecialchars');//券的有效期
    	$data['end_time'] = I('param.end_time','', 'htmlspecialchars');//券的有效期
    	$data['belong_user_id'] = I('param.belong_user_id','', 'int');//所属用户
    	$data['mobile'] = I('param.mobile','', 'htmlspecialchars');//所属手机
    	$data['order_id'] = I('param.order_id','', 'htmlspecialchars');//订单id
    	$data['validation_count'] = I('param.validation_count','', 'int');//验证次数
    	$data['validation_time'] = I('param.validation_time','', 'int');//验证时间
    	$data['status'] = I('param.status','', 'int');//状态|1正常,2禁止,3黑名单,4删除
    	$Coupon_model   =   D('Coupon');
    	$coupon_info_result = $Coupon_model->get_coupon_by_id($coupon_id);
    	
    	if($coupon_info_result['status']>0) 
    	{
    		if(!empty($data['total_value']))
    		{
    			$result = $Coupon_model->update_couponById($coupon_id,$data);
    			if($result['status']==1){
    				$this->success('修改成功',U('Coupon/list_coupon@admin'));
    			}else{
    				$this->error($result['message']);
    			}
    		}else{
    			$this->assign('coupon_info_result',$coupon_info_result);
    			//     	print_r($article_info_result);
    			$this->display();
    		}
    		
    	}else{
    		$this->error($coupon_info_result['message']);
    	}
    }
    /**
     * 添加批次
     */
    public function add_batch(){
    	$data['site_id'] =I('param.site_id','','int');
    	$data['batch_code'] =I('param.batch_code','','htmlspecialchars');
    	$data['batch_name'] =I('param.batch_name','','htmlspecialchars');
    	$data['short_name'] =I('param.short_name','','htmlspecialchars');
    	$data['batch_remark'] =I('param.batch_remark','','htmlspecialchars');
    	$data['is_sale'] =I('param.is_sale','','int');
    	$data['status'] =I('param.status','','int');
    	$Coupon_model   =   D('Coupon');
    	if(!empty($data['batch_name']))
    	{
    		$batch_add_result = $Coupon_model->add_batch($data);
    		if($batch_add_result['status']==1){
    			$this->success($batch_add_result['message'],U('Coupon/list_batch@admin'));
    		}else{
    			$this->error($batch_add_result['message']);
    		}
    	}else{
    		$condition=array();
    		$page_size=I('param.status','50','int');
    		$batch_list_result = $Coupon_model->get_batch_list($condition,$page_size);
    		$this->assign('batch_list_result',$batch_list_result);
    		$this->display();
    	}
    }
    /**
     * 批次列表
     */
	public function list_batch(){ 
	    $condition=array();
	    $condition['site_id']=I('param.site_id','', 'int');//所属站点
	    $condition['status']=I('param.status','', 'int');//状态|1正常,2禁止,3黑名单,4删除
	    $condition['batch_code']=I('param.batch_code','', 'htmlspecialchars');
	    $condition['is_sale']=I('param.is_sale','', 'htmlspecialchars');//是否销售|1:销售,0:非销售
	    $page_size = 50;
	    $Coupon_model   =   D('Coupon');
	    
	    $batch_list_result = $Coupon_model->get_batch_list($condition,$page_size);
	    //print_r($category_list_result);
	    $this->assign('batch_list_result',$batch_list_result);
	    $this->display();
	}
	/**
	 * 修改批次
	 */
	public  function update_batch(){
		$Coupon_model = D('Coupon');
		$batch_id = I('param.batch_id','0','htmlspecialchars');
		if(!empty($batch_id) && I('param.op','','htmlspecialchars')=='update'){//写到数据库
			$data['site_id'] =I('param.site_id','','int');
			$data['batch_code'] =I('param.batch_code','','htmlspecialchars');
			$data['batch_name'] =I('param.batch_name','','htmlspecialchars');
			$data['short_name'] =I('param.short_name','','htmlspecialchars');
			$data['batch_remark'] =I('param.batch_remark','','htmlspecialchars');
			$data['is_sale'] =I('param.is_sale','','int');
			$data['status'] =I('param.status','','int');
	
			$batch_update_result =   $Coupon_model->update_batchById($batch_id,$data);
			// 	    		print_r($data);
			if($batch_update_result['status']) {
				$this->success($batch_update_result['message']);
			}else{
				$this->error($batch_update_result['message']);
			}
		}else{
			$batch_info_result =   $Coupon_model->get_batch_by_id($batch_id);
			if($batch_info_result['status']) {
				$this->category_info_result =   $batch_info_result;// 模板变量赋值
			}else{
				$this->error($batch_info_result['message']);
			}
		}
		$this->display();
	}
}