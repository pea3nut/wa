<?php
namespace Home\Service;
use Think\Model;
use Home\Model\UsersModel;
/**
 * 用户修改密码操作
 * */
class ChangePasswordService{
    /**
     * 入口函数。此函数会被自动调用
     * */
    public function run(){
        //检查验证码
        if(!(APP_DEBUG && C('Not_VerifyCode'))){
            check_verify(I('post.verifycode')) or drop(EC_4341);
        };
        //校验登陆信息
        test_token() or drop(EC_4342);
        //尝试创建数据对象
        $mo=new UsersModel();
        $mo->field('uid,password');
        $mo->create(
            array('uid'=>cookie('uid'),'password'=>I('post.password'))
            ,Model::MODEL_UPDATE
        ) or drop($mo->getError());
        //检测字段值
        if(I('post.password') != I('post.re_password')) drop(EC_4343);
        //写入数据
        $mo->save() or drop(EC_4351.$mo->getError());
        //执行登出操作
        R('Service/_empty','action=SignOut') or drop(EC_4361);
    }
}