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
     * @return mixed
     * */
    public function find(){
        //# 要返回的数组
        $reObj =array(
            'buy'         =>array(),
            'submit'      =>array(),
        );
        //# 赋值submit
        $works_da =new \Home\ViewData\WorksViewData();
        $works_da->where(array('author_uid' =>$this->uid));
        $reObj['submit'] =$works_da->select();
        //# 赋值buy
        //## 获取购买记录
        $buy_mo =new \Home\Model\NsBuyModel();
        $buy_mo->where(array('uid'=>$this->uid));
        $buy_mo->field(array('id','works_id','score'));
        $buy_list =$buy_mo->select();
        //## 遍历购买记录
        for($i=0 ;$i<count($buy_list) ;$i++){
            //### 通过购买记录的works_id获取作品信息
            $works_da =new \Home\ViewData\WorksViewData();
            echo $buy_list[$i]['works_id'],"\n";
            $buy_works =$works_da ->find($buy_list[$i]['works_id']);
            //### 添加到数组
            array_push($reObj['buy'], array(
                'id'    =>$buy_list[$i]['id'],
                'my_score' =>$buy_list[$i]['score'],
                'works' =>$buy_works,
            ));
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
        $this->options['where'] =array('author_uid'=>$uid);
        parent::__construct();
    }
}