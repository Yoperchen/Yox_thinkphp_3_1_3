<?php
// 租赁PC
class NewsAction extends Action {
    public function index(){
		$this->display();
    }
    /**
     * 文章列表
     */
    public function get_article_list(){
    	$condition['type']=$this->_param('type','htmlspecialchars,strip_tags');
    	$condition['store_id']=$this->_param('store_id','htmlspecialchars,strip_tags');
    	$condition['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');//用户
    	$page_size=$this->_param('page_size','htmlspecialchars,strip_tags',12);//每页几条
    
    	$result=D('Article')->get_article_list($condition,$page_size);
    	//print_r($result);
		$this->assign($result);
    	$this->display();
    }
    /**
     * 获取文章、获取公告
     * index.php?g=api&m=Article&a=get_article_by_id&id=文章id
     *
     */
    public function get_article_by_id(){
    	$id=$this->_param('id','htmlspecialchars,strip_tags');
    	$isdetail=$this->_param('isdetail','htmlspecialchars,strip_tags');
    	$result=D('Article')->getArticleById($id,$isdetail);
    	//print_r($result);
		$this->assign($result);
    	$this->display();
    }
}