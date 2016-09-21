<?php
//地址处理
class AddressAction extends ApibaseAction {
	/**
	 * 获取省份列表
	 */
	public function get_provinces_list(){
		$page_size=$this->_param('page_size','htmlspecialchars,strip_tags',12);//每页几条
		$result=D('District')->get_list_by_upid(0,$page_size);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 获取指定省份城市列表
	 */
	public function get_city_list_by_provinces_id(){
		$id=$this->_param('id','htmlspecialchars,strip_tags');
		$page_size=$this->_param('page_size','htmlspecialchars,strip_tags',12);//每页几条
		$result=D('District')->get_list_by_upid($id,$page_size);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 根据城市获取区|天河区、白云区
	 */
	public function get_district_by_city_id(){
		$id=$this->_param('id','htmlspecialchars,strip_tags');
		$page_size=$this->_param('page_size','htmlspecialchars,strip_tags',12);//每页几条
		$result=D('District')->get_list_by_upid($id,$page_size);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	public function get_info_by_district_id(){
		$id=$this->_param('id','htmlspecialchars,strip_tags');
		$result=D('District')->get_info_by_district_id($id);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	
	public function get_city_list(){
		$condition['hot']=$this->_param('hot','htmlspecialchars,strip_tags');//热门城市
		$condition['level']=$this->_param('level','htmlspecialchars,strip_tags',2);//地区级别，1：省，2城市(或直辖市的区)，3：区(镇、街道)
		$condition['character']=$this->_param('character','htmlspecialchars,strip_tags');//字母
		$page_size=$this->_param('page_size','htmlspecialchars,strip_tags',10);
		$result=D('District')->get_city_list($condition,$page_size);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	
	/**
	 * 添加社区、学校
	 */
	public function add_community(){
		$data['name']=$this->_param('name','htmlspecialchars,strip_tags');//社区名称
		$data['desc']=$this->_param('desc','htmlspecialchars,strip_tags');//描述、简介
		$data['city_id']=$this->_param('city_id','htmlspecialchars,strip_tags');//城市id
		$data['official']=$this->_param('official','htmlspecialchars,strip_tags');//官方|万科、华为、腾讯
		$data['district_id']=$this->_param('district_id','htmlspecialchars,strip_tags');//区id
		$data['longitude']=$this->_param('longitude','htmlspecialchars,strip_tags');//经度
		$data['latitude']=$this->_param('latitude','htmlspecialchars,strip_tags');//纬度
		$result=D('Community')->add_community($data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 获取社区列表
	 * @param array $condition 条件
	 * @param intval $page_size  
	 */
	public function get_community_list(){
		$condition['city_id']=$this->_param('city_id','htmlspecialchars,strip_tags');//城市id
		$condition['district_id']=$this->_param('district_id','htmlspecialchars,strip_tags');//区id,对应district表
		$condition['is_school']=$this->_param('is_school','htmlspecialchars,strip_tags');//1：只要学校
		$page_size=$this->_param('page_size','htmlspecialchars,strip_tags',10);
		$result=D('Community')->get_community_list($condition,$page_size);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	} 
	
	/**
	 * 获取社区详细信息
	 */
	public function get_community_info(){
		$id=$this->_param('id','htmlspecialchars,strip_tags');//城市id
		$result=D('Community')->get_info_by_community_id($id);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 获取地址信息
	 */
	public function get_address_by_id()
	{
		$id = I('param.address_id','','int');
		$result=D('Address')->get_address_by_id($id);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 获取地址列表
	 */
	public function get_address_list()
	{
		$condition['belong_user_id'] = I('param.belong_user_id','','int');//所属用户
		$condition['belong_store_id'] = I('param.belong_store_id','','int');//所属商家
		$condition['country_id'] = I('param.country_id','','int');//所属国家
		$condition['province_id'] = I('param.province_id','','int');//省份
		$condition['city_id'] = I('param.city_id','','int');//城市
		$condition['district_id'] = I('param.district_id','','int');//区、天河区
		$condition['default'] = I('param.default','','int');//1：默认地点，0：非默认地点
		$page_size=I('param.page_size',15,'int');
		$result=D('Address')->get_address_list( $condition, $page_size);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 添加地址
	 */
	public function add_address()
	{
		$data['belong_user_id'] = I('param.belong_user_id','','int');//所属用户
		$data['belong_store_id'] = I('param.belong_store_id','','int');//所属商家
		$data['country_id'] = I('param.country_id','','int');//所属国家
		$data['province_id'] = I('param.province_id','','int');//省份
		$data['city_id'] = I('param.city_id','','int');//城市
		$data['district_id'] = I('param.district_id','','int');//区、天河区
		$data['address'] = I('param.address','','htmlspecialchars');//详细
		$data['default'] = I('param.default','','int');//1：默认地点，0：非默认地点
		$result=D('Address')->add_address( $data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 修改地址
	 */
	public function update_address()
	{
		$id = I('param.address_id','','int');
		$data['belong_user_id'] = I('param.belong_user_id','','int');//所属用户
		$data['belong_store_id'] = I('param.belong_store_id','','int');//所属商家
		$data['country_id'] = I('param.country_id','','int');//所属国家
		$data['province_id'] = I('param.province_id','','int');//省份
		$data['city_id'] = I('param.city_id','','int');//城市
		$data['district_id'] = I('param.district_id','','int');//区、天河区
		$data['address'] = I('param.address','','htmlspecialchars');//详细
		$data['default'] = I('param.default','','int');//1：默认地点，0：非默认地点
		$result=D('Address')->update_addressById($id, $data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 删除地址
	 */
	public function del_address_by_id()
	{
		$condition['id'] = I('param.address_id','','int');
		$result=D('Address')->del_address( $condition);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 获取站点地址
	 */
	public function get_host(){
		header("Content-type: text/html; charset=utf-8");
		$host=$this->_server('HTTP_HOST');
		$host=$host.'/';//域名后面添加斜杠
		$result=array('status'=>1,'message'=>'成功','data'=>$host);
		exit(json_encode($result));
	}

}