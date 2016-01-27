<?php
namespace Home\Controller;
use Think\Controller;
/**
 * 首页控制器
 * */
class IndexController extends Controller {
    public function index(){
        $this->success('即将跳转到开发文档页','Exploit/index',3);
        //$this->display('Index/welcome');
    }
    public function welcome(){
        $this->display();
    }
}