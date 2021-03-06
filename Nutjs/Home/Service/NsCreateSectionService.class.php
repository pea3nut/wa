<?php
namespace Home\Service;
use Think\Model;
use Home\Model\NsSectionModel;
/**
 * 果仁商店创建作品
 * */
class NsCreateSectionService{
    /**
     * 入口函数。此函数会被自动调用
     * */
    public function run(){
        //校验登陆信息
        test_token() or drop(EC_4D41);
        //尝试创建数据对象
        $sectionMo = new NsSectionModel();
        $sectionMo->field('works_id,section_id,section_name');
        $sectionMo ->create(
            I('post.'),
            Model::MODEL_INSERT
        ) or drop($sectionMo->getError());
        //校验是否有权限进行此操作
        $this->checkPermissions() or drop(EC_4D42);
        //若开启Not_Submit_To_Database则不提交数据库
        if (C('Not_Submit_To_Database')) {
            var_dump($sectionMo->submit);
            var_dump($sectionMo->data());
            $sectionMo->fetchSql(true);
        };
        //获取数据库返回值
        $id =$sectionMo->add() or drop(EC_4D52);
        //移动章节md文件
        $section_id =(I('post.section_id') === '') ?'auto' :I('post.section_id');
        $section_path ='./Nutjs/Upload/'.cookie('uid').'/works/'.I('post.works_id').'/section/'.$section_id.'/section.md';
        $real_section_path ='';
        if(file_exists($section_path)){
            $real_section_path ='./Nutjs/Home/Public/Include/NutStore/article/'.I('post.works_id')."/section-{$sectionMo->section_id}.md";
            rename($section_path, $real_section_path);
        };
        echo drop(true ,true ,array(
            'id'         =>$id,
            'section_id' =>$sectionMo->section_id,
            'has-md'     =>toURL($real_section_path),
        ));
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