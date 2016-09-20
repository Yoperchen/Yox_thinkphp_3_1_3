<?php
//商家列表
//{:W('ListArticle',array('template'=>'admin_store_ListArticle','condition'=>array('store_id'=>1)))}
class ListCommentWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'ListComment';
    	
    	$Comment_model  =   D('Comment');
    	$condition = array();//条件
    	$condition['store_id']=$data['condition']['store_id']?array('eq',$data['condition']['store_id']):'';//商家
    	$condition['goods_id']=$data['condition']['goods_id']?array('eq',$data['condition']['goods_id']):'';//商品
    	$condition['article_id']=$data['condition']['article_id']?array('eq',$data['condition']['article_id']):'';//文章
    	$condition['user_id']=$data['condition']['user_id']?array('eq',$data['condition']['user_id']):'';//用户
    	$condition['share_id']=$data['condition']['share_id']?array('eq',$data['condition']['share_id']):'';//分享ID
    	$condition['collect_id']=$data['condition']['collect_id']?array('eq',$data['condition']['collect_id']):'';//用户
		$condition['title']=$data['condition']['title']?array('like','%'.$data['condition']['title'].'%'):'';//标题
		
		$condition['add_time']=$data['condition']['add_time']?array('eq',$data['condition']['add_time']):'';//添加时间
		$condition['add_time']=$data['condition']['egt_add_time']?array('EGT',$data['condition']['egt_add_time']):'';//大于等于
		$condition['add_time']=$data['condition']['gt_add_time']?array('GT',$data['condition']['gt_add_time']):'';//大于
		$condition['add_time']=$data['condition']['elt_add_time']?array('ELT',$data['condition']['elt_add_time']):'';//小于等于
		$condition['add_time']=$data['condition']['lt_add_time']?array('LT',$data['condition']['lt_add_time']):'';//小于
		 
		$condition['update_time']=$data['condition']['update_time']?array('eq',$data['condition']['update_time']):'';//修改时间
		$condition['update_time']=$data['condition']['egt_update_time']?array('EGT',$data['condition']['egt_update_time']):'';//大于等于
		$condition['update_time']=$data['condition']['gt_update_time']?array('GT',$data['condition']['gt_update_time']):'';//大于
		$condition['update_time']=$data['condition']['elt_update_time']?array('ELT',$data['condition']['elt_update_time']):'';//小于等于
		$condition['update_time']=$data['condition']['lt_update_time']?array('LT',$data['condition']['lt_update_time']):'';//小于
		
    	$list_comment_result = $Comment_model-> get_comment_list($condition,$page_size=15);
    	$data['list']=$list_comment_result['data']['list'];
        $content = $this->renderFile($Template,$data);
     	if($data['format_type']=='json')
		{
			return json_encode(array('status'=>1,'data'=>$content));
		}
		elseif($data['format_type']=='xml')
		{
			
		}elseif($data['format_type']=='jsonp')
		{
			return $_GET['jsoncallback']."(".json_encode(array('status'=>1,'data'=>$content)).")";
		}
		else
		{
	        return $content;  
		}
    } 
 }