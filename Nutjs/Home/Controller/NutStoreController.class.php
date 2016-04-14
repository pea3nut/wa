<?php
namespace Home\Controller;
use Think\Controller;
use Home\ViewData\WorksViewData;
use Home\ViewData\UserViewData;
/**
 * 果仁商店页面
 * */
class NutStoreController extends Controller {
    //查看课程信息页面
    public function works($works_id){
        //过滤非法字符
        $works_id   =(int)$works_id;
        //# 取得数据渲染模板
        //## works信息
        $works_da =new WorksViewData($works_id);
        $this->_data['works'] =$works_da->find();
        //## author信息
        $author_da =new UserViewData($this->_data['works']['author_uid']);
        $this->_data['author'] =$author_da->find();
        var_dump($this->_data);
    }
    //编辑可选信息页面
    public function edit($works_id){
        //过滤非法字符
        $works_id   =(int)$works_id;
        //# 取得数据渲染模板
        //## works信息
        $works_da =new WorksViewData($works_id);
        $this->_data['works'] =$works_da->find();
        //### 如果不是课程作者
        if($this->_data['works']['author_uid'] !== cookie('uid')) $this->error('只有课程作者才可以编辑课程信息');
        //## author信息
        $author_da =new UserViewData($this->_data['works']['author_uid']);
        $this->_data['author'] =$author_da->find();
        var_dump($this->_data);
    }
    //果仁商店个人信息页面
    public function member($uid='') {
        //过滤非法字符
        $uid =$uid?:cookie('uid');
        if(!preg_match(RegExp_uid, $uid)) $this->error();
    }
    //查看课程列表
    //阅读课程界面
    public function read($works_id ,$section='0'){
        //过滤非法字符
        $works_id   =(int)$works_id;
        $section    =(int)$section;
        //获取works信息，下面要用
        $works_da =new WorksViewData($works_id);
        $this->_data['works'] =$works_da->find();
        //页面权限判断
        if($section !== 0){//如果请求的不是第0章节
            if(test_token()){//如果已登录
                if($this->_data['works']['author_uid'] !== cookie('uid')){//如果不是课程作者
                    $mo =new \Home\Model\NsBuyModel();
                    $mo ->where(array(
                        'works_id'  =>(int)$works_id,
                        'uid'       =>cookie('uid'),
                    ));
                    if(empty($mo->find())){//如果没购买
                        $this->error('请先购买此课程',U('NutStore/works/'.$works_id) );
                    }
                }
            }else{//如果没登陆
                $this->error('阅读章节请先登录',U('Member/sign_in'));
            }
        };
        //# 取得数据渲染模板
        //## author信息
        $author_da =new UserViewData($this->_data['works']['author_uid']);
        $this->_data['author'] =$author_da->find();
        //## 章节信息
        $mdFile =MODULE_PATH.'Public/Include/'.CONTROLLER_NAME."/article/{$works_id}/section-{$section}.md";
        if(file_exists($mdFile)) $this->_data['works']['section']=decode_markdown($mdFile);
        var_dump($this->_data);
    }

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