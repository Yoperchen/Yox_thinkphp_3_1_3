<?php
//文章
class IncomingCallLogAction extends Action {
    public function getCallList(){
    	$data['store_id'] =$this->_post('store_id', 'htmlspecialchars');//商家
    	$data['tel'] =$this->_post('tel', 'htmlspecialchars');//电话
    	$data['user_id'] =$this->_post('user_id', 'htmlspecialchars');//电话
    	$data['startTime'] =$this->_post('startTime', 'htmlspecialchars');//开始时间
    	$data['endTime'] =$this->_post('endTime', 'htmlspecialchars');//结束时间
    	$this->data = $data;
    	print_r($data);
		$this->display('list_incoming_call_log');
    }
}