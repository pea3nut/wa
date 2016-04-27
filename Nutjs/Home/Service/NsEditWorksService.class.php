<?php
namespace Home\Service;
use Think\Model;
use Home\Model\NsWorksListModel;
/**
 * 果仁商店修改作品信息
 * */
class NsEditWorksService{
    /**
     * 入口函数。此函数会被自动调用
     * */
    public function run(){
        //校验登陆信息
        test_token() or drop(EC_4B41);
        //尝试创建数据对象
        $worksMo = new NsWorksListModel();
        $worksMo->field('id,works_name,works_intro,works_state,price');
        $worksMo ->create(
            array_merge(
                I('post.'),
                array(
                    'id'         =>I('post.works_id'),
                )
            ),
            Model::MODEL_UPDATE
        ) or drop($worksMo->getError());
        //校验是否有权限进行此操作
        $this->checkPermissions() or drop(EC_4B42);
        //定位修改的记录
        $worksMo->where(array('id'=>I('post.works_id')));
        //若开启Not_Submit_To_Database则不提交数据库
        if (C('Not_Submit_To_Database')) {
            var_dump($worksMo->data());
            $worksMo->fetchSql(true);
        };
        //写入数据库
        $worksMo->save()    or drop(EC_4B51.$worksMo->getError());
        //移动Banner
        $banner_path ='./Nutjs/Upload/'.cookie('uid').'/works-banner-'.I('post.works_id').'.jpg';
        if(file_exists($banner_path)){
            rename($banner_path, './Nutjs/Home/Public/Image/NutStore/article/works-'.I('post.works_id').'.jpg');
            unlink($banner_path);
        };
        drop(true);
    }
    /**
     * 检测是否是作品作者
     * @access protected
     * @return bool
     * */
    protected function checkPermissions(){
        $mo =new NsWorksListModel();
        $mo ->where(array(
            'id'         =>I('post.works_id'),
            'author_uid' =>cookie('uid')
        ));
        $data =$mo->find();
        return !empty($data);
    }
}