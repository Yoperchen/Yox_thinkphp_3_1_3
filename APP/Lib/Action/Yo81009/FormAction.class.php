<?php
// 企业网站
class FormAction extends Action {
    public function index()
    {
    
    	$condition['site_id']=$this->_param('site_id','htmlspecialchars,strip_tags',7);//站点id
		$condition['is_show']=1;
		//导航
    	$navigation_result = D('Navigation')->get_navigation_list($condition);
		
		//站点设置
		$site_info = D('Partner_site')->get_site_by_id($condition['site_id']);
		$template= $site_info['data']['template']?$site_info['data']['template']:'default_theme';
		//C('DEFAULT_THEME',$template);//模板
		
		$result_article_list = D('Article')->get_article_list($condition,$page_size=20);
		if($result_article_list['status']!=1){
			$this->error($result_article_list['message']);
		}
		
		//print_r($navigation_result);
		//print_r($site_info);
		
		$this->assign('navigation_result',$navigation_result);
		$this->assign('site_info',$site_info);
		$this->assign('result_article_list',$result_article_list);
		$this->display();
    }

    public function item_list()
    {
        $category_id = I('get.category_id');
        
    }
    public function item_list_category_74() 
    {
        $this->display();
    }
}