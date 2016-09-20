<?php
return array(
	//'配置项'=>'配置值'
	   // 'TMPL_L_DELIM'=>'{YO:',//模版左标签
	//	'TMPL_R_DELIM'			=>'}',//模版右标签
		'HOST' =>'http://www.linglingtang.me/',
		'URL_MODEL'     =>  3,
		'URL_PATHINFO_DEPR' =>  '/',
		
		//分组
		'APP_GROUP_LIST'	=> 'Yo81008',//分组列表
		'DEFAULT_GROUP' 	=> 'Yo81008',//默认分组
		'TMPL_FILE_DEPR'	=>'/',//默认是'/',为了减少目录深度，用_
		
		//多语言
		'LANG_SWITCH_ON'    => true,   // 开启语言包功能
		'LANG_AUTO_DETECT'  => true, // 自动侦测语言 开启多语言功能后有效
		'DEFAULT_LANG' 	    => 'zh-cn', // 默认语言
		'LANG_LIST'         => 'zh-cn,en-us,zh-tw', // 允许切换的语言列表 用逗号分隔
		'VAR_LANGUAGE'      => 'l', // 默认语言切换变量字母‘l’
		
		//分布式数据库配置定义,默认第一个数据库配置是主服务器
		'DB_TYPE'            =>  'mysql',//分布式数据库类型必须相同
		'DB_HOST'          =>  'localhost',//即使是两个相同的IP也需要重复定义
		'DB_NAME'         =>  'yo20150301',//如果相同可以不用定义多个
		'DB_USER'           => 'root',//如果相同可以不用定义多个
		'DB_PWD'            => '',//如果相同可以不用定义多个
		'DB_PORT'           => '3307',//如果相同可以不用定义多个
		'DB_PREFIX'        =>  'Yo_',
		//'DB_RW_SEPARATE'=>false,//设置分布式数据库的读写是否分离,true:分离|false:不分离
		//'DB_MASTER_NUM'=>'',//支持多个主服务器写入
		
		//邮件配置
		'MAIL_ADDRESS'=>'xxxxxxxxx@qq.com', // 邮箱地址
		'MAIL_LOGINNAME'=>'xxxxxxxxx@qq.com', // 邮箱登录帐号
		'MAIL_SMTP'=>'smtp.qq.com', // 邮箱SMTP服务器
		'MAIL_PASSWORD'=>'xxxxxxxxx', // 邮箱密码

		//'COOKIE_DOMAIN' => 'linglingtang.com', // Cookie有效域名
		
		/*
		// 开启子域名配置
		//详情访问http://doc.thinkphp.cn/manual/sub_domain_deploy.html
		*/
		'APP_SUB_DOMAIN_DEPLOY'=>1, 
   		 /*子域名配置 
   		 *格式如: '子域名'=>array('分组名/[模块名]','var1=a&var2=b'); 
   	 	*/
    	'APP_SUB_DOMAIN_RULES'=>array
		(
			'yo81008'=>array('Yo81008/'),  //  

    	),
    
        //缓存方式
        //支持: File|Db|Apc|Memcache|Shmop|Sqlite|Xcache|Apachenote|Eaccelerator
//        'DATA_CACHE_TYPE' => 'Memcache',
//        'MEMCACHE_HOST' => '127.0.0.1',
//        'MEMCACHE_PORT'	=>	'11211',

);