<?php
//商品分类列表
//{:W('ListShowGoodsCategory',array('select_store_id'=>2,'is_show'=>1))}  商家为2，不隐藏的商品分类
class ListShowGoodsCategoryWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'ListShowGoodsCategory';
    	
 		$category = D('Goods_category');
 		$conditions = '';//条件
 		if(!empty($data['is_show'])){//是否显示
 			$conditions['is_show']=array('eq',$data['is_show']);
 		}
 		if(!empty($data['select_store_id'])){//根据商家选分类
 			$conditions['store_id']=array('eq',$data['select_store_id']);
 		}
 		if(!empty($data['hide_id'])){//不显示的分类，包括其子分类也会不显示
 			$conditions['path']=array('notlike','%'.$data['hide_id'].'%');//不显示子分类
 			$conditions['id']=array('neq',$data['hide_id']);//不显示自己
 		}
 		//将无限级分类中的数据去除来,根据concat(path,'-',id) => 'bpath' 实现排序(很关键)
 		$list = $category->field(array('id','store_id','name','pid','path','sort',"concat(path,'-',id)"=>'bpath'))->where($conditions)->order('bpath')->select();
 		foreach ($list as $key => $val){
 			//根据排序的位置生成无限极列表的样式
 			for($i = 0; $i < count(explode('-',$list[$key]['bpath']))-2 ; $i++){
 				$list[$key]['count'] .= "---";
 			}
 		}
    	$data['good_category_list'] = $list;
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