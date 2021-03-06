<?php
// 本类由系统自动生成，仅供测试用途
class GoodsAction extends Action {
		//增
		public function addGoods(){
				if(I('param.op','0','htmlspecialchars')=='add'){
						$Goods = M("Goods");
						$data['category'] =I('param.goods_category','0','htmlspecialchars');//分类
						$data['sort'] =I('param.sort','0','htmlspecialchars');//排序
						$data['brand'] =I('param.brand','0','htmlspecialchars');//排序
						$data['store_id'] =I('param.store_id','0','htmlspecialchars');//商家Id
						$data['goods_name'] =I('param.goods_name','0','htmlspecialchars');//商品名称
						$data['quantity'] =I('param.quantity','0','htmlspecialchars');//数量
						$data['price'] =I('param.price','0','htmlspecialchars');//价格
						$data['desc'] =I('param.desc','0','htmlspecialchars');//商品详细描述
						$data['prief'] =I('param.prief','0','htmlspecialchars');//商品简介
						$data['status'] =I('param.status','0','htmlspecialchars');//状态
						$data['img'] =I('param.img','0','htmlspecialchars');//图片
						$data['addTime'] =I('param.addTime','0','htmlspecialchars');//添加时间
						if($Goods->add($data)){
							//$this->success('创建成功',U('AdminStore/Goods/listGoods'));
							echo '数据创建成功';
							exit;
						
						}else{
							//$this->error('数据错误~',U('AdminStore/Goods/addGoods'));
							echo '<a style="color:red">数据创建失败</a>';
				}
			}
			$this->display();
		}
		//删
		public function delGood(){
			$Goods = M('Goods');
			$data['good_id'] = I('param.good_id','0','htmlspecialchars');
			if($Goods->where('goods_id='.$data['good_id'])->delete()){// 删除
				$return_data['good_id'] = $data['good_id'];//ajax返回的数据
				//echo 'c';
				$this->ajaxReturn($return_data,'删除成功',1);
			}else{
				$this->ajaxReturn($return_data,'删除失败',1);
				//echo 's';
			}
		}
		//商品列表(查)
	    public function listGoods(){
	    	import("@.ORG.Page");       //导入分页类
	    	$Goods   =   M('Goods');
	    	$list = $Goods->select();
	    	// $list = range(2,51);
	    	$param = array(
	    			'result'=>$list,			//分页用的数组或sql
	    			'listvar'=>'list',			//分页循环变量
	    			'listRows'=>8,			//每页记录数
	    			'parameter'=>'search=key&name=thinkphp',//url分页后继续带的参数
	    			'target'=>'content',	//ajax更新内容的容器id，不带#
	    			'pagesId'=>'page',		//分页后页的容器id不带# target和pagesId同时定义才Ajax分页
	    			'template'=>'Goods:ajaxgoodlist',//ajax更新模板
	    	);
	    	$this->page($param);
			$this->display();
	    }
	    //改
	    public function updateGoods(){
	    	$Good = D('Goods');
	    	if(I('param.good_id','0','htmlspecialchars')&&I('param.op','0','htmlspecialchars')=='update'){//写到数据库
	    		$data['category'] =I('param.goods_category','0','htmlspecialchars');//分类
	    		$data['sort'] =I('param.sort','0','htmlspecialchars');//排序
	    		$data['store_id'] =I('param.stores','','htmlspecialchars'); //商家Id
	    		$data['goods_name'] =I('param.goods_name','0','htmlspecialchars');//商品名称
	    		$data['brand_id'] =I('param.brand','0','htmlspecialchars');//品牌
	    		$data['quantity'] =I('param.quantity','0','htmlspecialchars');//数量
	    		$data['price'] =I('param.price','0','htmlspecialchars');//价格
	    		$data['brief'] =I('param.brief','没有简介','htmlspecialchars');//简介
	    		$data['desc'] =I('param.desc','没有描述','htmlspecialchars');//商品描述
	    		$data['status'] =I('param.status','0','htmlspecialchars');//状态
	    		$data['img'] =I('param.img','0','htmlspecialchars');//图片
	    		$data['last_update'] =time();//添加时间
	    		
	    		$conditions['goods_id']=array('eq',I('param.good_id','','htmlspecialchars'));//条件

	    		$Good->where($conditions)->save($data); // 根据条件保存修改的数据
	    		
	    		$data =   $Good->find($this->_param('good_id'));
	    		if($data) {
	    			$this->data =   $data;// 模板变量赋值
	    		}else{
	    			$this->error('数据错误~');
	    		}
	    	}else{
	    		$data =   $Good->find($this->_param('good_id'));
	    		if($data) {
	    			$this->data =   $data;// 模板变量赋值
	    		}else{
	    			$this->error('数据错误~');
	    		}
	    	}
	    	$this->display();
	    }
	    public function add_category(){//添加分类
	    	if(I('param.op','0','htmlspecialchars')=='add'){
		    	$Goods_category = D("Goods_category");
		    	$data['name'] =I('param.category_name','没有名称','htmlspecialchars');//添加时间
		    	$data['pid'] =I('param.goods_category','0','htmlspecialchars');//添加时间
		    	$data['description'] =I('param.description','没有描述','htmlspecialchars');//添加时间
		    	$data['kewords'] =I('param.kewords','','htmlspecialchars');//添加时间
		    	$data['sort'] =I('param.sort','50','htmlspecialchars');//添加时间
		    	$data['is_show'] =I('param.is_show','1','htmlspecialchars');//添加时间
		    	if($Goods_category->add($data)){
		    		echo '<a style="color:green;">数据创建成功</a>';
		    		exit;
		    	}else{
		    		echo '<a style="color:red">数据创建失败</a>';
		    	}
	    	}else{
	    		$this->display();
	    	};
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
	     
	    public function listGoodsCategory(){//分类列表
	    	 
	    	$this->display();
	    }
	    public  function update_category(){//修改分类
	    	$Goods_category = D('Goods_category');
	    	if(I('param.category_id','0','htmlspecialchars')&&I('param.op','0','htmlspecialchars')=='update'){//写到数据库
	    		$data['name'] =I('param.category_name','0','htmlspecialchars');
	    		$data['store_id'] =I('param.store_id','0','htmlspecialchars');
	    		$data['pid'] =I('param.store_id','0','htmlspecialchars');
	    		$data['description'] =I('param.description','0','htmlspecialchars');
	    		$data['keywords'] =I('param.keywords','0','htmlspecialchars');
	    		$data['sort'] =I('param.sort','0','htmlspecialchars');
	    		$data['is_show'] =I('param.is_show','0','htmlspecialchars');
	    		
	    		$conditions['id']=array('eq',I('param.category_id','','htmlspecialchars'));//条件
// print_r($data);
	    		$Goods_category->where($conditions)->save($data); // 根据条件保存修改的数据
	    		
	    		$data =   $Goods_category->find(I('param.category_id','0','htmlspecialchars'));
// 	    		print_r($data);
	    		if($data) {
	    			$this->data =   $data;// 模板变量赋值
	    		}else{
	    			$this->error('数据错误~');
	    		}
	    	}else{
	    		$data =   $Goods_category->find($this->_param('category_id'));
	    		if($data) {
	    			$this->data =   $data;// 模板变量赋值
	    		}else{
	    			$this->error('数据错误~');
	    		}
	    	}
	    	$this->display();
	    }

	    public  function add_brand(){
	    	if(I('param.op','0','htmlspecialchars')=='add'){
			    	$Brand = D('Brand');
			    	$data['store_id'] =I('param.addTime','0','htmlspecialchars');//所属商家
			    	$data['name'] =I('param.name','0','htmlspecialchars');//品牌名称
			    	$data['desc'] =I('param.desc','0','htmlspecialchars');//描述
			    	$data['is_show'] =I('param.is_show','1','htmlspecialchars');//是否显示|1:显示，2不显示
			    	$data['sort'] =I('param.sort','50','htmlspecialchars');//排序
			    	if($Brand->add($data)){
			    		//$this->success('创建成功',U('AdminStore/Goods/listGoods'));
			    		echo '<a style="color:green">数据创建成功</a>';
			    		exit;
			    	
			    	}else{
			    		//$this->error('数据错误~',U('AdminStore/Goods/addGoods'));
			    		echo '<a style="color:red">数据创建失败</a>';
			    	}
			    	}else{
		    	$this->display();
	    	}
	    }
	    
	    public  function del_brand(){
	    	$Brand = M('Brand');
			$conditions['id']=array('eq',I('param.brand_id','','htmlspecialchars'));//条件
			if($Brand->where($conditions)->delete()){// 删除
				echo '<a style="color:green;">删除成功</a>';
			}else{
				echo '<a style="color:red;">删除失败</a>';
			}
			exit;
	    }
	    public  function list_brands(){
	    	$this->display();
	    }
	    public  function update_brand(){
	    	$Brand = D('Brand');
	    	if(I('param.brand_id','0','htmlspecialchars')&&I('param.op','0','htmlspecialchars')=='update'){
			    	$data['name'] =I('param.name','0','htmlspecialchars');//品牌名称
			    	$data['desc'] =I('param.desc','0','htmlspecialchars');//描述
			    	$data['is_show'] =I('param.is_show','1','htmlspecialchars');//是否显示|1:显示，2不显示
			    	$data['sort'] =I('param.sort','50','htmlspecialchars');//排序
	    	 
	    		    $conditions['id']=array('eq',I('param.brand_id','','htmlspecialchars'));//条件
	    	
	    		    $Brand->where($conditions)->save($data); // 根据条件保存修改的数据
	    	 
	    	     	$data =   $Brand->where($conditions)->find();
	    		if($data) {
	    			$this->data =   $data;// 模板变量赋值
	    			echo '<a style="color:green;">修改成功</a>';
	    			$this->display();
	    		}else{
	    			$this->error('数据错误~');
	    		}
	    	}else{
	    		$conditions['id']=array('eq',I('param.brand_id','','htmlspecialchars'));//条件
	    		$data =   $Brand->where($conditions)->find();
	    		if($data) {
	    			$this->data =   $data;// 模板变量赋值
// 	    			print_r($data);
	    		}else{
	    			$this->error('数据错误');
	    		}
	    		$this->display();
	    	}
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