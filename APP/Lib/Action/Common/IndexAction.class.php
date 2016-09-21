<?php
/**
 * 首页
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 */
class IndexAction extends Action {
    public function index(){
    	print_r($_SESSION);
    	die('common项目');
		$this->display();
    }
}