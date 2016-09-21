<?php
/*
 * 商品api
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
*/
class GoodsAction extends ApibaseAction {
	
	/*
	 * 获取用户商品列表
	 */
	public function list_goods(){
 		$conditions['store_id']=$this->_param('store_id','htmlspecialchars,strip_tags');
 		$conditions['category_id']=$this->_param('category_id','htmlspecialchars,strip_tags');
 		$conditions['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');
 		$conditions['brand']=$this->_param('brand','htmlspecialchars,strip_tags');
 		$conditions['community_id']=$this->_param('community_id','htmlspecialchars,strip_tags');//社区、学校
 		$conditions['city_id']=$this->_param('city_id','htmlspecialchars,strip_tags');//地区id
		$conditions['mobile']=$this->_param('mobile','htmlspecialchars,strip_tags');//手机|联系电话|可能是帮别人上传的
 		$conditions['tag_id']=$this->_param('tag_id','htmlspecialchars,strip_tags');//标签id
 		
 		$page_size=$this->_param('page_size','htmlspecialchars,strip_tags',10);
 		$p=$this->_param('p','htmlspecialchars,strip_tags',1);
 		
 		$Goods  =   D('Goods');
 		$result = $Goods->get_good_list($conditions,$page_size);
 		
 		header("Content-type: text/html; charset=utf-8");
 		exit(json_encode($result));//json格式数据
	}
	/**
	 * 获取商品信息
	 * index.php?g=api&m=Goods&a=get_good_by_id&id=商品id
	 */
	public function get_good_by_id(){
		$id=$this->_param('id','htmlspecialchars,strip_tags');
		if(empty($id)){
			$result=array('status'=>0,'message'=>'id不能为空');
		}else{
			$Goods  =   D('Goods');
			$result=$Goods->getGoodById($id);
		}
		 header("Content-type: text/html; charset=utf-8");
 		exit(json_encode($result));//json格式数据
	}
	/**
	 * 删除商品
	 * index.php?g=api&m=Goods&a=del_good&id=商品id
	 */
	public function del_good(){
		$id=$this->_param('id','htmlspecialchars,strip_tags');
		$Goods  =   D('Goods');
		$result=$Goods->del_good($id);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));//json格式数据
	}
	
	public function update_goodById(){
		$id=$this->_param('id','htmlspecialchars,strip_tags');
		$data['goods_name']=$this->_param('goods_name','htmlspecialchars,strip_tags');//商品名称
		$data['category']=$this->_param('category','htmlspecialchars,strip_tags');//分类
		$data['brand']=$this->_param('brand','htmlspecialchars,strip_tags');//品牌
		$data['sort']=$this->_param('sort','htmlspecialchars,strip_tags');//排序
		$data['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');//用户id
		$data['store_id']=$this->_param('store_id','htmlspecialchars,strip_tags');//商家id
		$data['quantity']=$this->_param('quantity','htmlspecialchars,strip_tags');//数量
		$data['price']=$this->_param('price','htmlspecialchars,strip_tags');
		$data['desc']=$this->_param('desc','htmlspecialchars,strip_tags');
		$data['brief']=$this->_param('brief','htmlspecialchars,strip_tags');
		$data['status']=$this->_param('status','htmlspecialchars,strip_tags');//状态|0:禁止售卖，1：正常
		$data['community_id']=$this->_param('community_id','htmlspecialchars,strip_tags');//社区id,对应community表
		$data['district_id']=$this->_param('district_id','htmlspecialchars,strip_tags');//地区id,对应district表
		$data['tag_id']=$this->_param('tag_id','htmlspecialchars,strip_tags');//标签id,对应tag表
		$data['mobile']=$this->_param('mobile','htmlspecialchars,strip_tags');//手机|联系电话|可能是帮别人上传的
		$data['lng']=$this->_param('lng','htmlspecialchars,strip_tags');//地区id,对应district表
		$data['lat']=$this->_param('lat','htmlspecialchars,strip_tags');//地区id,对应district表
		
		$Good=D('Goods');
		$result=$Good->update_goodById($id,$data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));//json格式数据
		
		
	}
	/**
	 * 添加商品
	 * index.php?g=api&m=Goods&a=add_good&goods_name=商品名称&category=商品分类&brand=商品品牌&quantity=商品数量&price=商品价格&desc=商品描述&img1=商品图片&img2=商品图片&img3=商品图片
	 */
	public function add_good(){
		$data['goods_name']=$this->_param('goods_name','htmlspecialchars,strip_tags');//商品名称
		$data['category']=$this->_param('category','htmlspecialchars,strip_tags');//分类
		$data['brand']=$this->_param('brand','htmlspecialchars,strip_tags');//品牌
		$data['sort']=$this->_param('sort','htmlspecialchars,strip_tags');//排序
		$data['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');//用户id
		$data['store_id']=$this->_param('store_id','htmlspecialchars,strip_tags');//商家id
		$data['quantity']=$this->_param('quantity','htmlspecialchars,strip_tags');//数量
		$data['price']=$this->_param('price','htmlspecialchars,strip_tags');//价格
		$data['desc']=$this->_param('desc','htmlspecialchars,strip_tags');//描述
		$data['brief']=$this->_param('brief','htmlspecialchars,strip_tags');//描述2
		$data['status']=$this->_param('status','htmlspecialchars,strip_tags');//状态|0:禁止售卖，1：正常
		$data['community_id']=$this->_param('community_id','htmlspecialchars,strip_tags');//社区id,对应community表
		$data['district_id']=$this->_param('district_id','htmlspecialchars,strip_tags');//地区id,对应district表
		$data['mobile']=$this->_param('mobile','htmlspecialchars,strip_tags');//手机|联系电话|可能是帮别人上传的
		$data['lng']=$this->_param('lng','htmlspecialchars,strip_tags');//地区id,对应district表
		$data['lat']=$this->_param('lat','htmlspecialchars,strip_tags');//地区id,对应district表
		$Good=D('Goods');
		$result=$Good->add_good($data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));//json格式数据
		
	}
	/**
	 * 商品点赞
	 */
	public function set_good_up(){
		$good_id = $this->_param('good_id','htmlspecialchars,strip_tags',0);
		
		$Good=D('Goods');
		$result = $Good->set_good_up($good_id);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));//json格式数据
	}
	/**
	 * 商品差评
	 */
	public function set_good_down(){
		$good_id = $this->_param('good_id','htmlspecialchars,strip_tags',0);
		
		$Good=D('Goods');
		$result = $Good->set_good_down($good_id);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));//json格式数据	
	}
	/**
	 * 商品喜欢
	 */
	public function set_good_like(){
		$good_id = $this->_param('good_id','htmlspecialchars,strip_tags',0);
		
		$Good=D('Goods');
		$result = $Good->set_good_like($good_id);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));//json格式数据
	}
	/**
	 * 添加分类
	 */
	public function add_category(){
		$Goods_category = D("Goods_category");
		$data['site_id'] =I('param.site_id','0','htmlspecialchars');//所属站点
		$data['store_id'] =I('param.store_id','0','htmlspecialchars');//所属商家
		$data['name'] =I('param.name','没有名称','htmlspecialchars');//分类名称
		$data['pid'] =I('param.pid','0','htmlspecialchars');//三级分类
		$data['description'] =I('param.description','没有描述','htmlspecialchars');//描述
		$data['kewords'] =I('param.kewords','','htmlspecialchars');//关键词
		$data['sort'] =I('param.sort','50','htmlspecialchars');//排序
		$data['is_show'] =I('param.is_show','1','htmlspecialchars');//是否显示
			 
		$result = $Goods_category->add_category($data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));//json格式数据
			
	}
	public function get_category_list()
	{
		$Goods_category = D("Goods_category");
		$condition['site_id'] = I('param.site_id','0','htmlspecialchars');
		$condition['store_id'] = I('param.store_id','0','htmlspecialchars');
		
		$result = $Goods_category->get_good_category_list($condition,$page_size=100);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));//json格式数据
	}
	public function get_category_by_id()
	{
		$category_id = I('param.category_id','0','htmlspecialchars');
		$Goods_category = D("Goods_category");
		$result =   $Goods_category->get_info_by_category_id($category_id);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));//json格式数据
	}
	public function update_category()
	{
		$Goods_category = D("Goods_category");
		$category_id=I('param.category_id','0','htmlspecialchars');//所属站点
		$data['site_id'] =I('param.site_id','0','htmlspecialchars');//所属站点
		$data['store_id'] =I('param.store_id','0','htmlspecialchars');//所属商家
		$data['name'] =I('param.name','没有名称','htmlspecialchars');//分类名称
		$data['pid'] =I('param.pid','0','htmlspecialchars');//三级分类
		$data['description'] =I('param.description','没有描述','htmlspecialchars');//描述
		$data['kewords'] =I('param.kewords','','htmlspecialchars');//关键词
		$data['sort'] =I('param.sort','50','htmlspecialchars');//排序
		$data['is_show'] =I('param.is_show','1','htmlspecialchars');//是否显示
		
		$result = $Goods_category->update_category($category_id,$data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));//json格式数据
	}
	/**
	 * 删除
	 */
	public function del_category()
	{
		$condition['id']= I('param.category_id','0','htmlspecialchars');
		$condition['id']=
		$Goods_category = D("Goods_category");
		
		$result = $Goods_category->del_category($condition);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));//json格式数据
	}

	/**
	 * 品牌列表
	 */
	public function get_brand_list(){
		$page_size=$this->_param('page_size','htmlspecialchars,strip_tags',10);
		$p=$this->_param('p','htmlspecialchars,strip_tags',1);
		
		$conditions = '';//条件
// 		if(!empty($data['store_id'])){//商品所属商家
// 			$conditions['store_id']=array('eq',$data['store_id']);
// 		}

		$Good=D('Brand');
		$result=$Good->get_brand_list($conditions,$page_size);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));//json格式数据
	}
	
	/**
	 * 根据品牌id获取品牌信息
	 */
	public function get_brand_by_id(){
		$id=$this->_param('id','htmlspecialchars,strip_tags');
		$result=D('Brand')->getBrandById($id);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
		
	}
	/**
	 * 添加品牌
	 */
	public function add_brand(){
		$data['site_id']=$this->_param('site_id','htmlspecialchars,strip_tags');//站点ID
		$data['store_id']=$this->_param('store_id','htmlspecialchars,strip_tags');//商家ID
		$data['name']=$this->_param('name','htmlspecialchars,strip_tags');//分类
		$data['desc']=$this->_param('desc','htmlspecialchars,strip_tags');//品牌
		$data['is_show']=$this->_param('is_show','htmlspecialchars,strip_tags');//是否显示
		$data['sort']=$this->_param('sort','htmlspecialchars,strip_tags');//排序
		$data['img_50_50']=$this->_param('img_50_50','htmlspecialchars,strip_tags');//图片
		$data['img_200_200']=$this->_param('img_200_200','htmlspecialchars,strip_tags');//图片
		
		$result=D('Brand')->add_brand($data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 修改品牌
	 */
	public function update_brand(){
		$id = $this->_param('id','htmlspecialchars,strip_tags');//站点ID
		$data['site_id']=$this->_param('site_id','htmlspecialchars,strip_tags');//站点ID
		$data['store_id']=$this->_param('store_id','htmlspecialchars,strip_tags');//商家ID
		$data['name']=$this->_param('name','htmlspecialchars,strip_tags');//分类
		$data['desc']=$this->_param('desc','htmlspecialchars,strip_tags');//品牌
		$data['is_show']=$this->_param('is_show','htmlspecialchars,strip_tags');//是否显示
		$data['sort']=$this->_param('sort','htmlspecialchars,strip_tags');//排序
		$data['img_50_50']=$this->_param('img_50_50','htmlspecialchars,strip_tags');//图片
		$data['img_200_200']=$this->_param('img_200_200','htmlspecialchars,strip_tags');//图片
		
		$result=D('Brand')->update_brandById($id,$data);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
	/**
	 * 删除品牌
	 */
	Public function del_brand(){
		$condition['id'] = $this->_param('brand_id','htmlspecialchars,strip_tags');//品牌ID
		
		$result=D('Brand')->del_brand($condition);
		header("Content-type: text/html; charset=utf-8");
		exit(json_encode($result));
	}
}