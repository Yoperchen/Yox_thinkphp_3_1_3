<?php
/**
 * 文章
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class ArticleAction extends Action {
    public function index(){
    	die('common项目');
		$this->display();
    }
    public function add_article()
    {
    	$data['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');
    	$data['store_id']=$this->_param('store_id','htmlspecialchars,strip_tags');
    	$data['title']=$this->_param('title','htmlspecialchars,strip_tags');
    	$data['type']=$this->_param('type','htmlspecialchars,strip_tags');
    	$data['category_id']=$this->_param('category_id','htmlspecialchars,strip_tags');//分类id
    	$data['desc']=$this->_param('desc','htmlspecialchars,strip_tags');
    	$data['content']=I('content','',null);
    	$data['sort']=$this->_param('sort','htmlspecialchars,strip_tags');
    	$data['from_url']=$this->_param('from_url','url');
    	$data['author']=$this->_param('author','htmlspecialchars,strip_tags');
    	$data['community_id']=$this->_param('community_id','htmlspecialchars,strip_tags');
    	$data['up']=$this->_param('up','htmlspecialchars,strip_tags');
    	$data['down']=$this->_param('down','htmlspecialchars,strip_tags');
    	$data['like']=$this->_param('like','htmlspecialchars,strip_tags');
    	$data['status']=$this->_param('status','htmlspecialchars,strip_tags');
    	$data['view']=$this->_param('view','htmlspecialchars,strip_tags');
    	$data['img1']=$this->_param('img1','htmlspecialchars,strip_tags');
    	$data['img2']=$this->_param('img2','htmlspecialchars,strip_tags');
    	$data['img3']=$this->_param('img3','htmlspecialchars,strip_tags');
    	$result=D('Article')->add_article($data);
    	if($this->isAjax())
    	{
    		die(json_encode($result));
    	}
    	if($result['status']>0){
    		$this->success($result['message']);
    	}else {
    		$this->error($result['message']);
    	}
    }
    public function article_detail()
    {
    	$article_id=I('article_id','','int');
    	$isdetail=I('isdetail','','htmlspecialchars');
    	$this->assign('article_id',$article_id);
    	$this->assign('isdetail',$isdetail);
    	$this->display ();
    }
    
    public function del_article()
    {
    	$article_id=I('param.article_id','','htmlspecialchars');
    	$del_result = D('Article')->del_article($article_id);
    	if(!$this->isAjax())
    	{
    		if($del_result['status']==1)
    		{
    			$this->success($del_result['message']);
    		}
    		else
    		{
    			$this->error($del_result['message']);
    		}
    	}
    	else
    	{
    		$this->ajaxReturn($del_result['data'],$del_result['message'],$del_result['status']);
    	}
    }
}