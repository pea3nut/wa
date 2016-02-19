<?php
namespace Home\Controller;
use Think\Controller;
/**
 * 果仁商店控制器
 * */
class NutStoreController extends Controller {
    public function debug(){
        echo 'Home / NutStoreController -> debug()';
    }
    public function index(){
        //将作品信息送入模板
        $mo_list = new \Home\Model\NsWorksListModel();
        $list_data =$mo_list->select();
        $this->assign('works_inf',$list_data);
        //获取统计字段
        $mo_buy = new \Home\Model\NsBuyModel();
        $mo_buy->group('works_id');
        $buy_data =$mo_buy->getField('works_id ,avg(score) as avg_score ,count(uid) as buy_number');
        //送入模板
        $this->assign('works_statistic',$buy_data);

        $this->assign('is_signin',1);
        $this->display();
    }
    public function courses($id){
        if(preg_match('/^\d+$/', $id)){
            //作品信息
            $mo_works =new \Home\Model\NsWorksListModel();
            $mo_works ->where(array('id'=>$id));
            $works_data =$mo_works->find();
            //获取统计字段
            $mo_buy =new \Home\Model\NsBuyModel();
            $mo_buy ->where(array('works_id'=>$id));
            $mo_buy ->field('avg(score) as avg_score ,count(uid) as buy_number');
            $buy_data =$mo_buy->find();
            //合并信息
            $works_inf =array_merge($works_data ,$buy_data);
            //获取课程序言路径
            $path = "./Nutjs/Home/Public/Include/NutStore/article/{$works_inf['author_uid']}/{$works_inf['id']}/section-0.md";
            //获取Markdown文件 渲染赋值
            $courses_preface ='';
            if(file_exists($path)){
                $markdown =file_get_contents($path);
                include './Public/Library/Michelf/Markdown.inc.php';
                $courses_preface = \Michelf\Markdown::defaultTransform($markdown);
            }
            //作者信息
            $mo_author =new \Home\Model\UserInfModel();
            $mo_author ->where(array('uid' =>$works_inf['author_uid']));
            $author_data =$mo_author ->find();
        }
        //模板赋值
        $this->assign('author',$author_data);
        $this->assign('works_inf',$works_inf);
        $this->assign('courses_preface',$courses_preface);
        //输出
        $this->display();
    }
    public function body(){
        $md='.\Nutjs\Home\Public\Include\NutStore\article\A233\git_workflow\section-1.md';
        $this->assign('markdown',decode_markdown($md));
        $this->display();
    }
    public function __construct(){
        header("Content-type: text/html; charset=utf-8");
        parent::__construct();
    }
}