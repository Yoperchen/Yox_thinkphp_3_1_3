<?php
// 门户网站PC
class NewsAction extends Action {
    public function index(){
		$this->display();
    }
     public function article_detail(){
     		$id=$this->_param('id','htmlspecialchars,strip_tags',33);//默认33
		$isdetail=$this->_param('isdetail','htmlspecialchars,strip_tags');
		$article_detail_result=D('Article')->getArticleById($id,$isdetail);
		
		$this->assign('article_detail_result',$article_detail_result);
		//print_r($article_detail_result);
		$this->display();
    }
}