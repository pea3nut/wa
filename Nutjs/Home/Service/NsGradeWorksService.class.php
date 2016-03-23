<?php
namespace Home\Service;
use Think\Model;
use Home\Model\NsBuyModel;
/**
 * 果仁商店已购买作品打分操作
 * */
class NsGradeWorksService{
    /**
     * 入口函数。此函数会被自动调用
     * */
    public function run(){
        //校验登陆信息
        test_token() or drop(EC_4K41);
        //尝试创建购买记录数据对象
        $buyMo =new NsBuyModel();
        $buyMo ->create(
            array(
                'id'      =>I('post.buy_id'),
                'score'   =>I('post.score'),
            ),
            Model::MODEL_UPDATE
        ) or drop($buyMo->getError());
        var_dump($buyMo->data());
        //定位修改记录
        $buyMo ->where(array('id'=>I('post.buy_id')));
        //校验是否有权限进行此操作
        $this->checkPermissions() or drop(EC_4K42);
        //若开启Not_Submit_To_Database则不提交数据库
        if (C('Not_Submit_To_Database')) {
            var_dump($buyMo->data());
            $buyMo->fetchSql(true);
        };
        //写入数据库
        $buyMo->save()    or drop(EC_4K51.$buyMo->getError());
        drop(true);
    }
    /**
     * 检测是否是作品作者
     * @access protected
     * @return bool
     * */
    protected function checkPermissions(){
        $mo =new NsBuyModel();
        $mo ->where(array(
            'id'    =>I('post.buy_id'),
            'uid'   =>cookie('uid')
        ));
        $data =$mo->find();
        return !empty($data);
    }
}