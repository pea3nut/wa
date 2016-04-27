<?php
namespace Home\Controller;
use Think\Controller;
use Gregwar\Image\Image;
require './Public/Library/Repository/Image-master/autoload.php';

/**
 * 行为控制器
 * */
class BehaviorController extends Controller {
    /**
     * 响应上传行为
     * @param String $type 本次上传的标识
     * @param Mixed $data 附件的数据
     * */
    public function upload($type ,$data=''){
        # 该方法是敏感的，需要登陆Token和字段过滤
        test_token()                 or drop(false);
        preg_match('/^\w*$/', $data) or drop(false);
        # 实例化Upload类
        $upload = new \Think\Upload();
        $upload  ->rootPath = './Nutjs/Upload/';
        $upload  ->replace  = true;
        $upload  ->autoSub  = false;
        # 根据$type值执行对应操作
        switch ($type){
            case 'works_banner':
                if(empty($data)){
                    $file_name ='works-banner-submit.jpg';
                }else{
                    $file_name ="works-banner-{$data}.jpg";
                };
                $this->worksBanner($upload ,$file_name);
                break;
        }
    }
    /**
     * 作品上传Banner
     * @access protr
     * */
    protected function worksBanner($upload ,$file_name){
        # 初始化
        $upload  ->maxSize  = 2097152 ;
        $upload  ->exts     = array('jpg', 'gif', 'png', 'jpeg');
        $upload  ->savePath = cookie('uid').'/';
        # 上传文件
        $info = $upload->uploadOne($_FILES['file']);
        if(!$info) {// 上传错误提示错误信息
            drop('1201,'.$upload->getError());
        }else{// 上传成功
            $img_dir   =$upload->rootPath .$upload->savePath;
            ## 转换裁剪文件
            Image::open($img_dir.$info['savename'])
                ->forceResize(640, 360)
                ->save($img_dir.$file_name)
            ;
            ## 删除源文件
            unlink($img_dir.$info['savename']);
            # 返回信息
            $img_url   =substr($img_dir.$file_name ,1);
            echo drop('1200,'.URL_ROOT.$img_url ,true ,null ,true);
        };
    }
    /*! =====特殊方法=====*/
    /**
     * 测试方法
     * */
    public function debug(){
        echo 'Home / BehaviorController -> debug()';
    }
    public function __construct(){
        //header('Content-Type:application/json; charset=utf-8');
        parent::__construct();
    }
}