<?php
/**
 * 通用文件操作
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class FilesAction extends Action {
    public function index(){
		$this->display();
    }
    /**
     * 上传文件
     */
    public function upload_file(){
    	$editor = I('param.editor','', 'htmlspecialchars');
    	$data['site_id'] = I('param.site_id','', 'htmlspecialchars');
    	$data['type'] = I('param.type','', 'htmlspecialchars');
    	$data['user_id'] = I('param.user_id','', 'htmlspecialchars');
    	$data['store_id'] = I('param.store_id','', 'htmlspecialchars');
    	$data['description'] = I('param.desc','', 'htmlspecialchars');
    	$data['from_url'] = I('param.from_url','', 'htmlspecialchars');
    	$data['sort'] = I('param.sort','', 'htmlspecialchars');
    	$data['up'] = I('param.up','', 'htmlspecialchars');
    	$data['down'] = I('param.down','', 'htmlspecialchars');
    	$data['like'] = I('param.like','', 'htmlspecialchars');
    	
    	$Files_model   =   D('Files');
    	$file_list_result = $Files_model->add_file($data);
		header("Content-type: text/html; charset=utf-8");
		die(json_encode($file_list_result));
    	
    }
    /**
     * 文件列表
     */
    public function get_file_list()
    {
    	$condition = array();
    	$condition['title'] = array('like','%'.I('param.title','', 'htmlspecialchars').'%');
    	$add_time1=I('param.add_time1','', 'htmlspecialchars');
    	$add_time2=I('param.add_time2','', 'htmlspecialchars');
    	$condition['site_id']=I('param.site_id','', 'htmlspecialchars');
    	$condition['store_id']=I('param.store_id','', 'htmlspecialchars');
    	$condition['user_id']=I('param.user_id','', 'htmlspecialchars');
    	if(!empty($add_time1)&&$add_time2)
    	{
    		$condition['add_time'] = array(
    				array('gt',strtotime($add_time1)),
    				array('lt',strtotime($add_time2))
    		);
    	}
    	
    	$Files_model   =   D('Files');
    	$condition=array();
    	$file_list_result = $Files_model->get_file_list($condition,$page_size=20);
		header("Content-type: text/html; charset=utf-8");
		die(json_encode($file_list_result));
    }
    public function get_file_by_id(){
    	$file_id = I('param.file_id','', 'htmlspecialchars');
    	$Files_model   =   D('Files');
    	$file_info_result = $Files_model->get_file_by_id($file_id,$isdetail=0);
    	header("Content-type: text/html; charset=utf-8");
    	die(json_encode($file_info_result));
    }
    /**
     * 修改文件信息
     */
    public function update_file()
    {
    	$file_id = I('param.file_id','', 'htmlspecialchars');
    	$editor = I('param.editor','', 'htmlspecialchars');
    	$data['site_id'] = I('param.site_id','', 'htmlspecialchars');
    	$data['type'] = I('param.type','', 'htmlspecialchars');
    	$data['user_id'] = I('param.user_id','', 'htmlspecialchars');
    	$data['store_id'] = I('param.store_id','', 'htmlspecialchars');
    	$data['description'] = I('param.desc','', 'htmlspecialchars');
    	$data['from_url'] = I('param.from_url','', 'htmlspecialchars');
    	$data['sort'] = I('param.sort','', 'htmlspecialchars');
    	$data['up'] = I('param.up','', 'htmlspecialchars');
    	$data['down'] = I('param.down','', 'htmlspecialchars');
    	$data['like'] = I('param.like','', 'htmlspecialchars');
    	
    	$Files_model   =   D('Files');
    	$file_info_result = $Files_model->update_file_by_id($file_id,$data);
    	header("Content-type: text/html; charset=utf-8");
		die(json_encode($file_info_result));
    }
    /**
     * 删除文件
     */
    public function del_file(){
    	$file_id = I('param.file_id','', 'htmlspecialchars');
    	$Files_model   =   D('Files');
    	$del_file_info = $Files_model->del_file($file_id);
    	header("Content-type: text/html; charset=utf-8");
		die(json_encode($del_file_info));
    }
}