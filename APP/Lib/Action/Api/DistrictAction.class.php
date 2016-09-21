<?php
/**
 * 地区管理
 * @author Yoper
 *
 */
class DistrictAction extends ApibaseAction {
	/*
	 * 添加地区
	*/
	public function add_district(){
		$data['name']=I('name','','htmlspecialchars');//地区名称
		$data['level']=I('level','','int');//级别
		$data['upid']=I('upid','','int');//上级id
		$data['rank']=I('upid','','int');//排序
		$data['hot']=I('hot','','int');//是否热门
		$data['character']=I('character','','htmlspecialchars,strip_tags');//字母
		
		$result=D('District')->add_district($data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 获取地区列表
	 * index.php?g=api&m=Comments&a=get_comment_list&article_id=文章id
	 */
	public function get_district_list(){
		$condition['name']=I('name','','htmlspecialchars');//地区名称
		$condition['level']=I('level','','int');//级别
		$condition['upid']=I('upid','','int');//上级id
		$condition['rank']=I('rank','','int');//排序
		$condition['hot']=I('hot','','int');//是否热门
		$condition['alphabet']=I('alphabet','','htmlspecialchars,strip_tags');//字母
		$condition['page']=$this->_param('page','htmlspecialchars,strip_tags');
		
		$result=D('District')->get_district_list($condition,'*');
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 获取地区内容
	 * index.php?g=api&m=Comments&a=get_comment_by_id&id=评论id
	 * 
	 */
	public function getDistrictById(){
		$id=I('id','','int');
		$isdetail=I('isdetail','0','int');
		$result=D('District')->get_district_by_id($id,$isdetail);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 修改地区
	 * 
	 * 
	 */
	public function update_district(){
		$id=I('id','','int');//id
		$data['name']=I('name','','htmlspecialchars');//地区名称
		$data['level']=I('level','','int');//级别
		$data['upid']=I('upid','','int');//上级id
		$data['rank']=I('upid','','int');//排序
		$data['hot']=I('hot','','int');//是否热门
		$data['character']=I('character','','htmlspecialchars,strip_tags');//字母
		
		$result=D('District')->update_districtById($id,$data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * index.php?g=api&m=Comments&a=del_comment&id=文章id
	 * 删除
	 */
	public function del_district(){
		$id=I('id','','int');//id
		$result=D('District')->del_district($id);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}

}