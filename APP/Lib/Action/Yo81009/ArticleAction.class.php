<?php
// 网址导航PC
class ArticleAction extends Action {
	public function article_list(){
		$site_id=$this->_param('site_id','htmlspecialchars,strip_tags',7);//站点id
		//站点信息
		$site_info = D('Partner_site')->get_site_by_id($site_id);
		
        	$condition['site_id'] = $site_id;
		$condition['is_show']=1;
		//导航
    		$navigation_result = D('Navigation')->get_navigation_list($condition);
		
    		$condition['site_id']=$this->_param('site_id','htmlspecialchars,strip_tags',7);
    		$result_article_list = D('Article')->get_article_list($condition,$page_size=20);
		if($navigation_result['status']!=1){
			$this->error('查找出错');
		}
		if($result_article_list['status']!=1){
			$this->error('查找出错');
		}
		
		//print_r($site_info);
		//print_r($navigation_result);
		//print_r($result_article_list);
		
		$this->assign('site_info',$site_info);
		$this->assign('navigation_result',$navigation_result);
		$this->assign('result_article_list',$result_article_list);
		$this->display();
    }
	public function content(){
		$site_id=$this->_param('site_id','htmlspecialchars,strip_tags',7);//站点id
		//站点信息
		$site_info = D('Partner_site')->get_site_by_id($site_id);
		
		//导航
		$condition['site_id']=$site_id;//站点id
		$condition['is_show']=1;
    		$navigation_result = D('Navigation')->get_navigation_list($condition);
		
		//文章详细
		$id = $this->_param('id','htmlspecialchars,strip_tags',1);
		$ArticleModel = D('Article');
		$article_result = $ArticleModel->getArticleById($id,$isdetail=0);
		$article_result2 = $ArticleModel->getArticleById($id-1,$isdetail=0);//上一篇
		$article_result3 = $ArticleModel->getArticleById($id+1,$isdetail=0);//下一篇
		
		if($article_result['status']!=1){
			$this->error('查找出错');
		}
		if($navigation_result['status']!=1){
			$this->error('查找出错');
		}
		
		//print_r($site_info);
		//print_r($article_result);
		//print_r($article_result2);
		//print_r($article_result3);
		//print_r($navigation_result);
		
		$this->assign('site_info',$site_info);
		$this->assign('navigation_result',$navigation_result);
		$this->assign('article_result',$article_result);
		$this->assign('article_result2',$article_result2);
		$this->assign('article_result3',$article_result3);
		$this->display();
    }
}