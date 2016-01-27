<?php
namespace Home\Controller;
use Think\Controller;
/**
 * 响应用户请求Service层的动作
 * 一般来说调用此控制器意味着请求Service层
 * */
class ServiceController extends Controller {
    /**
     * 生成输出验证码
     * @access public
     * */
    public function verifycode($config=''){
        //读取参数
        if (empty($config)){
            $config=array(
                'imageW'    => '70px',
                'imageH'    => '30px',
                'fontSize'    => '15',
                'useNoise'    => false,
                'length'    => '3'
            );
        };
        //生成输出验证码
        $Verify = new \Think\Verify($config);
        $Verify->entry();
    }
    /**
     * 调用用户请求的Service类
     * @access public
     * @param string $action 用户请求的动作名，首字母可大写(推荐)也可不大写
     * */
    public function _empty($action){
        //过滤非法字符
        if(!preg_match('/^\w+$/', $action)) exit('action!');
        //替换下划线
        $action=ucfirst(preg_replace_callback('/_[\w]/', function ($arr){
            return strtoupper(substr($arr[0],1));
        }, $action));
        //生成类路径
        $action="\\Home\\Service\\{$action}Service";
        //记录日志
        trace($action,'执行方法');
        //实例化
        $serviceObj=new $action();
        //检查并执行run方法
        if(method_exists($serviceObj,'run')){
            $serviceObj->run();
        };
    }
    /**
     * 架构函数 取得模板对象实例
     * @access public
     */
    public function __construct(){
        //关闭页面调试工具（trace）
        C('SHOW_PAGE_TRACE',false);
        parent::__construct();
    }
}