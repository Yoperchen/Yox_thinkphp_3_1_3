<?php
/**
 * 猫
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class CatAction extends Action {
	
public function _empty() {  
    R('Empty/_empty');  
}  
	
	public function index(){

		$this->display();
	}

}