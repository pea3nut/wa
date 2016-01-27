<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用入口文件

// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');
// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',True);
// 定义应用目录
define('APP_PATH','./Nutjs/');
// 定义自动生成的安全文件
define('DIR_SECURE_FILENAME', 'default.html');
define('DIR_SECURE_CONTENT', 'Dir!');
//生成控制器
define('BUILD_CONTROLLER_LIST','Index,User,Mnt');
//默认将此文件绑定Home模块
define('BIND_MODULE','Home');
//引入常量文件
$define_file=APP_PATH.BIND_MODULE.'/Common/define.php';
if(file_exists($define_file)) require $define_file;
// 引入ThinkPHP入口文件
require './ThinkPHP/ThinkPHP.php';