<?php
/**
 * 商家管理
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class StoreAction extends AdminbaseAction {
    public function index()
    {
        $this->display();
    }
		//增
		public function add_store(){
			$data['site_id'] =I('param.title','', 'htmlspecialchars');
			$data['password'] =I('param.title','', 'htmlspecialchars');
			$data['store_name'] =I('param.title','', 'htmlspecialchars');
			$data['keywords'] =I('param.title','', 'htmlspecialchars');
			$data['logo'] =I('param.title','', 'htmlspecialchars');
			$data['banner'] =I('param.title','', 'htmlspecialchars');
			$data['sort'] =I('param.sort','', 'htmlspecialchars');
			$data['community_id'] =I('param.community_id','', 'htmlspecialchars');
			$data['city_id'] =I('param.city_id','', 'htmlspecialchars');
			$data['up'] =I('param.up','', 'htmlspecialchars');
			$data['down'] =I('param.down','', 'htmlspecialchars');
			$data['like'] =I('param.like','', 'htmlspecialchars');
			$data['status'] =I('param.status','', 'htmlspecialchars');
			$Stores_model = D('Stores');
			if(!empty($data['store_name'])){
				$store_add_result = $Stores_model->add_store($data);
				if($store_add_result['status']<1){
					$this->error($store_add_result['message']);
				}else{
					$this->success($store_add_result['message']);
				}
			}else{
				$this->display();
			}
		}
		//商品列表(查)
	    public function list_store(){
	    	$Store_model = D('Stores');
	    	$condition=array();
	    	$site_id =I('param.site_id','', 'htmlspecialchars');
	    	$city_id =I('param.city_id','', 'htmlspecialchars');
	    	$store_name=I('param.store_name','', 'htmlspecialchars');
	    	 
	    	if(!empty($site_id))$condition['site_id']=$site_id;
	    	if(!empty($store_name))$condition['store_name']=array('like','%'.$store_name.'%');
	    	if(!empty($store_name))$condition['city_id']=$city_id;
	    	$store_list_result = $Store_model->get_store_list($condition,$page_size=20);
	    	if($store_list_result['status']<1){
	    		$this->error($store_list_result['message']);
	    	}
	    	$this->assign('store_list_result',$store_list_result);
			$this->display();
	    }
	    //改
	    public function update_store(){
	    	$id=I('param.id','', 'htmlspecialchars');
	    	$data['site_id'] =I('param.title','', 'htmlspecialchars');
			$data['password'] =I('param.title','', 'htmlspecialchars');
			$data['store_name'] =I('param.title','', 'htmlspecialchars');
			$data['keywords'] =I('param.title','', 'htmlspecialchars');
			$data['logo'] =I('param.title','', 'htmlspecialchars');
			$data['banner'] =I('param.title','', 'htmlspecialchars');
			$data['sort'] =I('param.sort','', 'htmlspecialchars');
			$data['community_id'] =I('param.community_id','', 'htmlspecialchars');
			$data['city_id'] =I('param.city_id','', 'htmlspecialchars');
			$data['up'] =I('param.up','', 'htmlspecialchars');
			$data['down'] =I('param.down','', 'htmlspecialchars');
			$data['like'] =I('param.like','', 'htmlspecialchars');
			$data['status'] =I('param.status','', 'htmlspecialchars');
			$Store_model = D('Stores');
			if(!empty($data['store_name'])){
				$store_update_result = $Store_model->update_storeById($id,$data);
				if($store_update_result['status']<1){
					$this->error($store_update_result['message']);
				}else{
					$this->success($store_update_result['message']);
				}
			}else{
				$store_info_result = $Store_model->getStoreById($id,$isdetail=0);
				$this->assign('store_info_result',$store_info_result);
	    		$this->display();
			}
	    }
	    //删
	    public function del_store(){
	    	$Stores = D('Stores');
	    		
	    	$id = I('param.id','', 'htmlspecialchars');
	    	$data['status']=4;//状态|1正常,2禁止,3黑名单,4删除
	    	$store_del_result = $Stores->update_storeById($id,$data);
	    	if($store_del_result['status']<1){
	    		$this->error($store_del_result['message']);
	    	}else{
	    		$this->success($store_del_result['message']);
	    	}
	    		
	    }
}