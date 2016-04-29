<?php
namespace Home\Service;
use Think\Model;
use Home\Model\NsSectionModel;
/**
 * 果仁商店修改作品信息
 * */
class NsEditSectionService{
    /**
     * 入口函数。此函数会被自动调用
     * */
    public function run(){
        //校验登陆信息
        test_token() or drop(EC_4E41);
        //尝试创建数据对象
        $sectionMo = new NsSectionModel();
        $sectionMo->field('works_id,section_id,section_name');
        $sectionMo ->create(
            I('post.'),
            Model::MODEL_UPDATE
        ) or drop($sectionMo->getError());
        //定位修改的记录
        $sectionMo->where(array(
            'id'   =>I('post.id'),
        ));
        //校验是否有权限进行此操作
        $this->checkPermissions() or drop(EC_4E42);
        //若开启Not_Submit_To_Database则不提交数据库
        if (C('Not_Submit_To_Database')) {
            var_dump($sectionMo->data());
            $sectionMo->fetchSql(true);
        };
        //写入数据库
        $sectionMo->save()    or drop(EC_4E51.$sectionMo->getError());
        drop(true);
    }
    /**
     * 检测是否是作品作者
     * @access protected
     * @return bool
     * */
    protected function checkPermissions(){
        $mo =new \Home\Model\NsSectionModel();
        $mo->relation('works');
        $mo ->where(array(
            'id'   =>I('post.id'),
        ));
        $data =$mo->find();
        return ($data['works']['author_uid'] ==cookie('uid'));
    }
}