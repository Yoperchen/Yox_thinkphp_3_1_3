<?php
class PageAction extends ApibaseAction {	
	
	public function _initialize() {
		//$this->check_sql_filter();		
	}
	public function index() {
		$api_key = I( 'param.api_key', '', 'int' );
		$api_category= I('param.api_category');
		//file_put_contents('./data/tmp/all-ap'.$_REQUEST['userId'].'.txt', var_export($_REQUEST, true));
		Log::write($_REQUEST,'INFO');
        
		$check_result = $this->check_parameters_legality();

		if($check_result['status']!=1)
		{
			die(json_encode($check_result));
		}
		R ( $this->api_array[$api_category][$api_key]['api']);
	}
	public function is_check_url() {
		return false;
		//return in_array($ma, array(1009,1010,1025,1027,1028,1014,1015,1016,1047,1035,1034,1011,1013,5016,1026,1041,1040,1045));
	}
}