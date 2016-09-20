<?php
// 网址导航PC
//个人中心
class OrderAction extends CommonAction {
    public function index(){
    	$condition=array();
    	$condition['pay_money_user_id']=session('id')?session('id'):-1;
//     	print_r($condition);
    	$this->assign('condition',$condition);
		$this->display();
    }
}