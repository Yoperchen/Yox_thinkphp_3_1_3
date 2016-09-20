<?php
//地区列表
// {:W('ListDistrict',array('select_user_id'=>2,'select_user_id'=>1))}   调用商家id=2 and 用户id=1的订单
class ListDistrictWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'ListDistrict';
	
    	$District_model  =   D('District');
	
    	$condition = '';//条件
    	if(!empty($data['condition']['group'])){//分组
    	    $condition['group']=$data['condition']['group'];
    	}
        if(!empty($data['condition']['district_id'])){//district_id
    		$condition['id']=array('eq',$data['condition']['district_id']);
    	}
    	if(!empty($data['condition']['name'])){//district_id
    		$condition['name']=array('like','%'.$data['condition']['name'].'%');
    	}
    	if(!empty($data['condition']['level'])){//级别
    		$condition['level']=array('eq',$data['condition']['level']);
    	}
    	if(!empty($data['condition']['upid'])){//上级id
    		$condition['upid']=array('eq',$data['condition']['upid']);
    	}
	if(!empty($data['condition']['hot'])){//热门
    		$condition['hot']=array('eq',$data['condition']['hot']);
    	}
	if(!empty($data['condition']['alphabet'])){//字母
    		$condition['alphabet']=array('eq',$data['condition']['alphabet']);
    	}
    	
	$data['page']['page_size'] = $data['page']['page_size']?intval($data['page']['page_size']):10000;
	
    	$district_list_result = $District_model-> get_district_list($condition,'*',$data['page']['page_size']);
	//print_r($district_list_result);
	$data['list']=$district_list_result['data']['list'];
	//print_r($data['list']);
        $content = $this->renderFile($Template,$data);
        return $content;  
    } 
 }