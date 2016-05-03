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
     * 删除文件行为
     * */
    public function delete($type){
        # 该方法是敏感的，需要登陆Token和字段过滤
        test_token()                 or drop(false);
        # 白名单行为
        switch ($type){
            case 'works_banner':
                $works_id =(int)I('post.works_id');
                if(!empty($works_id)){
                    unlink('./Nutjs/Upload/'.cookie('uid')."/works/{$works_id}/inf/banner.jpg");
                    echo drop(true);
                }else{
                    drop(false);
                };
                break;
            case 'works_section':
                $works_id =(int)I('post.works_id');
                $section_id =(int)I('post.section_id');
                if(!empty($works_id) && (!empty($section_id) || I('post.section_id') ==='0')){
                    unlink('./Nutjs/Upload/'.cookie('uid')."/works/{$works_id}/section/{$section_id}/section.md");
                    echo drop(true);
                }else{
                    drop(false);
                };
                break;
            default:
                drop(false);
                break;
        };
    }
    /**
     * 响应上传行为
     * @param String $type 本次上传的标识
     * @param Mixed $data 附件的数据
     * */
    public function upload($type ,$data=''){sleep(1);
        # 该方法是敏感的，需要登陆Token和字段过滤
        test_token()                 or drop(false);
        preg_match('/^[\w,]*$/', $data) or drop(false);
        # 实例化Upload类
        $upload = new \Think\Upload();
        $upload  ->rootPath = './Nutjs/Upload/';
        $upload  ->replace  = true;
        $upload  ->autoSub  = false;
        # 根据$type值执行对应操作
        switch ($type){
            case 'works_banner':
                $works_id =(int)I('post.works_id');
                if(empty($works_id)){
                    $upload  ->savePath = cookie('uid').'/works/auto/inf/';
                }else{
                    $upload  ->savePath = cookie('uid')."/works/{$works_id}/inf/";
                };
                $this->worksBanner($upload);
                break;
            case 'works_section':
                $works_id =(int)I('post.works_id');
                $section_id =(int)I('post.section_id');
                if(empty($section_id) && I('post.section_id') !=='0'){
                    $upload  ->savePath = cookie('uid')."/works/{$works_id}/section/auto/";
                }else{
                    $upload  ->savePath = cookie('uid')."/works/{$works_id}/section/{$section_id}/";
                };
                $this->worksSection($upload);
                break;
            default:
                drop(false);
                break;
        }
    }
    /**
     * 作品上传Banner
     * @param $upload Upload对象
     * @access protected
     * */
    protected function worksBanner($upload){
        # 初始化
        $file_name ='banner.jpg';
        $upload  ->maxSize  = 2097152 ;
        $upload  ->exts     = array('jpg', 'gif', 'png', 'jpeg');
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
            $img_url   =toURL($img_dir.$file_name);
            echo drop('1200,'.$img_url ,true ,null ,true);
        };
    }
    /**
     * 作品上传章节
     * @param $upload Upload对象
     * @access protected
     * */
    protected function worksSection($upload){
        # 初始化
        $upload  ->maxSize  = 102400 ;
        $upload  ->exts     = array('md');
        $upload  ->saveName = 'section';
        # 上传文件
        $info = $upload->uploadOne($_FILES['file']);
        if(!$info) {// 上传错误提示错误信息
            drop('1201,'.$upload->getError());
        }else{// 上传成功
            $md_url   =$upload->rootPath .$upload->savePath .$info['savename'];
            $md_url   =toURL($md_url);
            echo drop('1200,'.$md_url ,true ,null ,true);
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