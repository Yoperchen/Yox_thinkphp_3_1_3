<?php
//商家顶部，主导航，底部导航
//{:W('NavigationStores',array('store_id'=>'2'))}  商家2的导航
class NavigationStoresWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'NavigationStores';
    	
 		$Navigation = M('Stores_navigation');
 		$conditions = '';//条件
 		if(!empty($data['is_show'])){//is_show|1:显示，2：不显示
 			$conditions['is_show']=array('eq',$data['is_show']);
 		}
 		if(!empty($data['store_id'])){//position|1:顶部，2：主要导航条，3底部导航
 			$conditions['store_id']=array('eq',$data['store_id']);
 		}
 		if(!empty($data['position'])){//position|1:顶部，2：主要导航条，3底部导航
 			$conditions['position']=array('eq',$data['position']);
 		}
 		
 		//将无限级分类中的数据去除来,根据concat(path,'-',id) => 'bpath' 实现排序(很关键)
 		$list = $Navigation->field(array('id','store_id','is_show','position','name','pid','path','url','blank',"concat(path,'-',id)"=>'bpath'))->where($conditions)->order('bpath')->select();
 		foreach ($list as $key => $val){
 			//根据排序的位置生成无限极列表的样式
 			for($i = 0; $i < count(explode('-',$list[$key]['bpath']))-2 ; $i++){
 				$list[$key]['count'] .= "---";
 			}
 		}
    	$navigation['navigation'] = $list;
        $content = $this->renderFile($Template,$navigation);
     	if($data['format_type']=='json')
		{
			return json_encode(array('status'=>1,'data'=>$content));
		}
		elseif($data['format_type']=='xml')
		{
			
		}
		else
		{
	        return $content;  
		}
    } 
 }