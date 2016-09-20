<?php
/**
 * 分类操作
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 */
class Goods_categoryModel extends Model{
	protected $_auto = array(
			//根据id生成无限极的父子关系
			array('path','createPath',3,'callback'),
	);

	protected $_validate = array(
			array('name','require','栏目必须填!'),
	);

	public function add_category($data){
		$condition=array_filter($condition);//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$result=array('status'=>0,'message'=>'data不能为空');
		$img_err='';
		if(!empty($data['pid'])){
			$category_info_result = $this->get_info_by_category_id($data['pid']);
			if($category_info_result['status']<1)
			{
				$result=array('status'=>0,'message'=>$category_info_result['message']);
			}
			//子分类与上级分类要在同一个商家
			if($category_info_result['data']['store_id']!=$data['store_id'])
			{
				$result=array('status'=>0,'message'=>'子分类与上级分类必须在同一个商家');
			}
			//子分类与上级分类要在同一个站点
			if($category_info_result['data']['site_id']!=$data['site_id'])
			{
				$result=array('status'=>0,'message'=>'子分类与上级分类必须在同一个站点');
			}
			$data['path']=$category_info_result['data']['path'].'-'.$data['pid'];
		}else{
			$data['pid']=0;
			$data['path']=0;
		}
		if (!empty($_FILES)){//如果有图片上传
			import('ORG.Net.UploadFile');
			$upload = new UploadFile();// 实例化上传类
			// 				$upload->saveRule='';//上传文件的保存规则，必须是一个无需任何参数的函数名，例如可以是 time、 uniqid com_create_guid 等，但必须能保证生成的文件名是唯一的，默认是uniqid
			$upload->maxSize  = 3145728 ;// 设置附件上传大小
			// 				$upload->uploadReplace=0;//存在同名文件是否是覆盖
			$upload->thumb = true;//是否生成缩略图
			$upload->thumbMaxWidth = '50,200,1000';//缩略图的最大宽度，多个使用逗号分隔
			$upload->thumbMaxHeight = '50,200,275';//缩略图的最大高度，多个使用逗号分隔
			$upload->thumbRemoveOrigin = 1;//生成缩略图后是否删除原图
			$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 允许上传的文件后缀（留空为不限制），使用数组设置，默认为空数组
			$upload->allowTypes  = array('image/png', 'image/jpeg', 'image/gif');//允许上传的文件类型（留空为不限制），使用数组设置，默认为空数组
			$upload->subType = 'date';//子目录创建方式，默认为hash，可以设置为hash或者date
			$upload->dateFormat = 'Y-m-d';
			$upload->savePath =  './Public/Uploads/Category/';// 文件保存路径，如果留空会取UPLOAD_PATH常量定义的路径
			if(!$upload->upload()) {// 上传错误提示错误信息
				// 					return $upload->getErrorMsg();
				$img_err=','.$upload->getErrorMsg();
			}else{// 上传成功 获取上传文件信息
				$info =  $upload->getUploadFileInfo();
			}
	
			$img1_src=$info[0]['savename']?$upload->savePath.$info[0]['savename']:'';
			$img2_src=$info[1]['savename']?$upload->savePath.$info[1]['savename']:'';
			$img3_src=$info[2]['savename']?$upload->savePath.$info[2]['savename']:'';
			$data['img_50_50']=$img1_src;
			$data['img_200_200']=$img2_src;
			$data['img_1000_275']=$img3_src;
		}
		$category_id=$this->data($data)->add();
		if($category_id){
			$result=array('status'=>1,'message'=>'成功'.$img_err,
					'data'=>$data);
		}
		return $result;
	}
	
	/**
	 * 获取指定分类信息
	 * @param unknown $category_id
	 * @return multitype:number string |multitype:number string unknown
	 */
	public function get_info_by_category_id($category_id){
		if(empty($category_id)){
			$result=array('status'=>0,'message'=>'id不能为空');
			return $result;
		}
		$category_info = $this->where(array('id'=>$category_id))->find();
		if(!empty($category_info)){
			$result=array('status'=>1,'message'=>'成功','data'=>$category_info);	
		}else{
			$result=array('status'=>0,'message'=>'查无此分类数据','data'=>$category_info);	
		}
		
		return $result;
	}
	/**
	 * 获取分类列表
	 * @param array $condition
	 * @param number $page_size
	 * @return array
	 */
	public function get_good_category_list($condition,$page_size=100){
 		$condition=array_filter($condition,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$result=array('status'=>0,'message'=>'错误','data'=>null);
		import('ORG.Util.Page');// 导入分页类
		$count      = $this->where($condition)->count();// 查询满足要求的总记录数
		$Page       = new Page($count,$page_size);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $this->where($condition)->order('path,sort,id')->limit($Page->firstRow.','.$Page->listRows)->select();
		//组转数据
		//必须保证pid/path字段正确
		$list_new = array();
		foreach ($list as $key=>$category){
			if(empty($category['pid'])){//顶级分类
				$list_new[$category['id']]=$category;
			}else{
				$pid_arr = explode('-', $category['path']);
				$level = count($pid_arr);
				if($level==2){//第二级
					$list_new[$pid_arr[1]]['children'][$category['id']]=$category;
				}
				if($level==3){//第三级
					$list_new[$pid_arr[1]]['children'][$pid_arr[2]]['children'][$category['id']]=$category;
				}
				if($level==4){//第四级
					$list_new[$pid_arr[1]]['children'][$pid_arr[2]]['children'][$pid_arr[3]]['children'][$category['id']]=$category;
				}
				if($level==5){//第五级
					$list_new[$pid_arr[1]]['children'][$pid_arr[2]]['children'][$pid_arr[3]]['children'][$pid_arr[4]]['children'][$category['id']]=$category;
				}
				if($level==6){//第六及，还不够吗
					$list_new[$pid_arr[1]]['children'][$pid_arr[2]]['children'][$pid_arr[3]]['children'][$pid_arr[4]]['children'][$pid_arr[5]]['children'][$category['id']]=$category;
				}
				if($level==7){//第七级，够了把
					$list_new[$pid_arr[1]]['children'][$pid_arr[2]]['children'][$pid_arr[3]]['children'][$pid_arr[4]]['children'][$pid_arr[5]]['children'][$pid_arr[6]]['children'][$category['id']]=$category;
				}
			}
		}
		if(!empty($list_new)){
			$result=array(
					'status'=>1,
					'message'=>'成功',
					'data'=>array(
						'page'=>array(
								'count'=>$count,//文章总数
								'page_size'=>$page_size,
								'page'=>$Page->firstRow+1,
							),
						'list'=>$list_new
					),
			);
		}else{
			$result=array(
					'status'=>0,
					'message'=>'数据为空',
					'data'=>array(
							'page'=>array(),
							'list'=>$list_new
					),
			);
		}
		return $result;
		// 		$this->assign('list',$list);// 赋值数据集
		// 		$this->assign('page',$show);// 赋值分页输出
		
	}
	public function update_category($id,$data){
		$data=array_filter($data);//去掉数组空值，不然条件上会加上 xx='' 导致把数据修改为空
		$data['update_time']=time();
		$result=array('status'=>0,'message'=>'修改错误','data'=>null);
		if(empty($id)||empty($data)){
			$result=array('status'=>0,'message'=>'修改失败，id或数据为空','data'=>null);
			return $result;
		}
		//path字段
		if(!empty($data['pid']))
		{
			$category_info_result = $this->get_info_by_category_id($data['pid']);
			if($category_info_result['status']<1)
			{
				$result=array('status'=>0,'message'=>$category_info_result['message']);
			}
			//子分类与上级分类要在同一个商家
			if($category_info_result['data']['store_id']!=$data['store_id'])
			{
				$result=array('status'=>0,'message'=>'子分类与上级分类必须在同一个商家');
			}
			//子分类与上级分类要在同一个站点
			if($category_info_result['data']['site_id']!=$data['site_id'])
			{
				$result=array('status'=>0,'message'=>'子分类与上级分类必须在同一个站点');
			}
			$data['path']=$category_info_result['data']['path'].'-'.$data['pid'];
		}else{
			$data['pid']=0;
			$data['path']=0;
		}
		
		if (!empty($_FILES)){//如果有图片上传
			import('ORG.Net.UploadFile');
			$upload = new UploadFile();// 实例化上传类
			// 				$upload->saveRule='';//上传文件的保存规则，必须是一个无需任何参数的函数名，例如可以是 time、 uniqid com_create_guid 等，但必须能保证生成的文件名是唯一的，默认是uniqid
			$upload->maxSize  = 3145728 ;// 设置附件上传大小
			// 				$upload->uploadReplace=0;//存在同名文件是否是覆盖
			$upload->thumb = true;//是否生成缩略图
			$upload->thumbMaxWidth = '50,200';//缩略图的最大宽度，多个使用逗号分隔
			$upload->thumbMaxHeight = '50,200';//缩略图的最大高度，多个使用逗号分隔
			$upload->thumbRemoveOrigin = 1;//生成缩略图后是否删除原图
			$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 允许上传的文件后缀（留空为不限制），使用数组设置，默认为空数组
			$upload->allowTypes  = array('image/png', 'image/jpeg', 'image/gif');//允许上传的文件类型（留空为不限制），使用数组设置，默认为空数组
			$upload->subType = 'date';//子目录创建方式，默认为hash，可以设置为hash或者date
			$upload->dateFormat = 'Y-m-d';
			$upload->savePath =  './Public/Uploads/';// 文件保存路径，如果留空会取UPLOAD_PATH常量定义的路径
			if(!$upload->upload()) {// 上传错误提示错误信息
				// 					return $upload->getErrorMsg();
				$img_err=','.$upload->getErrorMsg();
			}else{// 上传成功 获取上传文件信息
				$info =  $upload->getUploadFileInfo();
			}
		
			$img1_src=$info[0]['savename']?$upload->savePath.$info[0]['savename']:'';
			$img2_src=$info[1]['savename']?$upload->savePath.$info[1]['savename']:'';
			$img3_src=$info[2]['savename']?$upload->savePath.$info[2]['savename']:'';
			$data['img_50_50']=$img1_src;
			$data['img_200_200']=$img2_src;
			$data['img_1000_275'] =$img3_src;
		}
		if($this->where(array('id'=>$id))->save($data)){ // 根据条件保存修改的数据
			$result=array(
					'status'=>1,
					'message'=>'修改成功',
					'data'=>$data
					);
		}else{
			$result=array(
					'status'=>0,
					'message'=>'修改失败',
					'data'=>$data);
		}
		
		return $result;
		
	}
	/**
	 * 删除
	 * @param array $condition
	 */
	public function del_category($condition){
		if(empty($condition))
		{
			$result=array(
					'status'=>0,
					'message'=>'条件为空',
					'data'=>$condition
			);
		}
		if(!empty($condition['id']))
		{
			$category_info_result = $this->get_info_by_category_id($condition['id']);//是否存在
			if($category_info_result['status']<1)
			{
				$result=array('status'=>0,'message'=>'查询出错1','data'=>$category_info_result['message']);
				return $result;
			}
			//查询是否有子类
			$tmp_condition['path']=array(
					array('like','%-'.$category_info_result['data']['id'].'%'),
					array('like','%-'.$category_info_result['data']['id'].'-%'),
					array('like','%'.$category_info_result['data']['id'].'-%'),
					'or');
			$category_list = $this->where($tmp_condition)->select();
			if(!empty($category_list))
			{//存在子类，不能删除
				$result=array('status'=>0,'message'=>'此分类下存在子类，不能删除，请先删除子分类','data'=>$category_list);
				return $result;
			}
		}
		$tmp=$this->where($condition)->delete();
		if($tmp){
			$result=array('status'=>1,'message'=>'删除成功','data'=>$tmp,'condition'=>$condition);
		}else{
			$result=array('status'=>0,'message'=>'删除失败','data'=>$tmp,'condition'=>$condition);
		}
		return $result;
		
	}

}