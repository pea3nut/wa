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
    //表单提交时无需验证verifycode，此配置还要求开启调试模式的情况下才可生效
    'Not_VerifyCode' => false,
    //模板文件名后缀
    'TMPL_TEMPLATE_SUFFIX'=>'.tpl',
    //定义路径模式
    'URL_MODEL'=>2,
    //注册会员批次
    'WEB_BATCH' => 'D',
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
//        '' => '',
    ),
);