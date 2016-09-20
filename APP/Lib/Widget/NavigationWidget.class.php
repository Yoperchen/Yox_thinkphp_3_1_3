<?php
//顶部，主导航，底部导航
class NavigationWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'Navigation';
    	
//  		$Navigation = M('Navigation');
//  		$conditions = '';//条件
//  		if(!empty($data['is_show'])){
//  			$conditions['is_show']=array('eq',$data['is_show']);
//  		}
//  		if(!empty($data['position'])){
//  			$conditions['position']=array('eq',$data['position']);
//  		}
 		
//  		//将无限级分类中的数据去除来,根据concat(path,'-',id) => 'bpath' 实现排序(很关键)
//  		$list = $Navigation->field(array('id','name','pid','path','url','blank',"concat(path,'-',id)"=>'bpath'))->where($conditions)->order('bpath')->select();
//  		foreach ($list as $key => $val){
//  			//根据排序的位置生成无限极列表的样式
//  			for($i = 0; $i < count(explode('-',$list[$key]['bpath']))-2 ; $i++){
//  				$list[$key]['count'] .= "---";
//  			}
//  		}
// //  		print_r($list);
//     	$navigation['navigation'] = $list;
    	 $condition = '';//条件
    	 $condition['is_show']=$data['condition']['is_show']?array('eq',$data['condition']['is_show']):'';
    	 $condition['position']=$data['condition']['position']?array('eq',$data['condition']['position']):'';
    	 $condition['site_id']=$data['condition']['site_id']?array('eq',$data['condition']['site_id']):'';
    	 $condition['store_id']=$data['condition']['store_id']?array('eq',$data['condition']['store_id']):'';
    	 $condition['pid']=$data['condition']['pid']?array('eq',$data['condition']['pid']):'';
    	 
    	$Navigation_model = D('Navigation');
    	$list_navigation_result =$Navigation_model->get_navigation_list( $condition, $page_size=50);
    	$data['list']=$list_navigation_result['data']['list'];
    	$data['page']=$list_navigation_result['data']['page'];
     	//print_r($data);
//     	print_r($list_navigation_result);
        $content = $this->renderFile($Template,$data);
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