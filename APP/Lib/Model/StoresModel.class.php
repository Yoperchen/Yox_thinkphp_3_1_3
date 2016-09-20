<?php
/**
 * 商家管理
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class StoresModel extends Model {
	
	// 定义自动验证
	protected $_validate    =   array(
			array('title','require','标题忘了输入了吧~&nbsp└(^o^)┘'),

	);
	// 定义自动完成
	//protected $_auto    =   array(
			//array('create_time','time',1,'function'),
	//);
	/**
	 * 添加商家
	 * @param array $data
	 */
	public function add_store($data){
		if(!empty($data)&&empty($_FILES)){
			return array('status'=>0,'message'=>'data不能为空');
		}
		if(empty($data['site_id'])){
			return array('status'=>0,'message'=>'站点ID不能为空');
		}
		if(empty($data['store_name'])){
			return array('status'=>0,'message'=>'商家名称不能为空');
		}
		if(empty($data['password'])){
			return array('status'=>0,'message'=>'密码不能为空');
		}else{
			$data['password']=$this->password_encryption($data['password']);
		}
		$file_data=array();
		$file_data['store_id']=$data['store_id'];
		$file_data['site_id']=$data['site_id']?$data['site_id']:$data['site_id'];
		$file_data=array_filter($file_data,"Yocms_del_empty");
		$Files_model = D('Files');
		$file_list_result = $Files_model->add_file($file_data);
		foreach($file_list_result['list'] as $key=>$file_info){
			$data['banner']=array_key_exists('banner', $file_info)?$file_info['banner']:'';
			$data['logo']=array_key_exists('logo', $file_info)?$file_info['logo']:'';
		}
		$data=array_filter($data,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$store_id=$this->data($data)->add();
		if($store_id){
			$result=array('status'=>1,'message'=>'成功,'.$file_list_result['message'],
						'data'=>$data,
				);
			}else{
				$result=array('status'=>1,'message'=>'失败,'.$file_list_result['message'],
						'data'=>$data,
				);
			}
			
			return $result;

	}
	/**
	 * 获取指定商家信息
	 * @param int $id
	 * @param int $isdetail
	 * @return array
	 */
	public function getStoreById($id=0,$isdetail=0){
		if(empty($id)){ 
			$data=array('status'=>0,'message'=>'id不能为空');
			return $data;
		}
		if($isdetail==0){
			$store_info = $this->where(array('id'=>$id))->find();
			$result=array('status'=>1,'message'=>'成功','data'=>$store_info);
		}else{//详细
			$store_info = $this->where(array('id'=>$id))->find();
			$result=array('status'=>1,'message'=>'成功','data'=>$store_info);
		}
		//访问日志
		if(session('?account_type')&&session('?id')&&session('?name')){
			$visit_data=array();
			$visit_data['visit_user_id']=session('id');;//访问者
			$visit_data['interviewees_store_id']=$id;//被访问者
			$visit_data['visit_content']='商家';//访问内容
			D('Visit_logModel')->add_visit_log($data);
		}
		return $result;
		
	} 
	/**
	 * 商家登录
	 * @param int $id
	 * @param string $password
	 * @return array
	 */
	public function store_login($id = '',$password = '')
	{
		if(empty($password)){
			$data['status'] =0;
			$data['message'] = '密码为空';
			return $data;
		}
		
		if(empty($id)){
			$data['status'] =0;
			$data['message'] = '帐号为空';
			return $data;
		}
		
		$store_info =array();
		$condition =array();
		if(empty($store_info)){
			$store_info =$this->where(array('id'=>$id))->find();//id登录
			unset($condition);
			$condition['id']=$id;
		}
		if(empty($store_info)){
			$store_info =$this->where(array('name'=>$id))->find();//name登录
			unset($condition);
			$condition['name']=$id;
		}
		if(empty($store_info)){			//如果信息为空，则email登录
			$id=strtolower($id);
			$store_info = $this->where(array('email'=>$id))->find();
			unset($condition);
			$condition['email']=$id;
		}
		if(empty($store_info)){				//如果信息为空，则mobile登录
			$store_info = $this->where(array('mobile'=>$id))->find();
			unset($condition);
			$condition['mobile']=$id;
		}
		if(!empty($store_info)){
			if($store_info['status']!=1){//状态|1正常,2禁止,3黑名单,4删除
				if($store_info['status']==2){
					$message='您的账户被禁止使用，请发送邮件至944975166@qq.com申诉，当天回复。';
				}
				if($store_info['status']==3){
					$message='您的账户被列为黑名单，请发送邮件至944975166@qq.com申诉，当天回复。';
				}
				if($store_info['status']==3){
					$message='您的账户已被删除单，请发送邮件至944975166@qq.com申诉，当天回复。';
				}else{
					$message='账户状态未知，请发送邮件至944975166@qq.com，当天回复。';
				}
				$data['status'] =0;
				$data['message'] = $message;
				return $data;
			}
		}
		if(!empty($store_info)){	//如果账户存在，再验证密码
			$condition['password']=$this->password_encryption($password);
			$store_info = $this->where($condition)->find();
				
			if(!empty($store_info)){//如果密码也正确//==============================
				$login_code=$this->set_login_code($store_info['id']);
				//session
				session('account_type','store');  //帐号类型: user->用户,admin->管理员,store->商家
				session('id',$store_info['id']);  //设置session
				session('store_name',$store_info['store_name']);  //设置session
				session('mobile',$store_info['mobile']);  //设置session
				session('login_code',$login_code);  //登录码，登录成功了会有,每个月都不一样,app有用
				session('is_login',1);//是否登录
				session('sex',$store_info['sex']);//性别|1男、2女
				session('lng',$store_info['lng']);  //设置session，经度
				session('lat',$store_info['lat']);  //设置session, 纬度
				session('geohash',$store_info['geohash']);//geo
				session('last_login_date',date('Y-m-d i:m:s',$store_info['last_login_time']));  //设置session, 上次登录时间
				session('avatar',$store_info['avatar']);  //头像
				session('up',$store_info['up']);//顶
				session('down',$store_info['down']);//差
				session('like',$store_info['like']);//喜欢
				session('view',$store_info['view']);//访问次数
				session('funds',$store_info['funds']);//资金、站点余额
				session('integral',$store_info['integral']);//积分|积分与人民币的兑换是1:1
				session('level',$store_info['level']);//会员等级
				session('level_begin_time',$store_info['level_begin_time']);//等级开始时间
				session('level_end_time',$store_info['level_end_time']);//等级结束时间
				session('community_id',$store_info['community_id']);//社区id|学校，医院，小区
				session('city_id',$store_info['city_id']);//常在城市id
				session('district_id',$store_info['district_id']);//地区，对应district表
				session('is_mobile_verify',$store_info['is_mobile_verify']);  //设置session, 是否手机验证
				session('is_email_verify',$store_info['is_email_verify']);  //设置session, 是否邮箱验证
				session('status',$store_info['status']);//状态|1正常,2禁止,3黑名单,4删除
				session('login_count',$store_info['login_count']);//登录次数
				session('up_store_id',$store_info['up_store_id']);//上级用户，通过谁的推广过来的用户
				session('reg_ip',$store_info['reg_ip']);//最后登录ip
				session('last_login_ip',$store_info['last_login_ip']);//
				session('store_sign',$store_info['store_sign']);//个性签名
				session('last_login_time',$store_info['last_login_time']);//最后登录时间
				//设置cookie
				cookie('account_type','store');  //帐号类型: user->用户,admin->管理员,store->商家
				cookie('id',$store_info['id']);  //设置session
				cookie('store_name',$store_info['store_name']);  //设置session
				cookie('mobile',$store_info['mobile']);  //设置session
				cookie('login_code',$login_code);  //登录码，登录成功了会有,每个月都不一样,app有用
				cookie('is_login',1);
				cookie('sex',$store_info['sex']);//性别|1男、2女
				cookie('lng',$store_info['lng']);  //设置session，经度
				cookie('lat',$store_info['lat']);  //设置session, 纬度
				cookie('last_login_date',date('Y-m-d i:m:s',$store_info['last_login_time']));  //设置session, 上次登录时间
				cookie('avatar',$store_info['avatar']);  //头像
				cookie('up',$store_info['up']);//顶
				cookie('down',$store_info['down']);//差
				cookie('like',$store_info['like']);//喜欢
				cookie('view',$store_info['view']);//访问次数
				cookie('community_id',$store_info['community_id']);//社区id|学校，医院，小区
				cookie('city_id',$store_info['city_id']);//常在城市id
				cookie('district_id',$store_info['district_id']);//地区，对应district表
				cookie('is_mobile_verify',$store_info['is_mobile_verify']);  //设置session, 是否手机验证
				cookie('is_email_verify',$store_info['is_email_verify']);  //设置session, 是否邮箱验证
				cookie('status',$store_info['status']);//状态|1正常,2禁止,3黑名单,4删除
				$update_data=array();
				$update_data['last_login_ip']=get_client_ip();
				$update_data['last_login_time']=time();
				$update_data['login_count']=$store_info['login_count']+1;
				$this->where(array('id'=>$store_info['id']))->save($update_data);
		
				$data['data']['account_type'] = 'store';
				$data['data']['id'] = $store_info['id'];
				$data['data']['store_name'] = $store_info['store_name'];
				$data['data']['mobile'] = $store_info['mobile'];
				$data['data']['login_code'] = $login_code;
				$data['data']['is_login']=1;
				$data['data']['logo']=$store_info['logo'];
				$data['status'] = 1;
				$data['message'] = '登录成功';
				return $data;
		
			}else{
				$data['status'] = 0;
				$data['message'] = '密码错误';
				return $data;
			}
		}else{
		
			$data['status'] = 0;
			$data['message'] = '帐号错误';
			return $data;
		}
		
	}
	/**
	 * 商家列表
	 * @param array $condition
	 * @param number $page_size
	 * @param string $field 查询指定字段
	 * @return array
	 */
	public function get_store_list($condition,$page_size=20,$field='*'){
		$condition=array_filter($condition,"Yocms_del_empty");
		$result=array('status'=>0,'message'=>'错误','data'=>null);
		import('ORG.Util.Page');// 导入分页类
		$count      = $this->where($condition)->count();// 查询满足要求的总记录数
		$Page       = new Page($count,$page_size);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $this->field($field)->where($condition)->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
		if(!empty($list)){
			$result=array(
					'status'=>1,
					'message'=>'成功',
					'data'=>array(
						'page'=>array(
								'count'=>$count,//商家总数
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
	public function update_storeById($id,$data){
		$result=array('status'=>0,'message'=>'修改错误','data'=>null);
		if(empty($id)||empty($data)){
			$result=array('status'=>0,'message'=>'修改失败，id或数据为空','data'=>null);
			return $result;
		}
		if(empty($data['password'])){
			return array('status'=>0,'message'=>'密码不能为空');
		}else{
			$data['password']=$this->password_encryption($data['password']);
		}
		$file_data=array();
		$file_data['store_id']=$id;
		$file_data['site_id']=$data['site_id']?$data['site_id']:$data['site_id'];
		$file_data=array_filter($file_data,"Yocms_del_empty");
		$Files_model = D('Files');
		$file_list_result = $Files_model->add_file($file_data);
		foreach($file_list_result['list'] as $key=>$file_info){
			$data['banner']=array_key_exists('banner', $file_info)?$file_info['banner']:'';
			$data['logo']=array_key_exists('logo', $file_info)?$file_info['logo']:'';
		}
		$data=array_filter($data,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		if($this->where(array('id'=>$id))->save($data)){ // 根据条件保存修改的数据
			$result=array(
					'status'=>1,
					'message'=>'修改成功',
					'data'=>$data
					);
		}else{
			$result=array(
					'status'=>0,
					'message'=>'修改失败',
					'data'=>array());
		}
		
		return $result;
		
	}
	/**
	 * 删除商家
	 * @param int $id
	 * @return multitype:number string NULL |Ambigous <multitype:number string NULL , multitype:number string >
	 */
	public function del_store($id){
		$result=array('status'=>0,'message'=>'删除成功','data'=>null);
		$tmp_error='';
		if(empty($id)){
			$result=array('status'=>0,'message'=>'删除成功失败，id或数据为空','data'=>null);
			return $result;
		}
		if($tmp=$this->where(array('id'=>$id))->delete()){ // 删除所有状态为0的用户数据
			if(!M('Stores_detail')->where(array('store_id'=>$id))->delete()){//删除详细信息表的数据
				$tmp_error='，stores_detail详细信息表的信息没有删掉！！';
			}
			if(!M('Stores_navigation')->where(array('store_id'=>$id))->delete()){//删除Stores_navigation表的数据
				$tmp_error.='，Stores_navigation导航表 的信息没有删掉！！';
			}
			$result=array('status'=>1,'message'=>'删除成功','data'=>$tmp.$tmp_error);
		}
		return $result;
		
	}
	
	
	/**
	 *密码加密
	 */
	public function password_encryption($passowrd){
		return(md5($passowrd.'Yocms'));
	}
	
}