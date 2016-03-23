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
        $tpl='
            <table border="1" cellspacing="0" cellpadding="3">
                <tr>
                    <td colspan="2"><strong>原始值</strong></td>
                </tr>
                <tr>
                    <td>uid</td>
                    <td>{$uid}</td>
                </tr>
                <tr>
                    <td>token</td>
                    <td>{$token}</td>
                </tr>
                <tr>
                    <td colspan="2"><strong>函数返回值</strong></td>
                </tr>
                <tr>
                    <td>test_token($uid,$token)</td>
                    <td>{$test_token}</td>
                </tr>
                <tr>
                    <td>get_state($uid)</td>
                    <td>{$get_state}</td>
                </tr>
            </table>
        ';
        //获取默认值
        if (empty($uid))$uid=cookie('uid');
        if (empty($token))$token=cookie('token');
        //渲染信息
        $tpl =str_replace('{$uid}'        ,$uid ,$tpl);
        $tpl =str_replace('{$token}'      ,$token ,$tpl);
        $tpl =str_replace('{$test_token}' ,test_token($uid,$token)?'true':'false' ,$tpl);
        $tpl =str_replace('{$get_state}'  ,get_state($uid) ,$tpl);
        //输出信息
        echo $tpl;
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