<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends AdminbaseAction {
    public function index()
    {
		$this->display();
    }
    public function test(){
    	$film_name=date('Ymd').'test.xls';
    	header("Content-Type: application/vnd.ms-excel");
    	header("Content-Disposition: attachment;filename=" . $film_name);
    	echo iconv('utf-8','gbk',"名称\t名称\t1\t2\t3\t4\t5\t6\t7\r\n");
    	$str="Straight (Cut)\t短管\tA\tB\tL\t\t\t\t\r\n";
    	echo iconv('utf-8','gbk',$str);
    }
    public function test2(){
    	$good_id = '1';
//     	$info = D('Attribute')->get_attribute_by_good_id($good_id);
    	$info = D('Goods')->getGoodById($good_id);
    	print_r($info);
    }
    public function test3(){
    	print_r(@$_REQUEST);
    	echo '<form method="post">';
    	echo '<input type="text" name="attribute[1][attribute_type_id]" value="111">';
    	echo '<input type="text" name="attribute[1][attribute_name]" value="222">';
    	echo '<input type="text" name="attribute[1][attribute_value]" value="333">';
    	echo '<input type="text" name="attribute[2][attribute_type_id]" value="444">';
    	echo '<input type="text" name="attribute[2][attribute_name]" value="555">';
    	echo '<input type="text" name="attribute[2][attribute_value]" value="666">';
    	echo '<input type="submit" name="提交">';
    	echo '</form>';
    	die();
    }
}