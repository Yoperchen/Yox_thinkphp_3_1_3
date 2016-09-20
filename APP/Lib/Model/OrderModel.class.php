<?php
/**
 * 订单
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 */
class OrderModel extends AdvModel 
{
	const IS_LOG=1;
	/**
	 * 添加通用订单
	 */
	public function set_order($data)
	{
		$data=array_filter($data,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		if(!empty($data['serialize']))
		{
			$data['serialize'] = serialize($data['serialize']);//序列化字段可以用来存额外的信息
		}
		
		$result=array('status'=>0,'message'=>'data不能为空');
		if(!empty($data)){
			$today=date('Y-m-d');
			$data['order_num']?$data['order_num']:'YO'.$today.time().'-'.rand(10, 10000);
			$data['add_time']=time();
			$order_id=$this->data($data)->add();
			 if($order_id){
			 	$data['id']=$order_id;
				$result=array('status'=>1,'message'=>'添加订单成功','data'=>$data);
			 }else{
			 	$result=array('status'=>0,'message'=>'添加订单失败','data'=>$data);
			 }
			return $result;
		}

	}
	
	/**
	 * 设置订单成功
	 */
	public function set_order_success($order_id)
	{
		$result=array('status'=>0);
		if(empty($order_id)){
		    $result['message']='订单id为空';
			return $result;
		}

		$order_info = $this->where(array('order_id'=>$order_id))->find();
		
		if(empty($order_info))
		{
			$result['message']='查无此订单';
			return $result;
		}
		
		if($order_info['status']==9)
		{
			$result['status']=1;
			$result['message']='订单'.$order_id.'已经支付过了，不能再次支付';
			$result['data']['order_id']=$order_id;
			return $result;
		}
		$data['update_time']=time();
		$data['status']=1;
		if($this->where(array('order_id'=>$order_info['order_id']))->save($data))
		{
			$result['status']=1;
			$result['message']='修改成功';
			$result['data']['order_id']=$order_id;
		}
		return $result;
	}
	/**
	 * 设置订单成功
	 * @param string $out_trade_no
	 */
	public function set_order_success_by_out_trade_no($out_trade_no)
	{
	    $order_info = $this->where(array('order_num'=>$out_trade_no))->find();
	    $this->set_order_success($order_info['order_id']);
	}
	/**
	 * 获取订单纤细信息
	 * @param number $order_id
	 * @param number $isdetail
	 * @return array
	 */
	public function get_order_info($order_id=0,$isdetail=0,$field="order_id"){
		if(empty($order_id)){
			$data=array('status'=>0,'message'=>'id不能为空');
			return $data;
		}
		$order_info = $this->where(array($field=>$order_id))->find();
		if(empty($order_info)){
			$data_tmp=array();
			$data_tmp['order_id']=$order_id;
			$data_tmp['field']=$field;
			$data=array('status'=>0,'message'=>'失败1，查无此订单','data'=>$data_tmp);
			return $data;
		}
		if($isdetail==0){
			$order_info['serialize'] = unserialize($order_info['serialize']);
			$data=array('status'=>1,'message'=>'成功','data'=>$order_info);

			return $data;
		}else{//详细
			$user_info = M('User')->where(array('id'=>$order_info['pay_money_user_id']))->find();
			if(!empty($user_info)){
				$order_detail_info =array_merge($user_info,$order_info);
			}else{
				$order_detail_info =$order_info;
			}
			$order_detail_info['serialize'] = unserialize($order_info['serialize']);
			if(!empty($order_info)){
				$data=array('status'=>1,'message'=>'成功.','data'=>$order_detail_info);
			}else{
				$data_tmp=array();
				$data_tmp['order_id']=$order_id;
				$data_tmp['field']=$field;
				$data_tmp['order_info']=$order_info;
				$data=array('status'=>0,'message'=>'失败2','data'=>$data_tmp);
			}
			
			return $data;
		}
	}
	/**
	 * 获取订单列表
	 * @param array $condition
	 * @param int $page_size
	 */
	public function get_order_list($condition,$page_size=10){
		$condition=array_filter($condition,"Yocms_del_empty");//去掉数组空值
		$result=array('status'=>0,'message'=>'错误','data'=>null);
		import('ORG.Util.Page');// 导入分页类
		$count      = $this->where($condition)->count();// 查询满足要求的总记录数
		$Page       = new Page($count,$page_size);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $this->where($condition)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$result=array(
				'status'=>1,
				'message'=>'成功',
				'data'=>array(
						'page'=>array(
								'count'=>$count,//文章总数
								'page_size'=>$page_size,
								'page'=>$Page->firstRow+1,
								'page_str'=>$Page->show(),
						),
						'list'=>$list
				),
		);
		return $result;
		// 		$this->assign('list',$list);// 赋值数据集
		// 		$this->assign('page',$show);// 赋值分页输出
		
	}
	/**
	 * 修改订单信息
	 * @param int $order_id
	 * @param int $order_num
	 * @param array $data
	 */
	public function update_order($order_id,$order_num,$data)
	{
		$result=array('status'=>0);
		if((empty($order_id)&&empty($order_num))||empty($data))
		{
			$result['message']='修改失败，id或数据为空';
			$result['data']=$data;
			return $result;
		}
		
		$data['update_time']=time();
		$condition = array();
		$condition = array('order_id'=>$order_id);
		if(empty($order_id))$condition=array('order_num'=>$order_num);
		$is_save=$this->where($condition)->save($data);
		
		if(!$is_save)
		{
		    $result['status']=0;
		    $result['message']='修改失败';
		}
		$result['status']=1;
		$result['message']='修改成功';
		return $result;
	}
	/**
	 * 订单成功后扣除余额、积分、优惠券等
	 * 余额严格意义虽然不算优惠，但是有相似的处理逻辑所以放这里处理且名词归类上放优惠策略里
	 * @param int $order_id
	 */
	public function use_promotions($order_id)
	{
	    $result=array('status'=>0);
// 	    $order_info = $this->where(array('order_id'=>$order_id))->find();
	    $get_order_result = $this->get_order_info($order_id=0,$isdetail=0,$field="order_id");
	    if(empty($get_order_result['data']))
	    {
	        $result['message']='订单不存在';
	        return $result;
	    }
	    if($get_order_result['data']['status']!=1 ||$get_order_result['data']['status']!=9)
	    {
	        $result['message']='订单未支付成功，不能使用券';
	        return $result;
	    }
	    if(!empty($order_info['use_coupon']))
	    {
	        //优惠券扣除
	         
	    }
	    if(!empty($order_info['use_funds']))
	    {
	        //余额扣除
	        $this->use_funds($order_id);
	    }
	    if(!empty($order_info['use_integral']))
	    {
	        //余额扣除
	        $this->use_integral($order_id);
	    }
	    if(!empty($order_info['use_goods']))
	    {
	        //以物换物|技能交换
	        $this->use_goods($order_id);
	    }
	    $result['status']=1;
	    $result['message']='扣减成功';
	    return $result;
	}
	/**
	 * 设置使用现金成功
	 * 支付主体扣减余额
	 * 收款主体增加余额
	 * @param int $order_id
	 */
	private function use_funds($order_id)
	{
	    $result=array('status'=>0);
	    if(empty($order_id))
	    {
	        $result['message']='订单号错误';
	        return $result;
	    }
	    
	    $model = new Model();
	    $User_model = D('User');
	    $Stores_model = D('Stores');
	    //事物开始
	    $model->startTrans();
	    
	    $is_user_pay_money =0;
	    $is_store_pay_money=0;
	    $is_user_get_money =0;
	    $is_store_get_money=0;
	    
	    $get_order_result = $this->get_order_info($order_id);//订单信息
	    //用户主体支付
	    if(!empty($get_order_result['data']['pay_money_user_id']))
	    {
	        $is_user_pay_money=1;
	    }
	    //商家主体支付
	    if(!empty($get_order_result['data']['pay_money_store_id']))
	    {
	        $is_store_pay_money=1;
	    }
	    //用户主体收款
	    if(!empty($get_order_result['data']['get_money_user_id']))
	    {
	        $is_user_get_money=1;
	    }
	    //商家主体收款
	    if(!empty($get_order_result['data']['get_money_store_id']))
	    {
	        $is_store_get_money=1;
	    }
	    if((empty($is_user_pay_money)&&empty($is_store_pay_money))||(empty($is_user_get_money)&&empty($is_store_get_money)))
	    {
	        $result['message']='支付者或收款者为空';
	        return $result;
	    }
	    //订单不存在
	    if(empty($get_order_result['data']))
	    {
	        $result['message']='查无此订单';
	        $result['data']['id']=$order_id;
	        return $result;
	    }
	    $pay_user_info_result = $User_model->get_user_info(array('id'=>$get_order_result['data']['pay_money_user_id']));//支付者信息(商家)
	    $pay_store_info_result = $Stores_model->$Stores_model->getStoreById(array('id'=>$get_order_result['data']['pay_money_store_id']));//支付者信息(商家)
	    $get_money_user_info_result = $User_model->get_user_info(array('id'=>$get_order_result['data']['get_money_user_id']));//支付者信息(商家)
	    $get_money_store_info_result = $Stores_model->$Stores_model->getStoreById(array('id'=>$get_order_result['data']['get_money_store_id']));//支付者信息(商家)
	    
	    //支付者余额扣减
	    if(!empty($get_order_result['data']['pay_money_user_id']))
	    {
	        $pay_user_update_data = array();
	        $pay_user_update_data['funds']=$pay_user_info_result['data']['funds'] - $get_order_result['data']['use_funds'];
	        $update_pay_user_result = $User_model->update_user_info_by_userid($get_order_result['data']['pay_money_user_id'],$pay_user_update_data);
	    }
        elseif(!empty($get_order_result['data']['pay_money_store_id']))
        {
            $pay_store_update_data = array();
	        $pay_store_update_data['funds']=$pay_store_info_result['data']['funds'] - $get_order_result['data']['use_funds'];
	        $update_pay_store_result = $User_model->update_storeById($get_order_result['data']['pay_money_store_id'],$pay_store_update_data);
        }
        else
        {
            $result['message']='支付者信息为空';
            return $result;
        }
        //售卖者增加现金
		if(!empty($get_order_result['data']['get_money_user_id']))
		{
			$get_money_update_data['funds']=$get_money_user_info_result['data']['funds']+$get_order_result['data']['pay_price'];
			$update_user_result = $User_model->update_user_info_by_userid($get_money_user_info_result['data']['id'],$get_money_update_data);
		}
		elseif(!empty($get_order_result['data']['get_money_store_id']))
		{
			$get_money_update_data['funds']=$get_money_store_info_result['data']['funds']+$get_order_result['data']['pay_price'];
			$update_store_result = $Stores_model->update_storeById($get_money_store_info_result['data']['id'],$get_money_update_data);
		}
		else
		{
		    $result['message']='收款者信息为空';
		    return $result;
		}
		if(($update_pay_user_result['status']<1 && $update_pay_store_result['status']<1)||($update_user_result['status']<1 &&$update_store_result['status']<1))
		{
		    //回滚
		    $model->rollback();
		}
		//事物提交
		$model->commit();
		$result['status']=1;
		return $result;
	}
	/**
	 * 设置使用积分成功
	 * 支付主体扣减积分
	 * 收款主体增加积分
	 * @param int $order_id
	 */
	private function use_integral($order_id)
	{
	    $result=array('status'=>0);
	    if(empty($order_id))
	    {
	        $result['message']='订单号错误';
	        return $result;
	    }
	     
	    $model = new Model();
	    $User_model = D('User');
	    $Stores_model = D('Stores');
	    //事物开始
	    $model->startTrans();
	     
	    $is_user_pay_money =0;
	    $is_store_pay_money=0;
	    $is_user_get_money =0;
	    $is_store_get_money=0;
	     
	    $get_order_result = $this->get_order_info($order_id);//订单信息
	    //用户主体支付
	    if(!empty($get_order_result['data']['pay_money_user_id']))
	    {
	        $is_user_pay_money=1;
	    }
	    //商家主体支付
	    if(!empty($get_order_result['data']['pay_money_store_id']))
	    {
	        $is_store_pay_money=1;
	    }
	    //用户主体收款
	    if(!empty($get_order_result['data']['get_money_user_id']))
	    {
	        $is_user_get_money=1;
	    }
	    //商家主体收款
	    if(!empty($get_order_result['data']['get_money_store_id']))
	    {
	        $is_store_get_money=1;
	    }
	    if((empty($is_user_pay_money)&&empty($is_store_pay_money))||(empty($is_user_get_money)&&empty($is_store_get_money)))
	    {
	        $result['message']='支付者或收款者为空';
	        return $result;
	    }
	    //订单不存在
	    if(empty($get_order_result['data']))
	    {
	        $result['message']='查无此订单';
	        $result['data']['id']=$order_id;
	        return $result;
	    }
	    $pay_user_info_result = $User_model->get_user_info(array('id'=>$get_order_result['data']['pay_money_user_id']));//支付者信息(商家)
	    $pay_store_info_result = $Stores_model->$Stores_model->getStoreById(array('id'=>$get_order_result['data']['pay_money_store_id']));//支付者信息(商家)
	    $get_money_user_info_result = $User_model->get_user_info(array('id'=>$get_order_result['data']['get_money_user_id']));//支付者信息(商家)
	    $get_money_store_info_result = $Stores_model->$Stores_model->getStoreById(array('id'=>$get_order_result['data']['get_money_store_id']));//支付者信息(商家)
	     
	    //支付者余额扣减
	    if(!empty($get_order_result['data']['pay_money_user_id']))
	    {
	        $pay_user_update_data = array();
	        $pay_user_update_data['integral']=$pay_user_info_result['data']['integral'] - $get_order_result['data']['use_integral'];
	        $update_pay_user_result = $User_model->update_user_info_by_userid($get_order_result['data']['pay_money_user_id'],$pay_user_update_data);
	    }
	    elseif(!empty($get_order_result['data']['pay_money_store_id']))
	    {
	        $pay_store_update_data = array();
	        $pay_store_update_data['integral']=$pay_store_info_result['data']['integral'] - $get_order_result['data']['use_integral'];
	        $update_pay_store_result = $User_model->update_storeById($get_order_result['data']['pay_money_store_id'],$pay_store_update_data);
	    }
	    else
	    {
	        $result['message']='支付者信息为空';
	        return $result;
	    }
	    //售卖者增加积分
	    if(!empty($get_order_result['data']['get_money_user_id']))
	    {
	        $get_money_update_data['integral']=$get_money_user_info_result['data']['integral']+$get_order_result['data']['use_integral'];
	        $update_user_result = $User_model->update_user_info_by_userid($get_money_user_info_result['data']['id'],$get_money_update_data);
	    }
	    elseif(!empty($get_order_result['data']['get_money_store_id']))
	    {
	        $get_money_update_data['integral']=$get_money_store_info_result['data']['integral']+$get_order_result['data']['use_integral'];
	        $update_store_result = $Stores_model->update_storeById($get_money_store_info_result['data']['id'],$get_money_update_data);
	    }
	    else
	    {
	        $result['message']='收款者信息为空';
	        return $result;
	    }
	    if(($update_pay_user_result['status']<1 && $update_pay_store_result['status']<1)||($update_user_result['status']<1 &&$update_store_result['status']<1))
	    {
	        //回滚
	        $model->rollback();
	    }
	    //事物提交
	    $model->commit();
	    $result['status']=1;
	    return $result;
	    
	}
	private function use_goods($order_id)
	{
	    
	}
	/**
	 * 站点余额支付
	 * @param int $order_id 订单唯一字段值
	 * @param int $user_id 用户id
	 * @param string $field 订单唯一字段
	 * return array
	 */
	public function pay_by_funds($order_id,$pay_user_id,$pay_store_id,$field='order_id')
	{
		$result=array('status'=>0);
		if(empty($order_id)){
		    $result['message']='id不能为空';
			return $result;
		}
		$model = new Model();
		$User_model = D('User');
		$Stores_model = D('Stores');
		//事物开始
		$model->startTrans();
		$is_user_pay_money =0;
	    $is_store_pay_money=0;
	    $is_user_get_money =0;
	    $is_store_get_money=0;
	    
	    $get_order_result = $this->get_order_info($order_id);//订单信息
	    //用户主体付款
		if(!empty($get_order_result['data']['pay_money_user_id']))
		{
		    $is_user_pay_money=1;
		}
		//商家主体付款
		if(!empty($get_order_result['data']['pay_money_store_id']))
		{
		    $is_store_pay_money=1;
		}
		//用户主体收款
		if(!empty($get_order_result['data']['get_money_user_id']))
		{
		    $is_user_get_money=1;
		}
		//商家主体收款
		if(!empty($get_order_result['data']['get_money_store_id']))
		{
		    $is_store_get_money=1;
		}
		if((empty($is_user_pay_money)&&empty($is_store_pay_money))||(empty($is_user_get_money)&&empty($is_store_get_money)))
		{
		    $result['message']='支付者或收款者为空';
		    return $result;
		}
		//订单不存在
		if(empty($get_order_result['data']))
		{
		    $result['message']='查无此订单';
		    $result['data']['id']=$order_id;
		    return $result;
		}
		
		if($is_user_pay_money)
		{
		    $pay_user_info_result = $User_model->get_user_info(array('id'=>$pay_user_id));
		}
		elseif($is_store_pay_money)
		{
		    $pay_store_info_result = $Stores_model->$Stores_model->getStoreById(array('id'=>$pay_store_id));//支付者信息(商家)
		}
		else
		{
		    $result['message']='支付者信息为空';
		    return $result;
		}
		if($is_user_get_money)
		{
			$get_money_user_info_result = $User_model->get_user_info(array('id'=>$get_order_result['data']['get_money_user_id']));
		}
		elseif($is_store_get_money)
		{
			$get_money_store_info_result = $Stores_model->$Stores_model->getStoreById(array('id'=>$get_order_result['data']['get_money_store_id']));//支付者信息(商家)
		}
		else{
		    $result['message']='收款者信息为空';
		    return $result;
		}
		
		//查询用户出错
		if($pay_user_info_result['status']<1)
		{
			return array('status'=>0,'message'=>$pay_user_info_result['message'],'data'=>$pay_user_info_result);
		}
		$get_money_user_or_store_funds=$pay_user_info_result['data']['funds']?$pay_user_info_result['data']['funds']:$pay_store_info_result['data']['funds'];
		if($get_money_user_or_store_funds>=$get_order_result['data']['pay_price'])
		{
		    $use_funds=$get_order_result['data']['pay_price'];
		    $pay_price=0;
		}
		else
		{
		    $use_funds=$get_money_user_or_store_funds;
		    $pay_price=$get_order_result['data']['pay_price']-$use_funds;
		}
		
		$order_update_data=array();
		$order_update_data['pay_money_user_id']=$pay_user_id;
		$order_update_data['pay_money_store_id']=$pay_store_id;
		$order_update_data['use_funds']=$use_funds;
		$order_update_data['pay_price']=$pay_price;
		$order_update_data['payment_method']=0;//付款方式|0：余额支付，1:积分支付，2:优惠券(现金券/兑换券/折扣券/)支付,3:以物易物支付,4:支付宝，5：财付通支付，6：货到付款，7信用卡支付，
		$order_update_data['status']=0;//0:等待买家付款，1支付成功，2支付失败，3取消,9已完成
		$order_update_data['update_time']=time();
		$update_order_result = $this->update_order($order_id,'',$order_update_data);
		if($update_order_result['status']<1)
		{
		    $result['status']=-3;
		    $result['message']='余额支付出错，请即刻处理';
		    //回滚
		    $model->rollback();
		    return $result;
		}
		//事物提交
	    $model->commit();
	    $result['status']=1;
	    $result['message']='余额支付设置成功';
	    return $result;
	}
	/**
	 * 积分支付,与人民币1:10
	 * @param int $order_id
	 * @param int $pay_user_id 支付者id(用户)
	 * @param int $pay_store_id 支付者id(商家)
	 * @param string $field 订单id 字段 唯一
	 */
	public function pay_by_integral($order_id=0,$pay_user_id=0,$pay_store_id=0,$field='order_id'){
		$result=array('status'=>0,'message'=>'修改错误','data'=>'');
		if(empty($order_id)){
			return array('status'=>0,'message'=>'id不能为空');
		}
		$model = new Model();
		$User_model = D('User');
		$Stores_model = D('Stores');
		$order_info = $this->where(array($field=>$order_id))->find();
		//事物开始
		$model->startTrans();
		//订单不存在
		if(empty($order_info)){
			$data_tmp=array();
			$data_tmp['order_id']=$order_id;
			$data_tmp['field']=$field;
			$data=array('status'=>0,'message'=>'失败1，查无此订单','data'=>$data_tmp);
			return $data;
		}
		if(!empty($pay_user_id))
		{
			$pay_user_info_result = $User_model->get_user_info(array('id'=>$pay_user_id));
			//查询用户出错
			if($pay_user_info_result['status']<1){
				return array('status'=>0,'message'=>$pay_user_info_result['message'],'data'=>$pay_user_info_result);
			}
			//站点积分不足以支付
			if($pay_user_info_result['data']['integral']<=0)
			{
			    return array('status'=>0,'message'=>'积分不足');
			}
			if($pay_user_info_result['data']['integral']>=$order_info['total_price'])
			{
			    $use_integral=$order_info['total_price'];
			    $pay_price=0;
			}
			else{
			    $use_integral=$pay_user_info_result['data']['integral'];
			    $pay_price=$order_info['total_price']-$use_integral;
			}
// 			$user_update_data = array();
// 			$user_update_data['integral']=$pay_user_info_result['data']['integral'] - $order_info['total_price'];
// 			$tmp = $User_model->update_user_info_by_userid($pay_user_id,$user_update_data);
		}
		elseif(!empty($pay_store_id))
		{
			$pay_store_info_result=$Stores_model-> $Stores_model->getStoreById(array('id'=>$pay_store_id));//支付者信息(商家)
			//查询用户出错
			if($pay_store_info_result['status']<1){
				return array('status'=>0,'message'=>$pay_store_info_result['message'],'data'=>$pay_store_info_result);
			}
			//站点积分不足以支付
			if($pay_store_info_result['data']['integral']<=0)
			{
			    return array('status'=>0,'message'=>'积分不足');
			}
			elseif($pay_store_info_result['data']['integral']>=$order_info['pay_price'])
			{
                $use_integral=$order_info['pay_price'];
                $pay_price=0;
			}
			else
			{
			    $use_integral=$pay_store_info_result['data']['integral'];
			    $pay_price=$order_info['total_price']-$use_integral;
			}
// 			$store_update_data = array();
// 			$store_update_data['integral']=$pay_store_info_result['data']['integral'] - $order_info['total_price'];
// 			$tmp = $Stores_model->update_storeById($pay_store_id,$store_update_data);
		}else{
			return array('status'=>0,'message'=>'支付者id为空','data'=>$pay_user_id);
		}
		
		//用户余额扣了之后修改订单状态,同时商品所属者积分增加
		$order_update_data=array();
		$order_update_data['pay_money_user_id']=$pay_user_id;
		$order_update_data['pay_money_store_id']=$pay_store_id;
		$order_update_data['use_integral']=$use_integral;
		$order_update_data['pay_price']=$pay_price;
		$order_update_data['payment_method']=1;//付款方式|0：余额支付，1:积分支付，2:优惠券(现金券/兑换券/折扣券/)支付,3:以物易物支付,4:支付宝，5：财付通支付，6：货到付款，7信用卡支付，
		$order_update_data['status']=0;//0:等待买家付款，1支付成功，2支付失败，3取消,9已完成
		$order_update_data['update_time']=time();
		$update_order_result = $this->update_order($order_id,'',$order_update_data);
		if($update_order_result['status']<1)
		{
		    //回滚
		    $model->rollback();
		    Log::write($pay_user_id.' 原积分:'.$pay_user_info_result['data']['integral'],'ERR');
		    $result['message']='积分支付出错，请即刻处理';
		    return $result;
		}
	    $model->commit();
	    $this->write_log(__METHOD__, $pay_user_id.' 原积分:'.$pay_user_info_result['data']['integral']);
	    $result['status']=1;
	    $result['message']='积分支付设置成功';
	    return $result;
	}
	/**
	 * 以物易物(技能交换)
	 * 交易成功则
	 * 售卖商品减库存
	 * 支付商品减库存
	 * @param int $order_id 必须
	 * @param int $pay_user_id 可选
	 * @param int $pay_store_id 可选
	 * @param int $pay_good_id 必须
	 * @param int $get_good_id 必须
	 * @param string $field 必须
	 * @return array
	 * 
	 */
	public function pay_by_barter($order_id,$pay_user_id=0,$pay_store_id=0,$pay_goods_id,$get_goods_id,$field='order_id')
	{
		Log::write(__METHOD__.' order_id:'.$order_id.' pay_user_id:'.$pay_user_id.' pay_store_id:'.$pay_store_id.' pay_goods_id:'.$pay_goods_id.' get_goods_id:'.$get_goods_id.' field'.$field,'INFO');
		$result=array('status'=>0);
		if(empty($order_id))
		{
		    $result['message']='订单id不能为空';
			return $result;
		}
		if(empty($pay_goods_id)||empty($get_goods_id))
		{
		    $result['message']='商品(技能)ID不能为空';
		    return $result;
		}
		$model = new Model();
		$User_model = D('User');
		$Goods_model = D('Goods');
		$Stores_model = D('Stores');
		//事物开始
		$model->startTrans();
		$order_info_result = $this->get_order_info($order_id,$isdetail=0,$field);//订单信息
		$pay_good_info_result = $Goods_model->getGoodById($pay_goods_id,$isdetail=0);//支付的商品信息
		$get_good_info_result = $Goods_model->getGoodById($get_goods_id,$isdetail=0);//购买的商品信息
		if(!empty($pay_user_id)){
			$pay_user_info_result = $User_model->get_user_info(array('id'=>$pay_user_id));//支付者信息(用户)
		}elseif(!empty($pay_store_id)){
			$pay_store_info_result=$Stores_model-> $Stores_model->getStoreById(array('id'=>$pay_store_id));//支付者信息(商家)
		}else{
			if($pay_good_info_result['data']['user_id']){
				$pay_user_info_result = $User_model->get_user_info(array('id'=>$pay_good_info_result['data']['user_id']));//支付者信息(用户)
			}elseif($pay_good_info_result['data']['store_id']){
				$pay_store_info_result=$Stores_model-> $Stores_model->getStoreById(array('id'=>$pay_good_info_result['data']['store_id']));//支付者信息(商家)
			}else{
				return array('status'=>0,'message'=>'支付的商品没有所属人,支付失败');
			}
		}
		if(!empty($get_good_info_result['data']['user_id'])){
			$receive_user_info_result = $User_model->get_user_info(array('id'=>$get_good_info_result['data']['user_id']));//商品所属用户
		}elseif(!empty($get_good_info_result['data']['store_id'])){
			$receive_store_info_result = $Stores_model->getStoreById(array('id'=>$get_good_info_result['data']['store_id']));//商品所属商家
		}else{
			return array('status'=>0,'message'=>'购买的商品所属用户未知||商品所属商家未知');
		}
		//查询订单错误
		if($order_info_result['status']<1){
			return array('status'=>0,'message'=>$order_info_result['message'],'data'=>$order_info_result['data']);
		}
		//查询用户出错
		if($pay_user_info_result['status']<1){
			return array('status'=>0,'message'=>$pay_user_info_result['message'],'data'=>$pay_user_info_result['data']);
		}
		if($receive_user_info_result['status']<1 && $receive_store_info_result['status']<1){
			return array('status'=>0,'message'=>$receive_user_info_result['message'],'data'=>$receive_user_info_result['data']);
		}
		//查询商品出错
		if($pay_good_info_result['status']<1){
			return array('status'=>0,'message'=>$pay_good_info_result['message'],'data'=>$pay_good_info_result);
		}
		//查询商品出错
		if($pay_good_info_result['status']<1){
			return array('status'=>0,'message'=>$pay_good_info_result['message'],'data'=>$pay_good_info_result);
		}
		if($pay_good_info_result['data']['quantity']<1){
			return array('status'=>0,'message'=>'当前交换的技能数量不足,请添加或者使用其他支付方式','data'=>$pay_good_info_result['data']);
		}
		$order_update_data=array();
		$order_update_data['pay_money_user_id']=$pay_user_id;
		$order_update_data['pay_money_store_id']=$pay_store_id;
		$order_update_data['get_money_store_id']=$receive_store_info_result['data']['store_id']?$receive_store_info_result['data']['store_id']:0;
		$order_update_data['get_money_user_id']=$receive_user_info_result['data']['user_id']?$receive_user_info_result['data']['user_id']:0;
		$order_update_data['goods_id']=$get_goods_id;
		$order_update_data['use_goods']=$order_info_result['data']['pay_price'];//初始值
		$order_update_data['payment_method']=3;//付款方式|0：余额支付，1:积分支付，2:优惠券(现金券/兑换券/折扣券/)支付,3:以物易物支付,4:支付宝，5：财付通支付，6：货到付款，7信用卡支付，
		//以物换物需另一方同意才能完成交易，故状态仍为0
		$order_update_data['status']=0;//0:等待买家付款，1支付成功，2支付失败，3取消,9已完成
		$order_update_data['update_time']=time();
		$is_save_result = $this->where(array($field=>$order_id))->save($order_update_data);
		if(!$is_save_result){
		    //回滚
		    $model->rollback();
		    $result['message']='失败';
		    return $result;
		}
		//交换成功则减库存
		//$goods_update_data=array();
		//$goods_update_data['quantity']=$pay_good_info_result['data']['quantity']-1;
		//$Goods_model->update_goodById($pay_good_info_result['data']['id'],$goods_update_data);
		$model->commit();
		$result['message']='设置交换成功，请等待用户接受';
		return $result;
	}
	/**
	 * 优惠券支付
	 * @param unknown $order_id
	 * @param number $pay_user_id
	 * @param number $pay_store_id
	 * @param unknown $serial_number
	 * @param unknown $serial_password
	 * @param string $field
	 * @return unknown
	 */
	public function pay_by_coupon($order_id,$pay_user_id=0,$pay_store_id=0,$serial_number,$serial_password,$field='order_id')
	{
	    $result = array('status'=>0);
	    if(empty($order_id))
	    {
	        $result['message']='订单号错误';
	        return $result;
	    }
	    $Coupon = D('Coupon');
	    $coupun_info_result = $Coupon->get_coupun_by_serial_number($serial_number);//优惠券信息
	    if(empty($coupun_info_result['data']))
	    {
	        $result['message']='券码不存在';
	        return $result;
	    }
	    $method_name='pay_by_coupon_'.$coupun_info_result['data']['type_id'];
	    if(!method_exists(__CLASS__, $method_name))
	    {
	        $result['message']=$method_name.'方法不存在';
	        return $result;
	    }
	    $pay_result = $this->$method_name($order_id,$pay_user_id,$pay_store_id,$serial_number,$serial_password,$field);
// 	    $pay_result = $this->pay_by_coupon_1($order_id,$pay_user_id,$pay_store_id,$serial_number,$serial_password,$field);
	    
	    if($pay_result['status']<1)
	    {
	        $result['message']=$pay_result['message'];
	        return $result;
	    }
		$order_coupon_data=array();
		$order_coupon_data['order_id']=$order_id;
		$order_coupon_data['serial_number']=$serial_number;
		$order_coupon_data['status']=0;
		$is_order_coupon_add = $this->add_order_coupon($order_coupon_data);
		
		$result['status']=1;
		return $result;
	}
	/**
	 * 代金券支付
	 * 成功则
	 * 扣减金额
	 * @param int $order_id 必须
	 * @param int $pay_user_id 可选
	 * @param int $pay_store_id 可选
	 * @param int $pay_good_id 必须
	 * @param int $get_good_id 必须
	 * @param string $field 必须
	 * @return array
	 *
	 */
	private function pay_by_coupon_1($order_id,$pay_user_id=0,$pay_store_id=0,$serial_number,$serial_password,$field='order_id')
	{
		Log::write(__CLASS__.':'.__FUNCTION__.' order_id:'.$order_id.' pay_user_id:'.$pay_user_id.' pay_store_id:'.$pay_store_id.' serial_number:'.$serial_number.' field'.$field,'INFO');
		$result=array('status'=>0);
		if(empty($order_id)){
			return array('status'=>0,'message'=>'订单id不能为空');
		}
		if(empty($serial_number)){
			return array('status'=>0,'message'=>'优惠券不能为空');
		}
		$model = new Model();
		$User_model = D('User');
		$Goods_model = D('Goods');
		$Stores_model = D('Stores');
		$Coupon = D('Coupon');
		//事物开始
		$model->startTrans();
		$order_info_result = $this->get_order_info($order_id,$isdetail=0,$field);//订单信息
		$good_info_result = $Goods_model->getGoodById($order_info_result['data']['goods_id'],$isdetail=0);//商品信息
		$coupun_info_result = $Coupon->get_coupun_by_serial_number($serial_number);//优惠券信息
		if(!empty($pay_user_id))
		{
			$pay_user_info_result = $User_model->get_user_info(array('id'=>$pay_user_id));//支付者信息(用户)
		}
		elseif(!empty($pay_store_id))
		{
			$pay_store_info_result=$Stores_model-> $Stores_model->getStoreById(array('id'=>$pay_store_id));//支付者信息(商家)
		}
		if($pay_user_info_result['status']<1 && $pay_store_info_result['status']<1)
		{
			return array('status'=>0,'message'=>'支付者用户id有误,查无此用户','data'=>$pay_store_info_result['data']);
		}
		//查询订单错误
		if($order_info_result['status']<1){
			return array('status'=>0,'message'=>$order_info_result['message'],'data'=>$order_info_result['data']);
		}
		if($coupun_info_result['data']['type_id']!=2)
		{
		    $result['message']='非现金券';
		    return $result;
		}
		if($coupun_info_result['status']<1)
		{
			return array('status'=>0,'message'=>$coupun_info_result['message'],'data'=>$coupun_info_result['data']);
		}
		if(!empty($coupun_info_result['data']['password'])&&($coupun_info_result['data']['password']!=$serial_password))
		{
			//优惠券密码错误
			return array('status'=>0,'message'=>'优惠券密码错误','data'=>$coupun_info_result['data']);
		}
		if($coupun_info_result['data']['remain_value']<=0)
		{
			//代金券已用完
			return array('status'=>0,'message'=>'代金券已用完','data'=>$coupun_info_result['data']);
		}
		if($coupun_info_result['data']['total_value']<=0)
		{
		    //代金券已用完
		    return array('status'=>0,'message'=>'代金券已用完.','data'=>$coupun_info_result['data']);
		}
		if($good_info_result['status']>0 && $good_info_result['data']['quantity']<$order_info_result['buy_quantity'])
		{
		    //商品库存不足
		    return array('status'=>0,'message'=>'商品库存不足','data'=>$coupun_info_result['data']);
		}
// 		if($coupun_info_result['data']['remain_value']<=$order_info_result['data']['pay_price'])
// 		{
// 			//代金券不足
// 			return array('status'=>0,'message'=>'代金券不足','data'=>$coupun_info_result['data']);
// 		}
        if($coupun_info_result['data']['remain_value']>=$order_info_result['data']['total_price'])
        {
            $coupon_update_data=array();
            $coupon_update_data['remain_value']=$coupun_info_result['data']['remain_value']-$order_info_result['data']['total_price'];//减现金券
            $use_coupon=$order_info_result['data']['pay_price'];
            $pay_price=0;
        }
		else
		{
		    $coupon_update_data['remain_value']=0;//减现金券
		    $use_coupon=$coupun_info_result['data']['remain_value'];
		    $pay_price=$order_info_result['data']['total_price']-$use_coupon;
		}
// 		$update_coupon_result = $Coupon->update_couponById($coupun_info_result['data']['id'], $coupon_update_data);
		
		$order_update_data=array();
		$order_update_data['pay_money_user_id']=$pay_user_id;
		$order_update_data['pay_money_store_id']=$pay_store_id;
		$order_update_data['use_coupon']=$use_coupon;
		$order_update_data['pay_price']=$pay_price;
		$order_update_data['payment_method']=2;////付款方式|0：余额支付，1:积分支付，2:优惠券(现金券/兑换券/折扣券/)支付,3:以物易物支付,4:支付宝，5：财付通支付，6：货到付款，7信用卡支付，
		$order_update_data['status']=0;//0:等待买家付款，1支付成功，2支付失败，3取消,9已完成
		$order_update_data['update_time']=time();
		$is_order_save = $this->where(array($field=>$order_id))->save($order_update_data);
		
		if(!$is_order_save)
		{
			//支付成功则减库存
// 			$goods_update_data=array();
// 			$goods_update_data['quantity']=$good_info_result['data']['quantity']-$order_info_result['buy_quantity'];
// 			$Goods_model->update_goodById($good_info_result['data']['goods_id'],$goods_update_data);
// 			if($good_info_result['user_id']>0){
// 				$increase_funds_result = $this->increase_funds($good_info_result['user_id'],'',$order_info_result['data']['pay_price']);
// 			}elseif($good_info_result['store_id']>0)
// 			{
// 				$increase_funds_result = $this->increase_funds('',$good_info_result['store_id'],$order_info_result['data']['pay_price']);
// 			}else{
// 				$increase_funds_result=-3;
// 			}
		    //失败回滚
		    $model->rollback();
		    $result['message']='失败';
		    return $result;
		}
		//提交事物
		$model->commit();
		$result['status']=1;
		$result['message']='请确认订单';
		return $result;
	}
	/**
	 * 兑换券支付
	 * 成功则
	 * 扣减金额
	 * @param int $order_id
	 * @param int $pay_user_id
	 * @param int $pay_store_id
	 * @param string $serial_number
	 * @param string $serial_password
	 * @param string $field
	 */
	private function pay_by_coupon_2($order_id,$pay_user_id=0,$pay_store_id=0,$serial_number,$serial_password,$field='order_id')
	{
	    Log::write(__CLASS__.':'.__FUNCTION__.' order_id:'.$order_id.' pay_user_id:'.$pay_user_id.' pay_store_id:'.$pay_store_id.' serial_number:'.$serial_number.' field'.$field,'INFO');
	    $result=array('status'=>0);
	    if(empty($order_id)){
	        return array('status'=>0,'message'=>'订单id不能为空');
	    }
	    if(empty($serial_number)){
	        return array('status'=>0,'message'=>'优惠券不能为空');
	    }
	    $model = new Model();
	    $User_model = D('User');
	    $Goods_model = D('Goods');
	    $Stores_model = D('Stores');
	    $Coupon = D('Coupon');
	    //事物开始
	    $model->startTrans();
	    $order_info_result = $this->get_order_info($order_id,$isdetail=0,$field);//订单信息
	    $good_info_result = $Goods_model->getGoodById($order_info_result['data']['goods_id'],$isdetail=0);//商品信息
	    $coupun_info_result = $Coupon->get_coupun_by_serial_number($serial_number);//优惠券信息
	    if(!empty($pay_user_id))
	    {
	        $pay_user_info_result = $User_model->get_user_info(array('id'=>$pay_user_id));//支付者信息(用户)
	    }
	    elseif(!empty($pay_store_id))
	    {
	        $pay_store_info_result=$Stores_model-> $Stores_model->getStoreById(array('id'=>$pay_store_id));//支付者信息(商家)
	    }
	    if($pay_user_info_result['status']<1 && $pay_store_info_result['status']<1)
	    {
	        return array('status'=>0,'message'=>'支付者用户id有误,查无此用户','data'=>$pay_store_info_result['data']);
	    }
	    //查询订单错误
	    if($order_info_result['status']<1){
	        return array('status'=>0,'message'=>$order_info_result['message'],'data'=>$order_info_result['data']);
	    }
	    if($coupun_info_result['data']['type_id']!=2)
	    {
	        $result['message']='非兑换券';
	        return $result;
	    }
	    if($coupun_info_result['status']<1)
	    {
	        return array('status'=>0,'message'=>$coupun_info_result['message'],'data'=>$coupun_info_result['data']);
	    }
	    if(!empty($coupun_info_result['data']['password'])&&($coupun_info_result['data']['password']!=$serial_password))
	    {
	        //优惠券密码错误
	        return array('status'=>0,'message'=>'优惠券密码错误','data'=>$coupun_info_result['data']);
	    }
	    if($coupun_info_result['data']['remain_value']<=0)
	    {
	        //代金券已用完
	        return array('status'=>0,'message'=>'兑换券已用完','data'=>$coupun_info_result['data']);
	    }
	    if($coupun_info_result['data']['total_value']<=0)
	    {
	        //代金券已用完
	        return array('status'=>0,'message'=>'兑换已用完.','data'=>$coupun_info_result['data']);
	    }
	    if(!empty($good_info_result['data']) && $good_info_result['status']>0 && $good_info_result['data']['quantity']<$order_info_result['buy_quantity'])
	    {
	        //商品库存不足
	        $result['message']='商品库存不足';
	        return $result;
	    }
		
		if(!empty($order_info_result['data']['goods_id']))
		{
		    $goods_unit_price=$order_info_result['data']['total_price']/$order_info_result['buy_quantity'];
		    $use_coupon=$coupun_info_result['data']['remain_value']*$goods_unit_price;
		    $pay_price=$order_info_result['data']['total_price']-$use_coupon;
		}
        

	    // $update_coupon_result = $Coupon->update_couponById($coupun_info_result['data']['id'], $coupon_update_data);
	    
	    $order_update_data=array();
	    $order_update_data['pay_money_user_id']=$pay_user_id;//支付者
	    $order_update_data['pay_money_store_id']=$pay_store_id;//支付者
	    $order_update_data['use_coupon']=$use_coupon;//优惠券抵消的金额
	    $order_update_data['pay_price']=$pay_price;//最后支付的金额
	    $order_update_data['payment_method']=2;////付款方式|0：余额支付，1:积分支付，2:优惠券(现金券/兑换券/折扣券/)支付,3:以物易物支付,4:支付宝，5：财付通支付，6：货到付款，7信用卡支付，
	    $order_update_data['status']=0;//0:等待买家付款，1支付成功，2支付失败，3取消,9已完成
	    $order_update_data['update_time']=time();
	    $is_order_save = $this->where(array($field=>$order_id))->save($order_update_data);
	    
	    if(!$is_order_save)
	    {
	        //失败回滚
	        $model->rollback();
	        $result['message']='失败';
	        return $result;
	    }
	    //提交事物
	    $model->commit();
	    $result['status']=1;
	    $result['message']='请确认订单';
	    return $result;
	    
	}
	/**
	 * 取消余额支付
	 * @param int $order_id
	 */
	public function cancel_use_funds($order_id)
	{
	    $result = array('status'=>0);
	    if(empty($order_id))
	    {
	        $result['message']='订单id不能为空';
	        return $result;
	    }
	    $order_info_result = $this->get_order_info($order_id);
	    if(empty($order_info_result['data']))
	    {
	        $result['message']='订单为空';
	        return $result;
	    }

	    $model = new Model();
	    $User_model = D('User');
	    $Stores_model = D('Stores');
	    //事物开始
	    $model->startTrans();
	    
	    $pay_user_info_result = $User_model->get_user_info(array('id'=>$order_info_result['data']['pay_money_user_id']));
	    
	    //订单恢复原价
	    //余额支付字段改为0
	    $update_order_data=array();
	    $update_order_data['use_funds']=0;
	    $update_order_data['pay_price']=$order_info_result['data']['pay_price']+$order_info_result['data']['use_funds'];
	    $update_order_result = $this->update_order($order_id,'',$update_order_data);
	    if($update_order_result['status']<1)
	    {
	        $result['message']='取消余额支付失败';
	        return $result;
	    }
	    if($order_info_result['data']['status']==9)
	    {
	        //如果已完成
    	    //余额退回用户
    	    $update_user_data=array();
    	    $update_user_data['funds']=$pay_user_info_result['data']['funds']+$order_info_result['data']['use_funds'];
    	    $update_user_result = $User_model->update_user_info_by_userid($order_info_result['data']['pay_money_user_id'],$update_user_data);
    	    if($update_user_result['status']<1)
    	    {
    	        //回滚
    	        $model->rollback();
    	        $result['message']='取消余额支付失败.';
    	        return $result;
    	    }
	    }
	    $model->commit();
	    $result['message']='已取消余额支付';
	    return $result;
	}
	/**
	 * 取消积分支付,与人民币1:10
	 * @param int $order_id
	 */
	public function cancel_use_integral($order_id)
	{
	    $result = array('status'=>0);
	    if(empty($order_id))
	    {
	        $result['message']='订单id不能为空';
	        return $result;
	    }
	    $order_info_result = $this->get_order_info($order_id);
	    if(empty($order_info_result['data']))
	    {
	        $result['message']='订单为空';
	        return $result;
	    }

	    $model = new Model();
	    $User_model = D('User');
	    $Stores_model = D('Stores');
	    //事物开始
	    $model->startTrans();
	    
	    $pay_user_info_result = $User_model->get_user_info(array('id'=>$order_info_result['data']['pay_money_user_id']));
	    
	    //订单恢复原价
	    //积分支付字段改为0
	    $update_order_data=array();
	    $update_order_data['use_integral']=0;
	    $update_order_data['pay_price']=$order_info_result['data']['pay_price']+$order_info_result['data']['use_integral']/10;
	    $update_order_result = $this->update_order($order_id,'',$update_order_data);
	    if($update_order_result['status']<1)
	    {
	        $result['message']='取消积分支付失败';
	        return $result;
	    }
	    if($order_info_result['data']['status']==9)
	    {
	        //如果已完成
    	    //积分退回用户
    	    $update_user_data=array();
    	    $update_user_data['integral']=$pay_user_info_result['data']['integral']+$order_info_result['data']['use_integral'];
    	    $update_user_result = $User_model->update_user_info_by_userid($order_info_result['data']['pay_money_user_id'],$update_user_data);
    	    if($update_user_result['status']<1)
    	    {
    	        //回滚
    	        $model->rollback();
    	        $result['message']='取消积分失败.';
    	        return $result;
    	    }
	    }
	    $model->commit();
	    $result['message']='已取消积分支付';
	    return $result;
	}
	/**
	 * 取消物物交换
	 * @param int $order_id
	 */
	public function cancel_use_barter($order_id)
	{
	    $result = array('status'=>0);
	    if(empty($order_id))
	    {
	        $result['message']='订单id不能为空';
	        return $result;
	    }
	    $order_info_result = $this->get_order_info($order_id);
	    if(empty($order_info_result['data']))
	    {
	        $result['message']='订单为空';
	        return $result;
	    }

	    $model = new Model();
	    $User_model = D('User');
	    $Stores_model = D('Stores');
	    $Goods_model = D('Goods');
	    //事物开始
	    $model->startTrans();
	    
	    $pay_user_info_result = $User_model->get_user_info(array('id'=>$order_info_result['data']['pay_money_user_id']));
	    $get_use_goods_result = $Goods_model->getGoodById($order_info_result['use_goods_id']);
	    //订单恢复原价
	    //积分支付字段改为0
	    $update_order_data=array();
	    $update_order_data['use_goods_id']=0;
	    $update_order_data['pay_price']=$get_use_goods_result['data']['price'];
	    $update_order_result = $this->update_order($order_id,'',$update_order_data);
	    if($update_order_result['status']<1)
	    {
	        $result['message']='取消余额支付失败';
	        return $result;
	    }
	    if($order_info_result['data']['status']==9)
	    {
	        //如果已完成
    	    //支付退回用户
    	    $update_goods_data=array();
    	    $update_goods_data['quantity']=$get_use_goods_result['data']['quantity']+1;
    	    $update_goods_result = $Goods_model->update_user_info_by_userid($order_info_result['data']['pay_money_user_id'],$update_goods_data);
    	    if($update_goods_result['status']<1)
    	    {
    	        //回滚
    	        $model->rollback();
    	        $result['message']='取消物物交换失败.';
    	        return $result;
    	    }
	    }
	    $model->commit();
	    $result['message']='已取消物物支付';
	    return $result;
	    
	}
	/**
	 * 取消使用优惠券
	 * 恢复价格
	 * @param int $order_id
	 */
	public function cancel_use_coupon($order_id)
	{
	    $result = array('status'=>0);
	    if(empty($order_id))
	    {
	        $result['message']='订单id不能为空';
	        return $result;
	    }
	    $order_info_result = $this->get_order_info($order_id);
	    if(empty($order_info_result['data']))
	    {
	        $result['message']='订单为空';
	        return $result;
	    }
	    if(empty($order_info_result['data']['use_coupon']))
	    {
	        $result['message']='此订单没有使用优惠券';
	        return $result;
	    }
	    $User_model = D('User');
	    $Coupon_model = D('Coupon');
	    
	    $order_coupon_condition=array();
	    $order_coupon_condition['order_id']=$order_id;
	    $get_order_coupon_result = $this->get_order_coupon($order_coupon_condition);
	    $pay_user_info_result = $User_model->get_user_info(array('id'=>$order_info_result['data']['pay_money_user_id']));
	    $coupon_info_result = $Coupon_model->get_coupun_by_serial_number($get_order_coupon_result['data']['serial_number']);
	    
	    $method_name='cancel_use_coupon_type_'.$coupon_info_result['data']['type_id'];
	    if(!method_exists(__CLASS__, $method_name))
	    {
	        $result['message']=$method_name.'方法不存在';
	        return $result;
	    }
	    
	    $cancel_result = $this->$method_name($order_id,$order_info_result['data'],$coupon_info_result['data']);
	    if($cancel_result['status']<1)
	    {
	        $result['message']='取消使用优惠券失败';
	        return $result;
	    }
	    
	    $order_coupon_condition=array();
	    $order_coupon_data=array();
	    $order_coupon_condition['order_id']=$order_id;
	    $order_coupon_data['status']=2;
	    $update_order_coupon_result = $this->update_order_coupon($order_coupon_condition, $order_coupon_data);
	    if($update_order_coupon_result['status']<1)
	    {
	        $result['message']='取消失败！';
	        return $result;
	    }
	    $result['status']=1;
	    $result['message']='取消成功';
	    return $result;
	}
	/**
	 * 取消使用优惠券-现金券
	 * @param int $order_id
	 * @return multitype:number string
	 */
	private function cancel_use_coupon_type_1($order_id,$order_info,$coupon_info)
	{
	    $result = array('status'=>0);
	    if(empty($order_id))
	    {
	        $result['message']='订单id不能为空';
	        return $result;
	    }

	    $model = new Model();
	    $Coupon_model = D('Coupon');
	    //事物开始
	    $model->startTrans();
	    
	    if(empty($coupon_info))
	    {
    	    $order_coupon_condition=array();
    	    $order_coupon_condition['order_id']=$order_id;
    	    $get_order_coupon_result = $this->get_order_coupon($order_coupon_condition);
    	    $get_coupon_info_result = $Coupon_model->get_coupun_by_serial_number($get_order_coupon_result['data']['serial_number']);
    	    $coupon_info=$get_coupon_info_result['data'];
	    }
	    if(empty($coupon_info))
	    {
	        $result['message']='券码不存在';
	        return $result;
	    }
	    if($coupon_info['type_id']!=1)
	    {
	        $result['message']='此券码非现金券';
	        return $result;
	    }
	    //订单价格恢复
	    //优惠券支付字段改为0
	    $update_order_data=array();
	    $update_order_data['use_coupon']=0;
	    $update_order_data['pay_price']=$order_info['pay_price']+$order_info['use_coupon'];
	    $update_order_result = $this->update_order($order_id,'',$update_order_data);
	    if($update_order_result['status']<1)
	    {
	        $result['message']='取消现金券支付失败';
	        return $result;
	    }
	    if($order_info['status']==9 ||$order_info['status']==1)
	    {
	        //如果已完成则
	        //现金券使用额退回
	        $update_coupon_data=array();
	        $update_coupon_data['remain_value']=$coupon_info['remain_value']+$order_info['use_coupon'];
	        $update_coupon_result = $Coupon_model->update_couponById($coupon_info['id'], $update_coupon_data);
	        
	        if($update_coupon_result['status']<1)
	        {
	            //回滚
	            $model->rollback();
	            $result['message']='取消现金券失败.';
	            return $result;
	        }
	    }
	    $model->commit();
	    $result['message']='已取消现金券支付';
	    return $result;
	}
	/**
	 * 取消使用优惠券-兑换券
	 * @param unknown $order_id
	 * @return multitype:number string
	 */
	private function cancel_use_coupon_type_2($order_id,$order_info,$coupon_info)
	{
	    $result = array('status'=>0);
	    if(empty($order_id))
	    {
	        $result['message']='订单id不能为空';
	        return $result;
	    }
	    
	    $model = new Model();
	    $Coupon_model = D('Coupon');
	    //事物开始
	    $model->startTrans();
	    
	    if(empty($coupon_info))
	    {
    	    $order_coupon_condition=array();
    	    $order_coupon_condition['order_id']=$order_id;
    	    $get_order_coupon_result = $this->get_order_coupon($order_coupon_condition);
    	    $get_coupon_info_result = $Coupon_model->get_coupun_by_serial_number($get_order_coupon_result['data']['serial_number']);
    	    $coupon_info=$get_coupon_info_result['data'];
	    }
	    if(empty($coupon_info))
	    {
	        $result['message']='券码不存在';
	        return $result;
	    }
	    if($coupon_info['type_id']!=2)
	    {
	        $result['message']='此券码非兑换券';
	        return $result;
	    }
	    //订单恢复原价
	    //优惠券支付字段改为0
	    $update_order_data=array();
	    $update_order_data['use_coupon']=0;
	    $update_order_data['pay_price']=$order_info['total_price'];
	    $update_order_result = $this->update_order($order_id,'',$update_order_data);
	    if($update_order_result['status']<1)
	    {
	        $result['message']='取消兑换券支付失败';
	        return $result;
	    }
	    if($order_info['status']==9||$order_info['status']==1)
	    {
	        //如果已完成则
    	    //兑换券使用额退回
    	    $update_coupon_data=array();
    	    $update_coupon_data['remain_value']=$coupon_info['remain_value']+1;
    	    $update_coupon_result = $Coupon_model->update_couponById($coupon_info['id'], $update_coupon_data);
    	    if($update_coupon_result['status']<1)
    	    {
    	        //回滚
    	        $model->rollback();
    	        $result['message']='取消兑换券支付失败.';
    	        return $result;
    	    }
	    }
	    $model->commit();
	    $result['message']='已取兑换券支付';
	    return $result;
	}
	/**
	 * 取消订单
	 * @param int $order_id
	 */
	public function cancel_order($order_id)
	{
	    $result = array('status'=>0);
	    if(empty($order_id))
	    {
	        $result['message']='订单id不能为空';
	        return $result;
	    }
	    $order_info_result = $this->get_order_info($order_id);
	    if(empty($order_info_result['data']))
	    {
	        $result['message']='订单为空';
	        return $result;
	    }
	    if($order_info_result['data']['status']==9)
	    {
	        //恢复价格
	        //退回余额|退回积分|退回物|退回优惠券
	        $this->cancel_use_funds($order_id);
	        $this->cancel_use_integral($order_id);
	        $this->cancel_use_barter($order_id);
	        $this->cancel_use_coupon($order_id);
	    }
	    else
	    {
	        //恢复价格
	        $this->cancel_use_funds($order_id);
	        $this->cancel_use_integral($order_id);
	        $this->cancel_use_barter($order_id);
	        $this->cancel_use_coupon($order_id);
	    }
	    $update_order_data=array();
	    $update_order_data['status']=2;
	    $update_order_result = $this->update_order($order_id,'',$update_order_data);
	    
	    $result['message']='订单已取消';
	    return $result;
	}
// 	public function cancel_use_coupon($order_id)
// 	{
// 	    $cancel_funds_result = $this->cancel_use_funds($order_id);
// 	    $cancel_integral_result = $this->cancel_use_integral($order_id);
// 	    $cancel_barter_result = $this->cancel_use_barter($order_id);
// 	    $cancel_coupon_result = $this->cancel_use_coupon($order_id);
	    
// 	}
	/**
	 * 获取订单优惠券信息
	 * @param array $condition
	 * @return multitype:number unknown
	 */
	public function get_order_coupon($condition,$field)
	{
	    $result=array('status'=>0);
	    if(empty($condition))
	    {
	        $result['message']='条件为空';
	        return $result;
	    }
	    $Order_coupon = M('Order_coupon');
	    $order_coupon_info = $Order_coupon->where($condition)->field($field)->order('id desc')->find();
	    $result['status']=1;
	    $result['data']=$order_coupon_info;
	    return $result;
	}
	/**
	 * 添加优惠券信息到表
	 * @param array $order_coupon_data
	 */
	public function add_order_coupon($order_coupon_data)
	{
	    $result=array('status'=>0);
	    if(empty($order_coupon_data))
	    {
	        $result['message']='数据为空';
	        return $result;
	    }
	    $order_coupon_data['add_time']=time();
	    $Order_coupon = M('Order_coupon');
	    $is_add = $Order_coupon->data($order_coupon_data)->add();
	    if(!$is_add)
	    {
	        $result['message']='添加优惠失败';
	        return $result;
	    }
	    $result['status']=1;
	    $result['message']='添加优惠成功';
	    return $result;
	}
	/**
	 * 修改订单优惠券
	 * @param array $condition
	 * @param array $order_coupon_data
	 */
	public function update_order_coupon($condition,$order_coupon_data)
	{
	    $result=array('status'=>0);
	    if(empty($order_coupon_data))
	    {
	        $result['message']='数据为空';
	        return $result;
	    }
	    if(empty($condition))
	    {
	        $result['message']='条件为空';
	        return $result;
	    }
	    $data['update_time']=time();
	    $is_save = $this->where($condition)->save($data);
	    if(!$is_save)
	    {
	        // 根据条件保存修改的数
	        $result['message']='修改失败';
	        return $result;
	    }
	    $result['status']=1;
	    $result['message']='修改成功';
	    return $result;
	}
	/**
	 * 用户或商家增加资金
	 * @param int $increase_user_id 增加的用户
	 * @param int $increase_store_id 增加的商家
	 * @param float $increase_funds 增加多少金额
	 */
	private function increase_funds($increase_user_id,$increase_store_id,$increase_funds)
	{
		Log::write(__METHOD__.' increase_user_id:'.$increase_user_id.' increase_store_id:'.$increase_store_id.' increase_funds:'.$increase_funds,'INFO');
		$result = array('status'=>0);
		if(empty($increase_user_id)&&empty($increase_store_id))
		{
		    $result['message']='ID为空';
		    return $result;
		}
		if(!empty($increase_user_id))
		{
			$User_model = D('User');
			$is_set_inc=$User_model->where(array('id'=>$increase_user_id))->setInc('funds',$increase_funds);//延迟60秒更新
			if(!$is_set_inc)
			{
			    $result['message']='增加现金失败';
				return $result;
			}
		}
		elseif(!empty($increase_store_id))
		{
			$Stores_model = D('Stores');
			$is_set_inc=$Stores_model->where(array('id'=>$increase_store_id))->setInc('funds',$increase_funds);//金额+$order_info_result['data']['pay_price']，延迟60秒更新
		    if(!$is_set_inc)
			{
			    $result['message']='增加现金失败';
				return $result;
			}
		}
		$result['status']=1;
		$result['message']='增加现金成功';
		Log::write(var_export($result,TRUE), Log::INFO);
		return $result;
	}
	/**
	 * 用户或商家增加资金
	 * @param int $increase_user_id 减少的用户
	 * @param int $increase_store_id 减少的商家
	 * @param float $increase_funds 减少多少金额
	 */
	private function decrease_funds($increase_user_id,$increase_store_id,$increase_funds)
	{
	    $this->write_log(__METHOD__,' increase_user_id:'.$increase_user_id.' increase_store_id:'.$increase_store_id.' increase_funds:'.$increase_funds);
		$result = array('status'=>0);
		if(!empty($increase_user_id))
		{
			$User_model = D('User');
			$is_set_dec=$User_model->where(array('id'=>$increase_user_id))->setDec('funds',$increase_funds);//金额+$order_info_result['data']['pay_price']，延迟60秒更新
		    if(!$is_set_dec)
			{
			    $result['message']='扣减现金失败';
				return $result;
			}
		}
		elseif(!empty($increase_store_id))
		{
			$Stores_model = D('Stores');
			$is_set_dec=$Stores_model->where(array('id'=>$increase_store_id))->setDec('funds',$increase_funds);//金额+$order_info_result['data']['pay_price']，延迟60秒更新
		    if(!$is_set_dec)
			{
			    $result['message']='扣减现金失败';
			    $result['data']['user_id']=$increase_user_id;
			    $result['data']['store_id']=$increase_store_id;
			    $this->write_log(__METHOD__,$result);
				return $result;
			}
		}
		$result['status']=1;
		$result['message']='扣减成功';
		$this->write_log(__METHOD__,$result);
		return $result;
	}
	/**
	 * 写日志
	 * @param unknown $log_data
	 * @param string $level
	 */
	private function write_log($method,$log_data,$level=Log::INFO)
	{
	    self::IS_LOG ? write_log($method,$log_data,$level=Log::INFO):'';
	}
}