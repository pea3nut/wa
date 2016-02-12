<?php
namespace Home\Controller;
use Think\Controller;
/**
 * 测试控制器
 * */
class NutStoreController extends Controller {
    public function debug(){
        echo 'Home / NutStoreController -> debug()';
    }
    public function index(){
        $this->assign('is_signin',1);
        $this->display();
    }
    public function body(){
        $md='.\Nutjs\Home\Public\Include\NutStore\article\A233\git_workflow\section-1.md';
        $this->assign('markdown',decode_markdown($md));
        $this->display();
    }
    public function __construct(){
        header("Content-type: text/html; charset=utf-8");
        parent::__construct();
    }
}