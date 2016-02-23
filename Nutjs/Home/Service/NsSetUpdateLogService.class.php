<?php
namespace Home\Service;
use Think\Model;
use Home\Model\UsersModel;
/**
 * 果仁商店提交作品更新日志
 * */
class NsSetUpdateLogService{
    /**
     * 入口函数。此函数会被自动调用
     * */
    public function run(){
        //校验登陆信息
        test_token() or drop(EC_4A41);
        //尝试创建数据对象
        $mo_log = new \Home\Model\NsUpdateLogModel();
        $mo_log ->create(array(
            'works_id' => I('post.works_id')

        ));

        //校验是否有权限进行此操作
        $mo ->where(array('id' => cookie('uid')));
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