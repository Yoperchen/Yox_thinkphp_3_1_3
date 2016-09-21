<?php
class GoodsAction extends Action {
	
public function _empty() {  
    R('Empty/_empty');  
}  
	public function good_detail() {//商品详情
		$id = $_REQUEST['goods_id'];
		
		$Form   =   M('Goods');
		$data =   $Form->find($id);
		if($data) {
			$this->data =   $data;// 模板变量赋值
		}else{
			$this->error('数据错误');
		}
// 		print_r($data);
		$this->display();
	}
	
	public function search_goods(){
		import("@.ORG.Page");       //导入分页类
		$Form   =   M('Goods');
		$conditions = '';
		$conditions .= $this->_param('keywords')?"`goods_name` LIKE '%".$this->_param('keywords')."%'":"name=''";
		$conditions .= $this->_param('keywords')?" or `desc` LIKE '%".$this->_param('keywords')."%'":"desc=''";
		echo $conditions;
		$list = $Form->where($conditions)->select();
		// $list = range(2,51);
		$param = array(
				'result'=>$list,			//分页用的数组或sql
				'listvar'=>'list',			//分页循环变量
				'listRows'=>5,			//每页记录数
				'parameter'=>'search=key&name=thinkphp',//url分页后继续带的参数
				'target'=>'content',	//ajax更新内容的容器id，不带#
				'pagesId'=>'page',		//分页后页的容器id不带# target和pagesId同时定义才Ajax分页
				'template'=>'Index:ajaxgoodlist',//ajax更新模板
		);
		$this->page($param);
		$this->display();
	}
	public function list_goods(){
		import("@.ORG.Page");       //导入分页类
		$Form   =   M('Goods');
		$list = $Form->select();
		// $list = range(2,51);
		$param = array(
				'result'=>$list,			//分页用的数组或sql
				'listvar'=>'list',			//分页循环变量
				'listRows'=>5,			//每页记录数
				'parameter'=>'search=key&name=thinkphp',//url分页后继续带的参数
				'target'=>'content',	//ajax更新内容的容器id，不带#
				'pagesId'=>'page',		//分页后页的容器id不带# target和pagesId同时定义才Ajax分页
				'template'=>'Index:ajaxgoodlist',//ajax更新模板
		);
		$this->page($param);

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
		public function page($param) {
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