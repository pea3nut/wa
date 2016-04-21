<?php
namespace Home\Controller;
use Think\Controller;

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
    /**
     * 检测数据库是否能连通
     * */
    public function test_db(){
        $mo =new \Home\Model\UsersModel();
        $mo ->select();
        if($mo->getError()){
            echo $mo->getError();
        }else{
            echo '数据库连接成功';
        };
    }
    public function __construct(){
        header("Content-type: text/html; charset=utf-8");
        parent::__construct();
    }
}