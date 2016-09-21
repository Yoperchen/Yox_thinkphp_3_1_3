<?php
/**
 * 广告
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class AdAction extends Action {
    public function index(){
    	die('common项目');
		$this->display();
    }
    
    public function ad_detail()
    {
    	$ad_id=I('param.ad_id','','htmlspecialchars');
    	$isdetail=I('param.isdetail','','htmlspecialchars');
    	$this->assign('ad_id',$ad_id);
    	$this->assign('isdetail',$isdetail);
    	$this->display ();
    }
    
    public function del_ad()
    {
    	$ad_id=I('param.ad_id','','htmlspecialchars');
    	$del_result = D('Ad')->del_ad($ad_id);
    	if(!$this->isAjax())
    	{
	    	if($del_result['status']==1)
	    	{
	    		$this->success($del_result['message']);
	    	}
	    	else 
	    	{
	    		$this->error($del_result['message']);
	    	}
    	
    	}
    	else 
    	{
    		$this->ajaxReturn($del_result['data'],$del_result['message'],$del_result['status']);
    	}
    }
    public function update_ad()
    {

		$id=$this->_param('id','htmlspecialchars,strip_tags');
		$data['api_partner_id']=$this->_param('api_partner_id','htmlspecialchars,strip_tags');//第三方合作伙伴id
		$data['partner_site_id']=$this->_param('partner_site_id','htmlspecialchars,strip_tags');//第三方站点id
		$data['store_id']=$this->_param('store_id','htmlspecialchars,strip_tags',0);//商家id
		$data['user_id']=$this->_param('user_id','htmlspecialchars,strip_tags');//用户id
		$data['title']=$this->_param('title','htmlspecialchars,strip_tags');//广告标题
		$data['desc']=$this->_param('desc','htmlspecialchars,strip_tags');//广告描述
		$data['type']=$this->_param('type','htmlspecialchars,strip_tags');//广告类型|Link(链接)、text(文字)、Picture(图片)
		$data['platform']=$this->_param('platform','htmlspecialchars,strip_tags');//设备|AN/IP/H5/WB/MAC/KI
		$data['page']=$this->_param('page','htmlspecialchars,strip_tags');//页面|index/personal_center/good_list/good_detail/article_list..
		$data['text']=$this->_param('text','htmlspecialchars,strip_tags');//文字
		$data['link']=$this->_param('link','htmlspecialchars,strip_tags');//链接
		$data['begin_time']=$this->_param('begin_time','htmlspecialchars,strip_tags',time());//广告开始时间
		$data['end_time']=$this->_param('end_time','htmlspecialchars,strip_tags');//广告借宿时间
		
        import('ORG.Yocms_client',LIB_PATH);// 导入Yocms客户端类
        $Yocms_client_obj = new Yocms_client();
        $update_result = $Yocms_client_obj->get_common_info($ma='9009',$data,$method='post');
        if(!$this->isAjax()){
            if($update_result['status']==1)
            {
                $this->success($update_result['message']);
            }
            else
            {
                $this->error($update_result['message']);
            }
        }
        else
        {
            $this->ajaxReturn($update_result['data'],$update_result['message'],$update_result['status']);
        }
        
    }
}