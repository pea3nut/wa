<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;
/**
 * 工具控制器
 * */
class ToolsController extends Controller {
    /**
     * 检测数据库连接，成功则输出成功信息，失败则报错
     * @access public
     * */
    public function test_db(){
        $mo=new Model();
        $msg=$mo->table('wa_users')->getDbFields();
        echo '连接成功！';
    }
    /**
     * 以一个更友好的方式检测令牌
     * 通过此方法可以更直观的显示状态信息。
     * @param $uid 协会编号，默认获取cookie('uid')
     * @param $token 协会编号，默认获取cookie('token')
     * @access public
     * */
    public function test_login($uid='',$token='') {
        //获取默认值
        if (empty($uid))$uid=cookie('uid');
        if (empty($token))$token=cookie('token');
        //输出原始信息
        echo "-- uid ---> $uid\n-- token-> $token\n";
        //检测令牌
        if(test_token($uid,$token)){
            echo '<br />已通过 test_token<br />';
        }else {
            echo '<br />未通过 test_token <br />';
            if (defined('APP_DEBUG') && APP_DEBUG){
                //输出数据库的令牌
                $mo=new \Home\Model\TokenModel();
                $mo->where(array('uid'=>$uid));
                $mo->field('token');
                $db_token = $mo->find()['token'];
                echo "<br />DbToken -- $db_token<br />";
            };
        }
        //调用get_state
        echo '<br />get_state 返回 '.get_state($uid),'<br />';
    }
    /**
     * 检测令牌是否有效
     * 通过此接口可以检测当前令牌是否有效。确切的说是检测现在是否是成功登陆的状态。
     * @param $uid 协会编号，默认获取cookie('uid')
     * @param $token 协会编号，默认获取cookie('token')
     * @access public
     * */
    public function test_token($uid='',$token='') {
        if(test_token($uid,$token)){
            echo 1;
        }else{
            echo 0;
        };
    }
    /**
     * 获取某个用户的账号状态值
     * 通过此接口可以直接获取某个用户账号的状态值
     * @param $uid 协会编号，默认获取cookie('uid')
     * @access public
     * */
    public function get_state($uid) {
        echo get_state($uid);
    }
    /**
     * 架构函数 取得模板对象实例
     * @access public
     */
    public function __construct(){
        //关闭页面调试工具（trace）
        C('SHOW_PAGE_TRACE',false);
        parent::__construct();
    }
}