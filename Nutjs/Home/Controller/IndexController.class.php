<?php
namespace Home\Controller;
use Think\Controller;
/**
 * 首页控制器
 * */
class IndexController extends Controller {
    //首页
    public function index(){
        $this->success('即将跳转到开发文档页','Develop/index',3);
    }
    /*! =====特殊方法=====*/
    /**
     * 测试方法
     * */
    public function debug(){
        echo 'Home / IndexController -> debug()';
    }
}