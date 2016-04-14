<?php
namespace Home\Controller;
use Think\Controller;
/**
 * 会员信息操作页面
 * */
class DevelopController extends Controller {
    /**
     * 检测Markdown请求
     * */
    public function _empty(){
        //校验ACTION_NAME名
        if(preg_match('/^\w*$/', ACTION_NAME)){
            $mdFile =MODULE_PATH.'Public/Include/'.CONTROLLER_NAME.'/Markdown/'.ACTION_NAME.'.md';
            //检查是否为文件
            if(file_exists($mdFile)){
                //渲染输出Markdown文件
                $this->_data['body']=decode_markdown($mdFile);
                $this->display('_doc');
                return;
            };
        };
        //注意，一旦上文没有执行return语句，这里将会抛出一个错误
        E(L('_ERROR_ACTION_').':'.ACTION_NAME);
    }
    /*! =====特殊方法=====*/
    /**
     * 测试方法
     * */
    public function debug(){
        echo 'Home / ExploitController -> debug()';
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