<?php
//工具
// {:W('Tool',array('select_user_id'=>2,'select_user_id'=>1))}   调用商家id=2 and 用户id=1的订单
class ToolWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Tool = $data['tool'];//工具
    	$Template = $data['template'];//模版
    	
        $content = $this->renderFile($Tool.'/'.$Template,$data);
        return $content;  
    } 
 }