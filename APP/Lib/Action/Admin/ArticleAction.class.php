<?php
/**
 * 文章操作
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class ArticleAction extends AdminbaseAction {
    public function index()
    {
        //检查登录
        $this->check_login();
		$this->display();
    }
    
    public function add_article(){
        //检查登录
        $this->check_login();
    	$data['site_id'] = I('param.site_id','', 'htmlspecialchars');
    	$data['type'] = I('param.type','', 'htmlspecialchars');
    	$data['category_id'] = I('param.category_id','', 'htmlspecialchars');
    	$data['user_id'] = I('param.user_id','', 'htmlspecialchars');
    	$data['store_id'] = I('param.store_id','', 'htmlspecialchars');
    	$data['title'] = I('param.title','', 'htmlspecialchars');
    	$data['desc'] = I('param.desc','', 'htmlspecialchars');
    	$data['content'] = I('param.content','', 'htmlspecialchars');
    	$data['from_url'] = I('param.from_url','', 'htmlspecialchars');
    	$data['author'] = I('param.author','', 'htmlspecialchars');
    	$data['sort'] = I('param.sort','', 'htmlspecialchars');
    	$data['community'] = I('param.community','', 'htmlspecialchars');
    	$data['tag_id'] = I('param.tag_id','', 'htmlspecialchars');
    	$data['up'] = I('param.up','', 'htmlspecialchars');
    	$data['down'] = I('param.down','', 'htmlspecialchars');
    	$data['like'] = I('param.like','', 'htmlspecialchars');
    	
    	if(!empty($data['title'])){
	    	$Article_model   =   D('Article');
	    	$result = $Article_model->add_article($data);
	    	if($result['status']<1){
	    		$this->error($result['message']);
	    	}else{
	    		$this->success($result['message']);
	    	}
    	}else{
    		$this->display();
    	}
    }
    public function list_article()
    {
    	$condition = array();
    	$condition['title'] = array('like','%'.I('param.add_time1','', 'htmlspecialchars').'%');
    	$add_time1=I('param.add_time1','', 'htmlspecialchars');
    	$add_time2=I('param.add_time2','', 'htmlspecialchars');
    	if(!empty($add_time1)&&$add_time2)
    	{
    		$condition['add_time'] = array(
    				array('gt',strtotime($add_time1)),
    				array('lt',strtotime($add_time2))
    		);
    	}
    	
    	$Article_model   =   D('Article');
    	$condition=array();
    	$article_list_result = $Article_model->get_article_list($condition,$page_size=20);
    	if($article_list_result['status']<1){
    		$this->error($article_list_result['message']);
    	}
//     	print_r($article_list_result);
    	$this->assign('article_list_result',$article_list_result);
    	$this->display();
    }
    /**
     * 修改文章
     */
    public function update_article()
    {
    	$article_id = I('param.id','', 'htmlspecialchars');
    	$data['site_id'] = I('param.site_id','', 'htmlspecialchars');
    	$data['type'] = I('param.type','', 'htmlspecialchars');
    	$data['category_id'] = I('param.category_id','', 'htmlspecialchars');
    	$data['user_id'] = I('param.user_id','', 'htmlspecialchars');
    	$data['store_id'] = I('param.store_id','', 'htmlspecialchars');
    	$data['title'] = I('param.title','', 'htmlspecialchars');
    	$data['desc'] = I('param.desc','', 'htmlspecialchars');
    	$data['content'] = I('param.content','', 'htmlspecialchars');
    	$data['from_url'] = I('param.from_url','', 'htmlspecialchars');
    	$data['author'] = I('param.author','', 'htmlspecialchars');
    	$data['sort'] = I('param.sort','', 'htmlspecialchars');
    	$data['community'] = I('param.community','', 'htmlspecialchars');
    	$data['tag_id'] = I('param.tag_id','', 'htmlspecialchars');
    	$data['up'] = I('param.up','', 'htmlspecialchars');
    	$data['down'] = I('param.down','', 'htmlspecialchars');
    	$data['like'] = I('param.like','', 'htmlspecialchars');
    	$data['img1'] = I('param.img1','', 'htmlspecialchars');
    	$data['img2'] = I('param.img2','', 'htmlspecialchars');
    	$data['img3'] = I('param.img3','', 'htmlspecialchars');
    	$Article_model   =   D('Article');
    	$article_info_result = $Article_model->getArticleById($article_id);
    	
    	if($article_info_result['status']>0) 
    	{
    		if(!empty($data['title']))
    		{
    			$result = $Article_model->update_articleById($article_id,$data);
    			if($result['status']==1){
    				$this->success('修改成功',U('Article/list_article@admin'));
    			}else{
    				$this->error($result['message']);
    			}
    		}else{
    			$this->assign('article_info_result',$article_info_result);
    			//     	print_r($article_info_result);
    			$this->display();
    		}
    		
    	}else{
    		$this->error($article_info_result['message']);
    	}
    }
	public function list_article_category(){ 
	    $condition=array();
	    $page_size = 50;
	    $article_category_model = D('Article_category');
	    
	    $category_list_result = $article_category_model->get_article_category_list($condition,$page_size);
	    //print_r($category_list_result);
	    $this->assign('category_list_result',$category_list_result);
	    $this->display();
	}
	public  function update_category(){//修改分类
		$article_category_model = D('Article_category');
		$category_id = I('param.category_id','0','htmlspecialchars');
		if(!empty($category_id) && I('param.op','0','htmlspecialchars')=='update'){//写到数据库
			$data['name'] =I('param.category_name','0','htmlspecialchars');
			$data['store_id'] =I('param.store_id','0','htmlspecialchars');
			$data['pid'] =I('param.store_id','0','htmlspecialchars');
			$data['description'] =I('param.description','0','htmlspecialchars');
			$data['keywords'] =I('param.keywords','0','htmlspecialchars');
			$data['sort'] =I('param.sort','0','htmlspecialchars');
			$data['is_show'] =I('param.is_show','0','htmlspecialchars');
	
			$category_update_result =   $article_category_model->update_CategoryById($category_id,$data);
			// 	    		print_r($data);
			if($category_update_result['status']) {
				$this->success($category_update_result['message']);
			}else{
				$this->error($category_update_result['message']);
			}
		}else{
			$category_info_result =   $article_category_model->getCategoryById($category_id);
			if($category_info_result['status']) {
				$this->category_info_result =   $category_info_result;// 模板变量赋值
			}else{
				$this->error($category_info_result['message']);
			}
		}
		$this->display();
	}
}