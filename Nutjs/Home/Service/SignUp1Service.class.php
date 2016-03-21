<?php
namespace Home\Service;
use Think\Model;
use Home\Model\UsersModel;
use Home\Model\UserInfModel;
/**
 * 用户注册第二步
 * */
class SignUp1Service{
    /**
     * 入口函数。此函数会被自动调用
     * */
    public function run(){
        //检查验证码
        if(!(APP_DEBUG && C('Not_VerifyCode'))){
            check_verify(I('post.verifycode')) or drop(EC_4841);
        };
        //校验登陆信息
        test_token() or drop(EC_4842);
        //校验是否需要登记信息
        get_state() == '100' or drop(EC_4843);
        //获取uid
        $_POST['uid']=cookie('uid');
        //尝试创建数据对象
        //user_inf表
        $uiMo=new UserInfModel();
        $uiMo->create(
            I('post.'),
            Model::MODEL_INSERT
        ) or drop($uiMo->getError());
        //users表
        $uMo=new UsersModel();
        $uMo->field('uid,state');
        $uMo->create(
            array(
                'uid'=>$_POST['uid'],
                'state'=>200
            ),
            Model::MODEL_UPDATE
        ) or drop($uMo->getError());
        //若开启Not_Submit_To_Database则不提交数据库
        if (C('Not_Submit_To_Database')) {
            var_dump($uiMo->data());
            var_dump($uMo->data());
            $uiMo->fetchSql(true);
            $uMo->fetchSql(true);
        };
        //注册信息
        $uiMo->add() or drop(EC_4861.$uiMo->getError());
        $uMo->save() or drop(EC_4862.$uMo->getError());
        //End 注册信息
        drop(true);
    }
    protected function checkInf(){
        $mo=new UsersModel();
        $mo->where(array('uid'=>$_POST)['uid']);
        if(empty($mo->find())){
            return true;
        }else{
            return false;
        };
    }
}