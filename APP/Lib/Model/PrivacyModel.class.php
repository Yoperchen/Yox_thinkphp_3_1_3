<?php
/**
 * 隐私模型
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class PrivacyModel extends AdvModel 
{
	/**
	 * 添加隐私
	 * @param array $data
	 */
	public function add_privacy($data){
		$data['add_time']=time();
		$result=array('status'=>0,'message'=>'data不能为空');
		if(!empty($data['user_id'])&&!is_numeric($data['user_id'])){
			$result=array('status'=>0,'message'=>'user_id 错误','data'=>null);
		}

		$data=array_filter($data,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		if(!empty($data)){
			$privacy_id=$this->data($data)->add();
		}
		$result=array('status'=>1,'message'=>'成功','data'=>$data);
		return $result;

	}
	/**
	 * 隐私详细
	 * @param number $id
	 * @param number $isdetail
	 * @return array
	 */
	public function get_privacyById($id=0,$isdetail=0){
		if(empty($id)){ 
			$data=array('status'=>0,'message'=>'id不能为空');
			return $data;
		}
		$this->where(array('id'=>$id))->setLazyInc('view',1,60);//每60秒统一更新+1
		if($isdetail==0){
			$privacy_info = $this->where(array('id'=>$id))->find();
			$result=array('status'=>1,'message'=>'成功','data'=>$privacy_info);
		}else{//详细
			$privacy_info		 = $this->where(array('id'=>$id))->find();
			$result=array('status'=>1,'message'=>'获取详细信息成功','data'=>$privacy_info);
		}
		return $result;
		
	} 
	/**
	 * 隐私列表
	 * @param array $condition
	 * @param number $page_size
	 * @return array
	 */
	public function get_privacy_list($condition,$page_size=20){
		$condition=array_filter($condition,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$result=array('status'=>0,'message'=>'错误','data'=>null);
		if(!empty($condition['belong_user_id'])&&!is_numeric($condition['belong_user_id'])){
			$result=array('status'=>0,'message'=>'user_id 错误','data'=>null);
		}
		import('ORG.Util.Page');// 导入分页类
		$count      = $this->where($condition)->count();// 查询满足要求的总记录数
		$Page       = new Page($count,$page_size);// 实例化分页类 传入总记录数和每页显示的记录数
// 		$Page->setConfig('theme',' %totalRow% %header% %nowPage%/%totalPage% 页 %downPage%');//自定义分页输出
		$show       = $Page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $this->where($condition)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		if(!empty($list)){
			$result=array(
					'status'=>1,
					'message'=>'成功',
					'data'=>array(
						'page'=>array(
								'count'=>$count,//文章总数
								'page_size'=>$page_size,
								'page'=>$_REQUEST['p']?"".$_REQUEST['p']."":"1",
								'page_str'=>$Page->show(),
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
	/**
	 * 修改隐私
	 * @param int $id
	 * @param array $data
	 */
	public function update_privacyById($id,$data){
		$data['update_time']=time();
		$result=array('status'=>0,'message'=>'修改错误','data'=>null);
		if(empty($id)||empty($data)){
			$result=array('status'=>0,'message'=>'修改失败，id或数据为空','data'=>null);
			return $result;
		}
// 		print_r($data);die();
		$data=array_filter($data,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		if($this->where(array('id'=>$id))->save($data)){ // 根据条件保存修改的数据
			$result=array(
					'status'=>1,
					'message'=>'修改成功,',
					'data'=>$data);
		}else{
			$result=array(
					'status'=>0,
					'message'=>'修改失败,',
					'data'=>$data);
		}
		
		return $result;
		
	}
	/**
	 * 删除
	 * @param int $id
	 */
	public function del_privacy($id){
		$result=array('status'=>0,'message'=>'删除成功','data'=>null);
		if(empty($id))
		{
			$result=array('status'=>0,'message'=>'删除成功失败，id或数据为空','data'=>null);
			return $result;
		}
		$tmp=$this->where(array('id'=>$id))->delete();
		if($tmp)
		{
			$result=array('status'=>1,'message'=>'删除成功','data'=>$tmp);
		}
		else
		{
			$result=array('status'=>0,'message'=>'删除失败','data'=>$tmp);
		}
		return $result;
		
	}
	/**
	 * 检查用户内容隐私设置
	 * @param int $belong_user_id 隐私所有者id
	 * @param int $visit_user_id 访问者id
	 * @param string $content 属于$belong_user_id黑白名单针对的内容类型|all所有内容/article5654指定文章/goods888指定商品/user123
	 */
	public function check_privacy($belong_user_id,$visit_user_id,$content)
	{
		$privacy_condition=array();
		$result = array('status'=>1,'message'=>'s');
		$privacy_condition['belong_user_id']=$belong_user_id;
		$privacy_condition['status']=1;
		$privacy_list_result = $this->get_privacy_list($privacy_condition,$page_size=1000000);
		//检查权限
		foreach($privacy_list_result['data']['list'] as $privacy)
		{
			if($privacy['restriction_type']==2)
			{
				//黑名单
				//目标内容 目标用户|all:所有人、friend:好友、follower关注着、1，2，3指定用户
				if(!is_array($content) && $privacy['content']==$content &&  $privacy['user']==$visit_user_id)
				{
					//指定内容指定用户无权限浏览
					$privacy['privacy_note']='';
					$privacy['privacy_note']='您无权限访问此内容';
					$result = array('status'=>0,'message'=>$privacy['privacy_note'],'data'=>$privacy);
					break;
				}
// 				if(is_array($content) && in_array($privacy['content'], $content) &&  $privacy['user']==$visit_user_id)
// 				{
// 					//指定内容指定用户无权限浏览
// 					foreach($content as $c)
// 					{
// 						if($c==$privacy['content'])
// 						{
// 							$privacy_content_arr[]=$c;
// 						}
// 					}
// 					$result = array('status'=>0,'message'=>'您无权限访问此内容','data'=>array('privacy_content'=>$privacy_content_arr));
// 					break;
// 				}
				if($privacy['content']=='all' && $privacy['user']==$visit_user_id)
				{
					//所有内容指定用户无权限浏览
					//即指定用户不可见
					$privacy['privacy_note']='';
					$privacy['privacy_note']='您无权限访问此内容.';
					$result = array('status'=>0,'message'=>$privacy['privacy_note'],'data'=>$privacy);
					break;
				}
				if($privacy['content']=='all' && $privacy['user']=='follower')
				{
					//所有内容关注者无权限浏览
					//即关注者不可见
					//暂未开发
					$privacy['privacy_note']='';
					$privacy['privacy_note']='您无权限访问此内容..';
					$result = array('status'=>0,'message'=>$privacy['privacy_note'],'data'=>$privacy);
					break;
				}
				if($privacy['content']=='all' && $privacy['user']=='friend')
				{
					//所有内容好友无权限浏览(黑名单)
					//即好友不可见
					$User_friends_model = D('User_friends');
					$user_friend_condition=array();
					$user_friend_condition['user_id']=$belong_user_id;
					$user_friend_condition['friend_user_id']=$visit_user_id;
					$user_friend_list_result = $User_friends_model->get_friend_list($user_friend_condition,$page_size=10000);
					if(count($user_friend_list_result['data']['list'])>0)
					{
						$privacy['privacy_note']='';
						$privacy['privacy_note']='您无权限访问此内容...';
						$result = array('status'=>0,'message'=>$privacy['privacy_note'],'data'=>$privacy);
						break;
					}
						
				}
				if($privacy['content']=='all' && $privacy['user']=='all')
				{
					//所有内容 所有用户无权限浏览(黑名单)
					//即仅自己可见
					$privacy['privacy_note']='';
					$privacy['privacy_note']='无权限访问,空间只主人自己可见';
					$result = array('status'=>0,'message'=>$privacy['privacy_note'],'data'=>$privacy);
					break;
				}
			}
			
			if($privacy['restriction_type']==1)
			{
				//白名单
				//目标内容 目标用户|all:所有人、friend:好友、follower关注着、1，2，3指定用户
				if(!is_array($content) && $privacy['content']==$content &&  $privacy['user']==$visit_user_id)
				{
					//指定内容指定用户才有权限浏览
					$privacy['privacy_note']='';
					$privacy['privacy_note']='有权访问此内容.';
					$result = array('status'=>1,'message'=>$privacy['privacy_note'],'data'=>$privacy);
					break;
				}
// 				elseif(is_array($content) && in_array($privacy['content'], $content) &&  $privacy['user']==$visit_user_id)
// 				{
// 					//所有内容指定用户才有权限浏览
// 					//即指定用户可见
// 					$result = array('status'=>1,'message'=>'有权访问');
// 					break;
// 				}
				elseif($privacy['content']=='all' && $privacy['user']=='follower')
				{
					//所有内容关注者才有权限浏览
					//即关注者可见
					//暂未开发
					$privacy['privacy_note']='';
					$privacy['privacy_note']='有权访问.';
					$result = array('status'=>1,'message'=>$privacy['privacy_note'],'data'=>$privacy);
					break;
				}
				elseif($privacy['content']=='all' && $privacy['user']=='friend')
				{
					//所有内容好友才有权限浏览(白名单)
					//即好友可见
					$User_friends_model = D('User_friends');
					$user_friend_condition=array();
					$user_friend_condition['user_id']=$belong_user_id;
					$user_friend_condition['friend_user_id']=$visit_user_id;
					$user_friend_list_result = $User_friends_model->get_friend_list($user_friend_condition,$page_size=10000);
					if(count($user_friend_list_result['data']['list'])>0)
					{
						$privacy['privacy_note']='';
						$privacy['privacy_note']='有权访问..';
						$result = array('status'=>1,'message'=>$privacy['privacy_note'],'data'=>$privacy);
						break;
					}
						
				}
				elseif($privacy['content']=='all' && $privacy['user']=='all')
				{
					//所有内容 所有用户有权限浏览(白名单)
					//所有人可见
					$privacy['privacy_note']='';
					$privacy['privacy_note']='有权访问...';
					$result = array('status'=>1,'message'=>$privacy['privacy_note'],'data'=>$privacy);
					break;
				}
				else
				{
					//设置了白名单，却不在匹配范围内
					$privacy['privacy_note']='';
					$privacy['privacy_note']='无权访问';
					$result = array('status'=>0,'message'=>$privacy['privacy_note'],'data'=>$privacy);
					break;
				}
			}
		}
		return $result;
	}
	/**
	 * 内容列表隐私判断，只做标识，不做阅览限制
	 * @param array $prefix 前缀 article、file、goods、user
	 * @param array $content_list
	 * @return array $result
	 */
	public function mark_content_list_privacy($prefix='',$content_list)
	{
		$result = array('status'=>1,'message'=>'s');
		if(empty($prefix)||empty($content_list))
		{
			$result = array('status'=>0,'message'=>'前缀为空或列表为空');
			return $result;
		}
		foreach($content_list as $content)
		{
			$prefix_content_id_arr[]=$prefix.$content['id'];
		}
		$privacy_condition=array();
		$privacy_condition['status']=1;
		$privacy_condition['content'] = array('in',$prefix_content_id_arr);
		$privacy_list_result = $this->get_privacy_list($privacy_condition,$page_size=1000000);
		if($privacy_list_result['data']['list'])
		{
			//返回设置了隐私的内容设置
			$new_content_list=array();
			foreach($content_list as $key1=>$content)
			{
				$prefix_content_id=$prefix.$content['id'];
				foreach($privacy_list_result['data']['list'] as $key2=>$privacy_content)
				{
					if($privacy_content['content']==$prefix_content_id && $privacy_content['restriction_type']==1)
					{
						//白名单
						//隐私描述
						$privacy_content['privacy_note']='';
						if(empty($privacy_content['privacy_note']))$privacy_content['privacy_note']=$privacy_content['question_ids']?'回答问题可见':'';
						if(empty($privacy_content['privacy_note']))$privacy_content['privacy_note']=$privacy_content['user']=='all'?'所有人可见':'';
						if(empty($privacy_content['privacy_note']))$privacy_content['privacy_note']=$privacy_content['user']=='friend'?'好友可见':'';
						if(empty($privacy_content['privacy_note']))$privacy_content['privacy_note']=$privacy_content['user']=='follower'?'关注可见':'';
						if(empty($privacy_content['privacy_note']))$privacy_content['privacy_note']=(strstr($privacy_content['user'],',')||is_numeric($privacy_content['user']))?'指定'.$privacy_content['user'].'用户可见':'';
						$content['privacy_info'][]=$privacy_content;
						//匹配到就没用了,释放内存
						unset($privacy_list_result['data']['list'][$key2]);
					}
					if($privacy_content['content']==$prefix_content_id && $privacy_content['restriction_type']==2)
					{
						//黑名单
						//隐私描述
						$privacy_content['privacy_note']='';
						if(empty($privacy_content['privacy_note']))$privacy_content['privacy_note']=$privacy_content['user']=='all'?'所有人不可见':'';
						if(empty($privacy_content['privacy_note']))$privacy_content['privacy_note']=$privacy_content['user']=='friend'?'好友不可见':'';
						if(empty($privacy_content['privacy_note']))$privacy_content['privacy_note']=$privacy_content['user']=='follower'?'关注不可见':'';
						if(empty($privacy_content['privacy_note']))$privacy_content['privacy_note']=(strstr($privacy_content['user'],',')||is_numeric($privacy_content['user']))?'指定'.$privacy_content['user'].'用户不可见':'';
						$content['privacy_info'][]=$privacy_content;
						//匹配到就没用了,释放内存
						unset($privacy_list_result['data']['list'][$key2]);
					}
				}
				$new_content_list[]=$content;
				unset($content_list[$key1]);
			}
			unset($privacy_list_result);
			$result = array('status'=>1,'message'=>'本列表有隐私内容','data'=>array('list'=>$new_content_list));
		}else 
		{
			$result = array('status'=>0,'message'=>'本列表没有隐私内容','data'=>array('list'=>$content_list));
		}
		return $result;
	}
	
}