<?php  
/** 
 * @空操作 404等错误 
 */  
class EmptyAction extends Action {  
    public function _initialize(){  
    }  
      
    public function index() {  
        $this->_empty();  
    }  
      
    public function _empty() {  
        $this->display('Public:404');  
    }  
}  