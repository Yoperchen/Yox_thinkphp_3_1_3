<?php
// 企业网站
class ImageAction extends Action {
    public function index(){
		$this->display();
    }
	public function image_list(){
		$site_id=$this->_param('site_id','htmlspecialchars,strip_tags',7);//站点id
		//站点信息
		$site_info = D('Partner_site')->get_site_by_id($site_id);
		
        	$condition['site_id'] = $site_id;
		$condition['is_show']=1;
		//导航
    		$navigation_result = D('Navigation')->get_navigation_list($condition);
		$this->assign('site_info',$site_info);
		
		$this->assign('navigation_result',$navigation_result);
		$this->display();
    }
}