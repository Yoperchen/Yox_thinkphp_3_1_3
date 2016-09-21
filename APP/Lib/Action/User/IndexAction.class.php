<?php
// 用户
class IndexAction extends Action {
    public function index(){
    		$user_condition['id']=$this->_param('user_id','htmlspecialchars,strip_tags','');//站点id
    		empty($user_condition['id'])?header('Location:http://www.linglingtang.com/index.php?s=User/Index/index&user_id=1'):'';
		     $article_condition['user_id']=$user_condition['id'];
		     $navigation_condition['user_id']=$user_condition['id'];
		//导航
    		$navigation_result = D('Navigation')->get_navigation_list($navigation_condition);
		
		//站点设置
		$user_info_result = D('User')->get_user_info($user_condition,$isdetail=0);
		$article_list_result = D('Article')->get_article_list($article_condition,$page_size=20);
		$template= $user_info_result['data']['template']?$user_info_result['data']['template']:'default_theme';
		C('DEFAULT_THEME',$template);//模板
		
		//print_r($navigation_result);
		//print_r($user_info_result);
		
		$this->assign('article_list_result',$article_list_result);
		$this->assign('user_info_result',$user_info_result);
		$this->display();
    }
}