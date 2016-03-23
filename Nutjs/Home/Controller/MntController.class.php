<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;
/**
 * 测试控制器
 * */
class MntController extends Controller {
    public function debug(){
        echo 'debug';
    }
    public function __construct(){
        header("Content-type: text/html; charset=utf-8");
        parent::__construct();
    }
}