<?php
/**
 * 通用文件操作
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class FilesAction extends AdminbaseAction {
    public function index()
    {
        //检查登录
        if(session('account_type')!='admin' && session('id')<1)
        {
            $message='没有登录，请先登录哦。';
            $this->error($message,U('Login/login@admin'),$this->isAjax());
        }
		$this->display();
    }
    
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
    	if($editor=='ckeditor'||isset($_REQUEST['CKEditor'])){
    		header("Content-type: text/html; charset=utf-8");
    		$CKEditorFuncNum = I('param.CKEditorFuncNum','1', 'htmlspecialchars');
    		//ckeditor
    		//1.返回的内容必须为　text/html　格式，并且内容为：
    		//2.路径名必须以斜杠“/”分隔，如果用的是反斜杠“\”，那么恭喜，它是不会自动跳转到　Image　Info　里去的，并且　URL　里也不会有值。另外，error　message　这一段可以去掉，为空表示没有错误，不为空则会弹出一个对话框显示　error　message　的内容。
    		$message='';
    		if($file_list_result['status']<1)$message=$file_list_result['message'];
    		$ckeditor_info='<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction("'.$CKEditorFuncNum.'", "'.$file_list_result['list'][0]['url'].'", "'.$message.'");</script>';
    		die($ckeditor_info);
// 			print_r($file_list_result['list'][0]['url']);die();
    	}else{
    		header("Content-type: text/html; charset=utf-8");
    		die('出错了 ,sorry,'.$editor);
    	}
    	
    }
    /**
     * 文件列表
     */
    public function list_file()
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
    	if($file_list_result['status']<1){
    		$this->error($file_list_result['message']);
    	}
//     	print_r($file_list_result);
    	$this->assign('file_list_result',$file_list_result);
    	$this->display();
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
    	$file_info_result = $Files_model->get_file_by_id($file_id,$isdetail=0);
    	
    	if($file_info_result['status']) 
    	{
    		$this->data =   $file_info_result;// 模板变量赋值
    		if(!empty($file_id))
    		{
    			$update_info_result = $Files_model->update_articleById($file_id,$data);
    			if($update_info_result['status']==1){
    				$this->success($update_info_result['message']);
    			}else{
    				$this->error($update_info_result['message']);
    			}
    		}
    		
    	}else{
    		$this->error($file_info_result['message']);
    	}
    	$this->assign('file_info_result',$file_info_result);
//     	print_r($file_info_result);
    	$this->display();
    }
    public function del_file(){
    	$file_id = I('param.file_id','', 'htmlspecialchars');
    	$Files_model   =   D('Files');
    	$del_file_info = $Files_model->del_file($file_id);
    	if($del_file_info['status']<1){
    		$this->error($del_file_info['message']);
    	}else{
    		$this->success($del_file_info['message']);
    	}
    }
}