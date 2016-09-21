<?php
/**
 * 导航管理
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class NavigationAction extends AdminbaseAction {
    public function index()
    {
		$this->display();
    }
    /**
     * 添加导航
     */
  public function add_navigation(){
  	$data['site_id'] =I('param.site_id','0','htmlspecialchars');//站点ID
  	$data['name'] =I('param.name','0','htmlspecialchars');//名称
  	$data['store_id'] =I('param.store_id','0','htmlspecialchars');//商家id
  	$data['pid'] =I('param.store_id','0','htmlspecialchars');//上级导航id
  	$data['description'] =I('param.description','0','htmlspecialchars');//描述
  	$data['keywords'] =I('param.keywords','0','htmlspecialchars');//关键字，可用于seo
  	$data['url'] =I('param.url','0','htmlspecialchars');//跳转url
  	$data['position'] =I('param.position','0','htmlspecialchars');//1:顶部，2：主要导航，3底部导航
  	$data['blank'] =I('param.blank','0','htmlspecialchars');//是否新标签打开|0：否，1：是
  	$data['is_show'] =I('param.is_show','0','htmlspecialchars');//1:显示，2：隐藏
  	if(!empty($data['name']))
  	{
  		$navigation_model = D('Navigation');
  		$navigation_add_result = $navigation_model->add_navigation($data);
  		if($navigation_add_result['status']<1)
  		{
  			$this->error($navigation_add_result['message']);
  		}else{
  			$this->success($navigation_add_result['message']);
  		}
  	}else{
  		$this->display();
  	}
  	
  	
  }
  /**
   * 导航条列表
   */
	public function list_navigation(){ 
	    $condition=array();
	    $page_size = 100;
	    $navigation_model = D('Navigation');
	    
	    $navigation_list_result = $navigation_model->get_navigation_list($condition,$page_size);
	    //print_r($category_list_result);
	    $this->assign('navigation_list_result',$navigation_list_result);
	    $this->display();
	}
	/**
	 * 修改导航条
	 */
	public  function update_navigation(){//修改分类
		$navigation_model = D('Navigation');
		$navigation_id = I('param.navigation_id','0','htmlspecialchars');
		if(!empty($navigation_id) && I('param.name','0','htmlspecialchars'))
		{
			$data['site_id'] =I('param.site_id','0','htmlspecialchars');//站点ID
			$data['store_id'] =I('param.store_id','0','htmlspecialchars');//商家id
			$data['name'] =I('param.name','0','htmlspecialchars');//名称
			$data['pid'] =I('param.store_id','0','htmlspecialchars');//上级导航id
			$data['description'] =I('param.description','0','htmlspecialchars');//描述
			$data['keywords'] =I('param.keywords','0','htmlspecialchars');//关键字，可用于seo
			$data['url'] =I('param.url','0','htmlspecialchars');//跳转url
			$data['position'] =I('param.position','0','htmlspecialchars');//1:顶部，2：主要导航，3底部导航
			$data['blank'] =I('param.blank','0','htmlspecialchars');//是否新标签打开|0：否，1：是
			$data['is_show'] =I('param.is_show','0','htmlspecialchars');//1:显示，2：隐藏
			//修改
			$category_update_result =   $navigation_model->update_category($navigation_id,$data);
			// 	    		print_r($data);
			if($category_update_result['status']) {
				$this->success($category_update_result['message']);
			}else{
				$this->error($category_update_result['message']);
			}
		}else{
			$navigation_info_result =   $navigation_model->get_navigation_by_id($navigation_id);
			if($navigation_info_result['status']) {
				$this->navigation_info_result =   $navigation_info_result;// 模板变量赋值
			}else{
				$this->error($navigation_info_result['message']);
			}
		}
		$this->display();
	}
	/**
	 * 删除导航
	 */
	public function delete_navigation(){
		$navigation_model = D('Navigation');
		$category_id = I('param.navigation_id','0','htmlspecialchars');
		$condition['id']=$category_id;
		$navigation_delete_result = $navigation_model->del_navigation( $condition);
		if($navigation_delete_result['status']<1)
		{
			$this->error($navigation_delete_result['message']);
		}else{
			$this->success($navigation_delete_result['message']);
		}
	}
}