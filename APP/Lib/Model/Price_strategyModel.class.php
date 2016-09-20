<?php
/**
 *价格策略
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
*/
class Price_strategyModel extends Model { 
	
	// 定义自动验证
	protected $_validate    =   array(
			array('title','require','标题忘了输入了吧~&nbsp└(^o^)┘'),

	);
	// 定义自动完成
	//protected $_auto    =   array(
			//array('create_time','time',1,'function'),
	//);
	/**
	 * 添加价格策略
	 * @param array $data
	 */
	public function add_price_strategy($data){
		$condition=array_filter($condition);//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$result=array('status'=>0,'message'=>'data不能为空');
		if(!empty($data)){
			return $result;
			}
			$id=$this->data($data)->add();
			if($id){
				$result=array('status'=>1,'message'=>'成功',
						'data'=>array(
								'id'=>$id,
								'user_id'=>$data['user_id'],//价格策略所属的用户
								'name'=>$data['name'],//价格策略名称
								'remark'=>$data['remark'],//备注
								'low_price'=>$data['low_price'],//最低价
								'standard_price'=>$data['standard_price'],//标准价
								'up_settlement_price'=>$data['up_settlement_price'],//对上结算价，如对供电局结算价
								'down_settlement_price'=>$data['down_settlement_price'],//对下结算价，如对租户的结算价
								'discounts'=>$data['discounts'],//折扣，0.5，0.6
								'formula'=>$data['formula'],//计算公式|low_price，up_settlement_price，down_settlement_price，standard_price，standard_price*discounts，
								'unit_price'=>$data['unit_price'],//单价
								'currency_unit'=>$data['currency_unit'],//货币单位|人民币、美元
								'number_unit'=>$data['number_unit'],//数量单位|个、度
								'time_unit'=>$data['time_unit'],//时间单位|月，学期，年
								'enable_time_period'=>$data['enable_time_period'],//启用时间段
						));
				return $result;
			}

	}
	/**
	 * 获取价格策略
	 * @param number $id
	 * @param number $isdetail
	 * @return array
	 */
	public function get_price_strategyById($id=0){
		if(empty($id)){ 
			$data=array('status'=>0,'message'=>'id不能为空');
			return $data;
		}
			$article_info = $this->where(array('id'=>$id))->find();
			$data=array('status'=>1,'message'=>'成功','data'=>$article_info);
			return $data;
	} 
	/**
	 * 价格策略列表
	 * @param array $condition
	 * @param number $page_size
	 * @return array
	 */
	public function get_price_strategy_list($condition,$page_size=20){
		$condition=array_filter($condition);//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$result=array('status'=>0,'message'=>'错误','data'=>null);
		import('ORG.Util.Page');// 导入分页类
		$count      = $this->where($condition)->count();// 查询满足要求的总记录数
		$Page       = new Page($count,$page_size);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $this->where($condition)->order('id')->field('user_id,name,remark,low_price,standard_price,up_settlement_price,down_settlement_price,discounts,formula ,unit_price,time_unit,currency_unit,number_unit,enable_time_period')->limit($Page->firstRow.','.$Page->listRows)->select();
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
						'list'=>$list
				),
			);
		}else{
			$result=array(
					'status'=>0,
					'message'=>'数据为空',
					'data'=>array(
							'page'=>array(),
							'list'=>$list
					),
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
	public function update_price_strategyById($id,$data){
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
							'user_id'=>$data['user_id'],
							'name'=>$data['name'],
							'remark'=>$data['remark'],
							'low_price'=>$data['low_price'],
							'standard_price'=>$data['standard_price'],
							'up_settlement_price'=>$data['up_settlement_price'],
							'down_settlement_price'=>$data['down_settlement_price'],
							'discounts'=>$data['discounts'],
							'formula'=>$data['formula'],
							'unit_price'=>$data['unit_price'],
							'time_unit'=>$data['time_unit'],
							'currency_unit'=>$data['currency_unit'],
							'number_unit'=>$data['number_unit'],
							'enable_time_period'=>$data['enable_time_period'],
					));
		}else{
			$result=array(
					'status'=>0,
					'message'=>'修改失败',
					'data'=>array());
		}
		
		return $result;
		
	}
	/**
	 * 删除合作商家
	 * @param unknown $id
	 * @return multitype:number string NULL |Ambigous <multitype:number string NULL , multitype:number string >
	 */
	public function del_price_strategy($id){
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
}