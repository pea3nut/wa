<?php
return array(
    //数据库信息
    'DB_TYPE'=>'mysql', //数据库类型
    'DB_HOST'=>'localhost', //服务器地址
    'DB_NAME'=>'web_association', //数据库名
    'DB_USER'=>'root', //用户名
    'DB_PWD'=>'', //密码
    'DB_PORT'=>3306, //端口
    'DB_PREFIX'=>'wa_', //数据库表前缀
    'db_charset' => 'utf8',//数据库字符集
    //链接参数
    'DB_PARAMS' => array(
        //不将number字段强制转换成string
        PDO::ATTR_EMULATE_PREPARES => false,
    ),
    //表单提交时无需验证verifycode，此配置还要求开启调试模式的情况下才可生效
    'Not_VerifyCode' => true,
    //不对页面进行权限验证
    'Not_Control_Page'=>true,
    //请求Service时，不提交到服务器，而是打印出数据对象
    'Not_Submit_To_Database' =>false,
    //模板文件名后缀
    'TMPL_TEMPLATE_SUFFIX'=>'.tpl',
    //定义路径模式
    'URL_MODEL'=>2,
    //注册会员批次
    'WEB_BATCH' => 'D',
    //新注册会员的果仁数
    'INIT_NUTS' => 0,
    //Cookie前缀
    'COOKIE_PREFIX'=>'wa_',
    //Cookie过期时间
    'COOKIE_EXPIRE'=>3600,
    //支持所有后缀名
    'URL_HTML_SUFFIX'=>'',
    //开启路由
    'URL_ROUTER_ON' => true,
    //定义路由规则
    'URL_ROUTE_RULES'=>array(
        'NutStore/index'    => 'NutStore/works_list',
        '/NutStore\/?$/'          => 'NutStore/works_list',
    ),
    //关闭多模块访问，使用单模块设计
    'MULTI_MODULE' => false,
    'DEFAULT_MODULE' => 'Home',
    //开启参数绑定
    'URL_PARAMS_BIND_TYPE' => 1,
    //域名部署
    'APP_SUB_DOMAIN_DEPLOY' => 1,
    'APP_SUB_DOMAIN_RULES' => array(
        'service'   => 'Home/Service',
        'nutjs.org' => 'Exploit',
    ),
    //开启Model字段映射
    'READ_DATA_MAP'=>true,
    //页面调试工具
    'SHOW_PAGE_TRACE' =>true,

    'LOG_RECORD' => true, // 开启日志记录
    'LOG_LEVEL' =>'EMERG,ALERT,CRIT,ERR', // 只记录EMERG ALERT CRIT ERR 错误
);