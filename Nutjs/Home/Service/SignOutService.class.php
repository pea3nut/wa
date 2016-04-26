<?php
namespace Home\Service;
/**
 * 用户退出登录操作
 * */
class SignOutService{
    /**
     * 入口函数。此函数会被自动调用
     * */
    public function run($ajax=true){
        //更新令牌
        if(test_token()) log_in(cookie('uid'));
        //销毁cookie
        cookie(null);
        //返回信息
        if($ajax)echo drop('1200,退出登录成功',true);
    }
}