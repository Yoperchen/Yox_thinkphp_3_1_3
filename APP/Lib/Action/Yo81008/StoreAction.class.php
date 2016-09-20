<?php
// 网址导航PC
class StoreAction extends CommonAction {
    public function index(){
		$this->display();
    }
    public function home(){
    	$navigation_condition['store_id']=I('store_id',1,'int');
    	$goods_condition['store_id']=I('store_id',1,'int');
    	$this->assign('navigation_condition',$navigation_condition);
    	$this->assign('goods_condition',$goods_condition);
		$this->display();
    }
    public function store_detail(){
    	$navigation_condition['store_id']=I('store_id',1,'int');
    	$goods_condition['store_id']=I('store_id',1,'int');
    	$this->assign('navigation_condition',$navigation_condition);
    	$this->assign('goods_condition',$goods_condition);
    	$this->display();
    }
}