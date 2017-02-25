<?php
function env_check(&$env_items) {
	foreach($env_items as $key => $item) {
		$env_items[$key]['status'] = 1;
		if($key == 'os') {
			$env_items[$key]['current'] = PHP_OS;
		} elseif($key == 'php'){
			$env_items[$key]['current'] = PHP_VERSION;
		} elseif($key == 'attachmentupload') {
			if(@ini_get('file_uploads')){
				$env_items[$key]['current'] =  ini_get('upload_max_filesize');
			}else{
				$env_items[$key]['status'] = -1;
				$env_items[$key]['current'] = '没有开启文件上传';
			}
		} elseif($key == 'gdversion') {
			if(extension_loaded('gd')){
				$tmp = gd_info();
			    $env_items[$key]['current'] = empty($tmp['GD Version']) ? '' : $tmp['GD Version'];
			    unset($tmp);
			}else{
				$env_items[$key]['current'] = "没有开启GD扩展";
				$env_items[$key]['status'] = -1;
			}
		} elseif($key == 'diskspace') {
			if(function_exists('disk_free_space')) {
				$env_items[$key]['current'] = floor(disk_free_space(INSTALL_ROOT) / (1024*1024)).'M';
			} else {
				$env_items[$key]['current'] = '未知的磁盘空间';
				$env_items[$key]['status'] = 0;
			}
		}
	}
	return $env_items;
}

function dir_check(&$dir_items) {
	foreach($dir_items as $key => $item) {
		$item_path = $item['path'];
		if(!dir_writeable(INSTALL_ROOT.$item_path)) {
			if(!is_dir(INSTALL_ROOT.$item_path)) {
				$dir_items[$key]['status'] = 1;
			} else {
				$dir_items[$key]['status'] = -1;
			}
		} else {
			$dir_items[$key]['status'] = 1;
		}
	}
	return $dir_items;
}

function dir_writeable($dir) {
	$writeable = 0;
	if(!is_dir($dir)) {
		@mkdir($dir, 0777);
	}
	if(is_dir($dir)) {
		if($fp = @fopen("$dir/test.txt", 'w')) {
			@fclose($fp);
			
		}
	    if(file_exists("$dir/test.txt")){
	    	$writeable = 1;
			@unlink("$dir/test.txt");
		}
	}
	return $writeable;
}
function initConfig($db_host,$db_user,$db_port,$db_pass,$db_prefix,$db_name){
	$code = "return [
			// 输入过滤
			'DEFAULT_FILTER' =>  'htmlspecialchars,strip_tags,stripslashes',

			/*数据库配置*/
			// 数据库类型
			'DB_TYPE'		=> 'mysql',
			// 服务器地址
			'DB_HOST'		=> '127.0.0.1',
			// 用户名
			'DB_USER'		=> '".$db_user."',
			// 密码
			'DB_PWD'		=> '".$db_pass."',
			// 端口
			'DB_PORT'       => '".$db_port."',
			// 数据库名
			'DB_NAME'		=> '".$db_name."',
			// 数据库表前缀
			'DB_PREFIX'		=> '".$db_prefix."',
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
	]";
	$code = "<?php\n ".$code.";\n?>";
    file_put_contents(INSTALL_ROOT."/Application/common/conf/config.php", $code);
    
    clearstatcache();
}
function check_func($func_items){
	foreach($func_items as $key => $item) {
		if(function_exists($key)){
			$func_items[$key]['current'] = '支持';
			$func_items[$key]['status'] = 1;
		}else{
			$func_items[$key]['current'] = '不支持';
			$func_items[$key]['status'] = -1;
		}
	}
	return $func_items;
}

function runquery($sql,$tablepre = '') {
	global $db;

	if(!isset($sql) || empty($sql)) return;
	$sql = str_replace("\r", "\n", str_replace(' `'.TABLEPRE, ' `'.$tablepre, $sql));
	$ret = array();
	$num = 0;
	foreach(explode(";\n", trim($sql)) as $query) {
		$ret[$num] = '';
		$queries = explode("\n", trim($query));
		foreach($queries as $query) {
			$ret[$num] .= (isset($query[0]) && $query[0] == '#') || (isset($query[1]) && isset($query[1]) && $query[0].$query[1] == '--') ? '' : $query;
		}
		$num++;
	}
	unset($sql);
	$dbver = $db->version();
	foreach($ret as $query) {
		$query = trim($query);
		if($query) {
			if(strtoupper(substr($query, 0, 12)) == 'CREATE TABLE') {
				$type = strtoupper(preg_replace("/^\s*CREATE TABLE\s+.+\s+\(.+?\).*(ENGINE|TYPE)\s*=\s*([a-z]+?).*$/isU", "\\2", $query));
	            $type = 'InnoDB';
	            $query = preg_replace("/^\s*(CREATE TABLE\s+.+\s+\(.+?\)).*$/isU", "\\1", $query).($dbver > '4.1' ? " ENGINE=$type DEFAULT CHARSET=".DBCHARSET : " TYPE=$type");
			}
			$db->query($query);
		}
	}
}

function timezone_set($timeoffset = 8) {
	if(function_exists('date_default_timezone_set')) {
		@date_default_timezone_set('Etc/GMT'.($timeoffset > 0 ? '-' : '+').(abs($timeoffset)));
	}
}


?>