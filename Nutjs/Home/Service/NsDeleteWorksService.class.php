<?php
namespace Home\Service;
use Home\Model\NsWorksListModel;
/**
 * 果仁商店删除作品
 * */
class NsDeleteWorksService{
    /**
     * 入口函数。此函数会被自动调用
     * */
    public function run(){
        //过滤字段
        preg_match(RegExp_Number, I('post.works_id')) or drop(EC_4C31);
        //校验登陆信息
        test_token() or drop(EC_4C41);
        //校验是否有权限进行此操作
        $this->checkPermissions() or drop(EC_4C42);
        //删除数据库记录
        $this->rmWorksRecord(I('post.works_id'));
        //删除作品文件
        $this->rmWorksFile(I('post.works_id'));
        echo drop(true);
    }
    /**
     * 删除作品的数据库记录
     * @access protected
     * @param Int $works_id 作品ID
     * */
    protected function rmWorksRecord($works_id){
        $worksMo = new NsWorksListModel();
        $worksMo->relation(array('section','log','buy'));
        //定位修改的记录
        $worksMo->where(array('id'=>$works_id));
        //若开启Not_Submit_To_Database则不提交数据库
        if (C('Not_Submit_To_Database')) {
            var_dump($worksMo->data());
            $worksMo->fetchSql(true);
        };
        $worksMo->delete();
    }
    /**
     * 删除作品的文件
     * @access protected
     * @param Int $works_id 作品ID
     * */
    protected function rmWorksFile($works_id){
        # 删除章节
        $section_dir='./Nutjs/Home/Public/Include/NutStore/article/'.$works_id.'/';
        del_file_all($section_dir);
        //删除Banner
        unlink("./Nutjs/Home/Public/Image/NutStore/article/works-{$works_id}.jpg");
        # 删除预提交文件
        $works_ready ='./Nutjs/Upload/'.cookie('uid').'/works/'.$works_id;
        del_file_all($works_ready);
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