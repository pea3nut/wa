<?php
namespace Home\Service;
use Home\Model\NsSectionModel;
/**
 * 果仁商店修改作品信息
 * */
class NsDeleteSectionService{
    /**
     * 入口函数。此函数会被自动调用
     * */
    public function run(){
        //校验登陆信息
        test_token() or drop(EC_4E41);
        //校验字段
        preg_match(RegExp_Number, I('post.works_id'))   or drop(EC_4F31);
        preg_match(RegExp_Number, I('post.section_id')) or drop(EC_4F32);
        //尝试创建数据对象
        $sectionMo = new NsSectionModel();
        $sectionMo->limit(1);
        $sectionMo->where(array(
            'works_id'   =>I('post.works_id'),
            'section_id' =>I('post.section_id')
        ));
        //校验是否有权限进行此操作
        $this->checkPermissions() or drop(EC_4F42);
        //若开启Not_Submit_To_Database则不提交数据库
        if (C('Not_Submit_To_Database')) {
            $sectionMo->fetchSql(true);
        };
        //写入数据库
        ($sql=$sectionMo->delete())    or drop(EC_4F51.$sectionMo->getError());
        //若开启Not_Submit_To_Database则不提交数据库
        if (C('Not_Submit_To_Database')) {
            echo $sql;
        };
        //删除章节对应的Markdown
        $section_path='./Nutjs/Home/Public/Include/NutStore/article/'.I('post.works_id').'/section-'.I('post.section_id').'.md';
        unlink($section_path);
        drop(true);
    }
    /**
     * 检测是否是作品作者
     * @access protected
     * @return bool
     * */
    protected function checkPermissions(){
        $mo =new \Home\Model\NsWorksListModel();
        $mo ->where(array(
            'id'         =>I('post.works_id'),
            'author_uid' =>cookie('uid')
        ));
        $data =$mo->find();
        return !empty($data);
    }
}