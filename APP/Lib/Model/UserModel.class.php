<?php
/**
 * 用户
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class UserModel extends Model {
	const USER_TYPE='user';
	/**
	 * 修改用户信息
	 */
	public function update_user_info_by_userid($id,$data){
		$data=array_filter($data,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致把数据修改为空
		//写日志
		Log::write($id.var_export($data),'INFO');
		$result=array('status'=>0,'message'=>'修改错误','data'=>null);
		if(empty($id)||empty($data)){
			$result=array('status'=>0,'message'=>'修改失败，id或数据为空','data'=>null);
		}
		$condition=array();
		$condition['id']=$id;
		$user_info_result = $this->get_user_info($condition);
		if(!empty($data['district_id'])&&!is_numeric($data['district_id'])){
			$result=array('status'=>0,'message'=>'district_id格式 错误','data'=>$data);
		}
		if(!empty($data['community_id'])&&!is_numeric($data['community_id'])){
			$result=array('status'=>0,'message'=>'community_id格式 错误','data'=>$data);
		}
		if(!empty($data['city_id'])&&!is_numeric($data['city_id'])){
			$result=array('status'=>0,'message'=>'city_id格式 错误','data'=>$data);
		}
		if(!empty($data['tag_id'])&&!is_numeric($data['tag_id'])){
			$result=array('status'=>0,'message'=>'tag_id格式 错误','data'=>$data);
		}
		if(!empty($data['up_user_id'])&&!is_numeric($data['up_user_id'])){
			$result=array('status'=>0,'message'=>'up_user_id格式 错误','data'=>$data);
		}
		if(!empty($data['user_id'])&&!is_numeric($data['user_id'])){
			$result=array('status'=>0,'message'=>'user_id格式 错误','data'=>$data);
		}
		if(!empty($data['name'])){
			if($user_info_result['data']['name']!=$data['name']){
				$is_exit=$this->check_name_exist($data['name']);
				if($is_exit['status']==1){
					return array('status'=>0,'message'=>'该用户名已经存在了','data'=>'');
				}
			}
		}
		if(!empty($data['email'])){
			if($user_info_result['data']['name']!=$data['email']){
				$is_exit=$this->check_email_exist($data['email']);
				if($is_exit['status']==1){
					return array('status'=>0,'message'=>'该邮箱已经存在了','data'=>'');
				}
			}
		}
		if(!empty($data['mobile'])){
			if($user_info_result['data']['mobile']!=$data['mobile']){
				$is_exit=$this->check_mobile_exist($data['mobile']);
				if($is_exit['status']==1){
					return array('status'=>0,'message'=>'该手机号已经存在了','data'=>'');
				}
			}
		}
		if(!empty($data['lng'])&&!empty($data['lat'])){//经纬度geohash
			import('ORG.Geohash',LIB_PATH);// 导入天气类
			$geohash = new Geohash;
			$data['geohash']=$geohash->encode($data['lat'], $data['lng']);//纬度、经度
		}
		$file_data=array();
		$file_data['user_id']=$id;
		$file_data['store_id']=$data['store_id']?$data['store_id']:'';
		$file_data['site_id']=$data['site_id']?$data['site_id']:'';
		$file_data=array_filter($file_data,"Yocms_del_empty");
		$Files_model = D('Files');
		$file_list_result = $Files_model->add_file($file_data);
		foreach($file_list_result['list'] as $key=>$file_info){
			$data['avatar']=array_key_exists('avatar', $file_info)?$file_info['avatar']:'';
		}
		if($this->where(array('id'=>$id))->save($data)){ // 根据条件保存修改的数据
			$result=array(
					'status'=>1,
					'message'=>'z修改成功'.$file_list_result['message'],
					'data'=>$data
				);
		}else{
			$result=array(
					'status'=>0,
					'message'=>'z没有修改或修改失败'.$file_list_result['message'],
					'data'=>$data,
					);
		}
		
		return $result;
	}
	
	//余额充值
	public function recharge($user_id,$recharge_amount){
		if(empty($user_id)){
			$result = array('status'=>0,'message'=>'用户ID不能为空','data'=>$user_id);
			return $result;
		}
		if(empty($recharge_amount)){
			$result = array('status'=>0,'message'=>'充值金额不能为空','data'=>$recharge_amount);
			return $result;
		}
		$condition=array();
		$condition['id']=$user_id;
		$user_info_result = $this->get_user_info($condition,$isdetail=0);
		if($user_info_result['status']<1){
			return array('status'=>0,'message'=>$user_info_result['message'],'data'=>$user_info_result['data']);
		}
		$data=array();
		$data['funds']=$user_info_result['data']['funds']+$recharge_amount;
		$tmp = $this->where(array('id'=>$user_id))->save($data);
		if($tmp){
			$user_info_result2 = $this->get_user_info($condition,$isdetail=0);
			if($user_info_result['status']<1){
				return array('status'=>0,'message'=>$user_info_result['message'],'data'=>$user_info_result['data']);
			}
			//写日志
			Log::write('充值成功 用户ID:'.$user_id.' 原余额:'.$user_info_result['data']['funds'].' 充值金额:'.$recharge_amount. '充值后余额'.$user_info_result2['data']['funds'],'INFO');
			return array('status'=>1,'message'=>'充值成功','data'=>
					array(
							'id'=>$user_id,
							'funds'=>$user_info_result2['data']['funds']
							));
		}else{
			//写日志
			Log::write('充值失败 用户ID:'.$user_id.' 原余额:'.$user_info_result['data']['funds'].' 充值金额:'.$recharge_amount. '充值后余额'.$user_info_result2['data']['funds'],'ERR');
			return array('status'=>-1,'message'=>'充值失败','data'=>'');
		}
		
	}
	
	/**
	 * 获取用户列表
	 * @param array $condition 条件
	 * @param int $page_size 查询几条
	 * @param string $field 查询指定字段
	 * @return array
	 */
	public function get_user_list($condition,$page_size=20,$field="*"){
		$condition=array_filter($condition,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$result=array('status'=>0,'message'=>'错误','data'=>null);
		if(!empty($condition['lng'])&&!empty($condition['lat']))//经度纬度
		{
			import('ORG.Geohash',LIB_PATH);// 导入Geohash类
			$geohash = new Geohash;
			$hash = $geohash->encode($condition['lat'], $condition['lng']);//纬度经度
			//取前缀，前缀约长范围越小
			$prefix = substr($hash, 0, 6);
			//echo $hash;//wx4eqwk59ep36s
			//取出相邻八个区域
			$neighbors = $geohash->neighbors($prefix);
			array_push($neighbors, $prefix);
			$condition['geohash']=array('like',array(
					$neighbors['top'].'%',
					$neighbors['bottom'].'%',
					$neighbors['right'].'%',
					$neighbors['left'].'%',
					$neighbors['topleft'].'%',
					$neighbors['topright'].'%',
					$neighbors['bottomright'].'%',
					$neighbors['bottomleft'].'%',
					$neighbors[0].'%',
					),'OR');
		}
		import('ORG.Util.Page');// 导入分页类
		$count      =M('User')->where($condition)->count();// 查询满足要求的总记录数
		$Page       = new Page($count,$page_size);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list_tmp =$this->field($field)->where($condition)->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
		foreach($list_tmp as $user)
		{
			unset($user['password']);
			$list[]=$user;
		}
		//隐私设置
		$Privacy_model = D('Privacy');
		$mark_result = $Privacy_model->mark_content_list_privacy($prefix='user',$list);
		$list = $mark_result['data']['list'];
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
							'page'=>array(
									'count'=>$count,//文章总数
									'page_size'=>$page_size,
									'page'=>$Page->firstRow+1,
							),
							'list'=>$list,
							'condition'=>$condition,
					),
			);
		}
		return $result;
		// 		$this->assign('list',$list);// 赋值数据集
		// 		$this->assign('page',$show);// 赋值分页输出
	}
	
	/**
	 * 用户登录
	 * @param $id 用户id/邮箱/手机
	 * @param $password 用户密码
	 * @param $login_type 指定登录类型
	 */
	function user_login($id = '',$password = ''){
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
		
		$user_info =array();
		$condition =array();
		if(empty($user_info)){
			$user_info =$this->where(array('id'=>$id))->find();//id登录
			unset($condition);
			$condition['id']=$id;
		}
		if(empty($user_info)){
			$user_info =$this->where(array('name'=>$id))->find();//name登录
			unset($condition);
			$condition['name']=$id;
		}
		if(empty($user_info)){			//如果信息为空，则email登录
			$id=strtolower($id);
			$user_info = $this->where(array('email'=>$id))->find();
			unset($condition);
			$condition['email']=$id;
		}
		if(empty($user_info)){				//如果信息为空，则mobile登录
			$user_info = $this->where(array('mobile'=>$id))->find();
			unset($condition);
			$condition['mobile']=$id;
		}
		if(!empty($user_info)){
			if($user_info['status']!=1){//状态|1正常,2禁止,3黑名单,4删除
			if($user_info['status']==2){
				$message='您的账户被禁止使用，请发送邮件至944975166@qq.com申诉，当天回复。';
			}
			if($user_info['status']==3){
				$message='您的账户被列为黑名单，请发送邮件至944975166@qq.com申诉，当天回复。';
			}
			if($user_info['status']==3){
				$message='您的账户已被删除单，请发送邮件至944975166@qq.com申诉，当天回复。';
			}else{
				$message='账户状态未知，请发送邮件至944975166@qq.com，当天回复。';
			}
			$data['status'] =0;
			$data['message'] = $message;
			return $data;
			}
		}
		if(!empty($user_info)){	//如果账户存在，再验证密码
		$condition['password']=$this->password_encryption($password);
			$user_info = $this->where($condition)->find();
			
			if(!empty($user_info)){//如果密码也正确//==============================
				$login_code=$this->set_login_code($user_info['id']);
				//session
				session('account_type','user');  //帐号类型: user->用户,admin->管理员
				session('id',$user_info['id']);  //设置session
				session('name',$user_info['name']);  //设置session
				session('mobile',$user_info['mobile']);  //设置session
				session('login_code',$login_code);  //登录码，登录成功了会有,每个月都不一样,app有用
				session('is_login',1);//是否登录
				session('sex',$user_info['sex']);//性别|1男、2女
				session('lng',$user_info['lng']);  //设置session，经度
				session('lat',$user_info['lat']);  //设置session, 纬度
				session('geohash',$user_info['geohash']);//geo
				session('last_login_date',date('Y-m-d i:m:s',$user_info['last_login_time']));  //设置session, 上次登录时间
				session('avatar',$user_info['avatar']);  //头像
				session('up',$user_info['up']);//顶
				session('down',$user_info['down']);//差
				session('like',$user_info['like']);//喜欢
				session('view',$user_info['view']);//访问次数
				session('funds',$user_info['funds']);//资金、站点余额
				session('integral',$user_info['integral']);//积分|积分与人民币的兑换是1:1
				session('level',$user_info['level']);//会员等级
				session('level_begin_time',$user_info['level_begin_time']);//等级开始时间
				session('level_end_time',$user_info['level_end_time']);//等级结束时间
				session('community_id',$user_info['community_id']);//社区id|学校，医院，小区
				session('city_id',$user_info['city_id']);//常在城市id
				session('district_id',$user_info['district_id']);//地区，对应district表
				session('is_mobile_verify',$user_info['is_mobile_verify']);  //设置session, 是否手机验证
				session('is_email_verify',$user_info['is_email_verify']);  //设置session, 是否邮箱验证
				session('status',$user_info['status']);//状态|1正常,2禁止,3黑名单,4删除
				session('login_count',$user_info['login_count']);//登录次数
				session('up_user_id',$user_info['up_user_id']);//上级用户，通过谁的推广过来的用户
				session('reg_ip',$user_info['reg_ip']);//最后登录ip
				session('last_login_ip',$user_info['last_login_ip']);//
				session('user_sign',$user_info['user_sign']);//个性签名
				session('last_login_time',$user_info['last_login_time']);//最后登录时间
				//设置cookie
				cookie('account_type','user');  //帐号类型: user->用户,admin->管理员
				cookie('id',$user_info['id']);  //设置session
				cookie('name',$user_info['name']);  //设置session
				cookie('mobile',$user_info['mobile']);  //设置session
				cookie('login_code',$login_code);  //登录码，登录成功了会有,每个月都不一样,app有用
				cookie('is_login',1);
				cookie('sex',$user_info['sex']);//性别|1男、2女
				cookie('lng',$user_info['lng']);  //设置session，经度
				cookie('lat',$user_info['lat']);  //设置session, 纬度
				cookie('last_login_date',date('Y-m-d i:m:s',$user_info['last_login_time']));  //设置session, 上次登录时间
				cookie('avatar',$user_info['avatar']);  //头像
				cookie('up',$user_info['up']);//顶
				cookie('down',$user_info['down']);//差
				cookie('like',$user_info['like']);//喜欢
				cookie('view',$user_info['view']);//访问次数
				cookie('community_id',$user_info['community_id']);//社区id|学校，医院，小区
				cookie('city_id',$user_info['city_id']);//常在城市id
				cookie('district_id',$user_info['district_id']);//地区，对应district表
				cookie('is_mobile_verify',$user_info['is_mobile_verify']);  //设置session, 是否手机验证
				cookie('is_email_verify',$user_info['is_email_verify']);  //设置session, 是否邮箱验证
				cookie('status',$user_info['status']);//状态|1正常,2禁止,3黑名单,4删除
				$update_data=array();
				$update_data['last_login_ip']=get_client_ip();
				$update_data['last_login_time']=time();
				$update_data['login_count']=$user_info['login_count']+1;
				$this->where(array('id'=>$user_info['id']))->save($update_data);
				
				$data['data']['account_type'] = 'user';
				$data['data']['id'] = $user_info['id'];
				$data['data']['name'] = $user_info['name'];
				$data['data']['mobile'] = $user_info['mobile'];
				$data['data']['login_code'] = $login_code;
				$data['data']['is_login']=1;
				$data['data']['avatar']=$user_info['avatar'];
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
	function get_login_user_id(){
		$user_id='';
		if(!session('?id')){//没有设置id
			return $user_id;
		}
		$user_id = session('id');
		return $user_id;
	}
	function get_login_user_info(){
		$data=array();
		if(!session('?id') && session('account_type')!=='user'){//没有登录
			$data['data']['status']=0;
			$data['data']['message']='没有登录';
			$data['data']['is_login']=0;
			return $data;
		}
		$data['data']['status']=1;
		$data['data']['message']='已经登录';
		$data['data']['id']=session('id');
		$data['data']['name']=session('name');
		$data['data']['mobile']=session('mobile');
		$data['data']['login_code']=session('login_code');
		$data['data']['is_login']=session('is_login');
		$data['data']['lng']=session('lng');
		$data['data']['lat']=session('lat');
		return $data;
	
	}
	/**
	 * 退出
	 */
	function logout(){
		$is_logout=false;//是否退出成功
		//session('account_type',null); // 删除account_type
		session(null); // 清空当前的session
		if(!session('?account_type')||!session('?id')){
		$is_logout=true;	
		    }
		return $is_logout;

	}
	
	/**
	 * 注册
	 */
	public function register($data){
		$data['reg_ip']=get_client_ip();
		if(empty($data)|| empty($data['password'])){
			$data=array();
			$data['status']=0;
			$data['message']='请输入密码';
			return $data;
		}
		if(empty($data['mobile']) && empty($data['email'])){
			$data=array();
			$data['status']=0;
			$data['message']='请输入帐号';
			return $data;
		}
		if(!empty($data['email'])){
			$data['email']=strtolower($data['email']);
			$is_exit_result=$this->check_email_exist($data['email']);
			if($is_exit_result['status']==1){
			$data=array();
			$data['status']=-1;
			$data['message']='该邮箱已经被注册了，请联系客服处理';
// 			$data['data']=$is_exit_result['data'];
			return $data;
			}
			unset($data['mobile']);
		}
		
		if(!empty($data['mobile'])){
			$is_exit_result=$this->check_mobile_exist($data['mobile']);
			if($is_exit_result['status']==1){
			$data=array();
			$data['status']=-2;
			$data['message']='该手机已经被注册了，请联系客服处理';
// 			$data['data']=$is_exit_result['data'];
			return $data;
			}
			 if (!preg_match('/^1[23456789][0-9]{9}$/',$data['mobile'])) {  
			        return array('status'=>'0','message'=>'手机格式错误','data'=>$data); 
			 }  
			unset($data['email']);
		}
		if(!empty($data['name'])){
			$data['name']=strtolower($data['name']);
			$is_exit=$this->check_name_exist($data['name']);
			if($is_exit['status']==1){
			$data=array();
			$data['status']=-2;
			$data['message']='该用户名已经被注册了';
// 			$data['data']=$is_exit_result['data'];
			return $data;
			}
			unset($data['name']);
		}
		if(empty($data['nick_name'])){//默认昵称
			$nickname_arr = array(
				'杀马特','我最美是吗','蓝色气泡','封号还来','等待你上线','纵横四海','依然飘雪','我没有昵称',
				'爱情不是时光旅人','女生似尤物','么么哒','小糖果','时光是记忆的橡皮擦','散了就散了','女王不会哭泣',
				'飘零作归宿','二次元','次元护使','爱你一万年','记忆时光');
			$data['nick_name']=$nickname_arr[array_rand($nickname_arr)];
		}
		if(empty($data['avatar'])){//默认头像
			$avatar_url_arr = array(
					'Public/Uploads/default_avatar/face_1.jpg','Public/Uploads/default_avatar/face_2.jpg',
					'Public/Uploads/default_avatar/face_3.jpg','Public/Uploads/default_avatar/face_4.jpg',
					'Public/Uploads/default_avatar/face_5.jpg','Public/Uploads/default_avatar/face_6.jpg',
					'Public/Uploads/default_avatar/face_7.jpg','Public/Uploads/default_avatar/face_8.jpg',
					'Public/Uploads/default_avatar/face_9.jpg','Public/Uploads/default_avatar/face_10.jpg',
					'Public/Uploads/default_avatar/face_11.jpg','Public/Uploads/default_avatar/face_12.jpg',
					'Public/Uploads/default_avatar/face_13.jpg','Public/Uploads/default_avatar/face_14.jpg',);
			$data['avatar']=$avatar_url_arr[array_rand($avatar_url_arr)];
		}
		$data['password']=$this->password_encryption($data['password']);
		$data['reg_time']=time();
		$data['is_email_verify']=0;
		$data['is_mobile_verify']=0;
		$Users = M('User');
		if(!($id=$Users->data($data)->add())){
// 			$data=array();
			$data['status']=-3;
			$data['message']='注册失败';
			return $data;

		}else{
			if(!empty($data['email'])||1){//1是测试用
				$data['email']=empty($data['email'])?'944975166@qq.com':$data['email'];//测试用
				$title='广州三客信息有限公司注册验证';
				$content='您之所以收到本邮件，是因为您刚刚在广州三客信息有限公司注册了帐号'
						.'如果不是您本人操作，请忽略，如果确认是您本人注册的，'
						.'请点击以下链接&nbsp;<a href="http://www.xdsjsd.com/index.php?g=User&m=Verify&a=verify_email&email='.$data['email'].'">验证邮件</a><br/>'
						.'<br/>广州三客信息有限公司'
						.'<br/>'.date('Y-m-d H:i:s') 
						.'<br/>';
				if(SendMail($data['email'],$title,$content))//发送验证邮件
					$tmp_msg= ',验证邮件发送成功！';
				else
					$tmp_msg =',验证邮件发送失败';
				}
			
			$data=array();
			$data['status']=1;
			$data['message']='注册成功'.$tmp_msg;
			$data['data']['id']=$id;
			$data['mobile']['id']=$data['mobile'];
			$data['email']['id']=$data['email'];
			return $data;
			}
		}
		
		/**
		 * 手机是否存在
		 * @param unknown $mobile
		 * @return multitype:number string
		 */
		public function check_mobile_exist($mobile){
			$Users = M("Users"); // 实例化User对象
			$conditions=array();
// 			$conditions['mobile']=$mobile;
			$flag=$Users->where('mobile='.$mobile)->find();
			$data=array();
			if($flag){
				$data['status']=1;
				$data['message']='该手机已经注册过了';
				$data['data']=$flag;
				return $data;
			}else{
				$data['status']=0;
				$data['message']='该手机没有注册过';
				return $data;
			}
		
	}
	public function check_name_exist($name){
			$Users = M("Users"); // 实例化User对象
			$condition=array();
			$condition['name']=strtolower($name);
			$flag=$Users->where($condition)->find();
			$data=array();
			if($flag){
				$data['status']=1;
				$data['message']='该用户名已经注册过了';
				$data['data']=$flag;
				return $data;
			}else{
				$data['status']=0;
				$data['message']='该用户名没有注册过';
				return $data;
			}
	}
	/**
	 * 邮箱是否存在
	 * @param unknown $mobile
	 * @return multitype:number string
	 */
	public function check_email_exist($email){
		$Users = M("Users"); // 实例化User对象
		$condition=array();
		$condition['email']=strtolower($email);
		$flag=$Users->where($condition)->find();
		$data=array();
		if($flag){
			$user_info= M('User')->where('id='.$user_info['id'])->field('id,is_email_verify')->find();
			$message_tmp='';
			if($user_info['is_email_verify']){//邮箱验证成功
				$message_tmp='，且验证成功';
				$data['status']=1;
			}else{
				$message_tmp='，但没有验证';
				$data['status']=0;
			}
			
			$data['message']='该邮箱已经注册过了'.$message_tmp;
			return $data;
		}else{
			$data['status']=-1;
			$data['message']='该邮箱没有注册过';
			return $data;
		}
	
	}
	/**
	 * 获取用户信息
	 * @param array $condition
	 * @param int $isdetail
	 */
	public function get_user_info($condition,$isdetail=0){
		$condition=array_filter($condition,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		if(empty($condition)){
			$data=array('status'=>0,'message'=>'id或mobile或email不能为空');
			return $data;
		}
		$user_info = $this->where($condition)->find();
		if($isdetail!=0)
		{
			//详细
			$user_info = $this->where($condition)->find();
		}

		//隐私权限检查
		$check_privacy_result = D('Privacy')->check_privacy($user_info['user_id'],session('id'),'user'.$user_info['id']);
		if($check_privacy_result['status']<1)
		{
			$user_info['mobile']=$check_privacy_result['message'];
			$user_info['email']=$check_privacy_result['message'];
			$result=array('status'=>0,'message'=>$check_privacy_result['message'],'data'=>$user_info);
			return $result;
		}

		if(!empty($user_info['community_id']))
		{
			$community_model = D('Community');
			$community_info_result = $community_model->get_info_by_community_id($user_info['community_id']);
			$user_info['community']=$community_info_result['data'];
		}
		if(!empty($user_info)){
			$data=array('status'=>1,'message'=>'成功','data'=>$user_info);
		}else{
			$data=array('status'=>0,'message'=>'查询成功，但没有数据','data'=>$user_info);
		}
		$data['condition']=$condition;
		return $data;
	}
	
	/**
	 * 验证邮箱
	 * return bool
	 */
	public function verify_email($email){
		$flag=false;
		$user_info= M('User')->where('email="'.$email.'"')->field('id,is_email_verify')->find();//Array ( [id] => 1 )
		if($user_info['is_email_verify']){//之前已经验证成功过
			$flag=true;
		}else{
			$data['is_email_verify']=1;
			M('User')->where('id='.$user_info['id'])->save($data);
			$flag=true;
			
			//发送验证成功邮件 
			$title='广州三客信息有限公司邮箱验证成功';
			$content='恭喜您成功验证，成为三客信息有限公司的正式会员，将可以享受更多的福利哦'
					.'点击以下链接登录&nbsp;<a href="http://www.xdsjsd.com">三客</a><br/>'
							.'<br/>广州三客信息有限公司'
									.'<br/>'.date('Y-m-d H:i:s') ;
			if(SendMail($data['email'],$title,$content))//发送验证邮件
				$tmp_msg= ',验证邮件发送成功！';
			else
				$tmp_msg =',验证邮件发送失败';
			
		}
		return $flag;
	}
	/**
	 * 验证注册时的验证码
	 * @param string $verify_type
	 * @param unknown $code
	 * @return boolean
	 */
	public function verify_code($verify_type='verify_register_code',$code){
		if(empty($verify_type)||empty($code)){
			return false;
		}
	return true;
	
	}
	/**
	 * 重置密码(userid,mobile,email至少要传一个，新密码必须传)
	 * @param string $old_password
	 * @param string $new_password
	 * @param int $userid
	 * @param int $mobile
	 * @param string $email
	 * @param int $isForced 1:强制更新，0：提供旧密码更新(非强制更新)
	 * @return array
	 */
	public function reset_password($old_password='',$new_password='',$userid='',$mobile='',$email='',$isForced=0){
		$new_password=$this->password_encryption($new_password);//新密码
		$old_password=$this->password_encryption($old_password);//旧密码
		
		if($isForced==1){//强制更新
			if(!empty($userid)){
				$user_info= M('User')->where(array('id'=>$userid))->field('id')->find();//Array ( [id] => 1 )
				$condition=array('id'=>$userid);
			 }
			 elseif(!empty($mobile)){
			 	$user_info= M('User')->where(array('mobile'=>$mobile))->field('id')->find();//Array ( [id] => 1 )
			 	$condition=array('mobile'=>$mobile);
			 }
			 elseif(!empty($email)){
			 	$user_info= M('User')->where(array('email'=>$email))->field('id')->find();//Array ( [id] => 1 )
			 	$condition=array('email'=>$email);
			 }else{
			 	$data=array('status'=>0,'message'=>'强制更新请输入用户id,或者mobile或者email');
			 	return $data;
			 }
			 
			 
		}
		
		if($isForced==0){//账号密码更新(非强制更新)
			if(!empty($userid)&&!empty($old_password)&&!empty($new_password)){
				$user_info= M('User')->where('id="'.$userid.'" and password="'.$old_password.'"')->field('id')->find();//Array ( [id] => 1 )
				$condition=array('id'=>$userid);
				// 			 	M('User')->where('user_id='.$user_info['id'])->save($data);
			}
			elseif(!empty($mobile)&&!empty($old_password)&&!empty($new_password)){
				$user_info= M('User')->where('mobile="'.$mobile.'" and password="'.$old_password.'"')->field('id')->find();//Array ( [id] => 1 )
				$condition=array('mobile'=>$mobile);
			}
			elseif(!empty($email)&&!empty($old_password)&&!empty($new_password)){
				$user_info= M('User')->where('email="'.$email.'" and password="'.$old_password.'"')->field('id')->find();//Array ( [id] => 1 )
				$condition=array('email'=>$email);
			}else{
				$data=array('status'=>0,'message'=>'非强制更新请输入旧密码');
				return $data;
			}
		}
		
		if(!empty($user_info)){
			$data=array('password'=>$new_password);
			if(M('User')->where($condition)->save($data)){
				$data=array('status'=>1,'message'=>'修改成功');
				return $data;
			}else{
				$data=array('status'=>0,'message'=>'修改密码不成功','data'=>$data,'condition'=>$condition);
				return $data;
			}
			
		}else{
			$data=array('status'=>-1,'message'=>'用户不存在',
					'data'=>array(
							'mobile'=>$mobile,
							'old_passwords'=>$old_password,
							'new_password'=>$new_password,
							'userid'=>$userid,
							'email'=>$email,
							'isForced'=>$isForced,
			));
			return $data;
		}
		
		
	}
	/**
	*密码加密
	*/
	public function password_encryption($passowrd){//123456:2f1e108fad600d781774fcd3351c7c70
		return(md5($passowrd.'Yocms'));
	}
	
	//设置登陆嘛
	public function  set_login_code($user_id){
		return md5($user_id.date('Y-m',time()));
	}
	//获取登陆码
	public function get_login_code(){
		if(session('?login_code')){
			return session('login_code');
		}else{
			return false;
		}
	}
	//检查login_code是否正确
	public function check_login_code($login_code){
		if($login_code!=$this->get_login_code()){
			return false;
		}else{
			return true;
		}
	}
	public function del_user($condition)
	{
		if(empty($condition))
		{
			$result =array('status'=>0,'message'=>'条件为空');
		}
		$tmp=$this->where($condition)->delete();
		if($tmp){
			$result =array('status'=>1,'message'=>'删除成功','data'=>$tmp);
		}else{
			$result =array('status'=>0,'message'=>'删除失败','data'=>$tmp);
		}
		return $result;
	}
}