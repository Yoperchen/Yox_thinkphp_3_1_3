<?php
/*
 * 商家api
 */
class StoresAction extends ApibaseAction {
		/*
		 * 获取商家列表
		 */
	public function get_store_list(){
		$condition['community_id']=$this->_param('community_id','htmlspecialchars,strip_tags',0);//社区id
		$condition['city_id']=$this->_param('city_id','htmlspecialchars,strip_tags',0);//城市id
		$store_name=$this->_param('name','htmlspecialchars,strip_tags',0);
 		if(!empty($_REQUEST['store_name'])){
 			$conditions['store_name']=array('like','%'.$store_name.'%');
 		}
 		$data = D('Stores')-> get_store_list($condition,$page_size=20);
 		header("Content-type: text/html; charset=utf-8");
 		exit(json_encode($data));//json格式数据
	}
}