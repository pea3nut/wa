<?php
namespace Home\Controller;
use Think\Controller;
use Home\ViewData\ListViewData;

/**
 * 测试控制器
 * */
class MntController extends Controller {
    /*! =====特殊方法=====*/
    /**
     * 测试方法
     * */
    public function debug(){
        echo 'Home / MntController -> debug()';
    }
    public function __construct(){
        header("Content-type: text/html; charset=utf-8");
        parent::__construct();
    }
}