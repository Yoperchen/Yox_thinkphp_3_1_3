<?php
/**
 * 站点
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 */
class Partner_siteModel extends Model {
	const USER_TYPE='site';
	/**
	 * 添加站点
	 * @param array $data
	 */
	public function add_site( $data){
		$data=array_filter($data,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致把数据修改为空
		$result=array('status'=>0,'message'=>'错误了');
		if(empty($data)){
			$result=array('status'=>0,'message'=>'数据为空');
		}
		if(empty($data['partner_api_id'])){
			$result=array('status'=>0,'message'=>'partner_api_id为空，请选择第三方合作帐号');
		}
		if(!empty($data)){
			$data['add_time']=time();
			 if($id=$this->data($data)->add()){
				$result=array('status'=>1,'message'=>'成功','data'=>$id);
			 }else{
			 	$result=array('status'=>1,'message'=>'新增失败','data'=>$id);
			 }
			return $result;
		}
	}
	//添加站点
	public function register($data){
			if(empty($data)|| empty($data['password'])||(empty($data['mobile']) && empty($data['email']) && empty($data['site_name']))){
			$data=array();
			$data['status']=0;
			$data['message']='请输入帐号密码';
			$data['data']=$data;
			return $data;
		}
		if(empty($data['partner_api_id'])){
			$result=array('status'=>0,'message'=>'partner_api_id为空，请选择第三方合作帐号');
		}
// 		if(!empty($data['email'])){
// 			$is_exit=$this->check_email_exist($data['email']);
// 			if($is_exit['status']==1){
// 			$data=array();
// 			$data['status']=-1;
// 			$data['message']='该邮箱已经被注册了，请联系客服处理';
// 			return $data;
// 			}
// 			unset($data['mobile']);
// 		}
		
// 		if(!empty($data['mobile'])){
// 			$is_exit=$this->check_mobile_exist($data['mobile']);
// 			if($is_exit['status']==1){
// 			$data=array();
// 			$data['status']=-2;
// 			$data['message']='该手机已经被注册了，请联系客服处理';
// 			return $data;
// 			}
// 			unset($data['email']);
// 		}
		
		$data['password']=$this->password_encryption($data['password']);
		$data['add_time']=time();
		$data['is_email_verify']=0;
		$data['is_mobile_verify']=0;
		if(!$id=$this->data($data)->add()){
// 			$data=array();
			$data['status']=-3;
			$data['message']='注册失败';
			$data['data']=$data;
			return $data;

		}else{
			if(!empty($data['email'])||1){//1是测试用
				$data['email']=empty($data['email'])?'944975166@qq.com':$data['email'];//测试用
				$title='广州三客信息有限公司注册验证';
				$content='您之所以收到本邮件，是因为您刚刚在广州三客信息有限公司注册了帐号'
						.'如果不是您本人操作，请忽略，如果确认是您本人注册的，'
						.'请点击以下链接&nbsp;<a href="'.$_SERVER['HTTP_HOST'].'/index.php?g=User&m=Verify&a=verify_email&email='.$data['email'].'">验证邮件</a><br/>'
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
			$data['data']=$data;
			return $data;
	}
	}
	/**
	 * 获取站点信息
	 * @param number $id
	 * @param number $isdetail 是否详细，详细就获取用户信息
	 * @return array
	 */
	public function get_site_by_id( $id=0,$isdetail=0){
		if(empty($id)){ 
			$data=array('status'=>0,'message'=>'id不能为空');
			return $data;
		}
		if($isdetail==0){
			$site_info = $this->where(array('id'=>$id))->find();
			$data=array('status'=>1,'message'=>'成功','data'=>$site_info);
			return $data;
		}else{//详细
			$site_info		 = $this->where(array('id'=>$id))->find();
			$site_detail_info = M('User')->where(array('id'=>$site_info['belong_user_id']))->find();
			$site_info		 =array_merge_recursive($site_info,$site_detail_info);
			$data=array('status'=>1,'message'=>'成功','data'=>$site_info);
			return $data;
		}
		
	} 
	/**
	 * 获取导航列表
	 * @param array $condition
	 * @param int $page_size
	 */
	public function get_site_list( $condition, $page_size=15){
		$condition=array_filter($condition,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致把数据修改为空
		$result=array('status'=>0,'message'=>'错误','data'=>null);
		import('ORG.Util.Page');// 导入分页类
		$count      = $this->where($condition)->count();// 查询满足要求的总记录数
		$Page       = new Page($count,$page_size);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $this->where($condition)->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
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
		return $result;
// 		$this->assign('list',$list);// 赋值数据集
// 		$this->assign('page',$show);// 赋值分页输出
	}
	/**
	 * 修改
	 * @param int $id
	 * @param array $data
	 */
	public function update_siteById($id, $data){
		$result=array('status'=>0,'message'=>'修改错误','data'=>null);
		if(empty($id)||empty($data)){
			$result=array('status'=>0,'message'=>'修改失败，id或数据为空','data'=>null);
			return $result;
		}
		
		$data['update_time']=time();
		if($result['data']=$this->where(array('id'=>$id))->save($data)){ // 根据条件保存修改的数据
			$result['status']=1;
			$result['message']='修改成功';
		}
		
		return $result;
		
	}
	/**
	 * 删除导航
	 * @param array $condition
	 */
	public function del_site( $condition){
		$result=array('status'=>0,'message'=>'删除成功','data'=>null);
		if(empty($condition)){
			$result=array('status'=>0,'message'=>'删除成功失败，id或数据为空','data'=>null);
			return $result;
		}
		
		if($result['data']=$this->where($condition)->delete()){ // 删除所有状态为0的用户数据
			$result=array('status'=>1,'message'=>'删除成功','data'=>$result['data']);
		}
		return $result;
		
	}
	/**
	 * 登录
	 * @param string $id
	 * @param string $password
	 */
	public function site_login($id='',$password){

		if(empty($password)){
			$data['status'] =0;
			$data['message'] = '站点密码为空';
			return $data;
		}
		
		if(empty($id)){
			$data['status'] =0;
			$data['message'] = '站点帐号为空';
			return $data;
		}
		
		$site_info =array();
		$condition =array();
		if(empty($site_info)){
			$site_info =$this->where(array('id'=>$id))->find();//id登录
			unset($condition);
			$condition['id']=$id;
		}
		if(empty($site_info)){
			$site_info =$this->where(array('site_name'=>$id))->find();//id登录
			unset($condition);
			$condition['site_name']=$id;
		}
		if(empty($site_info)){		 //如果信息为空，则email登录
			$id=strtolower($id);
			$site_info = $this->where(array('email'=>$id))->find();
			unset($condition);
			$condition['email']=$id;
		}
		if(empty($site_info)){		//如果信息为空，则mobile登录
			$site_info = $this->where(array('mobile'=>$id))->find();
			unset($condition);
			$condition['mobile']=$id;
		}
		
		if(!empty($site_info)){	//如果账户存在，再验证密码
			$condition['password']=$this->password_encryption($password);
			$site_info = $this->where($condition)->find();
				
			if(!empty($site_info)){//如果密码也正确//==============================
				$login_code=$this->set_login_code($site_info['id']);
				//设置session
				session('account_type','site');  //帐号类型: user->用户,admin->管理员
				session('id',$site_info['id']);  //设置session
				session('site_name',$site_info['site_name']);  //设置session
				session('mobile',$site_info['mobile']);  //设置session
				session('login_code',$login_code);  //登录码，登录成功了会有,每个月都不一样,app有用
				session('is_login',1);
				session('lng',$site_info['lng']);  //设置session，经度
				session('lat',$site_info['lat']);  //设置session, 纬度
				session('last_login_date',date('Y-m-d i:m:s',$site_info['last_login_time']));  //设置session, 上次登录时间
				session('is_mobile_verify',$site_info['is_mobile_verify']);  //设置session, 是否手机验证
		
				//设置cookies
				cookie('account_type','site');
				cookie('id',$site_info['id'],'/');
				cookie('site_name',$site_info['site_name']);
				cookie('mobile',$site_info['mobile']);
				cookie('login_code',$login_code);
				cookie('is_login',1,'/');
				cookie('lng',$site_info['lng']);
				cookie('lat',$site_info['lat']);
				cookie('last_login_date',date('Y-m-d i:m:s',$site_info['last_login_time']));
				cookie('is_mobile_verify',$site_info['is_mobile_verify']);
				
				$this->where(array('id'=>$site_info['id']))->save(array('last_login_time'=>time()));
		
				$data['data']['account_type'] = 'site';
				$data['data']['id'] = $site_info['id'];
				$data['data']['name'] = $site_info['name'];
				$data['data']['mobile'] = $site_info['mobile'];
				$data['data']['login_code'] = $login_code;
				$data['data']['is_login'] = 1;
				$data['status'] = 1;
				$data['message'] = '登录成功';
				return $data;
		
			}else{
				session('is_login',0);
				setcookie('is_login',0,'/');
				$data['status'] = 0;
				$data['message'] = '站点密码错误';
				return $data;
			}
		}else{
		
			$data['status'] = 0;
			$data['message'] = '站点帐号错误';
			return $data;
		}
		
		
		
	}
	function get_login_site_info(){
		$data=array();
		if(!session('?id') && session('account_type')!=='site'){//没有登录
			$data['data']['status']=0;
			$data['data']['message']='没有登录';
			$data['data']['is_login']=0;
			return $data;
		}
		$data['data']['status']=1;
		$data['data']['message']='已经登录';
		$data['data']['id']=session('id');
		$data['data']['site_name']=session('site_name');
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
	 *密码加密
	 */
	public function password_encryption($passowrd){
		return(md5($passowrd.'Yocms'));
	}
	//设置登陆嘛
	public function  set_login_code($site_id){
		return md5($site_id.date('Y-m',time()));
	}
	
	
}