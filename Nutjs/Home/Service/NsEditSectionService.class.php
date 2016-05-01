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
        ($sectionMo->save() !==false)    or drop(EC_4E51.$sectionMo->getError());
        # 移动章节md文件
        ## 通过section的记录ID获取原section_id和works_id
        $works_id_old=$section_id_old='';
        $this->analysisId(I('post.id') ,$works_id_old ,$section_id_old);
        ## 判断是否指派了新的section_id和works_id
        if(isset($_POST['section_id'])){
            $section_id_new=I('post.section_id');
        }else{
            $section_id_new =$section_id_old;
        };
        if(isset($_POST['works_id'])){
            $works_id_new=I('post.works_id');
        }else{
            $works_id_new =$works_id_old;
        };
        ## 移动成新的md文件
        $section_path ='./Nutjs/Upload/'.cookie('uid')."/works/$works_id_old/section/$section_id_old/section.md";
        if(file_exists($section_path)){
            $new_path="./Nutjs/Home/Public/Include/NutStore/article/{$works_id_new}/section-{$section_id_new}.md";
            rename($section_path, $new_path);
            unlink($section_path);
        };
        drop(true);
    }
    /**
     * 通过章节的记录ID，获取对应的作品和章节ID
     * @param Int $id 章节记录ID
     * @param &$works_id 将返回的作品ID
     * @param &$section_id 将返回的章节ID
     * */
    protected function analysisId($id ,&$works_id ,&$section_id){
        $sectionMo = new NsSectionModel();
        $sectionMo->where(array(
            'id'   =>I('post.id'),
        ));
        $data =$sectionMo->find();

        $works_id   =$data['works_id'];
        $section_id =$data['section_id'];
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