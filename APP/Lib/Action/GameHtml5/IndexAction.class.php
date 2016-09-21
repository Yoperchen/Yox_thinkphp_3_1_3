<?php
class CatAction extends Action {
	
public function _empty() {  
    R('Empty/_empty');  
}  
	
	public function index(){

		$this->display();
	}

}