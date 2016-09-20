<?php
// 网址导航PC
class ShareAction extends CommonAction {
    public function index(){
    	$share_condition['belong_user_id']=I('belong_user_id','','int');
    	$this->assign('share_condition',$share_condition);
		$this->display();
    }
    public function home(){
    	$share_condition['belong_user_id']=I('belong_user_id','','int');
    	$this->assign('share_condition',$share_condition);
		$this->display();
    }
    public function list_share(){
    	$share_condition['belong_user_id']=I('belong_user_id',1,'int');
    	$this->assign('share_condition',$share_condition);
    	$this->display();
    }
    public function share_detail(){
    	$share_condition['share_id']=I('share_id',1,'int');
    	$this->assign('share_condition',$share_condition);
    	$this->display();
    }
}