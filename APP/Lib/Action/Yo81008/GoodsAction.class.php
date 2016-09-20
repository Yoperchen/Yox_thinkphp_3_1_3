<?php
// 网址导航PC
//个人中心
class GoodsAction extends Action {
    public function index(){
		$this->display();
    }
    public function goods_detail()
    {
    	$goods_id = I('goods_id',1);
    	$this->assign('goods_id',$goods_id);
    	$this->display();
    }
}