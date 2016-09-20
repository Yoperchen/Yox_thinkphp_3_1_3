<?php
/**
 * 收费缴费
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class TollModel extends Model {
	const formula_low_price = 1;//最低价
	const formula_standard_price = 2;//标准价
	const formula_up_settlement_price = 3;//对上结算价
	const formula_down_settlement_price = 4;//对下结算价
	const formula_discounts_price = 5;//standard_price*discounts 标准折扣价
	
	// 定义自动验证
	protected $_validate    =   array(
			array('title','require','标题忘了输入了吧~&nbsp└(^o^)┘'),

	);
	// 定义自动完成
	//protected $_auto    =   array(
			//array('create_time','time',1,'function'),
	//);
	/**
	 * 添加文章
	 * @param array $data
	 */
	public function add_toll($data){
		$data=array_filter($data);//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		
		$result=array('status'=>0,'message'=>'data不能为空');
		if(empty($data)){
			return $result;
		}
		if(!empty($data['price_strategy'])){
			$data['total_cost']=$this->get_total_price_by_price_strategy($data['price_strategy']);//根据价格策略获取总价
		}
		$id=$this->data($data)->add();
		if($id){
			$result=array('status'=>1,'message'=>'成功',
					'data'=>$data
			);
		}
			return $result;

	}
	/**
	 * 
	 * @param number $id
	 * @param number $isdetail
	 * @return array
	 */
	public function getTollById($id=0,$isdetail=0){
		if(empty($id)){ 
			$result=array('status'=>0,'message'=>'id不能为空');
			return $result;
		}
		if($isdetail==0){
			$toll_info = $this->where(array('id'=>$id))->find();
			$result=array('status'=>1,'message'=>'成功','data'=>$toll_info);
			return $result;
		}else{//详细
			$toll_info		 = $this->where(array('id'=>$id))->find();
			$users_info = M('User')->where(array('id'=>$toll_info['user_id']))->find();
			$toll_info		 =array_merge_recursive($toll_info,$users_info);
			$result=array('status'=>1,'message'=>'成功','data'=>$toll_info);
			return $result;
		}
		
	} 
	/**
	 * 文章列表
	 * @param array $condition
	 * @param number $page_size
	 * @return array
	 */
	public function get_toll_list($condition,$page_size=20){
		$condition=array_filter($condition,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$result=array('status'=>0,'message'=>'错误','data'=>null);
		import('ORG.Util.Page');// 导入分页类
		$count      = $this->where($condition)->count();// 查询满足要求的总记录数
		$Page       = new Page($count,$page_size);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $this->where($condition)->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
		if(!empty($list)){
			$result=array(
					'status'=>1,
					'message'=>'成功',
					'data'=>array(
						'page'=>array(
								'count'=>$count,//文章总数
								'page_size'=>$page_size,
								'page'=>$Page->firstRow+1,
							),
						'list'=>$list,
				),
					'condition'=>$condition
			);
		}else{
			$result=array(
					'status'=>0,
					'message'=>'数据为空',
					'data'=>array(
							'page'=>array(),
							'list'=>$list
					),
					'param'=>$_REQUEST
			);
		}
		return $result;
// 		$this->assign('list',$list);// 赋值数据集
// 		$this->assign('page',$show);// 赋值分页输出
	}
	/**
	 * 修改
	 * @param int $id
	 * @param array $data
	 */
	public function update_tollById($id,$data){
		$condition=array_filter($condition);//去掉数组空值，不然条件上会加上 xx='' 导致把数据修改为空
		$result=array('status'=>0,'message'=>'修改错误','data'=>null);
		if(empty($id)||empty($data)){
			$result=array('status'=>0,'message'=>'修改失败，id或数据为空','data'=>null);
			return $result;
		}
		
		if($this->where(array('id'=>$id))->save($data)){ // 根据条件保存修改的数据
			$result=array(
					'status'=>1,
					'message'=>'修改成功',
					'data'=>array(
							'id'=>$id,
							'type'=>$data['type'],//类型
							'price_strategy'=>$data['price_strategy'],//价格策略id
							'total_cost'=>$data['total_cost'],//费用
							'user_id'=>$data['user_id'],//需要缴费的用户id
							'time_period'=>$data['time_period'],//时间段
							'user_amount_or_number'=>$data['user_amount_or_number'],//使用量|度、
							'responsible_person'=>$data['responsible_person'],//负责人
							'add_userid'=>$data['add_userid'],//添加者
					));
		}else{
			$result=array(
					'status'=>0,
					'message'=>'修改失败',
					'data'=>array());
		}
		
		return $result;
		
	}
	
	public function del_article($id){
		$result=array('status'=>0,'message'=>'删除成功','data'=>null);
		if(empty($id)){
			$result=array('status'=>0,'message'=>'删除成功失败，id或数据为空','data'=>null);
			return $result;
		}
		if($tmp=$this->where(array('id'=>$id))->delete()){ // 删除所有状态为0的用户数据
			$result=array('status'=>1,'message'=>'删除成功','data'=>$tmp);
		}
		return $result;
		
	}
	
	//根据价格策略获取总价
	public function get_total_price_by_price_strategy($price_strategy=0){
		//如果使用了价格策略，就按照价格策略计算 total_cost
		$total_price=0;
		$price_strategy_info=M('Price_strategy')->where(array('id'=>$price_strategy))->find();
		$formula=$price_strategy_info['formula'];
		if($formula==self::formula_low_price){//最低价
			$total_price = $price_strategy_info['low_price']* $price_strategy_info['number_unit'];
		}elseif($formula==self::formula_standard_price){//标准价
			$total_price = $price_strategy_info['standard_price']* $price_strategy_info['number_unit'];
		}elseif($formula==self::formula_up_settlement_price){//对上结算价
			$total_price = $price_strategy_info['up_settlement_price']* $price_strategy_info['number_unit'];
		}elseif($formula==self::formula_down_settlement_price){//对下结算价
			$total_price = $price_strategy_info['down_settlement_price']* $price_strategy_info['number_unit'];
		}elseif($formula==self::formula_discounts_price){//标准折扣价
			$total_price = $price_strategy_info['discounts']*$price_strategy_info['standard_price']* $price_strategy_info['number_unit'];
		}
		return $total_price;
	}
	
	
}