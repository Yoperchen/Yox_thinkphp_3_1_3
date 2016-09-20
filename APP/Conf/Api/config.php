<?php
if (!defined('THINK_PATH'))	exit();

return array(
		//'TMPL_ENGINE_TYPE' => 'php',//模版引擎类型
		'TMPL_FILE_DEPR' => '/', //默认模板分隔符
		'DEFAULT_FILTER'=>'htmlspecialchars,strip_tags',//输入过滤
		
		//日志记录
		'LOG_RECORD' => true, // 开启日志记录
		'LOG_LEVEL'  =>'EMERG,ALERT,CRIT,ERR',//只记录EMERG ALERT CRIT ERR 错误
		//'LOG_FILE_SIZE'=>'',//限制日志文件的大小，超过大小的日志会形成备份文件
);