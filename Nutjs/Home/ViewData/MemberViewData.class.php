<?php
namespace Home\ViewData;
use Think\Model\RelationModel;
/**
 * 创建用于View模板NutStore/member的数据
 * */
class MemberViewData extends RelationModel{
    /**
     * 自身的表名
     * @access protected
     * @var String
     * */
    protected $tableName ='ns_works_list';
    /**
     * 构造方法传进的uid值
     * @access protected
     * @var String
     * */
    protected $uid ='';
    /**
     * 查询数据
     * @access public
     * @param mixed $options 表达式参数
     * @return mixed
     * */
    public function find($options){
        //# 要返回的数组
        $reObj =array(
            'buy'   =>array(
                'length'=>0,
            ),
            'submit'=>array(),
        );
        //# 赋值submit
        $reObj['submit'] =$this->select();
        $reObj['submit']["length"] =count($reObj['submit']);
        //# 赋值buy
        //## 获取购买记录
        $buy_mo =new \Home\Model\NsBuyModel();
        $buy_mo->where(array('uid'=>$this->uid));
        $buy_mo->field(array('id','works_id','score'));
        $buy_list =$buy_mo->select();
        //## 遍历购买记录
        for($i=0 ;$i< ($reObj['buy']['length']=count($buy_list)) ;$i++){
            //### 通过works_id获取作品信息
            $tp_da =new WorksViewData($buy_list[$i]['works_id']);
            $works_arr =$tp_da->find();
            //### author_id获取作品作者
            $author_da =new UserViewData($works_arr['author_uid']);
            $author_arr =$author_da->find();
            //### 添加到数组
            array_push($reObj['buy'], array(
                'id'    =>$buy_list[$i]['id'],
                'score' =>$buy_list[$i]['score'],
                'works' =>$works_arr,
                'author'=>$author_arr,
            ));
            //### 释放多余的字段
            unset($buy_list[i]['works_id']);
        };
        return $reObj;
    }
    /**
     * 针对本层特殊的构造函数
     * @access public
     * @param $uid 获取记录的uid值
     * */
    public function __construct($uid){
        if(!preg_match(RegExp_uid, $uid)) drop('1201,MemberViewData构造时发生异常');
        $this->uid=$uid;
        $this->options['field'] =$this->fields;
        $this->options['link']  =true;
        $this->options['where'] =array('uid'=>$uid);
        parent::__construct();
    }
}