<?php
// 用户
class UserAction extends Action 
{
    public function index()
    {
//     	$condition['site_id'] = I ( 'param.site_id', '', 'htmlspecialchars' ); // 站点id
//     	$condition['type'] = I ( 'param.type', '', 'htmlspecialchars' ); // 类型|1:公告;2:普通文章;3:论坛贴;4日志;5说说
//     	$condition['category_id'] = I ( 'param.category_id', '', 'htmlspecialchars' ); // 分类id
//     	$condition['user_id'] = I ( 'param.user_id', '', 'htmlspecialchars' ); // 用户id
//     	$condition['store_id'] = I ( 'param.store_id', '', 'htmlspecialchars' ); // 商家id
//     	import('ORG.Yocms_client',LIB_PATH);// 导入Yocms客户端类
//     	$Yocms_client_obj = new Yocms_client();
//     	$list_share_result = $Yocms_client_obj->get_common_info($ma='10001',$data='',$method='get');//分享列表
     	//print_r($condition);
    	
     	$this->assign('condition',$condition);
		$this->display();
    }

}