<?php
//商家列表
//{:W('ListArticleCategory',array('template'=>'admin_store_ListArticleCategory','store_id'=>1))}
class ListArticleCategoryWidget extends Widget{  
 public function render($data){ 
 	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'ListArticleCategory';
    	
 		$category = D('Article_category');
 		$conditions = '';//条件
 		if(!empty($data['is_show'])){//是否显示
 			$conditions['is_show']=array('eq',$data['is_show']);
 		}
 		if(!empty($data['store_id'])){//根据商家选分类
 			$conditions['store_id']=array('eq',$data['store_id']);
 		}
 		//将无限级分类中的数据去除来,根据concat(path,'-',id) => 'bpath' 实现排序(很关键)
 		$list = $category->field(array('id','name','pid','path','sort',"concat(path,'-',id)"=>'bpath'))->where($conditions)->order('bpath')->select();
 		foreach ($list as $key => $val){
 			//根据排序的位置生成无限极列表的样式
 			for($i = 0; $i < count(explode('-',$list[$key]['bpath']))-2 ; $i++){
 				$list[$key]['count'] .= "---";
 			}
 		}
    	$data['article_category_list'] = $list;
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