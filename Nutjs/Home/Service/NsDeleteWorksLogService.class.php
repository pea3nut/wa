<?php
namespace Home\Service;
use Home\Model\NsUpdateLogModel;
/**
 * 果仁商店修改作品信息
 * */
class NsDeleteWorksLogService{
    /**
     * 入口函数。此函数会被自动调用
     * */
    public function run(){
        //校验登陆信息
        test_token() or drop(EC_4J41);
        //校验字段
        preg_match(RegExp_Number, I('get.log_id'))   or drop(EC_4J31);
        //定位记录
        $sectionMo = new NsUpdateLogModel();
        $sectionMo->limit(1);
        $sectionMo->where(array(
            'id'   =>I('get.log_id')
        ));
        //校验是否有权限进行此操作
        $this->checkPermissions() or drop(EC_4J42);
        //若开启Not_Submit_To_Database则不提交数据库
        if (C('Not_Submit_To_Database')) {
            $sectionMo->fetchSql(true);
        };
        //写入数据库
        ($sql=$sectionMo->delete())    or drop(EC_4J51.$sectionMo->getError());
        //若开启Not_Submit_To_Database则不提交数据库
        if (C('Not_Submit_To_Database')) {
            echo $sql;
        };
        drop(true);
    }
    /**
     * 检测是否是作品作者
     * @access protected
     * @return bool
     * */
    protected function checkPermissions(){
        //通过log_id获得works_id
        $logMo =new \Home\Model\NsUpdateLogModel();
        $logMo ->where(array(
            'id'         =>I('get.log_id'),
        ));
        $worksId =$logMo->getField('works_id');
        $worksId or drop(EC_4J43);
        //通过works_id查找
        $worksMo =new \Home\Model\NsWorksListModel();
        $worksMo ->where(array(
            'id'         =>$worksId,
            'author_uid' =>cookie('uid')
        ));
        $data =$worksMo->find();
        return !empty($data);
    }
}