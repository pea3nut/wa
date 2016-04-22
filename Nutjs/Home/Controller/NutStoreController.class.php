<?php
namespace Home\Controller;
use Think\Controller;
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
        $works_da =new \Home\ViewData\WorksViewData($works_id);
        $this->_data['works'] =$works_da->find();
        //## author信息
        $author_da =new \Home\ViewData\UserViewData($this->_data['works']['author_uid']);
        $this->_data['author'] =$author_da->find();
        //## 课程序言
        $md="./Nutjs/Home/Public/Include/NutStore/article/{$works_id}/section-0.md";
        $this->_data['works']['preface'] =decode_markdown($md);
        //## 章节列表

        //## 课程统计信息
        //$this->display();
        var_dump($this->_data);
    }
    //编辑可选信息页面
    public function edit($works_id){
        //过滤非法字符
        $works_id   =(int)$works_id;
        //# 取得数据渲染模板
        //## works信息
        $works_da =new \Home\ViewData\WorksViewData($works_id);
        $this->_data['works'] =$works_da->find();
        //### 如果不是课程作者
        if($this->_data['works']['author_uid'] !== cookie('uid')) $this->error('只有课程作者才可以编辑课程信息','javascript:history.back(-1);');
        //## author信息
        $author_da =new \Home\ViewData\UserViewData($this->_data['works']['author_uid']);
        $this->_data['author'] =$author_da->find();
        $this->display();
    }
    //果仁商店个人信息页面
    public function member($uid='') {
        //过滤非法字符
        $uid =$uid?:cookie('uid');
        if(!preg_match(RegExp_uid, $uid)) $this->error();
        //渲染输出模板
        $mr_da =new \Home\ViewData\MemberViewData($uid);
        $this->_data =array_merge($this->_data ,$mr_da->find());
        $this->display();
        //var_dump($this->_data);
    }
    //查看课程列表
    public function works_list($order_by ,$aod='asc'){
        $list_da =new \Home\ViewData\ListViewData($order_by, $aod);
        $this->_data =array_merge($this->_data ,$list_da->select());
        var_dump($this->_data);
    }
    //阅读课程界面
    public function read($works_id ,$section='0'){
        //过滤非法字符
        $works_id   =(int)$works_id;
        $section    =(int)$section;
        //获取works信息，下面要用
        $works_da =new \Home\ViewData\WorksViewData($works_id);
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
        $author_da =new \Home\ViewData\UserViewData($this->_data['works']['author_uid']);
        $this->_data['author'] =$author_da->find();
        //## 章节信息
        $mdFile =MODULE_PATH.'Public/Include/'.CONTROLLER_NAME."/article/{$works_id}/section-{$section}.md";
        if(file_exists($mdFile)) $this->_data['works']['section']=decode_markdown($mdFile);
        var_dump($this->_data);
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
     * */
    public function __construct(){
        header("Content-type: text/html; charset=utf-8");
        parent::__construct();
    }
}