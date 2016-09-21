<?php
/**
 * 课程表管理
 * @author Yoper
 *
 */
class CourseAction extends ApibaseAction {
	/*
	 * 添加课程表
	*/
	public function add_course(){
		$data['api_partner_id']=$this->_param('api_partner_id','htmlspecialchars,strip_tags');//第三方合作伙伴id
		$data['partner_site_id']=$this->_param('partner_site_id','htmlspecialchars,strip_tags');//第三方站点id
		$data['belong_user_id']=$this->_param('belong_user_id','htmlspecialchars,strip_tags',0);//属于谁
		$data['week']=$this->_param('week','htmlspecialchars,strip_tags');//星期几
		$data['first_class']=$this->_param('first_class','htmlspecialchars,strip_tags');//第1节课
		$data['second_class']=$this->_param('second_class','htmlspecialchars,strip_tags');//第2节课
		$data['third_class']=$this->_param('third_class','htmlspecialchars,strip_tags');//第3节课
		$data['fourth_class']=$this->_param('fourth_class','htmlspecialchars,strip_tags');//第4节课
		$data['fifth_class']=$this->_param('fifth_class','htmlspecialchars,strip_tags');//第5节课
		$data['sixth_class']=$this->_param('sixth_class','htmlspecialchars,strip_tags');//第6节课
		$data['seventh_class']=$this->_param('seventh_class','htmlspecialchars,strip_tags');//第7节课
		$data['eighth_class']=$this->_param('eighth_class','htmlspecialchars,strip_tags',time());//第8节课
		$data['ninth_class']=$this->_param('ninth_class','htmlspecialchars,strip_tags');//第9节课
		$data['tenth_class']=$this->_param('tenth_class','htmlspecialchars,strip_tags');//第十节课
		$data['class']=$this->_param('class','htmlspecialchars,strip_tags');//班级
		$data['community_id']=$this->_param('community_id','htmlspecialchars,strip_tags');//学校的社区id
		
		$result=D('Course')->add_course($data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 获取课程表列表
	 * index.php?g=api&m=Comments&a=get_comment_list&article_id=文章id
	 */
	public function get_course_list(){
		$condition['api_partner_id']=$this->_param('api_partner_id','htmlspecialchars,strip_tags');//第三方合作伙伴id
		$condition['partner_site_id']=$this->_param('partner_site_id','htmlspecialchars,strip_tags');//第三方站点id
		$condition['belong_user_id']=$this->_param('belong_user_id','htmlspecialchars,strip_tags');//属于那个用户
		$condition['week']=$this->_param('week','htmlspecialchars,strip_tags');
		$condition['class']=$this->_param('class','htmlspecialchars,strip_tags');//班级
		$condition['community_id']=$this->_param('community_id','htmlspecialchars,strip_tags');
		$page_size=$this->_param('page_size','htmlspecialchars,strip_tags');
		
		$result=D('Course')->get_course_list($condition,$page_size);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 获取我的课程表
	 */
	public function get_my_course(){
// 		$condition['api_partner_id']=$this->_param('api_partner_id','htmlspecialchars,strip_tags');//第三方合作伙伴id
// 		$condition['partner_site_id']=$this->_param('partner_site_id','htmlspecialchars,strip_tags');//第三方站点id
		$belong_user_id=$this->_param('belong_user_id','htmlspecialchars,strip_tags');
		$class=$this->_param('class','htmlspecialchars,strip_tags');//班级
		
		$result=D('Course')->get_my_course($belong_user_id,$class);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 获取班级列表
	 */
	public function get_class_list(){
		/*
		$condition['belong_user_id']=$this->_param('belong_user_id','htmlspecialchars,strip_tags');//班级
		
		$result=D('Course')->get_class_list($condition);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
		*/
		$condition['city_id'] = $this->_param('city_id','htmlspecialchars,strip_tags',0);
		$condition['belong_user_id'] = $this->_param('belong_user_id','htmlspecialchars,strip_tags',0);
		$condition['belong_store_id'] = $this->_param('belong_store_id','htmlspecialchars,strip_tags',0);
		$condition['community_id'] = $this->_param('community_id','htmlspecialchars,strip_tags',0);
		$condition['category_id'] = 2;//群类型|1:普通群,2:班级群,3公司群,4朋友群,5兴趣爱好,6粉丝,7学习考试,8行业、技术,9游戏群
		$user_id = $this->_param('user_id','htmlspecialchars,strip_tags',0);
		$user_id ? $condition['user_ids'] = array('like', '%'.$user_id.'%'):'';
		
		R('Api/Friend/get_group_list',$condition);
	}
	/**
	*创建一个班级
	*/
	public function add_class(){
		$data['name']=$this->_param('name','htmlspecialchars,strip_tags',0);//群名称
		$data['description']=$this->_param('description','htmlspecialchars,strip_tags',0);//群描述
		$data['belong_user_id']=$this->_param('belong_user_id','htmlspecialchars,strip_tags',0);//所属用户
		$data['belong_store_id']=$this->_param('belong_store_id','htmlspecialchars,strip_tags',0);//所属商家
		$data['user_ids']=$this->_param('user_ids','htmlspecialchars,strip_tags',0);//群成员
		$data['city_id']=$this->_param('city_id','htmlspecialchars,strip_tags',0);//城市
		$data['community_id']=$this->_param('community_id','htmlspecialchars,strip_tags',0);
		
		R('Api/Friend/add_group',$data);
	}
	/**
	 * 删除我的课程表、删除一个班的课程表
	 */
	public function del_my_course(){
// 		$condition['api_partner_id']=$this->_param('api_partner_id','htmlspecialchars,strip_tags');//第三方合作伙伴id
// 		$condition['partner_site_id']=$this->_param('partner_site_id','htmlspecialchars,strip_tags');//第三方站点id
		$belong_user_id=$this->_param('belong_user_id','htmlspecialchars,strip_tags');
		$class=$this->_param('class','htmlspecialchars,strip_tags');//班级
		
		$result=D('Course')->del_my_course($belong_user_id,$class);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 获取一天的课程表
	 * 
	 */
	public function getCourseById(){
		$id=$this->_param('id','htmlspecialchars,strip_tags');
		$isdetail=$this->_param('isdetail','htmlspecialchars,strip_tags');
		$result=D('Course')->getCourseById($id,$isdetail);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 修改一天的课程表
	 * 
	 */
	public function update_course(){
		$id=$this->_param('id','htmlspecialchars,strip_tags');
		$data['api_partner_id']=$this->_param('api_partner_id','htmlspecialchars,strip_tags');//第三方合作伙伴id
		$data['partner_site_id']=$this->_param('partner_site_id','htmlspecialchars,strip_tags');//第三方站点id
		$data['belong_user_id']=$this->_param('belong_user_id','htmlspecialchars,strip_tags',0);//属于谁
		$data['week']=$this->_param('week','htmlspecialchars,strip_tags');//星期几
		$data['first_class']=$this->_param('first_class','htmlspecialchars,strip_tags');//第1节课
		$data['second_class']=$this->_param('second_class','htmlspecialchars,strip_tags');//第2节课
		$data['third class']=$this->_param('third class','htmlspecialchars,strip_tags');//第3节课
		$data['fourth class']=$this->_param('fourth class','htmlspecialchars,strip_tags');//第4节课
		$data['fifth_class']=$this->_param('fifth_class','htmlspecialchars,strip_tags');//第5节课
		$data['sixth_class']=$this->_param('sixth_class','htmlspecialchars,strip_tags');//第6节课
		$data['seventh_class']=$this->_param('seventh_class','htmlspecialchars,strip_tags');//第7节课
		$data['eighth_class']=$this->_param('eighth_class','htmlspecialchars,strip_tags',time());//第8节课
		$data['ninth_class']=$this->_param('ninth_class','htmlspecialchars,strip_tags');//第9节课
		$data['tenth_class']=$this->_param('tenth_class','htmlspecialchars,strip_tags');//第十节课
		$data['class']=$this->_param('class','htmlspecialchars,strip_tags');//班级
		$data['community_id']=$this->_param('community_id','htmlspecialchars,strip_tags');//学校的社区id
		
		$result=D('Course')->update_courseById($id,$data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 删除用户一天的课程表
	 */
	public function del_course(){
		$id=$this->_param('id','htmlspecialchars,strip_tags');
		$result=D('Course')->del_course($id);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}

}