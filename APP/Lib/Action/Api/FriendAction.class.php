<?php
/*
 * 好友、成员、消息、约会、群(组、班级、系)
 */
class FriendAction extends ApibaseAction {
	
	/**
	 * 获取指定社区成员
	 */
	public function  get_community_member(){
		$condition['community_id']=$this->_param('community_id','htmlspecialchars,strip_tags',0);//社区id
		$condition['city_id']=$this->_param('city_id','htmlspecialchars,strip_tags');//城市id
		$condition['district_id']=$this->_param('district_id','htmlspecialchars,strip_tags');//区
		$condition['up_user_id']=$this->_param('up_user_id','htmlspecialchars,strip_tags');//上级用户
		$page_size=$this->_param('page_size','htmlspecialchars,strip_tags',20);//每页几条
		$result=D('User')->get_user_list($condition,$page_size=20);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 获取好友列表
	 */
	public function get_friends(){
		$condition['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags',0);//哪个好友的好友列表
		$condition['friend_category_id']=$this->_param('friend_category_id','htmlspecialchars,strip_tags',0);//好友分组id
		$condition['friend_user_status']=1;//未删除的好友
		$page_size=$this->_param('page_size','htmlspecialchars,strip_tags',20);//每页几条
		$result=D('User_friends')->get_friend_list($condition,$page_size=20);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
		
	}
	/**
	 * 获取好友分组(好友分类)
	 */
	public function get_friend_category_list(){
		$condition['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags',0);//所属用户id
		$result=D('User_friend_category')->get_category_list($condition,$page_size=20);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 获取系统好友分组(好友分类)
	 */
	public function get_system_friend_category_list(){
		$condition['user_id']=0;//所属用户id
		$result=D('User_friend_category')->get_category_list($condition,$page_size=10);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	//添加好友
	public function add_friend(){
		$data['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags',0);//所属用户id
		$data['friend_user_id']=$this->_param('friend_user_id','htmlspecialchars,strip_tags',0);//好友id
		$data['friend_category_id']=$this->_param('friend_category_id','htmlspecialchars,strip_tags',0);//分组id
		$data['friend_remark_name']=$this->_param('friend_remark_name','htmlspecialchars,strip_tags',0);//好友备注名称
		$data['remark']=$this->_param('remark','htmlspecialchars,strip_tags',0);//私立华联2013级小师妹，动漫专业
		$data['friend_user_sort']=$this->_param('friend_user_sort','htmlspecialchars,strip_tags',0);//好友排序
		$data['friend_user_status']=$this->_param('friend_user_status','htmlspecialchars,strip_tags',1);//状态|1正常 0黑名单
		
		$result=D('User_friends')->add_user_friend($data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 删除好友，假删除以便好友找回
	 */
	public function del_friend(){
		$id = $this->_param('id','htmlspecialchars,strip_tags',0);//成为好友id
		
		$result=D('User_friends')->set_friend_user_status_delete($id);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 加黑名单
	 */
	public function add_blacklist(){
		$id=$this->_param('id','htmlspecialchars,strip_tags',0);//用户id
		$data['friend_category_id']=5;//1：我的社区好友，2我的好友，3：家人，4陌生人，5:黑名单分组、
		$data['friend_user_status']=$this->_param('friend_user_status','htmlspecialchars,strip_tags',1);//状态|1正常 0黑名单
		if(empty($data['user_id'])||empty($data['friend_user_id'])){
			$result=array('status'=>0,'message'=>'用户id或者好友用户id为空','data'=>$data);
			exit(json_encode($result));
		}
		$result=D('User_friends')->update_friendById($id,$data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	
	/**
	 * 发送消息
	 */
	public function send_message(){
		$data['from_site_id']=$this->_param('from_site_id','htmlspecialchars,strip_tags',0);//来自哪个网站
		$data['to_site_id']=$this->_param('to_site_id','htmlspecialchars,strip_tags',0);//发去那个网站
		$data['api_partner_id']=$this->_param('api_partner_id','htmlspecialchars,strip_tags',0);//第三方合作伙伴
		$data['from_user_id']=$this->_param('from_user_id','htmlspecialchars,strip_tags',0);//发送者
		$data['to_user_id']=$this->_param('to_user_id','htmlspecialchars,strip_tags',0);//接收者
		$data['title']=$this->_param('title','htmlspecialchars,strip_tags',0);//标题
		$data['message_content']=$this->_param('message_content','htmlspecialchars,strip_tags',0);//消息内容
		$data['is_read']=$this->_param('is_read','htmlspecialchars,strip_tags',0);//是否已读
		$data['theme']=$this->_param('theme','htmlspecialchars,strip_tags',0);//信息模板(主题、气泡、外框模版)
		
		$result=D('Message')->add_message($data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	
	/**
	 * 删除消息
	 */
	public function del_message(){
		$message_id=$this->_param('message_id','htmlspecialchars,strip_tags',0);//消息id
	
		$result=D('Message')->del_message($message_id);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	
	/**
	 * 获取消息列表
	 */
	public function get_message_list(){
		$condition['from_site_id']=$this->_param('from_site_id','htmlspecialchars,strip_tags',0);//发送站点
		$condition['to_site_id']=$this->_param('to_site_id','htmlspecialchars,strip_tags',0);//接受站点
		$condition['api_partner_id']=$this->_param('api_partner_id','htmlspecialchars,strip_tags',0);//第三方合作伙伴id
		$condition['from_user_id']=$this->_param('from_user_id','htmlspecialchars,strip_tags',0);//发送者
		$condition['to_user_id']=$this->_param('to_user_id','htmlspecialchars,strip_tags',0);//接收者
		$condition['is_read']=$this->_param('is_read','htmlspecialchars,strip_tags',0);//是否已读，1;已读，0;纬度
		$condition['theme']=$this->_param('theme','htmlspecialchars,strip_tags',0);//消息外框、气泡、主题
		$page_size=$this->_param('page_size','htmlspecialchars,strip_tags',20);//每页几条

		$result=D('Message')->get_message_list($condition,$page_size);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 修改消息
	 */
	public function update_message(){
		$condition['id']=$this->_param('message_id','htmlspecialchars,strip_tags',0);//发送站点
		$condition['from_site_id']=$this->_param('from_site_id','htmlspecialchars,strip_tags',0);//来自那个网站
		$condition['to_site_id']=$this->_param('to_site_id','htmlspecialchars,strip_tags',0);//发去那个网站
		$condition['api_partner_id']=$this->_param('api_partner_id','htmlspecialchars,strip_tags',0);//第三方
		$condition['from_user_id']=$this->_param('from_user_id','htmlspecialchars,strip_tags',0);//发送着id
		$condition['to_user_id']=$this->_param('to_user_id','htmlspecialchars,strip_tags',0);//接收者id
		$condition['title']=$this->_param('title','htmlspecialchars,strip_tags',0);//标题
		$condition['message_content']=$this->_param('message_content','htmlspecialchars,strip_tags',0);//消息内容
		$condition['is_read']=$this->_param('is_read','htmlspecialchars,strip_tags',0);//是否已读
		$condition['theme']=$this->_param('theme','htmlspecialchars,strip_tags',0);//消息主题、气泡、外框
	
		$result=D('Message')->get_message_list($condition,$page_size=20);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 创建群
	 */
	public function add_group(){
		$data['name']=$this->_param('name','htmlspecialchars,strip_tags',0);//群名称
		$data['description']=$this->_param('description','htmlspecialchars,strip_tags',0);//群描述
		$data['belong_user_id']=$this->_param('belong_user_id','htmlspecialchars,strip_tags',0);//所属用户
		$data['belong_store_id']=$this->_param('belong_store_id','htmlspecialchars,strip_tags',0);//所属商家
		$data['user_ids']=$this->_param('user_ids','htmlspecialchars,strip_tags',0);//群成员
		$data['city_id']=$this->_param('city_id','htmlspecialchars,strip_tags',0);//城市
		$data['community_id']=$this->_param('community_id','htmlspecialchars,strip_tags',0);
		
		$result=D('Groups')->add_group($data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 加群
	 */
	public function join_group(){
		$group_id = $this->_param('group_id','htmlspecialchars,strip_tags',0);
		$apply_user_id = $this->_param('apply_user_id','htmlspecialchars,strip_tags',0);
		
		$result=D('Groups')->join_group($group_id,$apply_user_id);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 退群
	 */
	public function exit_group(){
		$group_id = $this->_param('group_id','htmlspecialchars,strip_tags',0);
		$apply_user_id = $this->_param('apply_user_id','htmlspecialchars,strip_tags',0);
		
		$result=D('Groups')->exit_group($group_id,$apply_user_id);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 获取群详细信息
	 */
	public function get_group(){
		$group_id = $this->_param('group_id','htmlspecialchars,strip_tags',0);
		
		$result=D('Groups')->get_group($group_id);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 获取群成员列表
	 */
	public function get_group_user(){
		$group_id = $this->_param('group_id','htmlspecialchars,strip_tags',0);
		
		$result=D('Groups')->get_group_user($group_id);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	
	/**
	 * 群列表
	 */
	public function get_group_list(){
		$condition['city_id'] = $this->_param('city_id','htmlspecialchars,strip_tags',0);
		$condition['belong_user_id'] = $this->_param('belong_user_id','htmlspecialchars,strip_tags',0);
		$condition['belong_store_id'] = $this->_param('belong_store_id','htmlspecialchars,strip_tags',0);
		$condition['community_id'] = $this->_param('community_id','htmlspecialchars,strip_tags',0);
		$condition['category_id'] = $this->_param('category_id','htmlspecialchars,strip_tags',0);//群类型|1:普通群,2:班级群,3公司群,4朋友群,5兴趣爱好,6粉丝,7学习考试,8行业、技术,9游戏群
		$user_id = $this->_param('user_id','htmlspecialchars,strip_tags',0);
		$user_id ? $condition['user_ids'] = array('like', '%'.$user_id.'%'):'';
		
		$result=D('Groups')->get_group_list($condition);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 修改群
	 */
	public function update_groupById(){
		$id = $this->_param('id','htmlspecialchars,strip_tags',0);//群id
		$data['name']=$this->_param('name','htmlspecialchars,strip_tags',0);//群名称
		$data['description']=$this->_param('description','htmlspecialchars,strip_tags',0);//群描述
		$data['belong_user_id']=$this->_param('belong_user_id','htmlspecialchars,strip_tags',0);//所属用户
		$data['belong_store_id']=$this->_param('belong_store_id','htmlspecialchars,strip_tags',0);//所属商家
		$data['user_ids']=$this->_param('user_ids','htmlspecialchars,strip_tags',0);//群成员
		$data['city_id']=$this->_param('city_id','htmlspecialchars,strip_tags',0);//城市
		$data['community_id']=$this->_param('community_id','htmlspecialchars,strip_tags',0);
		
		$result=D('Groups')->update_groupById($id,$data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 解散群、删除群
	 */
	public function del_group(){
		$id = $this->_param('id','htmlspecialchars,strip_tags',0);//群id
		
		$result=D('Groups')->del_group($id);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 发送群信息
	 */
	public function send_group_message(){
		$data['from_user_id']=$this->_param('from_user_id','htmlspecialchars,strip_tags',0);//用户id
		$data['to_group_id']=$this->_param('to_group_id','htmlspecialchars,strip_tags',0);//群id
		$data['title']=$this->_param('title','htmlspecialchars,strip_tags',0);//消息标题
		$data['message_content']=$this->_param('message_content','htmlspecialchars,strip_tags',0);//消息内容
		$data['is_read']=$this->_param('is_read','htmlspecialchars,strip_tags',0);//是否已读
		$data['read_time']=$this->_param('read_time','htmlspecialchars,strip_tags',0);//读时间
		$data['theme']=$this->_param('theme','htmlspecialchars,strip_tags',0);//消息主题、模板
		
		$result=D('Groups_message')->add_message($data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 群消息列表
	 */
	public function get_group_message_list(){
		$condition['from_user_id'] = $this->_param('from_user_id','htmlspecialchars,strip_tags',0);
		$condition['to_group_id'] = $this->_param('to_group_id','htmlspecialchars,strip_tags',0);
		$condition['is_read'] = $this->_param('is_read','htmlspecialchars,strip_tags',0);
		$message_content = $this->_param('message_content','htmlspecialchars,strip_tags',0);
		$condition['message_content'] = array('like', '%'.$message_content.'%');
		
		$result=D('Groups_message')->get_message_list($condition,$page_size=20);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 删除群消息
	 */
	public function del_group_message(){
		$id = $this->_param('id','htmlspecialchars,strip_tags',0);
		
		$result=D('Groups_message')->del_message($id);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
}