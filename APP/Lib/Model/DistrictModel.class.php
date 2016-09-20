<?php
/**
 * 省份、城市、地区
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 */
class DistrictModel extends Model {
	/**
	 * 
	 * @param int $id
	 */
    public function getDistrictById($id)
    {
        if(empty($id)){
            $data=array('status'=>0,'message'=>'id不能为空');
            return $data;
        }

        $district_info		 = $this->where(array('id'=>$id))->find();
        $result=array('status'=>1,'message'=>'获取详细信息成功','data'=>$district_info);
    
        return $result;
    }
	/**
	 * 根据上级获取下级地区
	 */
	public function get_list_by_upid($upid,$page_size=20){
// 		$condition=array_filter($condition);//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$result=array('status'=>0,'message'=>'错误','data'=>null);
		import('ORG.Util.Page');// 导入分页类
		$count      = $this->where(array('upid'=>$upid))->count();// 查询满足要求的总记录数
		$Page       = new Page($count,$page_size);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $this->where(array('upid'=>$upid))->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
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
	public function get_info_by_district_id($id){
		if(empty($id)){
			$result=array('status'=>0,'message'=>'id不能为空');
			return $result;
		}
		$district_info = $this->where(array('id'=>$id))->find();
		$result=array('status'=>1,'message'=>'成功','data'=>$district_info);
		return $result;
	}
	/**
	 * 地区列表
	 * @param array $condition
	 * @param number $page_size
	 */
	public function get_district_list($condition,$field='*',$page_size=10)
	{
	    ini_set('memory_limit','256M');
		$condition=array_filter($condition,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$result=array('status'=>0,'message'=>'错误','data'=>null);
		import('ORG.Util.Page');// 导入分页类
		$count      = $this->where($condition)->count();// 查询满足要求的总记录数
		$Page       = new Page($count,$page_size);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		
		//字母分组组合数据
		if($condition['group']=='province_alphabet')
		{
		    //省份-城市-区
		    unset($condition['group']);
		    //读缓存
		    $s_key='district_get_district_list_province_alphabet';
		    $list = S($s_key);
		    if(empty($list))
		    {
    		    $condition['alphabet']=array('NEQ','');
     		    $alphabet_list = $this->field('alphabet,level,count(*)')->group('alphabet')->where($condition)->limit($Page->firstRow.','.$Page->listRows)->order('id')->select();
    		    $list_tmp = $this->cache(true,60)->where($condition)->limit($Page->firstRow.','.$Page->listRows)->order('id')->select();
    		    $list        =array();
    		    $list_level_1=array();
    		    $list_level_2=array();
    		    $list_level_3=array();
    		    $list_level_1_tmp=array();
    		    $list_level_2_tmp=array();
    		    $list_level_3_tmp=array();
    		    foreach($list_tmp as $district)
    		    {
    			    foreach($alphabet_list as $alphabet)
    			    {
    			        //一级行政区
    			    	if(($district['alphabet']==$alphabet['alphabet']) && ($district['level']==1))
    			    	{
    				        $list_level_1[$alphabet['alphabet']][]=$district;
    				        $list_level_1_tmp[]=$district;
    				    }
    				    //二级行政区
    				    if(($district['alphabet']==$alphabet['alphabet']) && ($district['level']==2))
    				    {
    				        $list_level_2_tmp[]=$district;
    				    }
    				    //三级行政区
    				    if(($district['alphabet']==$alphabet['alphabet']) && ($district['level']==3))
    				    {
    				        $list_level_3_tmp[]=$district;
    				    }
    			    }
    		    }
    		    
    		    foreach($list_level_1_tmp as $district_level_1)
    		    {
    		        foreach($list_level_2_tmp as $district_level_2)
    		        {
    		            if($district_level_1['id']==$district_level_2['upid']){
    		                $list_level_2['upid_'.$district_level_1['id']]['up_info']=$district_level_1;
    		                $list_level_2['upid_'.$district_level_1['id']]['district'][]=$district_level_2;
    		            }
    		        }
    		    }
    		    foreach($list_level_2_tmp as $district_level_2)
    		    {
    		        foreach($list_level_3_tmp as $district_level_3)
    		        {
    		            if($district_level_2['id']==$district_level_3['upid']){
    		                $list_level_3['upid_'.$district_level_2['id']]['up_info']=$district_level_2;
    		                $list_level_3['upid_'.$district_level_2['id']]['district'][]=$district_level_3;
    		            }
    		        }
    		    }
    		    ksort($list_level_1);
    		    $list['l1']=$list_level_1;
    		    $list['l2']=$list_level_2;
    		    $list['l3']=$list_level_3;
    		    //写缓存
    		    S($s_key,$list,array('expire'=>'300'));
		    }
		    
		}
		elseif($condition['group']=='city_alphabet')
		{
		    //只拿城市
		    unset($condition['group']);
		    //读缓存
		    $s_key='district_get_district_list_city_alphabet';
		    $list = S($s_key);
		    if(empty($list))
		    {
    		    $beijing_result = $this->cache(true,60)->getDistrictById(1);
    		    $shanghai_result = $this->cache(true,60)->getDistrictById(9);
    		    $chongqing_result = $this->cache(true,60)->getDistrictById(22);
    		    $list['B'][]=$beijing_result['data'];
    		    $list['S'][]=$shanghai_result['data'];
    		    $list['C'][]=$chongqing_result['data'];
    		    $list['Hot'][]=$beijing_result['data'];
    		    $list['Hot'][]=$shanghai_result['data'];
    		    $list['Hot'][]=$chongqing_result['data'];
    		    
    		    $condition['alphabet']=array('NEQ','');
    		    $condition['level']=array('EQ',2);
    		    //$condition['id']=array('in',array(1,9,22));
    		    $alphabet_list = $this->cache(true,60)->field('alphabet,level,count(*)')->group('alphabet')->where($condition)->limit($Page->firstRow.','.$Page->listRows)->order('id')->select();
    		    $list_tmp = $this->cache(true,60)->where($condition)->limit($Page->firstRow.','.$Page->listRows)->order('id')->select();
    		    foreach ($list_tmp as $city_district)
    		    {
    		        foreach ($alphabet_list as $alphabet)
    		        {
        		        if($city_district['alphabet']==$alphabet['alphabet'])
        		        {
        		            $list[$alphabet['alphabet']][]=$city_district;
        		        }
    		        }
    		        if($city_district['hot']==1)
    		        {
    		            $list['Hot'][]=$city_district;
    		        }
    		    }
    		    ksort($list);
    		    //写缓存
                S($s_key,$list,array('expire'=>'300'));
		    }
		    //echo $this->getLastSql();
		    //print_r($condition);
		   // echo ' - ';
		   // print_r($list);die();
		}
		else
		{
		    // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
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
			    'condition'=>$condition,
			);
		}else{
			$result=array(
					'status'=>1,
					'message'=>'数据为空',
					'data'=>array(
							'page'=>array(),
							'list'=>$list
					),
			'condition'=>$condition,
			);
		}
		return $result;
	}
	/**
	 * 获取城市列表
	 */
	public function get_city_list($condition,$page_size=10){
		$condition=array_filter($condition,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
		$condition['level']=2;
		$result=array('status'=>0,'message'=>'错误','data'=>null);
		import('ORG.Util.Page');// 导入分页类
		$count      = $this->where($condition)->count();// 查询满足要求的总记录数
		$Page       = new Page($count,$page_size);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $this->where($condition)->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
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
	}
	
	public function get_district_group($condition,$group='alphabet')
	{
	    if($group=='alphabet')
	    {
	        $list = $this->where($condition)->order('id')->group("alphabet")->limit($Page->firstRow.','.$Page->listRows)->select();
	    }
// 	    print_r($list);
	    return $result;
	}
	/**
	 * 
	 * @param int $id
	 * @param array $data
	 */
	public function update_districtById($id,$data)
	{
	    $result=array('status'=>0,'message'=>'修改错误','data'=>null);
	    if(empty($id)||empty($data))
	    {
	        $result=array('status'=>0,'message'=>'修改失败，id或数据为空','data'=>null);
	        return $result;
	    }
	    $data=array_filter($data,"Yocms_del_empty");//去掉数组空值，不然条件上会加上 xx='' 导致数据出不来
	    if($this->where(array('id'=>$id))->save($data)){ // 根据条件保存修改的数据
	        $result=array(
	            'status'=>1,
	            'message'=>'修改成功',
	            'data'=>$data);
	    }else{
	        $result=array(
	            'status'=>0,
	            'message'=>'修改失败',
	            'data'=>$data);
	    }
	
	    return $result;
	
	}
}