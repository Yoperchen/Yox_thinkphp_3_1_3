<?php
//通用底部
class FooterWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'Footer';
    	//$Good_category  =   M('Good_category');
    	
    	//$conditions = '';//条件查询
    	//$conditions .= 'is_show=1 && parent_id=1';//show|1:显示，2;隐藏；parent_id|1:顶级分类

    	//$data['good_category_list'] = $Good_category-> where($conditions)->order('sort')->limit(15)->select();
        $content = $this->renderFile($Template,$data);
        return $content;  
    } 
 }