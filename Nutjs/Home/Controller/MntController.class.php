<?php
namespace Home\Controller;
use Think\Controller;
/**
 * 测试控制器
 * */
class MntController extends Controller {
    public function debug(){
        echo 'Home / MntController -> debug()';
    }
    public function __construct(){
        header("Content-type: text/html; charset=utf-8");
        parent::__construct();
    }

}