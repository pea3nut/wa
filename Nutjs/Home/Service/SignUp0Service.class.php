<?php
namespace Home\Service;
use Think\Model;
use Home\Model\UsersModel;
use Home\Model\InviteCodeModel;
/**
 * 用户注册第一步
 * */
class SignUp0Service{
    /**
     * 入口函数。此函数会被自动调用
     * */
    public function run(){
        //检查验证码
        if(!(APP_DEBUG && C('Not_VerifyCode'))){
           check_verify(I('post.verifycode')) or drop(EC_4741);
        };
        //尝试创建数据对象
        //users表
        $usersMo=new UsersModel();
        $usersMo->field('qq,password');
        $usersMo->create(
            I('post.'),
            Model::MODEL_INSERT
        ) or drop($usersMo->getError());
        //invite_code表
        $icMo=new InviteCodeModel();
        $icMo->field('uid,invite_code');
        $icMo->create(
            array(
                'invite_code'=>I('post.invite_code'),
                'uid'=>$usersMo->getUid(),
            ),
            Model::MODEL_INSERT
        ) or drop($icMo->getError());
        //数据检查
        if(I('post.password') != I('post.re_password'))           drop(EC_4742);
        $this->checkInviteCode_0( I('post.invite_code'))    or drop(EC_4751);
        $this->checkInviteCode_1( I('post.invite_code'))    or drop(EC_4752);
        //注册信息
        $usersMo->add()    or drop(EC_4761);
        $icMo->save()    or drop(EC_4762);;
        //生成登陆信息
        log_in($usersMo->getUid());
        //返回成功信息
        echo drop('1200,'.$usersMo->getUid(),true);
    }
    /**
     * 检查该QQ是否已被注册
     * @param string qq 用户提交的qq字段
     * @access protected
     * */
    protected function checkQq($qq){
        $mo=new UsersModel();
        if(empty($mo->where(array('qq'=>$qq))->find())){
            return true;
        }else{
            return false;
        };
    }
    /**
     * 校验邀请码是否存在
     * @param string invite_code 用户提交的邀请码
     * @access protected
     * */
    protected function checkInviteCode_0($invite_code){
        $mo=new InviteCodeModel();
        if(empty($mo->where(array('invite_code'=>$invite_code))->find())){
            return false;
        }else{
            return true;
        };
    }
    /**
     * 校验邀请码是否已被使用
     * @param string invite_code 用户提交的邀请码
     * @access protected
     * */
    protected function checkInviteCode_1($invite_code){
        $mo=new InviteCodeModel();
        if(empty($mo->where(array('invite_code'=>$invite_code))->field('uid')->find()['uid'])){
            return true;
        }else{
            return false;
        };
    }
}