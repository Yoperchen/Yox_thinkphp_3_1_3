<?php
/**
 * 社区、学校、小单位
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 */
class CommunityModel extends Model {
	
	
	/**
	 * 添加社区
	 * @param array $data
	 */
	public function add_community($data){
		$condition=array_filter($condition,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$result=array('status'=>0,'message'=>'data不能为空');
			$img_err='';
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
				$upload->savePath =  './Public/Uploads/Community/';// 文件保存路径，如果留空会取UPLOAD_PATH常量定义的路径
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
			if(!empty($data['lng'])&&!empty($data['lat']))
			{//经纬度geohash
				import('ORG.Geohash',LIB_PATH);// 导入天气类
				$geohash = new Geohash;
				$data['geohash']=$geohash->encode($data['lat'], $data['lng']);//纬度、经度
			}
			$community_id=$this->data($data)->add();
			$result=array('status'=>1,'message'=>'成功'.$img_err,
					'data'=>array(
							'id'=>$community_id,
							'name'=>$data['name'],
							'desc'=>$data['desc'],
							'longitude'=>$data['longitude'],
							'latitude'=>$data['latitude'],
							'img_50_50'=>$data['img_50_50'],
							'img_200_200'=>$data['img_200_200'],
							'img_1000_275'=>$data['img_1000_275'],
					));
			return $result;
		}
	
	
	/**
	 * 根据上级获取下级地区
	 */
// 	public function get_list_by_cityid($city_id,$page_size=20){
// // 		$condition=array_filter($condition);//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
// 		$result=array('status'=>0,'message'=>'错误','data'=>null);
// 		import('ORG.Util.Page');// 导入分页类
// 		$count      = $this->where(array('city_id'=>$city_id))->count();// 查询满足要求的总记录数
// 		$Page       = new Page($count,$page_size);// 实例化分页类 传入总记录数和每页显示的记录数
// 		$show       = $Page->show();// 分页显示输出
// 		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
// 		$list = $this->where(array('city_id'=>$city_id))->order('city_id')->limit($Page->firstRow.','.$Page->listRows)->select();
// 		if(!empty($list)){
// 			$result=array(
// 					'status'=>1,
// 					'message'=>'成功',
// 					'data'=>array(
// 							'page'=>array(
// 									'count'=>$count,//文章总数
// 									'page_size'=>$page_size,
// 									'page'=>$Page->firstRow+1,
// 							),
// 							'list'=>$list
// 					),
// 			);
// 		}else{
// 			$result=array(
// 					'status'=>0,
// 					'message'=>'数据为空',
// 					'data'=>array(
// 							'page'=>array(),
// 							'list'=>$list
// 					),
// 			);
// 		}
// 		return $result;
// 		// 		$this->assign('list',$list);// 赋值数据集
// 		// 		$this->assign('page',$show);// 赋值分页输出
		
		
// 	}
/**
 * 根据社区id获取社区
 * @param int $community_id
 * @return array
 */
	public function get_info_by_community_id($community_id){
		$result=array('status'=>0,'message'=>'出错了');
		if(empty($community_id)){
			$result=array('status'=>0,'message'=>'id不能为空');
			return $result;
		}
		$community_info = $this->where(array('id'=>$community_id))->find();
		if(!empty($community_info)){
			$result=array('status'=>1,'message'=>'成功','data'=>$community_info);
		}
		
		return $result;
	}
	
	/**
	 * 获取社区列表
	 */
	public function get_community_list($condition,$page_size=10){
		$condition=array_filter($condition,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$result=array('status'=>0,'message'=>'错误','data'=>null);
		if(!empty($condition['lng'])&&!empty($condition['lat']))//经度纬度
		{
			import('ORG.Geohash',LIB_PATH);// 导入Geohash类
			$geohash = new Geohash;
			$hash = $geohash->encode($condition['lat'], $condition['lng']);//纬度经度
			//取前缀，前缀约长范围越小
			$prefix = substr($hash, 0, 6);
			//echo $hash;//wx4eqwk59ep36s
			//取出相邻八个区域
			$neighbors = $geohash->neighbors($prefix);
			array_push($neighbors, $prefix);
			$condition['geohash']=array('like',array(
					$neighbors['top'].'%',
					$neighbors['bottom'].'%',
					$neighbors['right'].'%',
					$neighbors['left'].'%',
					$neighbors['topleft'].'%',
					$neighbors['topright'].'%',
					$neighbors['bottomright'].'%',
					$neighbors['bottomleft'].'%',
					$neighbors[0].'%',
			),'OR');
		}
		import('ORG.Util.Page');// 导入分页类
		$count      = $this->where($condition)->count();// 查询满足要求的总记录数
		$Page       = new Page($count,$page_size);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		//字母分组组合数据
		if($condition['group']=='city_and_alphabet')
		{
		    //城市->字母->社区
		    unset($condition['group']);
		    $s_key='community_get_community_list_city_and_alphabet';
		    $list = S($s_key);
		    if(empty($list))
		    {
    		    //所有字母
    		    $condition['alphabet']=array('NEQ','');
    		    $alphabet_list = $this->cache(true,60)->field('alphabet,city_id,count(*)')->group('alphabet')->where($condition)->limit($Page->firstRow.','.$Page->listRows)->order('id')->select();
    		    //所有城市
    		    $city_list = $this->cache(true,60)->field('alphabet,city_id,count(*)')->group('city_id')->where($condition)->limit($Page->firstRow.','.$Page->listRows)->order('id')->select();
    		    $city_id_arr=array();
    		    foreach($city_list as $city){
    		        $city_id_arr[]=$city['city_id'];
    		    }
    		    $city_count=count($city_id_arr);
    		    $city_list_condition=array();
    		    $city_list_condition['id']=array('in',$city_id_arr);
    		    $city_list_result = D('District')->cache(true,60)->get_district_list($city_list_condition,$field='*',$city_count);
    		    //所有社区
    		    $list_tmp = $this->cache(true,60)->where($condition)->limit($Page->firstRow.','.$Page->listRows)->order('id')->select();
    		    $list=array();
    		    
    		    //组装数据
    		    foreach ($list_tmp as $community_info)
    		    {
    		        foreach($city_list_result['data']['list'] as $city_info)
    		        {
    		          if($community_info['city_id']==$city_info['id'])
    		          {
    		              $list[$community_info['city_id']]['city_info']=$city_info;
    		              foreach ($alphabet_list as $alphabet)
    		              {
    		                  if($community_info['alphabet']==$alphabet['alphabet'])
    		                  {
    		                      $list[$community_info['city_id']]['community'][$community_info['alphabet']][]=$community_info;
    		                  }
    		              }
    		          }
    		        }
    		    }
    		    ksort($list);
    		    S($s_key,$list,array('expire'=>'300'));
		    }
		}
		elseif($condition['group']=='city')
		{
		    //城市->社区
		    unset($condition['group']);
		    $s_key='community_get_community_list_city';
		    $list = S($s_key);
		    if(empty($list))
		    {
    		    //所有城市
    		    $city_list = $this->cache(true,60)->field('alphabet,city_id,count(*)')->group('city_id')->where($condition)->limit($Page->firstRow.','.$Page->listRows)->order('id')->select();
    		    $city_id_arr=array();
    		    foreach($city_list as $city){
    		        $city_id_arr[]=$city['city_id'];
    		    }
    		    $city_count=count($city_id_arr);
    		    $city_list_condition=array();
    		    $city_list_condition['id']=array('in',$city_id_arr);
    		    $city_list_result = D('District')->cache(true,60)->get_district_list($city_list_condition,$field='*',$city_count);
    		    //所有社区
    		    $list_tmp = $this->cache(true,60)->where($condition)->limit($Page->firstRow.','.$Page->listRows)->order('id')->select();
    		    $list=array();
    		    
    		    //组装数据
    		    foreach ($list_tmp as $community_info)
    		    {
    		        foreach($city_list_result['data']['list'] as $city_info)
    		        {
    		            if($community_info['city_id']==$city_info['id'])
    		            {
    		                $list[$community_info['city_id']]['city_info']=$city_info;
    		                $list[$community_info['city_id']]['community']=$community_info;
    		            }
    		        }
    		    }
    		    ksort($list);
    		    S($s_key,$list,array('expire'=>'300'));
		    }
		}
		elseif($condition['group']=='alphabet')
		{
		    //字母->社区
		    unset($condition['group']);
		    $s_key='community_get_community_list_alphabet';
		    $list = S($s_key);
		    if(empty($list))
		    {
    		    //所有字母
    		    $condition['alphabet']=array('NEQ','');
    		    $alphabet_list = $this->cache(true,60)->field('alphabet,city_id,count(*)')->group('alphabet')->where($condition)->limit($Page->firstRow.','.$Page->listRows)->order('id')->select();
    		    //所有社区
    		    $list_tmp = $this->cache(true,60)->where($condition)->limit($Page->firstRow.','.$Page->listRows)->order('id')->select();
    		    $list=array();
    		    
    		    //组装数据
    		    foreach ($list_tmp as $community_info)
    		    {
    		        foreach($alphabet_list as $alphabet)
    		        {
    		            if($community_info['alphabet']==$alphabet['alphabet'])
    		            {
    		                $list[$community_info['alphabet']][]=$community_info;
    		            }
    		        }
    		        if($community_info['hot']==1)
    		        {
    		            $list['Hot'][]=$community_info;
    		        }
    		    }
    		    ksort($list);
    		    S($s_key,$list,array('expire'=>'300'));
		    }
		     //print_r($list);die();
		}
		else
		{
		  $list = $this->cache(true,60)->where($condition)->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
		}
		if(!empty($list)){
			$result=array(
					'status'=>1,
					'message'=>'成功',
					'data'=>array(
						'page'=>array(
								'count'=>$count,//文章总数
								'page_size'=>$page_size,
								'page'=>$Page->firstRow+1,
							),
						'list'=>$list
					),
			);
		}else{
			$result=array(
					'status'=>0,
					'message'=>'数据为空',
					'data'=>array(
							'page'=>array(),
							'list'=>$list
					),
			);
		}
		return $result;
		// 		$this->assign('list',$list);// 赋值数据集
		// 		$this->assign('page',$show);// 赋值分页输出
		
	}
	
}