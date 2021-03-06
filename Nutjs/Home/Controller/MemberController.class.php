<?php
namespace Home\Controller;
use Think\Controller;
/**
 * 会员信息操作页面
 * */
class MemberController extends Controller {
    //会员登录页面
    public function sign_in(){
        $this->display();
    }
    //会员注册第一步
    public function sign_up_0(){
        $this->display();
    }
    //会员注册第二步
    public function sign_up_1(){
        test_control_login();
        $this->display();
    }
    //修改密码页面
    public function change_password(){
        test_control_login();
        $this->display();
    }
    //退出登录
    public function sign_out(){
        $se =new \Home\Service\SignOutService();
        $se ->run(false);
        $this->success("退出登录成功");
    }
    /*! =====特殊方法=====*/
    /**
     * 测试方法
     * */
    public function debug(){
        echo 'Home / MemberController -> debug()';
    }
}