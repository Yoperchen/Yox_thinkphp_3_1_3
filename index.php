<?php
error_reporting(E_ALL);
ini_set('max_execution_time', '100');
//phpinfo();
if($_SERVER["HTTP_HOST"]=='linglingtang.com')
{
	//商城
	header('Location: http://www.linglingtang.com/');
}else{
//商城
	define('BUILD_DIR_SECURE',true);//目录安全文件
	define('DIR_SECURE_FILENAME', 'index.html');//目录安全文件
	define('DIR_SECURE_CONTENT', 'deney Access!');//目录安全文件
	
	define('APP_NAME','APP');//项目名称
	define('APP_PATH','./APP/');//项目目录
	define('APP_DEBUG', true);//调试
	
	require 'ThinkPHP_3_1_3/ThinkPHP.php';

}

