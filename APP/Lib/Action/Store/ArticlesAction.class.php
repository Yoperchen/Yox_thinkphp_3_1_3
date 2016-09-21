<?php
//文章
class ArticlesAction extends Action {
	public function index(){
		$this->display();
	}
    public function add_article(){
    	
    	if(I('param.op','0','htmlspecialchars')=='add'){
    		$data['title'] =I('param.title','没有标题','htmlspecialchars');//分类
    		$Article = D('Article');
    		if($Article->add($data)){
    			echo '<a style="color:green;">添加成功</a>';
    		}

    	}
		$this->display();
    }
    public function del_article(){
    	
    	if(I('param.article_id','0','htmlspecialchars')){
    		
    		$Article = D('Article');
    		$conditions['id']=array('eq',I('param.article_id','','htmlspecialchars'));//条件
    		if($Article->where($conditions)->delete()){
    			$this->success('删除成功');
    		}
    	}
    }
    
    public  function list_article(){
    	$this->display();
    }
    public function update_article(){
    	$Article= D('Article');
    	if(I('param.article_id','0','htmlspecialchars')&&I('param.op','0','htmlspecialchars')=='update'){//写到数据库
    		$data['title'] =I('param.title','没有标题','htmlspecialchars');//分类
    		 
    		$conditions['id']=array('eq',I('param.article_id','','htmlspecialchars'));//条件
    	
    		$Article->where($conditions)->save($data); // 根据条件保存修改的数据
    		 
    		$data =   $Article->find($this->_param('good_id'));
    		if($data) {
    			$this->data =   $data;// 模板变量赋值
    		}else{
    			$this->error('数据错误~');
    		}
    	}else{
    		$data =   $Article->find($this->_param('good_id'));
    		if($data) {
    			$this->data =   $data;// 模板变量赋值
    		}else{
    			$this->error('数据错误~');
    		}
    	}
    	$this->display();
    }

}