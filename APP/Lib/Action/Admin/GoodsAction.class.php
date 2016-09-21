<?php
/**
 * 商品管理
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class GoodsAction extends AdminbaseAction {
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
		//增
		public function addGoods(){
			$Goods = D("Goods");
			
			$data['category'] = I('param.category','','htmlspecialchars');//分类
			$data['sort'] = I('param.sort','','htmlspecialchars');//排序
			$data['store_id'] = I('param.store_id','','htmlspecialchars');//商家Id
			$data['name'] = I('param.name','','htmlspecialchars');//商品名称
			$data['quantity'] = I('param.quantity','','htmlspecialchars');//数量
			$data['price'] = I('param.price','','htmlspecialchars');//价格
			$data['desc'] =I('param.desc','','htmlspecialchars');//商品描述
			$data['status'] =I('param.status','','htmlspecialchars');//状态
			$data['attribute_type'] =$_POST['attribute_type'];//状态
			$data['img'] = I('param.img','','htmlspecialchars');//图片
			if(!empty($data)&&!empty($data['name']))
			{
				$result = $Goods->add_good($data);
				if($result['status']==1)
				{
					$this->success('添加成功');
				}else{
					$this->error('添加失败');
				}
			}else
			{
				$this->display();
			}
		}
		//删
		public function delGood(){
			$Goods = M('Goods');
			$data['goods_id'] = I('param.goods_id','','htmlspecialchars');
			if($Goods->where('goods_id='.$data['goods_id'])->delete()){// 删除
				$return_data['goods_id'] = $data['goods_id'];//ajax返回的数据
				//echo 'c';
				$this->ajaxReturn($return_data,'删除成功',1);
			}else{
				$this->ajaxReturn($return_data,'删除失败',1);
				//echo 's';
			}
		}
		//商品列表(查)
	    public function listGoods(){
	    	$Goods   =   D('Goods');
	    	$condition=array();
	    	$condition['site_id'] = I('param.site_id','','int');//站点id
	    	$condition['store_id'] = I('param.store_id','','int');//商家id
	    	$condition['user_id'] = I('param.user_id','','int');//用户id
	    	$condition['name']=array('like','%'.I('param.name','','htmlspecialchars').'%');//商品名称
	    	$condition['status'] = I('param.status','','int');//商品状态
	    	$add_time1 = I('param.add_time1','', 'htmlspecialchars');
	    	$add_time2 = I('param.add_time2','', 'htmlspecialchars');
	    	if(!empty($add_time1)&&!empty($add_time2))
	    	{
	    		$condition['add_time2'] = array(
	    				array('gt',strtotime($add_time1)),
	    				array('lt',strtotime($add_time2))
	    		);
	    	}
	    	$good_list_result = $Goods->get_good_list($condition,$page_size=12);
// 	    	print_r($good_list_result);
	    	$this->assign('good_list_result',$good_list_result);
			$this->display();
	    }
	    public function detailGood(){
	    	$goods_id =I('param.goods_id','','htmlspecialchars');
	    	$is_export =I('param.is_export','','htmlspecialchars');
	    	$Goods=D('Goods');
	    	$good_info_result = $Goods->getGoodById($goods_id);
	    	if($good_info_result['status']!=1){
	    		$this->error($good_info_result['message']);
	    	}
	    	if($is_export)
	    	{
	    	
	    		$film_name='order'.$good_info_result['data']['order_num'].'.xls';
	    		header("Content-Type: application/vnd.ms-excel");
	    		header("Content-Disposition: attachment;filename=" . $film_name);
	    		echo iconv('utf-8','gbk',"订单号\t名称\t1\t2\t3\t4\t5\t6\t7\r\n");
	    		//     		$str.="Straight (Cut)\t短管\tA\tB\tL\t\t\t\t\r\n";
	    		$str.=$good_info_result['data']['goods_id']."\t";
	    		$str.=$good_info_result['data']['name']."\t";
	    		$str.=$good_info_result['data']['name']."\t";
	    		$str.=$good_info_result['data']['name']."\t";
	    		$str.=$good_info_result['data']['name']."\t";
	    		$str.=$good_info_result['data']['name']."\t";
	    		$str.=$good_info_result['data']['name']."\t";
	    		$str.=$good_info_result['data']['name']."\t";
	    		$str.=$good_info_result['data']['name']."\t";
	    		$str.="\r\n";
	    		echo iconv('utf-8','gbk',$str);die();
	    	}
// 	    	print_r($good_info_result);
	    	$this->assign('good_info_result',$good_info_result);
	    	$this->display();
	    }
	    //改
	    public function updateGoods(){
	    	if($this->_get('good_id', 'htmlspecialchars')&&$this->_get('op', 'htmlspecialchars')=='update'){//写到数据库

	    	}else{
	    		$Good = D('Goods');
	    		$data =   $Good->find($this->_get('good_id'));
	    		if($data) {
	    			$this->data =   $data;// 模板变量赋值
	    		}else{
	    			$this->error('数据错误');
	    		}
	    	}
	    	$this->display();
	    }
	    /**
	     * 添加分类
	     */
	    public function add_category(){
	    	$Goods_category = D("Goods_category");
	    	if(I('param.op','0','htmlspecialchars')=='add'){
	    		$data['site_id'] =I('param.site_id','0','htmlspecialchars');//添加时间
	    		$data['store_id'] =I('param.store_id','0','htmlspecialchars');//添加时间
	    		$data['name'] =I('param.name','没有名称','htmlspecialchars');//添加时间
	    		$data['pid'] =I('param.pid','0','htmlspecialchars');//添加时间
	    		$data['description'] =I('param.description','没有描述','htmlspecialchars');//添加时间
	    		$data['kewords'] =I('param.kewords','','htmlspecialchars');//添加时间
	    		$data['sort'] =I('param.sort','50','htmlspecialchars');//添加时间
	    		$data['is_show'] =I('param.is_show','1','htmlspecialchars');//添加时间
	    		
	    		$category_add_result = $Goods_category->add_category($data);
	    		if($category_add_result['status']<1)
	    		{
	    			$this->error($category_add_result['message']);
		    	}else{
		    		
		    		$this->success($category_add_result['message']);
		    	}
	    	}else{
	    		$condition=array();
	    		$category_list_result = $Goods_category->get_good_category_list($condition,$page_size=100);
	    		$this->assign('category_list_result',$category_list_result);
	    		$this->display();
	    	}
	    }
	    public  function delete_category(){//删除分类
	    	$Goods_category = M('Goods_category');
	    	$data['id'] = I('param.category_id','0','htmlspecialchars');
	    	if($Goods_category->where('id='.$data['id'])->delete()){// 删除
	    		echo '删除成功';
	    	}else{
	    		echo '删除失败';
	    	}
	    	exit;
	    }
	    /**
	     * 分类列表
	     */
	    public function listGoodsCategory(){
	    	$condition=array();
	    	$page_size = 50;
	    	$Goods_category = D('Goods_category');
	    	
	    	$category_list_result = $Goods_category->get_good_category_list($condition,$page_size);
// 	    	print_r($category_list_result);
	    	$this->assign('category_list_result',$category_list_result);
	    	$this->display();
	    }
	    public  function update_category(){//修改分类
	    	$Goods_category = D('Goods_category');
	    	$category_id = I('param.category_id','0','htmlspecialchars');
	    	if(!empty($category_id) && I('param.op','0','htmlspecialchars')=='update'){//写到数据库
	    		$data['name'] =I('param.category_name','0','htmlspecialchars');
	    		$data['store_id'] =I('param.store_id','0','htmlspecialchars');
	    		$data['pid'] =I('param.store_id','0','htmlspecialchars');
	    		$data['description'] =I('param.description','0','htmlspecialchars');
	    		$data['keywords'] =I('param.keywords','0','htmlspecialchars');
	    		$data['sort'] =I('param.sort','0','htmlspecialchars');
	    		$data['is_show'] =I('param.is_show','0','htmlspecialchars');
	    		 
	    		$category_update_result =   $Goods_category->update_category($category_id,$data);
	    		// 	    		print_r($data);
	    		if($category_update_result['status']) {
	    			$this->success($category_update_result['message']);
	    		}else{
	    			$this->error($category_update_result['message']);
	    		}
	    	}else{
	    		$category_info_result =   $Goods_category->get_info_by_category_id($category_id);
	    		if($category_info_result['status']) {
	    			$this->category_info_result =   $category_info_result;// 模板变量赋值
	    		}else{
	    			$this->error($category_info_result['message']);
	    		}
	    	}
	    	$this->display();
	    }
	    
	    
	    
	    
	    
	    

	    /**
	     +----------------------------------------------------------
	     * 分页函数 支持sql和数据集分页 sql请用 buildSelectSql()函数生成
	     +----------------------------------------------------------
	     * @access public
	     +----------------------------------------------------------
	     * @param array   $result 排好序的数据集或者查询的sql语句
	     * @param int       $totalRows  每页显示记录数 默认21
	     * @param string $listvar    赋给模板遍历的变量名 默认list
	     * @param string $parameter  分页跳转的参数
	     * @param string $target  分页后点链接显示的内容id名
	     * @param string $pagesId  分页后点链接元素外层id名
	     * @param string $template ajaxlist的模板名
	     * @param string $url ajax分页自定义的url
	     +----------------------------------------------------------
	     */
	    public  function page($param) {
	    	extract($param);
	    	import("@.ORG.Page");
	    	//总记录数
	    	$flag = is_string($result);
	    	$listvar = $listvar ? $listvar : 'list';
	    	$listRows = $listRows? $listRows : 21;
	    	if ($flag)
	    		$totalRows = M()->table($result . ' a')->count();
	    	else
	    		$totalRows = ($result) ? count($result) : 1;
	    	//创建分页对象
	    	if ($target && $pagesId)
	    		$p = new Page($totalRows, $listRows, $parameter, $url,$target, $pagesId);
	    	else
	    		$p = new Page($totalRows, $listRows, $parameter,$url);
	    	//抽取数据
	    	if ($flag) {
	    		$result .= " LIMIT {$p->firstRow},{$p->listRows}";
	    		$voList = M()->query($result);
	    	} else {
	    		$voList = array_slice($result, $p->firstRow, $p->listRows);
	    	}
	    	$pages = C('PAGE');//要ajax分页配置PAGE中必须theme带%ajax%，其他字符串替换统一在配置文件中设置，
	    	//可以使用该方法前用C临时改变配置
	    	foreach ($pages as $key => $value) {
	    		$p->setConfig($key, $value); // 'theme'=>'%upPage% %linkPage% %downPage% %ajax%'; 要带 %ajax%
	    	}
	    	//分页显示
	    	$page = $p->show();
	    	//模板赋值
	    	$this->assign($listvar, $voList);
	    	$this->assign("page", $page);
	    	if ($this->isAjax()) {//判断ajax请求
	    		layout(false);
	    		$template = (!$template) ? 'ajaxgoodlist' : $template;
	    		exit($this->fetch($template));
	    	}
	    	return $voList;
	    }
}