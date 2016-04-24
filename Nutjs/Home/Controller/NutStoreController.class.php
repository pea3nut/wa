<?php
namespace Home\Controller;
use Think\Controller;
/**
 * 果仁商店页面
 * */
class NutStoreController extends Controller {
    //查看课程信息页面
    public function works($works_id){
        #过滤非法字符
        $works_id   =(int)$works_id;
        # 取得数据渲染模板
        ## works信息
        $works_da =new \Home\ViewData\WorksViewData();
        $this->_data['works'] =$works_da->find($works_id);
        ## 课程序言
        $md="./Nutjs/Home/Public/Include/NutStore/article/{$works_id}/section-0.md";
        $this->_data['works']['preface'] =decode_markdown($md);
        # 渲染输出
        $this->display();
    }
    //编辑可选信息页面
    public function edit($works_id){
        # 过滤非法字符
        $works_id   =(int)$works_id;
        # 检查登陆
        test_control_login();
        # 取得works信息
        $works_da =new \Home\ViewData\WorksViewData();
        $this->_data['works'] =$works_da->find($works_id);
        # 校验作者
        if($this->_data['works']['inf']['author_uid'] !== cookie('uid'))
            $this->error('只有课程作者才可以编辑课程信息');
        # 渲染输出
        $this->display();
    }
    //果仁商店个人信息页面
    public function member($uid='') {
        # 过滤非法字符
        $uid =strtoupper($uid?:cookie('uid'));
        if(empty($uid)) $this->error('请先登录',U('Member/sign_in'));
        if(!preg_match(RegExp_uid, $uid)) $this->error('不存在此用户');
        # 渲染输出模板
        $mr_da =new \Home\ViewData\MemberViewData($uid);
        $this->_data =array_merge($this->_data ,$mr_da->find());
        # 输出个人信息
        if($uid == cookie('uid')){//查看自己的信息
            $this->_data['target_user'] =&$this->_data['user'];
        }else{//获取信息
            $user_va =new \Home\ViewData\UserViewData($uid);
            $this->_data['target_user'] =$user_va->find();
        }
        $this->display();
    }
    //查看课程列表
    public function works_list($order_by='update_date' ,$aod='desc'){
        # 过滤非法数据
        if(!preg_match('/^\w+$/', $this->order_by=$order_by)) $this->error('排序字段无效');
        if(!preg_match('/^(asc|desc)$/i', $this->aod=$aod)) $this->error('排序方式仅能为asc|desc');
        # 取得作品信息
        $works_da =new \Home\ViewData\WorksViewData();
        $works_da->order("$order_by $aod");
        $this->_data['works'] =$works_da->select();
        # 输出排序信息
        $this->_data['order'] =strtolower("$order_by $aod");
        $this->display();
    }
    //阅读课程界面
    public function read($works_id ,$section='0'){
        # 过滤非法字符
        $works_id   =(int)$works_id;
        $section    =(int)$section;
        # 获取works信息，下面要用
        $works_da =new \Home\ViewData\WorksViewData();
        $this->_data['works'] =$works_da->find($works_id);
        # 页面权限判断
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
        # 渲染章节Markdown
        $mdFile =MODULE_PATH.'Public/Include/'.CONTROLLER_NAME."/article/{$works_id}/section-{$section}.md";
        if(file_exists($mdFile)) $this->_data['section_value']=decode_markdown($mdFile);
        $this->display();
    }
    //购买作品
    public function buy($works_id){
        #过滤非法字符
        $works_id   =(int)$works_id;
        # 取得数据渲染模板works信息
        $works_da =new \Home\ViewData\WorksViewData();
        $this->_data['works'] =$works_da->find($works_id);
        # 渲染输出
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
     * */
    public function __construct(){
        header("Content-type: text/html; charset=utf-8");
        parent::__construct();
    }
}