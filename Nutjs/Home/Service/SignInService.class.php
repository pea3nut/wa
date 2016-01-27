<?php
namespace Home\Service;
use Home\Model\UsersModel;
/**
 * 用户登陆操作
 * */
class SignInService{
    /**
     * 用户的协会编号
     * @var String
     * @access public
     * */
    protected $uid=null;
    /**
     * 入口函数。此函数会被自动调用
     * */
    public function run(){
        //检查验证码
        if(!(APP_DEBUG && C('Not_VerifyCode'))){
            check_verify(I('post.verifycode')) or drop(EC_4541);
        };
        //检查字段值
        preg_match(RegExp_username, I('post.username')) or drop(EC_4531);
        //检查用户名是否存在
        $this->checkUsername(I('post.username')) or drop(EC_4551);
        //检查密码是否正确
        $this->checkPassword(I('post.password')) or drop(EC_4552);
        //生成登陆信息
        log_in($this->uid);
        //返回成功
        drop(true);
    }
    /**
     * 用户名是否存在
     * @access protected
     * @param string $username 提交的用户名，有可能是协会编号或QQ
     * @return boolean
     * */
    protected function checkUsername($username){
        $mo=new UsersModel();
        $mo->where(array(
            'uid'=>$username,
            'qq'=>$username,
            '_logic'=>'OR',
        ));
        $this->uid=$mo->getField('uid');
        if(empty($this->uid)){
            return false;
        }else{
            return true;
        };
    }
    /**
     * 校验密码是否正确
     * 内置回调函数
     * @access protected
     * @param string $password 提交的密码
     * @return boolean
     * */
    protected function checkPassword($password){
        $mo=new UsersModel();
        $mo->where(array(
            'uid'=>$this->uid,
        ));
        $dbPassword=$mo->getField('password');
        $subPassword=crypt($password,$dbPassword);
        if($dbPassword != $subPassword){
            return false;
        }else{
            return true;
        }
    }
}