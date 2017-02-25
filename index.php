<?php
// +----------------------------------------------------------------------
// | @Version: 2016-12-9 17:08:54 @Author: 画中浅笑
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: huazhongsmile <javahanmr@163.com>
// +----------------------------------------------------------------------
// 应用入口文件
// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('PHP版本要求 PHP > 5.3.0 !');
// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',true);
//定义模块
define('BIND_MODULE', 'Home');
//当前模板
define('Template', '');
// 定义应用目录
define('APP_PATH','./Application/');
//定义网站根目录
define('__WEBROOT__', 'http://192.168.1.107/smile/');
define('__PUBLIC__', 'http://127.0.0.1/smile/Public');
//程序安装 判定
if(is_dir("install") && !file_exists("install/install.ok")){
    header("Location:install/index.php");
    exit();
}
// 引入ThinkPHP入口文件
require './ThinkPHP/ThinkPHP.php';
//// 亲^_^ 后面不需要任何代码了 就是如此简单