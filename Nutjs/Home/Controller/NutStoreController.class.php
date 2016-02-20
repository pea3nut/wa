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
    public function courses($courses_id){
        if( !preg_match('/^\d+$/', $courses_id))exit('E');
        //#作品信息
        $mo_works =new \Home\Model\NsWorksListModel();
        $mo_works ->where(array('id'=>$courses_id));
        $works_data =$mo_works->find();
        //获取统计字段
        $mo_buy =new \Home\Model\NsBuyModel();
        $mo_buy ->where(array('works_id'=>$courses_id));
        $mo_buy ->field('avg(score) as avg_score ,count(uid) as buy_number');
        $buy_data =$mo_buy->find();
        //#合并信息
        $works_inf =array_merge($works_data ,$buy_data);
        //获取课程序言路径
        $path = "./Nutjs/Home/Public/Include/NutStore/article/{$works_inf['author_uid']}/section-0.md";
        //获取Markdown文件 渲染赋值
        $courses_preface ='';
        if(file_exists($path)){
            $markdown =file_get_contents($path);
            include './Public/Library/Michelf/Markdown.inc.php';
            $courses_preface = \Michelf\Markdown::defaultTransform($markdown);
        }
        //#作者信息
        $mo_author =new \Home\Model\UserInfModel();
        $mo_author ->where(array('uid' =>$works_inf['author_uid']));
        $author_data =$mo_author ->find();
        //#课程列表
        $mo_section =new \Home\Model\NsSectionModel();
        $mo_section ->where(array('works_id' =>$courses_id));
        $mo_section ->order('section_id');
        $section_data =$mo_section->select();
        //模板赋值
        $this->assign('author',$author_data);
        $this->assign('works_inf',$works_inf);
        $this->assign('courses_preface',$courses_preface);
        $this->assign('section_list',$section_data);
        //输出
        $this->display();
    }
    public function body($courses_id ,$section_id){
        if( !( preg_match('/^\d+$/', $courses_id) && preg_match('/^\d+$/', $section_id) ))exit('E');
        $md="./Nutjs/Home/Public/Include/NutStore/article/{$courses_id}/section-{$section_id}.md";
        $this->assign('markdown',decode_markdown($md));
        $this->display();
    }
    public function edit($courses_id){
        if( !preg_match('/^\d+$/', $courses_id))exit('E');
        //#作品信息
        $mo_works =new \Home\Model\NsWorksListModel();
        $mo_works ->where(array('id'=>$courses_id));
        $works_data =$mo_works->find();
        //#课程列表
        $mo_section =new \Home\Model\NsSectionModel();
        $mo_section ->where(array('works_id' =>$courses_id));
        $mo_section ->order('section_id');
        $section_data =$mo_section->select();
        //模板赋值
        $this->assign('section_list',$section_data);
        $this->assign('works_inf',$works_data);
        //输出
        $this->display();
    }
    public function person(){
        test_token() or exit('E');
        //#投稿信息
        $mo_works =new \Home\Model\NsWorksListModel();
        $mo_works ->where(array('author_uid'=>cookie('uid')));
        $works_data =$mo_works->select();
        //#购买信息
        $mo_buy =new \Home\Model\NsBuyModel();
        $mo_buy ->where(array('uid'=>cookie('uid')));
        $buy_data =$mo_buy->select();
        //模板赋值
        $this->assign('buy_data',$buy_data);
        $this->assign('submit_data',$works_data);
        //输出
        $this->display();
    }
    public function __construct(){
        header("Content-type: text/html; charset=utf-8");
        parent::__construct();
    }
}