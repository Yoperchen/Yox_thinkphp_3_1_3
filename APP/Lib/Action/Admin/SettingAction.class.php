<?php
/**
 * 系统设置
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class SettingAction extends AdminbaseAction {
    public function index()
    {
		$this->display();
    }
    /**
     * 添加设置
     */
    public function add_setting()
    {
    	$data['site_id'] = I('param.site_id','','htmlspecialchars');//站点ID
    	$data['name'] = I('param.name','','htmlspecialchars');//名称
    	$data['value'] = I('param.value','','htmlspecialchars');//值
    	
    	if(!empty($data['name']))
    	{
	    	$setting_model = D("Setting");
	    	$setting_add_result = $setting_model->add_setting($data);
	    	if($setting_add_result['status']<1){
	    		$this->error($setting_add_result['message']);
	    	}else{
	    		$this->success($setting_add_result['message']);
	    	}
	    }else{
	    	$this->display();
	    }
    }
    /**
     * 获取设置列表
     */
    public function list_setting()
    {
    	$setting_model = D("Setting");
    	$condition = array();
    	$condition['site_id'] = I('param.site_id','','htmlspecialchars');//站点ID
    	$condition['name'] = array('like','%'.I('param.name','','htmlspecialchars').'%');//站点ID
    	$setting_list_result = $setting_model->get_setting_list($condition,$page_size=20);
    	if($setting_list_result['status']<1)
    	{
    		$this->error($setting_list_result['message']);
    	}
    	$this->assign('setting_list_result',$setting_list_result);
    	$this->display();
    }
    /**
     * 修改设置
     */
    public function update_setting()
    {
    	$id = I('param.id','','htmlspecialchars');//站点ID
    	$data['site_id'] = I('param.site_id','','htmlspecialchars');//站点ID
    	$data['name'] = I('param.name','','htmlspecialchars');//名称
    	$data['value'] = I('param.value','','htmlspecialchars');//值
    	$setting_model = D("Setting");
    	if(!empty($data['name'])){
    		$setting_update_result = $setting_model->update_settingById($id,$data);
    		if($setting_update_result['status']<1){
    			$this->error($setting_update_result['message']);
    		}else{
    			$this->success($setting_update_result['message']);
    		}
    	}else{
    		$setting_info_result = $setting_model->get_settingById($id,$isdetail=1);
    		$this->assign('setting_info_result',$setting_info_result);
    		$this->display();
    	}
    	
    }
    /**
     * 删除设置
     */
    Public function del_setting()
    {
    	$condition['id'] = I('param.setting_id','','htmlspecialchars');
    	$setting_model = D("Setting");
    	$setting_del_info = $setting_model->del_setting($condition);
    	if($setting_del_info['status']<1){
    		$this->error($setting_del_info['message']);
    	}else{
    		$this->success($setting_del_info['message']);
    	}
    }

}