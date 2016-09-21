<?php
/**
 * 广告管理
 * @author Yoper
 *
 */
class AdAction extends ApibaseAction {
	/*
	 * 公告添加评论
	*/
	public function add_ad(){
		$data['api_partner_id']=$this->_param('api_partner_id','htmlspecialchars,strip_tags');//第三方合作伙伴id
		$data['partner_site_id']=$this->_param('partner_site_id','htmlspecialchars,strip_tags');//第三方站点id
		$data['store_id']=$this->_param('store_id','htmlspecialchars,strip_tags',0);//商家id
		$data['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');//用户id
		$data['title']=$this->_param('title','htmlspecialchars,strip_tags');//广告标题
		$data['desc']=$this->_param('desc','htmlspecialchars,strip_tags');//广告描述
		$data['type']=$this->_param('type','htmlspecialchars,strip_tags');//广告类型|Link(链接)、text(文字)、Picture(图片)
		$data['platform']=$this->_param('platform','htmlspecialchars,strip_tags');//设备|AN/IP/H5/WB/MAC/KI
		$data['page']=$this->_param('page','htmlspecialchars,strip_tags');//页面|index/personal_center/good_list/good_detail/article_list..
		$data['text']=$this->_param('text','htmlspecialchars,strip_tags');//文字
		$data['link']=$this->_param('link','htmlspecialchars,strip_tags');//链接
		$data['begin_time']=$this->_param('begin_time','htmlspecialchars,strip_tags',time());//广告开始时间
		$data['end_time']=$this->_param('end_time','htmlspecialchars,strip_tags');//广告借宿时间
		
		$result=D('Ad')->add_ad($data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 获取公告评论列表
	 * index.php?g=api&m=Comments&a=get_comment_list&article_id=文章id
	 */
	public function get_ad_list(){
		$condition['api_partner_id']=$this->_param('api_partner_id','htmlspecialchars,strip_tags');//第三方合作伙伴id
		$condition['partner_site_id']=$this->_param('partner_site_id','htmlspecialchars,strip_tags');//第三方站点id
		$condition['type']=$this->_param('type','htmlspecialchars,strip_tags');
		$condition['store_id']=$this->_param('store_id','htmlspecialchars,strip_tags');
		$condition['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');//用户
		$condition['platform']=$this->_param('platform','htmlspecialchars,strip_tags');
		$condition['page']=$this->_param('page','htmlspecialchars,strip_tags');
		
		$result=D('Ad')->get_ad_list($condition);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 获取评论内容
	 * index.php?g=api&m=Comments&a=get_comment_by_id&id=评论id
	 * 
	 */
	public function getAdById(){
		$id=$this->_param('id','htmlspecialchars,strip_tags');
		$isdetail=$this->_param('isdetail','htmlspecialchars,strip_tags');
		$result=D('Ad')->get_ad_by_id($id,$isdetail);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 修改评论
	 * index.php?g=api&m=Comments&a=update_comment&id=文章id&title=标题&content=内容
	 * 
	 */
	public function update_ad(){
		$id=$this->_param('id','htmlspecialchars,strip_tags');
		$data['api_partner_id']=$this->_param('api_partner_id','htmlspecialchars,strip_tags');//第三方合作伙伴id
		$data['partner_site_id']=$this->_param('partner_site_id','htmlspecialchars,strip_tags');//第三方站点id
		$data['store_id']=$this->_param('store_id','htmlspecialchars,strip_tags',0);//商家id
		$data['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');//用户id
		$data['title']=$this->_param('title','htmlspecialchars,strip_tags');//广告标题
		$data['desc']=$this->_param('desc','htmlspecialchars,strip_tags');//广告描述
		$data['type']=$this->_param('type','htmlspecialchars,strip_tags');//广告类型|Link(链接)、text(文字)、Picture(图片)
		$data['platform']=$this->_param('platform','htmlspecialchars,strip_tags');//设备|AN/IP/H5/WB/MAC/KI
		$data['page']=$this->_param('page','htmlspecialchars,strip_tags');//页面|index/personal_center/good_list/good_detail/article_list..
		$data['text']=$this->_param('text','htmlspecialchars,strip_tags');//文字
		$data['link']=$this->_param('link','htmlspecialchars,strip_tags');//链接
		$data['begin_time']=$this->_param('begin_time','htmlspecialchars,strip_tags',time());//广告开始时间
		$data['end_time']=$this->_param('end_time','htmlspecialchars,strip_tags');//广告借宿时间
		
		$result=D('Ad')->update_adById($id,$data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * index.php?g=api&m=Comments&a=del_comment&id=文章id
	 * 删除
	 */
	public function del_ad(){
		$id=$this->_param('id','htmlspecialchars,strip_tags');
		$result=D('Ad')->del_ad($id);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}

}