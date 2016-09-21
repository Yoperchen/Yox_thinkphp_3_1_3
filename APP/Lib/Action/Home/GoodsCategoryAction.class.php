<?php
 class GoodsCategoryAction extends Action{
 	public function index(){
 		$category = D('Goods_category');
 		//将无限级分类中的数据去除来,根据concat(path,'-',id) => 'bpath' 实现排序(很关键)
 		$list = $category->field(array('id','name','pid','path',"concat(path,'-',id)"=>'bpath'))->order('bpath')->select();
 		foreach ($list as $key => $val){
 			//根据排序的位置生成无限极列表的样式
 			for($i = 0; $i < count(explode('-',$list[$key]['bpath']))-2 ; $i++){
 				$list[$key]['count'] .= "---";
 			}
 		}
 		$this->assign('catelist',$list);
 		//print_r($list);
 		$this->display();
 }
 public function add(){
 	$category = new Goods_categoryModel();
 	if($category->create()){
 		if($category->add()){
 			$this->success('添加成功');
 		}
 		else{
 			$this->error('添加失败!');
 		}
 	}
 	else{
 		$this->error("error!");
 		//$category->getError();
 	}
 
 }
 
 }
 ?>