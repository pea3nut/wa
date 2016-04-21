<?php
//正则表达式
define('RegExp_username'    ,'/^(\w\d{3})|(\d{5,11})$/' ,true);
define('RegExp_password'    ,'/^[\w@!#$%\^&\*\.~]{6,22}$/' ,true);
define('RegExp_uid'         ,'/^\w\d{3}$/' ,true);
define('RegExp_name'        ,'/^[\x{4e00}-\x{9fa5}]+$/u' ,true);
define('RegExp_nickname'    ,'/^[\x{4e00}-\x{9fa5}\w \@\#]+$/u' ,true);
define('RegExp_school'      ,'/^((ql)|(sk)|(sy))$/' ,true);
define('RegExp_phone'       ,'/^(\d{11}|\d{8})$/u' ,true);
define('RegExp_wechat'      ,'/^(\w{5,16})?$/' ,true);
define('RegExp_age'         ,'/^\d{2}$/' ,true);
define('RegExp_gender'      ,'/^[1|2]$/' ,true);
define('RegExp_qq'          ,'/^\d{5,11}$/' ,true);
define('RegExp_state'       ,'/^\d{3}$/' ,true);
define('RegExp_works_state' ,'/^[-1|0|1|2]$/' ,true);
define('RegExp_Number'      ,'/^\d+$/' ,true);
define('RegExp_Letter'      ,'/^\w+$/' ,true);
define('RegExp_Integer'     ,'/^\-?\d+$/' ,true);
//将errorCode数组转换成常量
//格式define('EC_[错误码]','[错误码],[错误信息]！');
$errorcode=include 'error_code.php';
foreach ($errorcode as $code => $msg){
    define("EC_{$code}", "{$code},{$msg}！");
}
//时间常量
define('Short_Date'      ,date('Y-m-d') ,true);
define('Long_Date'       ,date('Y-m-d H:i:s') ,true);
//其他常量
define('Project_Version' ,'5.0.1' ,true);
//站点URL根路径
define('URL_ROOT', dirname($_SERVER['SCRIPT_NAME']));