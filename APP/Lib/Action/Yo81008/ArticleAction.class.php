<?php
// 网址导航PC
//个人中心
class ArticleAction extends CommonAction {
    public function index(){
    	$condition['community_id']=I('community_id','');
    	$condition['city_id']=I('city_id','');
//     	print_r($condition);
    	$this->assign('condition',$condition);;
	$this->display();
    }
    /**
     * 文章列表
     */
    public function article_list()
    {
//     	$condition['user_id']=session('?id')?session('id'):1;//默认id为1,测试用
    	$condition['type']=$this->_param('type','htmlspecialchars,strip_tags');
    	$condition['store_id']=$this->_param('store_id','htmlspecialchars,strip_tags');
    	$condition['tag_id']=$this->_param('tag_id','htmlspecialchars,strip_tags');
    	$page_size=$this->_param('page_size','htmlspecialchars,strip_tags');
    	$Article_model=D('Article');
    	$result = $Article_model->get_article_list($condition,$page_size=20);
    	if($this->isAjax())
    	{
    		die(json_encode($result));
    	}
    	$this->assign('result',$result);
    	$this->display();
    }
    public function add_article()
    {
        //检查登录
        if(session('account_type')!='user' && session('id')<1)
        {
            $message='没有登录，请先登录哦。';
            $this->error($message,'',$this->isAjax());
        }
    	$data['user_id']=session('id')?session('id'):0;
    	$data['store_id']=I('store_id',0,'htmlspecialchars,strip_tags');
    	$data['title']=$this->_param('title','htmlspecialchars,strip_tags');
    	$data['type']=$this->_param('type','htmlspecialchars,strip_tags');
    	$data['category_id']=$this->_param('category_id','htmlspecialchars,strip_tags');//分类id
    	$data['desc']=$this->_param('desc','htmlspecialchars,strip_tags');
    	$data['content']=$this->_param('content','htmlspecialchars,strip_tags');
    	$data['sort']=$this->_param('sort','htmlspecialchars,strip_tags');
    	$data['from_url']=$this->_param('from_url','htmlspecialchars,strip_tags');
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
		if(!empty($data['title'])){
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
		}else{
	// 		$article_condition['type']=4;
	// 		$article_condition['user_id']=session('id')?session('id'):0;
	// 		$this->assign('article_condition',$article_condition);
			$this->display();
		}
    }
    /**
     * 文章详情
     */
    public function article_detail()
    {
    	$condition['article_id']=I('article_id',0,'int');
	//print_r($condition);
    	$this->assign('condition',$condition);
    	$this->display();
    }
}