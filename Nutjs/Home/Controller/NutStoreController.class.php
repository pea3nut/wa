<?php
namespace Home\Controller;
use Think\Controller;
/**
 * 果仁商店页面
 * */
class NutStoreController extends Controller {
    public function index(){
        //将作品信息送入模板
        $mo_list = new \Home\Model\NsWorksListModel();
        $list_data =$mo_list->select();
        //获取统计字段
        $mo_buy = new \Home\Model\NsBuyModel();
        $mo_buy->group('works_id');
        $buy_data =$mo_buy->getField('works_id ,avg(score) as avg_score ,count(uid) as buy_number');
        //送入模板
        $this->assign('works_inf',$list_data);
        $this->assign('works_statistic',$buy_data);
        $this->display();
    }
    public function courses($courses_id){
        if( !preg_match('/^\d+$/', $courses_id))exit('E');
        //#作品信息
        $data =array();
        $mo_works =new \Home\Model\NsWorksListModel();
        $mo_works ->where(array('id'=>$courses_id));
        $mo_works ->relation(true);
        $data =$mo_works->find();
        //#作品平均分
        $avg_score =0;
        $mo_buy=new \Home\Model\NsBuyModel();
        $mo_buy ->where(array('work_id'=>$courses_id));
        $mo_buy ->field('avg(score) as avg_score');
        $avg_score =$mo_buy ->find()['avg_score'] /2;
        $avg_score =number_format($avg_score,2);
        //#作者投稿课程数量
        $mo_sl =new \Home\Model\NsWorksListModel();
        $mo_sl ->where(array('author_uid'=>$data['author_uid']));
        $submit_count =$mo_sl ->count();
        //#渲染课程序言markdown文件
        $courses_preface ='';
        //##获取课程序言路径
        $path = "./Nutjs/Home/Public/Include/NutStore/article/{$courses_id}/section-0.md";
        //##获取Markdown文件 渲染赋值
        if(file_exists($path)){
            $markdown =file_get_contents($path);
            include './Public/Library/Michelf/Markdown.inc.php';
            $courses_preface = \Michelf\Markdown::defaultTransform($markdown);
        }
        //赋值
        $this->assign('courses_preface',$courses_preface);
        $this->assign('data',$data);
        $this->assign('avg_score',$avg_score);
        $this->assign('submit_count',$submit_count);
        //输出
        $this->display();
    }
    public function body($courses_id ,$section_id){
        if( !( preg_match('/^\d+$/', $courses_id) && preg_match('/^\d+$/', $section_id) ))exit('E');
        $md="./Nutjs/Home/Public/Include/NutStore/article/{$courses_id}/section-{$section_id}.md";
        $this->assign('markdown',decode_markdown($md));
        $this->display();
    }
    public function edit($courses_id=0){
        if( !preg_match('/^\d+$/', $courses_id))exit('E');
        //#作品信息
        $mo_works =new \Home\Model\NsWorksListModel();
        $mo_works ->where(array('id'=>$courses_id));
        $mo_works ->relation('section');
        $data =$mo_works->find();
        //模板赋值
        $this->assign('data',$data);
        //var_dump($data);
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
    /*! =====特殊方法=====*/
    /**
     * 测试方法
     * */
    public function debug(){
        echo 'Home / NutStoreController -> debug()';
    }
    /**
     * 架构函数 取得模板对象实例
     * @access public
     */
    public function __construct(){
        header("Content-type: text/html; charset=utf-8");
        parent::__construct();
    }
}