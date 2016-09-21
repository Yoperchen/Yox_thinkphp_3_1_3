<?php
// 门户网站PC
class IndexAction extends Action {
    public function index(){
    	//文章列表12条
    	$condition['type']=$this->_param('type','htmlspecialchars,strip_tags');//1:公告;2:普通文章;3:论坛贴;4日志;5说说
	$condition['store_id']=$this->_param('store_id','htmlspecialchars,strip_tags');
	$condition['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');//用户
	$page_size=$this->_param('page_size','htmlspecialchars,strip_tags',12);//每页几条	
	$result=D('Article')->get_article_list($condition,$page_size);
	//if(APP_DEBUG==true){echo 'result:<br/>';print_r($result);}
	
	//24小时最热12条
	//$hot_24_hours_condition['type']=$this->_param('type','htmlspecialchars,strip_tags');//1:公告;2:普通文章;3:论坛贴;4日志;5说说
	//$hot_24_hours_condition['store_id']=$this->_param('store_id','htmlspecialchars,strip_tags');
	//$hot_24_hours_condition['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');//用户
	//$hot_24_hours_condition['add_time']=array('GT',strtotime("-1 day"));//大于当前时间
	//$hot_24_hours_condition['add_time']=array('LT',time());//小于当前时间
	$hot_24_hours_page_size=$this->_param('page_size','htmlspecialchars,strip_tags',12);//每页几条
	$hot_24_hours_result=D('Article')->get_article_list($hot_24_hours_condition,$hot_24_hours_page_size);
	if(empty($hot_24_hours_result['data']['list']) || count($hot_24_hours_result['data']['list']<2)){
		$hot_24_hours_result=$result;
	}
	//if(APP_DEBUG==true){echo 'hot_24_hours_result:<br/>';var_dump($hot_24_hours_result);}
	
	//最热网友12条
	//$hot_user_list_condition['is_mobile_verify']=1;//已验证过手机
	//$hot_user_list_condition['like']=array('GT',10);//大于10
	//$hot_user_list_condition['name']=array('NEQ','');//用户名不为空
	$hot_user_page_size=$this->_param('page_size','htmlspecialchars,strip_tags',12);//每页几条
	$hot_user_result=D('User')->get_user_list($hot_user_list_condition,$hot_user_page_size);
	if(empty($hot_user_result['data']['list'])
	|| count($hot_user_result['data']['list']<2)){
		$hot_user_result=$result;
	}
	//if(APP_DEBUG==true){echo 'hot_user_result:<br/>';var_dump($hot_user_result);}
	
	//昨天最热头条5条
	//$hot_yesterday_condition['type']=$this->_param('type','htmlspecialchars,strip_tags');//1:公告;2:普通文章;3:论坛贴;4日志;5说说
	//$hot_yesterday_condition['store_id']=$this->_param('store_id','htmlspecialchars,strip_tags');
	//$hot_yesterday_condition['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');//用户
	//$hot_yesterday_condition['add_time']=array('GT',strtotime("-2 day"));//大于当前时间
	//$hot_yesterday_condition['add_time']=array('LT',strtotime("-1 day"));//小于当前时间
	$hot_yesterday_page_size=$this->_param('page_size','htmlspecialchars,strip_tags',5);//每页几条
	$hot_yesterday_result=D('Article')->get_article_list($hot_24_hours_condition,$hot_24_hours_page_size);
	if(empty($hot_yesterday_result['data']['list'])
	|| count($hot_yesterday_result['data']['list']<2)){
		$hot_yesterday_result=$result;
	}
	//if(APP_DEBUG==true){echo 'hot_yesterday_result:<br/>';var_dump($hot_yesterday_result);}
	//print_r($result);
	$this->assign('result',$result);
    	$this->assign('hot_24_hours_result',$hot_24_hours_result);
	$this->assign('hot_user_result',$hot_user_result);
	$this->assign('hot_yesterday_result',$hot_yesterday_result);
	$this->display();
    }
}