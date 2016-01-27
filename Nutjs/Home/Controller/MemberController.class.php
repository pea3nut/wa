<?php
namespace Home\Controller;
use Think\Controller;
/**
 * 会员操作控制器
 * */
class MemberController extends Controller {
    public function index(){
        $this->display('sign_in');
    }
    public function debug(){
        echo 'Home / MemberController -> debug()';
    }
}