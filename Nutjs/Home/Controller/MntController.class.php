<?php
namespace Home\Controller;
use Think\Controller;
/**
 * 测试控制器
 * */
class MntController extends Controller {
    public function debug(){
        $mo_list = new \Home\Model\NsWorksListModel();
        $list_data =$mo_list->select();
        var_dump($list_data);
        $mo_buy = new \Home\Model\NsBuyModel();
        $mo_buy->group('works_id');
        $buy_data =$mo_buy->getField('works_id ,avg(score) as avg_score ,count(uid) as buy_number');
        var_dump($buy_data);

        var_dump($buy_data + $list_data);
    }
    public function __construct(){
        header("Content-type: text/html; charset=utf-8");
        parent::__construct();
    }

}