<?php
namespace Home\Service;
use Think\Model;
use Home\Model\NsWorksListModel;
/**
 * 果仁商店创建作品
 * */
class NsCreateWorksService{
    /**
     * 入口函数。此函数会被自动调用
     * */
    public function run(){
        //校验登陆信息
        test_token() or drop(EC_4A41);
        //尝试创建数据对象
        $worksMo = new NsWorksListModel();
        $worksMo->field('author_uid,works_name,works_intro,price');
        $worksMo ->create(
            array_merge(
                I('post.'),
                array(
                    'author_uid' =>cookie('uid'),
                )
            ),
            Model::MODEL_INSERT
        ) or drop($worksMo->getError());
        //若开启Not_Submit_To_Database则不提交数据库
        if (C('Not_Submit_To_Database')) {
            var_dump($worksMo->data());
            $worksMo->fetchSql(true);
        };
        //获取数据库返回值
        $insetId=$worksMo->add();
        if ($insetId){
            if(C('Not_Submit_To_Database')) {//调试模式下
                echo $insetId;
            }else{//正常操作成功
                echo drop('1200,'.$insetId,true);
            };
        }else{//否则就是出错了
            drop(EC_4A51.$worksMo->getError());
        }
        //移动Banner
        $banner_path ='./Nutjs/Upload/'.cookie('uid').'/works/auto/inf/banner.jpg';
        if(file_exists($banner_path)){
            rename($banner_path, './Nutjs/Home/Public/Image/NutStore/article/works-'.$insetId.'.jpg');
            unlink($banner_path);
        };
    }
}