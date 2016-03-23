<?php
namespace Home\Service;
use Think\Model;
use Home\Model\NsUpdateLogModel;
/**
 * 果仁商店创建作品
 * */
class NsCreateWorksLogService{
    /**
     * 入口函数。此函数会被自动调用
     * */
    public function run(){
        //校验登陆信息
        test_token() or drop(EC_4H41);
        //尝试创建数据对象
        $logMo = new NsUpdateLogModel();
        $logMo->field('works_id,log,date');
        $logMo ->create(
            I('post.'),
            Model::MODEL_INSERT
        ) or drop($logMo->getError());
        //检查权限
        $this->checkPermissions() or drop(EC_4H42);
        //若开启Not_Submit_To_Database则不提交数据库
        if (C('Not_Submit_To_Database')) {
            var_dump($logMo->data());
            $logMo->fetchSql(true);
        };
        //获取数据库返回值
        $insetId=$logMo->add();
        if ($insetId){
            if(C('Not_Submit_To_Database')) {//调试模式下
                echo $insetId;
            }else{//正常操作成功
                echo drop('1200,'.$insetId,true);
            };
        }else{//否则就是出错了
            drop(EC_4H51.$logMo->getError());
        }
    }
    /**
     * 检测是否是作品作者
     * @access protected
     * @return bool
     * */
    protected function checkPermissions(){
        $worksMo =new \Home\Model\NsWorksListModel();
        $worksMo ->where(array(
            'id'         =>I('post.works_id'),
            'author_uid' =>cookie('uid')
        ));
        $data =$worksMo->find();
        return !empty($data);
    }
}