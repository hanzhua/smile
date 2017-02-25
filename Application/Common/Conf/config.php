<?php
 return [
			// 输入过滤
			'DEFAULT_FILTER' =>  'htmlspecialchars,strip_tags,stripslashes',

			/*数据库配置*/
			// 数据库类型
			'DB_TYPE'		=> 'mysql',
			// 服务器地址
			'DB_HOST'		=> '127.0.0.1',
			// 用户名
			'DB_USER'		=> 'root',
			// 密码
			'DB_PWD'		=> 'root',
			// 端口
			'DB_PORT'       => '3306',
			// 数据库名
			'DB_NAME'		=> 'smile',
			// 数据库表前缀
			'DB_PREFIX'		=> 'sml_',
			// 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
			'DB_DEPLOY'     => 0,
			// 数据库读写是否分离 主从式有效
			'DB_RW_SEPARATE' => false,
			// 读写分离后 主服务器数量
			'DB_MASTER_NUM'  => 1,
			// 指定从服务器序号
			'DB_SLAVE_NO'    => '',

			/* URL设置 */
			// URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    		// 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式
			'URL_MODEL'			=>  0,
			// URL伪静态后缀设置
    		'URL_HTML_SUFFIX'   => 'html' ,

    		/* 日志设置 */
			'LOG_RECORD'            =>  true,   // 默认false:不记录日志
			'LOG_TYPE'              =>  'File', // 日志记录类型 默认为文件方式
			'LOG_LEVEL'             =>  'EMERG,ALERT,CRIT,ERR',// 允许记录的日志级别
			'LOG_FILE_SIZE'         =>  2097152,	// 日志文件大小限制
			'LOG_EXCEPTION_RECORD'  =>  true,    // 是否记录异常信息日志
	];
?>